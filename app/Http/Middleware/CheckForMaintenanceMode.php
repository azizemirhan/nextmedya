<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache; // Cache'i kullan

class CheckForMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ayarları önbellekten oku
        $settings = Cache::get('settings.all', []);
        $maintenanceMode = $settings['maintenance_mode']->value ?? 'off';

        // Bakım modu AÇIKSA ve giriş yapan kullanıcı admin DEĞİLSE
        if ($maintenanceMode === 'on' && !Auth::guard('admin')->check()) {
            // Laravel'in standart bakım modu (503) sayfasını göster
            abort(503);
        }

        return $next($request);
    }
}
