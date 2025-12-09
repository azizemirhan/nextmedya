<?php
// config/plugins.php

return [
    /*
    |--------------------------------------------------------------------------
    | Plugin API Configuration
    |--------------------------------------------------------------------------
    |
    | API ayarları: Eklentilerin çekileceği uzak API bilgileri
    | API URL ve API Key değerlerini .env dosyasında tanımlayın
    |
    */

    'api' => [
        'url' => env('PLUGIN_API_URL', 'https://plugins.example.com/api'),
        'key' => env('PLUGIN_API_KEY', ''),
        'timeout' => env('PLUGIN_API_TIMEOUT', 300), // saniye
        'retry_times' => env('PLUGIN_API_RETRY', 3),
        'retry_sleep' => env('PLUGIN_API_RETRY_SLEEP', 100), // milisaniye
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Storage Paths
    |--------------------------------------------------------------------------
    |
    | Eklentilerin yükleneceği ve saklanacağı dizinler
    |
    */

    'paths' => [
        'plugins' => base_path('plugins'),
        'temp' => storage_path('app/temp/plugins'),
        'backups' => storage_path('app/backups/plugins'),
        'cache' => storage_path('app/cache/plugins'),
        'logs' => storage_path('logs/plugins'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto Update Settings
    |--------------------------------------------------------------------------
    |
    | Otomatik güncelleme ayarları
    |
    */

    'updates' => [
        'auto_update' => env('PLUGIN_AUTO_UPDATE', false),
        'check_frequency' => env('PLUGIN_UPDATE_CHECK', 'daily'), // hourly, daily, weekly, monthly
        'auto_backup' => env('PLUGIN_AUTO_BACKUP', true),
        'keep_backups' => env('PLUGIN_KEEP_BACKUPS', 5), // Kaç yedek tutulsun
        'notification_email' => env('PLUGIN_UPDATE_EMAIL', null),
    ],

    /*
    |--------------------------------------------------------------------------
    | System Requirements
    |--------------------------------------------------------------------------
    |
    | Minimum sistem gereksinimleri
    |
    */

    'requirements' => [
        'php' => '8.0',
        'laravel' => '10.0',
        'memory_limit' => '256M',
        'max_execution_time' => 300,
        'extensions' => [
            'zip',
            'curl',
            'json',
            'mbstring',
            'openssl',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload Settings
    |--------------------------------------------------------------------------
    |
    | Dosya yükleme ayarları
    |
    */

    'upload' => [
        'allowed_extensions' => ['zip'],
        'max_size' => env('PLUGIN_MAX_SIZE', 50), // MB
        'chunk_size' => env('PLUGIN_CHUNK_SIZE', 1), // MB - Büyük dosyalar için
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Güvenlik ayarları
    |
    */

    'security' => [
        'verify_ssl' => env('PLUGIN_VERIFY_SSL', true),
        'check_signature' => env('PLUGIN_CHECK_SIGNATURE', true),
        'sandbox_mode' => env('PLUGIN_SANDBOX', false),
        'allowed_permissions' => [
            'database' => true,
            'filesystem' => true,
            'network' => false,
            'system' => false,
        ],
        'blocked_functions' => [
            'exec',
            'system',
            'shell_exec',
            'passthru',
            'eval',
            'file_get_contents',
            'file_put_contents',
            'fopen',
            'fwrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Önbellek ayarları
    |
    */

    'cache' => [
        'enabled' => env('PLUGIN_CACHE_ENABLED', true),
        'driver' => env('PLUGIN_CACHE_DRIVER', 'file'),
        'prefix' => 'plugin_',
        'ttl' => [
            'list' => 3600, // 1 saat
            'details' => 7200, // 2 saat
            'updates' => 86400, // 24 saat
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Settings
    |--------------------------------------------------------------------------
    |
    | Veritabanı ayarları
    |
    */

    'database' => [
        'tables' => [
            'plugins' => 'plugins',
            'installations' => 'plugin_installations',
            'settings' => 'plugin_settings',
            'permissions' => 'plugin_permissions',
        ],
        'prefix' => env('PLUGIN_DB_PREFIX', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Settings
    |--------------------------------------------------------------------------
    |
    | Admin panel ayarları
    |
    */

    'admin' => [
        'route_prefix' => 'admin/plugins',
        'middleware' => ['web', 'auth', 'is_admin'],
        'pagination' => 20,
        'enable_market' => env('PLUGIN_MARKET_ENABLED', true),
        'enable_upload' => env('PLUGIN_UPLOAD_ENABLED', false),
        'enable_dev_mode' => env('PLUGIN_DEV_MODE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Defaults
    |--------------------------------------------------------------------------
    |
    | Eklenti varsayılan ayarları
    |
    */

    'defaults' => [
        'status' => 'inactive',
        'auto_activate' => false,
        'run_migrations' => true,
        'publish_assets' => true,
        'register_commands' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Types
    |--------------------------------------------------------------------------
    |
    | Desteklenen eklenti türleri
    |
    */

    'types' => [
        'module' => [
            'name' => 'Modül',
            'description' => 'Sisteme yeni özellikler ekler',
            'icon' => 'fas fa-puzzle-piece',
        ],
        'theme' => [
            'name' => 'Tema',
            'description' => 'Görünümü değiştirir',
            'icon' => 'fas fa-paint-brush',
        ],
        'widget' => [
            'name' => 'Widget',
            'description' => 'Küçük bileşenler ekler',
            'icon' => 'fas fa-th-large',
        ],
        'integration' => [
            'name' => 'Entegrasyon',
            'description' => 'Dış servislerle bağlantı kurar',
            'icon' => 'fas fa-link',
        ],
        'tool' => [
            'name' => 'Araç',
            'description' => 'Yardımcı araçlar sağlar',
            'icon' => 'fas fa-tools',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Categories
    |--------------------------------------------------------------------------
    |
    | Eklenti kategorileri
    |
    */

    'categories' => [
        'content' => 'İçerik Yönetimi',
        'seo' => 'SEO',
        'security' => 'Güvenlik',
        'performance' => 'Performans',
        'marketing' => 'Pazarlama',
        'social' => 'Sosyal Medya',
        'ecommerce' => 'E-Ticaret',
        'analytics' => 'Analitik',
        'media' => 'Medya',
        'communication' => 'İletişim',
        'development' => 'Geliştirme',
        'other' => 'Diğer',
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Log ayarları
    |
    */

    'logging' => [
        'enabled' => env('PLUGIN_LOGGING', true),
        'channel' => env('PLUGIN_LOG_CHANNEL', 'daily'),
        'level' => env('PLUGIN_LOG_LEVEL', 'info'),
        'days' => env('PLUGIN_LOG_DAYS', 14),
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | API istek limitleri
    |
    */

    'rate_limit' => [
        'enabled' => env('PLUGIN_RATE_LIMIT', true),
        'max_attempts' => env('PLUGIN_MAX_ATTEMPTS', 60),
        'decay_minutes' => env('PLUGIN_DECAY_MINUTES', 1),
    ],

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | Bildirim ayarları
    |
    */

    'notifications' => [
        'channels' => ['database', 'mail'],
        'events' => [
            'installed' => true,
            'updated' => true,
            'activated' => false,
            'deactivated' => false,
            'uninstalled' => true,
            'error' => true,
        ],
    ],
];
