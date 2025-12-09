<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Policy/guard ile kısıtlayacak isen burada false + policy uygula
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'array', 'max:200'],
            'title*' => ['nullable', 'string', 'max:200'],

            'slug' => ['nullable', 'string', 'max:255'],

            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string'],

            'location' => ['nullable', 'array', 'max:200'],
            'location.*' => ['nullable', 'string', 'max:200'],

            'completion_date' => ['nullable', 'date'],
            'status' => ['required', 'integer', 'in:0,1'], // 0 = Devam, 1 = Tamam
            'is_featured' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.tr.required' => 'Türkçe başlık zorunludur.',
        ];
    }
}
