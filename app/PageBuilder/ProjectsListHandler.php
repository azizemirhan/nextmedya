<?php

namespace App\PageBuilder;

use App\Models\PageSection;
use App\Models\Project;

// Project modelini import edin

class ProjectsListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        // Admin panelinden girilen content'ten ayarları al
        $perPage = $section->content['projects_per_page'] ?? 8; // Sayfa başına proje sayısı, varsayılan 8
        $onlyFeatured = $section->content['show_only_featured'] ?? false; // Sadece öne çıkanları göster durumu

        // Sorguyu başlat
        $query = Project::query();

        // Eğer 'Sadece Öne Çıkanları Göster' seçiliyse, sorguyu filtrele
        if ($onlyFeatured) {
            $query->where('is_featured', true);
        }

        // Sadece tamamlanmış projeleri al, en yeniden eskiye sırala ve SAYFALA
        return $query->where('status', 1)
            ->latest()
            ->paginate($perPage);
    }
}
