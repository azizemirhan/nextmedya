<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);
        $status = fake()->randomElement(['published', 'draft', 'scheduled']);
        $published_at = ($status === 'published') ? now()->subDays(rand(1, 365)) : null;
        if ($status === 'scheduled') {
            $published_at = now()->addDays(rand(1, 60));
        }

        return [
            // Temel Alanlar
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => implode("\n\n", fake()->paragraphs(15)),
            'excerpt' => fake()->paragraph(3),
            'featured_image' => fake()->imageUrl(1200, 630, 'technics', true),
            'featured_image_alt_text' => 'Görsel: '.$title,

            // Yapısal Alanlar
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'status' => $status,
            'visibility' => fake()->randomElement(['public', 'private']),
            'published_at' => $published_at,

            // SEO Alanları
            'seo_title' => $title.' - SitenizinAdı.com',
            'meta_description' => fake()->sentence(25),
            'keywords' => implode(', ', fake()->words(5)),
            'canonical_url' => fake()->optional(0.1)->url(), // %10 ihtimalle canonical URL ata
            'index_status' => 'index',
            'follow_status' => 'follow',

            // JSON Schema Alanları
            'schema_type' => fake()->randomElement(['auto', 'manual', 'none']),
            'manual_schema_json' => null, // Manuel veriyi özel durumlarda elle dolduracağız
            'generated_schema_json' => null, // Bu alan controller'da oluşturulup doldurulabilir
        ];
    }
}
