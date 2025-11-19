<?php
namespace App\PageBuilder;
use App\Models\PageSection;
use App\Models\Feature; // Feature modeliniz

class FeaturesListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        return Feature::orderBy('order')->get();
    }
}
