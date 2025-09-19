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

            // İlişki
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();

            // Kimlik
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();

            // İletişim (JSON)
            $table->json('emails')->nullable();  // ["ad.soyad@..", {"value":"...","label":"work","primary":true}]
            $table->json('phones')->nullable();  // [{"number":"...","label":"work"}, ...]
            $table->json('addresses')->nullable();
            $table->json('socials')->nullable(); // {"linkedin":"...", "twitter":"..."}

            // İzin/KVKK & tercihler
            $table->boolean('is_decision_maker')->default(false);
            $table->boolean('consent_email')->default(false);
            $table->boolean('consent_sms')->default(false);
            $table->timestamp('consent_updated_at')->nullable();

            // Lead bilgisi
            $table->string('source')->nullable();
            $table->unsignedSmallInteger('score')->default(0);

            // Generated kolonlar (performans)
            $table->string('primary_email')->virtualAs("json_unquote(json_extract(`emails`, '$[0].value'))")->nullable();
            $table->string('primary_phone')->virtualAs("json_unquote(json_extract(`phones`, '$[0].number'))")->nullable();

            $table->timestamps();
            $table->softDeletes();

            // İndeksler
            $table->index('account_id');
            $table->index('primary_email');
            $table->index('primary_phone');
            $table->fullText(['first_name', 'last_name', 'job_title', 'department']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
