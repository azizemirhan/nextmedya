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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // string('title') yerine
            $table->json('subtitle'); // text('subtitle') yerine
            $table->json('button_text')->nullable(); // Buton Yazısı (örn: "Projelerimizi İnceleyin")
            $table->string('button_url')->nullable(); // Buton Linki
            $table->string('image_path'); // Bilgisayardan yüklenecek resmin yolu
            $table->integer('order')->default(0); // Slider sırasını belirlemek için
            $table->boolean('is_active')->default(true); // Slider'ı aktif/pasif yapmak için

            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
