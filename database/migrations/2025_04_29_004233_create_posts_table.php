<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->string('meta_title')->nullable(); // SEO başlığı
            $table->string('meta_description')->nullable(); // SEO açıklaması
            $table->string('meta_keywords')->nullable(); // SEO anahtar kelimeleri
            $table->string('featured_image')->nullable(); // Öne çıkan görsel
            $table->timestamp('published_at')->nullable(); // Yayın tarihi
            $table->foreignId('author_id')->constrained('users'); // Yazar bilgisi
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Durum
            $table->json('schema_markup')->nullable(); // Schema Markup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
