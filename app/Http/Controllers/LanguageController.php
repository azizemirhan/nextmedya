<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function swap($locale)
    {
        // Desteklenen dilleri kontrol et
        try {
            $activeLanguagesJson = setting('active_languages');

            // DÜZELTME: Eğer zaten array ise decode etme
            if (is_array($activeLanguagesJson)) {
                $activeLanguageCodes = $activeLanguagesJson;
            } else {
                $activeLanguageCodes = json_decode($activeLanguagesJson, true) ?? ['tr', 'en'];
            }

            // Eğer istenen dil aktif diller arasında yoksa, varsayılan dile yönlendir
            if (!in_array($locale, $activeLanguageCodes)) {
                $locale = $activeLanguageCodes[0] ?? 'tr';
            }

        } catch (\Exception $e) {
            // Hata durumunda varsayılan
            $locale = 'tr';
        }

        // Session'a kaydet
        session()->put('locale', $locale);

        // Laravel'in mevcut locale'ini de güncelle (immediate effect için)
        app()->setLocale($locale);

        // Debug için (geliştirme ortamında)
        if (config('app.debug')) {
            session()->flash('language_debug', "Dil {$locale} olarak değiştirildi");
        }

        // Önceki sayfaya geri dön
        return redirect()->back();
    }
}
