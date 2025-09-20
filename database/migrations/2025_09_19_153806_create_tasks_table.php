<?php

// database/migrations/2025_09_19_000003_create_tasks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // DOĞRU: task_lists'a bağla
            $table->foreignId('list_id')
                ->constrained('task_lists')
                ->cascadeOnDelete();

            $table->foreignId('board_id')
                ->constrained('boards')
                ->cascadeOnDelete();

            $table->string('title', 255);
            $table->text('description')->nullable();

            // Sıralama ve durumlar
            $table->unsignedInteger('position')->default(0);
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->enum('status', ['open', 'in_progress', 'done', 'archived'])->default('open');

            // Zamanlar
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            // Sayaçlar
            $table->unsignedInteger('comments_count')->default(0);
            $table->unsignedInteger('attachments_count')->default(0);
            $table->unsignedInteger('check_items_count')->default(0);
            $table->unsignedInteger('check_items_done_count')->default(0);

            // Esnek alan
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['board_id', 'list_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
