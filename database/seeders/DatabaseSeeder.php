<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user for Filament
        User::updateOrCreate(
            ['email' => 'admin@ojjoestates.com'],
            [
                'name' => 'Ojjo Admin',
                'email' => 'admin@ojjoestates.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Default admin user created:');
        $this->command->info('Email: admin@ojjoestates.com');
        $this->command->info('Password: admin123');

        // Call other seeders
        $this->call([
            SettingsSeeder::class,
            EmailTemplateSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
        ]);
    }
}
