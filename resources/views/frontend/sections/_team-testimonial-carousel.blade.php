@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Ekibimiz');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Uzman Kadromuz');
    $sectionType = data_get($content, 'section_type', 'team'); // team veya testimonial
    
    $items = data_get($content, 'items', []);
    
    if (empty($items)) {
        if ($sectionType === 'team') {
            $items = [
                [
                    'image' => 'https://placehold.co/400x500',
                    'name' => ['tr' => 'Ahmet Yılmaz', 'en' => 'Ahmet Yilmaz'],
                    'position' => ['tr' => 'Genel Müdür', 'en' => 'General Manager'],
                    'bio' => ['tr' => '15 yıllık deneyim', 'en' => '15 years of experience'],
                    'social' => [
                        'linkedin' => '#',
                        'twitter' => '#',
                        'email' => 'ahmet@example.com'
                    ]
                ],
                [
                    'image' => 'https://placehold.co/400x500',
                    'name' => ['tr' => 'Ayşe Demir', 'en' => 'Ayse Demir'],
                    'position' => ['tr' => 'Proje Müdürü', 'en' => 'Project Manager'],
                    'bio' => ['tr' => '10 yıllık deneyim', 'en' => '10 years of experience'],
                    'social' => [
                        'linkedin' => '#',
                        'twitter' => '#',
                        'email' => 'ayse@example.com'
                    ]
                ],
                [
                    'image' => 'https://placehold.co/400x500',
                    'name' => ['tr' => 'Mehmet Kaya', 'en' => 'Mehmet Kaya'],
                    'position' => ['tr' => 'Baş Mühendis', 'en' => 'Chief Engineer'],
                    'bio' => ['tr' => '12 yıllık deneyim', 'en' => '12 years of experience'],
                    'social' => [
                        'linkedin' => '#',
                        'twitter' => '#',
                        'email' => 'mehmet@example.com'
                    ]
                ],
            ];
        } else {
            $items = [
                [
                    'image' => 'https://placehold.co/100x100',
                    'name' => ['tr' => 'Ali Veli', 'en' => 'Ali Veli'],
                    'position' => ['tr' => 'CEO, ABC Şirketi', 'en' => 'CEO, ABC Company'],
                    'testimonial' => ['tr' => 'Harika bir ekip, profesyonel yaklaşım ve mükemmel sonuçlar. Kesinlikle tavsiye ederim.', 'en' => 'Great team, professional approach and excellent results. I definitely recommend.'],
                    'rating' => 5
                ],
                [
                    'image' => 'https://placehold.co/100x100',
                    'name' => ['tr' => 'Zeynep Yıldız', 'en' => 'Zeynep Yildiz'],
                    'position' => ['tr' => 'Kurucu, XYZ Startup', 'en' => 'Founder, XYZ Startup'],
                    'testimonial' => ['tr' => 'Beklentilerimizi aşan bir hizmet aldık. Teşekkürler!', 'en' => 'We received a service that exceeded our expectations. Thank you!'],
                    'rating' => 5
                ],
            ];
        }
    }
    
    $uniqueId = 'tmcar-' . uniqid();
@endphp

<section class="tmcar-section tmcar-section--{{ $sectionType }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tmcar-header">
                    <span class="tmcar-header__subtitle">{{ $sectionSubtitle }}</span>
                    <h2 class="tmcar-header__title">{{ $sectionTitle }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tmcar-carousel-wrapper">
                    <div id="{{ $uniqueId }}" class="carousel slide tmcar-carousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($items->chunk(3) as $chunkIndex => $chunk)
                                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach($chunk as $item)
                                            <div class="col-lg-4">
                                                @if($sectionType === 'team')
                                                    <div class="tmcar-team-card">
                                                        <div class="tmcar-team-card__image">
                                                            <img src="{{ data_get($item, 'image', 'https://placehold.co/400x500') }}" alt="{{ data_get($item, 'name.' . app()->getLocale()) }}">
                                                            <div class="tmcar-team-card__overlay">
                                                                <div class="tmcar-team-card__social">
                                                                    @if(data_get($item, 'social.linkedin'))
                                                                        <a href="{{ data_get($item, 'social.linkedin') }}" class="tmcar-social-link">
                                                                            <i class="fab fa-linkedin-in"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if(data_get($item, 'social.twitter'))
                                                                        <a href="{{ data_get($item, 'social.twitter') }}" class="tmcar-social-link">
                                                                            <i class="fab fa-twitter"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if(data_get($item, 'social.email'))
                                                                        <a href="mailto:{{ data_get($item, 'social.email') }}" class="tmcar-social-link">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tmcar-team-card__content">
                                                            <h3 class="tmcar-team-card__name">{{ data_get($item, 'name.' . app()->getLocale()) }}</h3>
                                                            <p class="tmcar-team-card__position">{{ data_get($item, 'position.' . app()->getLocale()) }}</p>
                                                            @if(data_get($item, 'bio.' . app()->getLocale()))
                                                                <p class="tmcar-team-card__bio">{{ data_get($item, 'bio.' . app()->getLocale()) }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="tmcar-testimonial-card">
                                                        <div class="tmcar-testimonial-card__quote">
                                                            <i class="fas fa-quote-left"></i>
                                                        </div>
                                                        <div class="tmcar-testimonial-card__rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fas fa-star {{ $i <= data_get($item, 'rating', 5) ? 'active' : '' }}"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="tmcar-testimonial-card__text">{{ data_get($item, 'testimonial.' . app()->getLocale()) }}</p>
                                                        <div class="tmcar-testimonial-card__author">
                                                            <img src="{{ data_get($item, 'image') }}" alt="{{ data_get($item, 'name.' . app()->getLocale()) }}" class="tmcar-testimonial-card__avatar">
                                                            <div class="tmcar-testimonial-card__info">
                                                                <h4 class="tmcar-testimonial-card__name">{{ data_get($item, 'name.' . app()->getLocale()) }}</h4>
                                                                <p class="tmcar-testimonial-card__position">{{ data_get($item, 'position.' . app()->getLocale()) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($items->count() > 3)
                            <button class="carousel-control-prev tmcar-control tmcar-control--prev" type="button" data-bs-target="#{{ $uniqueId }}" data-bs-slide="prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-control-next tmcar-control tmcar-control--next" type="button" data-bs-target="#{{ $uniqueId }}" data-bs-slide="next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .tmcar-section {
            padding: 100px 0;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .tmcar-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .tmcar-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .tmcar-header__subtitle {
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

        .tmcar-header__title {
            font-size: 46px;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            line-height: 1.2;
        }

        .tmcar-carousel-wrapper {
            position: relative;
            padding: 20px 0;
        }

        /* Team Card Styles */
        .tmcar-team-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            margin-bottom: 30px;
            height: 100%;
        }

        .tmcar-team-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .tmcar-team-card__image {
            position: relative;
            overflow: hidden;
            height: 400px;
        }

        .tmcar-team-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .tmcar-team-card:hover .tmcar-team-card__image img {
            transform: scale(1.1);
        }

        .tmcar-team-card__overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 60%, rgba(14, 19, 39, 0.9) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 30px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .tmcar-team-card:hover .tmcar-team-card__overlay {
            opacity: 1;
        }

        .tmcar-team-card__social {
            display: flex;
            gap: 15px;
        }

        .tmcar-social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 18px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .tmcar-social-link:hover {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            transform: translateY(-3px);
            color: #ffffff;
        }

        .tmcar-team-card__content {
            padding: 25px;
            text-align: center;
        }

        .tmcar-team-card__name {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }

        .tmcar-team-card__position {
            font-size: 15px;
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .tmcar-team-card__bio {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Testimonial Card Styles */
        .tmcar-testimonial-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            margin-bottom: 30px;
            position: relative;
            height: 100%;
        }

        .tmcar-testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .tmcar-testimonial-card__quote {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.15));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tmcar-testimonial-card__quote i {
            font-size: 24px;
            color: var(--primary-blue);
        }

        .tmcar-testimonial-card__rating {
            margin-bottom: 20px;
        }

        .tmcar-testimonial-card__rating i {
            color: #ddd;
            font-size: 18px;
            margin-right: 5px;
        }

        .tmcar-testimonial-card__rating i.active {
            color: var(--warning-color);
        }

        .tmcar-testimonial-card__text {
            font-size: 16px;
            color: var(--text-primary);
            line-height: 1.8;
            margin-bottom: 30px;
            font-style: italic;
        }

        .tmcar-testimonial-card__author {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-top: 25px;
            border-top: 2px solid var(--border-color);
        }

        .tmcar-testimonial-card__avatar {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid var(--primary-blue);
        }

        .tmcar-testimonial-card__name {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }

        .tmcar-testimonial-card__position {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Carousel Controls */
        .tmcar-control {
            width: 50px;
            height: 50px;
            background: #ffffff;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            opacity: 1;
            transition: all 0.3s ease;
            top: 50%;
            transform: translateY(-50%);
        }

        .tmcar-control i {
            color: var(--primary-dark);
            font-size: 18px;
        }

        .tmcar-control:hover {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .tmcar-control:hover i {
            color: #ffffff;
        }

        .tmcar-control--prev {
            left: -25px;
        }

        .tmcar-control--next {
            right: -25px;
        }

        @media (max-width: 992px) {
            .tmcar-section {
                padding: 80px 0;
            }

            .tmcar-header__title {
                font-size: 36px;
            }

            .tmcar-team-card__image {
                height: 350px;
            }

            .tmcar-control {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .tmcar-section {
                padding: 60px 0;
            }

            .tmcar-header__title {
                font-size: 28px;
            }

            .tmcar-team-card__image {
                height: 300px;
            }

            .tmcar-testimonial-card {
                padding: 30px 25px;
            }
        }
    </style>
@endpush