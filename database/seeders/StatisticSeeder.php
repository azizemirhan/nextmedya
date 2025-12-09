<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statistics')->insert([
            [
                'icon' => 'icon-experience',
                'number' => '20+',
                'title' => json_encode(['tr' => 'Yıllık Tecrübe', 'en' => 'Years of Experience']),
                'order' => 1,
            ],
            [
                'icon' => 'icon-project',
                'number' => '75+',
                'title' => json_encode(['tr' => 'Tamamlanan Proje', 'en' => 'Completed Projects']),
                'order' => 2,
            ],
            [
                'icon' => 'icon-family',
                'number' => '500+',
                'title' => json_encode(['tr' => 'Mutlu Aile', 'en' => 'Happy Families']),
                'order' => 3,
            ],
        ]);
    }
}
