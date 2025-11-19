@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Projenizi Hayata Geçirelim');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Bugün Bizimle İletişime Geçin');
    $description = data_get($content, 'description.' . app()->getLocale(), 'Profesyonel ekibimiz, projenizi en iyi şekilde tamamlamak için hazır.');
    $backgroundImage = data_get($content, 'background_image') ? asset($content['background_image']) : null;
    $backgroundStyle = data_get($content, 'background_style', 'gradient'); // gradient, image, particles
    
    $primaryButton = [
        'text' => data_get($content, 'primary_button_text.' . app()->getLocale(), 'Hemen Başlayın'),
        'link' => data_get($content, 'primary_button_link', '#contact'),
        'icon' => data_get($content, 'primary_button_icon', 'fas fa-arrow-right')
    ];
    
    $secondaryButton = [
        'text' => data_get($content, 'secondary_button_text.' . app()->getLocale()),
        'link' => data_get($content, 'secondary_button_link', '#'),
        'icon' => data_get($content, 'secondary_button_icon', 'fas fa-phone')
    ];
    
    $features = data_get($content, 'features', []);
    if (empty($features)) {
        $features = [
            [
                'icon' => 'fas fa-check-circle',
                'text' => ['tr' => 'Ücretsiz Danışmanlık', 'en' => 'Free Consultation']
            ],
            [
                'icon' => 'fas fa-check-circle',
                'text' => ['tr' => '7/24 Destek', 'en' => '24/7 Support']
            ],
            [
                'icon' => 'fas fa-check-circle',
                'text' => ['tr' => 'Garantili Hizmet', 'en' => 'Guaranteed Service']
            ],
        ];
    }
@endphp

<section class="ctaban-section ctaban-section--{{ $backgroundStyle }}" @if($backgroundImage && $backgroundStyle === 'image') style="background-image: url('{{ $backgroundImage }}');" @endif>
    <div class="ctaban-overlay"></div>

    @if($backgroundStyle === 'particles')
        <div class="ctaban-particles">
            @for($i = 0; $i < 20; $i++)
                <div class="ctaban-particle" style="
                    left: {{ rand(0, 100) }}%;
                    top: {{ rand(0, 100) }}%;
                    width: {{ rand(4, 12) }}px;
                    height: {{ rand(4, 12) }}px;
                    animation-duration: {{ rand(20, 40) }}s;
                    animation-delay: {{ rand(0, 10) }}s;
                "></div>
            @endfor
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="ctaban-content">
                    <span class="ctaban-content__subtitle" data-aos="fade-up">{{ $sectionSubtitle }}</span>
                    <h2 class="ctaban-content__title" data-aos="fade-up" data-aos-delay="100">{{ $sectionTitle }}</h2>

                    @if($description)
                        <p class="ctaban-content__description" data-aos="fade-up" data-aos-delay="200">{{ $description }}</p>
                    @endif

                    @if(!empty($features))
                        <ul class="ctaban-features" data-aos="fade-up" data-aos-delay="300">
                            @foreach($features as $feature)
                                <li class="ctaban-features__item">
                                    <i class="{{ data_get($feature, 'icon', 'fas fa-check') }} ctaban-features__icon"></i>
                                    <span>{{ data_get($feature, 'text.' . app()->getLocale(), 'Feature') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="ctaban-buttons" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ $primaryButton['link'] }}" class="ctaban-btn ctaban-btn--primary">
                            <span>{{ $primaryButton['text'] }}</span>
                            <i class="{{ $primaryButton['icon'] }}"></i>
                        </a>

                        @if($secondaryButton['text'])
                            <a href="{{ $secondaryButton['link'] }}" class="ctaban-btn ctaban-btn--secondary">
                                <i class="{{ $secondaryButton['icon'] }}"></i>
                                <span>{{ $secondaryButton['text'] }}</span>
                            </a>
                        @endif
                    </div>

                    @if(data_get($content, 'contact_info.' . app()->getLocale()))
                        <div class="ctaban-contact" data-aos="fade-up" data-aos-delay="500">
                            <i class="fas fa-phone-alt"></i>
                            <span>{{ data_get($content, 'contact_info.' . app()->getLocale()) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="ctaban-shape ctaban-shape--1"></div>
    <div class="ctaban-shape ctaban-shape--2"></div>
    <div class="ctaban-shape ctaban-shape--3"></div>
</section>

@push('styles')
    <style>
        .ctaban-section {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .ctaban-section--gradient {
            background: var(--gradient-primary);
        }

        .ctaban-section--image {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .ctaban-section--particles {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-navy) 50%, var(--primary-blue) 100%);
        }

        .ctaban-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                    radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 50%, rgba(37, 99, 235, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .ctaban-section--image .ctaban-overlay {
            background: rgba(14, 19, 39, 0.85);
        }

        .ctaban-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .ctaban-particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: ctaban-float linear infinite;
        }

        @keyframes ctaban-float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .ctaban-section .container {
            position: relative;
            z-index: 2;
        }

        .ctaban-content {
            text-align: center;
        }

        .ctaban-content__subtitle {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 25px;
        }

        .ctaban-content__title {
            font-size: 54px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 25px;
            line-height: 1.2;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .ctaban-content__description {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.7;
            margin-bottom: 35px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .ctaban-features {
            list-style: none;
            padding: 0;
            margin: 0 0 45px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .ctaban-features__item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
        }

        .ctaban-features__icon {
            color: var(--success-color);
            font-size: 20px;
        }

        .ctaban-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .ctaban-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .ctaban-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .ctaban-btn:hover::before {
            left: 100%;
        }

        .ctaban-btn--primary {
            background: #ffffff;
            color: var(--primary-dark);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .ctaban-btn--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
            color: var(--primary-dark);
        }

        .ctaban-btn--secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .ctaban-btn--secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
            transform: translateY(-3px);
            color: #ffffff;
        }

        .ctaban-btn i {
            transition: transform 0.3s ease;
        }

        .ctaban-btn--primary:hover i {
            transform: translateX(5px);
        }

        .ctaban-contact {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            padding: 15px 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .ctaban-contact i {
            font-size: 20px;
        }

        .ctaban-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            z-index: 0;
        }

        .ctaban-shape--1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            top: -200px;
            left: -200px;
            animation: ctaban-rotate 30s linear infinite;
        }

        .ctaban-shape--2 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            bottom: -150px;
            right: -150px;
            animation: ctaban-rotate 40s linear infinite reverse;
        }

        .ctaban-shape--3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            top: 50%;
            right: 10%;
            animation: ctaban-pulse 5s ease-in-out infinite;
        }

        @keyframes ctaban-rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes ctaban-pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.2;
            }
        }

        @media (max-width: 992px) {
            .ctaban-section {
                padding: 100px 0;
            }

            .ctaban-content__title {
                font-size: 42px;
            }

            .ctaban-content__description {
                font-size: 18px;
            }
        }

        @media (max-width: 768px) {
            .ctaban-section {
                padding: 80px 0;
            }

            .ctaban-content__title {
                font-size: 32px;
            }

            .ctaban-content__description {
                font-size: 16px;
            }

            .ctaban-features {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .ctaban-buttons {
                flex-direction: column;
            }

            .ctaban-btn {
                width: 100%;
                justify-content: center;
            }

            .ctaban-contact {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
@endpush