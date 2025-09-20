<?php

// database/migrations/2025_09_19_000006_create_task_comments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('body');
            $table->json('mentions')->nullable(); // @mentions user id list
            $table->timestamps();
            $table->softDeletes();

            $table->index('task_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_comments');
    }
};
