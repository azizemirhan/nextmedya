<?php
// database/migrations/2025_01_01_000000_create_plugins_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('version');
            $table->string('author')->nullable();
            $table->string('author_uri')->nullable();
            $table->text('description')->nullable();
            $table->string('license')->nullable();
            $table->string('plugin_uri')->nullable();
            $table->string('repository_url')->nullable();
            $table->string('download_url')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_installed')->default(false);
            $table->json('requirements')->nullable();
            $table->json('dependencies')->nullable();
            $table->json('settings')->nullable();
            $table->json('permissions')->nullable();
            $table->string('main_file')->nullable();
            $table->string('namespace')->nullable();
            $table->string('provider_class')->nullable();
            $table->enum('status', ['active', 'inactive', 'error', 'updating'])->default('inactive');
            $table->timestamp('last_check')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plugins');
    }
};
