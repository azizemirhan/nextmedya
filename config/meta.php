<?php
// config/meta.php

return [
    // Meta Pixel ID
    'pixel_id' => env('META_PIXEL_ID'),

    // Access Token
    'access_token' => env('META_ACCESS_TOKEN'),

    // API Version
    'api_version' => env('META_API_VERSION', 'v21.0'),

    // Test Event Code (sadece test aşamasında kullanın)
    'test_event_code' => env('META_TEST_EVENT_CODE', null),
];