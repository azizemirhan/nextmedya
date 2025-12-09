<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title.tr'       => ['required','string','max:200'],
            'title.en'       => ['nullable','string','max:200'],
            'icon'           => ['nullable','string','max:200'],
            'description.tr' => ['nullable','string'],
            'description.en' => ['nullable','string'],
            'order'          => ['required','integer','min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.tr.required' => 'Türkçe başlık zorunludur.',
            'order.required'    => 'Sıralama alanı zorunludur.',
        ];
    }
}
