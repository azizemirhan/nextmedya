<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_images')->insert([
            // Proje 1 (Mavişehir) için resimler
            ['project_id' => 1, 'image_path' => '/images/projects/mavisehir-1.jpg', 'is_cover' => true],
            ['project_id' => 1, 'image_path' => '/images/projects/mavisehir-2.jpg', 'is_cover' => false],
            ['project_id' => 1, 'image_path' => '/images/projects/mavisehir-3.jpg', 'is_cover' => false],
            // Proje 2 (Ankara Ofis) için resimler
            ['project_id' => 2, 'image_path' => '/images/projects/ankara-ofis-1.jpg', 'is_cover' => true],
            ['project_id' => 2, 'image_path' => '/images/projects/ankara-ofis-2.jpg', 'is_cover' => false],
        ]);
    }
}
