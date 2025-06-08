<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminExists = User::where('email', 'smoggrafton@gmail.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Mulinda Akiibu',
                'email' => 'smoggrafton@gmail.com',
                'password' => Hash::make('9898@Morgan21@9898'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
