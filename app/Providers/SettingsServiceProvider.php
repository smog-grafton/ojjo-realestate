<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Only try to load settings if the settings table exists
        if (Schema::hasTable('settings')) {
            try {
                $this->configureMailSettings();
            } catch (\Exception $e) {
                // Log error but don't break the application
                Log::warning('Failed to load mail settings from database: ' . $e->getMessage());
            }
        }
    }

    /**
     * Configure mail settings from database
     */
    private function configureMailSettings(): void
    {
        $mailSettings = Setting::byGroup('mail')->pluck('value', 'key')->toArray();
        
        if (!empty($mailSettings)) {
            // Configure mail settings
            Config::set([
                'mail.default' => $mailSettings['mail_mailer'] ?? 'smtp',
                'mail.mailers.smtp.host' => $mailSettings['mail_host'] ?? 'smtp.hostinger.com',
                'mail.mailers.smtp.port' => (int) ($mailSettings['mail_port'] ?? 465),
                'mail.mailers.smtp.encryption' => $mailSettings['mail_encryption'] ?? 'ssl',
                'mail.mailers.smtp.username' => $mailSettings['mail_username'] ?? null,
                'mail.mailers.smtp.password' => $mailSettings['mail_password'] ?? null,
                'mail.from.address' => $mailSettings['mail_from_address'] ?? 'newsletter@ojjoestates.com',
                'mail.from.name' => $mailSettings['mail_from_name'] ?? 'Ojjo Real Estate',
            ]);
        }
    }
}
