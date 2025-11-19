<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Page;
use App\Models\Service;
use App\Models\Post;
use App\Models\Category;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml for the website';

    public function handle()
    {
        $this->info('Sitemap oluşturuluyor...');

        $sitemap = Sitemap::create()
            // 1. Anasayfa gibi statik sayfaları ekle
            ->add(Url::create(route('frontend.home'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(1.0));

        // 2. Dinamik "Page" modelinden sayfaları ekle
        Page::where('status', 'published')->cursor()->each(function (Page $page) use ($sitemap) {
            $sitemap->add(
                Url::create(route('frontend.page.show', $page->slug))
                    ->setLastModificationDate($page->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8)
            );
        });

        // 3. "Service" modelinden hizmet detay sayfalarını ekle
        Service::where('is_active', true)->cursor()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('frontend.services.show', $service->slug))
                    ->setLastModificationDate($service->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.9)
            );
        });

        // 4. "Post" modelinden blog yazılarını ekle
        Post::published()->cursor()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $post->slug))
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.9)
            );
        });

        // 5. Blog Kategori sayfalarını ekle
        Category::where('is_active', true)->cursor()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.category', $category->slug))
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7)
            );
        });


        // Oluşturulan sitemap'i public klasörüne yaz
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap başarıyla oluşturuldu: public/sitemap.xml');
        return Command::SUCCESS;
    }
}
