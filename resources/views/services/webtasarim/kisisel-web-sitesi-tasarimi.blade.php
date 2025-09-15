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
                        <span class="service-details__subtitle tp-char-animation" style="font-size: 40px">Kişisel</span>
                        <h4 class="sv-hero-title tp-char-animation">Web Sitesi Tasarımı</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                Kişisel markanızı dijital dünyada güçlü bir şekilde konumlandırın.
                                Profesyonel ve özgün tasarımlarla hazırladığımız kişisel web siteleri
                                sayesinde dijital kimliğinizi en etkili şekilde yansıtın.
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
                                Kişisel web siteleri, bireysel yeteneklerinizi, geçmişinizi ve hedeflerinizi
                                profesyonel bir dijital platformda sunmanın en etkili yoludur.
                                İster bir freelancer, ister bir sanatçı, akademisyen ya da danışman olun;
                                dijital vitrininizin tasarımı, sizi doğru şekilde temsil etmelidir.
                            </p>
                            <p>Bu yaklaşımla;</p>
                        </div>
                        <div class="service-details__fea-list">
                            <ul>
                                <li>Kişiye özel, özgün arayüz tasarımı</li>
                                <li>Portfolyo, blog ve iletişim bölümleri</li>
                                <li>SEO uyumlu, mobil öncelikli altyapı</li>
                            </ul>
                        </div>
                        <div class="service-details__left-text">
                            <p>
                                Günümüzde ilk izlenim dijitalde başlıyor. Kişisel web siteniz; iş
                                başvurularında, iş birliklerinde ya da potansiyel müşterilerinizle ilk
                                temasta fark yaratmanızı sağlar.
                                Alanında uzman ekibimizle, sizi en doğru şekilde yansıtacak dijital
                                platformu birlikte tasarlıyoruz.
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
                            <a href="{{ route('ampwebtasarim') }}">AMP Web Tasarım</a>
                            <a href="{{ route('ampwebtasarim') }}" class="active">Kişisel Web Tasarım</a>
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
                                    style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    Next Medya</span>
                                <span class="text-space"></span>
                                Kişisel web siteniz, dijital dünyadaki en güçlü vitrinlerinizden biridir.
                                Size özel geliştirilen arayüzlerle, fark yaratan bir dijital kimlik inşa
                                edin.
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Kişisel Web Sitesi Ne İşe Yarar?</h1>
                <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Kişisel markanızı güçlendirir:</div>
                        <div class="descr">
                            Dijitalde kendinizi ifade etmenin en profesyonel yolu, sizi ve yaptıklarınızı
                            doğru şekilde anlatan özgün bir web sitesidir. Bu, dijital itibarınızı doğrudan
                            etkiler.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">İş birliklerine açık kapı bırakır:</div>
                        <div class="descr">
                            Portfolyonuzu, başarı hikayelerinizi ve uzmanlık alanlarınızı sergileyerek
                            freelance işler, iş başvuruları veya ortaklık teklifleri için hazır bir zemin
                            oluşturursunuz.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Aramalarda daha görünür olursunuz:</div>
                        <div class="descr">
                            SEO uyumlu yapı sayesinde, adınız veya uzmanlık alanlarınız arandığında arama
                            motorlarında üst sıralarda yer alabilirsiniz. Bu, size ulaşılabilirlik
                            kazandırır.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Güven ve profesyonellik hissi verir:
                        </div>
                        <div class="descr">
                            Kurumsal görünümlü kişisel bir site, sizi ziyaret eden kişilere güven verir.
                            Özgeçmiş PDF'si yerine, etkileşimli ve güncel bir platform sunarsınız.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">İçeriklerinizi özgürce sunarsınız:</div>
                        <div class="descr">
                            Blog yazıları, projeleriniz, videolarınız ya da çalışmalarınız için tamamen
                            kontrol sizde olur. Sosyal medya algoritmalarına bağlı kalmazsınız.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date" style="padding: 40px">Dijital dünyada fark edilirsiniz:</div>
                        <div class="descr">
                            Sıradan profillerin ötesinde, kendinize ait bir alan yaratarak öne çıkarsınız.
                            Bu da sizi hem profesyonel hem de özgün kılar.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tp-price-area">
            <div class="container">
                <div class="row">
                    <!-- Başlangıç Paketi -->
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-price-item">
                            <div class="tp-price-head"
                                style="background-image: url('{{ asset('site/assets/img/price/price-bg-1.jpg') }}');">
                                <h5 style="font-size: 30px">Temel Başlangıç</h5>
                            </div>
                            <div class="tp-price-body">
                                <span class="tp-price-monthly"><i>5000 ₺</i> / Kdv Dahil</span>
                                <div class="tp-price-list">
                                    <ul>
                                        <li><i class="fa-check"></i>Kişisel tanıtım sayfası (tek sayfa)
                                        </li>
                                        <li><i class="fa-check"></i>Mobil uyumlu responsive tasarım</li>
                                        <li><i class="fa-check"></i>İletişim formu ve sosyal medya
                                            bağlantıları</li>
                                        <li><i class="fa-check"></i>Temel SEO ayarları</li>
                                        <li><i class="fa-check"></i>Alan adı ve barındırma desteği</li>
                                    </ul>
                                </div>
                                <a class="tp-btn-black-md w-100 text-center" href="javascript:void(0);" onclick="openModal()">Detaylı
                                    Bilgi Al</a>
                            </div>
                        </div>
                    </div>
                    <!-- Orta Seviye -->
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-price-item active"
                            style="background-image: url('{{ asset('site/assets/img/price/price-bg-2.jpg') }}');">
                            <div class="tp-price-head">
                                <h5 style="font-size: 30px">Portföy & Blog Odaklı</h5>
                            </div>
                            <div class="tp-price-body">
                                <span class="tp-price-monthly"><i>8000 ₺</i> / Kdv Dahil</span>
                                <div class="tp-price-list">
                                    <ul>
                                        <li><i class="fa-check"></i>5 sayfalık özel web sitesi</li>
                                        <li><i class="fa-check"></i>Blog ve portföy entegrasyonu</li>
                                        <li><i class="fa-check"></i>Google Analytics kurulumu</li>
                                        <li><i class="fa-check"></i>Yüksek performans optimizasyonu</li>
                                        <li><i class="fa-check"></i>Profesyonel e-posta adresi</li>
                                    </ul>
                                </div>
                                <a class="tp-btn-black-md white-bg w-100 text-center" href="javascript:void(0);" onclick="openModal()">Detaylı Bilgi
                                    Al</a>
                            </div>
                        </div>
                    </div>
                    <!-- Gelişmiş Seviye -->
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-price-item"
                            style="background-image: url('{{ asset('site/assets/img/price/price-bg-3.jpg') }}');">
                            <div class="tp-price-head">
                                <h5 style="font-size: 30px">Kişisel Marka Web Sitesi</h5>
                            </div>
                            <div class="tp-price-body">
                                <span class="tp-price-monthly"><i>11000 ₺</i> / Kdv Dahil</span>
                                <div class="tp-price-list">
                                    <ul>
                                        <li><i class="fa-check"></i>10+ sayfa özel web tasarımı</li>
                                        <li><i class="fa-check"></i>Video sunum alanları, medya galerileri
                                        </li>
                                        <li><i class="fa-check"></i>Yazılım tabanlı blog sistemi</li>
                                        <li><i class="fa-check"></i>SEO danışmanlığı ve içerik rehberi</li>
                                        <li><i class="fa-check"></i>Gelişmiş güvenlik & hız altyapısı</li>
                                    </ul>
                                </div>
                                <a class="tp-btn-black-md w-100 text-center" href="javascript:void(0);" onclick="openModal()">Detaylı
                                    Bilgi Al</a>
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
                                <h4 class="tp-service-2-title mb-20 tp_title_anim">
                                    <div style="text-align: start;">Sıkça</div>
                                    <div style="text-align: start;">Sorulan Sorular</div>
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
                                        <!-- Soru 1 -->
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne">
                                                    Kişisel web sitesi herkese uygun mu?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>Serbest çalışanlar, danışmanlar, sanatçılar ve
                                                        akademisyenler başta olmak üzere herkes için
                                                        uygundur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Soru 2 -->
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo">
                                                    Sitenin içeriğini kendim güncelleyebilir miyim?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>Evet. Yönetim paneli opsiyonu ile içerikleri kolayca
                                                        düzenleyebilirsiniz.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Soru 3 -->
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseThree">
                                                    SEO hizmeti pakete dahil mi?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>Evet. Tüm paketlerde temel SEO ayarları
                                                        yapılmaktadır. Gelişmiş SEO için danışmanlık da
                                                        sunulmaktadır.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Soru 4 -->
                                        <div class="accordion-items">
                                            <h2 class="accordion-header">
                                                <button class="accordion-buttons collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFour">
                                                    Ne kadar sürede teslim ediliyor?
                                                    <span class="accordion-icon"></span>
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>Seçilen pakete göre 5 ila 15 iş günü arasında teslim
                                                        edilmektedir.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- .accordion end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
