<?php

namespace App\Filament\Admin\Resources\AgentResource\Pages;

use App\Filament\Admin\Resources\AgentResource;
use App\Models\AgentProfile;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class EditAgent extends EditRecord
{
    protected static string $resource = AgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Extract agent profile data
        $profileData = $data['agentProfile'] ?? [];
        unset($data['agentProfile']);
        
        // Update the user
        $record->update($data);
        
        // Ensure user has agent role
        if (!$record->hasRole('agent')) {
            $record->assignRole('agent');
        }
        
        // Generate slug if not provided
        if (empty($profileData['slug']) && !empty($record->name)) {
            $profileData['slug'] = Str::slug($record->name);
            
            // Make slug unique if needed
            $count = AgentProfile::where('slug', $profileData['slug'])
                ->where('user_id', '!=', $record->id)
                ->count();
                
            if ($count > 0) {
                $profileData['slug'] .= '-' . ($count + 1);
            }
        }
        
        // Update or create agent profile
        $record->agentProfile()->updateOrCreate(
            ['user_id' => $record->id],
            $profileData
        );
        
        return $record;
    }
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Always load the agent profile data directly from the database
        // to ensure we have the complete and current profile
        $user = $this->getRecord();
        
        // Eager load the agent profile if it's not already loaded
        if (!$user->relationLoaded('agentProfile')) {
            $user->load('agentProfile');
        }
        
        // If the user has an agent profile, add its data to the form
        if ($user->agentProfile) {
            $data['agentProfile'] = $user->agentProfile->toArray();
        }
        
        return $data;
    }
}
