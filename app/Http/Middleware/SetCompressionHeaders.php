<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Compression Middleware - Brotli/Gzip için response sıkıştırma
 * 
 * Bu middleware .htaccess'teki sıkıştırmayı destekler ve
 * PHP seviyesinde ek sıkıştırma sağlar.
 */
class SetCompressionHeaders
{
    /**
     * Sıkıştırılabilir MIME tipleri
     */
    protected array $compressibleTypes = [
        'text/html',
        'text/plain',
        'text/css',
        'text/javascript',
        'application/javascript',
        'application/json',
        'application/xml',
        'text/xml',
        'image/svg+xml',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Zaten sıkıştırılmış response'ları atla
        if ($response->headers->has('Content-Encoding')) {
            return $response;
        }

        // Binary content'leri atla (resimler, PDF vs.)
        $contentType = $response->headers->get('Content-Type', 'text/html');
        if (!$this->isCompressible($contentType)) {
            return $response;
        }

        // Client'ın desteklediği encoding'i kontrol et
        $acceptEncoding = $request->header('Accept-Encoding', '');
        
        // Brotli desteği varsa (en iyi sıkıştırma)
        if (str_contains($acceptEncoding, 'br') && function_exists('brotli_compress')) {
            $compressed = brotli_compress($response->getContent(), 4);
            if ($compressed !== false) {
                $response->setContent($compressed);
                $response->headers->set('Content-Encoding', 'br');
                $response->headers->set('Content-Length', strlen($compressed));
            }
        }
        // Gzip desteği
        elseif (str_contains($acceptEncoding, 'gzip') && function_exists('gzencode')) {
            $compressed = gzencode($response->getContent(), 6);
            if ($compressed !== false) {
                $response->setContent($compressed);
                $response->headers->set('Content-Encoding', 'gzip');
                $response->headers->set('Content-Length', strlen($compressed));
            }
        }
        // Deflate desteği
        elseif (str_contains($acceptEncoding, 'deflate') && function_exists('gzdeflate')) {
            $compressed = gzdeflate($response->getContent(), 6);
            if ($compressed !== false) {
                $response->setContent($compressed);
                $response->headers->set('Content-Encoding', 'deflate');
                $response->headers->set('Content-Length', strlen($compressed));
            }
        }

        // Vary header ekle
        $response->headers->set('Vary', 'Accept-Encoding');

        return $response;
    }

    /**
     * Content-Type'ın sıkıştırılabilir olup olmadığını kontrol et
     */
    protected function isCompressible(string $contentType): bool
    {
        foreach ($this->compressibleTypes as $type) {
            if (str_contains($contentType, $type)) {
                return true;
            }
        }
        return false;
    }
}
