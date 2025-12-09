<?php

// config/recaptcha.php

return [

    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Site Key
    |--------------------------------------------------------------------------
    |
    | Frontend'de kullanılacak public key
    |
    */
    'site_key' => env('RECAPTCHA_SITE_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Secret Key
    |--------------------------------------------------------------------------
    |
    | Backend'de doğrulama için kullanılacak private key
    |
    */
    'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Minimum Score
    |--------------------------------------------------------------------------
    |
    | reCAPTCHA v3 için minimum kabul edilebilir skor
    | 0.0 (kesinlikle bot) - 1.0 (kesinlikle insan)
    |
    */
    'minimum_score' => env('RECAPTCHA_MINIMUM_SCORE', 0.5),

    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | reCAPTCHA kontrolü aktif mi?
    | Development ortamında false yapabilirsiniz
    |
    */
    'enabled' => env('RECAPTCHA_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Verify URL
    |--------------------------------------------------------------------------
    |
    | Google reCAPTCHA doğrulama endpoint'i
    |
    */
    'verify_url' => 'https://www.google.com/recaptcha/api/siteverify',

];