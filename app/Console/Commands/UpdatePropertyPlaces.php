<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\Place;
use Illuminate\Support\Facades\Log;

class UpdatePropertyPlaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-property-places';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update property place_id fields based on city names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update property places...');
        
        // Get all places
        $places = Place::all()->pluck('id', 'name')->toArray();
        $this->info('Found ' . count($places) . ' places in the database.');
        
        // Get properties without place_id
        $properties = Property::whereNull('place_id')->get();
        $this->info('Found ' . $properties->count() . ' properties without place_id.');
        
        $updated = 0;
        $notMatched = 0;
        
        foreach ($properties as $property) {
            // Skip properties without city
            if (empty($property->city)) {
                continue;
            }
            
            // Try to find exact match
            if (isset($places[$property->city])) {
                $property->place_id = $places[$property->city];
                $property->save();
                $updated++;
            } else {
                // Try case-insensitive match
                $found = false;
                foreach ($places as $placeName => $placeId) {
                    if (strtolower($placeName) == strtolower($property->city)) {
                        $property->place_id = $placeId;
                        $property->save();
                        $updated++;
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $notMatched++;
                    Log::info("No place match found for property #{$property->id} with city: {$property->city}");
                }
            }
        }
        
        $this->info("Updated $updated properties with place_id.");
        $this->info("$notMatched properties had no matching place.");
        
        return Command::SUCCESS;
    }
}
