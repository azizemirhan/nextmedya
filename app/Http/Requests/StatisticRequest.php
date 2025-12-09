<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatisticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'icon'        => ['nullable','string','max:255'],
            'number'      => ['required','string','max:50'],
            'title.tr'    => ['required','string','max:200'],
            'title.en'    => ['nullable','string','max:200'],
            'order'       => ['required','integer','min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'number.required'   => 'Sayı alanı zorunludur.',
            'title.tr.required' => 'Türkçe başlık zorunludur.',
            'order.required'    => 'Sıralama alanı zorunludur.',
        ];
    }
}
