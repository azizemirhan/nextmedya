<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ReCaptcha\ReCaptcha;

class ServiceRequestFormRequest extends FormRequest
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
            
            // Step 2: Hizmet Seçimi
            'service_type' => ['required', 'string', 'in:web_design,mobile_app,seo,e_commerce,cms,api_integration,custom_software'],
            'package_type' => ['nullable', 'string', 'in:basic,professional,premium,enterprise'],
            'package_price' => ['nullable', 'numeric', 'min:0'],
            
            // Step 3: Detaylar
            'selected_features' => ['nullable', 'array'],
            'selected_features.*' => ['string'],
            'project_details' => ['nullable', 'string', 'max:2000'],
            'budget_range' => ['nullable', 'string', 'max:100'],
            'timeline' => ['nullable', 'string', 'max:100'],
            
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
                
                \Log::info('ServiceRequest reCAPTCHA', [
                    'score' => $score,
                    'success' => $score >= config('recaptcha.minimum_score', 0.5)
                ]);
                
                return $score >= config('recaptcha.minimum_score', 0.5);
            }

            \Log::warning('ServiceRequest reCAPTCHA failed', [
                'errors' => $verify->getErrorCodes()
            ]);

            return false;
        } catch (\Exception $e) {
            \Log::error('ServiceRequest reCAPTCHA exception: ' . $e->getMessage());
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
            'service_type.required' => 'Lütfen bir hizmet türü seçin.',
            'service_type.in' => 'Geçersiz hizmet türü.',
            'package_type.in' => 'Geçersiz paket türü.',
            'g-recaptcha-response.required' => 'Lütfen robot olmadığınızı doğrulayın.',
        ];
    }
}