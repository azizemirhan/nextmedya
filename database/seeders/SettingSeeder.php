<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Değerleri ham PHP tipleriyle (array, string) giriyoruz.
        // json_encode() işlemini modeldeki mutator otomatik olarak yapacak.
        $settings = [
            // === GENEL & GÖRSEL AYARLAR ===
            ['key' => 'site_logo', 'value' => '/logo.png', 'is_translatable' => false],
            ['key' => 'footer_logo', 'value' => '/images/footer-logo.png', 'is_translatable' => false],
            ['key' => 'site_favicon', 'value' => '/favicon.ico', 'is_translatable' => false],

            // === ÇOK DİLLİ METİNLER ===
            ['key' => 'header_cta_text', 'value' => ['tr' => 'Teklif Al', 'en' => 'Get a Quote'], 'is_translatable' => true],
            ['key' => 'footer_contact_text', 'value' => ['tr' => 'Satış Temsilcisi', 'en' => 'Sales Representative'], 'is_translatable' => true],
            ['key' => 'footer_cta_text', 'value' => ['tr' => 'Hizmetlerimiz', 'en' => 'Our Services'], 'is_translatable' => true],
            // Sektöre özel footer metni
            ['key' => 'footer_info_text', 'value' => [
                'tr' => 'Endüstriyel tesisler ve mekanik tesisatlar için profesyonel izolasyon çözümleri sunuyor, enerji verimliliğini artırıyor ve uluslararası standartlarda hizmet veriyoruz.',
                'en' => 'We provide professional insulation solutions for industrial facilities and mechanical systems, increasing energy efficiency and delivering services at international standards.'
            ], 'is_translatable' => true],
            ['key' => 'newsletter_title', 'value' => ['tr' => 'Bülten', 'en' => 'Newsletter'], 'is_translatable' => true],
            ['key' => 'newsletter_subtitle', 'value' => ['tr' => 'En son haberleri almak için bültenimize kaydolun.', 'en' => 'Signup for our newsletter to get the latest news.'], 'is_translatable' => true],
            // Firma adı güncellemesi
            ['key' => 'copyright_text', 'value' => [
                'tr' => '© 2025 İzokoç İzolasyon. Tüm Hakları Saklıdır.',
                'en' => '© 2025 İzokoç Insulation. All rights reserved.'
            ], 'is_translatable' => true],

            // === TEK DİLLİ METİNLER & LİNKLER ===
            ['key' => 'header_cta_url', 'value' => '/iletisim', 'is_translatable' => false],
            ['key' => 'footer_cta_url', 'value' => '/hizmetler', 'is_translatable' => false],
            ['key' => 'footer_contact_phone', 'value' => '+90 555 123 45 67', 'is_translatable' => false],
            ['key' => 'whatsapp_phone', 'value' => '+90 555 123 45 67', 'is_translatable' => false],
            // Adres ve e-posta güncellemesi
            ['key' => 'contact_address', 'value' => 'Ataşehir / İstanbul, Türkiye', 'is_translatable' => false],
            ['key' => 'contact_email', 'value' => 'info@izokoc.com.tr', 'is_translatable' => false],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com', 'is_translatable' => false],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com', 'is_translatable' => false],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com', 'is_translatable' => false],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com', 'is_translatable' => false],

            // === SİSTEM & HARİCİ SERVİSLER ===
            ['key' => 'google_site_verification', 'value' => '', 'is_translatable' => false],
            ['key' => 'bing_site_verification', 'value' => '', 'is_translatable' => false],
            ['key' => 'yandex_site_verification', 'value' => '', 'is_translatable' => false],
            ['key' => 'google_analytics_id', 'value' => '', 'is_translatable' => false],
            // Renk güncellemesi (Kurumsal Mavi)
            ['key' => 'primary_color', 'value' => '#004a99', 'is_translatable' => false],
            ['key' => 'primary_color_light', 'value' => '#e6f0ff', 'is_translatable' => false],
            ['key' => 'maintenance_mode', 'value' => 'off', 'is_translatable' => false], // 'on' veya 'off'
            ['key' => 'active_languages', 'value' => ['tr', 'en'], 'is_translatable' => false], // Bu da bir dizi
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']], // Bu anahtara sahip ayarı bul
                [                               // Bulamazsa veya bulursa bu verilerle güncelle/oluştur
                    'value' => $setting['value'],
                    'is_translatable' => $setting['is_translatable'],
                ]
            );
        }
    }
}