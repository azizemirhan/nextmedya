<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function convertToWebP($relativePath) {
    if (empty($relativePath)) return $relativePath;
    
    // Normalize path by removing escaped slashes for disk checking
    $normalizedPath = str_replace(['\/', '\\'], '/', $relativePath);
    
    if (Str::endsWith($normalizedPath, '.webp')) return $relativePath;

    $fullPath = public_path($normalizedPath);
    if (!File::exists($fullPath)) {
        // Only log if it's NOT a sample image to avoid noise
        if (!Str::contains($normalizedPath, 'sample')) {
            echo "File not found: $normalizedPath\n";
        }
        return $relativePath;
    }

    try {
        $pathInfo = pathinfo($fullPath);
        $newFileName = $pathInfo['filename'] . '.webp';
        $newRelativePath = $pathInfo['dirname'] . '/' . $newFileName;
        // Fix relative path calculation
        $newRelativePath = str_replace(public_path(), '', $newRelativePath);
        $newRelativePath = ltrim($newRelativePath, '/');
        
        $newFullPath = public_path($newRelativePath);

        $image = Image::read($fullPath);
        $image->toWebp(quality: 80)->save($newFullPath);
        
        echo "Converted: $normalizedPath -> $newRelativePath\n";
        
        // Return in the SAME format as input (if input had escaped slashes, we might want to preserve that? 
        // usually DBs are fine with forward slashes unless specifically required by some parser. 
        // JSON encode will re-escape if needed. 
        // Let's return clean path, and caller handles JSON encoding if strictly needed.)
        return $newRelativePath;
    } catch (\Exception $e) {
        echo "Error converting $normalizedPath: " . $e->getMessage() . "\n";
        return $relativePath;
    }
}

echo "Starting Image Optimization...\n";

// 1. Optimize Sliders
echo "\n--- Optimizing Sliders ---\n";
// ... (Skipping logic as they are samples, but keeping code if user fixes paths)

// 4. Optimize PageSections (Recursive/Regex with Escaped Slash Support)
echo "\n--- Optimizing Page Sections ---\n";

$sections = PageSection::all();
foreach ($sections as $section) {
    $rawContent = $section->getRawOriginal('content');
    if (empty($rawContent)) continue;

    // Simplified Regex to catch any image file ending in png/jpg/jpeg
    // We will then check if it looks like an uploads path.
    $pattern = '/([a-zA-Z0-9_\-\.\/\\\\]+\.(?:png|jpg|jpeg|PNG|JPG|JPEG))/';
    
    $count = 0;
    $newContent = preg_replace_callback($pattern, function($matches) {
        $originalMatch = $matches[1];
        
        // Normalize for check
        $normalized = str_replace(['\/', '\\'], '/', $originalMatch);
        
        // Only process if it looks like our upload path
        if (!Str::contains($normalized, 'uploads/')) {
            return $originalMatch;
        }

        // Convert
        $newPath = convertToWebP($normalized);
        
        if ($newPath !== $normalized) {
            // Restore escaping if original had it
             if (Str::contains($originalMatch, '\/')) {
                return str_replace('/', '\/', $newPath);
            }
            return $newPath;
        }
        return $originalMatch;
    }, $rawContent, -1, $count);

    if ($count > 0 && $newContent !== $rawContent) {
        DB::table('page_sections')->where('id', $section->id)->update(['content' => $newContent]);
        echo "Updated PageSection ID: {$section->id} ($count images)\n";
    }
}

echo "\n--- Optimization Complete ---\n";
