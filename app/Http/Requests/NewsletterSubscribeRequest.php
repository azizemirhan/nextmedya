<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterSubscribeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:190'],
            'website' => ['nullable', 'size:0'], // honeypot
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-posta zorunludur.',
            'email.email' => 'Geçerli bir e-posta girin.',
        ];
    }
}
