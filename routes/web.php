<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


Route::get('/test-api', function () {
    return view('test-api');
});

Route::prefix('chat')->group(function () {
    Route::post('/init', [\App\Http\Controllers\ChatController::class, 'initSession']);
    Route::post('/send', [\App\Http\Controllers\ChatController::class, 'sendMessage']);
    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'getMessages']);
    Route::post('/update-info', [\App\Http\Controllers\ChatController::class, 'updateVisitorInfo']);
});

Route::post('/newsletter/subscribe', [\App\Http\Controllers\Frontend\NewsletterController::class, 'store'])
    ->middleware('throttle:20,1') // dakikada 20 deneme
    ->name('newsletter.subscribe');

// (Opsiyonel: double opt-in onayı ve iptal linkleri)
Route::get('/newsletter/confirm/{token}', [\App\Http\Controllers\Frontend\NewsletterController::class, 'confirm'])->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [\App\Http\Controllers\Frontend\NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::get('/_mail-test', function () {
    try {
        Mail::raw('SMTP test body', function ($m) {
            $m->to('info@tuncay-insaat.com')
                ->subject('SMTP connectivity test');
        });
        return 'OK: Mail::raw gönderildi.';
    } catch (\Throwable $e) {
        Log::error('SMTP TEST ERROR', ['msg' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        return 'ERROR: ' . $e->getMessage();
    }
});

Route::post('/contact', [\App\Http\Controllers\Frontend\ContactController::class, '__invoke'])
    ->middleware('throttle:10,1')
    ->name('frontend.contact.submit');

Route::get('/debug-languages', function() {
    $activeLanguagesJson = setting('active_languages');
    $activeLanguageCodes = json_decode($activeLanguagesJson, true) ?? ['tr', 'en'];
    $allLanguages = config('languages.supported', []);

    $activeLanguages = collect($allLanguages)
        ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
        ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));

    return [
        'settings_raw' => setting('active_languages'),
        'active_codes' => $activeLanguageCodes,
        'active_languages' => $activeLanguages,
        'current_locale' => app()->getLocale(),
        'session_locale' => session('locale'),
        'middleware_test' => 'SetLocale middleware çalışıyor mu?',
        'request_path' => request()->path(),
        'session_started' => session()->isStarted(),
        'session_id' => session()->getId(),
    ];
});

// Test için dil değiştirme route'u
Route::get('/test-language/{locale}', function($locale) {
    session()->put('locale', $locale);

    // Immediate olarak da ayarla
    app()->setLocale($locale);

    return [
        'message' => "Dil {$locale} olarak ayarlandı",
        'session_locale' => session('locale'),
        'app_locale_after' => app()->getLocale(),
        'session_all' => session()->all(),
    ];
});

// Cache temizleme route'u
Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');

    return 'Cache temizlendi!';
});
Route::get('language/{locale}', [App\Http\Controllers\LanguageController::class, 'swap'])->name('language.swap');

Route::get('/login', function () {
    return 'Login sayfası henüz yapılmadı';
})->name('login');

Route::get('/', [\App\Http\Controllers\FrontendPageController::class, 'home'])->name('frontend.home');
Route::get('/hizmetlerimiz/{service:slug}', [\App\Http\Controllers\FrontendServiceController::class, 'show'])->name('frontend.services.show');

Route::get('/bloglar', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
// Tek bir yazıyı gösterme sayfası (örn: site.com/blog/yazi-slug)
Route::get('/bloglar/{post:slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
// Kategoriye göre yazıları listeleme (örn: site.com/blog/kategori/teknoloji)
Route::get('/bloglar/kategori/{category:slug}', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.category');
// Etikete göre yazıları listeleme (örn: site.com/blog/etiket/laravel)
Route::get('/bloglar/etiket/{tag:slug}', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.tag');

Route::get('/lock-screen', [\App\Http\Controllers\Auth\LockScreenController::class, 'showLockScreen'])->name('lock-screen');
Route::post('/unlock', [\App\Http\Controllers\Auth\LockScreenController::class, 'unlock'])->name('unlock');

Route::get('/{slug}', [\App\Http\Controllers\FrontendPageController::class, 'show'])->name('frontend.page.show');
