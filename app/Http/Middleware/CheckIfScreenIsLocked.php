<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfScreenIsLocked
{
    public function handle(Request $request, Closure $next)
    {
        if (session('locked') && !$request->routeIs('lock-screen') && !$request->routeIs('unlock')) {
            return redirect()->route('lock-screen');
        }
        return $next($request);
    }
}
