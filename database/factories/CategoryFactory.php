<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Modelin varsayılan durumunu tanımlar.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'seo_title' => ucfirst($name).' | Kategorisi',
            'meta_description' => fake()->sentence(20),

            // --- YENİ EKLENEN ALANLAR İÇİN GÜNCELLEMELER ---
            'is_active' => fake()->boolean(90),       // %90 ihtimalle true (aktif) döner
            'show_in_sidebar' => fake()->boolean(80), // %80 ihtimalle true döner
            'show_in_menu' => fake()->boolean(25),    // %25 ihtimalle true döner (her kategori menüde olmaz)

            // nullable olduğu için `optional()` kullanarak bazılarını boş bırakıyoruz
            'logo_path' => fake()->optional(0.7)->imageUrl(400, 400, 'cats', true), // %70 ihtimalle logo atar
            'banner_path' => fake()->optional(0.6)->imageUrl(1200, 400, 'business', true), // %60 ihtimalle banner atar
        ];
    }

    /**
     * Kategorinin silinmiş (çöp kutusunda) olduğunu belirten bir state.
     * Bu, soft delete özelliğini test etmek için kullanılır.
     */
    public function trashed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
            ];
        });
    }
}
