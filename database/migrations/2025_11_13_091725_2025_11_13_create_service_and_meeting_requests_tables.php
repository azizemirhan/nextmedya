<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hizmet Talep Formu (Bilgi Al)
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('form_type')->default('service_request'); // Form tipi ayırt etmek için
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            
            // Hizmet Seçimi
            $table->string('service_type'); // web_design, mobile_app, seo, vb.
            $table->string('package_type')->nullable(); // basic, premium, enterprise
            $table->decimal('package_price', 10, 2)->nullable();
            
            // Ek Bilgiler
            $table->json('selected_features')->nullable(); // Seçilen özellikler
            $table->text('project_details')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('timeline')->nullable(); // Ne zaman başlamak istiyor
            
            // Tracking
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            
            $table->index(['form_type', 'created_at']);
            $table->index('is_read');
        });

        // Toplantı Talep Formu
        Schema::create('meeting_requests', function (Blueprint $table) {
            $table->id();
            $table->string('form_type')->default('meeting_request');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            
            // Toplantı Tercihleri
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time')->nullable(); // morning, afternoon, evening
            $table->string('preferred_time_slot')->nullable(); // 09:00-10:00, vb.
            $table->date('alternative_date')->nullable();
            $table->string('alternative_time')->nullable();
            
            // İletişim Tercihi
            $table->json('contact_methods')->nullable(); // phone, video, in_person
            $table->string('meeting_type')->nullable(); // online, office, client_office
            $table->string('meeting_platform')->nullable(); // zoom, teams, google_meet
            
            // Toplantı Konusu
            $table->string('topic'); // new_project, consultation, support, vb.
            $table->text('message')->nullable();
            
            // Tracking
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            
            $table->index(['form_type', 'created_at']);
            $table->index('status');
            $table->index('preferred_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
        Schema::dropIfExists('meeting_requests');
    }
};