<?php

namespace App\View\Composers;

use App\Models\Menu;
use App\Models\Setting;
use App\Services\CacheService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

/**
 * GlobalDataComposer
 *
 * Octane-safe view composer that provides fresh data on each request.
 * This replaces View::share() calls which are not safe in Octane
 * because they persist data across requests.
 */
class GlobalDataComposer
{
    protected CacheService $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Settings - cached forever, invalidated on change
        $settings = $this->getSettings();
        $view->with('settings', $settings);

        // Active Languages
        $activeLanguages = $this->getActiveLanguages($settings);
        $view->with('activeLanguages', $activeLanguages);

        // Main Menu - cached for 24 hours
        $mainMenu = $this->getMainMenu();
        $view->with('mainMenu', $mainMenu);

        // GTM User Data - request-specific, must be fresh
        $gtmUser = $this->getGtmUserData();
        $view->with('gtmUser', $gtmUser);
    }

    /**
     * Get settings from cache
     */
    protected function getSettings()
    {
        try {
            return Cache::rememberForever('settings.all', function () {
                return Setting::all()->keyBy('key');
            });
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Get active languages based on settings
     */
    protected function getActiveLanguages($settings)
    {
        try {
            $activeLanguageCodes = $settings->get('active_languages')?->value ?? ['tr', 'en'];
            if (!is_array($activeLanguageCodes)) {
                $activeLanguageCodes = ['tr', 'en'];
            }

            $allLanguages = config('languages.supported', []);

            return collect($allLanguages)
                ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
                ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));
        } catch (\Exception $e) {
            return collect(['tr' => ['name' => 'Turkish', 'native' => 'Türkçe']]);
        }
    }

    /**
     * Get main menu from cache
     */
    protected function getMainMenu()
    {
        try {
            return $this->cacheService->remember(
                $this->cacheService->key('menu', 'main-menu'),
                'menu',
                function () {
                    return Menu::where('slug', 'main-menu')
                        ->with(['items' => function ($q) {
                            $q->whereNull('parent_id')->with('childrenRecursive')->orderBy('order');
                        }])
                        ->first();
                },
                ['navigation']
            );
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get GTM user data - this MUST be fresh on each request
     */
    protected function getGtmUserData(): array
    {
        if (!Auth::check()) {
            return [];
        }

        $user = Auth::user();

        return [
            'em' => function_exists('gtm_hash') ? gtm_hash($user->email) : null,
            'ph' => function_exists('gtm_hash') ? gtm_hash($user->phone ?? '') : null,
            'fn' => function_exists('gtm_hash') ? gtm_hash($user->name) : null,
            'db' => function_exists('gtm_hash') ? gtm_hash($user->birth_date ?? '') : null,
            'ct' => function_exists('gtm_hash') ? gtm_hash($user->city ?? '') : null,
            'external_id' => $user->id,
        ];
    }
}
