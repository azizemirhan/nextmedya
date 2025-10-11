<?php

return [
    'variants' => [
// ana varyantlar
        'thumb' => ['w' => 320, 'h' => 320, 'fit' => 'cover'],
        'small' => ['w' => 640, 'h' => 480, 'fit' => 'contain'],
        'medium' => ['w' => 1024, 'h' => 768, 'fit' => 'contain'],
        'large' => ['w' => 1600, 'h' => 1200, 'fit' => 'contain'],
// modern formatlar
        'webp' => true,
        'avif' => false,
    ],


    'optimize' => ['enabled' => true, 'timeout' => 30],


    'security' => [
        'allowed_mimes' => [
            'image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/avif',
            'video/mp4', 'video/quicktime', 'audio/mpeg', 'audio/mp3',
            'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ],
        'max_size_mb' => 25, // tek dosya
    ],


    'signed_urls' => [
        'default_ttl' => 3600, // saniye
    ],
];
