<?php

namespace App\Services;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageOptimizationService
{
    protected ImageManager $imageManager;
    protected $optimizer;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
        $this->optimizer = OptimizerChainFactory::create();
    }

    /**
     * Upload and optimize image with WebP conversion
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param array $sizes Configuration for responsive sizes
     * @return array Returns paths to original and optimized versions
     */
    public function uploadAndOptimize($file, string $directory, array $sizes = []): array
    {
        $fileName = time() . '_' . \Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();

        $fullDirectory = public_path($directory);

        // Create directory if not exists
        if (!file_exists($fullDirectory)) {
            mkdir($fullDirectory, 0755, true);
        }

        $paths = [];

        // Original image
        $originalPath = "{$directory}/{$fileName}.{$extension}";
        $file->move(public_path($directory), "{$fileName}.{$extension}");

        // Optimize original
        if (config('media.optimize.enabled', true)) {
            try {
                $this->optimizer->optimize(public_path($originalPath));
            } catch (\Exception $e) {
                \Log::warning("Image optimization failed: " . $e->getMessage());
            }
        }

        $paths['original'] = $originalPath;

        // Create WebP version
        if (config('media.webp', true)) {
            $webpPath = "{$directory}/{$fileName}.webp";
            try {
                $image = $this->imageManager->read(public_path($originalPath));
                $image->toWebp(85)->save(public_path($webpPath));
                $paths['webp'] = $webpPath;
            } catch (\Exception $e) {
                \Log::warning("WebP conversion failed: " . $e->getMessage());
            }
        }

        // Create AVIF version if enabled
        if (config('media.avif', false)) {
            $avifPath = "{$directory}/{$fileName}.avif";
            try {
                $image = $this->imageManager->read(public_path($originalPath));
                $image->toAvif(80)->save(public_path($avifPath));
                $paths['avif'] = $avifPath;
            } catch (\Exception $e) {
                \Log::warning("AVIF conversion failed: " . $e->getMessage());
            }
        }

        // Create responsive sizes
        if (!empty($sizes)) {
            $paths['variants'] = $this->createResponsiveVariants($originalPath, $fileName, $directory, $sizes);
        }

        return $paths;
    }

    /**
     * Create responsive image variants
     *
     * @param string $originalPath
     * @param string $fileName
     * @param string $directory
     * @param array $sizes
     * @return array
     */
    protected function createResponsiveVariants(string $originalPath, string $fileName, string $directory, array $sizes): array
    {
        $variants = [];

        foreach ($sizes as $name => $config) {
            try {
                $image = $this->imageManager->read(public_path($originalPath));

                $width = $config['w'] ?? null;
                $height = $config['h'] ?? null;
                $fit = $config['fit'] ?? 'contain';

                if ($fit === 'cover' && $width && $height) {
                    $image->cover($width, $height);
                } elseif ($width || $height) {
                    $image->scale($width, $height);
                }

                // Save original format variant
                $variantPath = "{$directory}/{$fileName}_{$name}." . pathinfo($originalPath, PATHINFO_EXTENSION);
                $image->save(public_path($variantPath));

                // Optimize
                if (config('media.optimize.enabled', true)) {
                    $this->optimizer->optimize(public_path($variantPath));
                }

                $variants[$name] = [
                    'original' => $variantPath
                ];

                // Save WebP variant
                if (config('media.webp', true)) {
                    $webpVariantPath = "{$directory}/{$fileName}_{$name}.webp";
                    $image->toWebp(85)->save(public_path($webpVariantPath));
                    $variants[$name]['webp'] = $webpVariantPath;
                }

            } catch (\Exception $e) {
                \Log::warning("Variant creation failed for {$name}: " . $e->getMessage());
            }
        }

        return $variants;
    }

    /**
     * Delete image and all its variants
     *
     * @param string|array $paths
     * @return void
     */
    public function deleteImage($paths): void
    {
        if (is_string($paths)) {
            $this->deleteSingleFile($paths);
        } elseif (is_array($paths)) {
            foreach ($paths as $key => $value) {
                if (is_array($value)) {
                    $this->deleteImage($value);
                } else {
                    $this->deleteSingleFile($value);
                }
            }
        }
    }

    /**
     * Delete a single file
     *
     * @param string $path
     * @return void
     */
    protected function deleteSingleFile(string $path): void
    {
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    /**
     * Get picture element HTML with all formats
     *
     * @param array $paths Image paths from uploadAndOptimize
     * @param string $alt Alt text
     * @param string $class CSS classes
     * @param bool $lazy Enable lazy loading
     * @return string
     */
    public function getPictureHtml(array $paths, string $alt = '', string $class = '', bool $lazy = true): string
    {
        $html = '<picture>';

        // AVIF source (if exists)
        if (isset($paths['avif'])) {
            $html .= '<source type="image/avif" srcset="' . asset($paths['avif']) . '">';
        }

        // WebP source (if exists)
        if (isset($paths['webp'])) {
            $html .= '<source type="image/webp" srcset="' . asset($paths['webp']) . '">';
        }

        // Fallback to original
        $lazyAttr = $lazy ? ' loading="lazy"' : '';
        $html .= '<img src="' . asset($paths['original']) . '" alt="' . e($alt) . '" class="' . e($class) . '"' . $lazyAttr . '>';

        $html .= '</picture>';

        return $html;
    }
}
