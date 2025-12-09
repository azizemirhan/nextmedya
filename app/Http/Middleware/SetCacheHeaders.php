<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cache Headers Middleware - Browser caching için HTTP header'ları
 * 
 * Statik ve dinamik içerik için uygun cache header'ları ayarlar.
 * Bu, PageSpeed Insights "Serve static assets with an efficient cache policy" uyarısını düzeltir.
 */
class SetCacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // API endpoint'lerini atla
        if ($request->is('api/*')) {
            return $response;
        }

        // Admin panelini atla - cache'lenmemeli
        if ($request->is('admin/*') || $request->is('panel/*')) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            return $response;
        }

        // Authenticated kullanıcılar için cache'leme
        if (auth()->check() || auth('admin')->check()) {
            $response->headers->set('Cache-Control', 'private, no-cache, must-revalidate');
            return $response;
        }

        // Statik sayfalar için browser caching
        // LCP ve FCP iyileştirmesi için önemli
        $contentType = $response->headers->get('Content-Type', 'text/html');

        if (str_contains($contentType, 'text/html')) {
            // HTML sayfaları - kısa cache + revalidation
            $response->headers->set('Cache-Control', 'public, max-age=300, stale-while-revalidate=86400');
            
            // ETag oluştur (content-based)
            $etag = md5($response->getContent());
            $response->headers->set('ETag', '"' . $etag . '"');
            
            // Conditional request kontrolü
            $ifNoneMatch = $request->header('If-None-Match');
            if ($ifNoneMatch && trim($ifNoneMatch, '"') === $etag) {
                $response->setStatusCode(304);
                $response->setContent('');
            }
        }

        // Security headers ekle (PageSpeed Best Practices için)
        if (!$response->headers->has('X-Content-Type-Options')) {
            $response->headers->set('X-Content-Type-Options', 'nosniff');
        }

        return $response;
    }
}
