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
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            // project_id, projects tablosundaki id'ye bağlanacak (foreign key)
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('image_path');
            $table->boolean('is_cover')->default(false); // Projenin kapak fotoğrafı mı?
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};
