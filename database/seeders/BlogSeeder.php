<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Yabancı anahtar kısıtlamalarını geçici olarak devre dışı bırak
        Schema::disableForeignKeyConstraints();

        // 2. Tabloları boşalt
        DB::table('post_tag')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->truncate();

        // 3. Yabancı anahtar kısıtlamalarını tekrar aktif et
        Schema::enableForeignKeyConstraints();

        // 4. Varsayılan bir yazar oluşturalım (Eloquent ile)
        $author = User::create([
            'name' => 'Tuncay İnşaat Admin',
            'email' => 'admin@tuncayinsaat.com',
            'password' => Hash::make('password'),
        ]);

        // 5. Kategorileri oluşturalım (Çok dilli)
        $cat1 = Category::create([
            'name' => ['tr' => 'İnşaat Teknolojileri', 'en' => 'Construction Technologies'],
            'slug' => 'insaat-teknolojileri',
            'is_active' => true,
        ]);
        $cat2 = Category::create([
            'name' => ['tr' => 'Mimari Tasarım', 'en' => 'Architectural Design'],
            'slug' => 'mimari-tasarim',
            'is_active' => true,
        ]);
        $cat3 = Category::create([
            'name' => ['tr' => 'Yönetmelikler', 'en' => 'Regulations'],
            'slug' => 'yonetmelikler',
            'is_active' => true,
        ]);

        // 6. Etiketleri oluşturalım (Çok dilli)
        $tag1 = Tag::create(['name' => ['tr' => 'Sürdürülebilirlik', 'en' => 'Sustainability'], 'slug' => 'surdurulebilirlik']);
        $tag2 = Tag::create(['name' => ['tr' => 'Akıllı Binalar', 'en' => 'Smart Buildings'], 'slug' => 'akilli-binalar']);
        $tag3 = Tag::create(['name' => ['tr' => 'Deprem Güvenliği', 'en' => 'Earthquake Safety'], 'slug' => 'deprem-guvenligi']);

        // 7. Yazıları oluşturalım (Çok dilli)
        $post1 = Post::create([
            'title' => ['tr' => 'İnşaat Sektöründe Sürdürülebilir Malzeme Kullanımı', 'en' => 'Sustainable Material Usage in the Construction Sector'],
            'slug' => 'insaat-sektorunde-surdurulebilir-malzeme-kullanimi',
            'content' => ['tr' => 'Bu yazıda, çevre dostu ve enerji verimli malzemelerin modern inşaat projelerindeki önemini ve uygulanışını detaylı bir şekilde ele alıyoruz.', 'en' => 'In this article, we discuss in detail the importance and implementation of eco-friendly and energy-efficient materials in modern construction projects.'],
            'excerpt' => ['tr' => 'Sürdürülebilir malzemeler, inşaat sektörünün geleceği için neden bu kadar önemli?', 'en' => 'Why are sustainable materials so important for the future of the construction industry?'],
            'featured_image' => 'placeholders/post_1.jpg',
            'user_id' => $author->id,
            'category_id' => $cat1->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $post2 = Post::create([
            'title' => ['tr' => 'Modern Mimaride Akıllı Bina Teknolojileri', 'en' => 'Smart Building Technologies in Modern Architecture'],
            'slug' => 'modern-mimaride-akilli-bina-teknolojileri',
            'content' => ['tr' => 'Nesnelerin İnterneti (IoT) ve otomasyon sistemlerinin binaları nasıl daha verimli, güvenli ve konforlu hale getirdiğini inceliyoruz.', 'en' => 'We examine how the Internet of Things (IoT) and automation systems are making buildings more efficient, secure, and comfortable.'],
            'excerpt' => ['tr' => 'Akıllı binalar, enerji verimliliğinden yaşam konforuna kadar birçok avantaj sunuyor.', 'en' => 'Smart buildings offer many advantages, from energy efficiency to living comfort.'],
            'featured_image' => 'placeholders/post_2.jpg',
            'user_id' => $author->id,
            'category_id' => $cat2->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $post3 = Post::create([
            'title' => ['tr' => 'Yeni Deprem Yönetmeliği ve Binalara Etkileri', 'en' => 'The New Earthquake Regulation and Its Effects on Buildings'],
            'slug' => 'yeni-deprem-yonetmeligi-ve-binalara-etkileri',
            'content' => ['tr' => '2025 yılında yürürlüğe giren en son deprem yönetmeliğinin getirdiği yenilikler, mevcut yapılar üzerindeki etkileri ve yeni inşaatlar için zorunluluklar.', 'en' => 'Innovations brought by the latest earthquake regulation effective in 2025, its effects on existing structures, and requirements for new constructions.'],
            'excerpt' => ['tr' => 'Güncellenen deprem yönetmeliği, mevcut ve yeni yapılacak binalar için ne gibi zorunluluklar getiriyor?', 'en' => 'What requirements does the updated earthquake regulation bring for existing and new buildings?'],
            'featured_image' => 'placeholders/post_3.jpg',
            'user_id' => $author->id,
            'category_id' => $cat3->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $post4 = Post::create([
            'title' => ['tr' => 'Proje Yönetiminde İnovatif Yaklaşımlar', 'en' => 'Innovative Approaches in Project Management'],
            'slug' => 'proje-yonetiminde-inovatif-yaklasimlar',
            'content' => ['tr' => 'Büyük ölçekli inşaat projelerinde maliyet ve zaman yönetimini optimize eden en yeni dijital araçlar, BIM ve yalın inşaat metodolojileri üzerine bir inceleme.', 'en' => 'A review of the latest digital tools, BIM, and lean construction methodologies that optimize cost and time management in large-scale construction projects.'],
            'excerpt' => ['tr' => 'Büyük ölçekli inşaat projelerinde maliyet ve zaman yönetimini optimize eden en yeni dijital araçlar ve metodolojiler.', 'en' => 'The latest digital tools and methodologies that optimize cost and time management in large-scale construction projects.'],
            'featured_image' => 'placeholders/post_4.jpg',
            'user_id' => $author->id,
            'category_id' => $cat1->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        // 8. Yazılar ve etiketler arasındaki ilişkiyi kuralım (Eloquent ile)
        $post1->tags()->attach([$tag1->id]);
        $post2->tags()->attach([$tag1->id, $tag2->id]);
        $post3->tags()->attach([$tag3->id]);
        $post4->tags()->attach([$tag2->id]);
    }
}
