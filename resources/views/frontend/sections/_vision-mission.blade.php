@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $backgroundImage = data_get($content, 'background_image');

    // Vizyon
    $visionIcon = data_get($content, 'vision_icon', 'icofont-eye-alt');
    $visionTitle = data_get($content, 'vision_title.' . app()->getLocale(), '');
    $visionContent = data_get($content, 'vision_content.' . app()->getLocale(), '');
    $visionImage = data_get($content, 'vision_image');

    // Misyon
    $missionIcon = data_get($content, 'mission_icon', 'icofont-flag-alt-1');
    $missionTitle = data_get($content, 'mission_title.' . app()->getLocale(), '');
    $missionContent = data_get($content, 'mission_content.' . app()->getLocale(), '');
    $missionImage = data_get($content, 'mission_image');

    // Değerler ve İstatistikler
    $values = data_get($content, 'values', []);
    $statistics = data_get($content, 'statistics', []);
@endphp

<section class="izokoc-vision-mission-section">
    {{-- Arka Plan --}}
    @if($backgroundImage)
        <div class="izokoc-vm-background">
            <img src="{{ asset($backgroundImage) }}" alt="{{ $mainTitle }}">
            <div class="izokoc-vm-background__overlay"></div>
        </div>
    @endif

    <div class="container">
        {{-- Başlık --}}
        <div class="row">
            <div class="col-lg-12 text-center">
                @if($subTitle)
                    <h6 class="izokoc-section__subtitle">{{ $subTitle }}</h6>
                @endif
                @if($mainTitle)
                    <h2 class="izokoc-section__title">{{ $mainTitle }}</h2>
                @endif
            </div>
        </div>

        {{-- Vizyon ve Misyon Kartları --}}
        <div class="row izokoc-vm-cards">
            {{-- Vizyon --}}
            @if($visionTitle || $visionContent)
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="izokoc-vm-card izokoc-vm-card--vision">
                        <div class="izokoc-vm-card__icon">
                            <i class="{{ $visionIcon }}"></i>
                        </div>

                        @if($visionImage)
                            <div class="izokoc-vm-card__image">
                                <img src="{{ asset($visionImage) }}" alt="{{ $visionTitle }}">
                            </div>
                        @endif

                        <div class="izokoc-vm-card__content">
                            @if($visionTitle)
                                <h3 class="izokoc-vm-card__title">{{ $visionTitle }}</h3>
                            @endif
                            @if($visionContent)
                                <div class="izokoc-vm-card__text">
                                    <p>{!! $visionContent  !!}</p>
                                </div>
                            @endif
                        </div>

                        <div class="izokoc-vm-card__decoration"></div>
                    </div>
                </div>
            @endif

            {{-- Misyon --}}
            @if($missionTitle || $missionContent)
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="izokoc-vm-card izokoc-vm-card--mission">
                        <div class="izokoc-vm-card__icon">
                            <i class="{{ $missionIcon }}"></i>
                        </div>

                        @if($missionImage)
                            <div class="izokoc-vm-card__image">
                                <img src="{{ asset($missionImage) }}" alt="{{ $missionTitle }}">
                            </div>
                        @endif

                        <div class="izokoc-vm-card__content">
                            @if($missionTitle)
                                <h3 class="izokoc-vm-card__title">{{ $missionTitle }}</h3>
                            @endif
                            @if($missionContent)
                                <div class="izokoc-vm-card__text">
                                    <p>{!! $missionContent  !!}</p>
                                </div>
                            @endif
                        </div>

                        <div class="izokoc-vm-card__decoration"></div>
                    </div>
                </div>
            @endif
        </div>

        {{-- İstatistikler --}}
        @if(!empty($statistics))
            <div class="row izokoc-statistics-row">
                <div class="col-lg-12">
                    <div class="izokoc-statistics-grid">
                        @foreach($statistics as $index => $stat)
                            @php
                                $statIcon = data_get($stat, 'stat_icon', 'icofont-chart-growth');
                                $statNumber = data_get($stat, 'stat_number', '0');
                                $statSuffix = data_get($stat, 'stat_suffix', '');
                                $statTitle = data_get($stat, 'stat_title.' . app()->getLocale(), '');
                            @endphp

                            <div class="izokoc-stat-box" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                                <div class="izokoc-stat-box__icon">
                                    <i class="{{ $statIcon }}"></i>
                                </div>
                                <div class="izokoc-stat-box__number">
                                    <span class="counter" data-count="{{ $statNumber }}">0</span>
                                    @if($statSuffix)
                                        <span class="suffix">{{ $statSuffix }}</span>
                                    @endif
                                </div>
                                <div class="izokoc-stat-box__title">{{ $statTitle }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Değerlerimiz --}}
        @if(!empty($values))
            <div class="row izokoc-values-row">
                <div class="col-lg-12 text-center" data-aos="fade-up">
                    <h3 class="izokoc-values__heading">{{ __('Our Core Values') }}</h3>
                </div>

                @foreach($values as $index => $value)
                    @php
                        $valueIcon = data_get($value, 'value_icon', 'icofont-star');
                        $valueTitle = data_get($value, 'value_title.' . app()->getLocale(), '');
                        $valueDescription = data_get($value, 'value_description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="izokoc-value-card">
                            <div class="izokoc-value-card__icon">
                                <i class="{{ $valueIcon }}"></i>
                            </div>
                            <h5 class="izokoc-value-card__title">{{ $valueTitle }}</h5>
                            <p class="izokoc-value-card__description">{!! $valueDescription !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .izokoc-vision-mission-section {
            padding: 100px 0;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .izokoc-vm-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .izokoc-vm-background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .izokoc-vm-background__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 249, 250, 0.9) 100%);
        }

        .izokoc-vision-mission-section .container {
            position: relative;
            z-index: 1;
        }

        /* Başlık Stilleri */
        .izokoc-section__subtitle {
            color: #ffc107;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .izokoc-section__title {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 60px;
        }

        /* Vizyon Misyon Kartları */
        .izokoc-vm-cards {
            margin-bottom: 80px;
        }

        .izokoc-vm-card {
            position: relative;
            background: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            overflow: hidden;
            height: 100%;
            min-height: 500px;
            display: flex;
            flex-direction: column;
        }

        .izokoc-vm-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .izokoc-vm-card--vision {
            border-top: 5px solid #2196f3;
        }

        .izokoc-vm-card--mission {
            border-top: 5px solid #ffc107;
        }

        .izokoc-vm-card__icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .izokoc-vm-card--vision .izokoc-vm-card__icon {
            background: linear-gradient(135deg, #2196f3, #1976d2);
            color: #fff;
        }

        .izokoc-vm-card--mission .izokoc-vm-card__icon {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: #1a1a1a;
        }

        .izokoc-vm-card:hover .izokoc-vm-card__icon {
            transform: rotate(360deg) scale(1.1);
        }

        .izokoc-vm-card__image {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            height: 200px;
        }

        .izokoc-vm-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .izokoc-vm-card:hover .izokoc-vm-card__image img {
            transform: scale(1.1);
        }

        .izokoc-vm-card__content {
            flex: 1;
        }

        .izokoc-vm-card__title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 20px;
        }

        .izokoc-vm-card__text {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
        }

        .izokoc-vm-card__decoration {
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            opacity: 0.1;
        }

        .izokoc-vm-card--vision .izokoc-vm-card__decoration {
            background: linear-gradient(135deg, #2196f3, #1976d2);
        }

        .izokoc-vm-card--mission .izokoc-vm-card__decoration {
            background: linear-gradient(135deg, #ffc107, #ff9800);
        }

        /* İstatistikler */
        .izokoc-statistics-row {
            margin-bottom: 80px;
        }

        .izokoc-statistics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            padding: 40px;
            background: linear-gradient(135deg, #f8f9fa, #fff);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .izokoc-stat-box {
            text-align: center;
            padding: 30px 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .izokoc-stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.2);
        }

        .izokoc-stat-box__icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #1a1a1a;
            margin: 0 auto 20px;
        }

        .izokoc-stat-box__number {
            font-size: 48px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
            line-height: 1;
        }

        .izokoc-stat-box__number .suffix {
            font-size: 32px;
            color: #ffc107;
        }

        .izokoc-stat-box__title {
            font-size: 16px;
            color: #666;
            font-weight: 500;
        }

        /* Değerler */
        .izokoc-values-row {
            padding-top: 60px;
            border-top: 2px solid #e0e0e0;
        }

        .izokoc-values__heading {
            font-size: 36px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 50px;
            position: relative;
            padding-bottom: 20px;
        }

        .izokoc-values__heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #ffc107, #ff9800);
            border-radius: 2px;
        }

        .izokoc-value-card {
            text-align: center;
            padding: 40px 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 30px;
        }

        .izokoc-value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .izokoc-value-card__icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #1a1a1a;
            margin: 0 auto 25px;
            transition: all 0.3s ease;
        }

        .izokoc-value-card:hover .izokoc-value-card__icon {
            transform: rotate(360deg);
        }

        .izokoc-value-card__title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .izokoc-value-card__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        /* Sayaç Animasyonu */
        .counter {
            display: inline-block;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .izokoc-vision-mission-section {
                padding: 60px 0;
            }

            .izokoc-section__title {
                font-size: 32px;
                margin-bottom: 40px;
            }

            .izokoc-vm-card {
                min-height: 400px;
                margin-bottom: 30px;
            }

            .izokoc-statistics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .izokoc-section__title {
                font-size: 28px;
            }

            .izokoc-vm-card {
                padding: 40px 30px;
                min-height: auto;
            }

            .izokoc-vm-card__title {
                font-size: 24px;
            }

            .izokoc-statistics-grid {
                grid-template-columns: 1fr;
                padding: 30px 20px;
            }

            .izokoc-stat-box__number {
                font-size: 36px;
            }

            .izokoc-values__heading {
                font-size: 28px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Counter Animation
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');

            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000; // 2 saniye
                const increment = target / (duration / 16); // 60 FPS
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            };

            // Intersection Observer ile görünür olduğunda başlat
            const observerOptions = {
                threshold: 0.5
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        animateCounter(counter);
                        observer.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
@endpush