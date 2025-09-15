<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\User;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('tr_TR');

        // Örnek görsel yolları
        $images = [
            'http://127.0.0.1:8000/ornek1.png',
        ];

        // En az bir kullanıcı olmalı
        $authorId = User::first()?->id ?? 1;

        foreach (range(1, 10) as $index) {
            $title = $faker->sentence(6);
            $slug = Str::slug($title);
            $publishedAt = Carbon::now()->subDays(rand(0, 30));

            DB::table('posts')->insert([
                'title' => $title,
                'slug' => $slug,
                'content' => $faker->paragraphs(5, true),
                'meta_title' => $faker->sentence(6),
                'meta_description' => $faker->sentence(12),
                'meta_keywords' => implode(', ', $faker->words(5)),
                'featured_image' => $faker->randomElement($images),
                'published_at' => $publishedAt,
                'author_id' => $authorId,
                'status' => $faker->randomElement(['draft', 'published', 'archived']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
