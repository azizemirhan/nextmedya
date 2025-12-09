<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ReCaptcha\ReCaptcha;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20', // Yeni field
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ];


        // reCAPTCHA aktifse doğrulama ekle
        if (config('recaptcha.enabled')) {
            $rules['g-recaptcha-response'] = ['required'];
        }

        return $rules;
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        // reCAPTCHA kontrolü
        if (config('recaptcha.enabled')) {
            $validator->after(function ($validator) {
                $recaptchaResponse = $this->input('g-recaptcha-response');
                
                if (!$this->verifyRecaptcha($recaptchaResponse)) {
                    $validator->errors()->add(
                        'g-recaptcha-response', 
                        'reCAPTCHA doğrulaması başarısız. Lütfen tekrar deneyin.'
                    );
                }
            });
        }
    }

    /**
     * reCAPTCHA v3 doğrulaması
     */
    protected function verifyRecaptcha($response): bool
    {
        if (empty($response)) {
            return false;
        }

        try {
            $recaptcha = new ReCaptcha(config('recaptcha.secret_key'));
            $verify = $recaptcha->setExpectedHostname(request()->getHost())
                               ->verify($response, request()->ip());

            if ($verify->isSuccess()) {
                $score = $verify->getScore();
                $minimumScore = config('recaptcha.minimum_score', 0.5);
                
                // Log için
                \Log::info('reCAPTCHA verification', [
                    'score' => $score,
                    'minimum' => $minimumScore,
                    'ip' => request()->ip(),
                    'success' => $score >= $minimumScore
                ]);
                
                return $score >= $minimumScore;
            }

            // Hata logla
            \Log::warning('reCAPTCHA verification failed', [
                'errors' => $verify->getErrorCodes(),
                'ip' => request()->ip()
            ]);

            return false;

        } catch (\Exception $e) {
            \Log::error('reCAPTCHA exception: ' . $e->getMessage());
            
            // Hata durumunda yine de geçir (opsiyonel - güvenlik için false yapabilirsiniz)
            return config('app.debug') ? true : false;
        }
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad alanı zorunludur.',
            'name.max' => 'Ad Soyad en fazla 255 karakter olabilir.',
            'email.required' => 'E-posta adresi zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.max' => 'E-posta adresi en fazla 255 karakter olabilir.',
            'subject.max' => 'Konu en fazla 255 karakter olabilir.',
            'message.required' => 'Mesaj alanı zorunludur.',
            'message.max' => 'Mesaj en fazla 5000 karakter olabilir.',
            'g-recaptcha-response.required' => 'Lütfen reCAPTCHA doğrulamasını tamamlayın.',
        ];
    }
}