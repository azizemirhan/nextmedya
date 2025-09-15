<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SupportRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SupportRequestController extends Controller
{

    public function store(Request $request)
    {

        try {
            Mail::to('info@nextmedya.com')->send(new \App\Mail\SupportRequestMail($request));
        } catch (\Throwable $e) {
            Log::error('Support mail error: ' . $e->getMessage());
            return back()->withErrors(['mail' => 'Talebiniz alınamadı. Lütfen tekrar deneyin.']);
        }

        // Ana sayfaya yönlendir + flash mesaj
        return redirect()
            ->route('anasayfa') // yoksa ->to('/') kullan
            ->with('success', 'Talebiniz başarıyla iletildi.');
    }
}

 