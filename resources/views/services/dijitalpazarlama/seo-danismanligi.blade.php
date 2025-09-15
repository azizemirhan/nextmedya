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
                            SEO Danışmanlığı
                        </span>
                        <h4 class="sv-hero-title tp-char-animation">
                            Web Sitenizi Google'da Üst Sıralara Taşıyoruz
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                SEO, dijital pazarlama stratejisinin temel unsurlarından biridir ve işletmenizin çevrimiçi
                                görünürlüğünü artırmak için kritik bir rol oynar. Next Medya olarak sunduğumuz SEO
                                danışmanlık hizmeti, arama motorlarında organik sıralamanızı yükseltmeye ve web sitenizin
                                hedef kitlenizle daha fazla etkileşimde bulunmasına yardımcı olur. SEO stratejilerimiz,
                                sadece sıralama değil, aynı zamanda kullanıcı deneyimini de optimize eder.
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
                                SEO danışmanlık hizmetimiz, web sitenizin teknik altyapısının, içerik yapısının ve kullanıcı
                                deneyiminin arama motorları tarafından daha kolay taranabilir hale gelmesini sağlar. Anahtar
                                kelime analizi, rakip analizi, on-page SEO optimizasyonu ve link inşası gibi kritik SEO
                                stratejileri ile dijital başarınızı artırıyoruz.
                                Ayrıca, SEO performansınızı düzenli olarak izler ve geliştirme alanlarını raporluyoruz.
                            </p>
                            <p>SEO Danışmanlığı ile;</p>
                        </div>

                        <div class="service-details__fea-list">
                            <ul>
                                <li>Web sitenizin teknik SEO analizini yapar, arama motorlarının sitenizi daha hızlı ve
                                    verimli taramasını sağlarız.</li>
                                <li>SEO uyumlu içerik stratejileri geliştirir, anahtar kelime araştırması yaparak hedef
                                    kitlenize en uygun içerikleri oluştururuz.</li>
                                <li>Mobil uyumluluk ve hız optimizasyonu ile kullanıcı deneyimini iyileştiririz.</li>
                                <li>Güçlü backlink stratejileri ile sitenizin otoritesini artırırız.</li>
                                <li>SEO raporları ile sitenizin performansını düzenli olarak ölçer ve geliştirme alanlarını
                                    belirleriz.</li>
                            </ul>
                        </div>

                        <div class="service-details__left-text">
                            <p>
                                Next Medya olarak, SEO danışmanlık hizmetimiz ile web sitenizin tüm SEO ihtiyaçlarını
                                karşılıyoruz. Her sektör için özelleştirilmiş SEO stratejileri sunarak, web sitenizin hem
                                arama motorlarında üst sıralara çıkmasını hem de kullanıcılarınız için değerli bir kaynak
                                olmasını sağlıyoruz.
                            </p>

                            <p>
                                Dijital dünyada rekabetçi kalmak ve görünürlüğünüzü artırmak için SEO, uzun vadeli başarı
                                için kritik bir yatırımdır. Size özel oluşturduğumuz SEO stratejileri ile arama motorlarında
                                daha fazla organik trafik elde edebilir ve online varlığınızı güçlendirebilirsiniz.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-5">
                    <div class="service-details__right-wrap fix p-relative">
                        <div class="service-details__right-text-box" style="margin-bottom: 40px">
                            <h4>Başka Neler <br> Sunuyoruz?</h4>
                        </div>

                        <div class="service-details__right-category">
                            <a href="{{ route('kurumsalwebtasarim') }}">Kurumsal Web Tasarım</a>
                            <a href="{{ route('ampwebtasarim') }}">AMP Web Tasarım</a>
                            <a href="{{ route('kisiselwebsitesitasarimi') }}">Kişisel Web Tasarım</a>
                            <a href="{{ route('uruntanitimsitesi') }}">Ürün Tanıtım Sitesi</a>
                            <a href="{{ route('onepagewebtasarim') }}">One Page Web Tasarım</a>
                            <a href="{{ route('seodanismanligi') }}" class="active">Seo Danışmanlığı</a>
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
                <h1>SEO Danışmanlığı Süreci Nasıl İşler?</h1>
                <ul class="timeline-ul" style="margin-top: 70px; margin-bottom: 70px">
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">İhtiyaç Analizi & Hedef Belirleme</div>
                        <div class="descr">
                            SEO danışmanlık süreci, işletmenizin çevrimiçi görünürlüğü ve organik trafik hedeflerine ulaşmak
                            için başlangıç noktasını oluşturur. İhtiyaçlarınız doğrultusunda, SEO hedefleriniz (örneğin,
                            anahtar kelime sıralamaları, hedeflenen trafik hacmi) belirlenir. Ayrıca, web sitenizin SEO için
                            güçlü ve zayıf yönleri analiz edilerek, SEO stratejileri oluşturulur.
                            Bu aşamada, içerik stratejisi, teknik SEO gereksinimleri, mobil uyumluluk ve veri güvenliği gibi
                            unsurlar ön plana çıkar.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">SEO Analizi & Teklif Süreci</div>
                        <div class="descr">
                            İhtiyaç analizi sonrası, web sitenizin SEO gereksinimlerini karşılayacak özgün çözümler
                            geliştirilir. Teklif sürecinde, anahtar kelime araştırması, rakip analizi, on-page SEO, backlink
                            stratejileri ve içerik önerileri sunulur. Ayrıca, SEO sürecinin detayları, zaman çizelgesi,
                            teslimat tarihleri ve bakım planları hakkında açıklamalar yapılır.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">İçerik Stratejisi & SEO Planı Tasarımı</div>
                        <div class="descr">
                            SEO stratejisinin temel yapı taşları, içerik oluşturma ve optimize etme sürecidir. Anahtar
                            kelime odaklı içerik üretimi, blog yazıları, açıklamalar, meta etiketleri ve başlık etiketleri
                            gibi unsurlar planlanır. Ayrıca, mevcut içeriklerin SEO uyumlu hale getirilmesi ve yeni içerik
                            akışlarının oluşturulması sağlanır. SEO dostu içerik yapıları ve görseller ile kullanıcı
                            deneyimini iyileştiririz.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Web Tasarımı & Teknik SEO İyileştirmeleri</div>
                        <div class="descr">
                            Web sitenizin arayüz tasarımı SEO kriterlerine uygun şekilde geliştirilir. Mobil uyumlu, hızlı
                            yükleme süreleri, SEO dostu URL yapıları ve site haritalarının düzenlenmesi gibi teknik SEO
                            adımları yapılır. Ayrıca, iç ve dış bağlantı yapıları güçlendirilir, görsel optimizasyonları
                            gerçekleştirilir. Bu süreç, arama motorları için sitenizin erişilebilirliğini artırır.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">Kodlama & Sistem Entegrasyonu</div>
                        <div class="descr">
                            Onaylanan SEO stratejileri, performans odaklı bir altyapıya entegre edilir. Teknik SEO
                            iyileştirmeleri, doğru başlık etiketleri, meta açıklamalar, schema markup ve H1-H6 etiketlerinin
                            optimizasyonu gibi unsurlar kodlanır. Ayrıca, SEO için kritik olan hız optimizasyonları, güvenli
                            bağlantılar (SSL) ve mobil uyumluluk sağlanır.
                            Web sitenizin SEO performansını iyileştirmek için gerekli tüm teknik düzenlemeler yapılır.
                        </div>
                    </li>
                    <li style="--accent-color:#000" class="timeline-li">
                        <div class="date">SEO Testi & İzleme Süreci</div>
                        <div class="descr">
                            SEO iyileştirmelerinin ardından, sitenizin SEO performansı test edilir. Teknik SEO testleri,
                            sayfa hızı analizi, anahtar kelime sıralamaları ve mobil uyumluluk gibi faktörler detaylı
                            şekilde kontrol edilir. Sonrasında, SEO metriklerini izlemek için Google Analytics, Search
                            Console gibi araçlar ile düzenli raporlar sunarız. SEO performansınız sürekli izlenir ve gelişen
                            ihtiyaçlara göre stratejiler güncellenir.
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="tp-price-area">
        <div class="container">
            <div class="row">

                <!-- SEO Giriş -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item">
                        <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-1.jpg') }}"
                            style="background-image: url('assets/img/price/price-bg-1.jpg');">
                            <h5 style="font-size: 30px">SEO Danışmanlığı — Giriş</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>10000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Teknik + On-Page başlangıç denetimi
                                        (hatalar, önceliklendirme)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Temel anahtar kelime araştırması (çekirdek
                                        kümeler, niyet eşlemesi)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Başlık, meta açıklama ve H1–H3
                                        optimizasyon rehberi</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Site haritası & robots.txt düzeni, Search
                                        Console kurulumu</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Core Web Vitals hızlı kazanımlar listesi
                                    </li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Aylık özet rapor (trafik, görünürlük,
                                        öneri listesi)</li>
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

                <!-- SEO Standart -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item active"
                        data-background="{{ asset('site/assets/img/price/price-bg-2.jpg') }}"
                        style="background-image: url('assets/img/price/price-bg-2.jpg');">
                        <div class="tp-price-head">
                            <h5 style="font-size: 30px">SEO Danışmanlığı — Standart</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>15000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Kapsamlı anahtar kelime haritası
                                        (kategori/etiket, URL eşlemesi)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>İç linkleme mimarisi + içerik kümesi
                                        (topic cluster) planı</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Şema işaretlemeleri (Organization,
                                        LocalBusiness, Article, FAQ)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Backlink stratejisi & düşük kaliteli
                                        bağlantı taraması</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>GA4 panosu + GSC sorgu/pozisyon analizi
                                        (kanibalizasyon tespiti)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>İki haftada bir ilerleme raporu ve görev
                                        takibi</li>
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

                <!-- SEO Profesyonel -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="tp-price-item">
                        <div class="tp-price-head" data-background="{{ asset('site/assets/img/price/price-bg-3.jpg') }}"
                            style="background-image: url('assets/img/price/price-bg-3.jpg');">
                            <h5 style="font-size: 30px">SEO Danışmanlığı — Profesyonel</h5>
                        </div>
                        <div class="tp-price-body">
                            <span class="tp-price-monthly"><i>22000 ₺</i> / Kdv Dahil</span>
                            <div class="tp-price-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Sunucu log analizi & tarama bütçesi
                                        optimizasyonu</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Uluslararası SEO (hreflang stratejisi) /
                                        Çok dilli yapı danışmanlığı</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Site taşıma / yeniden platforma geçiş
                                        (risk planı + URL eşleme)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>EEAT güçlendirme (otorite sinyalleri,
                                        yazar profili, referanslandırma)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Dijital PR kampanya planı (haber/niş
                                        yayınlara sunum)</li>
                                    <li><i class="fa-sharp fa-light fa-check"></i>Haftalık yönetim özeti + aksiyon/OKR
                                        takibi</li>
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
