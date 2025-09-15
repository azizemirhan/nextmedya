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
                        <h4 class="sv-hero-title tp-char-animation">Bizimle iletişime geçin</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                Next Medya olarak, ihtiyaçlarınıza en uygun dijital çözümleri sunmak için buradayız. Web
                                tasarım, yazılım geliştirme, SEO, grafik ve kreatif tasarım hizmetlerimiz hakkında detaylı
                                bilgi almak ya da projeleriniz için bize ulaşmak çok
                                kolay.

                                Formu doldurarak veya doğrudan iletişim bilgilerimiz üzerinden bize ulaşabilirsiniz. Uzman
                                ekibimiz, ilettiğiniz talepleri en kısa sürede inceleyerek size geri dönüş sağlayacaktır.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="service-details__left-wrap">
                        <div class="service-details__left-text pb-20">
                            <p>İletişim Kanallarımız:</p>
                        </div>
                        <div class="service-details__fea-list">
                            <ul>
                                <li>E-posta: info@nextmedya.com</li>
                                <li>Telefon: +90 532 643 75 44</li>
                                <li>Şehit Kubilay Mah. Estergon Cad. 25/8 Keçiören / Ankara</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="map-wrap">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d48910.39607572062!2d32.76958309864366!3d39.98834550681223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x14d34d29a10830e1%3A0x4ee5eb3d8a1bf509!2sNext%20Medya%20Web%20Tasar%C4%B1m%20Ajans%C4%B1%2C%20%C5%9Eehit%20Kubilay%2C%20Estergon%20Caddesi%2C%20Ke%C3%A7i%C3%B6ren%2FAnkara!3m2!1d39.9883528!2d32.8107824!4m5!1s0x14d34d29a10830e1%3A0x4ee5eb3d8a1bf509!2s%C5%9Eehit%20Kubilay%2C%20Estergon%20Cd.%20No%3A25%2C%2006220%20Ke%C3%A7i%C3%B6ren%2FAnkara!3m2!1d39.9883528!2d32.8107824!5e0!3m2!1str!2str!4v1755068616572!5m2!1str!2str"
                                    allowfullscreen loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
