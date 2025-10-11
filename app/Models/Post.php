<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $guarded = [];

    // Çevrilebilir alanları bu diziye ekleyin
    public $translatable = [
        'title', 'content', 'excerpt', 'featured_image_alt_text',
        'seo_title', 'meta_description', 'keywords'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'manual_schema_json' => 'array',
        'generated_schema_json' => 'array',
    ];

    // --- İLİŞKİLER ---

    /**
     * Bu metod, hatayı çözen kısımdır.
     * Bir yazının yazarını (User modelini) döndürür.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        // Bu metod da 'author' ile aynı işi yapar.
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function lastModifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }

    // --- SCOPE'LAR ---
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where('published_at', '<=', now());
    }

    // --- BOOT METODU (SLUG İÇİN) ---
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = $post->slug ?? Str::slug($post->title);
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    // --- HELPER METOTLAR ---
    public function getPublishedDateFormattedAttribute(): string
    {
        return $this->published_at ? $this->published_at->format('d M, Y') : '';
    }


}
