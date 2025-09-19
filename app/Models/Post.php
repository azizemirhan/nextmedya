<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Factory ile create() metodunu kullanırken toplu atama (mass assignment)
     * hatası almamak için bu satırı eklemek önemlidir.
     */
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'manual_schema_json' => 'array', // <-- YENİ
        'generated_schema_json' => 'array', // <-- YENİ
    ];

    /**
     * Yazının yazarını getiren ilişki (bir yazı bir kullanıcıya aittir).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Yazının kategorisini getiren ilişki (bir yazı bir kategoriye aittir).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * YAZIYA AİT ETİKETLERİ GETİREN İLİŞKİ (ÇOKTAN-ÇOĞA)
     * EKSİK OLAN VE HATAYA NEDEN OLAN METOT BUDUR.
     */
    public function tags()
    {
        // Bir yazının birden çok etiketi olabilir.
        return $this->belongsToMany(Tag::class);
    }
}
