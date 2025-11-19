<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            SliderSeeder::class,
//            ServiceSeeder::class,
            MenuSeeder::class,
            BlogSeeder::class, // Bu seeder; kullanıcı, kategori, etiket ve yazıları oluşturacak

            AdminUserSeeder::class,
            SettingSeeder::class,
//            FeatureSeeder::class,
//            StatisticSeeder::class,
//            ProjectSeeder::class,
//            ProjectImageSeeder::class,
//            TeamMemberSeeder::class,
//            TestimonialSeeder::class,
//            SettingSeeder::class,
//            PermissionsSeeder::class,
//            FaqSeeder::class,
//            PageSeeder::class,
        ]);
    }
}
