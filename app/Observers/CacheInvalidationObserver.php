<?php

namespace App\Observers;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * CacheInvalidationObserver
 *
 * Model değişikliklerinde ilgili cache'leri otomatik olarak temizler.
 * Bu observer birden fazla modele attach edilebilir.
 */
class CacheInvalidationObserver
{
    protected CacheService $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Model oluşturulduğunda
     */
    public function created(Model $model): void
    {
        $this->invalidateCache($model, 'created');
    }

    /**
     * Model güncellendiğinde
     */
    public function updated(Model $model): void
    {
        $this->invalidateCache($model, 'updated');
    }

    /**
     * Model silindiğinde
     */
    public function deleted(Model $model): void
    {
        $this->invalidateCache($model, 'deleted');
    }

    /**
     * Model geri yüklendiğinde (soft delete)
     */
    public function restored(Model $model): void
    {
        $this->invalidateCache($model, 'restored');
    }

    /**
     * Model tipine göre ilgili cache'leri temizle
     */
    protected function invalidateCache(Model $model, string $event): void
    {
        $modelClass = get_class($model);
        
        try {
            match ($modelClass) {
                \App\Models\Post::class => $this->handlePostChange($model, $event),
                \App\Models\Page::class => $this->handlePageChange($model, $event),
                \App\Models\Service::class => $this->handleServiceChange($model, $event),
                \App\Models\Category::class => $this->handleCategoryChange($model, $event),
                \App\Models\Tag::class => $this->handleTagChange($model, $event),
                \App\Models\Menu::class, \App\Models\MenuItem::class => $this->handleMenuChange($model, $event),
                \App\Models\Setting::class => $this->handleSettingChange($model, $event),
                default => null,
            };
            
            Log::debug("CacheInvalidation: {$modelClass} {$event} - cache cleared");
        } catch (\Exception $e) {
            Log::error("CacheInvalidation failed for {$modelClass}: " . $e->getMessage());
        }
    }

    /**
     * Post değişikliklerinde sidebar ve content cache'lerini temizle
     */
    protected function handlePostChange(Model $post, string $event): void
    {
        // Sidebar'daki recent posts ve category counts etkilenir
        $this->cacheService->clearSidebar();
        
        // İleride post detay sayfası cache'lenirse onu da temizle
        // $this->cacheService->forget("posts:{$post->slug}");
    }

    /**
     * Page değişikliklerinde page cache'ini temizle
     */
    protected function handlePageChange(Model $page, string $event): void
    {
        // Page cache'i varsa temizle
        $this->cacheService->forgetByPrefix('pages');
    }

    /**
     * Service değişikliklerinde service cache'ini temizle
     */
    protected function handleServiceChange(Model $service, string $event): void
    {
        $this->cacheService->forgetByPrefix('services');
    }

    /**
     * Category değişikliklerinde sidebar cache'ini temizle
     */
    protected function handleCategoryChange(Model $category, string $event): void
    {
        $this->cacheService->clearSidebar();
    }

    /**
     * Tag değişikliklerinde sidebar cache'ini temizle
     */
    protected function handleTagChange(Model $tag, string $event): void
    {
        $this->cacheService->clearSidebar();
    }

    /**
     * Menu/MenuItem değişikliklerinde menü cache'ini temizle
     */
    protected function handleMenuChange(Model $model, string $event): void
    {
        // Tüm menü cache'lerini temizle
        $this->cacheService->clearMenu();
    }

    /**
     * Setting değişikliklerinde settings cache'ini temizle
     */
    protected function handleSettingChange(Model $setting, string $event): void
    {
        $this->cacheService->clearSettings();
    }
}
