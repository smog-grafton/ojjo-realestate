<?php

namespace App\Filament\Admin\Resources\AgentResource\Pages;

use App\Filament\Admin\Resources\AgentResource;
use App\Models\AgentProfile;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;
    
    protected function handleRecordCreation(array $data): Model
    {
        // Extract agent profile data
        $profileData = $data['agentProfile'] ?? [];
        unset($data['agentProfile']);
        
        // Create the user
        $user = static::getModel()::create($data);
        
        // Assign agent role
        $user->assignRole('agent');
        
        // Generate slug if not provided
        if (empty($profileData['slug']) && !empty($user->name)) {
            $profileData['slug'] = Str::slug($user->name);
            
            // Make slug unique if needed
            $count = AgentProfile::where('slug', $profileData['slug'])->count();
            if ($count > 0) {
                $profileData['slug'] .= '-' . ($count + 1);
            }
        }
        
        // Create agent profile
        $user->agentProfile()->create($profileData);
        
        return $user;
    }
}
