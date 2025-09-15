<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user(); // Kullanıcı bilgisi

        // Başarılı giriş sonrası JSON yanıtı döndürme
        return response()->json([
            'message' => 'Login successful',
            'role' => $user->role, // Kullanıcı rolünü döndür
            'redirect_url' => $this->getRedirectUrl($user->role) // Yönlendirme URL'si
        ]);
    }

    private function getRedirectUrl($role)
    {
        if ($role === 'admin') {
            return '/admin/panel';
        } elseif ($role === 'vendor') {
            return '/vendor/panel';
        }

        return '/dashboard'; // Varsayılan yönlendirme
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
