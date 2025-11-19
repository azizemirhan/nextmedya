<?php
// app/PageBuilder/AllMediaListHandler.php

namespace App\PageBuilder;

use App\Models\PageSection;
use App\Models\Media;

class AllMediaListHandler implements DataHandlerInterface
{
    /**
     * @param PageSection $blockData
     * @return array
     */
    public function handle(PageSection $blockData): array
    {
        // MediaController'dakine benzer bir sorgu oluşturuyoruz.
        // Bu sorgu, veritabanındaki TÜM aktif ve halka açık resimleri çeker.
        $query = Media::query();

        // Sadece 'image' tipindeki medyaları al
        $query->where('type', 'image');

        // Sadece aktif olanları al (is_active = true)
        $query->where('is_active', true);

        // Sadece görünürlüğü 'public' olanları al
        $query->where('visibility', 'public');

        // Sonuçları 'order' sütununa göre sırala
        $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');

        // Tüm sonuçları al
        $images = $query->get();

        // Blade dosyasına 'images' anahtarıyla veriyi gönder
        return [
            'images' => $images,
        ];
    }
}
