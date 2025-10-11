<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        // Eski verileri temizleyerek her seferinde aynı sonucu almayı garantiler
        DB::table('testimonials')->truncate();

        DB::table('testimonials')->insert([
            [
                'name' => json_encode(['tr' => 'Ahmet Çelik', 'en' => 'Ahmet Celik']),
                'company' => json_encode(['tr' => 'Mavişehir Modern Sakini', 'en' => 'Mavisehir Modern Resident']),
                'content' => json_encode(['tr' => 'Sürecin başından sonuna kadar olan profesyonel yaklaşımları sayesinde hiçbir sorun yaşamadık. Evimize zamanında kavuştuğumuz için çok mutluyuz.', 'en' => 'Thanks to their professional approach from start to finish, we had no problems. We are very happy to have our home on time.']),
                'image_path' => 'https://placehold.co/100x100',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['tr' => 'Zeynep Kaya', 'en' => 'Zeynep Kaya']),
                'company' => json_encode(['tr' => 'Ankara Ofis Park Yöneticisi', 'en' => 'Ankara Office Park Manager']),
                'content' => json_encode(['tr' => 'Ticari projemizde gösterdikleri titizlik ve belirledikleri takvime olan sadakatleri için Tuncay İnşaat\'a teşekkür ederiz. Beklentilerimizin ötesinde bir iş çıkardılar.', 'en' => 'We thank Tuncay Construction for their meticulousness and adherence to the schedule in our commercial project. They delivered work beyond our expectations.']),
                'image_path' => 'https://placehold.co/100x100',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['tr' => 'Mustafa Sönmez', 'en' => 'Mustafa Sonmez']),
                'company' => json_encode(['tr' => 'Kentsel Dönüşüm Projesi Kat Maliki', 'en' => 'Urban Transformation Project Flat Owner']),
                'content' => json_encode(['tr' => 'Kentsel dönüşüm gibi karmaşık bir süreçte bize her adımda yol gösterdiler. Hem hukuki hem de teknik konulardaki uzmanlıkları sayesinde süreci güvenle tamamladık.', 'en' => 'They guided us at every step in a complex process like urban transformation. Thanks to their expertise in both legal and technical matters, we completed the process with confidence.']),
                'image_path' => 'https://placehold.co/100x100',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['tr' => 'David Miller', 'en' => 'David Miller']),
                'company' => json_encode(['tr' => 'Yatırımcı', 'en' => 'Investor']),
                'content' => json_encode(['tr' => 'Tuncay İnşaat ile çalışmak, yatırımımızın kalitesini ve geri dönüşünü garanti altına aldı. Profesyonel ve şeffaf bir ekip.', 'en' => 'Working with Tuncay Construction guaranteed the quality and return on our investment. A professional and transparent team.']),
                'image_path' => 'https://placehold.co/100x100',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
