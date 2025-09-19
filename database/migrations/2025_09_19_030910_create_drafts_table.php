<?php

// database/migrations/2025_09_19_000900_create_drafts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Taslağa erişmek için anahtar: ör. "accounts.create" veya random uuid
            $table->string('draft_key')->index();

            // İlişkili kaynak varsa (edit senaryosu), polimorfik ilişki
            $table->nullableMorphs('draftable'); // draftable_type, draftable_id

            // Form rotası/bağlamsal bilgi (isteğe bağlı)
            $table->string('context')->nullable(); // ör: 'accounts.create'

            // Formun ham verisi (JSON)
            $table->json('payload');

            // Otomatik silim için opsiyonel son kullanma
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'draft_key']); // kullanıcı başına tekil
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drafts');
    }
};
