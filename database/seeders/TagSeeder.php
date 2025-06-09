<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Investment',
            'Luxury',
            'First-Time Buyer',
            'Uganda',
            'Kenya',
            'Tanzania',
            'Rwanda',
            'East Africa',
            'Property',
            'Land',
            'Residential',
            'Commercial',
            'Hospitality',
            'Hotels',
            'Vacation Rentals',
            'Market Analysis',
            'Tips',
            'Guides',
            'Finance',
            'Mortgage',
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
