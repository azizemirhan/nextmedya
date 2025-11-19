<?php

// app/Http/Controllers/Frontend/ContactController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactSubmitted;
use Illuminate\Support\Str;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

// GtmHelper'ı include et
require_once app_path('Helpers/GtmHelper.php');

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // honeypot kontrol
        if ($request->filled('website')) {
            return back()->with('error', 'İşlem reddedildi.');
        }

        // DB kaydı
        $record = ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'ip' => $request->ip(),
            'user_agent' => substr((string)$request->userAgent(), 0, 255),
        ]);

        // Mail gönderimi
        $to = config('mail.contact_to', env('MAIL_TO_ADDRESS', 'info@nextmedya.com'));
        try {
            Mail::to($to)->send(new ContactSubmitted([
                ...$data,
                'ip' => $record->ip,
                'ua' => $record->user_agent,
            ]));
        } catch (\Exception $e) {
            \Log::error('Contact form mail error: ' . $e->getMessage());
        }

        $eventId = Str::uuid()->toString();
        
        // User Data için Hash'lenmiş veriler oluştur
        $userData = $this->prepareUserData($data, $request);
        
        return redirect()->back()
            ->with('success', 'Teşekkürler, mesajınız başarıyla gönderildi!')
            ->withCookies([
                cookie('gtm_event_id', $eventId, 2),
                cookie('gtm_tracking', 'submitted', 2),
                cookie('gtm_value', '50', 2),
                cookie('gtm_currency', 'TRY', 2),
                cookie('gtm_form_type', 'Contact Us', 2),
                cookie('gtm_user_data', json_encode($userData), 2), // Yeni!
            ]);
    }

    /**
     * Meta CAPI için user data hazırla
     */
    private function prepareUserData(array $data, $request): array
    {
        $userData = [];

        // Email (zorunlu - form validation'da var)
        if (!empty($data['email'])) {
            $userData['em'] = gtm_hash($data['email']);
        }

        // Telefon (eğer form field'ı varsa)
        if (!empty($data['phone'])) {
            // Sadece rakamları al
            $phone = preg_replace('/[^0-9]/', '', $data['phone']);
            $userData['ph'] = gtm_hash($phone);
        }

        // İsim ayrıştırma
        if (!empty($data['name'])) {
            $nameParts = explode(' ', trim($data['name']), 2);
            $userData['fn'] = gtm_hash($nameParts[0]); // İlk isim
            
            if (isset($nameParts[1])) {
                $userData['ln'] = gtm_hash($nameParts[1]); // Soyisim
            }
        }

        // IP adresi (opsiyonel)
        $userData['client_ip_address'] = $request->ip();
        
        // User Agent (opsiyonel)
        $userData['client_user_agent'] = $request->userAgent();

        return $userData;
    }
}