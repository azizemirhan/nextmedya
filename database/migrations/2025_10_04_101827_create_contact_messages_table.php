<?php

// database/migrations/XXXX_XX_XX_create_contact_messages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $t) {
            $t->id();
            $t->string('name', 120);
            $t->string('email', 190)->index();
            $t->string('subject', 190);
            $t->text('message');
            $t->ipAddress('ip')->nullable();
            $t->string('user_agent', 255)->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};

