<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class RecaptchaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/recaptcha.php', 'recaptcha');
    }

    public function boot(): void
    {
        // Config dosyasını yayınla
        $this->publishes([
            __DIR__.'/../../config/recaptcha.php' => config_path('recaptcha.php'),
        ], 'recaptcha-config');

        // Custom validation rule
        $this->registerValidationRule();

        // Blade directives
        $this->registerBladeDirectives();

        // Helper functions kaydet
        $this->registerHelpers();
    }

    protected function registerValidationRule(): void
    {
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            // Skip IPs kontrolü
            if (in_array(request()->ip(), config('recaptcha.skip_ips', []))) {
                return true;
            }

            if (empty($value)) {
                return false;
            }

            try {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('recaptcha.secret_key'),
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);

                $result = $response->json();

                if (!$result['success']) {
                    \Log::warning('reCAPTCHA verification failed', [
                        'errors' => $result['error-codes'] ?? [],
                        'ip' => request()->ip(),
                    ]);
                    return false;
                }

                // v3 için skor kontrolü
                if (config('recaptcha.version') === 'v3') {
                    $threshold = $parameters[0] ?? config('recaptcha.score_threshold', 0.5);
                    $score = $result['score'] ?? 0;

                    \Log::info('reCAPTCHA score', [
                        'score' => $score,
                        'threshold' => $threshold,
                        'action' => $result['action'] ?? 'unknown',
                    ]);

                    return $score >= $threshold;
                }

                return true;

            } catch (\Exception $e) {
                \Log::error('reCAPTCHA verification error', [
                    'message' => $e->getMessage(),
                    'ip' => request()->ip(),
                ]);
                return false;
            }
        });

        Validator::replacer('recaptcha', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute,
                'reCAPTCHA doğrulaması başarısız oldu. Lütfen tekrar deneyin.');
        });
    }

    protected function registerBladeDirectives(): void
    {
        // v3 için script yükleme
        Blade::directive('recaptchaScript', function () {
            return "<?php echo recaptcha_script(); ?>";
        });

        // v3 için form submit
        Blade::directive('recaptchaV3', function ($expression) {
            return "<?php echo recaptcha_v3($expression); ?>";
        });

        // v2 için checkbox
        Blade::directive('recaptchaV2', function () {
            return "<?php echo recaptcha_v2(); ?>";
        });
    }

    protected function registerHelpers(): void
    {
        require_once __DIR__.'/../Helpers/recaptcha_helpers.php';
    }
}