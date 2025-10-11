<?php
// app/Http/Controllers/Admin/PluginController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use App\Services\PluginManager;
use Illuminate\Http\Request;
use Exception;

class PluginController extends Controller
{
    protected $pluginManager;

    public function __construct(PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }

    /**
     * Yüklü eklentileri listele
     */
    public function index()
    {
        $installedPlugins = Plugin::where('is_installed', true)->get();
        $updates = $this->pluginManager->checkForUpdates();

        return view('admin.plugins.index', compact('installedPlugins', 'updates'));
    }

    /**
     * Mevcut eklentileri göster (market)
     */
    public function market()
    {
        try {
            $availablePlugins = $this->pluginManager->fetchAvailablePlugins();
            $installedSlugs = Plugin::where('is_installed', true)->pluck('slug')->toArray();

            return view('admin.plugins.market', compact('availablePlugins', 'installedSlugs'));
        } catch (Exception $e) {
            return redirect()->route('admin.plugins.index')
                ->with('error', 'Eklenti marketi yüklenemedi: ' . $e->getMessage());
        }
    }

    /**
     * Eklenti detayları
     */
    public function show($slug)
    {
        try {
            $plugin = Plugin::where('slug', $slug)->first();

            if (!$plugin) {
                $pluginData = $this->pluginManager->getPluginDetails($slug);
                return view('admin.plugins.show', compact('pluginData'));
            }

            return view('admin.plugins.show', compact('plugin'));
        } catch (Exception $e) {
            return redirect()->route('admin.plugins.market')
                ->with('error', 'Eklenti detayları alınamadı: ' . $e->getMessage());
        }
    }

    /**
     * Eklenti yükle
     */
    public function install(Request $request)
    {
        $request->validate([
            'slug' => 'required|string'
        ]);

        try {
            $plugin = $this->pluginManager->installPlugin($request->slug);

            return redirect()->route('admin.plugins.index')
                ->with('success', $plugin->name . ' eklentisi başarıyla yüklendi.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Eklenti yüklenemedi: ' . $e->getMessage());
        }
    }

    /**
     * Eklentiyi etkinleştir
     */
    public function activate($slug)
    {
        try {
            $plugin = $this->pluginManager->activatePlugin($slug);

            return redirect()->route('admin.plugins.index')
                ->with('success', $plugin->name . ' eklentisi etkinleştirildi.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Eklenti etkinleştirilemedi: ' . $e->getMessage());
        }
    }

    /**
     * Eklentiyi devre dışı bırak
     */
    public function deactivate($slug)
    {
        try {
            $plugin = $this->pluginManager->deactivatePlugin($slug);

            return redirect()->route('admin.plugins.index')
                ->with('success', $plugin->name . ' eklentisi devre dışı bırakıldı.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Eklenti devre dışı bırakılamadı: ' . $e->getMessage());
        }
    }

    /**
     * Eklentiyi kaldır
     */
    public function uninstall($slug)
    {
        try {
            $this->pluginManager->uninstallPlugin($slug);

            return redirect()->route('admin.plugins.index')
                ->with('success', 'Eklenti başarıyla kaldırıldı.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Eklenti kaldırılamadı: ' . $e->getMessage());
        }
    }

    /**
     * Eklentiyi güncelle
     */
    public function update($slug)
    {
        try {
            $plugin = $this->pluginManager->updatePlugin($slug);

            return redirect()->route('admin.plugins.index')
                ->with('success', $plugin->name . ' eklentisi güncellendi.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Eklenti güncellenemedi: ' . $e->getMessage());
        }
    }

    /**
     * Eklenti ayarları
     */
    public function settings($slug)
    {
        $plugin = Plugin::where('slug', $slug)->firstOrFail();

        // Eklenti kendi settings view'ini sağlıyorsa
        $settingsView = 'plugins.' . $slug . '.settings';
        if (view()->exists($settingsView)) {
            return view($settingsView, compact('plugin'));
        }

        // Varsayılan settings view
        return view('admin.plugins.settings', compact('plugin'));
    }

    /**
     * Eklenti ayarlarını kaydet
     */
    public function updateSettings(Request $request, $slug)
    {
        $plugin = Plugin::where('slug', $slug)->firstOrFail();

        $plugin->update([
            'settings' => $request->except('_token', '_method')
        ]);

        return redirect()->back()
            ->with('success', 'Ayarlar kaydedildi.');
    }
}
