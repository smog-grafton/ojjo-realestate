<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            [
                'name' => 'New York',
                'slug' => 'new-york',
                'image' => 'place-images/new-york.jpg',
                'description' => 'The Big Apple, a global center for business, arts, and culture.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'London',
                'slug' => 'london',
                'image' => 'place-images/london.jpg',
                'description' => 'The capital of England and the United Kingdom.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Los Angeles',
                'slug' => 'los-angeles',
                'image' => 'place-images/los-angeles.jpg',
                'description' => 'The City of Angels, known for entertainment and cultural attractions.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Paris',
                'slug' => 'paris',
                'image' => 'place-images/paris.jpg',
                'description' => 'The City of Light, famous for its art, fashion, and cuisine.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Tokyo',
                'slug' => 'tokyo',
                'image' => 'place-images/tokyo.jpg',
                'description' => 'Japan\'s busy capital, blending ultramodern with traditional.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($places as $place) {
            Place::create($place);
        }
    }
}
