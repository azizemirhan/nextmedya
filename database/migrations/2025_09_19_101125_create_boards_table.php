<?php

// database/migrations/2025_09_19_000001_create_boards_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete(); // pano sahibi
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('visibility')->default('private'); // private|team|public
            $table->unsignedSmallInteger('lists_count')->default(0);
            $table->unsignedInteger('tasks_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['owner_id', 'visibility']);
        });

        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained('boards')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('role')->default('member'); // owner|admin|member|viewer
            $table->timestamps();
            $table->unique(['board_id', 'user_id']);
            $table->index(['user_id', 'role']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('board_members');
        Schema::dropIfExists('boards');
    }
};
