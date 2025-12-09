<?php

namespace App\PageBuilder;

use App\Models\PageSection;

interface DataHandlerInterface
{
    /**
     * Section için gerekli olan dinamik veriyi işler ve döndürür.
     *
     * @param PageSection $section Veritabanından gelen section kaydı (içinde admin panelinden girilen content bulunur)
     * @return array|object|null View'a gönderilecek olan dinamik veri
     */
    public function handle(PageSection $section);
}
