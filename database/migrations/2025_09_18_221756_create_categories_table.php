<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('keywords')->nullable(); // TEXT yerine text() kullanılmalı
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // --- SEO Alanları ---
            $table->string('seo_title')->nullable();
            $table->text('meta_description')->nullable();

            // Yeni Durum Alanları (after() olmadan)
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_sidebar')->default(true);
            $table->boolean('show_in_menu')->default(false);

            // Resim Alanları (nullable) (after() olmadan)
            $table->string('logo_path')->nullable();
            $table->string('banner_path')->nullable();

            $table->timestamps();

            // Soft Deletes için (after() olmadan, genellikle timestamp'lerden önce)
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
