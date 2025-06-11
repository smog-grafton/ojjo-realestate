<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Post;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get the latest published blog posts for the homepage
        $latestPosts = Post::with(['user', 'category'])
            ->published()
            ->latest('published_at')
            ->take(2)
            ->get();

        // Get featured properties for the homepage
        $featuredProperties = Property::where('status', 'available')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        // Get popular places - cities with the most properties
        $popularPlaces = Place::withCount('properties')
            ->where('is_active', true)
            ->orderBy('properties_count', 'desc')
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        return view('home', compact('latestPosts', 'featuredProperties', 'popularPlaces'));
    }
}
