<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function kurumsalwebtasarim(){

        $paketler = [
            'Next Start' => [
                "Mobil Uyumlu (Responsive) Tasarım" => true,
                "SEO Uyumlu Kodlama ve Yapılandırma" => true,
                "Hızlı Açılış Süresi (Optimize Performans)" => true,
                "Yönetim Paneli (Admin Panel)" => true,
                "SSL Sertifikası (Güvenli Bağlantı)" => true,
                "Ana Sayfa Slider Alanı" => true,
                "İletişim Formu (Google Maps ile Entegre)" => true,
                "Hakkımızda ve Ekibimiz Sayfası" => true,
                "Ürün/Hizmet Tanıtım Sayfaları" => true,
                "Sınırsız Sayfa Ekleyebilme" => true,
                "Sosyal Medya Entegrasyonları" => true,
                "Hızlı WhatsApp ve Telefon Butonu" => true,
                "Blog Sistemi" => true,
                "Galeri (Fotoğraf Modülü)" => true,
                "Teknik Destek ve Yedekleme Hizmeti" => true,
                "Domain + Hosting Hizmeti (1 Yıllık)" => true,
                "Google Harita Kaydı (My Business)" => true,
                "Yandex Harita Kaydı" => true,
                "Meta Etiket Yönetimi" => true,
                "Site Haritası ve Search Console Kaydı" => true,
                "Google Analytics + Tag Manager Entegrasyonu" => true,
                "Pop-up ve Duyuru Alanları" => true,
                "Teklif Formu / Talep Formu" => true,
                "KVKK & Gizlilik Politikası Sayfaları" => true,
                "Referanslar ve Projeler Modülü" => true,
                "İçerik Giriş Eğitimi (PDF veya Video)" => true,
                "Ziyaretçi IP ve Form Kayıt Loglama" => true,
                "Gelişmiş Güvenlik Önlemleri (Bot Koruma, Firewall)" => true,
                "Modern ve Kurumsal UI/UX Tasarım" => true,
                "Haftalık Otomatik Yedekleme" => true,
                "Gelişmiş Raporlama (Form, Tıklama, Ziyaretçi)" => true,
                "Apple Maps Kaydı" => true,
                "Yerel SEO Uyumlu Ayarlar" => true,
                "Çoklu Dil Desteği" => true,
                "Blog + Haber Sistemi" => true,
                "AMP Sayfa Desteği" => false,
                "PWA Desteği (Uygulama gibi çalışma)" => false,
                "Push Bildirim Sistemi" => false,
                "Ekibimiz Sayfasında Dinamik Profil Kartları" => false,
                "Sertifikalar, Belgeler Galerisi" => false,
                "Ziyaretçi Canlı Destek Entegrasyonu (Tawk.to, LiveChat vs.)" => false,
                "Yönetim Panelinden Proje & Duyuru Yönetimi" => false,
                "Veri Şifreleme (Veritabanı ve Formlar)" => false,
                "Site İçi Arama Takibi (Aranan Kelimeler)" => false
            ],
            'Next Boost' => [
                "Mobil Uyumlu (Responsive) Tasarım" => true,
                "SEO Uyumlu Kodlama ve Yapılandırma" => true,
                "Hızlı Açılış Süresi (Optimize Performans)" => true,
                "Yönetim Paneli (Admin Panel)" => true,
                "SSL Sertifikası (Güvenli Bağlantı)" => true,
                "Ana Sayfa Slider Alanı" => true,
                "İletişim Formu (Google Maps ile Entegre)" => true,
                "Hakkımızda ve Ekibimiz Sayfası" => true,
                "Ürün/Hizmet Tanıtım Sayfaları" => true,
                "Sınırsız Sayfa Ekleyebilme" => true,
                "Sosyal Medya Entegrasyonları" => true,
                "Hızlı WhatsApp ve Telefon Butonu" => true,
                "Blog Sistemi" => true,
                "Galeri (Fotoğraf Modülü)" => true,
                "Teknik Destek ve Yedekleme Hizmeti" => true,
                "Domain + Hosting Hizmeti (1 Yıllık)" => true,
                "Google Harita Kaydı (My Business)" => true,
                "Yandex Harita Kaydı" => true,
                "Meta Etiket Yönetimi" => true,
                "Site Haritası ve Search Console Kaydı" => true,
                "Google Analytics + Tag Manager Entegrasyonu" => true,
                "Pop-up ve Duyuru Alanları" => true,
                "Teklif Formu / Talep Formu" => true,
                "KVKK & Gizlilik Politikası Sayfaları" => true,
                "Referanslar ve Projeler Modülü" => true,
                "İçerik Giriş Eğitimi (PDF veya Video)" => true,
                "Ziyaretçi IP ve Form Kayıt Loglama" => true,
                "Gelişmiş Güvenlik Önlemleri (Bot Koruma, Firewall)" => true,
                "Modern ve Kurumsal UI/UX Tasarım" => true,
                "Haftalık Otomatik Yedekleme" => true,
                "Gelişmiş Raporlama (Form, Tıklama, Ziyaretçi)" => true,
                "Apple Maps Kaydı" => true,
                "Yerel SEO Uyumlu Ayarlar" => true,
                "Çoklu Dil Desteği" => true,
                "Blog + Haber Sistemi" => true,
                "AMP Sayfa Desteği" => true,
                "PWA Desteği (Uygulama gibi çalışma)" => true,
                "Push Bildirim Sistemi" => true,
                "Ekibimiz Sayfasında Dinamik Profil Kartları" => true,
                "Sertifikalar, Belgeler Galerisi" => true,
                "Ziyaretçi Canlı Destek Entegrasyonu (Tawk.to, LiveChat vs.)" => false,
                "Yönetim Panelinden Proje & Duyuru Yönetimi" => false,
                "Veri Şifreleme (Veritabanı ve Formlar)" => false,
                "Site İçi Arama Takibi (Aranan Kelimeler)" => false
            ],
            'Next ProVision' => [
                "Mobil Uyumlu (Responsive) Tasarım" => true,
                "SEO Uyumlu Kodlama ve Yapılandırma" => true,
                "Hızlı Açılış Süresi (Optimize Performans)" => true,
                "Yönetim Paneli (Admin Panel)" => true,
                "SSL Sertifikası (Güvenli Bağlantı)" => true,
                "Ana Sayfa Slider Alanı" => true,
                "İletişim Formu (Google Maps ile Entegre)" => true,
                "Hakkımızda ve Ekibimiz Sayfası" => true,
                "Ürün/Hizmet Tanıtım Sayfaları" => true,
                "Sınırsız Sayfa Ekleyebilme" => true,
                "Sosyal Medya Entegrasyonları" => true,
                "Hızlı WhatsApp ve Telefon Butonu" => true,
                "Blog Sistemi" => true,
                "Galeri (Fotoğraf Modülü)" => true,
                "Teknik Destek ve Yedekleme Hizmeti" => true,
                "Domain + Hosting Hizmeti (1 Yıllık)" => true,
                "Google Harita Kaydı (My Business)" => true,
                "Yandex Harita Kaydı" => true,
                "Meta Etiket Yönetimi" => true,
                "Site Haritası ve Search Console Kaydı" => true,
                "Google Analytics + Tag Manager Entegrasyonu" => true,
                "Pop-up ve Duyuru Alanları" => true,
                "Teklif Formu / Talep Formu" => true,
                "KVKK & Gizlilik Politikası Sayfaları" => true,
                "Referanslar ve Projeler Modülü" => true,
                "İçerik Giriş Eğitimi (PDF veya Video)" => true,
                "Ziyaretçi IP ve Form Kayıt Loglama" => true,
                "Gelişmiş Güvenlik Önlemleri (Bot Koruma, Firewall)" => true,
                "Modern ve Kurumsal UI/UX Tasarım" => true,
                "Haftalık Otomatik Yedekleme" => true,
                "Gelişmiş Raporlama (Form, Tıklama, Ziyaretçi)" => true,
                "Apple Maps Kaydı" => true,
                "Yerel SEO Uyumlu Ayarlar" => true,
                "Çoklu Dil Desteği" => true,
                "Blog + Haber Sistemi" => true,
                "AMP Sayfa Desteği" => true,
                "PWA Desteği (Uygulama gibi çalışma)" => true,
                "Push Bildirim Sistemi" => true,
                "Ekibimiz Sayfasında Dinamik Profil Kartları" => true,
                "Sertifikalar, Belgeler Galerisi" => true,
                "Ziyaretçi Canlı Destek Entegrasyonu (Tawk.to, LiveChat vs.)" => true,
                "Yönetim Panelinden Proje & Duyuru Yönetimi" => true,
                "Veri Şifreleme (Veritabanı ve Formlar)" => true,
                "Site İçi Arama Takibi (Aranan Kelimeler)" => true
            ]
        ];

        return view('services.webtasarim.kurumsal-web-tasarim', compact('paketler'));
    }
    public function ampwebtasarim(){
        return view('services.webtasarim.amp-web-tasarim');
    }
    public function kisiselwebsitesitasarimi(){
        return view('services.webtasarim.kisisel-web-sitesi-tasarimi');
    }
    public function uruntanitimsitesi(){
        return view('services.webtasarim.urun-tanitim-sitesi');
    }
    public function onepagewebtasarim(){
        return view('services.webtasarim.one-page-web-tasarim');
    }
    public function forumvetopluluksitetasarimi(){
        return view('services.webtasarim.forum-ve-topluluk-site-tasarimi');
    }
    public function pwawebtasarim(){
        return view('services.webtasarim.pwa-web-tasarim');
    }
    public function emlaksitesiyazilimi(){
        return view('services.yazilim.emlak-sitesi-yazilimi');
    }
    public function habersitesiyazilimi(){
        return view('services.yazilim.haber-sitesi-yazilimi');
    }
    public function onlineegitimyazilimi(){
        return view('services.yazilim.online-egitim-yazilimi');
    }
    public function freelancersitesiyazilimi(){
        return view('services.yazilim.freelancer-sitesi-yazilimi');
    }
    public function bayiyazilimi(){
        return view('services.yazilim.bayi-yazilimi');
    }
    public function b2beticaretyazilimi(){
        return view('services.yazilim.b2b-eticaret-yazilimi');
    }
    public function b2ceticaretyazilimi(){
        return view('services.yazilim.b2c-eticaret-yazilimi');
    }
    public function otelrezervasyonyazilimi(){
        return view('services.yazilim.otel-rezervasyon-yazilimi');
    }

    public function seodanismanligi(){
        return view('services.dijitalpazarlama.seo-danismanligi');
    }
    public function googlereklamdanismanligi(){
        return view('services.dijitalpazarlama.google-reklam-danismanligi');
    }
    public function sosyalmedyayonetimi(){
        return view('services.dijitalpazarlama.sosyal-medya-yonetimi');
    }
    public function metareklamyonetimi(){
        return view('services.dijitalpazarlama.meta-reklam-yonetimi');
    }
    public function duzenleniyor(){
        return view('duzenleniyor');
    }



}







