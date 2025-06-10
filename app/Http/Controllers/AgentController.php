<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\AgentProfile;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    /**
     * Display a listing of agents.
     */
    public function index(Request $request)
    {
        // Get verified agents with role 'agent' and approved verification status
        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })->whereHas('agentProfile', function ($query) {
            $query->where('verification_status', 'approved');
        })->with(['agentProfile', 'agentProfile.agency'])
          ->paginate(9);

        // Get agencies for filtering
        $agencies = Agency::where('verification_status', 'approved')
            ->orderBy('name')
            ->get();

        return view('agents.index', compact('agents', 'agencies'));
    }

    /**
     * Display the specified agent.
     */
    public function show(Request $request, $slug)
    {
        // Find the agent by slug
        $agentProfile = AgentProfile::where('slug', $slug)
            ->where('verification_status', 'approved')
            ->with(['user', 'agency'])
            ->firstOrFail();

        $agent = $agentProfile->user;

        // Make sure the user has the agent role
        if (!$agent->hasRole('agent')) {
            abort(404);
        }

        // Get the agent's properties
        $properties = Property::where('user_id', $agent->id)
            ->where('status', 'available')
            ->latest()
            ->paginate(6);

        // Get featured agents (excluding the current one)
        $featuredAgents = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })->whereHas('agentProfile', function ($query) use ($agent) {
            $query->where('verification_status', 'approved')
                  ->where('user_id', '!=', $agent->id);
        })->with(['agentProfile', 'agentProfile.agency'])
          ->inRandomOrder()
          ->take(3)
          ->get();

        return view('agents.show', compact('agent', 'agentProfile', 'properties', 'featuredAgents'));
    }

    /**
     * Filter agents by agency, name, or other criteria.
     */
    public function filter(Request $request)
    {
        $query = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })->whereHas('agentProfile', function ($query) {
            $query->where('verification_status', 'approved');
        })->with(['agentProfile', 'agentProfile.agency']);

        // Filter by agency if provided
        if ($request->has('agency_id') && $request->agency_id) {
            $query->whereHas('agentProfile', function ($q) use ($request) {
                $q->where('agency_id', $request->agency_id);
            });
        }

        // Filter by name if provided
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Get paginated results
        $agents = $query->paginate(9)->appends($request->all());

        // Get agencies for filtering
        $agencies = Agency::where('verification_status', 'approved')
            ->orderBy('name')
            ->get();

        return view('agents.index', compact('agents', 'agencies'));
    }
}
