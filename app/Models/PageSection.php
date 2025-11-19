<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // EKLE

class PageSection extends Model
{
    use HasFactory, HasTranslations; // HasTranslations EKLE

    protected $fillable = [
        'page_id',
        'section_key',
        'content',
        'order',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    // EKLE: Çevrilebilir alanlar (content içindeki JSON verileri için)
    public $translatable = [];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Helper metod: Content içindeki çok dilli değerleri almak için
     */
    public function getTranslation(string $key, string $locale, array $content = null, $default = '')
    {
        $content = $content ?? $this->content;
        return data_get($content, "$key.$locale", $default);
    }

    /**
     * Helper metod: Repeater içindeki çok dilli değerleri almak için
     */
    public function getRepeaterTranslation(string $repeaterKey, int $index, string $fieldKey, string $locale, array $content = null, $default = '')
    {
        $content = $content ?? $this->content;
        return data_get($content, "$repeaterKey.$index.$fieldKey.$locale", $default);
    }
}