<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageOptimizationService;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ConvertImagesToWebP extends Command
{
    protected $signature = 'images:convert-webp {--dry-run : Show what would be converted without converting}';
    protected $description = 'Convert all existing images to WebP format';

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $imageManager = new ImageManager(new Driver());

        // Directories to scan
        $directories = [
            'public/uploads',
            'public/site',
            'public/backend',
        ];

        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $totalConverted = 0;
        $totalSkipped = 0;

        $this->info($dryRun ? '🔍 DRY RUN - No files will be converted' : '🚀 Starting WebP conversion...');
        $this->newLine();

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                $this->warn("⚠️  Directory not found: {$directory}");
                continue;
            }

            $this->info("📁 Scanning: {$directory}");

            foreach ($extensions as $ext) {
                $pattern = $directory . '/**/*.' . $ext;
                $files = glob($pattern, GLOB_BRACE);

                foreach ($files as $file) {
                    $webpPath = preg_replace('/\.(jpg|jpeg|png|gif)$/i', '.webp', $file);

                    // Skip if WebP already exists
                    if (file_exists($webpPath)) {
                        $totalSkipped++;
                        continue;
                    }

                    $relativeFile = str_replace(base_path() . '/', '', $file);

                    if ($dryRun) {
                        $this->line("  → Would convert: {$relativeFile}");
                        $totalConverted++;
                    } else {
                        try {
                            $image = $imageManager->read($file);
                            $image->toWebp(85)->save($webpPath);

                            $this->line("  ✓ Converted: {$relativeFile}");
                            $totalConverted++;
                        } catch (\Exception $e) {
                            $this->error("  ✗ Failed: {$relativeFile} - " . $e->getMessage());
                        }
                    }
                }
            }
        }

        $this->newLine();
        $this->info("📊 Summary:");
        $this->info("  ✓ Converted: {$totalConverted} images");
        $this->info("  ⊘ Skipped: {$totalSkipped} images (already have WebP)");

        if ($dryRun) {
            $this->newLine();
            $this->warn('ℹ️  This was a dry run. Run without --dry-run to actually convert images.');
        }

        return 0;
    }
}
