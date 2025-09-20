<?php

// database/migrations/2025_09_19_000008_create_task_checklists_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->string('title')->default('Checklist');
            $table->unsignedSmallInteger('position')->default(0);
            $table->unsignedSmallInteger('items_count')->default(0);
            $table->unsignedSmallInteger('items_done_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['task_id','position']);
        });

        Schema::create('checklist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_id')->constrained('checklists')->cascadeOnDelete();
            $table->string('text');
            $table->boolean('is_done')->default(false);
            $table->unsignedSmallInteger('position')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['checklist_id','position']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('checklist_items');
        Schema::dropIfExists('checklists');
    }
};
