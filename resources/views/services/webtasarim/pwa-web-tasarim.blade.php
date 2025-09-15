@extends('layouts.master')
@section('custom_header')
    @include('layouts.header-dark')
@endsection
@section('content')
    <div class="service-details__area service-details__space pt-200 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="service-details__title-box mb-40">
                        <span class="service-details__subtitle tp-char-animation" style="font-size: 40px">
                            PWA Web Tasarım</span>
                        <h4 class="sv-hero-title tp-char-animation">Progressive Web App (PWA) Web Tasarımı
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                PWA (Progressive Web App) web tasarımı, mobil cihazlar ve masaüstü
                                bilgisayarlar için
                                yüksek performanslı, hızlı ve kullanıcı dostu web uygulamaları oluşturmanıza
                                olanak sağlar.
                                Web siteniz, internet bağlantısı olmasa bile kullanıcılar tarafından
                                sorunsuzca kullanılabilir,
                                böylece kullanıcı deneyimini en üst düzeye çıkarırız. Next Medya olarak, PWA
                                teknolojisini
                                sitenizin her cihazda hızlı yüklenmesini ve mükemmel bir performans
                                sergilemesini sağlayacak
                                şekilde entegre ediyoruz.
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
                                PWA Web Tasarımı, geleneksel web sitelerinin ötesine geçerek
                                kullanıcılarınıza
                                uygulama benzeri deneyimler sunar. İnternet bağlantısı olmayan ortamlarda
                                bile kullanıcılarınız
                                sitenize kolayca erişebilir. SEO uyumlu yapımızla, PWA sitenizin arama
                                motorlarında yüksek sıralarda
                                yer almasını sağlarız. Ayrıca, hızlı yükleme süreleri, mobil uyumluluk ve
                                kullanıcı dostu arayüz ile
                                sitenizin etkinliğini artırırız.
                            </p>
                            <p>PWA Web Tasarımı ile;</p>
                        </div>
                        <div class="service-details__fea-list">
                            <ul>
                                <li>Mobil uyumlu ve uygulama benzeri bir deneyim sunarak kullanıcıların
                                    sitenizde daha uzun süre
                                    kalmasını sağlarız.</li>
                                <li>SEO uyumlu PWA yapıları ile sitenizin organik arama sonuçlarında daha
                                    görünür hale gelmesini sağlarız.</li>
                                <li>Offline çalışma özelliği ile kullanıcılarınızın internet bağlantısı
                                    olmadığında dahi sitenizi ziyaret etmelerini sağlarız.</li>
                                <li>Hızlı yükleme süreleri ve kesintisiz kullanıcı deneyimi ile web
                                    sitenizin performansını en üst düzeye çıkarırız.</li>
                                <li>Push bildirimleri ile kullanıcılarınıza doğrudan ulaşarak etkileşimi
                                    artırırız.</li>
                            </ul>
                        </div>
                        <div class="service-details__left-text">
                            <p>PWA Web Tasarımı, özellikle mobil cihaz kullanıcıları için mükemmel bir çözüm
                                sunar.
                                İnternet bağlantısı sorunları yaşandığında bile sitenizin erişilebilir
                                olmasını sağlar ve
                                mobil performansı en üst seviyeye çıkarır. SEO uyumlu yapımız sayesinde, PWA
                                siteniz arama motorlarında
                                daha fazla görünürlük kazanır ve yüksek sıralamalara yerleşir.</p>
                            <p>Gelişen teknolojilere ayak uydurmak ve kullanıcılarınızı etkili bir şekilde
                                hedeflemek için
                                PWA Web Tasarımı, işinizin dijital alanda güçlü bir varlık oluşturmasına
                                yardımcı olacaktır.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="service-details__right-wrap fix p-relative">
                        <div class="service-details__right-text-box" style="margin-bottom: 40px">
                            <h4>Başka Neler <br> Var ?</h4>
                        </div>
                        <div class="service-details__right-category">
                            <a href="{{ route('kurumsalwebtasarim') }}">Kurumsal Web Tasarım</a>
                            <a href="{{ route('ampwebtasarim') }}">AMP Web Tasarım</a>
                            <a href="{{ route('kisiselwebsitesitasarimi') }}">Kişisel Web Tasarım</a>
                            <a href="{{ route('uruntanitimsitesi') }}">Ürün Tanıtım Sitesi</a>
                            <a href="{{ route('onepagewebtasarim') }}">One Page Web Tasarım</a>
                            <a href="{{ route('seodanismanligi') }}">Seo Danışmanlığı</a>
                            <a href="{{ route('pwawebtasarim') }}" class="active">PWA Web Tasarım</a>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button onclick="openModal()" class='glowing-btn'><span class='glowing-txt'
                                        style="font-size: 20px; letter-spacing: 2px">Detaylı Bilgi
                                        Alın</span></button>
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
                <h1>PWA Web Tasarım Süreci Nasıl İşler?</h1>
                <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Analiz & Hedef Belirleme</div>
                        <div class="descr">PWA web tasarım sürecimiz, kullanıcı ihtiyaçlarını ve web sitenizin
                            hız, güvenlik, mobil uyumluluk gibi performans hedeflerini belirleyerek başlar. PWA, hız
                            optimizasyonu ve offline erişim gibi özelliklerle kullanıcı deneyimini iyileştirir. Bu aşamada,
                            SEO dostu, mobil uyumlu ve hızlı bir site için gerekli temelleri atıyoruz.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Bilgilendirme & Teklif Süreci</div>
                        <div class="descr">PWA web tasarımının kapsamını belirledikten sonra, ihtiyaçlarınıza özel
                            bir teklif sunuyoruz. Teklifte, site hız optimizasyonu, offline kullanım, push bildirimleri
                            gibi PWA özelliklerinin yanı sıra, SEO uyumlu yapılar ve mobil dostu arayüzler gibi
                            unsurlar detaylandırılır. Ayrıca, proje süresi ve teslimat takvimi hakkında açık bilgi
                            sağlıyoruz.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">İçerik Yapısı & Mockup Tasarımı</div>
                        <div class="descr">PWA web siteniz için SEO dostu içerik yapısı oluşturuyoruz. Sayfa hızı,
                            mobil uyumluluk ve kullanıcı etkileşimi gibi faktörler göz önünde bulundurularak içerik
                            düzeni planlanır. Ayrıca, mockup tasarımlar ile kullanıcı akışı, görsel öğeler ve site
                            dinamiklerini öngörüyoruz. Bu tasarımlar, PWA özelliklerini en verimli şekilde yansıtır.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Arayüz Tasarımı ve Onay Süreci</div>
                        <div class="descr">Mockup tasarımlarının onaylanmasının ardından, site arayüzünü
                            şık ve modern bir şekilde tasarlıyoruz. Renk paletleri, tipografi, görseller ve etkileşimli
                            ögeler, SEO ve PWA standartlarına uygun seçilerek sitenizi dijital dünyada etkili bir şekilde
                            temsil ederiz. Tasarımda kullanıcı deneyimi (UX) ve etkileşim ön planda tutulur, hız ve
                            erişilebilirlik optimize edilir.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Kodlama & Sistem Entegrasyonu</div>
                        <div class="descr">Onaylanan tasarımlar, SEO uyumlu yapılarla birlikte hızlı yükleme
                            sürelerini sağlamak için kodlanır. PWA'nın temel özellikleri olan offline erişim, push
                            bildirimleri ve hızlı yükleme entegrasyonları yapılır. Ayrıca, sosyal medya bağlantıları ve
                            kullanıcı etkileşimlerini kolaylaştıran sistemler entegre edilir. Sitenin her cihazda uyumlu
                            çalışması için optimize edilmesi sağlanır.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Yayına Alma & Eğitim Süreci</div>
                        <div class="descr">Tüm testler başarıyla tamamlandığında, PWA web siteniz demo ortamında
                            ön izlemeye sunulur. Son onayınızın ardından siteyi canlıya alıyoruz. Ayrıca, PWA özelliklerinin
                            yönetimi, içerik güncellemeleri ve kullanıcı etkileşimleri hakkında eğitim veriyoruz. SEO
                            yönetimi
                            ve site analizleri konusunda size rehberlik ediyoruz. Hızlı yükleme süreleri ve kullanıcı
                            deneyimi
                            optimizasyonu hakkında detaylı bilgi sağlıyoruz.</div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="tp-price-area">
        <div class="container">
            <div class="row">

                <!-- PWA Giriş -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item">
                        <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-1.jpg') }}"
                            style="background-image: url('assets/img/price/price-bg-1.jpg');">
                            <h5 style="font-size: 30px">PWA — Giriş</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>12000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Manifest.json kurulumu (ad, ikonlar, tema
                                        rengi)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Servis Worker temel kurgu (app shell +
                                        offline ana sayfa)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>“Ana Ekrana Ekle” (A2HS) akışı ve kurulum
                                        banner’ı</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Önbellekleme: Precache kritik varlıklar
                                        (HTML/CSS/JS, ikonlar)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>HTTPS yapılandırma & temel güvenlik
                                        başlıkları</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Lighthouse PWA skoru ≥ 80 hedeflemesi</li>
                                </ul>
                            </div>
                            <a class="tp-btn-black-md w-100 text-center" href="javascript:void(0);" onclick="openModal()">
                                Detaylı Bilgi Al <span>
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11L11 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M1 1H11V11" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- PWA Standart -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item active"
                        data-background="{{ asset('site/assets/img/price/price-bg-2.jpg') }}"
                        style="background-image: url('assets/img/price/price-bg-2.jpg');">
                        <div class="tp-price-head">
                            <h5 style="font-size: 30px">PWA — Standart</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>18000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Workbox ile cache stratejileri
                                        (Stale-While-Revalidate, Runtime cache)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Offline sayfaları (404/iletişim için
                                        fallback)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Push Bildirimleri (izin akışı + temel
                                        abonelik)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Background Sync (form gönderimi
                                        çevrimdışı kuyruğa alma)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>iOS splash ekranları & ikon paketlemesi
                                    </li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>GA4 etkinlik & offline-queue entegrasyonu
                                    </li>
                                </ul>
                            </div>
                            <a class="tp-btn-black-md white-bg w-100 text-center" href="javascript:void(0);"
                                onclick="openModal()">
                                Detaylı Bilgi Al <span>
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11L11 1" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1 1H11V11" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- PWA Profesyonel -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item">
                        <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-3.jpg') }}"
                            style="background-image: url('assets/img/price/price-bg-3.jpg');">
                            <h5 style="font-size: 30px">PWA — Profesyonel</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>22000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Gelişmiş app-shell mimarisi (kod bölme,
                                        lazy-load, route-level cache)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>IndexedDB ile veri önbellekleme
                                        (liste/detay senaryoları)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Periodic Background Sync / Web Share
                                        Target (uygun tarayıcılarda)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Bildirim segmentasyonu (konu/konum bazlı
                                        topic’ler)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Sürümleme & update flow (SW güncelleme
                                        bildirimi, zorunlu yenileme)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Lighthouse PWA skoru ≥ 95 ve performans
                                        raporu</li>
                                </ul>
                            </div>
                            <a class="tp-btn-black-md w-100 text-center" href="javascript:void(0);"
                                onclick="openModal()">
                                Detaylı Bilgi Al <span>
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11L11 1" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1 1H11V11" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
