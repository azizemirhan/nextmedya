@extends('layouts.master') @section('custom_header')
@include('layouts.header-dark') @endsection @section('meta_title') Next Medya ®
» Kurumsal Web Sitesi Tasarımı, Web Yazılım – Ankara @endsection
@section('meta_keywords') Ankara web tasarım, Next Medya Web Tasarım, Keçiören
web tasarım, Çankaya web tasarım, Yenimahalle web tasarım, Ostim web tasarım,
kurumsal web tasarım, web tasarımcı, Ankara web site, web tasarım firmaları, web
tasarım ajansı, web dizayn, özel web tasarım, ödüllü web tasarım, web yazılım,
web tasarımcısı, hazır web sitesi, profesyonel web tasarım, tasarım ajansı,
kurumsal web sitesi, web sayfası tasarımı, ucuz web tasarım, internet sitesi
yapımı, site tasarım, İstanbul web tasarım, web sitesi kur, kurumsal web sitesi
firması, web sitesi tasarımcısı, Anadolu yakası web ajans, en iyi web tasarım
ajansı, interaktif ajans, web sitesi yapan firma @endsection
@section('og_title') Next Medya ® » Kurumsal Web Sitesi Tasarımı, Web Yazılım –
Ankara @endsection @section('og_image')
https://www.nextmedya.com/kurumsal-web-tasarim.png @endsection
@section('og_secure_url') https://www.nextmedya.com/kurumsal-web-tasarim.png
@endsection @section('og_image_alt') Next Medya Ankara – En İyi Kurumsal Web
Tasarım & Yazılım Çözümleri 2025 @endsection @section('og_description') Next
Medya; Ankara’da kurumsal web tasarım, SEO, özel yazılım ve dijital
stratejilerle markanızı rakiplerinizden ayıran profesyonel çözümler sunar.
@endsection @php $structuredFolder = 'kurumsal-web-tasarim'; $structuredFile =
'site.json'; @endphp @section('content')
<div class="service-details__area service-details__space pt-200 pb-120">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="service-details__title-box mb-40">
          <span
            class="service-details__subtitle tp-char-animation"
            style="font-size: 40px"
            >Kurumsal</span
          >
          <h4 class="sv-hero-title tp-char-animation">Web Tasarım</h4>
        </div>
      </div>
      <div class="row">
        <div class="offset-xl-4 col-xl-5">
          <div class="service-details__banner-text mb-80">
            <p class="mb-30 tp_title_anim">
              Next Medya, dijital dünyadaki duruşunuzu yeniden tanımlamak için
              kullanıcı deneyimini merkeze alır.Kurumsal web tasarım projenizde
              ihtiyaçlarınıza özel, strateji odaklı dijital çözümler sunarak
              size destek oluyoruz.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-lg-7">
        <div class="service-details__left-wrap">
          <div class="service-details__left-text pb-20">
            <p class="text-1 tp_title_anim">
              Ankara merkezli dijital çözüm ortağınız Next Medya, sektörü analiz
              eder ve sizin için sürdürülebilir dijital varlıklar üretir.
            </p>
            <p>Her sektörün dinamiği farklıdır. Bu farkı anlayarak;</p>
          </div>
          <div class="service-details__fea-list">
            <ul>
              <li>
                Kurumsal dilinize uygun, hızlı ve özgün tasarımlar
                oluşturuyoruz.
              </li>
              <li>
                Dijital varlığınızı sürdürülebilir ve performans odaklı hale
                getiriyoruz.
              </li>
            </ul>
          </div>
          <div class="service-details__left-text">
            <p>
              Tasarım sürecimizde yalnızca estetiğe değil, aynı zamanda
              kullanılabilirlik, mobil uyumluluk, hız, güvenlik ve SEO gibi
              temel performans kriterlerine de önem veriyoruz. “Ortak başarı”
              anlayışımızla size, sektörde fark yaratan projeler sunuyoruz. Bu
              süreçte sunduğumuz her çözüm, yalnızca bugünün değil, yarının
              dijital ihtiyaçlarını da karşılayacak şekilde kurgulanmıştır.
            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5">
        <div class="service-details__right-wrap fix p-relative">
          <div
            class="service-details__right-text-box"
            style="margin-bottom: 40px"
          >
            <h4>
              Başka Neler <br />
              Var ?
            </h4>
          </div>
          <div class="service-details__right-category">
            <a href="{{ route('kurumsalwebtasarim') }}" class="active"
              >Kurumsal Web Tasarım</a
            >
            <a href="{{ route('ampwebtasarim') }}">AMP Web Tasarım</a>
            <a href="{{ route('ampwebtasarim') }}">Kişisel Web Tasarım</a>
            <a href="{{ route('uruntanitimsitesi') }}">Ürün Tanıtım Sitesi</a>
            <a href="{{ route('onepagewebtasarim') }}">One Page Web Tasarım</a>
            <a href="{{ route('seodanismanligi') }}">Seo Danışmanlığı</a>
            <a href="{{ route('pwawebtasarim') }}">PWA Web Tasarım</a>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <button onclick="openModal()" class="glowing-btn">
                <span
                  class="glowing-txt"
                  style="font-size: 20px; letter-spacing: 2px"
                  >Detaylı Bilgi Alın</span
                >
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container" style="margin-top: -50px">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Süreç Nasıl İşliyor ?</h1>
      <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
        <li style="--accent-color: #000" class="timeline-li">
          <div class="date">Analiz & İhtiyaç Belirleme</div>
          <div class="descr">
            Web tasarım süreci, firmanızın hedef kitlesi, sektörel konumunun ve
            dijital ihtiyaçlarının detaylı analiziyle başlar. Hedeflerinizi
            netleştiririz ve markanıza özel bir web tasarım stratejik bir yol
            haritası oluştururuz.
          </div>
        </li>
        <li style="--accent-color: #000" class="timeline-li">
          <div class="date">Bilgilendirme & Teklif Süreci</div>
          <div class="descr">
            Yaptığımız analizler doğrultusunda, size özel hazırlanmış bir web
            tasarım teklifi ve zaman çizelgesi sunarız. Projenin tüm teknik
            detayları ve teslim süresi konusunda sizi açık ve şeffaf bir şekilde
            bilgilendiririz.
          </div>
        </li>

        <li style="--accent-color: #000" class="timeline-li">
          <div class="date">Bilgi Mimarisi</div>
          <div class="descr">
            Sayfa yapıları, içerik diyagramları ve kullanıcı akışlarını
            belirleyerek wireframe ve mockup (taslak) tasarımları hazırlarız. Bu
            aşama, kullanıcı deneyimi odaklı bir web tasarım altyapısının
            temelini oluşturur.
          </div>
        </li>
        <li style="--accent-color: #000" class="timeline-li">
          <div class="date">Arayüz Tasarımı</div>
          <div class="descr">
            Mockup onayınızın ardından, kurumsal kimliğinize uygun renk paleti,
            tipografi ve ikonografi ile modern ve özgün UI (arayüz) tasarımları
            geliştiririz. Bu web tasarım süreci, dijital kimliğinizi yansıtır.
          </div>
        </li>
        <li style="--accent-color: #000" class="timeline-li">
          <div class="date">Kodlama Süreci</div>
          <div class="descr">
            Onaylanan web tasarım tasarımları, mobil uyumlu olarak HTML/CSS/JS
            kodlarına dönüştürülür. Ardından CMS (içerik yönetim sistemi) ve
            gerekiyorsa özel modüller entegre edilir. Tüm sistem test edilerek
            yayına hazır hale getirilir.
          </div>
        </li>
        <li style="--accent-color: #000" class="timeline-li">
          <div class="date">Yayına Alma</div>
          <div class="descr">
            Tüm testler başarıyla tamamlandıktan sonra web sitenizi demo
            ortamında incelemeniz için sunarız. Son onayla birlikte web siteniz
            yayına alınır ve yetkili kullanıcılar için içerik yönetim paneli
            eğitimi verilir.
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="container" style="padding-bottom: 200px; padding-top: 30px">
      <header>
        <h1 style="color: #4285f4">Web Sitesi Paketlerimiz</h1>
        <p style="font-size: 30px; color: #d51920">
          İşletmeniz veya Projeleriniz için en uygun paketleri inceleyin.
        </p>
        <p style="font-size: 20px; color: #d51920">
          Paketlerimiz içerik olarak aynıdır tek değişen kodlandığı altyapıdır
        </p>
      </header>
      <div class="comparison-table" style="margin-top: 50px">
        <div class="plan-cards">
          <div class="plan-card starter">
            <div class="plan-header">
              <div class="plan-name">Başlangıç Paketi</div>
              <div class="plan-price">Müşteriye Özel Fiyat</div>
              <div class="plan-cta">
                <button class="cta-btn" onclick="openModal()">
                  Şimdi Fiyat Al
                </button>
                <a href="tel:+905326437544" style="color: #fff; border-radius: 20px" class="btn btn-info ml-5">
                  Şimdi Ara
                </a>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Genel Özellikler
            </h3>
            <div class="plan-features">
              <!-- Genel / Altyapı -->
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yıllık Yenileme Ücreti: 3000₺</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Domain + Hosting Hizmeti (1 Yıllık)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Aylık Trafik Kapasitesi: 1000 GB</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Veritabanı Alanı : 5000 MB</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ücretsiz CDN Entegrasyonu</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Günlük Otomatik Yedekleme</div>
              </div>
              <div class="feature-item">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ücretsiz SSL Sertifikası</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">E-Posta Hesabı : 10 Adet</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Mobil Uyumlu (Responsive) Tasarım
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  SEO Uyumlu Kodlama ve Yapılandırma
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Hızlı Açılış Süresi (Optimize Performans)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yönetim Paneli (Admin Panel)</div>
              </div>
              <div class="feature-item">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  SSL Sertifikası (Güvenli Bağlantı)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ana Sayfa Slider Alanı</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  İletişim Formu (Google Maps ile Entegre)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Hakkımızda ve Ekibimiz Sayfası</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ürün/Hizmet Tanıtım Sayfaları</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">10 Sayfa Tasarımı</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Sosyal Medya Entegrasyonları</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Hızlı WhatsApp ve Telefon Butonu</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Blog Sistemi</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Galeri (Fotoğraf Modülü)</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Teknik Destek ve Yedekleme Hizmeti
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Harita / Kayıtlar
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Google Harita Kaydı (My Business)
                </div>
              </div>
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Yandex Harita Kaydı</div>
              </div>
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Apple Maps Kaydı</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Seo
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Meta Etiket Yönetimi</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Site Haritası ve Search Console Kaydı
                </div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Google Analytics + Tag Manager Entegrasyonu
                </div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yerel SEO Uyumlu Ayarlar</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Blog + Haber Sistemi</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">AMP Sayfa Desteği</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Schema Entegrasyonu</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Etkileşim Dönüşüm
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="engagement">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Pop-up ve Duyuru Alanları</div>
              </div>
              <div class="feature-item" data-category="forms">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Teklif Formu / Talep Formu</div>
              </div>
              <div class="feature-item" data-category="legal">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  KVKK & Gizlilik Politikası Sayfaları
                </div>
              </div>
              <div class="feature-item" data-category="content">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Referanslar ve Projeler Modülü</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  İçerik Giriş Eğitimi (PDF veya Video)
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Loglama / Güvenlik
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="security">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">
                  Ziyaretçi IP ve Form Kayıt Loglama
                </div>
              </div>
              <div class="feature-item" data-category="security">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">
                  Gelişmiş Güvenlik Önlemleri (Bot Koruma, Firewall)
                </div>
              </div>
              <div class="feature-item" data-category="backup">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Haftalık Otomatik Yedekleme</div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">
                  Gelişmiş Raporlama (Form, Tıklama, Ziyaretçi)
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              UX / UI
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="design">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Modern ve Kurumsal UI/UX Tasarım</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Uluslararasılaştırma
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="i18n">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Çoklu Dil Desteği</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              İleri Seviye Modüller
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="pwa">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">
                  PWA Desteği (Uygulama gibi çalışma)
                </div>
              </div>
              <div class="feature-item" data-category="pwa">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Push Bildirim Sistemi</div>
              </div>
              <div class="feature-item" data-category="team">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ekibimiz Sayfasında Dinamik Profil Kartları
                </div>
              </div>
              <div class="feature-item" data-category="media">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Sertifikalar, Belgeler Galerisi</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ziyaretçi Canlı Destek Entegrasyonu (Tawk.to, LiveChat vs.)
                </div>
              </div>
              <div class="feature-item" data-category="cms">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Yönetim Panelinden Proje &amp; Duyuru Yönetimi
                </div>
              </div>
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Veri Şifreleme (Veritabanı ve Formlar)
                </div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Site İçi Arama Takibi (Aranan Kelimeler)
                </div>
              </div>
            </div>
          </div>
          <div class="plan-card pro popular">
            <div class="plan-header">
              <div class="plan-name">Standart Paket</div>
              <div class="plan-price">Müşteriye Özel Fiyat</div>
              <div class="plan-cta">
                <button class="cta-btn" onclick="openModal()">
                  Şimdi Fiyat Al
                </button>
                <a href="tel:+905326437544" style="color: #fff; border-radius: 20px" class="btn btn-info ml-5">
                  Şimdi Ara
                </a>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Genel Özellikler
            </h3>
            <div class="plan-features">
              <!-- Genel / Altyapı -->
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yıllık Yenileme Ücreti: 3000₺</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Domain + Hosting Hizmeti (1 Yıllık)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Aylık Trafik Kapasitesi: 1000 GB</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Veritabanı Alanı : 5000 MB</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ücretsiz CDN Entegrasyonu</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Günlük Otomatik Yedekleme</div>
              </div>
              <div class="feature-item">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ücretsiz SSL Sertifikası</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">E-Posta Hesabı : 15 Adet</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Mobil Uyumlu (Responsive) Tasarım
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  SEO Uyumlu Kodlama ve Yapılandırma
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Hızlı Açılış Süresi (Optimize Performans)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yönetim Paneli (Admin Panel)</div>
              </div>
              <div class="feature-item">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  SSL Sertifikası (Güvenli Bağlantı)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ana Sayfa Slider Alanı</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  İletişim Formu (Google Maps ile Entegre)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Hakkımızda ve Ekibimiz Sayfası</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ürün/Hizmet Tanıtım Sayfaları</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">15 Sayfa Tasarımı</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Sosyal Medya Entegrasyonları</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Hızlı WhatsApp ve Telefon Butonu</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Blog Sistemi</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Galeri (Fotoğraf Modülü)</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Teknik Destek ve Yedekleme Hizmeti
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Harita / Kayıtlar
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Google Harita Kaydı (My Business)
                </div>
              </div>
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yandex Harita Kaydı</div>
              </div>
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Apple Maps Kaydı</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Seo
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Meta Etiket Yönetimi</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Site Haritası ve Search Console Kaydı
                </div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Google Analytics + Tag Manager Entegrasyonu
                </div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yerel SEO Uyumlu Ayarlar</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Blog + Haber Sistemi</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">AMP Sayfa Desteği</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Schema Entegrasyonu</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Etkileşim Dönüşüm
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="engagement">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Pop-up ve Duyuru Alanları</div>
              </div>
              <div class="feature-item" data-category="forms">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Teklif Formu / Talep Formu</div>
              </div>
              <div class="feature-item" data-category="legal">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  KVKK & Gizlilik Politikası Sayfaları
                </div>
              </div>
              <div class="feature-item" data-category="content">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Referanslar ve Projeler Modülü</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  İçerik Giriş Eğitimi (PDF veya Video)
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Loglama / Güvenlik
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ziyaretçi IP ve Form Kayıt Loglama
                </div>
              </div>
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Gelişmiş Güvenlik Önlemleri (Bot Koruma, Firewall)
                </div>
              </div>
              <div class="feature-item" data-category="backup">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Haftalık Otomatik Yedekleme</div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">
                  Gelişmiş Raporlama (Form, Tıklama, Ziyaretçi)
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              UX / UI
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="design">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Modern ve Kurumsal UI/UX Tasarım</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Uluslararasılaştırma
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="i18n">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Çoklu Dil Desteği</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              İleri Seviye Modüller
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="pwa">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  PWA Desteği (Uygulama gibi çalışma)
                </div>
              </div>
              <div class="feature-item" data-category="pwa">
                <div class="feature-icon check" style="color: red;">x</div>
                <div class="feature-text" style="color: red">Push Bildirim Sistemi</div>
              </div>
              <div class="feature-item" data-category="team">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ekibimiz Sayfasında Dinamik Profil Kartları
                </div>
              </div>
              <div class="feature-item" data-category="media">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Sertifikalar, Belgeler Galerisi</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ziyaretçi Canlı Destek Entegrasyonu (Tawk.to, LiveChat vs.)
                </div>
              </div>
              <div class="feature-item" data-category="cms">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Yönetim Panelinden Proje &amp; Duyuru Yönetimi
                </div>
              </div>
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Veri Şifreleme (Veritabanı ve Formlar)
                </div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Site İçi Arama Takibi (Aranan Kelimeler)
                </div>
              </div>
            </div>
          </div>
          <div class="plan-card business">
            <div class="plan-header">
              <div class="plan-name">Profesyonel Paket</div>
              <div class="plan-price">Müşteriye Özel Fiyat</div>
              <div class="plan-cta">
                <button class="cta-btn" onclick="openModal()">
                  Şimdi Fiyat Al
                </button>
                <a href="tel:+905326437544" style="color: #fff; border-radius: 20px" class="btn btn-info ml-5">
                  Şimdi Ara
                </a>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Genel Özellikler
            </h3>
            <div class="plan-features">
              <!-- Genel / Altyapı -->
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yıllık Yenileme Ücreti: 3000₺</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Domain + Hosting Hizmeti (1 Yıllık)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Aylık Trafik Kapasitesi: 1000 GB</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Veritabanı Alanı : 5000 MB</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ücretsiz CDN Entegrasyonu</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Günlük Otomatik Yedekleme</div>
              </div>
              <div class="feature-item">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ücretsiz SSL Sertifikası</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">E-Posta Hesabı : 20 Adet</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Mobil Uyumlu (Responsive) Tasarım
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  SEO Uyumlu Kodlama ve Yapılandırma
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Hızlı Açılış Süresi (Optimize Performans)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yönetim Paneli (Admin Panel)</div>
              </div>
              <div class="feature-item">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  SSL Sertifikası (Güvenli Bağlantı)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ana Sayfa Slider Alanı</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  İletişim Formu (Google Maps ile Entegre)
                </div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Hakkımızda ve Ekibimiz Sayfası</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Ürün/Hizmet Tanıtım Sayfaları</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">25 Sayfa Tasarımı</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Sosyal Medya Entegrasyonları</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Hızlı WhatsApp ve Telefon Butonu</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Blog Sistemi</div>
              </div>
              <div class="feature-item" data-category="basic">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Galeri (Fotoğraf Modülü)</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Teknik Destek ve Yedekleme Hizmeti
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Harita / Kayıtlar
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Google Harita Kaydı (My Business)
                </div>
              </div>
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yandex Harita Kaydı</div>
              </div>
              <div class="feature-item" data-category="advanced">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Apple Maps Kaydı</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Seo
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Meta Etiket Yönetimi</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Site Haritası ve Search Console Kaydı
                </div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Google Analytics + Tag Manager Entegrasyonu
                </div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Yerel SEO Uyumlu Ayarlar</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Blog + Haber Sistemi</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">AMP Sayfa Desteği</div>
              </div>
              <div class="feature-item" data-category="seo">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Schema Entegrasyonu</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Etkileşim Dönüşüm
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="engagement">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Pop-up ve Duyuru Alanları</div>
              </div>
              <div class="feature-item" data-category="forms">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Teklif Formu / Talep Formu</div>
              </div>
              <div class="feature-item" data-category="legal">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  KVKK & Gizlilik Politikası Sayfaları
                </div>
              </div>
              <div class="feature-item" data-category="content">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Referanslar ve Projeler Modülü</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  İçerik Giriş Eğitimi (PDF veya Video)
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Loglama / Güvenlik
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ziyaretçi IP ve Form Kayıt Loglama
                </div>
              </div>
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Gelişmiş Güvenlik Önlemleri (Bot Koruma, Firewall)
                </div>
              </div>
              <div class="feature-item" data-category="backup">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Haftalık Otomatik Yedekleme</div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Gelişmiş Raporlama (Form, Tıklama, Ziyaretçi)
                </div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              UX / UI
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="design">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Modern ve Kurumsal UI/UX Tasarım</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              Uluslararasılaştırma
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="i18n">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Çoklu Dil Desteği</div>
              </div>
            </div>
            <h3 style="background-color: #dee2e6; color: #fff; padding: 10px">
              İleri Seviye Modüller
            </h3>
            <div class="plan-features">
              <div class="feature-item" data-category="pwa">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  PWA Desteği (Uygulama gibi çalışma)
                </div>
              </div>
              <div class="feature-item" data-category="pwa">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Push Bildirim Sistemi</div>
              </div>
              <div class="feature-item" data-category="team">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ekibimiz Sayfasında Dinamik Profil Kartları
                </div>
              </div>
              <div class="feature-item" data-category="media">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">Sertifikalar, Belgeler Galerisi</div>
              </div>
              <div class="feature-item" data-category="support">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Ziyaretçi Canlı Destek Entegrasyonu (Tawk.to, LiveChat vs.)
                </div>
              </div>
              <div class="feature-item" data-category="cms">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Yönetim Panelinden Proje &amp; Duyuru Yönetimi
                </div>
              </div>
              <div class="feature-item" data-category="security">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Veri Şifreleme (Veritabanı ve Formlar)
                </div>
              </div>
              <div class="feature-item" data-category="analytics">
                <div class="feature-icon check">✓</div>
                <div class="feature-text">
                  Site İçi Arama Takibi (Aranan Kelimeler)
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="showcase-details-2-slider-area pb-120">
  <div class="moving-gallery">
    <div
      class="showcase-details-2-slider-wrap wrapper-gallery slider-wrap-top d-flex align-items-end mb-20"
    >
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans5.png') }}" alt="" />
      </div>
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans3.png') }}" alt="" />
      </div>
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans1.png') }}" alt="" />
      </div>
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans5.png') }}" alt="" />
      </div>
    </div>
  </div>

  <div class="moving-gallery">
    <div
      class="showcase-details-2-slider-wrap wrapper-gallery slider-wrap-bottom d-flex align-items-start"
    >
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans6.png') }}" alt="" />
      </div>
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans2.png') }}" alt="" />
      </div>
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans4.png') }}" alt="" />
      </div>
      <div class="showcase-details-2-slider-item">
        <img src="{{ asset('referans6.png') }}" alt="" />
      </div>
    </div>
  </div>
  <div style="display: flex; align-items: center; justify-content: center">
    <a
      href="{{ route('referanslarimiz') }}"
      style="background-color: #000; color: #fff; padding: 7px 9px"
      >Tüm Referanslarımız</a
    >
  </div>
</div>
@endsection
