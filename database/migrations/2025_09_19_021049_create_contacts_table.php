<?php

// database/migrations/2025_09_19_000002_create_contacts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();

            $table->string('primary_email')->nullable()->index();
            $table->string('primary_phone')->nullable()->index();

            $table->json('emails')->nullable();
            $table->json('phones')->nullable();
            $table->json('addresses')->nullable();
            $table->json('socials')->nullable();
            $table->json('custom_fields')->nullable();
            $table->json('credentials')->nullable();

            $table->string('profile_photo_path')->nullable();
            $table->text('notes')->nullable();

            $table->boolean('is_decision_maker')->default(false);
            $table->boolean('consent_email')->default(false);
            $table->boolean('consent_sms')->default(false);
            $table->string('source')->nullable();
            $table->integer('score')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
