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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Müşteri Adı (örn: "Mehmet Öztürk")
            $table->json('company'); // Müşteri Ünvanı (örn: "Tuncay Life Sakini")
            $table->json('content'); // Yorum metni
            $table->string('image_path')->nullable(); // Müşteri fotoğrafı (isteğe bağlı)
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
