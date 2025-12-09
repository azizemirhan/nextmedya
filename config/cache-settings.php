<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache TTL (Time To Live) Settings
    |--------------------------------------------------------------------------
    |
    | Bu ayarlar uygulama genelinde cache sürelerini yönetir.
    | Değerler saniye cinsinden belirtilmiştir.
    |
    */
    'ttl' => [
        'menu'          => 86400,   // 24 saat
        'settings'      => 0,       // Forever (0 = sonsuz)
        'sidebar'       => 3600,    // 1 saat
        'posts'         => 1800,    // 30 dakika
        'pages'         => 3600,    // 1 saat
        'services'      => 3600,    // 1 saat
        'categories'    => 3600,    // 1 saat
        'tags'          => 3600,    // 1 saat
        'response'      => 300,     // 5 dakika (HTTP response cache)
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefixes
    |--------------------------------------------------------------------------
    |
    | Cache key'leri için standart prefix'ler.
    | Bu sayede cache key'leri tutarlı ve öngörülebilir olur.
    |
    */
    'prefixes' => [
        'menu'          => 'menu',
        'sidebar'       => 'sidebar',
        'settings'      => 'settings',
        'posts'         => 'posts',
        'pages'         => 'pages',
        'services'      => 'services',
        'categories'    => 'categories',
        'tags'          => 'tags',
        'response'      => 'response',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Tags
    |--------------------------------------------------------------------------
    |
    | Tag-based cache invalidation için gruplar.
    | Not: Tag'lar sadece Redis/Memcached ile çalışır.
    |
    */
    'tags' => [
        'content'   => ['posts', 'pages', 'services'],
        'navigation'=> ['menu', 'sidebar'],
        'meta'      => ['settings', 'categories', 'tags'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Cache Settings
    |--------------------------------------------------------------------------
    |
    | HTTP response cache ayarları.
    |
    */
    'response' => [
        'enabled'       => true,
        'exclude_paths' => [
            'admin/*',
            'api/*',
            'login',
            'logout',
            'register',
        ],
        'exclude_ajax'  => true,
        'vary_headers'  => ['Accept-Language', 'Accept-Encoding'],
    ],
];
