<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'files' => 'required|array|min:1',
            'files.*' => 'file|max:25600|mimes:jpeg,png,jpg,gif,svg,webp,mp4,avi,mov,wmv,mp3,wav,pdf,doc,docx,xls,xlsx,ppt,pptx',
            'folder' => 'nullable|string|max:255',
            'storage' => 'nullable|string',
            'auto_webp' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'files.required' => 'En az bir dosya seçmelisiniz.',
            'files.*.file' => 'Geçersiz dosya formatı.',
            'files.*.max' => 'Dosya boyutu 25MB\'dan büyük olamaz.',
            'files.*.mimes' => 'Desteklenmeyen dosya formatı.',
        ];
    }
}
