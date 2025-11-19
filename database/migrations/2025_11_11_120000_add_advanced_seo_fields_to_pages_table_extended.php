<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Odak Anahtar Kelime (Focus Keyword)
            $table->json('focus_keyword')->nullable()->after('keywords');

            // Twitter Card Alanları (og_image'dan sonra)
            $table->enum('twitter_card_type', ['summary', 'summary_large_image'])->default('summary_large_image')->after('og_image');
            $table->json('twitter_title')->nullable()->after('twitter_card_type');
            $table->json('twitter_description')->nullable()->after('twitter_title');
            $table->string('twitter_image')->nullable()->after('twitter_description');

            // Gelişmiş Meta Robots
            $table->boolean('meta_noindex')->default(false)->after('index_status');
            $table->boolean('meta_nofollow')->default(false)->after('meta_noindex');
            $table->boolean('meta_noarchive')->default(false)->after('meta_nofollow');
            $table->boolean('meta_nosnippet')->default(false)->after('meta_noarchive');
            $table->integer('meta_max_snippet')->nullable()->after('meta_nosnippet');
            $table->enum('meta_max_image_preview', ['none', 'standard', 'large'])->default('large')->after('meta_max_snippet');

            // Schema.org Yapılandırılmış Veri
            $table->string('schema_type')->nullable()->after('meta_max_image_preview');
            $table->enum('schema_article_type', ['Article', 'BlogPosting', 'NewsArticle', 'Product', 'Service', 'FAQPage', 'HowTo', 'LocalBusiness', 'Person'])->default('Article')->after('schema_type');

            // FAQ Schema için (JSON array)
            $table->json('schema_faq_items')->nullable()->after('schema_article_type');

            // Product Schema için
            $table->decimal('schema_product_price', 10, 2)->nullable()->after('schema_faq_items');
            $table->string('schema_product_currency', 3)->nullable()->after('schema_product_price');
            $table->enum('schema_product_availability', ['InStock', 'OutOfStock', 'PreOrder', 'Discontinued'])->nullable()->after('schema_product_currency');
            $table->decimal('schema_product_rating', 3, 2)->nullable()->after('schema_product_availability');
            $table->integer('schema_product_review_count')->nullable()->after('schema_product_rating');

            // Service Schema için
            $table->json('schema_service_area')->nullable()->after('schema_product_review_count');
            $table->json('schema_service_provider')->nullable()->after('schema_service_area');

            // Manual ve Generated Schema JSON
            $table->json('manual_schema_json')->nullable()->after('schema_service_provider');
            $table->json('generated_schema_json')->nullable()->after('manual_schema_json');

            // 301 Redirect Sistemi
            $table->string('redirect_url')->nullable()->after('slug');
            $table->boolean('redirect_enabled')->default(false)->after('redirect_url');
            $table->integer('redirect_type')->default(301)->after('redirect_enabled'); // 301, 302, 307, 308

            // SEO Skorları (Cache için)
            $table->integer('seo_score')->default(0)->after('redirect_type');
            $table->json('seo_analysis_results')->nullable()->after('seo_score');
            $table->timestamp('seo_last_analyzed_at')->nullable()->after('seo_analysis_results');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'focus_keyword',
                'twitter_card_type',
                'twitter_title',
                'twitter_description',
                'twitter_image',
                'meta_noindex',
                'meta_nofollow',
                'meta_noarchive',
                'meta_nosnippet',
                'meta_max_snippet',
                'meta_max_image_preview',
                'schema_type',
                'schema_article_type',
                'schema_faq_items',
                'schema_product_price',
                'schema_product_currency',
                'schema_product_availability',
                'schema_product_rating',
                'schema_product_review_count',
                'schema_service_area',
                'schema_service_provider',
                'manual_schema_json',
                'generated_schema_json',
                'redirect_url',
                'redirect_enabled',
                'redirect_type',
                'seo_score',
                'seo_analysis_results',
                'seo_last_analyzed_at',
            ]);
        });
    }
};
