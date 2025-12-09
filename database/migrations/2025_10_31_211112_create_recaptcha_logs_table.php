<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recaptcha_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index();
            $table->decimal('score', 3, 2)->index(); // 0.00 - 1.00
            $table->string('action', 50)->index();
            $table->boolean('success')->default(false)->index();
            $table->string('hostname')->nullable();
            $table->string('form_type', 50)->nullable(); // contact, newsletter, etc.
            $table->text('user_agent')->nullable();
            $table->string('route_name')->nullable();
            $table->json('error_codes')->nullable();
            $table->timestamp('challenge_ts')->nullable();
            $table->timestamps();

            // Indexes for reporting
            $table->index('created_at');
            $table->index(['created_at', 'success']);
            $table->index(['ip_address', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recaptcha_logs');
    }
};