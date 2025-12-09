<?php

// app/Http/Controllers/Auth/AdminLoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Birazdan bu view'ı oluşturacağız
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Özel 'admin' guard'ını kullanarak giriş denemesi yapıyoruz
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            // Sadece admin olan kullanıcıların giriş yapmasını sağla
            if (Auth::guard('admin')->user()->is_admin) {
                $request->session()->regenerate();

                // AJAX isteği mi kontrolü
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Giriş başarılı! Yönlendiriliyorsunuz...',
                        'redirect' => route('admin.dashboard')
                    ], 200);
                }

                return redirect()->route('admin.dashboard');
            }

            // Admin değilse, çıkış yaptır
            Auth::guard('admin')->logout();

            // AJAX isteği mi kontrolü
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bu hesap admin yetkisine sahip değil.'
                ], 403);
            }

            return back()->withErrors(['email' => 'Bu hesap admin yetkisine sahip değil.']);
        }

        // Giriş başarısız
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'E-posta veya şifre hatalı.'
            ], 401);
        }

        return back()->withErrors(['email' => 'Yetkisiz giriş denemesi veya hatalı bilgiler.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
