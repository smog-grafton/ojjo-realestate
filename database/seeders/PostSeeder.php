<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find an admin user, or use the first user if no admin exists
        $admin = User::first();
        
        // Get all categories and tags
        $categories = Category::all();
        $tags = Tag::all();
        
        // Post 1
        $post1 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $categories->where('name', 'Real Estate News')->first()?->id ?? $categories->random()->id,
            'title' => 'Your Vision Unrestricted: East African Real Estate',
            'excerpt' => 'To revolutionize the travel and real estate experience by seamlessly connecting users to premium accommodations and properties across East Africa and beyond.',
            'body' => '<p>To revolutionize the travel and real estate experience by seamlessly connecting users to premium accommodations and properties across East Africa and beyond. Our vision is to empower travelers with innovative tools, trusted services, and unparalleled accessibility, fostering memorable journeys and confident investments. We strive to set the benchmark for reliability, transparency, and excellence in booking and real estate services.</p>
                      <p>At OjjoEstates, we believe in transforming how people interact with real estate in East Africa. Our comprehensive platform offers a wide range of properties, from luxury villas to affordable housing, commercial spaces to vacation rentals, all designed to meet the diverse needs of our clients.</p>
                      <p>Our approach combines cutting-edge technology with deep local knowledge, ensuring that users can make informed decisions about their property investments. We work closely with trusted developers, agents, and property owners to curate a selection of high-quality listings that meet our rigorous standards.</p>',
            'status' => 'published',
            'published_at' => now()->subDays(30),
            'views' => rand(100, 500),
        ]);
        
        $post1->tags()->attach($tags->whereIn('name', ['East Africa', 'Property', 'Investment'])->pluck('id')->toArray());
        
        // Post 2
        $post2 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $categories->where('name', 'Market Trends')->first()?->id ?? $categories->random()->id,
            'title' => 'Driving Excellence in Real Estate and Hospitality',
            'excerpt' => 'Our mission is to connect clients with exceptional real estate opportunities and world-class accommodations, ensuring a seamless experience that delivers value, trust, and satisfaction.',
            'body' => '<p>Our mission is to connect clients with exceptional real estate opportunities and world-class accommodations, ensuring a seamless experience that delivers value, trust, and satisfaction. This commitment drives everything we do at OjjoEstates, from our careful property selection process to our attentive customer service.</p>
                      <p>In the real estate sector, excellence means more than just offering properties; it means understanding the unique needs of each client and providing tailored solutions. Whether you\'re a first-time buyer looking for your dream home, an investor seeking profitable opportunities, or a property owner looking to sell, our team is dedicated to guiding you through every step of the process.</p>
                      <p>In hospitality, we work with premier hotels, resorts, and vacation rentals across East Africa to offer accommodations that meet international standards while showcasing the region\'s unique charm and culture. Our booking platform is designed to make finding and reserving the perfect place to stay simple and stress-free.</p>',
            'status' => 'published',
            'published_at' => now()->subDays(20),
            'views' => rand(100, 500),
        ]);
        
        $post2->tags()->attach($tags->whereIn('name', ['Hospitality', 'Hotels', 'East Africa'])->pluck('id')->toArray());
        
        // Post 3
        $post3 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $categories->where('name', 'Investment Insights')->first()?->id ?? $categories->random()->id,
            'title' => 'From Vision to Reality: Our Journey',
            'excerpt' => 'Founded by Ojjo Property Masters Ltd and powered by SmogCoders, we\'ve grown into a leading name in East Africa for real estate and booking services.',
            'body' => '<p>Founded by Ojjo Property Masters Ltd and powered by SmogCoders, we\'ve grown into a leading name in East Africa for real estate and booking services. Our journey continues as we innovate and expand globally.</p>
                      <p>Our story began with a simple observation: the East African real estate market, despite its tremendous potential, lacked a comprehensive platform that could connect property seekers with quality listings in a transparent and efficient manner. This gap in the market inspired the creation of OjjoEstates, a platform designed to transform how people buy, sell, and rent properties in the region.</p>
                      <p>Since our launch, we\'ve continuously evolved our services based on user feedback and market demands. We\'ve expanded our property portfolio to include diverse options across multiple countries, developed innovative tools to simplify the search process, and built strong partnerships with key players in the real estate and hospitality industries.</p>
                      <p>As we look to the future, our focus remains on leveraging technology to enhance the real estate experience while maintaining the personal touch that has been central to our success. Our growing team of experts is committed to staying ahead of market trends and adapting our services to meet the changing needs of our clients.</p>',
            'status' => 'published',
            'published_at' => now()->subDays(10),
            'views' => rand(100, 500),
        ]);
        
        $post3->tags()->attach($tags->whereIn('name', ['Investment', 'Commercial', 'Residential'])->pluck('id')->toArray());
        
        // Post 4
        $post4 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $categories->where('name', 'Buying Tips')->first()?->id ?? $categories->random()->id,
            'title' => 'Building Communities, Transforming Lives',
            'excerpt' => 'We don\'t just facilitate transactions; we create opportunities and contribute to the development of communities across East Africa.',
            'body' => '<p>We don\'t just facilitate transactions; we create opportunities and contribute to the development of communities across East Africa. At OjjoEstates, we believe that real estate is more than just properties—it\'s about building spaces where people can thrive and communities can flourish.</p>
                      <p>Through our platform, we\'ve helped connect investors with development projects that have created housing, commercial spaces, and hospitality venues that serve local communities. By facilitating these investments, we\'ve played a role in creating jobs, improving infrastructure, and enhancing quality of life in various locations across East Africa.</p>
                      <p>We\'re particularly proud of our work with affordable housing initiatives, which aim to address the housing deficit in urban areas by providing quality homes at accessible prices. These projects not only help meet the basic need for shelter but also create stable environments where families can build their futures.</p>
                      <p>Our commitment to community development extends beyond property transactions. We regularly organize educational workshops on real estate investment, homeownership, and property management, empowering individuals with the knowledge they need to make informed decisions about one of life\'s most significant investments.</p>',
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'views' => rand(100, 500),
        ]);
        
        $post4->tags()->attach($tags->whereIn('name', ['Community', 'Investment', 'East Africa'])->pluck('id')->toArray());
    }
}
