<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ResizeImages extends Command
{
    protected $signature = 'images:resize
                            {--max-width=2000 : Maximum width in pixels}
                            {--max-height=2000 : Maximum height in pixels}
                            {--quality=85 : JPEG quality (1-100)}
                            {--dry-run : Show what would be resized without resizing}';

    protected $description = 'Resize large images to reduce file size';

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $maxWidth = (int) $this->option('max-width');
        $maxHeight = (int) $this->option('max-height');
        $quality = (int) $this->option('quality');

        $imageManager = new ImageManager(new Driver());

        // Directories to scan
        $directories = [
            'public/uploads',
        ];

        $extensions = ['jpg', 'jpeg', 'png'];
        $totalResized = 0;
        $totalSkipped = 0;
        $totalSaved = 0;

        $this->info($dryRun ? '🔍 DRY RUN - No files will be resized' : '🚀 Starting image resize...');
        $this->info("📐 Max dimensions: {$maxWidth}x{$maxHeight}px");
        $this->newLine();

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                continue;
            }

            $this->info("📁 Scanning: {$directory}");

            foreach ($extensions as $ext) {
                $pattern = $directory . '/**/*.' . $ext;
                $files = glob($pattern, GLOB_BRACE);

                foreach ($files as $file) {
                    // Get original file size
                    $originalSize = filesize($file);
                    $originalSizeMB = round($originalSize / 1024 / 1024, 2);

                    // Skip small files
                    if ($originalSize < 100 * 1024) { // Less than 100KB
                        $totalSkipped++;
                        continue;
                    }

                    $relativeFile = str_replace(base_path() . '/', '', $file);

                    try {
                        $image = $imageManager->read($file);
                        $width = $image->width();
                        $height = $image->height();

                        // Check if image needs resizing
                        if ($width <= $maxWidth && $height <= $maxHeight) {
                            $totalSkipped++;
                            continue;
                        }

                        if ($dryRun) {
                            $this->line("  → Would resize: {$relativeFile} ({$width}x{$height} → {$maxWidth}x{$maxHeight})");
                            $totalResized++;
                        } else {
                            // Resize maintaining aspect ratio
                            $image->scale($maxWidth, $maxHeight);

                            // Save with optimization
                            if (in_array($ext, ['jpg', 'jpeg'])) {
                                $image->toJpeg($quality)->save($file);
                            } else {
                                $image->save($file);
                            }

                            $newSize = filesize($file);
                            $newSizeMB = round($newSize / 1024 / 1024, 2);
                            $saved = $originalSize - $newSize;
                            $savedMB = round($saved / 1024 / 1024, 2);
                            $totalSaved += $saved;

                            $this->line("  ✓ Resized: {$relativeFile}");
                            $this->line("    Before: {$originalSizeMB}MB ({$width}x{$height})");
                            $this->line("    After: {$newSizeMB}MB | Saved: {$savedMB}MB");

                            $totalResized++;
                        }
                    } catch (\Exception $e) {
                        $this->error("  ✗ Failed: {$relativeFile} - " . $e->getMessage());
                    }
                }
            }
        }

        $this->newLine();
        $this->info("📊 Summary:");
        $this->info("  ✓ Resized: {$totalResized} images");
        $this->info("  ⊘ Skipped: {$totalSkipped} images");

        if (!$dryRun && $totalSaved > 0) {
            $totalSavedMB = round($totalSaved / 1024 / 1024, 2);
            $this->info("  💾 Total saved: {$totalSavedMB}MB");
        }

        if ($dryRun) {
            $this->newLine();
            $this->warn('ℹ️  This was a dry run. Run without --dry-run to actually resize images.');
        }

        return 0;
    }
}
