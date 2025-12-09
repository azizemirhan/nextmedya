<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        // Controller'dan view'e aktif dilleri de gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.settings.index', compact('settings', 'activeLanguages'));
    }

    /**
     * Tüm ayarları tek bir yerden günceller.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'header_cta_text' => 'nullable|array',
            'footer_contact_text' => 'nullable|array',
            'footer_info_text' => 'nullable|array',
            'newsletter_title' => 'nullable|array',
            'newsletter_subtitle' => 'nullable|array',
            'copyright_text' => 'nullable|array',
            'footer_contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png,svg|max:1024',
            'google_site_verification' => 'nullable|string|max:255',
            'bing_site_verification' => 'nullable|string|max:255',
            'yandex_site_verification' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:7',
            'primary_color_light' => 'nullable|string|max:7',
        ]);

        $fileInputs = ['site_logo', 'footer_logo', 'site_favicon'];

        // Dosya olmayan tüm ayarları işle
        foreach ($validatedData as $key => $value) {
            if (in_array($key, $fileInputs)) {
                continue;
            }
            // HİÇBİR json_encode YOK. Veriyi ham haliyle (array veya string) modele gönderiyoruz.
            // Model doğru formatlamayı otomatik olarak yapacak.
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Bakım Modu ayarını işle
        Setting::updateOrCreate(
            ['key' => 'maintenance_mode'],
            ['value' => $request->has('maintenance_mode') ? 'on' : 'off']
        );

        // Dosya yüklemelerini işle
        foreach ($fileInputs as $key) {
            if ($request->hasFile($key)) {
                $existingPath = setting($key);
                $newPath = $this->uploadImage($request, $key, 'uploads/settings', $existingPath);
                Setting::updateOrCreate(['key' => $key], ['value' => $newPath]);
            }
        }

        Cache::forget('settings');
        Cache::forget('settings.all');

        return redirect()->back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }

    /**
     * Dil ayarlarını günceller.
     */
    public function updateLanguages(Request $request)
    {
        $validated = $request->validate([
            'active_languages' => 'required|array',
            'active_languages.*' => 'in:' . implode(',', array_keys(config('languages.supported'))),
        ]);

        // HİÇBİR json_encode YOK. Ham diziyi doğrudan modele gönderiyoruz.
        Setting::updateOrCreate(
            ['key' => 'active_languages'],
            ['value' => $validated['active_languages']]
        );

        Cache::forget('settings');
        Cache::forget('settings.all');

        return redirect()->back()->with('success', 'Dil ayarları başarıyla güncellendi.');
    }

    public function generateSitemap()
    {
        try {
            \Artisan::call('sitemap:generate');
            return back()->with('success', 'Sitemap.xml başarıyla oluşturuldu ve güncellendi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Sitemap oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }

    // index metodunun view'e göndermesi için bu metodu ekliyoruz.
    private function getActiveLanguages(): array
    {
        $activeLanguageCodes = setting('active_languages', ['tr', 'en']);
        if (!is_array($activeLanguageCodes)) {
            $activeLanguageCodes = json_decode($activeLanguageCodes, true) ?? ['tr', 'en'];
        }
        $supportedLanguages = config('languages.supported', []);
        return collect($supportedLanguages)
            ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes))
            ->toArray();
    }
}
