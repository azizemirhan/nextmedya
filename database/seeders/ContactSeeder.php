<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'account_id' => null,
                'first_name' => 'Ahmet',
                'last_name' => 'Yılmaz',
                'job_title' => 'Satış Müdürü',
                'department' => 'Satış',
                'primary_email' => 'ahmet.yilmaz@example.com',
                'primary_phone' => '05321234567',
                'emails' => json_encode([
                    ['label' => 'iş', 'value' => 'ahmet.yilmaz@example.com'],
                    ['label' => 'kişisel', 'value' => 'ahmet@gmail.com'],
                ]),
                'phones' => json_encode([
                    ['label' => 'cep', 'number' => '05321234567'],
                    ['label' => 'ofis', 'number' => '02121234567'],
                ]),
                'addresses' => json_encode([
                    ['label' => 'ev', 'line1' => 'Atatürk Cad. No:123', 'city' => 'İstanbul'],
                ]),
                'socials' => json_encode([
                    ['label' => 'linkedin', 'value' => 'https://linkedin.com/in/ahmetyilmaz'],
                ]),
                'custom_fields' => json_encode([
                    ['key' => 'kaynak', 'value' => 'web'],
                ]),
                'credentials' => json_encode([
                    ['key' => 'portal', 'username' => 'ahmet', 'password' => 'secret123'],
                ]),
                'profile_photo_path' => null,
                'notes' => 'Önemli müşteri, sık sık kampanya ister.',
                'is_decision_maker' => true,
                'consent_email' => true,
                'consent_sms' => false,
                'score' => 85,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'account_id' => null,
                'first_name' => 'Elif',
                'last_name' => 'Demir',
                'job_title' => 'Pazarlama Uzmanı',
                'department' => 'Pazarlama',
                'primary_email' => 'elif.demir@example.com',
                'primary_phone' => '05449876543',
                'emails' => json_encode([
                    ['label' => 'iş', 'value' => 'elif.demir@example.com'],
                ]),
                'phones' => json_encode([
                    ['label' => 'cep', 'number' => '05449876543'],
                ]),
                'addresses' => json_encode([
                    ['label' => 'ofis', 'line1' => 'Cumhuriyet Mah. 45. Sok. No:5', 'city' => 'Ankara'],
                ]),
                'socials' => json_encode([
                    ['label' => 'twitter', 'value' => 'https://twitter.com/elifdemir'],
                ]),
                'custom_fields' => json_encode([
                    ['key' => 'kampanya ilgisi', 'value' => 'yüksek'],
                ]),
                'credentials' => json_encode([
                    ['key' => 'crm', 'username' => 'elifd', 'password' => 'crmPass!'],
                ]),
                'profile_photo_path' => null,
                'notes' => 'Yeni lead, pazarlama ekibinden geldi.',
                'is_decision_maker' => false,
                'consent_email' => true,
                'consent_sms' => true,
                'score' => 60,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
