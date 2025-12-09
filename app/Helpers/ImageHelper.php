<?php

if (!function_exists('optimized_image')) {
    /**
     * Get optimized image with lazy loading
     *
     * @param string $path
     * @param string $alt
     * @param string $class
     * @param bool $lazy
     * @return string
     */
    function optimized_image(string $path, string $alt = '', string $class = '', bool $lazy = true): string
    {
        if (empty($path)) {
            return '';
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $pathWithoutExt = substr($path, 0, strrpos($path, '.'));

        // Check for WebP version
        $webpPath = $pathWithoutExt . '.webp';
        $hasWebp = file_exists(public_path($webpPath));

        // Check for AVIF version
        $avifPath = $pathWithoutExt . '.avif';
        $hasAvif = file_exists(public_path($avifPath));

        if ($hasAvif || $hasWebp) {
            $html = '<picture>';

            if ($hasAvif) {
                $html .= '<source type="image/avif" srcset="' . asset($avifPath) . '">';
            }

            if ($hasWebp) {
                $html .= '<source type="image/webp" srcset="' . asset($webpPath) . '">';
            }

            $lazyAttr = $lazy ? ' loading="lazy"' : '';
            $html .= '<img src="' . asset($path) . '" alt="' . e($alt) . '" class="' . e($class) . '"' . $lazyAttr . '>';
            $html .= '</picture>';

            return $html;
        }

        // Fallback to regular img tag with lazy loading
        $lazyAttr = $lazy ? ' loading="lazy"' : '';
        return '<img src="' . asset($path) . '" alt="' . e($alt) . '" class="' . e($class) . '"' . $lazyAttr . '>';
    }
}

if (!function_exists('responsive_image')) {
    /**
     * Get responsive image with srcset
     *
     * @param string $path
     * @param array $variants ['thumb', 'medium', 'large']
     * @param string $alt
     * @param string $class
     * @param bool $lazy
     * @return string
     */
    function responsive_image(string $path, array $variants = [], string $alt = '', string $class = '', bool $lazy = true): string
    {
        if (empty($path)) {
            return '';
        }

        $directory = dirname($path);
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        $srcset = [];

        foreach ($variants as $variant => $width) {
            $variantPath = "{$directory}/{$filename}_{$variant}.{$extension}";
            if (file_exists(public_path($variantPath))) {
                $srcset[] = asset($variantPath) . " {$width}w";
            }
        }

        $srcsetAttr = !empty($srcset) ? ' srcset="' . implode(', ', $srcset) . '"' : '';
        $lazyAttr = $lazy ? ' loading="lazy"' : '';

        return '<img src="' . asset($path) . '" alt="' . e($alt) . '" class="' . e($class) . '"' . $srcsetAttr . $lazyAttr . '>';
    }
}

if (!function_exists('background_image')) {
    /**
     * Get background image with WebP fallback
     *
     * @param string $path
     * @param string $class
     * @return string
     */
    function background_image(string $path, string $class = ''): string
    {
        if (empty($path)) {
            return '';
        }

        $pathWithoutExt = substr($path, 0, strrpos($path, '.'));
        $webpPath = $pathWithoutExt . '.webp';

        if (file_exists(public_path($webpPath))) {
            $style = "background-image: url('" . asset($webpPath) . "');";
        } else {
            $style = "background-image: url('" . asset($path) . "');";
        }

        return '<div class="' . e($class) . '" style="' . $style . '"></div>';
    }
}
