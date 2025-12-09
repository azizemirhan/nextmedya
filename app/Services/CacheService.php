<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * CacheService - Merkezi cache yönetimi servisi
 *
 * Bu servis uygulama genelinde cache işlemlerini standardize eder.
 * Tag-based invalidation, TTL yönetimi ve cache warming özellikleri sunar.
 */
class CacheService
{
    /**
     * Cache driver'ın tag desteği olup olmadığını kontrol eder
     */
    protected bool $supportsTagging;

    public function __construct()
    {
        $this->supportsTagging = $this->checkTagSupport();
    }

    /**
     * Desteklenen driver'ları kontrol et (redis, memcached)
     */
    protected function checkTagSupport(): bool
    {
        $driver = config('cache.default');
        return in_array($driver, ['redis', 'memcached']);
    }

    /**
     * Cache key oluştur
     */
    public function key(string $prefix, string ...$parts): string
    {
        $configPrefix = config("cache-settings.prefixes.{$prefix}", $prefix);
        $parts = array_filter($parts);
        
        if (empty($parts)) {
            return $configPrefix;
        }
        
        return $configPrefix . ':' . implode(':', $parts);
    }

    /**
     * TTL değerini al
     */
    public function ttl(string $type): int
    {
        return config("cache-settings.ttl.{$type}", 3600);
    }

    /**
     * Cache'den veri al veya oluştur
     */
    public function remember(string $key, string $ttlType, callable $callback, array $tags = []): mixed
    {
        $ttl = $this->ttl($ttlType);

        // Tags destekleniyorsa kullan
        if ($this->supportsTagging && !empty($tags)) {
            if ($ttl === 0) {
                return Cache::tags($tags)->rememberForever($key, $callback);
            }
            return Cache::tags($tags)->remember($key, $ttl, $callback);
        }

        // Tag desteği yoksa normal cache kullan
        if ($ttl === 0) {
            return Cache::rememberForever($key, $callback);
        }
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Sonsuza kadar cache'le
     */
    public function forever(string $key, callable $callback, array $tags = []): mixed
    {
        if ($this->supportsTagging && !empty($tags)) {
            return Cache::tags($tags)->rememberForever($key, $callback);
        }
        return Cache::rememberForever($key, $callback);
    }

    /**
     * Cache'i invalidate et
     */
    public function forget(string $key, array $tags = []): bool
    {
        if ($this->supportsTagging && !empty($tags)) {
            return Cache::tags($tags)->forget($key);
        }
        return Cache::forget($key);
    }

    /**
     * Tag'a göre tüm cache'leri temizle
     */
    public function flushTags(array $tags): bool
    {
        if (!$this->supportsTagging) {
            Log::warning('CacheService: Tag flushing attempted but driver does not support tags');
            return false;
        }
        
        Cache::tags($tags)->flush();
        return true;
    }

    /**
     * Prefix'e göre cache'leri temizle (fallback for non-tag drivers)
     */
    public function forgetByPrefix(string $prefix): void
    {
        // File/database driver için prefix bazlı temizleme
        // Bu basit bir yaklaşım - gerçek uygulamada cache store'a göre farklılık gösterir
        $keys = $this->getPrefixedKeys($prefix);
        
        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Bilinen cache key'lerini toplu temizle
     */
    public function clearAll(): void
    {
        $prefixes = config('cache-settings.prefixes', []);
        
        foreach ($prefixes as $prefix) {
            $this->forgetByPrefix($prefix);
        }
    }

    /**
     * Spesifik prefix'e ait key'leri al
     * Not: Bu sadece bilinen key'ler için çalışır
     */
    protected function getPrefixedKeys(string $prefix): array
    {
        // Bilinen key pattern'leri
        $knownPatterns = [
            'menu' => ['menu:header', 'menu:footer', 'menu:main'],
            'sidebar' => ['sidebar:categories', 'sidebar:tags', 'sidebar:recent_posts'],
            'settings' => ['settings.all'],
        ];

        return $knownPatterns[$prefix] ?? [];
    }

    // =========================================================================
    // CONVENIENCE METHODS - Sık kullanılan cache işlemleri
    // =========================================================================

    /**
     * Menü cache'ini al veya oluştur
     */
    public function getMenu(string $placement, callable $callback): mixed
    {
        $key = $this->key('menu', $placement);
        return $this->remember($key, 'menu', $callback, ['navigation']);
    }

    /**
     * Menü cache'ini temizle
     */
    public function clearMenu(?string $placement = null): void
    {
        if ($placement) {
            $this->forget($this->key('menu', $placement), ['navigation']);
        } else {
            if ($this->supportsTagging) {
                $this->flushTags(['navigation']);
            } else {
                $this->forgetByPrefix('menu');
            }
        }
    }

    /**
     * Sidebar cache'ini al veya oluştur
     */
    public function getSidebar(string $type, callable $callback): mixed
    {
        $key = $this->key('sidebar', $type);
        return $this->remember($key, 'sidebar', $callback, ['navigation', 'content']);
    }

    /**
     * Sidebar cache'ini temizle
     */
    public function clearSidebar(): void
    {
        if ($this->supportsTagging) {
            // Content veya navigation değiştiğinde sidebar etkilenir
            $this->flushTags(['navigation']);
        } else {
            $this->forgetByPrefix('sidebar');
        }
    }

    /**
     * Settings cache'ini temizle
     */
    public function clearSettings(): void
    {
        Cache::forget('settings.all');
    }

    /**
     * İçerik cache'lerini temizle (posts, pages, services)
     */
    public function clearContent(): void
    {
        if ($this->supportsTagging) {
            $this->flushTags(['content']);
        } else {
            $this->forgetByPrefix('posts');
            $this->forgetByPrefix('pages');
            $this->forgetByPrefix('services');
        }
        
        // Sidebar da içerikten etkilenir
        $this->clearSidebar();
    }

    // =========================================================================
    // CACHE WARMING - Cache'leri önceden ısıt
    // =========================================================================

    /**
     * Tüm cache'leri ısıt
     */
    public function warmAll(): array
    {
        $results = [];
        
        $results['menu'] = $this->warmMenu();
        $results['sidebar'] = $this->warmSidebar();
        $results['settings'] = $this->warmSettings();
        
        return $results;
    }

    /**
     * Menü cache'lerini ısıt
     */
    public function warmMenu(): bool
    {
        try {
            $placements = ['header', 'footer'];
            
            foreach ($placements as $placement) {
                $key = $this->key('menu', $placement);
                $this->remember($key, 'menu', function () use ($placement) {
                    return \App\Models\Menu::where('placement', $placement)
                        ->with(['items' => function ($q) {
                            $q->whereNull('parent_id')->with('childrenRecursive')->orderBy('order');
                        }])
                        ->first();
                }, ['navigation']);
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error('Cache warming failed for menu: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sidebar cache'lerini ısıt
     */
    public function warmSidebar(): bool
    {
        try {
            // Categories
            $this->getSidebar('categories', function () {
                return \App\Models\Category::where('is_active', true)
                    ->withCount('posts')
                    ->orderBy('name')
                    ->get();
            });

            // Tags
            $this->getSidebar('tags', function () {
                return \App\Models\Tag::withCount('posts')
                    ->get()
                    ->sortByDesc('posts_count')
                    ->take(20);
            });

            // Recent Posts
            $this->getSidebar('recent_posts', function () {
                return \App\Models\Post::published()
                    ->select(['id', 'title', 'slug', 'featured_image', 'published_at'])
                    ->latest('published_at')
                    ->take(5)
                    ->get();
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Cache warming failed for sidebar: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Settings cache'ini ısıt
     */
    public function warmSettings(): bool
    {
        try {
            Cache::rememberForever('settings.all', function () {
                return \App\Models\Setting::all()->keyBy('key');
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Cache warming failed for settings: ' . $e->getMessage());
            return false;
        }
    }
}
