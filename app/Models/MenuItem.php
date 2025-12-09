<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations {
        getTranslation as protected traitGetTranslation;
        setTranslation as protected traitSetTranslation;
        setTranslations as protected traitSetTranslations;
    }

    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'page_id',
        'service_id',
        'target',
        'classes',
        'rel',
        'order',
        // Mega menü alanları
        'is_mega_menu',
        'icon',
        'description',
        'column_width'
    ];

    // Çok dilli alanlar
    public array $translatable = ['title', 'description'];

    protected $casts = [
        'title'         => 'array',
        'description'   => 'array',
        'menu_id'       => 'integer',
        'parent_id'     => 'integer',
        'page_id'       => 'integer',
        'service_id'    => 'integer',
        'order'         => 'integer',
        'is_mega_menu'  => 'boolean',
        'column_width'  => 'integer',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Mega menü için alt öğeleri gruplar halinde döndür
     */
    public function getMegaMenuColumns()
    {
        if (!$this->is_mega_menu) {
            return collect();
        }

        return $this->children()->get()->groupBy('column_width');
    }

    /**
     * Label için alias (geriye uyumluluk)
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): mixed
    {
        if ($key === 'label') {
            $key = 'title';
        }
        return $this->traitGetTranslation($key, $locale, $useFallbackLocale);
    }

    public function setTranslation(string $key, string $locale, mixed $value): static
    {
        if ($key === 'label') {
            $key = 'title';
        }
        return $this->traitSetTranslation($key, $locale, $value);
    }

    public function setTranslations(string $key, array $translations): static
    {
        if ($key === 'label') {
            $key = 'title';
        }
        return $this->traitSetTranslations($key, $translations);
    }
}