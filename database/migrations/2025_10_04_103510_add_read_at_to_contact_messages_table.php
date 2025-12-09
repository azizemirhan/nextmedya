<?php

// database/migrations/XXXX_add_read_at_to_contact_messages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $t) {
            $t->timestamp('read_at')->nullable()->index()->after('user_agent');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $t) {
            $t->dropColumn('read_at');
        });
    }
};
