<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('task_lists', function (Blueprint $table) {
            $table->id();

            // Her liste bir board'a bağlı
            $table->foreignId('board_id')
                ->constrained('boards')
                ->cascadeOnDelete();

            // Görünen ad
            $table->string('name', 180);

            // Kolon sırası (0,1,2…)
            $table->unsignedInteger('position')->default(0);

            // Opsiyoneller
            $table->unsignedSmallInteger('wip_limit')->nullable();   // “In Progress” için sınır gibi
            $table->boolean('is_archived')->default(false);          // Kolonu arşivle
            $table->string('color', 24)->nullable();                 // UI etiketi için
            $table->json('settings')->nullable();                    // esnek ayarlar

            $table->timestamps();
            $table->softDeletes();

            // Sık erişilen alanlar için index
            $table->index(['board_id', 'position']);
            // Aynı board içinde aynı pozisyonu engelle (opsiyonel, tutarlılık için iyi)
            $table->unique(['board_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_lists');
    }
};
