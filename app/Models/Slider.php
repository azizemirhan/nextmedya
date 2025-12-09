<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    /**
     * Hangi alanların çok dilli olacağını belirtir.
     *
     * @var array
     */
    public $translatable = ['title', 'subtitle', 'button_text', 'description']; // Burada olmalı

    /**
     * Mass assignment (toplu atama) ile doldurulabilir alanlar.
     * Formdan gelen verilerin doğrudan modele atanabilmesi için gereklidir.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'description', // Burada olmalı
        'button_text',
        'button_url',
        'image_path',
        'order',
        'is_active',
    ];

    /**
     * Belirli sütunların veri tiplerini otomatik olarak dönüştürür.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean', // Veritabanındaki 1/0 değerini true/false olarak kullanmamızı sağlar.
    ];
}
