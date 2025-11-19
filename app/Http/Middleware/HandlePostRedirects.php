<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandlePostRedirects
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sadece blog sayfalarında çalış
        if (!$request->is('blog/*')) {
            return $next($request);
        }

        // URL'den slug'ı al
        $slug = $request->route('slug');

        if (!$slug) {
            return $next($request);
        }

        // Bu slug'a sahip aktif bir post var mı kontrol et
        $post = Post::where('slug', $slug)->first();

        // Post varsa ve redirect aktifse
        if ($post && $post->redirect_enabled && $post->redirect_url) {
            return redirect($post->redirect_url, $post->redirect_type ?? 301);
        }

        return $next($request);
    }
}