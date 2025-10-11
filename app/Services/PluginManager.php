<?php
// app/Services/PluginManager.php

namespace App\Services;

use App\Models\Plugin;
use App\Models\PluginInstallation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use ZipArchive;
use Exception;

class PluginManager
{
    protected $pluginsPath;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->pluginsPath = base_path('plugins');
        $this->apiUrl = config('plugins.api_url', 'https://plugins-api.example.com/api');
        $this->apiKey = config('plugins.api_key');

        $this->ensurePluginsDirectory();
    }

    /**
     * Plugin dizinini oluştur
     */
    protected function ensurePluginsDirectory()
    {
        if (!File::exists($this->pluginsPath)) {
            File::makeDirectory($this->pluginsPath, 0755, true);
        }
    }

    /**
     * Mevcut eklentileri API'den getir
     */
    public function fetchAvailablePlugins()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->apiUrl . '/plugins');

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('API\'den eklentiler alınamadı: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('Eklenti listesi alınamadı: ' . $e->getMessage());
        }
    }

    /**
     * Eklenti detaylarını getir
     */
    public function getPluginDetails($slug)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->apiUrl . '/plugins/' . $slug);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Eklenti detayları alınamadı');
        } catch (Exception $e) {
            throw new Exception('Eklenti detayları alınamadı: ' . $e->getMessage());
        }
    }

    /**
     * Eklentiyi indir ve yükle
     */
    public function installPlugin($slug)
    {
        try {
            // Eklenti detaylarını al
            $pluginData = $this->getPluginDetails($slug);

            // Veritabanına kaydet
            $plugin = Plugin::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $pluginData['name'],
                    'version' => $pluginData['version'],
                    'author' => $pluginData['author'] ?? null,
                    'description' => $pluginData['description'] ?? null,
                    'download_url' => $pluginData['download_url'],
                    'requirements' => $pluginData['requirements'] ?? [],
                    'dependencies' => $pluginData['dependencies'] ?? [],
                    'status' => 'inactive',
                ]
            );

            // Log oluştur
            $installation = PluginInstallation::create([
                'plugin_id' => $plugin->id,
                'version' => $pluginData['version'],
                'action' => 'install',
                'status' => 'processing',
                'user_id' => auth()->id(),
            ]);

            // Eklenti dosyasını indir
            $this->downloadPlugin($plugin);

            // Eklenti dosyalarını çıkar
            $this->extractPlugin($plugin);

            // Composer autoload güncelle
            $this->updateComposerAutoload();

            // Migration'ları çalıştır
            $this->runPluginMigrations($plugin);

            // Asset'leri yayınla
            $this->publishPluginAssets($plugin);

            // Başarılı kurulum
            $plugin->update(['is_installed' => true]);
            $installation->update([
                'status' => 'success',
                'message' => 'Eklenti başarıyla yüklendi'
            ]);

            // Cache temizle
            Cache::flush();

            return $plugin;

        } catch (Exception $e) {
            if (isset($installation)) {
                $installation->update([
                    'status' => 'failed',
                    'message' => $e->getMessage()
                ]);
            }
            throw $e;
        }
    }

    /**
     * Eklenti dosyasını indir
     */
    protected function downloadPlugin(Plugin $plugin)
    {
        $downloadUrl = $plugin->download_url;
        $tempFile = storage_path('app/temp/' . $plugin->slug . '.zip');

        // Temp dizinini oluştur
        if (!File::exists(dirname($tempFile))) {
            File::makeDirectory(dirname($tempFile), 0755, true);
        }

        // Dosyayı indir
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->timeout(300)->get($downloadUrl);

        if (!$response->successful()) {
            throw new Exception('Eklenti dosyası indirilemedi');
        }

        File::put($tempFile, $response->body());

        return $tempFile;
    }

    /**
     * ZIP dosyasını çıkar
     */
    protected function extractPlugin(Plugin $plugin)
    {
        $zipFile = storage_path('app/temp/' . $plugin->slug . '.zip');
        $extractPath = $this->pluginsPath . '/' . $plugin->slug;

        if (!File::exists($zipFile)) {
            throw new Exception('Eklenti dosyası bulunamadı');
        }

        $zip = new ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            // Önce eski dosyaları temizle
            if (File::exists($extractPath)) {
                File::deleteDirectory($extractPath);
            }

            // Çıkar
            $zip->extractTo($extractPath);
            $zip->close();

            // Temp dosyasını sil
            File::delete($zipFile);

            // plugin.json dosyasını oku
            $this->loadPluginConfig($plugin);
        } else {
            throw new Exception('ZIP dosyası açılamadı');
        }
    }

    /**
     * Plugin config dosyasını yükle
     */
    protected function loadPluginConfig(Plugin $plugin)
    {
        $configFile = $this->pluginsPath . '/' . $plugin->slug . '/plugin.json';

        if (!File::exists($configFile)) {
            throw new Exception('plugin.json dosyası bulunamadı');
        }

        $config = json_decode(File::get($configFile), true);

        $plugin->update([
            'main_file' => $config['main'] ?? null,
            'namespace' => $config['namespace'] ?? null,
            'provider_class' => $config['provider'] ?? null,
            'permissions' => $config['permissions'] ?? [],
        ]);
    }

    /**
     * Eklentiyi etkinleştir
     */
    public function activatePlugin($slug)
    {
        $plugin = Plugin::where('slug', $slug)->firstOrFail();

        if (!$plugin->is_installed) {
            throw new Exception('Eklenti henüz yüklenmemiş');
        }

        // Provider'ı register et
        if ($plugin->provider_class) {
            $this->registerProvider($plugin);
        }

        // Routes dosyasını yükle
        $this->loadPluginRoutes($plugin);

        $plugin->update([
            'is_active' => true,
            'status' => 'active'
        ]);

        PluginInstallation::create([
            'plugin_id' => $plugin->id,
            'version' => $plugin->version,
            'action' => 'activate',
            'status' => 'success',
            'user_id' => auth()->id(),
        ]);

        Cache::flush();

        return $plugin;
    }

    /**
     * Eklentiyi devre dışı bırak
     */
    public function deactivatePlugin($slug)
    {
        $plugin = Plugin::where('slug', $slug)->firstOrFail();

        $plugin->update([
            'is_active' => false,
            'status' => 'inactive'
        ]);

        PluginInstallation::create([
            'plugin_id' => $plugin->id,
            'version' => $plugin->version,
            'action' => 'deactivate',
            'status' => 'success',
            'user_id' => auth()->id(),
        ]);

        Cache::flush();

        return $plugin;
    }

    /**
     * Eklentiyi kaldır
     */
    public function uninstallPlugin($slug)
    {
        $plugin = Plugin::where('slug', $slug)->firstOrFail();

        // Önce devre dışı bırak
        if ($plugin->is_active) {
            $this->deactivatePlugin($slug);
        }

        // Migration'ları geri al
        $this->rollbackPluginMigrations($plugin);

        // Dosyaları sil
        $pluginPath = $this->pluginsPath . '/' . $plugin->slug;
        if (File::exists($pluginPath)) {
            File::deleteDirectory($pluginPath);
        }

        // Veritabanından sil
        $plugin->delete();

        Cache::flush();

        return true;
    }

    /**
     * Plugin migration'larını çalıştır
     */
    protected function runPluginMigrations(Plugin $plugin)
    {
        $migrationPath = $this->pluginsPath . '/' . $plugin->slug . '/database/migrations';

        if (File::exists($migrationPath)) {
            Artisan::call('migrate', [
                '--path' => 'plugins/' . $plugin->slug . '/database/migrations',
                '--force' => true,
            ]);
        }
    }

    /**
     * Plugin migration'larını geri al
     */
    protected function rollbackPluginMigrations(Plugin $plugin)
    {
        $migrationPath = $this->pluginsPath . '/' . $plugin->slug . '/database/migrations';

        if (File::exists($migrationPath)) {
            Artisan::call('migrate:rollback', [
                '--path' => 'plugins/' . $plugin->slug . '/database/migrations',
                '--force' => true,
            ]);
        }
    }

    /**
     * Plugin asset'lerini yayınla
     */
    protected function publishPluginAssets(Plugin $plugin)
    {
        $sourcePath = $this->pluginsPath . '/' . $plugin->slug . '/assets';
        $targetPath = public_path('plugins/' . $plugin->slug);

        if (File::exists($sourcePath)) {
            File::copyDirectory($sourcePath, $targetPath);
        }
    }

    /**
     * Plugin route'larını yükle
     */
    protected function loadPluginRoutes(Plugin $plugin)
    {
        $routesFile = $this->pluginsPath . '/' . $plugin->slug . '/routes/web.php';

        if (File::exists($routesFile)) {
            include $routesFile;
        }
    }

    /**
     * Service Provider'ı register et
     */
    protected function registerProvider(Plugin $plugin)
    {
        $providerClass = $plugin->namespace . '\\' . $plugin->provider_class;

        if (class_exists($providerClass)) {
            app()->register($providerClass);
        }
    }

    /**
     * Composer autoload güncelle
     */
    protected function updateComposerAutoload()
    {
        Artisan::call('dump-autoload');
    }

    /**
     * Eklenti güncellemelerini kontrol et
     */
    public function checkForUpdates()
    {
        $plugins = Plugin::where('is_installed', true)->get();
        $updates = [];

        foreach ($plugins as $plugin) {
            try {
                $remoteData = $this->getPluginDetails($plugin->slug);

                if (version_compare($remoteData['version'], $plugin->version, '>')) {
                    $updates[] = [
                        'plugin' => $plugin,
                        'current_version' => $plugin->version,
                        'new_version' => $remoteData['version'],
                        'changelog' => $remoteData['changelog'] ?? null,
                    ];
                }

                $plugin->update(['last_check' => now()]);
            } catch (Exception $e) {
                continue;
            }
        }

        return $updates;
    }

    /**
     * Eklentiyi güncelle
     */
    public function updatePlugin($slug)
    {
        $plugin = Plugin::where('slug', $slug)->firstOrFail();

        // Önce yedek al
        $this->backupPlugin($plugin);

        try {
            // Yeni versiyonu indir ve yükle
            $this->downloadPlugin($plugin);
            $this->extractPlugin($plugin);

            // Migration'ları çalıştır
            $this->runPluginMigrations($plugin);

            // Asset'leri güncelle
            $this->publishPluginAssets($plugin);

            // Version'u güncelle
            $remoteData = $this->getPluginDetails($slug);
            $plugin->update(['version' => $remoteData['version']]);

            PluginInstallation::create([
                'plugin_id' => $plugin->id,
                'version' => $remoteData['version'],
                'action' => 'update',
                'status' => 'success',
                'user_id' => auth()->id(),
            ]);

            Cache::flush();

            return $plugin;

        } catch (Exception $e) {
            // Hata durumunda yedekten geri yükle
            $this->restorePlugin($plugin);
            throw $e;
        }
    }

    /**
     * Eklenti yedekle
     */
    protected function backupPlugin(Plugin $plugin)
    {
        $sourcePath = $this->pluginsPath . '/' . $plugin->slug;
        $backupPath = storage_path('app/backups/plugins/' . $plugin->slug . '_' . time());

        if (File::exists($sourcePath)) {
            File::copyDirectory($sourcePath, $backupPath);
        }
    }

    /**
     * Eklentiyi yedekten geri yükle
     */
    protected function restorePlugin(Plugin $plugin)
    {
        // En son yedeği bul
        $backupDir = storage_path('app/backups/plugins');
        $backups = File::glob($backupDir . '/' . $plugin->slug . '_*');

        if (!empty($backups)) {
            $latestBackup = end($backups);
            $targetPath = $this->pluginsPath . '/' . $plugin->slug;

            // Mevcut dosyaları sil
            if (File::exists($targetPath)) {
                File::deleteDirectory($targetPath);
            }

            // Yedekten geri yükle
            File::copyDirectory($latestBackup, $targetPath);
        }
    }
}
