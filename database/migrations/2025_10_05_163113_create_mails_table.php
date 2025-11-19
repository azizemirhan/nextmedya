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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();

            // Gönderen Bilgileri
            $table->foreignId('sender_id')->nullable()->constrained('users')->onDelete('cascade'); // Sistem içi gönderen
            $table->string('sender_name')->nullable(); // Dışarıdan gelen gönderenin adı
            $table->string('sender_email')->nullable(); // Dışarıdan gelen gönderenin e-postası

            // Alıcı Bilgileri
            $table->foreignId('recipient_id')->nullable()->constrained('users')->onDelete('cascade'); // Sistem içi alıcı
            $table->string('recipient_email')->nullable(); // Dışarıya gönderilen alıcının e-postası

            // Mail İçeriği
            $table->string('subject');
            $table->longText('body');

            // Mail Durumları
            $table->boolean('is_read')->default(false);
            $table->boolean('is_important')->default(false);
            $table->boolean('is_spam')->default(false);
            $table->boolean('is_draft')->default(false);

            // Zaman Damgaları
            $table->timestamps();
            $table->softDeletes(); // Çöp kutusu (trash) özelliği için
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
