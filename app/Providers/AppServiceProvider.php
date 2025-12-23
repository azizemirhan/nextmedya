<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Tag;
use App\Observers\CacheInvalidationObserver;
use App\Services\CacheService;
use App\View\Composers\GlobalDataComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // CacheService'i singleton olarak kaydet
        $this->app->singleton(CacheService::class, function ($app) {
            return new CacheService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Local ortamda HTTP kullan (HTTPS redirect'lerini engelle)
        if ($this->app->environment('local')) {
            \Illuminate\Support\Facades\URL::forceScheme('http');
        }

        // Cache Invalidation Observer'larını kaydet
        $this->registerCacheObservers();

        // Octane-safe View Composer kaydet
        // Bu composer her request'te fresh data sağlar
        View::composer('*', GlobalDataComposer::class);

        // Pagination için Bootstrap 5 kullan
        Paginator::useBootstrapFive();

        // Register Blade directives for image optimization
        $this->registerBladeDirectives();
    }

    /**
     * Cache Invalidation Observer'larını kaydet
     */
    private function registerCacheObservers(): void
    {
        // Observer'ı tüm ilgili modellere kaydet
        $models = [
            Post::class,
            Page::class,
            Service::class,
            Category::class,
            Tag::class,
            Menu::class,
            MenuItem::class,
            Setting::class,
        ];

        foreach ($models as $model) {
            $model::observe(CacheInvalidationObserver::class);
        }
    }

    /**
     * Register custom Blade directives for image optimization
     */
    private function registerBladeDirectives(): void
    {
        // @optimizedImage('path/to/image.jpg', 'Alt text', 'css-class')
        Blade::directive('optimizedImage', function ($expression) {
            return "<?php echo optimized_image({$expression}); ?>";
        });

        // @responsiveImage('path/to/image.jpg', ['thumb' => 320, 'medium' => 768], 'Alt text', 'css-class')
        Blade::directive('responsiveImage', function ($expression) {
            return "<?php echo responsive_image({$expression}); ?>";
        });

        // @lazyImage directive for simple lazy loading
        Blade::directive('lazyImage', function ($expression) {
            $args = explode(',', $expression);
            $path = $args[0] ?? "''";
            $alt = $args[1] ?? "''";
            $class = $args[2] ?? "''";
            return "<?php echo '<img src=\"' . asset({$path}) . '\" alt=\"' . e({$alt}) . '\" class=\"' . e({$class}) . '\" loading=\"lazy\">'; ?>";
        });
    }
}

