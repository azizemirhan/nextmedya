<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('media_folders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->foreignId('parent_id')->nullable()->constrained('media_folders')->nullOnDelete();
            $table->string('path')->unique();                    // “uploads/banners”
            $table->enum('visibility', ['public','private'])->default('public');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('media_folders');
    }
};
