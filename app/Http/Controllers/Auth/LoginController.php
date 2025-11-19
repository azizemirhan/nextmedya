<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // 1. Form verisini doğrula
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Giriş denemesi yap
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Session'ı güvenlik için yenile

            return redirect()->intended('/'); // Kullanıcıyı gitmek istediği sayfaya veya ana sayfaya yönlendir
        }

        // 3. Giriş başarısız olursa
        return back()->withErrors([
            'email' => 'Girilen bilgilerle eşleşen bir kullanıcı bulunamadı.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
