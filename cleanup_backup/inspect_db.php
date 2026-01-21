<?php

use App\Models\Slider;
use App\Models\PageSection;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- SLIDERS ---\n";
$sliders = Slider::all();
foreach ($sliders as $slider) {
    echo "ID: {$slider->id} | Image: " . json_encode($slider->image_path) . "\n";
}

echo "\n--- PAGE SECTIONS (First 5) ---\n";
$sections = PageSection::take(5)->get();
foreach ($sections as $section) {
    echo "ID: {$section->id} | Content Preview: " . substr(json_encode($section->content), 0, 200) . "...\n";
}
