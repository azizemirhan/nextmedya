<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Ayar adı (örn: 'site_logo')
            $table->json('value')->nullable(); // DEĞİŞİKLİK: Değeri JSON olarak tutacağız
            $table->boolean('is_translatable')->default(false); // DEĞİŞİKLİK: Çevrilebilir mi?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
