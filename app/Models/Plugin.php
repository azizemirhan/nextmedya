<?php
// app/Models/Plugin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plugin extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'version',
        'author',
        'author_uri',
        'description',
        'license',
        'plugin_uri',
        'repository_url',
        'download_url',
        'is_active',
        'is_installed',
        'requirements',
        'dependencies',
        'settings',
        'permissions',
        'main_file',
        'namespace',
        'provider_class',
        'status',
        'last_check',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_installed' => 'boolean',
        'requirements' => 'array',
        'dependencies' => 'array',
        'settings' => 'array',
        'permissions' => 'array',
        'last_check' => 'datetime',
    ];

    public function installations(): HasMany
    {
        return $this->hasMany(PluginInstallation::class);
    }

    public function getLatestInstallation()
    {
        return $this->installations()->latest()->first();
    }

    public function hasUpdate(): bool
    {
        // Bu metod API'den kontrol edilecek
        return false;
    }

    public function meetsRequirements(): bool
    {
        if (!$this->requirements) {
            return true;
        }

        // PHP versiyonu kontrolü
        if (isset($this->requirements['php'])) {
            if (!version_compare(PHP_VERSION, $this->requirements['php'], '>=')) {
                return false;
            }
        }

        // Laravel versiyonu kontrolü
        if (isset($this->requirements['laravel'])) {
            $laravelVersion = app()->version();
            if (!version_compare($laravelVersion, $this->requirements['laravel'], '>=')) {
                return false;
            }
        }

        return true;
    }
}
