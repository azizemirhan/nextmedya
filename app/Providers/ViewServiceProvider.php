<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Bu composer, belirtilen view'lar her render edildiğinde çalışır.
        View::composer(['admin.posts._form', 'admin.categories._form', 'admin.projects._form', 'admin.sliders._form', 'admin.testimonials._form', 'admin.services.create', 'admin.services.edit'], function ($view) {

            // 1. `setting()` fonksiyonu zaten bize bir PHP dizisi veriyor.
            $activeLanguageCodes = setting('active_languages', ['tr', 'en']);

            // Güvenlik önlemi: Gelen değerin dizi olduğundan emin olalım.
            if (!is_array($activeLanguageCodes)) {
                $activeLanguageCodes = ['tr', 'en'];
            }

            // 2. config/languages.php dosyasındaki tüm desteklenen dilleri alıyoruz.
            $allLanguages = config('languages.supported', []);

            // 3. Aktif dil kodlarına göre dilleri filtreleyip sıralıyoruz.
            $activeLanguages = collect($allLanguages)
                ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
                ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));

            // 4. Sonuçları view'a 'activeLanguages' değişkeni ile gönderiyoruz.
            $view->with('activeLanguages', $activeLanguages);
        });
    }
}
