<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Place;
use App\Models\Property;

class PlaceUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get unique cities from properties where place_id is null
        $cities = Property::whereNull('place_id')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->pluck('city')
            ->toArray();
        
        // Get existing places
        $existingPlaces = Place::pluck('name')->map(function($name) {
            return strtolower($name);
        })->toArray();
        
        foreach ($cities as $city) {
            // Skip if already exists (case-insensitive check)
            if (in_array(strtolower($city), $existingPlaces)) {
                continue;
            }
            
            // Create new place
            $place = new Place();
            $place->name = $city;
            $place->slug = Str::slug($city);
            $place->description = "Properties in {$city}";
            $place->is_active = true;
            $place->sort_order = 0;
            
            // Set a default image (using a placeholder image)
            $place->image = 'places/default-place.jpg';
            
            $place->save();
            
            // Add to existing places to prevent duplicates
            $existingPlaces[] = strtolower($city);
            
            // Update properties with this city
            Property::whereNull('place_id')
                ->where('city', $city)
                ->update(['place_id' => $place->id]);
        }
        
        // Update property count cache for all places
        $places = Place::all();
        foreach ($places as $place) {
            $count = Property::where('place_id', $place->id)
                ->where('status', 'approved')
                ->where('is_active', true)
                ->count();
            
            // We don't have a properties_count column, so we'll just update the description
            // to include this information
            $place->description = "Properties in {$place->name} ({$count} listings)";
            $place->save();
        }
    }
}
