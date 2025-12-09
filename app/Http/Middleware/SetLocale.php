<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Gelen isteği işle ve uygulama dilini ayarla.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // 1. Aktif dilleri SADECE BİR KEZ al.
            // `setting()` helper'ı modelin accessor'ı sayesinde bize zaten bir PHP dizisi veriyor.
            $activeLangs = setting('active_languages', ['tr', 'en']);

            // Güvenlik önlemi: Eğer bir sebepten dizi değilse veya boşsa, varsayılanı kullan.
            if (!is_array($activeLangs) || empty($activeLangs)) {
                $activeLangs = ['tr', 'en'];
            }

            // 2. Session'dan mevcut dili al.
            $sessionLocale = session('locale');

            // 3. Varsayılan dil olarak aktif dillerin ilkini belirle.
            $defaultLocale = $activeLangs[0];

            // 4. Geçerli dili belirle:
            // Session'da bir dil varsa VE bu dil aktif diller listesindeyse, onu kullan.
            // Aksi takdirde varsayılan dili kullan.
            $locale = ($sessionLocale && in_array($sessionLocale, $activeLangs))
                ? $sessionLocale
                : $defaultLocale;

        } catch (\Exception $e) {
            // Veritabanı veya ayar hatası gibi beklenmedik bir durumda sitenin çökmesini engelle.
            $locale = 'tr';
        }

        // 5. Belirlenen dili hem uygulama geneline hem de session'a ata.
        app()->setLocale($locale);

        // Eğer session'daki değer farklıysa güncelle.
        if (session('locale') !== $locale) {
            session()->put('locale', $locale);
        }

        return $next($request);
    }
}
