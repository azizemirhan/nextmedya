<?php

namespace App\PageBuilder;

use App\Models\Media;
use App\Models\PageSection;

class GalleryListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        // Admin panelinden gelen content'ten gösterilecek resim sayısını al, yoksa hepsini al.
        $count = $section->content['image_count'] ?? null;

        $query = Media::where('is_active', true)->orderBy('order');

        if ($count) {
            return $query->take($count)->get();
        }

        return $query->get();
    }
}
