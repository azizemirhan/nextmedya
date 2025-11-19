<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class FixSettingsCommand extends Command
{
    protected $signature = 'settings:fix-json';
    protected $description = 'Fix JSON encoding issues in settings table';

    public function handle()
    {
        $this->info('Fixing settings JSON encoding...');

        $jsonFields = [
            'active_languages',
            'header_cta_text',
            'footer_contact_text',
            'footer_info_text',
            'newsletter_title',
            'newsletter_subtitle',
            'copyright_text'
        ];

        foreach ($jsonFields as $field) {
            $setting = Setting::where('key', $field)->first();

            if ($setting) {
                $value = $setting->value;

                // Eğer string içinde \" varsa ve JSON gibi görünüyorsa düzelt
                if (is_string($value) && str_starts_with($value, '"[') && str_ends_with($value, ']"')) {
                    // Çift tırnak içindeki JSON'u düzelt
                    $fixed = trim($value, '"');
                    $fixed = str_replace('\"', '"', $fixed);

                    $setting->value = $fixed;
                    $setting->save();

                    $this->info("Fixed: {$field}");
                }
            }
        }

        $this->info('Settings JSON encoding fixed!');
        return 0;
    }
}

// Kullanım: php artisan settings:fix-json
