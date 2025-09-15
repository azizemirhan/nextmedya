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
                        <span class="service-details__subtitle tp-char-animation" style="font-size: 40px">AMP</span>
                        <h4 class="sv-hero-title tp-char-animation">Web Tasarım</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                Google’ın desteklediği AMP teknolojisiyle, mobil cihazlarda ışık hızında
                                yüklenen web siteleri tasarlıyoruz. Dönüşüm oranlarınızı artırın, SEO’da öne
                                çıkın.
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
                                AMP (Accelerated Mobile Pages), Google tarafından geliştirilen açık kaynaklı
                                bir HTML framework’üdür. Mobil cihazlarda içeriklerin çok daha hızlı
                                yüklenmesini sağlar. Bunu yaparken gereksiz kaynakları eleyip
                                sadeleştirilmiş bir kod yapısıyla çalışır.
                            </p>
                            <p>Her sektörün dinamiği farklıdır. Bu farkı anlayarak;</p>
                        </div>
                        <div class="service-details__fea-list">
                            <ul>
                                <li>Hafifletilmiş HTML ve CSS kullanımı</li>
                                <li>JavaScript kısıtlamaları</li>
                                <li>Google AMP Cache üzerinden servis edilme</li>
                            </ul>
                        </div>
                        <div class="service-details__left-text">
                            <p>
                                Günümüzde internet trafiğinin %70’inden fazlası mobil cihazlar üzerinden
                                gerçekleşiyor. Bu değişim, dijital varlıkların mobil öncelikli bir
                                yaklaşımla yeniden tasarlanmasını zorunlu kılıyor.
                                AMP Web Tasarım hizmetimiz, tam da bu noktada devreye girerek, mobil
                                kullanıcılar için ultra hızlı, optimize edilmiş web deneyimleri sunmanıza
                                olanak tanıyor.
                            </p>
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
                            <a href="{{ route('ampwebtasarim') }}" class="active">AMP Web Tasarım</a>
                            <a href="{{ route('kisiselwebsitesitasarimi') }}">Kişisel Web Tasarım</a>
                            <a href="{{ route('uruntanitimsitesi') }}">Ürün Tanıtım Sitesi</a>
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
        <div class="tp-service-5-area">
            <div class="container container-1775">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-service-5-title-box mb-90">
                            <h4 class="tp-service-5-title p-relative tp_fade_right"
                                style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                <span class="tp-service-5-subtitle tp_fade_left"
                                    style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">Next
                                    Medya</span>
                                <span class="text-space"></span>
                                AMP, mobil öncelikli indeksleme yaklaşımıyla çalışan arama motorlarında
                                ciddi
                                avantajlar sağlar.
                                SEO açısından avantajları:
                            </h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>AMP Sayfalar Ne İşe Yarar?</h1>
                <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Mobil sayfa yükleme hızında dramatik
                            artış:
                        </div>
                        <div class="descr" style="">AMP ile optimize edilen sayfalar, mobil
                            cihazlarda ışık hızında açılır. Bu da ziyaretçi memnuniyetini artırır ve sayfa
                            terk oranını düşürür.

                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Bounce rate (hemen çıkma oranı) düşüşü:
                        </div>
                        <div class="descr">Hızlı yüklenen sayfalar, ziyaretçilerin sitede daha uzun süre
                            kalmasını sağlar. Bu sayede hemen çıkma oranlarında gözle görülür bir azalma
                            yaşanır.

                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Organik trafiğin artışı:
                        </div>
                        <div class="descr">AMP teknolojisi, mobil arama sonuçlarında üst sıralarda yer
                            almanıza katkı sağlar. Bu da doğal olarak daha fazla kullanıcıya ulaşmanızı
                            mümkün kılar.

                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Daha iyi kullanıcı deneyimi:
                        </div>
                        <div class="descr">Mobil uyumlu, hızlı ve sade tasarlanmış AMP sayfaları,
                            ziyaretçilere beklentilerinin ötesinde akıcı ve sorunsuz bir kullanıcı deneyimi
                            sunar.

                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Reklam gelirlerinde artış (özellikle
                            içerik siteleri için):
                        </div>
                        <div class="descr">Sayfa hızı ve kullanıcı deneyimi arttıkça gösterim süresi uzar,
                            tıklama oranları yükselir ve reklam gelirlerinde doğrudan artış gözlemlenir.

                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Arama motorlarında öncelikli indeksleme
                            avantajı:
                        </div>
                        <div class="descr">AMP yapılı sayfalar, Google gibi arama motorlarında daha hızlı
                            taranır ve öncelikli indekslenir. Bu durum görünürlüğü artırır, rekabette
                            avantaj sağlar.

                        </div>
                    </li>
                </ul>

            </div>
        </div>
        <div class="tp-price-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-price-item">
                            <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-1.jpg') }}"
                                style="background-image: url(&quot;assets/img/price/price-bg-1.jpg&quot;);">
                                <h5 style="font-size: 30px">Mobil Performans Girişi</h5>
                            </div>
                            <div class="tp-price-body">
                                <span class="tp-price-monthly"><i>7000 ₺</i> / Kdv Dahil</span>
                                <div class="tp-price-list">
                                    <ul>
                                        <li><i class="fa-sharp fa-light fa-check"></i>AMP uyumlu tek sayfa (Landing Page)
                                            tasarımı</li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>Mobil hız optimizasyonu</li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>Google AMP validasyon testi</li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>AMP CDN entegrasyonu

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>Temel SEO yapılandırması (başlık,
                                            açıklama, görsel alt etiketleri)

                                        </li>
                                    </ul>
                                </div>
                                <a class="tp-btn-black-md w-100 text-center" href="javascript:void(0);" onclick="openModal()">
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
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-price-item active"
                            data-background="{{ asset('site/assets/img/price/price-bg-2.jpg') }}"
                            style="background-image: url(&quot;assets/img/price/price-bg-2.jpg&quot;);">
                            <div class="tp-price-head">
                                <h5 style="font-size: 30px">İçerik & Performans Dengesi</h5>
                            </div>
                            <div class="tp-price-body">
                                <span class="tp-price-monthly"><i>10000 ₺</i> / Kdv Dahil</span>
                                <div class="tp-price-list">
                                    <ul>
                                        <li><i class="fa-sharp fa-light fa-check"></i>5 sayfaya kadar özel AMP tasarım

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>Çoklu içerik şablonları (blog,
                                            hizmet, iletişim)


                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>AMP için yapılandırılmış veri
                                            (Schema.org) entegrasyonu

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>Google Analytics (AMP versiyon)
                                            entegrasyonu

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>SEO uyumlu AMP sitemap kurulumu

                                        </li>
                                    </ul>
                                </div>
                                <a class="tp-btn-black-md white-bg w-100 text-center" href="javascript:void(0);" onclick="openModal()">
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
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-price-item">
                            <div class="tp-price-head"
                                data-background="{{ asset('site/assets/img/price/price-bg-3.jpg') }}"
                                style="background-image: url(&quot;assets/img/price/price-bg-3.jpg&quot;);">
                                <h5 style="font-size: 30px"> Ölçeklenebilir & Entegre Çözümler
                                </h5>
                            </div>
                            <div class="tp-price-body">
                                <span class="tp-price-monthly"><i>13000 ₺</i> / Kdv Dahil</span>
                                <div class="tp-price-list">
                                    <ul>
                                        <li><i class="fa-sharp fa-light fa-check"></i>10+ sayfa özel AMP arayüz tasarımı

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>AMP ile çalışan dinamik içerik
                                            modülleri (haber akışı, ürün detayları vs.)


                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>AMP reklam entegrasyonu (AdSense,
                                            programatik)

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>AMP e-ticaret modülü (ürün kartı,
                                            sepet ön izleme, CTA optimizasyonu)

                                        </li>
                                        <li><i class="fa-sharp fa-light fa-check"></i>Özel AMP sunucu yapılandırması ve
                                            önbellekleme optimizasyonu

                                        </li>
                                    </ul>
                                </div>
                                <a class="tp-btn-black-md w-100 text-center" href="javascript:void(0);" onclick="openModal()">
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
        <div class="tp-service-2-area tp-service-2-pt pb-150">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-xl-4 col-lg-5">
                        <div class="tp-price-inner-faq">
                            <div class="tp-service-2-title-box pt-25 pb-120">
                                <h4 class="tp-service-2-title mb-20 tp_title_anim" style="perspective: 400px;">
                                    <div
                                        style="display: block; text-align: start; position: relative; translate: none; rotate: none; scale: none; transform-origin: 188px 25px; transform: translate3d(0px, 0px, 0px); opacity: 1;">
                                        Sıkça </div>
                                    <div
                                        style="display: block; text-align: start; position: relative; translate: none; rotate: none; scale: none; transform-origin: 188px 25px; transform: translate3d(0px, 0px, 0px); opacity: 1;">
                                        Sorulan Sorular</div>
                                </h4>
                            </div>
                            <div class="tp-service-2-shape-img text-center text-lg-start">
                                <img src="{{ asset('site/assets/img/home-02/service/sv-shape-1.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="tp-price-inner-faq-wrap">
                            <div class="fq-faq-wrapper">
                                <div class="tp-service-2-accordion-box">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    AMP her site için gerekli mi?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Hayır, ancak içerik odaklı, mobil trafiği yoğun olan siteler için
                                                        ciddi avantaj sağlar.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Google AMP’yi zorunlu kılıyor mu?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Hayır, ancak mobil sayfa hızı sıralama faktörü olduğundan AMP tercih
                                                        edilebilir.

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    AMP tasarımı klasik web tasarımlarından farklı mı?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Kodlama yapısı sadeleştirilmiş olsa da kullanıcıya sunulan arayüz
                                                        kurumsal estetikten ödün vermez.


                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
                                                    E-ticaret sitelerinde AMP kullanılabilir mi?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Evet. AMP e-ticaret modülleriyle ürün sayfaları AMP uyumlu hale
                                                        getirilebilir.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
