<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\PlaceUpdater;

class CreatePlacesFromCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-places-from-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create places from unique cities in the properties table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to create places from cities...');
        
        // Run the job synchronously
        (new PlaceUpdater())->handle();
        
        $this->info('Places have been created and properties updated.');
        
        return Command::SUCCESS;
    }
}
