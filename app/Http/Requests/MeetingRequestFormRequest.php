<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ReCaptcha\ReCaptcha;

class MeetingRequestFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            // Step 1: Kişisel Bilgiler
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'company' => ['nullable', 'string', 'max:255'],
            
            // Step 2: Toplantı Tarihi
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'preferred_time' => ['required', 'string', 'in:morning,afternoon,evening'],
            'preferred_time_slot' => ['nullable', 'string', 'max:50'],
            'alternative_date' => ['nullable', 'date', 'after_or_equal:today'],
            'alternative_time' => ['nullable', 'string', 'in:morning,afternoon,evening'],
            
            // Step 3: Toplantı Detayları
            'contact_methods' => ['required', 'array', 'min:1'],
            'contact_methods.*' => ['string', 'in:phone,video,email,whatsapp'],
            'meeting_type' => ['required', 'string', 'in:online,office,client_office'],
            'meeting_platform' => ['nullable', 'string', 'in:zoom,teams,google_meet,skype'],
            'topic' => ['required', 'string', 'in:new_project,consultation,quotation,support,partnership,other'],
            'message' => ['nullable', 'string', 'max:1000'],
            
            // Honeypot
            'website' => ['nullable', 'string'],
        ];

        // reCAPTCHA
        if (config('recaptcha.enabled')) {
            $rules['g-recaptcha-response'] = ['required'];
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        if (config('recaptcha.enabled')) {
            $validator->after(function ($validator) {
                if (!$this->verifyRecaptcha($this->input('g-recaptcha-response'))) {
                    $validator->errors()->add('g-recaptcha-response', 'reCAPTCHA doğrulaması başarısız.');
                }
            });
        }
    }

    protected function verifyRecaptcha($response): bool
    {
        if (empty($response)) {
            return false;
        }

        try {
            $recaptcha = new ReCaptcha(config('recaptcha.secret_key'));
            $verify = $recaptcha->verify($response, request()->ip());

            if ($verify->isSuccess()) {
                $score = $verify->getScore();
                
                \Log::info('MeetingRequest reCAPTCHA', [
                    'score' => $score,
                    'success' => $score >= config('recaptcha.minimum_score', 0.5)
                ]);
                
                return $score >= config('recaptcha.minimum_score', 0.5);
            }

            \Log::warning('MeetingRequest reCAPTCHA failed', [
                'errors' => $verify->getErrorCodes()
            ]);

            return false;
        } catch (\Exception $e) {
            \Log::error('MeetingRequest reCAPTCHA exception: ' . $e->getMessage());
            return config('app.debug') ? true : false;
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad alanı zorunludur.',
            'email.required' => 'E-posta adresi zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'phone.required' => 'Telefon numarası zorunludur.',
            'preferred_date.required' => 'Lütfen bir tarih seçin.',
            'preferred_date.after_or_equal' => 'Geçmiş bir tarih seçilemez.',
            'preferred_time.required' => 'Lütfen bir zaman dilimi seçin.',
            'contact_methods.required' => 'En az bir iletişim yöntemi seçmelisiniz.',
            'meeting_type.required' => 'Lütfen toplantı türünü seçin.',
            'topic.required' => 'Lütfen toplantı konusunu seçin.',
            'g-recaptcha-response.required' => 'Lütfen robot olmadığınızı doğrulayın.',
        ];
    }
}