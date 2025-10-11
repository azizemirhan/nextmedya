<?php

// database/migrations/YYYY_MM_DD_XXXXXX_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // --- Temel İçerik Alanları ---
            $table->json('title'); // Yazının ana başlığı (H1 etiketi için)
            $table->string('slug')->unique(); // SEO dostu URL
            $table->json('content'); // Yazının ana içeriği
            $table->json('excerpt')->nullable(); // Yazı özeti (Meta description için fallback)
            $table->string('featured_image')->nullable(); // Öne çıkan görselin dosya yolu
            $table->json('featured_image_alt_text')->nullable(); // Görsel için Alt metni (SEO için çok önemli)

            // --- Yapısal Alanlar ---
            $table->foreignId('user_id')->comment('Yazar')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->enum('status', ['published', 'draft', 'scheduled', 'pending_review', 'archived'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'password_protected'])->default('public');
            $table->string('password')->nullable(); // Eğer visibility 'password_protected' ise
            $table->timestamp('published_at')->nullable(); // Yayınlanma tarihi
            $table->foreignId('last_modified_by')->nullable()->comment('Son düzenleyen kullanıcı')->constrained('users')->onDelete('set null');

            // --- SEO Alanları ---
            $table->json('seo_title')->nullable(); // Google'da görünecek özel başlık (<title> etiketi için)
            $table->json('meta_description')->nullable(); // Google'da görünecek özel açıklama
            $table->json('keywords')->nullable(); // Anahtar kelimeler (virgülle ayrılmış)
            $table->string('canonical_url')->nullable(); // Yinelenen içerik sorununu önlemek için orijinal URL
            $table->enum('index_status', ['index', 'noindex'])->default('index'); // Arama motoru indexlesin mi?
            $table->enum('follow_status', ['follow', 'nofollow'])->default('follow'); // Sayfadaki linkleri takip etsin mi?

            // --- JSON Schema (Yapısal Veri) Alanları ---
            $table->enum('schema_type', ['auto', 'manual', 'none'])->default('auto'); // Hangi şema kullanılacak?
            $table->json('manual_schema_json')->nullable(); // Manuel olarak girilecek JSON-LD verisi
            $table->json('generated_schema_json')->nullable(); // Sistem tarafından otomatik oluşturulan JSON-LD verisi (önizleme/cache için)

            $table->timestamps(); // created_at ve updated_at

            // Performans için Index'ler
            $table->index('status');
            $table->index('published_at');
            $table->softDeletes(); // Bu satırı ekleyin

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
