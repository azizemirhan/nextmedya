<?php
// app/Helpers/PageBuilderHelper.php

namespace App\Helpers;

use App\Models\MediaFolder;

class PageBuilderHelper
{
    /**
     * Page Builder'daki select alanları için medya klasörlerini listeler.
     * Dönen format: [ 1 => 'Rulmanlar', 2 => 'Keçeler' ]
     */
    public static function getMediaFoldersForSelect()
    {
        return MediaFolder::orderBy('name')->pluck('name', 'id');
    }
}
