<?php

// app/Http/Middleware/IsAdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 'admin' guard'ı ile giriş yapılmış mı VE giriş yapan kullanıcı admin mi?
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->is_admin) {
            return $next($request);
        }

        // Değilse, giriş sayfasına yönlendir.
        return redirect()->route('admin.login');
    }
}
