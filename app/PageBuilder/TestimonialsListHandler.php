<?php
namespace App\PageBuilder;
use App\Models\PageSection;
use App\Models\Testimonial; // Testimonial modeliniz

class TestimonialsListHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        return Testimonial::where('is_active', true)->orderBy('order')->get();
    }
}
