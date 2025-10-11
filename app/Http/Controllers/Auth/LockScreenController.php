<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function showLockScreen()
    {
        if (!session('locked')) {
            return redirect('/admin/dashboard');
        }
        return view('auth.lock-screen');
    }

    // app/Http/Controllers/Auth/LockScreenController.php
    public function unlock(Request $request) {
        $request->validate(['password' => 'required']);
        // auth() -> auth('admin') olarak güncellendi
        if (Hash::check($request->password, auth('admin')->user()->password)) {
            session()->forget('locked');
            return redirect('/admin/dashboard');
        }
        return back()->withErrors(['password' => 'Girilen şifre yanlış.']);
    }
}
