<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Proje Adı
            $table->string('slug')->unique(); // SEO dostu URL için
            $table->json('description'); // Proje açıklaması
            $table->json('location')->nullable(); // Proje konumu (örn: "Bornova, İzmir")
            $table->date('completion_date')->nullable(); // Tamamlanma tarihi
            $table->string('image_path');
            $table->tinyInteger('status')->default(1); // 0 = Devam Ediyor, 1 = Tamamlandı
            $table->boolean('is_featured')->default(false); // Ana sayfada gösterilsin mi?

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
