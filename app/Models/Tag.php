<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag'); // post_tag pivot tablosu kullanıldı
    }
}
