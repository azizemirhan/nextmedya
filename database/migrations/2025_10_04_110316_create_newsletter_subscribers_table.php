<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('newsletter_subscribers', function (Blueprint $t) {
            $t->id();
            $t->string('email', 190)->unique();
            $t->string('status', 20)->default('pending'); // pending|confirmed|unsubscribed
            $t->string('token', 64)->unique();            // confirm/unsubscribe token
            $t->ipAddress('ip')->nullable();
            $t->string('user_agent', 255)->nullable();
            $t->timestamps();
            $t->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
    }
};
