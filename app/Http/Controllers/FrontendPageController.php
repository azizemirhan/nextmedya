<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class FrontendPageController extends Controller
{
    /**
     * URL'den gelen slug'a göre dinamik sayfayı bulur ve gösterir.
     */
//    public function show($slug)
//    {
//        // 1. Sayfayı bul: Slug'a göre, durumu "published" olan sayfayı ara. Bulamazsan 404 hatası ver.
//        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
//
//        // 2. Sayfanın section'larını veritabanından yükle (ilişkiyi kullanarak).
//        $page->load('sections');
//
//        // 3. Section tanımlarını config dosyasından al.
//        $availableSections = config('sections');
//
//        // 4. Sayfayı ve section'ları view'a gönder.
//        return view('frontend.page', compact('page', 'availableSections'));
//    }


//    public function show($slug)
//    {
//        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
//
//        // Banner başlığını al. Eğer özel banner başlığı girilmemişse, normal sayfa başlığını kullan.
//        $pageTitle = $page->getTranslation('banner_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale());
//
//        // Banner alt başlığını al.
//        $pageSubtitle = $page->getTranslation('banner_subtitle', app()->getLocale());
//
//        return view('frontend.page', compact('page', 'pageTitle', 'pageSubtitle'));
//    }

    public function show($slug)
    {
        // Sayfayı ve ilişkili bölümlerini tek sorguda çekmek (performans için)
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->with('sections') // 'sections' ilişkisini eager load yapıyoruz
            ->firstOrFail();

        // Banner başlığını al (bu kısım sizde zaten çalışıyor)
        $pageTitle = $page->getTranslation('banner_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale());
        $pageSubtitle = $page->getTranslation('banner_subtitle', app()->getLocale());

        // === EKSİK OLAN VE EKLENMESİ GEREKEN KISIM BAŞLANGICI ===
        // config/sections.php dosyasındaki tüm bölüm ayarlarını alıyoruz.
        $availableSections = config('sections');
        // === EKSİK OLAN KISIM BİTİŞİ ===

        // Tüm değişkenleri view'e gönderiyoruz.
        return view('frontend.page', compact(
            'page',
            'pageTitle',
            'pageSubtitle',
            'availableSections' // Eksik olan değişkeni view'e ekledik
        ));
    }
    /**
     * Ana sayfayı gösterir (Örnek).
     * Ana sayfa da dinamik bir sayfa olabilir. Slug'ı "anasayfa" olan sayfayı çekebilirsiniz.
     */
    public function home()
    {
        // Ana sayfanız da bir "Page" ise, slug'ı "home" olanı burada çekebilirsiniz.
        return $this->show('anasayfa'); // Örnek: slug'ı "anasayfa" olanı göster.
    }
}
