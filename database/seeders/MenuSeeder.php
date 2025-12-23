<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1) Header Menüsü (main-menu)
            $menu = Menu::firstOrCreate(
                ['slug' => 'main-menu'],
                [
                    'name' => 'Primary Menu',
                    'placement' => 'header'
                ]
            );

            $menu->setTranslations('name', [
                'tr' => 'Ana Menü',
                'en' => 'Main Menu',
            ]);
            $menu->save();

            // 2) TÜM eski item'ları temizle
            MenuItem::where('menu_id', $menu->id)->delete();

            // 3) KÖK MENÜLER (5 adet)
            $order = 1;

            // Ana Sayfa
            $this->makeItem(
                $menu,
                ['tr' => 'Ana Sayfa', 'en' => 'Home'],
                '/',
                $order++
            );

            // HİZMETLERİMİZ - MEGA MENU (4 Kolon)
            $hizmetler = $this->makeMegaMenuItem(
                $menu,
                ['tr' => 'Hizmetlerimiz', 'en' => 'Our Services'],
                '/hizmetlerimiz',
                $order++
            );

            // KURUMSAL - Normal Dropdown
            $kurumsal = $this->makeItem(
                $menu,
                ['tr' => 'Kurumsal', 'en' => 'Corporate'],
                '#',
                $order++
            );

            // BLOG
            $this->makeItem(
                $menu,
                ['tr' => 'Blog', 'en' => 'Blog'],
                '/bloglar',
                $order++
            );

            // İLETİŞİM
            $this->makeItem(
                $menu,
                ['tr' => 'İletişim', 'en' => 'Contact'],
                '/iletisim',
                $order++
            );

            // ===============================
            // HİZMETLERİMİZ - MEGA MENU KOLONLARI
            // ===============================

            // KOLON 1: WEB PAKETLERİ
            $webPaketleri = $this->makeMegaColumn(
                $menu,
                $hizmetler->id,
                ['tr' => 'Web Paketleri', 'en' => 'Web Packages'],
                'fas fa-globe',
                ['tr' => 'Hazır web çözümlerimiz', 'en' => 'Ready web solutions'],
                1
            );

            $this->megaColumnItems($menu, $webPaketleri->id, [
                ['title' => ['tr' => 'Kurumsal Web Sitesi', 'en' => 'Corporate Website'], 'url' => '/kurumsal-web-sitesi'],
                ['title' => ['tr' => 'E-Ticaret Sitesi', 'en' => 'E-Commerce Website'], 'url' => '/e-ticaret-sitesi'],
                ['title' => ['tr' => 'Kişisel Web Sitesi', 'en' => 'Personal Website'], 'url' => '/kisisel-web-sitesi'],
                ['title' => ['tr' => 'Landing Page', 'en' => 'Landing Page'], 'url' => '/landing-page'],
            ]);

            // KOLON 2: YAZILIM ÇÖZÜMLERİ
            $yazilimCozumleri = $this->makeMegaColumn(
                $menu,
                $hizmetler->id,
                ['tr' => 'Yazılım Çözümleri', 'en' => 'Software Solutions'],
                'fas fa-code',
                ['tr' => 'Özel yazılım geliştirme', 'en' => 'Custom software development'],
                2
            );

            $this->megaColumnItems($menu, $yazilimCozumleri->id, [
                ['title' => ['tr' => 'Özel Yazılım Geliştirme', 'en' => 'Custom Software'], 'url' => '/ozel-yazilim-gelistirme'],
                ['title' => ['tr' => 'Mobil Uygulamalar', 'en' => 'Mobile Apps'], 'url' => '/mobil-uygulamalar'],
                ['title' => ['tr' => 'API Entegrasyonları', 'en' => 'API Integrations'], 'url' => '/api-entegrasyonlari'],
                ['title' => ['tr' => 'CRM Sistemleri', 'en' => 'CRM Systems'], 'url' => '/crm-sistemleri'],
            ]);

            // KOLON 3: DİJİTAL PAZARLAMA
            $dijitalPazarlama = $this->makeMegaColumn(
                $menu,
                $hizmetler->id,
                ['tr' => 'Dijital Pazarlama', 'en' => 'Digital Marketing'],
                'fas fa-bullhorn',
                ['tr' => 'Online pazarlama hizmetleri', 'en' => 'Online marketing services'],
                3
            );

            $this->megaColumnItems($menu, $dijitalPazarlama->id, [
                ['title' => ['tr' => 'SEO Hizmetleri', 'en' => 'SEO Services'], 'url' => '/seo-hizmetleri'],
                ['title' => ['tr' => 'Google Ads', 'en' => 'Google Ads'], 'url' => '/google-ads'],
                ['title' => ['tr' => 'Sosyal Medya Yönetimi', 'en' => 'Social Media'], 'url' => '/sosyal-medya-yonetimi'],
                ['title' => ['tr' => 'İçerik Pazarlama', 'en' => 'Content Marketing'], 'url' => '/icerik-pazarlama'],
            ]);

            // KOLON 4: TASARIM & OPTİMİZASYON
            $tasarimOptimizasyon = $this->makeMegaColumn(
                $menu,
                $hizmetler->id,
                ['tr' => 'Tasarım & Optimizasyon', 'en' => 'Design & Optimization'],
                'fas fa-palette',
                ['tr' => 'Görsel ve performans', 'en' => 'Visual and performance'],
                4
            );

            $this->megaColumnItems($menu, $tasarimOptimizasyon->id, [
                ['title' => ['tr' => 'UI/UX Tasarım', 'en' => 'UI/UX Design'], 'url' => '/ui-ux-tasarim'],
                ['title' => ['tr' => 'Grafik Tasarım', 'en' => 'Graphic Design'], 'url' => '/grafik-tasarim'],
                ['title' => ['tr' => 'Hız Optimasyonu', 'en' => 'Speed Optimization'], 'url' => '/hiz-optimasyonu'],
                ['title' => ['tr' => 'SEO Optimasyonu', 'en' => 'SEO Optimization'], 'url' => '/seo-optimasyonu'],
            ]);

            // ===============================
            // KURUMSAL - NORMAL DROPDOWN
            // ===============================
            $this->children($menu, $kurumsal->id, [
                ['title' => ['tr' => 'Hakkımızda', 'en' => 'About Us'], 'url' => '/hakkimizda'],
                ['title' => ['tr' => 'Gizlilik Politikası', 'en' => 'Privacy Policy'], 'url' => '/gizlilik-politikasi'],
                ['title' => ['tr' => 'KVKK', 'en' => 'KVKK'], 'url' => '/kvkk-aydinlatma-metni'],
            ]);

            // ===============================
            // FOOTER MENÜSÜ (footer-explore)
            // ===============================
            $footerMenu = Menu::where('slug', 'footer-explore')->first();
            if ($footerMenu) {
                MenuItem::where('menu_id', $footerMenu->id)->delete();
                
                $footerOrder = 1;
                $this->makeItem($footerMenu, ['tr' => 'Ana Sayfa', 'en' => 'Home'], '/', $footerOrder++);
                $this->makeItem($footerMenu, ['tr' => 'Hizmetlerimiz', 'en' => 'Services'], '/hizmetlerimiz', $footerOrder++);
                $this->makeItem($footerMenu, ['tr' => 'Hakkımızda', 'en' => 'About'], '/hakkimizda', $footerOrder++);
                $this->makeItem($footerMenu, ['tr' => 'Blog', 'en' => 'Blog'], '/bloglar', $footerOrder++);
                $this->makeItem($footerMenu, ['tr' => 'İletişim', 'en' => 'Contact'], '/iletisim', $footerOrder++);
            }
        });
    }

    private function makeItem(Menu $menu, array $titles, ?string $url, int $order, ?int $parentId = null): MenuItem
    {
        $item = MenuItem::create([
            'menu_id'       => $menu->id,
            'parent_id'     => $parentId,
            'title'         => '',
            'url'           => $url,
            'target'        => '_self',
            'order'         => $order,
            'is_mega_menu'  => false,
            'column_width'  => 1,
        ]);
        $item->setTranslations('title', $titles);
        $item->save();
        return $item;
    }

    private function makeMegaMenuItem(Menu $menu, array $titles, ?string $url, int $order): MenuItem
    {
        $item = MenuItem::create([
            'menu_id'       => $menu->id,
            'parent_id'     => null,
            'title'         => '',
            'url'           => $url,
            'target'        => '_self',
            'order'         => $order,
            'is_mega_menu'  => true,
            'column_width'  => 4,
        ]);
        $item->setTranslations('title', $titles);
        $item->save();
        return $item;
    }

    private function makeMegaColumn(Menu $menu, int $parentId, array $titles, string $icon, array $descriptions, int $order): MenuItem
    {
        $item = MenuItem::create([
            'menu_id'       => $menu->id,
            'parent_id'     => $parentId,
            'title'         => '',
            'url'           => '#',
            'target'        => '_self',
            'order'         => $order,
            'is_mega_menu'  => false,
            'icon'          => $icon,
            'description'   => '',
            'column_width'  => 1,
        ]);
        $item->setTranslations('title', $titles);
        $item->setTranslations('description', $descriptions);
        $item->save();
        return $item;
    }

    private function megaColumnItems(Menu $menu, int $parentId, array $items): void
    {
        $order = 1;
        foreach ($items as $data) {
            $item = MenuItem::create([
                'menu_id'       => $menu->id,
                'parent_id'     => $parentId,
                'title'         => '',
                'url'           => $data['url'],
                'target'        => '_self',
                'order'         => $order++,
                'is_mega_menu'  => false,
                'column_width'  => 1,
            ]);
            $item->setTranslations('title', $data['title']);
            $item->save();
        }
    }

    private function children(Menu $menu, int $parentId, array $items): void
    {
        $order = 1;
        foreach ($items as $data) {
            $this->makeItem($menu, $data['title'], $data['url'], $order++, $parentId);
        }
    }
}