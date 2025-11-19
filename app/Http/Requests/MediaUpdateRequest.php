<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class MediaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-media') ?? true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'array'],
            'alt' => ['nullable', 'array'],
            'caption' => ['nullable', 'array'],
            'tags' => ['nullable', 'array'],
            'visibility' => ['nullable', 'in:public,private'],
            'status' => ['nullable', 'in:active,archived'],
            'is_favorite' => ['nullable', 'boolean'],
        ];
    }
}
