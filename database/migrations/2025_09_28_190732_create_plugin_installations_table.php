<?php
// database/migrations/2025_01_01_000001_create_plugin_installations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plugin_installations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plugin_id')->constrained()->onDelete('cascade');
            $table->string('version');
            $table->enum('action', ['install', 'update', 'uninstall', 'activate', 'deactivate']);
            $table->enum('status', ['pending', 'processing', 'success', 'failed']);
            $table->text('message')->nullable();
            $table->json('details')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plugin_installations');
    }
};
