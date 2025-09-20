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

        // 1. Önce kullanıcıları oluşturalım
        $this->call(AdminUserSeeder::class); // 1 Admin oluşturur
        User::factory(9)->create();          // 9 Member oluşturur

        // 2. Sonra Rolleri/İzinleri oluşturalım VE mevcut kullanıcılara atayalım
        $this->call(RolesAndPermissionsSeeder::class);

        // 3. Diğer verileri oluşturalım
        $this->call(AccountSeeder::class);
        $this->call(ContactSeeder::class);


        // 2. Etiketleri oluşturalım
        $tags = Tag::factory(40)->create();

        // 3. Normal (aktif/pasif karışık) kategoriler oluşturalım
        $categories = Category::factory(15)->create();

        // 4. Çöp kutusunda olan (soft-deleted) kategoriler oluşturalım
        $trashedCategories = Category::factory(5)->trashed()->create();

        // 5. Yazıları oluşturalım ve sadece normal kategorilere bağlayalım
        Post::factory(50)->create([
            // Yazıların kategorisini, silinmemiş olanlar arasından rastgele seç
            'category_id' => $categories->random()->id,
        ])->each(function ($post) use ($tags) {
            // Her yazıya 1 ile 5 arasında rastgele etiket ata
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
