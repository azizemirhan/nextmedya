<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'name',
        'company',
        'content',
    ];

    protected $fillable = [
        'name',
        'company',
        'content',
        'image_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',   // ['tr' => '...', 'en' => '...']
        'company' => 'array',
        'content' => 'array',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];
}
