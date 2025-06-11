<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Place;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UpdatePlaceImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-place-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update place images using featured images from properties';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update place images...');
        
        // Get all places
        $places = Place::all();
        $this->info('Found ' . $places->count() . ' places.');
        
        $updated = 0;
        
        foreach ($places as $place) {
            // Get a property with images for this place
            $property = Property::where('place_id', $place->id)
                ->whereNotNull('images')
                ->where('images', '!=', '')
                ->where('status', 'approved')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->first();
            
            if ($property) {
                try {
                    // Get the first image from the images JSON array
                    $images = json_decode($property->images, true);
                    
                    if (!empty($images) && is_array($images) && count($images) > 0) {
                        $sourcePath = $images[0];
                        
                        // Make sure the source file exists
                        if (!Storage::disk('public')->exists($sourcePath)) {
                            $this->warn("Source image not found: $sourcePath");
                            continue;
                        }
                        
                        // Determine the destination path
                        $extension = pathinfo($sourcePath, PATHINFO_EXTENSION);
                        if (empty($extension)) {
                            $extension = 'jpg';
                        }
                        
                        $destinationPath = 'places/' . $place->slug . '.' . $extension;
                        
                        // Copy the file
                        Storage::disk('public')->copy($sourcePath, $destinationPath);
                        
                        // Update the place image
                        $place->image = $destinationPath;
                        $place->save();
                        
                        $updated++;
                        $this->info("Updated image for place: {$place->name}");
                    } else {
                        $this->warn("No images found in property JSON for place: {$place->name}");
                    }
                } catch (\Exception $e) {
                    $this->error("Error processing image for {$place->name}: " . $e->getMessage());
                }
            } else {
                $this->warn("No property with images found for place: {$place->name}");
            }
        }
        
        $this->info("Updated images for $updated places.");
        
        return Command::SUCCESS;
    }
}
