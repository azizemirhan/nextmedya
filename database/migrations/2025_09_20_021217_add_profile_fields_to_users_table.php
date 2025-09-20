<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Görseldeki alanlar
            $table->string('profession')->nullable()->after('name');
            $table->string('country')->nullable()->after('phone');
            $table->string('address')->nullable()->after('country');
            $table->string('location')->nullable()->after('address');
            $table->string('website')->nullable()->after('location');
            $table->json('socials')->nullable()->after('website');

            // Not alanı
            $table->text('notes')->nullable()->after('socials');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profession', 'country', 'address', 'location', 'website', 'socials', 'notes'
            ]);
        });
    }
};
