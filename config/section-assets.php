<?php

/**
 * Section-based asset management
 *
 * This config maps section names to their required CSS/JS assets
 * Only load assets when the section is actually used on the page
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Section Asset Mappings
    |--------------------------------------------------------------------------
    |
    | Define which CSS and JS files each section requires
    | Assets will only be loaded when the section is present on the page
    |
    */

    'mappings' => [
        '_herobanner' => [
            'css' => [
                // Add specific CSS files if needed
            ],
            'js' => [
                // Add specific JS files if needed
            ],
        ],

        '_references' => [
            'css' => [],
            'js' => [],
        ],

        '_services' => [
            'css' => [],
            'js' => [],
        ],

        '_testimonials' => [
            'css' => [],
            'js' => [],
        ],

        '_contact' => [
            'css' => [],
            'js' => [],
        ],

        '_blog' => [
            'css' => [],
            'js' => [],
        ],

        '_team' => [
            'css' => [],
            'js' => [],
        ],

        '_portfolio' => [
            'css' => [],
            'js' => [],
        ],

        '_pricing' => [
            'css' => [],
            'js' => [],
        ],

        '_faq' => [
            'css' => [],
            'js' => [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Assets
    |--------------------------------------------------------------------------
    |
    | Assets that should always be loaded regardless of sections
    | These are critical assets required for basic site functionality
    |
    */

    'global' => [
        'css' => [
            'site/css/style.css',
            'site/css/footer.css',
        ],
        'js' => [
            'site/js/script.js',
            'site/js/footer.js',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Deferred Assets
    |--------------------------------------------------------------------------
    |
    | Assets that can be deferred (loaded after page load)
    | These don't affect above-the-fold rendering
    |
    */

    'deferred' => [
        'css' => [
            'site/css/google.css',
            'site/css/whatsapp-widget.css',
        ],
        'js' => [
            'site/js/google.js',
            'site/js/whatsapp-tracking.js',
        ],
    ],
];
