<?php

// database/migrations/2025_09_19_000001_create_accounts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();

            // Temel kimlik
            $table->string('name');                       // Görünen şirket adı
            $table->string('legal_name')->nullable();     // Ticari unvan
            $table->string('website')->nullable();
            $table->string('tax_number')->nullable();     // Vergi no / MERSİS vb.
            $table->string('registration_no')->nullable(); // Sicil no

            // Esnek alanlar (JSON dizileri)
            $table->json('emails')->nullable();   // ["info@..","sales@..",{"value":"...","label":"billing"}]
            $table->json('phones')->nullable();   // [{"country":"+90","number":"532...","label":"mobile"}, ...]
            $table->json('addresses')->nullable(); // [{"type":"hq","lines":["..."],"city":"...","country":"TR","zip":"..."}]
            $table->json('socials')->nullable();  // {"linkedin":"...","instagram":"...","x":"..."}
            $table->json('custom_fields')->nullable(); // Serbest şema: {"crm_code":"X12","tier":"Gold"}

            // Durum / sınıflandırma
            $table->string('industry')->nullable();
            $table->unsignedInteger('employee_count')->nullable();
            $table->unsignedBigInteger('annual_revenue')->nullable(); // yerel para cinsinden
            $table->enum('lifecycle_stage', ['lead', 'customer', 'partner', 'vendor', 'other'])->default('lead');
            $table->enum('status', ['active', 'inactive', 'prospect', 'churned'])->default('prospect');
            $table->unsignedSmallInteger('score')->default(0); // lead score
            $table->string('source')->nullable(); // kaynağı: webform, referans, ads

            // İlişkiler
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();

            // Aktivite işaretleri
            $table->timestamp('last_contacted_at')->nullable();
            $table->timestamp('next_activity_at')->nullable();
            $table->text('internal_notes')->nullable();

            // --- Performans için generated kolonlar (MySQL 8+) ---
            // Birincil e-posta ve telefonun hızlı aranması için:
            $table->string('primary_email')->virtualAs("json_unquote(json_extract(`emails`, '$[0].value'))")->nullable();
            $table->string('primary_phone')->virtualAs("json_unquote(json_extract(`phones`, '$[0].number'))")->nullable();
            // Düz dizi (sadece string listesi kullanıyorsan) için alternatif:
            // $table->string('primary_email')->virtualAs("json_unquote(json_extract(`emails`, '$[0]'))")->nullable();

            $table->timestamps();
            $table->softDeletes();

            // İndeksler
            $table->index('owner_id');
            $table->index('status');
            $table->index('lifecycle_stage');
            $table->index('primary_email');
            $table->index('primary_phone');
            $table->fullText(['name', 'legal_name']); // hızlı arama
        });

        // Opsiyonel: web sitesinden domain çıkarıp raporlamak istersen
        // DB::statement("ALTER TABLE accounts ADD domain VARCHAR(191) AS (SUBSTRING_INDEX(REPLACE(website, 'www.', ''), '/', 1)) VIRTUAL");
        // DB::statement("CREATE INDEX accounts_domain_idx ON accounts(domain)");
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
