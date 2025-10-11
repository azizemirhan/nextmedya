<?php

namespace App\PageBuilder;

use App\Models\PageSection;
use App\Models\Post; // Kendi Post modelinizin yolunu belirtin

class LatestPostsHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        // Admin panelinden gelen content'ten gösterilecek yazı sayısını al, yoksa 3 kabul et
        $postCount = $section->content['post_count'] ?? 3;

        // İlgili sorguyu çalıştır ve sonucu döndür
        return Post::where('status', 'published')
            ->latest()
            ->take($postCount)
            ->get();
    }
}
