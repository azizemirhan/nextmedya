<?php
// app/Providers/PluginServiceProvider.php

namespace App\Providers;

use App\Models\Plugin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Aktif eklentilerin service provider'larını register et
        $this->registerActivePlugins();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Aktif eklentileri boot et
        $this->bootActivePlugins();

        // Plugin view'lerini yükle
        $this->loadPluginViews();

        // Plugin route'larını yükle
        $this->loadPluginRoutes();

        // Plugin config'lerini yükle
        $this->loadPluginConfigs();

        // Plugin translation'larını yükle
        $this->loadPluginTranslations();
    }

    /**
     * Aktif eklentileri register et
     */
    protected function registerActivePlugins()
    {
        try {
            $activePlugins = Plugin::where('is_active', true)
                ->where('is_installed', true)
                ->get();

            foreach ($activePlugins as $plugin) {
                if ($plugin->provider_class && $plugin->namespace) {
                    $providerClass = $plugin->namespace . '\\Providers\\' . $plugin->provider_class;

                    if (class_exists($providerClass)) {
                        $this->app->register($providerClass);
                    }
                }
            }
        } catch (\Exception $e) {
            // Veritabanı henüz hazır değilse sessizce geç
        }
    }

    /**
     * Aktif eklentileri boot et
     */
    protected function bootActivePlugins()
    {
        try {
            $activePlugins = Plugin::where('is_active', true)
                ->where('is_installed', true)
                ->get();

            foreach ($activePlugins as $plugin) {
                $bootstrapFile = base_path('plugins/' . $plugin->slug . '/bootstrap.php');

                if (File::exists($bootstrapFile)) {
                    require_once $bootstrapFile;
                }
            }
        } catch (\Exception $e) {
            // Veritabanı henüz hazır değilse sessizce geç
        }
    }

    /**
     * Plugin view'lerini yükle
     */
    protected function loadPluginViews()
    {
        try {
            $activePlugins = Plugin::where('is_active', true)
                ->where('is_installed', true)
                ->get();

            foreach ($activePlugins as $plugin) {
                $viewsPath = base_path('plugins/' . $plugin->slug . '/resources/views');

                if (File::exists($viewsPath)) {
                    View::addNamespace('plugin_' . $plugin->slug, $viewsPath);
                }
            }
        } catch (\Exception $e) {
            // Sessizce geç
        }
    }

    /**
     * Plugin route'larını yükle
     */
    protected function loadPluginRoutes()
    {
        try {
            $activePlugins = Plugin::where('is_active', true)
                ->where('is_installed', true)
                ->get();

            foreach ($activePlugins as $plugin) {
                // Web routes
                $webRoutesFile = base_path('plugins/' . $plugin->slug . '/routes/web.php');
                if (File::exists($webRoutesFile)) {
                    Route::middleware('web')
                        ->prefix('plugin/' . $plugin->slug)
                        ->name('plugin.' . $plugin->slug . '.')
                        ->group($webRoutesFile);
                }

                // API routes
                $apiRoutesFile = base_path('plugins/' . $plugin->slug . '/routes/api.php');
                if (File::exists($apiRoutesFile)) {
                    Route::middleware('api')
                        ->prefix('api/plugin/' . $plugin->slug)
                        ->name('api.plugin.' . $plugin->slug . '.')
                        ->group($apiRoutesFile);
                }
            }
        } catch (\Exception $e) {
            // Sessizce geç
        }
    }

    /**
     * Plugin config'lerini yükle
     */
    protected function loadPluginConfigs()
    {
        try {
            $activePlugins = Plugin::where('is_active', true)
                ->where('is_installed', true)
                ->get();

            foreach ($activePlugins as $plugin) {
                $configPath = base_path('plugins/' . $plugin->slug . '/config');

                if (File::exists($configPath)) {
                    $configFiles = File::files($configPath);

                    foreach ($configFiles as $configFile) {
                        $configName = 'plugin_' . $plugin->slug . '_' . basename($configFile, '.php');
                        $this->mergeConfigFrom($configFile->getPathname(), $configName);
                    }
                }
            }
        } catch (\Exception $e) {
            // Sessizce geç
        }
    }

    /**
     * Plugin translation'larını yükle
     */
    protected function loadPluginTranslations()
    {
        try {
            $activePlugins = Plugin::where('is_active', true)
                ->where('is_installed', true)
                ->get();

            foreach ($activePlugins as $plugin) {
                $langPath = base_path('plugins/' . $plugin->slug . '/resources/lang');

                if (File::exists($langPath)) {
                    $this->loadTranslationsFrom($langPath, 'plugin_' . $plugin->slug);
                }
            }
        } catch (\Exception $e) {
            // Sessizce geç
        }
    }
}
