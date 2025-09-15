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
                        <span class="service-details__subtitle tp-char-animation" style="font-size: 40px"> Ürün
                            Tanıtımı</span>
                        <h4 class="sv-hero-title tp-char-animation">Web Tasarımı</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                ürünlerinizin online dünyada güçlü bir şekilde tanıtılmasını sağlayacak özel web tasarım
                                çözümleri sunuyoruz. Next Medya, markanızı özgün bir şekilde dijital ortamda
                                sergileyebilmeniz için tasarımlar üretir, her adımda kullanıcı odaklı düşünür ve dönüşüm
                                sağlayan çözümler geliştirir.
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
                            <p class="text-1 tp_title_anim">Next Medya olarak ürün tanıtım web siteleri tasarlarken,
                                yalnızca estetik değil, kullanıcı deneyimini en üst seviyeye taşıyan unsurlara da
                                odaklanırız. Web sitenizin görsel çekiciliği ile birlikte, hızlı yükleme süresi, mobil
                                uyumluluk, SEO uyumlu yapı ve güvenlik gibi temel gereksinimleri de göz önünde bulundururuz.
                            </p>
                            <p> ürününüzün tanıtımı için profesyonel bir online vitrin oluşturmak amacıyla;</p>
                        </div>
                        <div class="service-details__fea-list">
                            <ul>
                                <li>Ürünlerinizin tüm özelliklerini ve avantajlarını görsel ve yazılı olarak etkili bir
                                    şekilde sunarız.</li>
                                <li>Hedef kitlenizin ilgisini çekecek yaratıcı tasarımlar oluştururuz.</li>
                                <li>Sitenizin performansını sürekli olarak optimize eder, hızlı yükleme süreleri sağlar ve
                                    dönüşüm oranlarını artırırız.</li>
                            </ul>
                        </div>
                        <div class="service-details__left-text">
                            <p>Bir ürün tanıtım sitesi sadece ürününüzü tanıtmakla kalmaz, potansiyel müşterilere ürünün
                                kullanımı hakkında bilgi verir ve onları alışverişe teşvik eder. İyi bir web tasarımı, ürünü
                                doğru şekilde sunmak için kritik bir unsurdur. Biz de bu süreci profesyonellik ile
                                yönetiriz.</p>
                            <p>Her projede, müşterimizin hedef kitlesine yönelik özel çözümler geliştirmek ve başarılı
                                dönüşümler elde etmek için çalışıyoruz. Dijital dünyada sadece bugün için değil, gelecekteki
                                ihtiyaçlarınızı da karşılayacak şekilde sürdürülebilir çözümler sunarız.</p>
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
                            <a href="{{ route('uruntanitimsitesi') }}" class="active">Ürün Tanıtım Sitesi</a>
                            <a href="{{ route('onepagewebtasarim') }}">One Page Web Tasarım</a>
                            <a href="{{ route('seodanismanligi') }}">Seo Danışmanlığı</a>
                            <a href="{{ route('pwawebtasarim') }}">PWA Web Tasarım</a>

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
                <h1>Süreç Nasıl İşliyor ?</h1>
                <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Analiz & Ürün Hedefi Belirleme</div>
                        <div class="descr">Web tasarım sürecimiz, ürününüzün hedef kitlesi, pazardaki konumu ve dijital
                            ihtiyaçlarının analiz edilmesiyle başlar. Ürününüzün en güçlü yönlerini belirleyerek,
                            hedeflerinize uygun özel bir tanıtım stratejisi geliştiriyoruz.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Bilgilendirme & Teklif Süreci</div>
                        <div class="descr">Ürün analizine dayalı olarak, size özel bir teklif ve zaman planı oluşturuyoruz.
                            Web sitesi tasarımının kapsamı, hedef kitlenize yönelik tasarım detayları ve teslim süresi
                            hakkında şeffaf bilgi vererek süreci başlatıyoruz.</div>
                    </li>

                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Ürün Yapısı & Mockup Tasarımı</div>
                        <div class="descr">Ürününüzü tanıtan dijital içerik yapılarını oluşturuyoruz. Sayfa yapıları,
                            kullanıcı akışları ve içerik diyagramları ile tasarımın temellerini atarak, ürünü en iyi şekilde
                            sergileyen mockup tasarımları geliştiriyoruz.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Arayüz Tasarımı ve Onay Süreci</div>
                        <div class="descr">Mockup onayınız sonrası, ürününüzün özgün özelliklerini yansıtan, şık ve
                            kullanıcı dostu UI (arayüz) tasarımlarını hazırlıyoruz. Renk paleti, tipografi ve ikonografi ile
                            ürününüzün dijital kimliğini vurguluyoruz.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Kodlama ve Sistem Entegrasyonu</div>
                        <div class="descr">Onaylanan tasarımlar, mobil uyumlu şekilde kodlanır. Frontend geliştirmesi
                            tamamlandıktan sonra, CMS entegrasyonları ve varsa ürününüzle ilgili özel modüller projeye
                            entegre edilir. Sonrasında her şey test edilip yayına hazır hale getirilir.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Yayına Alma ve Eğitim Süreci</div>
                        <div class="descr">Tüm testler başarıyla tamamlandığında, web sitenizi demo ortamda ön izlemeye
                            açıyoruz ve son onayınız sonrası canlıya alıyoruz. Ürününüzün içerik yönetimini kolayca
                            yapabilmeniz için yetkili kullanıcılar için panel eğitimleri sağlıyoruz.</div>
                    </li>
                </ul>

            </div>
        </div>

    </div>
    <div class="tp-price-area">
        <div class="container">
            <div class="row">
                <!-- Giriş Paketi -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item">
                        <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-1.jpg') }}"
                            style="background-image: url('assets/img/price/price-bg-1.jpg');">
                            <h5 style="font-size: 30px">Başlangıç Paket</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>5000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Tek sayfalık ürün tanıtım arayüzü (Landing
                                        Page)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Mobil hız optimizasyonu (Core Web Vitals
                                        odaklı)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Ürün görsel galeri (Slider + Lightbox)
                                    </li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Temel SEO ayarları (title, description,
                                        alt etiketleri)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Hızlı iletişim butonları (WhatsApp,
                                        telefon)</li>
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

                <!-- Orta Paket -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item active"
                        data-background="{{ asset('site/assets/img/price/price-bg-2.jpg') }}"
                        style="background-image: url('assets/img/price/price-bg-2.jpg');">
                        <div class="tp-price-head">
                            <h5 style="font-size: 30px">Standart Paket</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>8000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>5 sayfaya kadar özel tasarım (Ana sayfa,
                                        ürün, hakkımızda, iletişim, blog)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Çoklu ürün/hizmet şablonları (listeleme +
                                        detay)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Ürün inceleme/yorum alanı</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Google Analytics & Search Console
                                        entegrasyonu</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>SEO uyumlu site haritası ve meta etiket
                                        yönetimi</li>
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

                <!-- Profesyonel Paket -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item">
                        <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-3.jpg') }}"
                            style="background-image: url('assets/img/price/price-bg-3.jpg');">
                            <h5 style="font-size: 30px">Profesyonel Paket</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>10000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>10+ sayfa özel tasarım (kategori, alt
                                        ürün grupları, kampanya sayfaları)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Dinamik modüller (kampanya banner’ları,
                                        yeni ürün alanları)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>E-ticaret ön hazırlık (sepete ekleme
                                        simülasyonu, CTA optimizasyonu)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Çoklu dil desteği (TR + EN)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Özel sunucu optimizasyonu & CDN
                                        entegrasyonu</li>
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
