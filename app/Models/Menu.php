<?php

namespace App\Models;

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

    public static function render(string $slug, string $view = 'frontend.partials._menu'): string
    {
        $menu = static::where('slug', $slug)->first();

        if (!$menu) {
            return '';
        }

        // Sadece kök item'ları çek; altlarını recursive yükle
        $items = $menu->items()
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->get();

        return view($view, ['items' => $items])->render();
    }

    /** İstersen header’da @if(\App\Models\Menu::existsBySlug('main-menu')) diye kullan */
    public static function existsBySlug(string $slug): bool
    {
        return static::where('slug', $slug)->exists();
    }

    public static function renderByPlacement(string $placement, string $view = 'frontend.partials._menu'): string
    {
        $menu = static::where('placement', $placement)->first();
        if (!$menu) return '';
        $items = $menu->items()->whereNull('parent_id')->with('childrenRecursive')->get();
        return view($view, ['items' => $items])->render();
    }
}
