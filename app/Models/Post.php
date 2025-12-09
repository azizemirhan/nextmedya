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

    public $translatable = [
        'title',
        'content',
        'excerpt',
        'summary',
        'featured_image_alt_text',
        'seo_title',
        'meta_description',
        'keywords',
        'focus_keyword', // YENİ
        'og_title', // YENİ
        'og_description', // YENİ
        'twitter_title', // YENİ
        'twitter_description', // YENİ
        'schema_service_area', // YENİ
        'schema_service_provider' // YENİ
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'manual_schema_json' => 'array',
        'generated_schema_json' => 'array',
        'seo_analysis_results' => 'array', // YENİ
        'schema_faq_items' => 'array', // YENİ
        'seo_last_analyzed_at' => 'datetime', // YENİ
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'featured_image_alt_text',
        'user_id',
        'category_id',
        'status',
        'visibility',
        'password',
        'published_at',
        'last_modified_by',
        'seo_title',
        'meta_description',
        'keywords',
        'canonical_url',
        'index_status',
        'follow_status',
        'schema_type',
        'manual_schema_json',
        'generated_schema_json',
        'focus_keyword', // YENİ

        // Open Graph
        'og_title',
        'og_description',
        'og_image',

        // Twitter Card
        'twitter_card_type',
        'twitter_title',
        'twitter_description',
        'twitter_image',

        // Meta Robots
        'meta_noindex',
        'meta_nofollow',
        'meta_noarchive',
        'meta_nosnippet',
        'meta_max_snippet',
        'meta_max_image_preview',

        // Schema.org
        'schema_article_type',
        'schema_faq_items',
        'schema_product_price',
        'schema_product_currency',
        'schema_product_availability',
        'schema_product_rating',
        'schema_product_review_count',
        'schema_service_area',
        'schema_service_provider',

        // Redirect
        'redirect_url',
        'redirect_enabled',
        'redirect_type',

        // SEO Analysis
        'seo_score',
        'seo_analysis_results',
        'seo_last_analyzed_at',
    ];

    // İlişkiler
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

    // Scope'lar
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'published');
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    // Helper
    public function getPublishedDateFormattedAttribute(): string
    {
        return $this->published_at ? $this->published_at->format('d M, Y') : '';
    }
}