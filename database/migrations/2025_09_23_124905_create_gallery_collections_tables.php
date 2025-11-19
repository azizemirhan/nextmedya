<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('gallery_collections', function (Blueprint $table) {
            $table->id();
            $table->json('name');                                // çok dilli koleksiyon adı
            $table->string('slug')->unique();
            $table->json('description')->nullable();
            $table->foreignId('cover_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('collection_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('gallery_collections')->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
            $table->unique(['collection_id','media_id']);
            $table->index(['collection_id','position']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('collection_media');
        Schema::dropIfExists('gallery_collections');
    }
};
