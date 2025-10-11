<?php
namespace App\PageBuilder;
use App\Models\PageSection;
use App\Models\Statistic; // Statistic modeliniz

class StatisticsListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        return Statistic::orderBy('order')->get();
    }
}
