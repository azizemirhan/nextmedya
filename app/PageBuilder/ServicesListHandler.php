<?php

namespace App\PageBuilder;

use App\Models\PageSection;
use App\Models\Service;

// Kendi Service modelinizin yolunu belirtin

class ServicesListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        // Admin panelinden gelen content'ten gösterilecek hizmet sayısını al, yoksa 6 kabul et.
        $count = $section->content['service_count'] ?? 6;

        // Sorguyu güncelle ve belirtilen sayıda hizmeti al.
        return Service::orderBy('order')->take($count)->get();
    }
}
