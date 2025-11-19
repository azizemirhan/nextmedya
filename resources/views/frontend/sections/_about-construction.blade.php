@php
    // Ana Başlıklar
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Sizin Vizyonunuz');
    $mainSubtitle = data_get($content, 'main_subtitle.' . app()->getLocale(), 'Bizim Ustalığımız');

    // Hero Bölümü
    $heroImage = data_get($content, 'hero_image') ? asset($content['hero_image']) : 'https://placehold.co/600x400';
    $yearsExperience = data_get($content, 'years_experience', '25+');
    $yearsLabel = data_get($content, 'years_label.' . app()->getLocale(), 'Yıllık Sektör Tecrübesi');

    // Tags
    $tag1 = data_get($content, 'tag1.' . app()->getLocale(), 'Kalite Odaklı Yaklaşım');
    $tag2 = data_get($content, 'tag2.' . app()->getLocale(), 'Güven İnşa Eder');

    // Menü Öğeleri
    $menuItems = data_get($content, 'menu_items', []);
    if (is_string($menuItems)) {
        $menuItems = json_decode($menuItems, true) ?? [];
    }

    // Varsayılan menü öğeleri
    if (empty($menuItems)) {
        $menuItems = [
            ['label' => ['tr' => 'MİSYON & VİZYON', 'en' => 'MISSION & VISION'], 'anchor' => 'mission-vision'],
            ['label' => ['tr' => 'DEĞERLERİMİZ', 'en' => 'OUR VALUES'], 'anchor' => 'values'],
            ['label' => ['tr' => 'EKİBİMİZ', 'en' => 'OUR TEAM'], 'anchor' => 'team'],
            ['label' => ['tr' => 'ÇALIŞMA PRENSİBİMİZ', 'en' => 'WORK PRINCIPLE'], 'anchor' => 'work-principle'],
            ['label' => ['tr' => 'HİZMETLERİMİZ', 'en' => 'OUR SERVICES'], 'anchor' => 'services'],
        ];
    }

    // Üst Sağ İçerik
    $topRightContent = data_get($content, 'top_right_content.' . app()->getLocale(), 'Başarımızın temelindeki güç, uzman ve tutkulu ekibimizdir. Kalite ve güven vizyonumuzu benimseyen takımımızla, en zorlu projeleri bile birlikte hayata geçiririz.');
    $topRightLink = data_get($content, 'top_right_link_text.' . app()->getLocale(), 'Bizimle İletişime Geçin');

    // Alt Kartlar (4 adet)
    $cards = data_get($content, 'service_cards', []);
    if (is_string($cards)) {
        $cards = json_decode($cards, true) ?? [];
    }

    // Varsayılan kartlar
    if (empty($cards)) {
        $cards = [
            [
                'title' => ['tr' => 'Genel İnşaat', 'en' => 'General Construction'],
                'content' => ['tr' => 'Fikir aşamasından teslim edilene kadar projenizin her aşamasını yönetiyoruz.', 'en' => 'From concept to completion, we handle every aspect of your project.'],
                'link_text' => ['tr' => 'Daha Fazla', 'en' => 'Read More']
            ],
            [
                'title' => ['tr' => 'Yenileme Süreci', 'en' => 'Renovation Process'],
                'content' => ['tr' => 'Yenileme ve restorasyon konusundaki uzmanlığımızla mekanınıza yeni bir soluk kazandırıyoruz.', 'en' => 'Breathe new life into your space with our expertise in renovation and restoration.'],
                'link_text' => ['tr' => 'Daha Fazla', 'en' => 'Read More']
            ],
            [
                'title' => ['tr' => 'Bina Tasarımı', 'en' => 'Building Design'],
                'content' => ['tr' => 'Tasarım ve inşaatın kusursuz entegrasyonu ile verimlilik ve maliyet tasarrufu sağlıyoruz.', 'en' => 'Seamless integration of design and construction for efficiency and cost savings.'],
                'link_text' => ['tr' => 'Daha Fazla', 'en' => 'Read More'],
                'image' => null
            ],
            [
                'title' => ['tr' => 'Bina Yönetimi', 'en' => 'Building Management'],
                'content' => ['tr' => 'Zamanında ve maliyet etkin proje teslimi için her detayı gözetiyoruz.', 'en' => 'We oversee every detail to ensure timely and cost-effective project delivery.'],
                'link_text' => ['tr' => 'Daha Fazla', 'en' => 'Read More']
            ]
        ];
    }
@endphp

<section class="construction-about">
    <div class="container">
        <!-- Main Title -->
        <div class="row main-title-section">
            <div class="col-lg-6">
                <h1 class="main-title">{{ $mainTitle }}</h1>
                <h2 class="main-subtitle">{{ $mainSubtitle }}</h2>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="row hero-section">
            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <img src="{{ $heroImage }}" alt="Construction">
                    <div class="experience-badge">
                        <div class="experience-number">{{ $yearsExperience }}</div>
                        <div class="experience-text">{{ $yearsLabel }}</div>
                    </div>
                </div>
                <div class="tags-wrapper">
                    <span class="tag">{{ $tag1 }}</span>
                    <span class="tag">{{ $tag2 }}</span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row h-100">
                    <div class="col-lg-6">
                        <div class="menu-section">
                            <ul class="menu-list">
                                @foreach($menuItems as $index => $item)
                                    <li class="menu-item">
                                        <a href="#{{ data_get($item, 'anchor', 'section-' . ($index + 1)) }}"
                                           class="menu-link smooth-scroll">
                                            <span class="menu-label">{{ data_get($item, 'label.' . app()->getLocale()) }}</span>
                                            <span class="menu-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="info-box">
                            <p class="info-content">{!! $topRightContent !!}</p>
                            <a href="#contact" class="read-more-btn smooth-scroll">
                                {{ $topRightLink }}
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Cards -->
        <div class="row service-cards">
            @foreach($cards as $index => $card)
                <div class="col-lg-3 col-md-6">
                    <div class="service-card {{ data_get($card, 'image') ? 'with-image' : '' }}">
                        @if(data_get($card, 'image'))
                            <img src="{{ asset(data_get($card, 'image')) }}" alt="" class="service-bg-image">
                        @endif

                        <div class="service-content">
                            <h3>{{ data_get($card, 'title.' . app()->getLocale()) }}</h3>
                            <p>{!! data_get($card, 'content.' . app()->getLocale()) !!}</p>
                            <a href="#" class="service-link">
                                {{ data_get($card, 'link_text.' . app()->getLocale(), 'Read More') }}
                                <span>→</span>
                            </a>
                        </div>

                        @if(data_get($card, 'image'))
                            <div class="arrow-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
    <style>
        /* Modern Construction About Section */
        .construction-about {
            padding: 100px 0;
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        /* Background Pattern */
        .construction-about::before {
            content: '';
            position: absolute;
            top: 0;
            right: -200px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 193, 7, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Main Title Section */
        .main-title-section {
            margin-bottom: 60px;
        }

        .main-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 300;
            line-height: 1;
            letter-spacing: -0.02em;
            color: #1a1a1a;
            margin: 0;
        }

        .main-subtitle {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            line-height: 1.1;
            color: #1a1a1a;
            margin: 0;
        }

        /* Hero Section */
        .hero-section {
            margin-bottom: 80px;
        }

        .hero-image-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            background: #f8f8f8;
            height: 400px;
        }

        .hero-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .hero-image-wrapper:hover img {
            transform: scale(1.05);
        }

        /* Experience Badge */
        .experience-badge {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .experience-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            line-height: 1;
            margin-bottom: 5px;
        }

        .experience-text {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        /* Tags */
        .tags-wrapper {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .tag {
            background: #f5f5f5;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .tag:hover {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Menu Section */
        .menu-section {
            background: #f8f8f8;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-link:hover {
            padding-left: 10px;
        }

        .menu-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 2px;
            background: #ffc107;
            transition: width 0.3s ease;
        }

        .menu-link:hover::before {
            width: 5px;
        }

        .menu-label {
            font-size: 0.85rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .menu-link:hover .menu-label {
            color: #1a1a1a;
        }

        .menu-number {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        /* Info Box */
        .info-box {
            background: #f8f8f8;
            padding: 40px;
            border-radius: 20px;
            position: relative;
            height: 100%;
        }

        .info-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
        }

        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1a1a1a;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .read-more-btn:hover {
            color: #ffc107;
            border-bottom-color: #ffc107;
            gap: 15px;
        }

        /* Service Cards */
        .service-cards {
            margin-top: 60px;
        }

        .service-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
            min-height: 250px;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            transition: width 0.4s ease;
        }

        .service-card:hover::before {
            width: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: #16213e;
        }

        .service-card.with-image {
            background-color: #1a1a1a;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .service-card.with-image .service-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3;
            transition: all 0.4s ease;
        }

        .service-card.with-image:hover .service-bg-image {
            transform: scale(1.1);
            opacity: 0.5;
        }

        .service-card.with-image .service-content {
            position: relative;
            z-index: 2;
        }

        .service-card.with-image h3 {
            color: #fff;
        }

        .service-card.with-image p {
            color: rgba(255, 255, 255, 0.9);
        }

        .service-card.with-image .service-link {
            color: #ffc107;
            border-bottom-color: #ffc107;
        }

        .service-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1a1a1a;
        }

        .service-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .service-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1a1a1a;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .service-link:hover {
            color: #ffc107;
            border-bottom-color: #ffc107;
            gap: 15px;
        }

        /* Arrow Icon */
        .arrow-icon {
            width: 50px;
            height: 50px;
            background: #ffc107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            bottom: 30px;
            right: 30px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .arrow-icon:hover {
            transform: scale(1.1) rotate(45deg);
            background: #ffab00;
        }

        .arrow-icon svg {
            width: 20px;
            height: 20px;
            fill: #1a1a1a;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-image-wrapper {
                height: 300px;
            }

            .service-card {
                min-height: 200px;
            }

            .main-title, .main-subtitle {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .construction-about {
                padding: 60px 0;
            }

            .tags-wrapper {
                flex-wrap: wrap;
            }

            .experience-badge {
                bottom: 20px;
                left: 20px;
                padding: 15px 20px;
            }

            .experience-number {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll fonksiyonu
            const smoothScrollLinks = document.querySelectorAll('.smooth-scroll');

            smoothScrollLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        const headerOffset = 100; // Header yüksekliği kadar offset
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Aktif menü öğesini işaretle
                        document.querySelectorAll('.menu-link').forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });

            // Scroll spy - hangi bölümde olduğumuzu tespit et
            const sections = document.querySelectorAll('[id^="mission-"], [id^="values"], [id^="team"], [id^="work-principle"], [id^="services"]');

            window.addEventListener('scroll', () => {
                let current = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.pageYOffset >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                smoothScrollLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href').substring(1) === current) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
@endpush
