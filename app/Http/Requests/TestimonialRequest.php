<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Policy ile kısacaksan burayı düzenle
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('post')
            ? ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:50048']
            : ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:50048'];

        return [
            'name' => ['required', 'array'],
            'name.*' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'array'],
            'company.*' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'array'],
            'content.*' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'image' => $imageRule,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim zorunludur.',
            'content.required' => 'Görüş içeriği zorunludur.',
            'order.required' => 'Sıralama alanı zorunludur.',
            'image.required' => 'Görsel (avatar) zorunludur.',
        ];
    }
}
