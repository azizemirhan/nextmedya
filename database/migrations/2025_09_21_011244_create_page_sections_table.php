<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_page_sections_table.php
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->string('section_key'); // 'about-section', 'blog-list' gibi benzersiz bir anahtar
            $table->json('content')->nullable(); // Title, buton text gibi içerikler burada saklanacak
            $table->integer('order')->default(0); // Section'ların sayfadaki sırası
            $table->boolean('is_active')->default(true); // BU SATIRI EKLEYİN
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
