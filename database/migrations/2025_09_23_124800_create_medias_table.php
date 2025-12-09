<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            // Primary fields
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('filename')->index();
            $table->string('path')->index();
            $table->string('disk')->default('public')->index();

            // Storage and folder relations
            $table->unsignedBigInteger('storage_profile_id')->nullable()->index();
            $table->unsignedBigInteger('folder_id')->nullable()->index();
            $table->string('folder_path')->nullable()->index();

            // File metadata
            $table->string('extension', 12)->index();
            $table->string('mime', 128)->index();
            $table->enum('type', ['image', 'video', 'audio', 'document', 'other'])->default('other')->index();
            $table->unsignedBigInteger('size_bytes')->default(0)->index();

            // Dimensions and media properties
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('duration_ms')->nullable();
            $table->enum('orientation', ['landscape', 'portrait', 'square'])->nullable();

            // File integrity and caching
            $table->string('checksum_sha256', 64)->nullable()->index();
            $table->string('etag', 128)->nullable();

            // CDN and URLs
            $table->string('cdn_path')->nullable()->index();
            $table->text('url')->nullable();
            $table->text('cdn_url')->nullable();
            $table->boolean('cdn_cached')->default(false)->index();

            // Status and visibility
            $table->enum('visibility', ['public', 'private'])->default('public')->index();
            $table->enum('status', ['active', 'archived'])->default('active')->index();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_favorite')->default(false)->index();
            $table->unsignedInteger('order')->default(0)->index();

            // Image analysis
            $table->string('dominant_color', 9)->nullable();
            $table->json('palette')->nullable();
            $table->json('exif')->nullable();
            $table->json('variants')->nullable();

            // Multilingual content
            $table->json('title')->nullable();
            $table->json('alt')->nullable();
            $table->json('caption')->nullable();
            $table->json('tags')->nullable();

            // User tracking
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['type', 'status']);
            $table->index(['folder_id', 'created_at']);
            $table->index(['created_at', 'type']);
            $table->index(['status', 'is_active']);

            // Foreign key constraints
            $table->foreign('folder_id')->references('id')->on('media_folders')->onDelete('set null');
            // storage_profiles tablosu varsa bu satırı aktifleştirin:
            // $table->foreign('storage_profile_id')->references('id')->on('storage_profiles')->onDelete('set null');

            // user tablosuna referanslar (eğer users tablosu varsa)
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
