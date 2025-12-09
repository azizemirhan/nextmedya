<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'title' => json_encode(['tr' => 'Müşteri Odaklı Yaklaşım', 'en' => 'Customer-Centric Approach']),
                'description' => json_encode(['tr' => 'Projenin her aşamasında müşterilerimizin beklentilerini dinliyor, süreci tam bir şeffaflıkla yönetiyoruz.', 'en' => 'We listen to our customers\' expectations at every stage and manage the process with full transparency.']),
                'order' => 1,
            ],
            [
                'title' => json_encode(['tr' => 'Zamanında Teslim Garantisi', 'en' => 'On-Time Delivery Guarantee']),
                'description' => json_encode(['tr' => 'Gelişmiş proje yönetim metodolojimiz sayesinde tüm projelerimizi söz verdiğimiz tarihte teslim ediyoruz.', 'en' => 'Thanks to our advanced project management, we deliver all projects on the promised date.']),
                'order' => 2,
            ],
        ]);
    }
}
