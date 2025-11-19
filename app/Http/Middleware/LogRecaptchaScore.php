<?php

namespace App\Http\Middleware;

use App\Models\RecaptchaLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRecaptchaScore
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Form submit edildiyse ve recaptcha token varsa
        if ($request->isMethod('post') && $request->has('recaptcha-response')) {
            $token = $request->input('recaptcha-response');

            // Manuel doğrulama yap ve skoru logla
            $result = recaptcha_validate($token);

            // Veritabanına kaydet
            try {
                RecaptchaLog::create([
                    'ip_address' => $request->ip(),
                    'score' => $result['score'] ?? 0,
                    'action' => $result['action'] ?? 'unknown',
                    'success' => $result['success'] ?? false,
                    'hostname' => $result['hostname'] ?? '',
                    'form_type' => $this->determineFormType($request),
                    'user_agent' => substr($request->userAgent(), 0, 255),
                    'route_name' => $request->route()?->getName(),
                    'error_codes' => $result['error_codes'] ?? null,
                    'challenge_ts' => isset($result['challenge_ts'])
                        ? \Carbon\Carbon::parse($result['challenge_ts'])
                        : null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to save reCAPTCHA log', [
                    'error' => $e->getMessage(),
                    'ip' => $request->ip(),
                ]);
            }

            // Hala log dosyasına da yaz (backup için)
            \Log::info('reCAPTCHA Score Log', [
                'route' => $request->route()?->getName(),
                'ip' => $request->ip(),
                'score' => $result['score'] ?? 0,
                'action' => $result['action'] ?? 'unknown',
                'success' => $result['success'] ?? false,
                'hostname' => $result['hostname'] ?? '',
                'user_agent' => substr($request->userAgent(), 0, 100),
            ]);

            // Düşük skorları özel olarak logla
            if (($result['score'] ?? 0) < 0.3) {
                \Log::warning('Low reCAPTCHA Score Detected', [
                    'ip' => $request->ip(),
                    'score' => $result['score'],
                    'route' => $request->route()?->getName(),
                ]);
            }
        }

        return $next($request);
    }

    /**
     * Form tipini belirle
     */
    protected function determineFormType(Request $request): string
    {
        $routeName = $request->route()?->getName();

        return match(true) {
            str_contains($routeName, 'contact') => 'contact',
            str_contains($routeName, 'newsletter') => 'newsletter',
            str_contains($routeName, 'comment') => 'comment',
            str_contains($routeName, 'register') => 'register',
            str_contains($routeName, 'login') => 'login',
            default => 'other',
        };
    }
}