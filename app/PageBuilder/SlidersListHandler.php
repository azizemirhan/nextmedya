<?php
namespace App\PageBuilder;

use App\Models\PageSection;
use App\Models\Slider; // Kendi Slider modeliniz

class SlidersListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        return Slider::where('is_active', true)->orderBy('order')->get();
    }
}
