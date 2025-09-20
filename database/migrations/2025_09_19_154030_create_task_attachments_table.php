<?php

// database/migrations/2025_09_19_000007_create_task_attachments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('path');               // storage yolu
            $table->string('original_name');      // orijinal dosya adı
            $table->unsignedInteger('size')->default(0); // KB
            $table->string('mime', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('task_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_attachments');
    }
};
