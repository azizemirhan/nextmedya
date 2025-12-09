<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterSubscribeRequest;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function store(NewsletterSubscribeRequest $request): RedirectResponse|JsonResponse
    {
        // Honeypot (bot önleme)
        if ($request->filled('website')) {
            return $this->respond($request, false, 'İşlem reddedildi (bot şüphesi).', 422);
        }

        $email = mb_strtolower(trim($request->get('email')));

        try {
            // Eğer zaten varsa güncelle, yoksa yeni oluştur
            $subscriber = NewsletterSubscriber::updateOrCreate(
                ['email' => $email],
                [
                    'status'     => 'confirmed',
                    'token'      => Str::random(64),
                    'ip'         => $request->ip(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 255),
                ]
            );

            Log::info('Yeni abone kaydı yapıldı', ['id' => $subscriber->id, 'email' => $subscriber->email]);

            return $this->respond($request, true, 'Aboneliğiniz aktif edildi. Teşekkürler.');
        } catch (\Throwable $e) {
            Log::error('Abonelik kaydı hatası', ['error' => $e->getMessage()]);
            return $this->respond($request, false, 'Kayıt sırasında hata oluştu.', 500);
        }
    }

    protected function respond($request, bool $ok, string $message, int $status = 200): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['success' => $ok, 'message' => $message], $status);
        }

        return back()->with($ok ? 'success' : 'error', $message);
    }
}
