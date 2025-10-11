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
            // 1) İlk yaratmada NAME zorunlu: string veriyoruz
            // Header'da \App\Models\Menu::render('main-menu') kullandığın için slug 'main-menu'
            $menu = Menu::firstOrCreate(
                ['slug' => 'main-menu'],
                ['name' => 'Primary Menu']   // <- NOT NULL hatasını burada çözüyoruz
            );

            // Ardından Spatie ile çevirileri set et (kolon ister string ister json olsun çalışır)
            $menu->setTranslations('name', [
                'tr' => 'Birincil Menü',
                'en' => 'Primary Menu',
            ]);
            $menu->save();

            // 2) Eski item'ları temizle
            $menu->items()->delete();

            // 3) Kök öğeler
            $order = 1;
            $home       = $this->makeItem($menu, 'Ana Sayfa',        '/',              $order++);
            $kurumsal   = $this->makeItem($menu, 'Kurumsal',         '/kurumsal',      $order++);
            $hizmetler  = $this->makeItem($menu, 'Hizmetlerimiz',    '/hizmetlerimiz', $order++);
            $projeler   = $this->makeItem($menu, 'Projelerimiz',     '/projelerimiz',  $order++);
            $blog       = $this->makeItem($menu, 'Blog / Haberler',  '/blog',          $order++);
            $iletisim   = $this->makeItem($menu, 'İletişim',         '/iletisim',      $order++);

            // 4) Alt öğeler — Kurumsal
            $this->children($menu, $kurumsal->id, [
                ['Hakkımızda',                  '/kurumsal/hakkimizda'],
                ['Vizyonumuz & Misyonumuz',     '/kurumsal/vizyon-misyon'],
                ['Kalite ve Çevre Politikamız', '/kurumsal/kalite-cevre-politikamiz'],
            ]);

            // 5) Alt öğeler — Hizmetlerimiz
            $this->children($menu, $hizmetler->id, [
                ['Müteahhitlik Hizmetleri',         '/hizmetlerimiz/muteahhitlik-hizmetleri'],
                ['Kentsel Dönüşüm',                 '/hizmetlerimiz/kentsel-donusum'],
                ['Kat Karşılığı Projeler',          '/hizmetlerimiz/kat-karsiligi-projeler'],
                ['Anahtar Teslim Projeler',         '/hizmetlerimiz/anahtar-teslim-projeler'],
                ['Proje Geliştirme ve Danışmanlık', '/hizmetlerimiz/proje-gelistirme-danismanlik'],
            ]);
        });
    }

    private function makeItem(Menu $menu, string $titleTr, ?string $url, int $order, ?int $parentId = null): MenuItem
    {
        // İlk kayıt: title'ı boş string ver (NOT NULL ise sorun çıkmasın)
        $item = MenuItem::create([
            'menu_id'   => $menu->id,
            'parent_id' => $parentId,
            'title'     => '',          // <- sonra Spatie ile dolduracağız
            'url'       => $url,
            'page_id'   => null,
            'target'    => '_self',
            'classes'   => null,
            'rel'       => null,
            'order'     => $order,
        ]);

        // Spatie çevirileri
        $item->setTranslations('title', ['tr' => $titleTr]);
        $item->save();

        return $item;
    }

    private function children(Menu $menu, int $parentId, array $rows): void
    {
        $i = 1;
        foreach ($rows as [$title, $url]) {
            $this->makeItem($menu, $title, $url, $i++, $parentId);
        }
    }
}
