<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Google Search Console 404 hatalarını düzeltmek için
 * eski URL'leri yeni URL'lere yönlendirir.
 */
class LegacyRedirectMiddleware
{
    /**
     * Eski URL -> Yeni URL eşleştirmeleri (301 Permanent Redirect)
     */
    protected array $redirects = [
        // === ESKİ HİZMET SAYFALARI ===
        "/hizmetler/emlak-sitesi-yazilimi" => "/hizmetlerimiz/ozel-yazilim-gelistirme",
        "/hizmetler/google-reklam-danismanligi" => "/hizmetlerimiz/google-ads",
        "/hizmetler/meta-reklam-yonetimi" => "/hizmetlerimiz/sosyal-medya-yonetimi",
        "/hizmetler/freelancer-sitesi-yazilimi" => "/hizmetlerimiz/kisisel-web-sitesi",
        "/hizmetler/forum-ve-topluluk-site-tasarimi" => "/hizmetlerimiz/ozel-yazilim-gelistirme",
        "/hizmetler/b2b-eticaret-yazilimi" => "/hizmetlerimiz/e-ticaret-sitesi",
        "/hizmetler/online-egitim-yazilimi" => "/hizmetlerimiz/ozel-yazilim-gelistirme",
        "/hizmetler/bayi-yazilimi" => "/hizmetlerimiz/ozel-yazilim-gelistirme",
        "/hizmetler/amp-web-tasarim" => "/hizmetlerimiz/hiz-optimizasyonu",
        "/hizmetler/pwa-web-tasarim" => "/hizmetlerimiz/mobil-uygulamalar",
        "/hizmetler/kurumsal-web-tasarim" => "/hizmetlerimiz/kurumsal-web-sitesi",
        "/hizmetler/kisisel-web-sitesi-tasarimi" => "/hizmetlerimiz/kisisel-web-sitesi",
        "/hizmetler/sosyal-medya-yonetimi" => "/hizmetlerimiz/sosyal-medya-yonetimi",
        
        // === ESKİ BLOG KATEGORİLERİ ===
        "/bloglar/kategori/sosyal-medya" => "/bloglar/kategori/dijital-pazarlama",
        "/bloglar/kategori/icerik-uretimi" => "/bloglar/kategori/seo-ve-icerik",
        "/bloglar/kategori/sosyal-medya-yonetimi" => "/bloglar/kategori/dijital-pazarlama",
        "/bloglar/kategori/seo-analytics" => "/bloglar/kategori/seo-ve-icerik",
        
        // === SİSTEM SAYFALARI ===
        "/index.html" => "/",
        "/contact" => "/iletisim",
        "/duzenleniyor" => "/",
        "/web-tasarim" => "/hizmetlerimiz/kurumsal-web-sitesi",
        "/portfolyo" => "/",
        "/vizyon-misyon" => "/hakkimizda",
        "/degerlerimiz" => "/hakkimizda",
        
        // === ESKİ BLOG YAZI FORMATI ===
        "/blog" => "/bloglar",
    ];

    /**
     * 410 Gone döndürülecek URL pattern'leri (kalıcı olarak silindi)
     */
    protected array $gonePatterns = [
        "/blog/qui-velit-",
        "/blog/perferendis-rerum-",
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = "/" . ltrim($request->path(), "/");
        
        // Query string'siz path'i kontrol et
        $pathWithoutQuery = strtok($path, "?");
        
        // ?cmpscreen parametresi varsa kaldır ve yönlendir
        if ($request->has("cmpscreen")) {
            $cleanUrl = url($pathWithoutQuery);
            return redirect($cleanUrl, 301);
        }
        
        // Direkt eşleşme kontrolü
        if (isset($this->redirects[$pathWithoutQuery])) {
            return redirect($this->redirects[$pathWithoutQuery], 301);
        }
        
        // 410 Gone pattern kontrolü
        foreach ($this->gonePatterns as $pattern) {
            if (str_starts_with($pathWithoutQuery, $pattern)) {
                abort(410, "Bu sayfa kalıcı olarak kaldırıldı.");
            }
        }
        
        // /hizmetler/* pattern'i için genel yönlendirme
        if (str_starts_with($pathWithoutQuery, "/hizmetler/") && !str_starts_with($pathWithoutQuery, "/hizmetlerimiz/")) {
            $slug = str_replace("/hizmetler/", "", $pathWithoutQuery);
            return redirect("/hizmetlerimiz/" . $slug, 301);
        }
        
        // /blog/* pattern'i için /bloglar'a yönlendir
        if (str_starts_with($pathWithoutQuery, "/blog/") && !str_starts_with($pathWithoutQuery, "/bloglar/")) {
            $slug = str_replace("/blog/", "", $pathWithoutQuery);
            return redirect("/bloglar/" . $slug, 301);
        }
        
        return $next($request);
    }
}
