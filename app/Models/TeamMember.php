<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model
{
    use HasFactory, HasTranslations;

    /**
     * Hangi alanların çok dilli olacağını belirtir.
     *
     * @var array
     */
    public $translatable = [
        'name',
        'position'
    ];

    /**
     * Mass assignment (toplu atama) ile doldurulabilir alanlar.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'position',
        'photo',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'order',
    ];

    /**
     * Belirtilen sütunların veri tiplerini otomatik olarak dönüştürür.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'array',
        'position' => 'array',
    ];
}
