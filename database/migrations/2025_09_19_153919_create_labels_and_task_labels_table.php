<?php

// database/migrations/2025_09_19_000005_create_labels_and_task_labels_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained('boards')->cascadeOnDelete();
            $table->string('name');
            $table->string('color', 32)->default('#64748b'); // tailwind slate-500 default
            $table->timestamps();
            $table->unique(['board_id','name']);
        });

        Schema::create('task_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('label_id')->constrained('labels')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['task_id','label_id']);
            $table->index('label_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_labels');
        Schema::dropIfExists('labels');
    }
};
