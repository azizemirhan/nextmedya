<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'banner_title',
        'banner_subtitle',
        'seo_title',
        'meta_description',
        'keywords',
        'canonical_url',
        'index_status',
        'follow_status',
        'schema_type',
        'manual_schema_json',
        'generated_schema_json',
        'focus_keyword',

        'excerpt',

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

    // Çok dilli alanlar
    // Çok dilli alanlar
    public $translatable = [
        'title',
        'excerpt',              // BU SATIRI EKLEYİN
        'seo_title',
        'meta_description',
        'keywords',
        'focus_keyword',
        'og_title',
        'og_description',
        'twitter_title',
        'twitter_description',
        'schema_service_area',
        'schema_service_provider',
        'banner_title',
        'banner_subtitle'
    ];

    protected $casts = [
        'manual_schema_json' => 'array',
        'generated_schema_json' => 'array',
        'seo_analysis_results' => 'array',
        'schema_faq_items' => 'array',
        'seo_last_analyzed_at' => 'datetime',
        'redirect_enabled' => 'boolean',
        'meta_noindex' => 'boolean',
        'meta_nofollow' => 'boolean',
        'meta_noarchive' => 'boolean',
        'meta_nosnippet' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    /**
     * Scope: Yayında olan sayfalar
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Taslak sayfalar
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}