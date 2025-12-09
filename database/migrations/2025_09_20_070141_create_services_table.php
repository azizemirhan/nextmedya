<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Hizmetin ana başlığı
            $table->string('slug')->unique();
            $table->json('summary')->nullable(); // Liste görünümleri için kısa özet
            $table->json('content')->nullable(); // "Service Details" metni
            $table->json('benefits')->nullable(); // "Service Benefits" listesi
            $table->json('expectations_content')->nullable(); // "Highest Expectations" metni
            $table->json('support_items')->nullable(); // "What can we support with?" listesi
            $table->json('faqs')->nullable(); // Akordiyon SSS bölümü

            $table->string('cover_image')->nullable(); // Ana büyük resim (1290x560)
            $table->json('gallery_images')->nullable(); // Diğer küçük galeri resimleri

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
