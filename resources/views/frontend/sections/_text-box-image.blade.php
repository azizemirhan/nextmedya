@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Hakkımızda');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Biz Kimiz');
    $mainContent = data_get($content, 'main_content.' . app()->getLocale(), 'Sektörde uzun yıllara dayanan tecrübemizle, müşterilerimize en kaliteli hizmeti sunmak için çalışıyoruz.');
    $image = data_get($content, 'image') ? asset($content['image']) : 'https://placehold.co/600x700';
    $imagePosition = data_get($content, 'image_position', 'right'); // left veya right

    $features = data_get($content, 'features', []);
    if (empty($features)) {
        $features = [
            [
                'icon' => 'fas fa-check-circle',
                'text' => ['tr' => 'Profesyonel Ekip', 'en' => 'Professional Team']
            ],
            [
                'icon' => 'fas fa-check-circle',
                'text' => ['tr' => 'Kaliteli Hizmet', 'en' => 'Quality Service']
            ],
            [
                'icon' => 'fas fa-check-circle',
                'text' => ['tr' => 'Zamanında Teslimat', 'en' => 'On-Time Delivery']
            ],
        ];
    }

    $stats = data_get($content, 'stats', []);
    if (empty($stats)) {
        $stats = [
            ['number' => '500+', 'label' => ['tr' => 'Mutlu Müşteri', 'en' => 'Happy Clients']],
            ['number' => '15+', 'label' => ['tr' => 'Yıllık Deneyim', 'en' => 'Years Experience']],
        ];
    }
@endphp

<section class="txtbox-section">
    <div class="container">
        <div class="row align-items-center {{ $imagePosition === 'left' ? 'flex-row-reverse' : '' }}">
            <div class="col-lg-6">
                <div class="txtbox-content">
                    <span class="txtbox-content__subtitle">{{ $sectionSubtitle }}</span>
                    <h2 class="txtbox-content__title">{{ $sectionTitle }}</h2>

                    <div class="txtbox-content__text">
                        {!! $mainContent !!}
                    </div>

                    @if(!empty($features))
                        <ul class="txtbox-features">
                            @foreach($features as $feature)
                                <li class="txtbox-features__item">
                                    <i class="{{ data_get($feature, 'icon', 'fas fa-check-circle') }} txtbox-features__icon"></i>
                                    <span>{{ data_get($feature, 'text.' . app()->getLocale(), 'Feature') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if(!empty($stats))
                        <div class="txtbox-stats">
                            @foreach($stats as $stat)
                                <div class="txtbox-stats__item">
                                    <h3 class="txtbox-stats__number">{{ data_get($stat, 'number', '0') }}</h3>
                                    <p class="txtbox-stats__label">{{ data_get($stat, 'label.' . app()->getLocale(), 'Stat') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if(data_get($content, 'button_text.' . app()->getLocale()))
                        <div class="txtbox-cta">
                            <a href="{{ data_get($content, 'button_link', '#') }}" class="txtbox-btn">
                                <span>{{ data_get($content, 'button_text.' . app()->getLocale()) }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="txtbox-image-wrapper" data-aos="fade-{{ $imagePosition === 'left' ? 'right' : 'left' }}">
                    <div class="txtbox-image">
                        <img src="{{ $image }}" alt="{{ $sectionTitle }}" class="txtbox-image__img">
                        <div class="txtbox-image__overlay"></div>
                        <div class="txtbox-image__pattern"></div>
                    </div>

                    @if(data_get($content, 'badge_text.' . app()->getLocale()))
                        <div class="txtbox-badge">
                            <div class="txtbox-badge__icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="txtbox-badge__text">
                                {{ data_get($content, 'badge_text.' . app()->getLocale()) }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .txtbox-section {
            padding: 100px 0;
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .txtbox-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 60%);
            border-radius: 50%;
        }

        .txtbox-content {
            padding-right: 30px;
        }

        .txtbox-content__subtitle {
            display: inline-block;
            background: var(--gradient-primary);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
        }

        .txtbox-content__title {
            font-size: 46px;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .txtbox-content__text {
            font-size: 17px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .txtbox-content__text p {
            margin-bottom: 15px;
        }

        .txtbox-features {
            list-style: none;
            padding: 0;
            margin: 0 0 35px 0;
        }

        .txtbox-features__item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 16px;
            color: var(--text-primary);
            font-weight: 500;
        }

        .txtbox-features__icon {
            color: var(--success-color);
            font-size: 20px;
            flex-shrink: 0;
        }

        .txtbox-stats {
            display: flex;
            gap: 50px;
            margin: 40px 0;
            padding: 30px 0;
            border-top: 2px solid var(--border-color);
            border-bottom: 2px solid var(--border-color);
        }

        .txtbox-stats__item {
            text-align: center;
        }

        .txtbox-stats__number {
            font-size: 42px;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
            line-height: 1;
        }

        .txtbox-stats__label {
            font-size: 15px;
            color: var(--text-secondary);
            font-weight: 500;
            margin: 0;
        }

        .txtbox-cta {
            margin-top: 35px;
        }

        .txtbox-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--gradient-primary);
            color: #ffffff;
            padding: 18px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .txtbox-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-glow);
            color: #ffffff;
        }

        .txtbox-btn i {
            transition: transform 0.3s ease;
        }

        .txtbox-btn:hover i {
            transform: translateX(5px);
        }

        .txtbox-image-wrapper {
            position: relative;
            padding: 20px;
        }

        .txtbox-image {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .txtbox-image__img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.6s ease;
        }

        .txtbox-image:hover .txtbox-image__img {
            transform: scale(1.05);
        }

        .txtbox-image__overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(14, 19, 39, 0.3) 0%, transparent 100%);
            pointer-events: none;
        }

        .txtbox-image__pattern {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: var(--gradient-primary);
            border-radius: 30px;
            opacity: 0.1;
            z-index: -1;
        }

        .txtbox-badge {
            position: absolute;
            bottom: 40px;
            left: 40px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 10;
        }

        .txtbox-badge__icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .txtbox-badge__icon i {
            color: #ffffff;
            font-size: 24px;
        }

        .txtbox-badge__text {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary-dark);
            line-height: 1.4;
        }

        @media (max-width: 992px) {
            .txtbox-section {
                padding: 80px 0;
            }

            .txtbox-content {
                padding-right: 0;
                margin-bottom: 50px;
            }

            .txtbox-content__title {
                font-size: 36px;
            }

            .txtbox-stats {
                gap: 30px;
            }

            .txtbox-stats__number {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .txtbox-content__title {
                font-size: 28px;
            }

            .txtbox-stats {
                flex-direction: column;
                gap: 20px;
            }

            .txtbox-badge {
                bottom: 20px;
                left: 20px;
                padding: 15px 20px;
            }

            .txtbox-badge__icon {
                width: 40px;
                height: 40px;
            }

            .txtbox-badge__icon i {
                font-size: 20px;
            }

            .txtbox-badge__text {
                font-size: 13px;
            }
        }
    </style>
@endpush