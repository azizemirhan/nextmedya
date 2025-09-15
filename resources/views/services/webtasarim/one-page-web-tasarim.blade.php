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
                            One Page Web Tasarım</span>
                        <h4 class="sv-hero-title tp-char-animation">Tek Sayfa Web Tasarımı</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                One page web tasarım hizmetimiz, basit, etkili ve görsel olarak çekici web
                                siteleri
                                oluşturmanızı sağlar. Sadece tek bir sayfa üzerinden markanızı tanıtabilir,
                                ürün veya hizmetlerinizi
                                etkili bir şekilde sergileyebilirsiniz. Next Medya olarak, minimalizmi
                                estetikle birleştiriyor ve kullanıcı
                                dostu tasarımlar sunuyoruz.
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
                            <p class="text-1 tp_title_anim">One Page Web Tasarımı, kısa ve öz bir web
                                sitesi oluşturmanın ideal
                                yoludur. Bu tür siteler, markanızı tanıtmak, etkin bir şekilde iletişim
                                kurmak ve dönüşüm sağlamak
                                için mükemmel bir platform sunar. SEO uyumlu tasarım anlayışımızla, web
                                sitenizin arama motorlarında
                                üst sıralarda yer almasını sağlarız. Ayrıca, hız optimizasyonu, mobil
                                uyumluluk ve kullanıcı deneyimini
                                ön planda tutarak performanslı ve güvenli bir site sunarız.</p>
                            <p>One Page Web Tasarımı ile;</p>
                        </div>
                        <div class="service-details__fea-list">
                            <ul>
                                <li>Minimalist ve kullanıcı dostu tasarımlar ile web sitenizin etkileyici
                                    bir görünüme kavuşmasını sağlarız.</li>
                                <li>SEO uyumlu yapılar geliştirerek, sitenizin arama motorlarında daha
                                    görünür olmasını sağlarız.</li>
                                <li>Hızlı yükleme süreleri, mobil uyumluluk ve etkili navigasyon gibi temel
                                    özelliklere odaklanırız.</li>
                                <li>Tek sayfa üzerinden tüm hizmetlerinizi, avantajlarınızı ve
                                    tekliflerinizi net bir şekilde sergileriz.</li>
                                <li>Tek sayfa tasarımının avantajlarından yararlanarak, kullanıcıyı yalnızca
                                    bir sayfada tutarak dönüşüm oranlarını artırırız.</li>
                            </ul>
                        </div>
                        <div class="service-details__left-text">
                            <p>One Page web siteleri, özellikle girişimciler, tanıtım amaçlı siteler veya
                                etkinlik sayfaları için mükemmel bir tercihtir.
                                Kolayca gezilebilen bir site yapısı ile kullanıcıların dikkatini çekmek ve
                                hızlıca dönüşüm sağlamak mümkündür. Ayrıca,
                                SEO uyumlu yapımızla, sitenizin Google gibi arama motorlarında yüksek
                                sıralarda yer almasını sağlayarak,
                                daha fazla organik trafik elde etmenizi garanti ederiz.</p>
                            <p>Tek sayfa tasarımını sadece estetik açıdan değil, işlevsellik ve SEO
                                açısından da en verimli şekilde
                                tasarlıyoruz. Müşterilerimize, dijital dünyada daha güçlü bir varlık
                                oluşturacak ve uzun vadeli başarıyı
                                garantileyecek çözümler sunuyoruz.</p>
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
                            <a href="{{ route('onepagewebtasarim') }}" class="active">One Page Web Tasarım</a>
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
                <h1>One Page Web Tasarım Süreci Nasıl İşler?</h1>
                <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Analiz & Hedef Belirleme</div>
                        <div class="descr">One Page Web Tasarımı sürecimiz, hedef kitlenizin dijital
                            davranışlarını analiz etmekle başlar.
                            Ürününüz veya hizmetiniz için etkili bir tanıtım stratejisi oluşturabilmek
                            amacıyla, pazar analizi yaparak
                            hedeflerinize uygun özel bir yol haritası belirleriz. Bu süreç, SEO dostu bir
                            yapı kurmak için temel oluşturur.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Bilgilendirme & Teklif Süreci</div>
                        <div class="descr">Proje analizini yaptıktan sonra, size özel bir teklif
                            hazırlıyoruz. Teklifte, One Page web tasarımının
                            kapsamı, SEO uyumlu özellikleri, mobil uyumluluk ve hızlı yükleme gibi detaylar
                            yer alır. Tasarım süreci için
                            zaman planı ve şeffaf bilgi sağlarız.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">İçerik Yapısı & Mockup Tasarımı</div>
                        <div class="descr">One Page Web Tasarımınız için içerik yapısını oluşturuyoruz.
                            Sayfa tasarımlarını ve kullanıcı
                            akışlarını planlayarak, görsel ve yazılı içerikleri SEO dostu şekilde
                            yerleştiriyoruz. İyi yapılandırılmış
                            mockup tasarımlarıyla, ürün veya hizmetinizi en etkili şekilde sunmaya yönelik
                            taslaklar hazırlıyoruz.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Arayüz Tasarımı ve Onay Süreci</div>
                        <div class="descr">Mockup tasarımlarının onayından sonra, tek sayfa web
                            tasarımınız için şık ve kullanıcı dostu
                            arayüz (UI) tasarımlarını hazırlıyoruz. SEO dostu renk paleti, tipografi ve
                            görseller kullanarak, markanızı
                            dijital ortamda doğru şekilde temsil ediyoruz. Tasarımlarınızın her detayı,
                            kullanıcı deneyimi (UX) ve
                            dönüşüm odaklı düşünülür.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Kodlama & Sistem Entegrasyonu</div>
                        <div class="descr">Onaylanan tasarımlar, mobil uyumluluk ve SEO gereksinimlerini
                            karşılayacak şekilde kodlanır.
                            Web sitenizin hızlı yüklenmesi için optimizasyon yapılır. Frontend geliştirme,
                            CMS entegrasyonları ve
                            gerekli modüller entegre edildikten sonra testler yapılır. Bu aşama, hem SEO hem
                            de kullanıcı deneyimi için
                            önemli bir adımdır.</div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Yayına Alma & Eğitim Süreci</div>
                        <div class="descr">Tüm testler başarıyla tamamlandığında, One Page web siteniz
                            demo ortamında ön izlemeye sunulur.
                            Son onayınız sonrası siteyi canlıya alıyoruz. Ayrıca, içeriğinizi kolayca
                            güncelleyebilmeniz için CMS
                            paneli eğitimi veriyoruz. SEO yönetimi, içerik güncellemeleri ve site analizleri
                            konusunda size rehberlik
                            ediyoruz.</div>
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
                            <h5 style="font-size: 30px">One Page — Giriş</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>4000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Tek sayfa kurumsal tanıtım tasarımı (Hero,
                                        Hakkımızda, Hizmetler, Galeri, İletişim)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Mobil uyum + temel hız optimizasyonu (Core
                                        Web Vitals odaklı)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Anchor menü (yumuşak kaydırma / smooth
                                        scroll)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>İletişim formu + Google Maps yerleşimi
                                    </li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Temel SEO ayarları (title, description,
                                        alt etiketleri)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Hızlı iletişim (WhatsApp & telefon
                                        kısayolu)</li>
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
                            <h5 style="font-size: 30px">One Page — Standart</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>6000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>8 bölüme kadar özel bölüm tasarımı
                                        (SSS/akordiyon, Referanslar, Süreç/Zaman Çizelgesi dahil)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Lightbox galeri + video gömme
                                        (YouTube/Vimeo)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Gelişmiş görsel sıkıştırma ve lazy-load
                                    </li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Google Analytics 4 + Search Console
                                        entegrasyonu</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Site haritası (XML) + Schema.org
                                        LocalBusiness/FAQ işaretlemeleri</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Form doğrulama + spam koruması (reCAPTCHA
                                        v3)</li>
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
                            <h5 style="font-size: 30px">One Page — Profesyonel</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>10000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>12+ bölüm ve mikro bileşenler (CTA
                                        varyasyonları, sayıya dayalı başarı göstergeleri, ekip kartları)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Lottie/ikon animasyonları + paralaks
                                        etkileşimleri</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Gelişmiş performans bütçesi (kritik CSS,
                                        preconnect/preload, CDN)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Olay/etkinlik takibi (GA4 event’leri,
                                        dönüşüm hedefleri)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>CRM/forma veri gönderimi entegrasyonu
                                        (ör. HubSpot/Zoho, webhook)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>PWA yerleşimi (ana ekrana ekle, offline
                                        temel kabuk)</li>
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
