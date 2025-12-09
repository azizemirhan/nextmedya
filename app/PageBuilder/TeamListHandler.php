<?php
namespace App\PageBuilder;
use App\Models\PageSection;
use App\Models\TeamMember; // TeamMember modeliniz

class TeamListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        return TeamMember::orderBy('order')->get();
    }
}
