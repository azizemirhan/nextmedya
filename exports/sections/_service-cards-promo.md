@php
    $services = $dynamicData ?? collect();
@endphp
@if($services->isNotEmpty())
    <section class="gap service-style-one">
        <div class="container">
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center" data-aos="flip-left"
                    data-aos-delay="{{ 50 * $loop->index }}">
                        <div class="service-data">
                            <div class="svg-icon d-flex-all">
                                {{-- BURADA DEĞİŞİKLİK YAPILDI --}}
                                <img src="{{ $service->cover_image }}" style="--delay: {{ $loop->index * 0.1 }}s;">
                            </div>
                            <h3><a href="#">{{ $service->getTranslation('title', app()->getLocale()) }}</a></h3>
                            <p>{{ $service->getTranslation('summary', app()->getLocale()) }}</p>
                            <a class="icon" href="#">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@push('styles')
    <style>
        /* Servis kutuları için genel düzenleme */
        .service-data {
            position: relative;
            padding: 30px;
            margin-bottom: 30px; /* Kutular arası boşluk */
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease-in-out; /* Kutunun kendi üzerine gelme animasyonu */
            overflow: hidden; /* Animasyonlar için */
        }

        .service-data:hover {
            transform: translateY(-10px); /* Üzerine gelince hafifçe yukarı kaydır */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        /* Resim taşıyıcı (SVG icon) */
        .svg-icon {
            position: relative; /* Animasyonlar için */
            margin-bottom: 25px;
            display: flex; /* İçindeki resmi ortalamak için */
            justify-content: center;
            align-items: center;
            /* Arka planındaki şekli göstermek için overflow: visible */
        }

        /* Dairesel Resimler - Daha Büyük Boyut ve Animasyonlar */
        .svg-icon img {
            width: 150px; /* Resmin genişliği - Önceki 120px'den daha büyük */
            height: 150px; /* Resmin yüksekliği - Genişlikle aynı */
            border-radius: 50%; /* Dairesel şekil */
            object-fit: cover; /* Resmi orantılı olarak doldurur */
            border: 5px solid #ffffff; /* Beyaz kalın bir kenarlık */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Daha belirgin bir gölge */
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Yumuşak geçiş animasyonu */
            opacity: 0; /* Başlangıçta gizli */
            transform: scale(0.8); /* Başlangıçta hafif küçük */
            animation: fadeInScale 1.2s ease-out forwards; /* Yüklenirken animasyon */
            animation-delay: var(--delay, 0s); /* Her resim için farklı gecikme */
        }

        /* Resim üzerine gelindiğinde büyüme ve gölge efekti */
        .service-data:hover .svg-icon img {
            transform: scale(1.1) rotate(5deg); /* Hafifçe büyüt ve döndür */
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25); /* Gölgeyi daha da belirginleştir */
        }

        /* Resimlerin altında bulunan icon (sağ ok) */
        .service-data .icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f0f0f0;
            color: #333;
            font-size: 18px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .service-data:hover .icon {
            background: #007bff; /* Hoverda arka plan rengini değiştir */
            color: #fff;
            transform: translateX(5px); /* Hafifçe sağa kaydır */
        }

        /* Yüklenirken resimlerin görünme animasyonu */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endpush
