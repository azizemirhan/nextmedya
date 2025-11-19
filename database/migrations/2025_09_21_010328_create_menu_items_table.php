<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();

            $table->foreignId('parent_id')->nullable()
                ->constrained('menu_items')->cascadeOnDelete();

            // ✅ ÖNCE BÖYLEYDİ (hata verdirir):
            // $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();

            // ✅ BÖYLE YAP: Şimdilik kolon, FK'sız
            $table->foreignId('page_id')->nullable();

            $table->string('title'); // (JSON kullanıyorsan json('title') yap)
            $table->string('url')->nullable();

            $table->string('target')->default('_self');
            $table->string('classes')->nullable();
            $table->string('rel')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_mega_menu')->default(false);
            $table->string('icon', 100)->nullable();
            $table->json('description')->nullable();
            $table->tinyInteger('column_width')->default(1);
            $table->timestamps();

            $table->index(['menu_id','parent_id','order']);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
