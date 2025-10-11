<?php

// app/Http/Controllers/Frontend/ContactController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactSubmitted;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // isteğe bağlı: honeypot
        if ($request->filled('website')) {
            return back()->with('error', 'İşlem reddedildi.'); // bot şüphesi
        }

        // DB kaydı (opsiyonel ama tavsiye)
        $record = ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'ip' => $request->ip(),
            'user_agent' => substr((string)$request->userAgent(), 0, 255),
        ]);

        // Mail hedefi (env veya config üzerinden)
        $to = config('mail.contact_to', env('MAIL_TO_ADDRESS', 'info@tuncay-insaat.com'));

        Mail::to($to)->send(new ContactSubmitted([
            ...$data,
            'ip' => $record->ip,
            'ua' => $record->user_agent,
        ]));

        return back()->with('success', __('Mesajınız alınmıştır. En kısa sürede dönüş yapılacaktır.'));
    }
}
