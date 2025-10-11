<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    // Spatie metodlarını alias’lıyoruz ki override ederken çağırabilelim
    use HasTranslations {
        getTranslation as protected traitGetTranslation;
        setTranslation as protected traitSetTranslation;
        setTranslations as protected traitSetTranslations;
    }

    protected $fillable = [
        'menu_id', 'parent_id', 'title', 'url', 'page_id', 'service_id', 'target', 'classes', 'rel', 'order'
    ];

    // Sadece gerçek kolonları translatable ilan et
    public array $translatable = ['title'];

    protected $casts = [
        'title'     => 'array',
        'menu_id'   => 'integer',
        'parent_id' => 'integer',
        'page_id'   => 'integer',
        'order'     => 'integer',
    ];

    public function menu(): BelongsTo   { return $this->belongsTo(Menu::class); }
    public function parent(): BelongsTo { return $this->belongsTo(MenuItem::class, 'parent_id'); }
    public function children(): HasMany { return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order'); }
    public function childrenRecursive(): HasMany { return $this->children()->with('childrenRecursive'); }


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
