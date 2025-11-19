@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Hizmetlerimiz');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Profesyonel İzolasyon Çözümleri');
    $bgColor = data_get($content, 'background_color', 'light');
    
    $serviceCategories = data_get($content, 'service_categories', []);
    if (is_string($serviceCategories)) {
        $serviceCategories = json_decode($serviceCategories, true) ?? [];
    }

    // Varsayılan kategoriler
    if (empty($serviceCategories)) {
        $serviceCategories = [
            [
                'category_icon' => 'fas fa-layer-group',
                'category_color' => '#2563eb',
                'category_title' => ['tr' => 'İZOLASYON', 'en' => 'INSULATION'],
                'category_description' => ['tr' => 'Enerji verimliliği sağlayan özel izolasyon çözümleri', 'en' => 'Special insulation solutions providing energy efficiency'],
                'services' => [
                    [
                        'service_title' => ['tr' => 'Boru İzolasyonu', 'en' => 'Pipe Insulation'],
                        'service_description' => ['tr' => 'Isı ve ses yalıtımı için profesyonel boru izolasyonu', 'en' => 'Professional pipe insulation for heat and sound insulation'],
                        'service_icon' => 'fas fa-pipe',
                        'service_link' => '#',
                    ],
                    [
                        'service_title' => ['tr' => 'Kazan İzolasyonu', 'en' => 'Boiler Insulation'],
                        'service_description' => ['tr' => 'Enerji tasarrufu sağlayan kazan izolasyonu', 'en' => 'Boiler insulation providing energy savings'],
                        'service_icon' => 'fas fa-fire',
                        'service_link' => '#',
                    ],
                    [
                        'service_title' => ['tr' => 'Tank İzolasyonu', 'en' => 'Tank Insulation'],
                        'service_description' => ['tr' => 'Endüstriyel tank izolasyon sistemleri', 'en' => 'Industrial tank insulation systems'],
                        'service_icon' => 'fas fa-drum',
                        'service_link' => '#',
                    ],
                ]
            ],
            [
                'category_icon' => 'fas fa-hard-hat',
                'category_color' => '#dc2626',
                'category_title' => ['tr' => 'VANA CEKETİ', 'en' => 'VALVE JACKET'],
                'category_description' => ['tr' => 'Özel tasarım vana yalıtım ceketleri', 'en' => 'Custom designed valve insulation jackets'],
                'services' => [
                    [
                        'service_title' => ['tr' => 'Buhar Vana Yalıtım Ceketi', 'en' => 'Steam Valve Insulation Jacket'],
                        'service_description' => ['tr' => 'Yüksek sıcaklığa dayanıklı vana ceketleri', 'en' => 'High temperature resistant valve jackets'],
                        'service_icon' => 'fas fa-temperature-high',
                        'service_link' => '#',
                    ],
                    [
                        'service_title' => ['tr' => 'Soğutma Vana Yalıtım Ceketi', 'en' => 'Cooling Valve Insulation Jacket'],
                        'service_description' => ['tr' => 'Yoğuşma önleyici özel ceketler', 'en' => 'Special anti-condensation jackets'],
                        'service_icon' => 'fas fa-snowflake',
                        'service_link' => '#',
                    ],
                ]
            ],
        ];
    }

    $uniqueId = 'ikzserlist-' . uniqid();
@endphp

<section class="ikzserlist-section ikzserlist-bg-{{ $bgColor }}" id="{{ $uniqueId }}">
    <div class="container">
        {{-- Service Categories --}}
        <div class="ikzserlist-categories">
            @foreach($serviceCategories as $categoryIndex => $category)
                @php
                    $categoryTitle = data_get($category, 'category_title.' . app()->getLocale(), 'Kategori');
                    $categoryDesc = data_get($category, 'category_description.' . app()->getLocale(), '');
                    $categoryIcon = data_get($category, 'category_icon', 'fas fa-layer-group');
                    $categoryColor = data_get($category, 'category_color', '#2563eb');
                    
                    $services = data_get($category, 'services', []);
                    if (is_string($services)) {
                        $services = json_decode($services, true) ?? [];
                    }
                @endphp

                <div class="ikzserlist-category-card" data-aos="fade-up" data-aos-delay="{{ $categoryIndex * 100 }}">
                    {{-- Category Header --}}
                    <div class="ikzserlist-category-header" style="--category-color: {{ $categoryColor }}">
                        <div class="ikzserlist-category-icon">
                            <i class="{{ $categoryIcon }}"></i>
                        </div>
                        <div class="ikzserlist-category-info">
                            <h3 class="ikzserlist-category-title" style="color: #fff">{{ $categoryTitle }}</h3>
                            @if($categoryDesc)
                                <p class="ikzserlist-category-desc" style="color: #fff">{{ $categoryDesc }}</p>
                            @endif
                        </div>
                        <button class="ikzserlist-expand-btn" type="button" aria-label="Genişlet">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>

                    {{-- Services Grid --}}
                    @if(!empty($services))
                        <div class="ikzserlist-services-grid">
                            @foreach($services as $serviceIndex => $service)
                                @php
                                    $serviceTitle = data_get($service, 'service_title.' . app()->getLocale(), 'Hizmet');
                                    $serviceDesc = data_get($service, 'service_description.' . app()->getLocale(), '');
                                    $serviceIcon = data_get($service, 'service_icon', 'fas fa-check-circle');
                                    $serviceLink = data_get($service, 'service_link', '#');
                                    $serviceImage = data_get($service, 'service_image');
                                @endphp

                                <div class="ikzserlist-service-item" style="--service-delay: {{ $serviceIndex * 0.05 }}s">
                                    @if($serviceImage)
                                        <div class="ikzserlist-service-image">
                                            <img src="{{ asset($serviceImage) }}" alt="{{ $serviceTitle }}" loading="lazy">
                                        </div>
                                    @endif

                                    <div class="ikzserlist-service-content">
                                        <div class="ikzserlist-service-icon">
                                            <i class="{{ $serviceIcon }}"></i>
                                        </div>
                                        <div class="ikzserlist-service-text">
                                            <h4 class="ikzserlist-service-title">{{ $serviceTitle }}</h4>
                                            @if($serviceDesc)
                                                <p class="ikzserlist-service-desc">{!! $serviceDesc !!}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ $serviceLink }}" class="ikzserlist-service-link" aria-label="{{ $serviceTitle }} detayları">
                                        <span>Detaylı Bilgi</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
    <style>
        /* === Base Section Styles === */
        .ikzserlist-section {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .ikzserlist-bg-light {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .ikzserlist-bg-dark {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        .ikzserlist-bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* === Section Header === */
        .ikzserlist-header {
            text-align: center;
            margin-bottom: 80px;
            position: relative;
        }

        .ikzserlist-header::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent);
            border-radius: 50%;
            z-index: 0;
        }

        .ikzserlist-header-content {
            position: relative;
            z-index: 1;
        }

        .ikzserlist-subtitle {
            font-size: 14px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 15px;
            display: block;
        }

        .ikzserlist-title {
            font-size: 48px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1.2;
            margin: 0;
            background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .ikzserlist-bg-dark .ikzserlist-title,
        .ikzserlist-bg-gradient .ikzserlist-title {
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* === Category Card === */
        .ikzserlist-categories {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .ikzserlist-category-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .ikzserlist-category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        /* === Category Header === */
        .ikzserlist-category-header {
            display: flex;
            align-items: center;
            gap: 25px;
            padding: 35px 40px;
            background: linear-gradient(135deg, var(--category-color, #2563eb) 0%, color-mix(in srgb, var(--category-color, #2563eb) 80%, black) 100%);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .ikzserlist-category-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .ikzserlist-category-header:hover::before {
            left: 100%;
        }

        .ikzserlist-category-icon {
            flex-shrink: 0;
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
        }

        .ikzserlist-category-header:hover .ikzserlist-category-icon {
            transform: rotate(360deg) scale(1.1);
            background: rgba(255, 255, 255, 0.3);
        }

        .ikzserlist-category-icon i {
            font-size: 32px;
            color: #ffffff;
        }

        .ikzserlist-category-info {
            flex: 1;
        }

        .ikzserlist-category-title {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            margin: 0 0 8px 0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .ikzserlist-category-desc {
            font-size: 15px;
            color: #fff;
            margin: 0;
            line-height: 1.6;
        }

        .ikzserlist-expand-btn {
            flex-shrink: 0;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .ikzserlist-expand-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .ikzserlist-expand-btn i {
            font-size: 20px;
            color: #ffffff;
            transition: transform 0.3s ease;
        }

        .ikzserlist-category-card.expanded .ikzserlist-expand-btn i {
            transform: rotate(180deg);
        }

        /* === Services Grid === */
        .ikzserlist-services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            padding: 40px;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .ikzserlist-category-card.expanded .ikzserlist-services-grid {
            max-height: 5000px;
            opacity: 1;
            padding: 40px;
        }

        /* === Service Item === */
        .ikzserlist-service-item {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.6s ease-out backwards;
            animation-delay: var(--service-delay, 0s);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ikzserlist-service-item:hover {
            border-color: var(--category-color, #2563eb);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .ikzserlist-service-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        .ikzserlist-service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .ikzserlist-service-item:hover .ikzserlist-service-image img {
            transform: scale(1.1);
        }

        .ikzserlist-service-content {
            padding: 25px;
            display: flex;
            gap: 15px;
            flex: 1;
        }

        .ikzserlist-service-icon {
            flex-shrink: 0;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--category-color, #2563eb) 0%, color-mix(in srgb, var(--category-color, #2563eb) 80%, black) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .ikzserlist-service-item:hover .ikzserlist-service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .ikzserlist-service-icon i {
            font-size: 22px;
            color: #ffffff;
        }

        .ikzserlist-service-text {
            flex: 1;
        }

        .ikzserlist-service-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .ikzserlist-service-desc {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        .ikzserlist-service-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 25px;
            background: #f8fafc;
            color: #1e293b;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border-top: 1px solid #f1f5f9;
        }

        .ikzserlist-service-link:hover {
            background: var(--category-color, #2563eb);
            color: #ffffff;
        }

        .ikzserlist-service-link i {
            transition: transform 0.3s ease;
        }

        .ikzserlist-service-link:hover i {
            transform: translateX(5px);
        }

        /* === Responsive === */
        @media (max-width: 1200px) {
            .ikzserlist-services-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 991px) {
            .ikzserlist-section {
                padding: 80px 0;
            }

            .ikzserlist-title {
                font-size: 38px;
            }

            .ikzserlist-category-header {
                padding: 25px 30px;
            }

            .ikzserlist-category-title {
                font-size: 24px;
            }

            .ikzserlist-services-grid {
                grid-template-columns: 1fr;
                padding: 30px;
            }
        }

        @media (max-width: 767px) {
            .ikzserlist-section {
                padding: 60px 0;
            }

            .ikzserlist-header {
                margin-bottom: 50px;
            }

            .ikzserlist-title {
                font-size: 32px;
            }

            .ikzserlist-category-header {
                padding: 20px;
                gap: 15px;
            }

            .ikzserlist-category-icon {
                width: 50px;
                height: 50px;
            }

            .ikzserlist-category-icon i {
                font-size: 24px;
            }

            .ikzserlist-category-title {
                font-size: 20px;
            }

            .ikzserlist-category-desc {
                font-size: 13px;
            }

            .ikzserlist-expand-btn {
                width: 40px;
                height: 40px;
            }

            .ikzserlist-services-grid {
                padding: 20px;
            }

            .ikzserlist-service-content {
                padding: 20px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryCards = document.querySelectorAll('.ikzserlist-category-card');

            // İlk kategoriyi otomatik aç
            if (categoryCards.length > 0) {
                categoryCards[0].classList.add('expanded');
            }

            categoryCards.forEach(card => {
                const header = card.querySelector('.ikzserlist-category-header');

                header.addEventListener('click', function() {
                    const isExpanded = card.classList.contains('expanded');

                    // Tüm kartları kapat
                    categoryCards.forEach(c => c.classList.remove('expanded'));

                    // Eğer kapalıysa aç
                    if (!isExpanded) {
                        card.classList.add('expanded');
                    }
                });
            });
        });
    </script>
@endpush