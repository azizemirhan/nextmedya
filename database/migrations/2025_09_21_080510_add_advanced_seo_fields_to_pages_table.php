<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // keywords sütunundan sonra eklenecekler
            $table->json('seo_title')->nullable()->after('status');
            $table->json('meta_description')->nullable()->after('seo_title');
            $table->json('keywords')->nullable()->after('meta_description');
            $table->enum('index_status', ['index', 'noindex'])->default('index')->after('keywords');
            $table->enum('follow_status', ['follow', 'nofollow'])->default('follow')->after('index_status');
            $table->string('canonical_url')->nullable()->after('follow_status');

            // Open Graph (Sosyal Medya Paylaşımı) Alanları
            $table->json('og_title')->nullable()->after('canonical_url');
            $table->json('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'index_status',
                'follow_status',
                'canonical_url',
                'og_title',
                'og_description',
                'og_image'
            ]);
        });
    }
};
