<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sliders')->insert([
            [
                'title' => json_encode(['tr' => 'Geleceği Güvenle İnşa Ediyoruz', 'en' => 'Building the Future with Confidence']),
                'subtitle' => json_encode(['tr' => 'Modern mimari ve 20 yılı aşkın tecrübemizle hayallerinizi gerçeğe dönüştürüyoruz.', 'en' => 'We turn your dreams into reality with modern architecture and over 20 years of experience.']),
                'button_text' => json_encode(['tr' => 'Projelerimiz', 'en' => 'Our Projects']),
                'button_url' => '/projeler',
                'image_path' => 'https://placehold.co/1920x800',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => json_encode(['tr' => 'Hayalinizdeki Yaşam Alanları', 'en' => 'The Living Spaces of Your Dreams']),
                'subtitle' => json_encode(['tr' => 'Estetik, konfor ve güvenliği bir araya getiren anahtar teslim projeler.', 'en' => 'Turnkey projects that bring together aesthetics, comfort, and safety.']),
                'button_text' => json_encode(['tr' => 'İletişime Geçin', 'en' => 'Contact Us']),
                'button_url' => '/iletisim',
                'image_path' => 'https://placehold.co/1920x800/a3be8c/ffffff', // Farklı renk
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
