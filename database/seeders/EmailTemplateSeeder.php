<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        EmailTemplate::create([
            'name' => 'Welcome Email',
            'subject' => 'Welcome to Ojjo Estates Newsletter! 🏠',
            'description' => 'Welcome email template for new subscribers',
            'body' => '
                <h2>Welcome to Ojjo Estates!</h2>
                <p>Hello {{subscriber_name}},</p>
                <p>Thank you for subscribing to our newsletter! We\'re excited to have you join our community of smart property investors across East Africa.</p>
                
                <h3>What to expect from us:</h3>
                <ul>
                    <li>🏠 <strong>Latest Property Listings</strong> - Be the first to know about new properties</li>
                    <li>📊 <strong>Market Insights</strong> - Expert analysis of real estate trends</li>
                    <li>💡 <strong>Investment Tips</strong> - Professional advice to maximize your returns</li>
                    <li>📍 <strong>Location Spotlights</strong> - Discover emerging neighborhoods</li>
                    <li>🎉 <strong>Exclusive Deals</strong> - Special offers just for subscribers</li>
                </ul>
                
                <p>We promise to deliver valuable content that helps you make informed real estate decisions.</p>
                
                <blockquote>
                    "Your journey to property ownership in East Africa starts here. Let\'s build your future together!"
                </blockquote>
                
                <p>Best regards,<br>
                The Ojjo Estates Team</p>
            ',
            'is_active' => true,
        ]);

        EmailTemplate::create([
            'name' => 'Property Update Weekly',
            'subject' => 'New Properties This Week - {{current_date}}',
            'description' => 'Weekly property listings update template',
            'body' => '
                <h2>This Week\'s Featured Properties</h2>
                <p>Hello {{subscriber_name}},</p>
                <p>Here are the latest property opportunities that just hit the market:</p>
                
                <h3>🌟 Featured This Week</h3>
                <p>We\'ve handpicked these exceptional properties based on their value, location, and investment potential.</p>
                
                <h4>🏢 Commercial Opportunities</h4>
                <ul>
                    <li>Prime office spaces in Kampala business district</li>
                    <li>Retail shops in growing residential areas</li>
                    <li>Warehouse facilities with excellent transport links</li>
                </ul>
                
                <h4>🏡 Residential Properties</h4>
                <ul>
                    <li>Modern apartments with city views</li>
                    <li>Family homes in secure neighborhoods</li>
                    <li>Luxury villas with premium amenities</li>
                </ul>
                
                <h3>💡 Investment Tip of the Week</h3>
                <p><em>"Location is everything in real estate. Properties near developing infrastructure projects often see significant appreciation over time."</em></p>
                
                <p>Ready to explore? Browse our full collection of properties and find your next investment opportunity.</p>
                
                <p>Happy investing!<br>
                The Ojjo Estates Team</p>
            ',
            'is_active' => true,
        ]);

        EmailTemplate::create([
            'name' => 'Market Insights Monthly',
            'subject' => 'East Africa Real Estate Market Report - {{current_date}}',
            'description' => 'Monthly market analysis and trends template',
            'body' => '
                <h2>Market Insights Report</h2>
                <p>Dear {{subscriber_name}},</p>
                <p>Our monthly analysis of the East African real estate market is here, packed with insights to guide your investment decisions.</p>
                
                <h3>📈 Market Highlights</h3>
                <ul>
                    <li><strong>Uganda:</strong> Residential prices up 8% year-over-year</li>
                    <li><strong>Kenya:</strong> Commercial real estate showing strong recovery</li>
                    <li><strong>Tanzania:</strong> Tourism sector driving coastal property demand</li>
                    <li><strong>Rwanda:</strong> Government infrastructure projects boosting property values</li>
                </ul>
                
                <h3>🎯 Investment Opportunities</h3>
                <h4>High Growth Areas:</h4>
                <ul>
                    <li>Satellite towns with new transport links</li>
                    <li>Areas near planned shopping centers</li>
                    <li>Emerging tech hubs and business districts</li>
                </ul>
                
                <h3>💰 Financing Update</h3>
                <p>Interest rates remain favorable for property investments, with several banks offering competitive packages for real estate financing.</p>
                
                <h3>🔮 Looking Ahead</h3>
                <p>The next quarter looks promising with several major infrastructure projects set to break ground, potentially creating new investment hotspots.</p>
                
                <blockquote>
                    "Smart investors are positioning themselves now for the growth expected in Q2. Don\'t miss out on these emerging opportunities."
                </blockquote>
                
                <p>Want detailed analysis for specific areas? Reply to this email with your areas of interest.</p>
                
                <p>Best regards,<br>
                Ojjo Estates Research Team</p>
            ',
            'is_active' => true,
        ]);

        EmailTemplate::create([
            'name' => 'Special Promotion',
            'subject' => '🎉 Limited Time Offer: {{newsletter_name}}',
            'description' => 'Template for special promotions and limited-time offers',
            'body' => '
                <h2>Exclusive Offer Just for You!</h2>
                <p>Hello {{subscriber_name}},</p>
                <p>As a valued newsletter subscriber, you get first access to our special promotions before anyone else!</p>
                
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center;">
                    <h3 style="color: #007bff; margin-bottom: 10px;">🎯 Special Offer Alert</h3>
                    <p style="margin-bottom: 15px;">This week only - Exclusive deals on selected properties</p>
                    <ul style="text-align: left; max-width: 300px; margin: 0 auto;">
                        <li>Zero processing fees</li>
                        <li>Extended payment plans</li>
                        <li>Free property valuation</li>
                        <li>Priority viewing arrangements</li>
                    </ul>
                </div>
                
                <h3>Why Act Now?</h3>
                <ul>
                    <li>⏰ <strong>Limited Time:</strong> Offer expires in 7 days</li>
                    <li>🏠 <strong>Select Properties:</strong> Handpicked for maximum value</li>
                    <li>💼 <strong>Investment Ready:</strong> All properties verified and ready</li>
                    <li>🤝 <strong>Expert Support:</strong> Our team will guide you through</li>
                </ul>
                
                <h3>How to Claim Your Offer</h3>
                <ol>
                    <li>Browse the featured properties</li>
                    <li>Contact our team mentioning this newsletter</li>
                    <li>Schedule your viewing within 48 hours</li>
                    <li>Enjoy your exclusive benefits!</li>
                </ol>
                
                <p><strong>Questions?</strong> Our investment specialists are standing by to help you make the most of this opportunity.</p>
                
                <p>Don\'t let this opportunity slip away!</p>
                
                <p>Best regards,<br>
                The Ojjo Estates Sales Team</p>
            ',
            'is_active' => true,
        ]);

        EmailTemplate::create([
            'name' => 'Property Alert',
            'subject' => '🚨 New Property Alert: Perfect Match for You!',
            'description' => 'Template for property alerts based on subscriber preferences',
            'body' => '
                <h2>Property Alert: We Found Something Special!</h2>
                <p>Hi {{subscriber_name}},</p>
                <p>Great news! A new property has just been listed that matches your preferences perfectly.</p>
                
                <div style="border: 2px solid #28a745; border-radius: 10px; padding: 20px; margin: 20px 0; background-color: #f8fff9;">
                    <h3 style="color: #28a745; margin-top: 0;">🎯 Property Match Found!</h3>
                    <p>Based on your interests, this property ticks all your boxes:</p>
                    <ul>
                        <li>✅ Location: Premium area with growth potential</li>
                        <li>✅ Price Range: Within your specified budget</li>
                        <li>✅ Type: Matches your property preferences</li>
                        <li>✅ Investment Potential: High ROI expected</li>
                    </ul>
                </div>
                
                <h3>Why This Property Stands Out</h3>
                <ul>
                    <li>🌟 <strong>Prime Location:</strong> Close to major amenities and transport</li>
                    <li>📈 <strong>Growth Area:</strong> Upcoming developments will boost value</li>
                    <li>🏗️ <strong>Modern Design:</strong> Contemporary features and finishes</li>
                    <li>💰 <strong>Great Value:</strong> Priced competitively for quick sale</li>
                </ul>
                
                <h3>⚡ Act Fast!</h3>
                <p>Properties like this don\'t stay on the market long. Similar properties in this area have sold within days of listing.</p>
                
                <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px; padding: 15px; margin: 20px 0;">
                    <p style="margin: 0;"><strong>💡 Tip:</strong> Schedule a viewing within 24 hours to avoid disappointment. Our calendar is filling up fast!</p>
                </div>
                
                <h3>Next Steps</h3>
                <ol>
                    <li>View detailed property information</li>
                    <li>Schedule an immediate viewing</li>
                    <li>Get pre-approval for financing if needed</li>
                    <li>Make your offer before others do!</li>
                </ol>
                
                <p>Our property specialists are ready to arrange an exclusive viewing for you today.</p>
                
                <p>Don\'t wait - your dream property awaits!</p>
                
                <p>Best regards,<br>
                Your Ojjo Estates Property Team</p>
            ',
            'is_active' => true,
        ]);
    }
}
