<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // 1. Ayarları SADECE BİR KEZ cache'ten veya DB'den al
            $settings = Cache::rememberForever('settings.all', function () {
                return Setting::all()->keyBy('key');
            });

            // Ayarları tüm view'larla paylaş
            View::share('settings', $settings);

            // 2. Aktif dil kodlarını al (setting() zaten dizi döndürüyor)
            $activeLanguageCodes = $settings->get('active_languages')?->value ?? ['tr', 'en'];
            if (!is_array($activeLanguageCodes)) {
                $activeLanguageCodes = ['tr', 'en'];
            }

            // 3. Uygulamanın dilini (locale) ayarla
            $this->setApplicationLocale($activeLanguageCodes);

            // 4. Menüyü al ve paylaş
            $mainMenu = Menu::where('slug', 'main-menu')->with('items')->first();
            View::share('mainMenu', $mainMenu);

            // 5. Aktif dil bilgilerini (isimleri vb.) tüm view'larla paylaş
            $this->shareActiveLanguages($activeLanguageCodes);

        } catch (\Exception $e) {
            // Veritabanı bağlantısı gibi bir sorun olursa sitenin çökmesini engelle
            View::share('settings', collect());
            View::share('mainMenu', null);
            View::share('activeLanguages', collect(['tr' => ['name' => 'Turkish', 'native' => 'Türkçe']]));
            app()->setLocale('tr');
        }
    }

    /**
     * Aktif dilleri config dosyasından alıp view'larla paylaşır.
     */
    private function shareActiveLanguages(array $activeLanguageCodes): void
    {
        // Config'den tüm desteklenen dilleri al
        $allLanguages = config('languages.supported', []);

        // Sadece aktif olan dilleri filtrele ve sırala
        $activeLanguages = collect($allLanguages)
            ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));

        View::share('activeLanguages', $activeLanguages);
    }

    /**
     * Uygulama dilini (locale) session'daki veya varsayılan değere göre ayarlar.
     */
    private function setApplicationLocale(array $activeLanguageCodes): void
    {
        // Session başlatılmış mı kontrol et (isteğe bağlı, genellikle web middleware'i halleder)
        if (app()->runningInConsole() || !session()->isStarted()) {
            return;
        }

        // Session'dan dili al
        $sessionLocale = session('locale');

        // Varsayılan dil, aktif dillerin ilki olsun
        $defaultLocale = $activeLanguageCodes[0] ?? 'tr';

        // Geçerli dili belirle: Session'daki dil aktif diller arasında varsa onu kullan, yoksa varsayılanı kullan.
        $locale = ($sessionLocale && in_array($sessionLocale, $activeLanguageCodes))
            ? $sessionLocale
            : $defaultLocale;

        // Laravel'in dilini ve session'ı güncelle
        app()->setLocale($locale);
        session()->put('locale', $locale);
    }
}
