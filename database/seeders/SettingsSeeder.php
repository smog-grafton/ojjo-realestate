<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mailSettings = [
            [
                'key' => 'mail_mailer',
                'value' => 'smtp',
                'group' => 'mail',
                'type' => 'string',
                'description' => 'Mail driver to use (smtp, sendmail, mailgun, etc.)',
                'is_encrypted' => false,
            ],
            [
                'key' => 'mail_host',
                'value' => 'smtp.hostinger.com',
                'group' => 'mail',
                'type' => 'string',
                'description' => 'SMTP server hostname',
                'is_encrypted' => false,
            ],
            [
                'key' => 'mail_port',
                'value' => '465',
                'group' => 'mail',
                'type' => 'integer',
                'description' => 'SMTP server port',
                'is_encrypted' => false,
            ],
            [
                'key' => 'mail_username',
                'value' => 'newsletter@yourdomain.com', // Replace with actual email
                'group' => 'mail',
                'type' => 'string',
                'description' => 'SMTP username (email address)',
                'is_encrypted' => false,
            ],
            [
                'key' => 'mail_password',
                'value' => '9898@Morgan21@9898',
                'group' => 'mail',
                'type' => 'string',
                'description' => 'SMTP password',
                'is_encrypted' => true, // Encrypt the password
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'ssl',
                'group' => 'mail',
                'type' => 'string',
                'description' => 'SMTP encryption (ssl, tls, or null)',
                'is_encrypted' => false,
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'newsletter@ojjoestates.com',
                'group' => 'mail',
                'type' => 'string',
                'description' => 'Default from email address',
                'is_encrypted' => false,
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'Ojjo Real Estate',
                'group' => 'mail',
                'type' => 'string',
                'description' => 'Default from name',
                'is_encrypted' => false,
            ],
        ];

        // General settings
        $generalSettings = [
            [
                'key' => 'app_name',
                'value' => 'Ojjo Real Estate',
                'group' => 'general',
                'type' => 'string',
                'description' => 'Application name',
                'is_encrypted' => false,
            ],
            [
                'key' => 'newsletter_enabled',
                'value' => true,
                'group' => 'newsletter',
                'type' => 'boolean',
                'description' => 'Enable/disable newsletter functionality',
                'is_encrypted' => false,
            ],
            [
                'key' => 'newsletter_from_name',
                'value' => 'Ojjo Real Estate Newsletter',
                'group' => 'newsletter',
                'type' => 'string',
                'description' => 'Newsletter sender name',
                'is_encrypted' => false,
            ],
        ];

        $allSettings = array_merge($mailSettings, $generalSettings);

        foreach ($allSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Settings seeded successfully!');
    }
}
