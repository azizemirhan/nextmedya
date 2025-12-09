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

            // 2) Eski item'ları temizle
            $menu->items()->delete();

            // 3) KÖK MENÜLER
            $order = 1;

            // Ana Sayfa
            $home = $this->makeItem(
                $menu,
                ['tr' => 'Ana Sayfa', 'en' => 'Home'],
                '/',
                $order++
            );

            // WEB ÇÖZÜMLERİ - MEGA MENU
            $webCozumleri = $this->makeMegaMenuItem(
                $menu,
                ['tr' => 'Web Çözümleri', 'en' => 'Web Solutions'],
                '#',
                $order++
            );

            // HİZMETLERİMİZ - Normal Dropdown
            $hizmetler = $this->makeItem(
                $menu,
                ['tr' => 'Hizmetlerimiz', 'en' => 'Our Services'],
                '/hizmetlerimiz',
                $order++
            );

            // FİYATLAR
            $fiyatlar = $this->makeItem(
                $menu,
                ['tr' => 'Fiyatlar', 'en' => 'Pricing'],
                '/fiyatlar',
                $order++
            );

            // REFERANSLAR
            $referanslar = $this->makeItem(
                $menu,
                ['tr' => 'Referanslar', 'en' => 'References'],
                '/referanslar',
                $order++
            );

            // BLOG
            $blog = $this->makeItem(
                $menu,
                ['tr' => 'Blog', 'en' => 'Blog'],
                '/blog',
                $order++
            );

            // İLETİŞİM
            $iletisim = $this->makeItem(
                $menu,
                ['tr' => 'İletişim', 'en' => 'Contact'],
                '/iletisim',
                $order++
            );

            // ===============================
            // WEB ÇÖZÜMLERİ - MEGA MENU KOLONLARI
            // ===============================

            // KOLON 1: PAKETLER
            $paketler = $this->makeMegaColumn(
                $menu,
                $webCozumleri->id,
                ['tr' => 'Paketler', 'en' => 'Packages'],
                'fas fa-box',
                ['tr' => 'Hazır çözümlerimiz', 'en' => 'Ready solutions'],
                1
            );

            $this->megaColumnItems($menu, $paketler->id, [
                [
                    'title' => ['tr' => 'Kurumsal Web Sitesi', 'en' => 'Corporate Website'],
                    'url' => '/web-cozumleri/kurumsal-web-sitesi',
                    'description' => ['tr' => 'Profesyonel firmanız için özel tasarım', 'en' => 'Custom design for your professional company']
                ],
                [
                    'title' => ['tr' => 'E-Ticaret Sitesi', 'en' => 'E-Commerce Website'],
                    'url' => '/web-cozumleri/e-ticaret-sitesi',
                    'description' => ['tr' => 'Online satış yapabileceğiniz platform', 'en' => 'Platform to sell online']
                ],
                [
                    'title' => ['tr' => 'Kişisel Web Sitesi', 'en' => 'Personal Website'],
                    'url' => '/web-cozumleri/kisisel-web-sitesi',
                    'description' => ['tr' => 'Portfolyo ve kişisel markalaşma', 'en' => 'Portfolio and personal branding']
                ],
                [
                    'title' => ['tr' => 'Landing Page', 'en' => 'Landing Page'],
                    'url' => '/web-cozumleri/landing-page',
                    'description' => ['tr' => 'Kampanyalara özel tek sayfa tasarım', 'en' => 'Single page design for campaigns']
                ],
            ]);

            // KOLON 2: ÇÖZÜMLER
            $cozumler = $this->makeMegaColumn(
                $menu,
                $webCozumleri->id,
                ['tr' => 'Çözümler', 'en' => 'Solutions'],
                'fas fa-tools',
                ['tr' => 'Özel yazılımlar', 'en' => 'Custom software'],
                2
            );

            $this->megaColumnItems($menu, $cozumler->id, [
                [
                    'title' => ['tr' => 'Özel Yazılım Geliştirme', 'en' => 'Custom Software Development'],
                    'url' => '/web-cozumleri/ozel-yazilim',
                    'description' => ['tr' => 'İhtiyacınıza özel web uygulamaları', 'en' => 'Custom web applications']
                ],
                [
                    'title' => ['tr' => 'Mobil Uygulamalar', 'en' => 'Mobile Applications'],
                    'url' => '/web-cozumleri/mobil-uygulamalar',
                    'description' => ['tr' => 'iOS ve Android uygulama geliştirme', 'en' => 'iOS and Android app development']
                ],
                [
                    'title' => ['tr' => 'API Entegrasyonları', 'en' => 'API Integrations'],
                    'url' => '/web-cozumleri/api-entegrasyonlari',
                    'description' => ['tr' => 'Üçüncü parti sistemlerle entegrasyon', 'en' => 'Third-party system integration']
                ],
                [
                    'title' => ['tr' => 'CRM Sistemleri', 'en' => 'CRM Systems'],
                    'url' => '/web-cozumleri/crm-sistemleri',
                    'description' => ['tr' => 'Müşteri ilişkileri yönetim sistemi', 'en' => 'Customer relationship management']
                ],
            ]);

            // KOLON 3: TASARIM
            $tasarim = $this->makeMegaColumn(
                $menu,
                $webCozumleri->id,
                ['tr' => 'Tasarım', 'en' => 'Design'],
                'fas fa-palette',
                ['tr' => 'Görsel çözümler', 'en' => 'Visual solutions'],
                3
            );

            $this->megaColumnItems($menu, $tasarim->id, [
                [
                    'title' => ['tr' => 'UI/UX Tasarım', 'en' => 'UI/UX Design'],
                    'url' => '/web-cozumleri/ui-ux-tasarim',
                    'description' => ['tr' => 'Kullanıcı deneyimi odaklı arayüzler', 'en' => 'User experience focused interfaces']
                ],
                [
                    'title' => ['tr' => 'Responsive Tasarım', 'en' => 'Responsive Design'],
                    'url' => '/web-cozumleri/responsive-tasarim',
                    'description' => ['tr' => 'Tüm cihazlarda uyumlu görünüm', 'en' => 'Compatible view on all devices']
                ],
                [
                    'title' => ['tr' => 'Grafik Tasarım', 'en' => 'Graphic Design'],
                    'url' => '/web-cozumleri/grafik-tasarim',
                    'description' => ['tr' => 'Logo, banner ve görsel tasarımlar', 'en' => 'Logo, banner and visual designs']
                ],
                [
                    'title' => ['tr' => 'Web Animasyonları', 'en' => 'Web Animations'],
                    'url' => '/web-cozumleri/web-animasyonlari',
                    'description' => ['tr' => 'Etkileyici hareket ve geçişler', 'en' => 'Impressive motions and transitions']
                ],
            ]);

            // KOLON 4: OPTİMİZASYON
            $optimizasyon = $this->makeMegaColumn(
                $menu,
                $webCozumleri->id,
                ['tr' => 'Optimizasyon', 'en' => 'Optimization'],
                'fas fa-bolt',
                ['tr' => 'Performans artışı', 'en' => 'Performance boost'],
                4
            );

            $this->megaColumnItems($menu, $optimizasyon->id, [
                [
                    'title' => ['tr' => 'Hız Optimizasyonu', 'en' => 'Speed Optimization'],
                    'url' => '/web-cozumleri/hiz-optimizasyonu',
                    'description' => ['tr' => 'Sayfa yükleme hızını artırın', 'en' => 'Increase page loading speed']
                ],
                [
                    'title' => ['tr' => 'SEO Optimizasyonu', 'en' => 'SEO Optimization'],
                    'url' => '/web-cozumleri/seo-optimizasyonu',
                    'description' => ['tr' => 'Arama motoru dostu yapılandırma', 'en' => 'Search engine friendly structure']
                ],
                [
                    'title' => ['tr' => 'Güvenlik Testleri', 'en' => 'Security Tests'],
                    'url' => '/web-cozumleri/guvenlik-testleri',
                    'description' => ['tr' => 'Siber güvenlik ve SSL sertifikası', 'en' => 'Cyber security and SSL certificate']
                ],
                [
                    'title' => ['tr' => 'Performans Analizi', 'en' => 'Performance Analysis'],
                    'url' => '/web-cozumleri/performans-analizi',
                    'description' => ['tr' => 'Detaylı raporlama ve iyileştirme', 'en' => 'Detailed reporting and improvement']
                ],
            ]);

            // ===============================
            // HİZMETLERİMİZ - NORMAL DROPDOWN
            // ===============================
            $this->children($menu, $hizmetler->id, [
                [
                    'title' => ['tr' => 'SEO Hizmetleri', 'en' => 'SEO Services'],
                    'url' => '/hizmetlerimiz/seo-hizmetleri'
                ],
                [
                    'title' => ['tr' => 'Dijital Pazarlama', 'en' => 'Digital Marketing'],
                    'url' => '/hizmetlerimiz/dijital-pazarlama'
                ],
                [
                    'title' => ['tr' => 'Sosyal Medya Yönetimi', 'en' => 'Social Media Management'],
                    'url' => '/hizmetlerimiz/sosyal-medya-yonetimi'
                ],
                [
                    'title' => ['tr' => 'Google Ads', 'en' => 'Google Ads'],
                    'url' => '/hizmetlerimiz/google-ads'
                ],
                [
                    'title' => ['tr' => 'İçerik Pazarlama', 'en' => 'Content Marketing'],
                    'url' => '/hizmetlerimiz/icerik-pazarlama'
                ],
            ]);
        });
    }

    /**
     * Normal menü öğesi oluştur
     */
    private function makeItem(
        Menu $menu,
        array $titles,
        ?string $url,
        int $order,
        ?int $parentId = null
    ): MenuItem {
        $item = MenuItem::create([
            'menu_id'       => $menu->id,
            'parent_id'     => $parentId,
            'title'         => '',
            'url'           => $url,
            'page_id'       => null,
            'service_id'    => null,
            'target'        => '_self',
            'classes'       => null,
            'rel'           => null,
            'order'         => $order,
            'is_mega_menu'  => false,
            'icon'          => null,
            'description'   => null,
            'column_width'  => 1,
        ]);

        $item->setTranslations('title', $titles);
        $item->save();

        return $item;
    }

    /**
     * Mega menü ana öğesi oluştur
     */
    private function makeMegaMenuItem(
        Menu $menu,
        array $titles,
        ?string $url,
        int $order
    ): MenuItem {
        $item = MenuItem::create([
            'menu_id'       => $menu->id,
            'parent_id'     => null,
            'title'         => '',
            'url'           => $url,
            'page_id'       => null,
            'service_id'    => null,
            'target'        => '_self',
            'classes'       => null,
            'rel'           => null,
            'order'         => $order,
            'is_mega_menu'  => true, // MEGA MENU AKTİF
            'icon'          => null,
            'description'   => null,
            'column_width'  => 4,
        ]);

        $item->setTranslations('title', $titles);
        $item->save();

        return $item;
    }

    /**
     * Mega menü kolonu oluştur
     */
    private function makeMegaColumn(
        Menu $menu,
        int $parentId,
        array $titles,
        string $icon,
        array $descriptions,
        int $order
    ): MenuItem {
        $item = MenuItem::create([
            'menu_id'       => $menu->id,
            'parent_id'     => $parentId,
            'title'         => '',
            'url'           => '#',
            'page_id'       => null,
            'service_id'    => null,
            'target'        => '_self',
            'classes'       => null,
            'rel'           => null,
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

    /**
     * Mega menü kolon içindeki öğeler
     */
    private function megaColumnItems(Menu $menu, int $parentId, array $items): void
    {
        $order = 1;
        foreach ($items as $data) {
            $item = MenuItem::create([
                'menu_id'       => $menu->id,
                'parent_id'     => $parentId,
                'title'         => '',
                'url'           => $data['url'],
                'page_id'       => null,
                'service_id'    => null,
                'target'        => '_self',
                'classes'       => null,
                'rel'           => null,
                'order'         => $order++,
                'is_mega_menu'  => false,
                'icon'          => null,
                'description'   => '',
                'column_width'  => 1,
            ]);

            $item->setTranslations('title', $data['title']);
            if (isset($data['description'])) {
                $item->setTranslations('description', $data['description']);
            }
            $item->save();
        }
    }

    /**
     * Normal dropdown alt öğeler
     */
    private function children(Menu $menu, int $parentId, array $items): void
    {
        $order = 1;
        foreach ($items as $data) {
            $this->makeItem($menu, $data['title'], $data['url'], $order++, $parentId);
        }
    }
}