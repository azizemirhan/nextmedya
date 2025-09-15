<?php

// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'published_at',
        'status',
        'author_id',
        'schema_markup'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'schema_markup' => 'array',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public static function boot()
    {
        parent::boot();

        // Slug oluşturulması
        static::creating(function ($post) {
            if (!$post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->meta_description ?? \Str::limit(strip_tags($this->content), 150);
    }

    // Schema Markup
    public function getSchemaMarkupAttribute()
    {
        $rawSchema = $this->attributes['schema_markup'] ?? null;

        if ($rawSchema) {
            // Veritabanındaki JSON verisini döndür
            return json_encode($rawSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }

        // Varsayılan JSON-LD şeması
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $this->title,
            'description' => $this->meta_description ?? Str::limit(strip_tags($this->content), 160),
            'author' => [
                '@type' => 'Person',
                'name' => optional($this->author)->name,
            ],
            'datePublished' => optional($this->published_at)->toIso8601String(),
            'image' => $this->featured_image ? asset($this->featured_image) : null,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url('/blog/' . $this->slug),
            ]
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }


    public function getBreadcrumbSchemaAttribute(): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Anasayfa',
                    'item' => url('/')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Bloglar',
                    'item' => url('/bloglar')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $this->title,
                    'item' => url('/blog/' . $this->slug)
                ]
            ]
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }


    public function generateSchemaMarkup()
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $this->meta_title ?: $this->title,
            "description" => $this->meta_description ?: Str::limit(strip_tags($this->content), 160),
            "image" => $this->featured_image ? asset($this->featured_image) : null,
            "author" => [
                "@type" => "Person",
                "name" => $this->author ? $this->author->name : 'Admin',
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => config('app.name'),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('logo.png'), // kendi logo dosyanı koy
                ],
            ],
            "datePublished" => $this->published_at ? $this->published_at->toW3cString() : now()->toW3cString(),
            "dateModified" => $this->updated_at->toW3cString(),
        ];
    }
}
