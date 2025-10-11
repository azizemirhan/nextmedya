<?php
namespace App\PageBuilder;
use App\Models\Faq;
use App\Models\PageSection;

class FaqListHandler implements DataHandlerInterface {
    public function handle(PageSection $section): object {
        $count = $section->content['faq_count'] ?? 10;
        return Faq::where('is_active', true)->orderBy('order')->take($count)->get();
    }
}
