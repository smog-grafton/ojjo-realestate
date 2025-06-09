<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Real Estate News',
                'description' => 'Latest news and updates from the real estate industry in East Africa.',
            ],
            [
                'name' => 'Market Trends',
                'description' => 'Analysis of current and future market trends in East African real estate.',
            ],
            [
                'name' => 'Buying Tips',
                'description' => 'Helpful tips and advice for property buyers and investors.',
            ],
            [
                'name' => 'Selling Guides',
                'description' => 'Guides and strategies for selling your property quickly and profitably.',
            ],
            [
                'name' => 'Investment Insights',
                'description' => 'Expert insights on real estate investment opportunities in East Africa.',
            ],
            [
                'name' => 'Hospitality',
                'description' => 'Information about hotels, resorts, and accommodations across East Africa.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
