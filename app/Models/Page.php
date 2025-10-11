<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    // $fillable dizisi, update() metoduyla hangi alanların
    // güncellenebileceğini belirler.
    protected $fillable = [
        'title',
        'slug',
        'status', // EKSİK OLAN ALAN BURAYA EKLENDİ
        'banner_title',     // YENİ EKLENDİ
        'banner_subtitle',  // YENİ EKLENDİ
        'seo_title',
        'meta_description',
        'keywords',
        'index_status',
        'follow_status',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
    ];

    // Hangi alanların çok dilli olduğunu belirtir.
    public $translatable = [
        'title', 'seo_title', 'meta_description', 'keywords', 'og_title', 'og_description', 'banner_title', 'banner_subtitle'
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }
}
