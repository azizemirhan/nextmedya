<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

// Carbon'u import edin

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Önceki verileri temizle (isteğe bağlı)
        DB::table('sliders')->delete();

        DB::table('sliders')->insert([
            [
                'title' => json_encode([
                    'tr' => 'Yüksek Performanslı İzolasyon Çözümleri',
                    'en' => 'High-Performance Insulation Solutions'
                ]),
                'subtitle' => json_encode([
                    'tr' => 'Endüstriyel tesisler ve mekanik tesisatlar için enerji verimliliği.',
                    'en' => 'Energy efficiency for industrial facilities and mechanical installations.'
                ]),
                'button_text' => json_encode([
                    'tr' => 'Hizmetlerimiz',
                    'en' => 'Our Services'
                ]),
                'button_url' => '/hizmetlerimiz', // Veya ilgili URL
                'image_path' => 'uploads/sliders/sample-1.jpg', // Gerçek dosya yolunu veya placeholder kullanın
                'order' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null, // Soft delete için null ekleyin
            ],
            [
                'title' => json_encode([
                    'tr' => 'Güvenlik ve Sürdürülebilirlik',
                    'en' => 'Safety and Sustainability'
                ]),
                'subtitle' => json_encode([
                    'tr' => 'Uluslararası standartlarda hizmet anlayışıyla projelerinize değer katıyoruz.',
                    'en' => 'Adding value to your projects with an international standard service approach.'
                ]),
                'button_text' => json_encode([
                    'tr' => 'Projelerimiz',
                    'en' => 'Our Projects'
                ]),
                'button_url' => '/projeler', // Veya ilgili URL
                'image_path' => 'uploads/sliders/sample-2.jpg', // Gerçek dosya yolunu veya placeholder kullanın
                'order' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null, // Soft delete için null ekleyin
            ],
            [
                'title' => json_encode([
                    'tr' => 'Enerji Kayıplarını Minimuma İndirin',
                    'en' => 'Minimize Energy Losses'
                ]),
                'subtitle' => json_encode([
                    'tr' => 'Uzman kadromuz ve sektörel tecrübemizle yanınızdayız.',
                    'en' => 'We are by your side with our expert staff and industry experience.'
                ]),
                'button_text' => json_encode([
                    'tr' => 'İletişime Geçin',
                    'en' => 'Contact Us'
                ]),
                'button_url' => '/iletisim', // Veya ilgili URL
                'image_path' => 'uploads/sliders/sample-3.jpg', // Gerçek dosya yolunu veya placeholder kullanın
                'order' => 3,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null, // Soft delete için null ekleyin
            ],
            // İhtiyaç duydukça daha fazla slider ekleyebilirsiniz...
        ]);
    }
}