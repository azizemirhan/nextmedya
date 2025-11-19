<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        $settings = Cache::remember('settings', now()->addDay(), function () {
            return Setting::all()->keyBy('key');
        });

        $setting = $settings->get($key);

        if (!$setting) {
            return $default;
        }

        // DÜZELTME: Eğer value zaten array ise olduğu gibi döndür
        if (is_array($setting->value)) {
            return $setting->value;
        }

        // String ise decode et
        if (is_string($setting->value)) {
            $decoded = json_decode($setting->value, true);
            return $decoded ?? $setting->value;
        }

        return $setting->value ?? $default;
    }
}

