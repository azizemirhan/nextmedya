<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandlePageRedirects
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // URL'den slug'ı al (page routes için)
        $slug = $request->route('slug');

        if (!$slug) {
            return $next($request);
        }

        // Bu slug'a sahip aktif bir page var mı kontrol et
        $page = Page::where('slug', $slug)->first();

        // Page varsa ve redirect aktifse
        if ($page && $page->redirect_enabled && $page->redirect_url) {
            return redirect($page->redirect_url, $page->redirect_type ?? 301);
        }

        return $next($request);
    }
}
