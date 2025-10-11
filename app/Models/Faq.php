<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['question', 'answer', 'order', 'is_active'];
    public $translatable = ['question', 'answer'];
}
