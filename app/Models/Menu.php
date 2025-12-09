<?php

namespace App\Models;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasTranslations;

    protected $fillable = ['name','slug', 'placement'];

    public array $translatable = ['name'];

    protected $casts = [
        'name' => 'array', // JSON tabloya geçtiğinde otomatik encode/ decode
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    /**
     * CacheService instance'ını al
     */
    protected static function getCacheService(): CacheService
    {
        return app(CacheService::class);
    }

    public static function render(string $slug, string $view = 'frontend.partials._menu'): string
    {
        $cacheService = static::getCacheService();
        $cacheKey = $cacheService->key('menu', 'slug', $slug);

        $items = $cacheService->remember($cacheKey, 'menu', function () use ($slug) {
            $menu = static::where('slug', $slug)->first();
            
            if (!$menu) {
                return collect();
            }

            return $menu->items()
                ->whereNull('parent_id')
                ->with('childrenRecursive')
                ->get();
        }, ['navigation']);

        if (!$items || $items->count() === 0) {
            return '';
        }

        return view($view, ['items' => $items])->render();
    }

    /** İstersen header'da @if(\App\Models\Menu::existsBySlug('main-menu')) diye kullan */
    public static function existsBySlug(string $slug): bool
    {
        return static::where('slug', $slug)->exists();
    }

    /**
     * Placement'a göre menüyü render eder - CACHE'Lİ
     *
     * @param string $placement Menü konumu (örn: 'header', 'footer')
     * @param string|null $type Menü tipi ('desktop' veya 'mobile'), null ise desktop
     * @param string $view View dosyası yolu
     * @return string
     */
    public static function renderByPlacement(
        string  $placement,
        ?string $type = null,
        string  $view = 'frontend.partials._menu'
    ): string
    {
        $cacheService = static::getCacheService();
        $cacheKey = $cacheService->key('menu', $placement);

        $items = $cacheService->remember($cacheKey, 'menu', function () use ($placement) {
            $menu = static::where('placement', $placement)->first();
            
            if (!$menu) {
                return collect();
            }

            return $menu->items()
                ->whereNull('parent_id')
                ->with('childrenRecursive')
                ->get();
        }, ['navigation']);

        if (!$items || $items->count() === 0) {
            return '';
        }

        return view($view, [
            'items' => $items,
            'type' => $type ?? 'desktop'
        ])->render();
    }

    /**
     * Footer için özel menü render metodu - CACHE'Lİ
     * Footer menüleri için farklı view ve class yapısı kullanır
     *
     * @param string $placement Menü konumu (örn: 'footer', 'footer-services')
     * @param string $view Footer view dosyası yolu
     * @return string
     */
    public static function renderFooterMenu(
        string $placement,
        string $view = 'frontend.partials._footer_menu'
    ): string
    {
        $cacheService = static::getCacheService();
        $cacheKey = $cacheService->key('menu', 'footer', $placement);

        $items = $cacheService->remember($cacheKey, 'menu', function () use ($placement) {
            $menu = static::where('placement', $placement)->first();
            
            if (!$menu) {
                return collect();
            }

            return $menu->items()
                ->whereNull('parent_id')
                ->with('childrenRecursive')
                ->get();
        }, ['navigation']);

        if (!$items || $items->count() === 0) {
            return '';
        }

        return view($view, ['items' => $items])->render();
    }
}