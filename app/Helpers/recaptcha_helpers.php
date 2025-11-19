<?php

if (!function_exists('recaptcha_script')) {
    /**
     * reCAPTCHA script tag'ini döndürür
     */
    function recaptcha_script(): string
    {
        $siteKey = config('recaptcha.site_key');
        $version = config('recaptcha.version');

        if (empty($siteKey)) {
            return '<!-- reCAPTCHA: Site key not configured -->';
        }

        if ($version === 'v3') {
            return sprintf(
                '<script src="https://www.google.com/recaptcha/api.js?render=%s" async defer></script>',
                $siteKey
            );
        }

        // v2 için
        return '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }
}

if (!function_exists('recaptcha_v3')) {
    /**
     * v3 için form submit işlemi
     *
     * @param string $formId Form ID
     * @param string $action Action adı (opsiyonel)
     * @return string
     */
    function recaptcha_v3(string $formId, string $action = 'submit'): string
    {
        $siteKey = config('recaptcha.site_key');

        if (empty($siteKey)) {
            return '<!-- reCAPTCHA: Site key not configured -->';
        }

        return <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('{$formId}');
    if (!form) {
        console.error('reCAPTCHA: Form #{$formId} not found');
        return;
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        grecaptcha.ready(function() {
            grecaptcha.execute('{$siteKey}', {action: '{$action}'}).then(function(token) {
                // Hidden input oluştur veya güncelle
                let input = form.querySelector('input[name="recaptcha-response"]');
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'recaptcha-response';
                    form.appendChild(input);
                }
                input.value = token;
                
                // Formu gönder
                form.submit();
            });
        });
    });
});
</script>
HTML;
    }
}

if (!function_exists('htmlScriptTagJsApiV3Submit')) {
    /**
     * Blade'de kullanmak için alternatif v3 fonksiyonu
     */
    function htmlScriptTagJsApiV3Submit(string $formId, string $action = 'submit'): string
    {
        return recaptcha_v3($formId, $action);
    }
}

if (!function_exists('recaptcha_v2')) {
    /**
     * v2 için checkbox HTML'ini döndürür
     */
    function recaptcha_v2(array $attributes = []): string
    {
        $siteKey = config('recaptcha.site_key');

        if (empty($siteKey)) {
            return '<!-- reCAPTCHA: Site key not configured -->';
        }

        $attrs = array_merge([
            'class' => 'g-recaptcha',
            'data-sitekey' => $siteKey,
        ], $attributes);

        $attrString = collect($attrs)
            ->map(fn($value, $key) => sprintf('%s="%s"', $key, htmlspecialchars($value)))
            ->implode(' ');

        return sprintf('<div %s></div>', $attrString);
    }
}

if (!function_exists('recaptcha_validate')) {
    /**
     * Manuel olarak reCAPTCHA doğrulama
     *
     * @param string $token
     * @return array ['success' => bool, 'score' => float, 'action' => string]
     */
    function recaptcha_validate(string $token): array
    {
        try {
            $response = \Illuminate\Support\Facades\Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => config('recaptcha.secret_key'),
                    'response' => $token,
                    'remoteip' => request()->ip(),
                ]
            );

            $result = $response->json();

            return [
                'success' => $result['success'] ?? false,
                'score' => $result['score'] ?? 0.0,
                'action' => $result['action'] ?? '',
                'hostname' => $result['hostname'] ?? '',
                'challenge_ts' => $result['challenge_ts'] ?? '',
                'error_codes' => $result['error-codes'] ?? [],
            ];

        } catch (\Exception $e) {
            \Log::error('reCAPTCHA manual validation error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'score' => 0.0,
                'action' => '',
                'error_codes' => ['exception'],
            ];
        }
    }
}