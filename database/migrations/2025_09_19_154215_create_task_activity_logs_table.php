<?php

// database/migrations/2025_09_19_000011_create_task_activity_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action'); // created|updated|moved|commented|attached|status_changed|assigned|unassigned ...
            $table->json('payload')->nullable();  // diff/ek bilgiler
            $table->timestamps();
            $table->index(['task_id','action']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_activity_logs');
    }
};
