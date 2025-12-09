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
        Schema::table('sliders', function (Blueprint $table) {
            // 'subtitle' sütunundan sonra 'description' sütununu ekle
            // JSON tipinde ve nullable (boş olabilir) olarak tanımla
            $table->json('description')->nullable()->after('subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            // Migration geri alınırsa 'description' sütununu kaldır
            $table->dropColumn('description');
        });
    }
};