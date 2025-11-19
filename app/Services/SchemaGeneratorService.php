<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Page;
use Illuminate\Support\Arr;

class SchemaGeneratorService
{
    /**
     * Post veya Page için dinamik schema oluşturur
     *
     * @param Post|Page $model
     * @param string $locale
     * @return array|null
     */
    public function generate($model, string $locale = 'tr'): ?array
    {
        $schemaType = $model->schema_article_type ?? ($model instanceof Post ? 'BlogPosting' : 'WebPage');

        return match($schemaType) {
            'Article', 'BlogPosting', 'NewsArticle' => $this->generateArticleSchema($model, $locale, $schemaType),
            'WebPage' => $this->generateWebPageSchema($model, $locale),
            'Product' => $this->generateProductSchema($model, $locale),
            'Service' => $this->generateServiceSchema($model, $locale),
            'FAQPage' => $this->generateFAQSchema($model, $locale),
            'HowTo' => $this->generateHowToSchema($model, $locale),
            'LocalBusiness' => $this->generateLocalBusinessSchema($model, $locale),
            'Person' => $this->generatePersonSchema($model, $locale),
            default => null
        };
    }

    /**
     * Article/BlogPosting/NewsArticle Schema
     */
    private function generateArticleSchema($model, string $locale, string $type): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => $type,
            'headline' => $model->getTranslation('title', $locale),
            'description' => $model->getTranslation('excerpt', $locale) ?: $model->getTranslation('meta_description', $locale),
            'datePublished' => $model->published_at?->toIso8601String(),
            'dateModified' => $model->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $model->author->name ?? 'Unknown',
                'url' => 'https://www.linkedin.com/in/aziz-emirhan-%C3%B6zdemir-91b694265/'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png')
                ]
            ]
        ];

        // Öne çıkan görsel
        if ($model->featured_image) {
            $schema['image'] = [
                '@type' => 'ImageObject',
                'url' => asset($model->featured_image),
                'width' => 1200,
                'height' => 630
            ];
        }

        // Makale içeriği (ilk 500 karakter) - sadece Post için
        if (isset($model->content)) {
            $content = strip_tags($model->getTranslation('content', $locale));
            $schema['articleBody'] = mb_substr($content, 0, 500) . '...';
            // Kelime sayısı
            $schema['wordCount'] = str_word_count($content);
        }

        // Kategori - sadece Post için
        if (isset($model->category) && $model->category) {
            $schema['articleSection'] = $model->category->getTranslation('name', $locale);
        }

        // Anahtar kelimeler
        $focusKeyword = $model->getTranslation('focus_keyword', $locale);
        if ($focusKeyword) {
            $schema['keywords'] = $focusKeyword;
        }

        return $schema;
    }

    /**
     * WebPage Schema (Pages için)
     */
    private function generateWebPageSchema($model, string $locale): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $model->getTranslation('title', $locale),
            'description' => $model->getTranslation('meta_description', $locale),
            'url' => route('frontend.page.show', $model->slug),
            'dateModified' => $model->updated_at->toIso8601String(),
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png')
                ]
            ]
        ];

        // Anahtar kelimeler
        $focusKeyword = $model->getTranslation('focus_keyword', $locale);
        if ($focusKeyword) {
            $schema['keywords'] = $focusKeyword;
        }

        return $schema;
    }

    /**
     * Product Schema
     */
    private function generateProductSchema($model, string $locale): array
    {
        $description = isset($model->excerpt)
            ? $model->getTranslation('excerpt', $locale)
            : $model->getTranslation('meta_description', $locale);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $model->getTranslation('title', $locale),
            'description' => $description,
        ];

        // Görsel
        if (isset($model->featured_image) && $model->featured_image) {
            $schema['image'] = asset($model->featured_image);
        }

        // URL
        $url = $model instanceof Post
            ? route('blog.show', $model->slug)
            : route('frontend.page.show', $model->slug);

        // Fiyat bilgisi
        if ($model->schema_product_price) {
            $schema['offers'] = [
                '@type' => 'Offer',
                'price' => $model->schema_product_price,
                'priceCurrency' => $model->schema_product_currency ?? 'TRY',
                'availability' => 'https://schema.org/' . ($model->schema_product_availability ?? 'InStock'),
                'url' => $url
            ];
        }

        // Değerlendirme
        if ($model->schema_product_rating) {
            $schema['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => $model->schema_product_rating,
                'reviewCount' => $model->schema_product_review_count ?? 0,
                'bestRating' => 5,
                'worstRating' => 1
            ];
        }

        return $schema;
    }

    /**
     * Service Schema
     */
    private function generateServiceSchema($model, string $locale): array
    {
        $description = isset($model->excerpt)
            ? $model->getTranslation('excerpt', $locale)
            : $model->getTranslation('meta_description', $locale);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $model->getTranslation('title', $locale),
            'description' => $description,
            'provider' => [
                '@type' => 'Organization',
                'name' => $model->getTranslation('schema_service_provider', $locale) ?? config('app.name')
            ]
        ];

        // Hizmet alanı
        $serviceArea = $model->getTranslation('schema_service_area', $locale);
        if ($serviceArea) {
            $schema['areaServed'] = [
                '@type' => 'Place',
                'name' => $serviceArea
            ];
        }

        // Görsel
        if (isset($model->featured_image) && $model->featured_image) {
            $schema['image'] = asset($model->featured_image);
        }

        return $schema;
    }

    /**
     * FAQPage Schema
     */
    private function generateFAQSchema($model, string $locale): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => []
        ];

        // FAQ items (JSON array olarak saklanıyor)
        $faqItems = $model->schema_faq_items;

        if (is_string($faqItems)) {
            $faqItems = json_decode($faqItems, true);
        }

        if (!empty($faqItems) && is_array($faqItems)) {
            foreach ($faqItems as $item) {
                if (!empty($item['question']) && !empty($item['answer'])) {
                    $schema['mainEntity'][] = [
                        '@type' => 'Question',
                        'name' => $item['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $item['answer']
                        ]
                    ];
                }
            }
        }

        return $schema;
    }

    /**
     * HowTo Schema
     */
    private function generateHowToSchema($model, string $locale): array
    {
        $content = isset($model->content) ? $model->getTranslation('content', $locale) : '';

        // İçerikten adımları çıkarmaya çalış (numbered list)
        preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $content, $matches);

        $steps = [];
        foreach ($matches[1] ?? [] as $index => $step) {
            $steps[] = [
                '@type' => 'HowToStep',
                'position' => $index + 1,
                'name' => 'Adım ' . ($index + 1),
                'text' => strip_tags($step)
            ];
        }

        $description = isset($model->excerpt)
            ? $model->getTranslation('excerpt', $locale)
            : $model->getTranslation('meta_description', $locale);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'HowTo',
            'name' => $model->getTranslation('title', $locale),
            'description' => $description,
            'step' => $steps,
            'totalTime' => 'PT10M' // Default 10 dakika (özelleştirilebilir)
        ];
    }

    /**
     * LocalBusiness Schema
     */
    private function generateLocalBusinessSchema($model, string $locale): array
    {
        $description = isset($model->excerpt)
            ? $model->getTranslation('excerpt', $locale)
            : $model->getTranslation('meta_description', $locale);

        $url = $model instanceof Post
            ? route('blog.show', $model->slug)
            : route('frontend.page.show', $model->slug);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $model->getTranslation('title', $locale),
            'description' => $description,
            'image' => (isset($model->featured_image) && $model->featured_image) ? asset($model->featured_image) : null,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $model->getTranslation('schema_service_area', $locale) ?? 'İstanbul',
                'addressCountry' => 'TR'
            ],
            'url' => $url
        ];
    }

    /**
     * Person Schema
     */
    private function generatePersonSchema($model, string $locale): array
    {
        $description = isset($model->excerpt)
            ? $model->getTranslation('excerpt', $locale)
            : $model->getTranslation('meta_description', $locale);

        $url = $model instanceof Post
            ? route('blog.show', $model->slug)
            : route('frontend.page.show', $model->slug);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $model->getTranslation('title', $locale),
            'description' => $description,
            'image' => (isset($model->featured_image) && $model->featured_image) ? asset($model->featured_image) : null,
            'url' => $url
        ];
    }

    /**
     * Schema JSON-LD'yi HTML <script> tag olarak döndürür
     */
    public function toScriptTag(array $schema): string
    {
        $json = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return '<script type="application/ld+json">' . PHP_EOL . $json . PHP_EOL . '</script>';
    }
}