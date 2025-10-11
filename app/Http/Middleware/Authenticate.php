<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        // API istekleri veya JSON bekleyenler için redirect yok → 401 döner
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        // Web isteklerinde admin login'e yönlendir
        return route('admin.login'); // yukarıdaki alias'ı da bırakabilirsin
    }
}
