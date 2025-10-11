<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => json_encode(['tr' => 'Mavişehir Modern Konutları', 'en' => 'Mavisehir Modern Residences']),
                'slug' => 'mavisehir-modern-konutlari',
                'description' => json_encode(['tr' => 'İzmir Mavişehir\'de, denize sıfır, modern ve lüks bir yaşam alanı sunan projemiz 2024 yılında teslim edilmiştir.', 'en' => 'Our project in Izmir Mavisehir, offering a modern and luxurious living space by the sea, was delivered in 2024.']),
                'location' => json_encode(['tr' => 'Mavişehir, İzmir', 'en' => 'Mavisehir, Izmir']),
                'completion_date' => Carbon::create(2024, 5, 15),
                'image_path' => 'https://placehold.co/640x395/4c566a/ffffff',
                'status' => 1, // Tamamlandı
                'is_featured' => true,
                'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null,
            ],
            [
                'title' => json_encode(['tr' => 'Ankara Ofis Park', 'en' => 'Ankara Office Park']),
                'slug' => 'ankara-ofis-park',
                'description' => json_encode(['tr' => 'Başkentin iş merkezinde, A sınıfı ofisler ve ticari alanlar içeren prestijli projemiz devam etmektedir.', 'en' => 'Our prestigious project, including A-class offices and commercial areas in the capital\'s business center, is ongoing.']),
                'location' => json_encode(['tr' => 'Çankaya, Ankara', 'en' => 'Cankaya, Ankara']),
                'completion_date' => null,
                'image_path' => 'https://placehold.co/640x395/a3be8c/ffffff',
                'status' => 0, // Devam Ediyor
                'is_featured' => true,
                'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null,
            ],
            // --- YENİ EKLENEN PROJELER ---
            [
                'title' => json_encode(['tr' => 'Bodrum Karia Villaları', 'en' => 'Bodrum Karia Villas']),
                'slug' => 'bodrum-karia-villalari',
                'description' => json_encode(['tr' => 'Ege\'nin incisi Bodrum\'da, özel havuzlu ve eşsiz manzaralı lüks villa projemiz tamamlanmıştır.', 'en' => 'Our luxury villa project with private pools and unique views in Bodrum, the pearl of the Aegean, has been completed.']),
                'location' => json_encode(['tr' => 'Yalıkavak, Bodrum', 'en' => 'Yalikavak, Bodrum']),
                'completion_date' => Carbon::create(2023, 11, 1),
                'image_path' => 'https://placehold.co/640x395/d08770/ffffff',
                'status' => 1, // Tamamlandı
                'is_featured' => true,
                'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null,
            ],
            [
                'title' => json_encode(['tr' => 'Gebze Lojistik Merkezi', 'en' => 'Gebze Logistics Center']),
                'slug' => 'gebze-lojistik-merkezi',
                'description' => json_encode(['tr' => 'Marmara Bölgesi\'nin sanayi kalbinde, 50.000 m² kapalı alana sahip modern lojistik ve depolama tesisi inşaatı.', 'en' => 'Construction of a modern logistics and storage facility with 50,000 m² of closed area in the industrial heart of the Marmara Region.']),
                'location' => json_encode(['tr' => 'Gebze, Kocaeli', 'en' => 'Gebze, Kocaeli']),
                'completion_date' => null,
                'image_path' => 'https://placehold.co/640x395/b48ead/ffffff',
                'status' => 0, // Devam Ediyor
                'is_featured' => false,
                'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null,
            ],
            [
                'title' => json_encode(['tr' => 'Galata Tarihi Bina Restorasyonu', 'en' => 'Galata Historical Building Restoration']),
                'slug' => 'galata-tarihi-bina-restorasyonu',
                'description' => json_encode(['tr' => 'İstanbul\'un tarihi dokusuna sadık kalarak, 19. yüzyıldan kalma tarihi bir binanın aslına uygun olarak restore edilmesi projesi.', 'en' => 'A project for the restoration of a 19th-century historical building in accordance with its original form, remaining faithful to the historical texture of Istanbul.']),
                'location' => json_encode(['tr' => 'Galata, İstanbul', 'en' => 'Galata, Istanbul']),
                'completion_date' => Carbon::create(2025, 2, 20),
                'image_path' => 'https://placehold.co/640x395/88c0d0/ffffff',
                'status' => 1, // Tamamlandı
                'is_featured' => true,
                'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null,
            ],
        ]);
    }
}
