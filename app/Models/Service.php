<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    // Seeder'ın ve formların bu alanları doldurmasına izin ver
    protected $fillable = [
        'title', 'slug', 'summary', 'content', 'benefits', 'expectations_content',
        'support_items', 'faqs', 'cover_image', 'gallery_images', 'order', 'is_active', 'banner_title', 'banner_subtitle',
    ];

    // Bu alanların çevrilebilir olduğunu belirt
    public $translatable = [
        'title', 'summary', 'content', 'benefits', 'expectations_content',
        'support_items', 'faqs', 'banner_title', 'banner_subtitle',
    ];

    // Bu alanların veritabanında JSON olarak saklandığını ve
    // erişildiğinde otomatik olarak PHP dizisine çevrilmesi gerektiğini belirt
    protected $casts = [
        'benefits' => 'array',
        'support_items' => 'array',
        'faqs' => 'array',
        'gallery_images' => 'array',
        'is_active' => 'boolean',
    ];
}
