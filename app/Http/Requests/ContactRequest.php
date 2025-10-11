<?php

// app/Http/Requests/ContactRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'subject' => ['required', 'string', 'max:190'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            // bal küpü (honeypot) isterseniz:
            'website' => ['nullable', 'size:0'], // formda gizli alan eklerseniz botları kırar
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad zorunludur.',
            'email.email' => 'Geçerli bir e-posta girin.',
            'subject.required' => 'Konu zorunludur.',
            'message.required' => 'Mesaj zorunludur.',
        ];
    }
}
