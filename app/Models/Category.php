<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    protected $guarded = [];

    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name', 'description', 'seo_title', 'meta_description', 'keywords']; // EKLENDİ

    protected $fillable = [
        'name',
        'slug',
        'description',
        'seo_title',
        'meta_description',
        'keywords',
        'is_active',
        'show_in_sidebar',
        'show_in_menu',
        'logo_path',
        'banner_path',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
