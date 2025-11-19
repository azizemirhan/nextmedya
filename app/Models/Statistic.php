<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statistic extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title']; // 3. BU SATIRI EKLEYİN

    protected $fillable = [
        'icon',
        'number',
        'title',
        'order',
    ];

    protected $casts = [
        'title' => 'array',   // ['tr' => '...', 'en' => '...']
        'order' => 'integer',
    ];
}
