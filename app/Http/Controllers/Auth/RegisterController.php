<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Kayıt formunu gösterir
    public function create()
    {
        return view('auth.register');
    }

    // Kullanıcıyı oluşturur ve veritabanına kaydeder
    public function store(Request $request)
    {
        // 1. Form verisini doğrula
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8', // password_confirmation ile eşleşmeli
        ]);

        // 2. Kullanıcıyı oluştur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Parolayı HASH'leyerek kaydet!
        ]);

        // 3. Kullanıcıyı oluşturduktan sonra otomatik giriş yaptır
        Auth::login($user);

        // 4. Kullanıcıyı ana sayfaya veya istediğin bir yere yönlendir
        return redirect('/');
    }
}
