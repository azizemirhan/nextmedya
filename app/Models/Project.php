<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Project extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = [
        'title',
        'description',
        'location',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'completion_date',
        'status',
        'is_featured',
        'image_path',
        'order',
    ];


    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'location' => 'array',
        'is_featured' => 'boolean',
        'completion_date' => 'date',
    ];
}
