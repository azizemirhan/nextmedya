<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/sitemap.xml', function () {
//     $sitemap = Sitemap::create();

//     // Sabit URL'leri ekliyoruz
//     $sitemap->add(route('anasayfa'), now(), 'daily', 1.0)
//             ->add(route('kurumsalwebtasarim'), now(), 'weekly', 0.8)
//             ->add(route('ampwebtasarim'), now(), 'weekly', 0.8);

//     // Hizmetler sayfalarını dinamik olarak ekliyoruz
//     $services = [
//         'kurumsalwebtasarim',
//         'ampwebtasarim',
//         'kisiselwebsitesitasarimi',
//         'uruntanitimsitesi',
//         'onepagewebtasarim',
//         'forumvetopluluksitetasarimi',
//         'pwawebtasarim',
//         'emlaksitesiyazilimi',
//         'habersitesiyazilimi',
//         'onlineegitimyazilimi',
//         'freelancersitesiyazilimi',
//         'bayiyazilimi',
//         'b2beticaretyazilimi',
//         'b2ceticaretyazilimi',
//         'otelrezervasyonyazilimi',
//         'turizmveorganizasyonyazilimi',
//         'seodanismanligi',
//         'googlereklamdanismanligi',
//         'sosyalmedyayonetimi',
//         'metareklamyonetimi',
//     ];

//     foreach ($services as $service) {
//         $sitemap->add(route($service), now(), 'weekly', 0.7);
//     }

//     // Blog yazılarını dinamik olarak ekliyoruz
//     $posts = \App\Models\Post::where('status', 'published')->get();
//     foreach ($posts as $post) {
//         $sitemap->add(route('blog.show', $post->slug), $post->updated_at, 'daily', 0.8);
//     }

//     return $sitemap->render('xml');
// });

// Route::get('/generate-sitemap', function () {
//     $sitemap = Sitemap::create()
//         Ana sayfa için
//         ->add(
//             Url::create('/')
//                 ->setPriority(1.0) // Ana sayfa yüksek önceliğe sahiptir
//                 ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY) // Günlük güncellenir
//         )
//         Hakkımızda sayfası
//         ->add(
//             Url::create('/hakkimizda')
//                 ->setPriority(0.8)
//                 ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY) // Aylık güncellenir
//         )
//         İletişim sayfası
//         ->add(
//             Url::create('/iletisim')
//                 ->setPriority(0.7)
//                 ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY) // Yıllık güncellenir
//         );

//     Blog yazıları için örnek
//     foreach (\App\Models\Post::all() as $post) {
//         $sitemap->add(
//             Url::create("/blog/{$post->slug}")
//                 ->setPriority(0.6) // Blog yazıları için orta öncelik
//                 ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY) // Haftalık güncellenir
//                 ->setLastModificationDate($post->updated_at) // Son güncellenme tarihi
//         );
//     }

//     Sitemap dosyasını kaydet
//     $sitemap->writeToFile(public_path('sitemap.xml'));

//     return 'Sitemap başarıyla oluşturuldu.';
// });

Route::get('/csrf-check', function () {
    return <<<'HTML'
<!doctype html><meta charset="utf-8">
<form method="POST" action="/csrf-check">
    <input type="hidden" name="_token" value="{}">
    <button>POST</button>
</form>
HTML;
})->name('csrf.check.get');

Route::post('/csrf-check', function (\Illuminate\Http\Request $r) {
    return 'OK session='.substr($r->session()->getId(), 0, 8);
})->name('csrf.check.post');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');

    return 'Tüm önbellekler başarıyla temizlendi.';
});

Route::get('/', [HomeController::class, 'index'])->name('anasayfa');

Route::permanentRedirect('/index.html', '/');
Route::permanentRedirect('/anasayfa', '/');

Route::post('/support-request', [\App\Http\Controllers\SupportRequestController::class, 'store'])
    ->name('support.request.store');

Route::get('/hakkimizda', [HomeController::class, 'hakkimizda'])->name('hakkimizda');
Route::get('/iletisim', [HomeController::class, 'iletisim'])->name('iletisim');
Route::get('/vizyon-misyon', [HomeController::class, 'v_m'])->name('v_m');
Route::get('/degerlerimiz', [HomeController::class, 'degerlerimiz'])->name('degerlerimiz');
Route::get('/referanslarimiz', [HomeController::class, 'referanslarimiz'])->name('referanslarimiz');

Route::get('/hizmetler/kurumsal-web-tasarim', [ServiceController::class, 'kurumsalwebtasarim'])->name('kurumsalwebtasarim');
Route::get('/hizmetler/amp-web-tasarim', [ServiceController::class, 'ampwebtasarim'])->name('ampwebtasarim');
Route::get('/hizmetler/kisisel-web-sitesi-tasarimi', [ServiceController::class, 'kisiselwebsitesitasarimi'])->name('kisiselwebsitesitasarimi');
Route::get('/hizmetler/urun-tanitim-sitesi', [ServiceController::class, 'uruntanitimsitesi'])->name('uruntanitimsitesi');
Route::get('/hizmetler/one-page-web-tasarim', [ServiceController::class, 'onepagewebtasarim'])->name('onepagewebtasarim');
Route::get('/hizmetler/forum-ve-topluluk-site-tasarimi', [ServiceController::class, 'forumvetopluluksitetasarimi'])->name('forumvetopluluksitetasarimi');
Route::get('/hizmetler/pwa-web-tasarim', [ServiceController::class, 'pwawebtasarim'])->name('pwawebtasarim');

Route::get('/hizmetler/emlak-sitesi-yazilimi', [ServiceController::class, 'emlaksitesiyazilimi'])->name('emlaksitesiyazilimi');
Route::get('/hizmetler/haber-sitesi-yazilimi', [ServiceController::class, 'habersitesiyazilimi'])->name('habersitesiyazilimi');
Route::get('/hizmetler/online-egitim-yazilimi', [ServiceController::class, 'onlineegitimyazilimi'])->name('onlineegitimyazilimi');
Route::get('/hizmetler/freelancer-sitesi-yazilimi', [ServiceController::class, 'freelancersitesiyazilimi'])->name('freelancersitesiyazilimi');
Route::get('/hizmetler/bayi-yazilimi', [ServiceController::class, 'bayiyazilimi'])->name('bayiyazilimi');
Route::get('/hizmetler/b2b-eticaret-yazilimi', [ServiceController::class, 'b2beticaretyazilimi'])->name('b2beticaretyazilimi');
Route::get('/hizmetler/b2c-eticaret-yazilimi', [ServiceController::class, 'b2ceticaretyazilimi'])->name('b2ceticaretyazilimi');
Route::get('/hizmetler/otel-rezervasyon-yazilimi', [ServiceController::class, 'otelrezervasyonyazilimi'])->name('otelrezervasyonyazilimi');

Route::get('/hizmetler/seo-danismanligi', [ServiceController::class, 'seodanismanligi'])->name('seodanismanligi');
Route::get('/hizmetler/google-reklam-danismanligi', [ServiceController::class, 'googlereklamdanismanligi'])->name('googlereklamdanismanligi');
Route::get('/hizmetler/sosyal-medya-yonetimi', [ServiceController::class, 'sosyalmedyayonetimi'])->name('sosyalmedyayonetimi');
Route::get('/hizmetler/meta-reklam-yonetimi', [ServiceController::class, 'metareklamyonetimi'])->name('metareklamyonetimi');
Route::get('/duzenleniyor', [ServiceController::class, 'duzenleniyor'])->name('duzenleniyor');
