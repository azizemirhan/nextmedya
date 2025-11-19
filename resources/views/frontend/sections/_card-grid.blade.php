@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Hizmetlerimiz');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Kaliteli ve Profesyonel Çözümler');
    $cards = data_get($content, 'cards', []);

    // Varsayılan kartlar
    if (empty($cards)) {
        $cards = [
            [
                'icon' => 'fas fa-rocket',
                'title' => ['tr' => 'İnovasyon', 'en' => 'Innovation'],
                'description' => ['tr' => 'En son teknolojilerle geleceği inşa ediyoruz', 'en' => 'Building the future with latest technologies'],
            ],
            [
                'icon' => 'fas fa-shield-alt',
                'title' => ['tr' => 'Güvenlik', 'en' => 'Security'],
                'description' => ['tr' => 'Verileriniz bizim için en önemli önceliktir', 'en' => 'Your data is our top priority'],
            ],
            [
                'icon' => 'fas fa-cogs',
                'title' => ['tr' => 'Özelleştirme', 'en' => 'Customization'],
                'description' => ['tr' => 'İhtiyaçlarınıza özel çözümler sunuyoruz', 'en' => 'We offer tailored solutions for your needs'],
            ],
            [
                'icon' => 'fas fa-headset',
                'title' => ['tr' => '7/24 Destek', 'en' => '24/7 Support'],
                'description' => ['tr' => 'Her zaman yanınızdayız', 'en' => 'We are always here for you'],
            ],
        ];
    }
@endphp

<section class="cgrid-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cgrid-header">
                    <span class="cgrid-header__subtitle">{{ $sectionSubtitle }}</span>
                    <h2 class="cgrid-header__title">{{ $sectionTitle }}</h2>
                </div>
            </div>
        </div>

        <div class="row cgrid-row">
            @foreach($cards as $index => $card)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cgrid-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="cgrid-card__icon-wrapper">
                            <i class="{{ data_get($card, 'icon', 'fas fa-star') }} cgrid-card__icon"></i>
                        </div>
                        <h3 class="cgrid-card__title">{{ data_get($card, 'title.' . app()->getLocale(), 'Card Title') }}</h3>
                        <p class="cgrid-card__description">{!! data_get($card, 'description.' . app()->getLocale(), 'Card description') !!}</p>
                        <div class="cgrid-card__overlay"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
    <style>
        .cgrid-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .cgrid-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: cgrid-float 20s ease-in-out infinite;
        }

        @keyframes cgrid-float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-50px, 50px); }
        }

        .cgrid-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .cgrid-header__subtitle {
            display: inline-block;
            background: var(--gradient-primary);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .cgrid-header__title {
            font-size: 42px;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            line-height: 1.2;
        }

        .cgrid-row {
            position: relative;
            z-index: 1;
        }

        .cgrid-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            box-shadow: var(--shadow-sm);
        }

        .cgrid-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .cgrid-card:hover::before {
            transform: scaleX(1);
        }

        .cgrid-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-sky);
        }

        .cgrid-card__icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-sky));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            position: relative;
            transition: all 0.4s ease;
        }

        .cgrid-card:hover .cgrid-card__icon-wrapper {
            transform: rotate(10deg) scale(1.1);
            box-shadow: var(--shadow-glow);
        }

        .cgrid-card__icon {
            font-size: 36px;
            color: #ffffff;
        }

        .cgrid-card__title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .cgrid-card:hover .cgrid-card__title {
            color: var(--primary-blue);
        }

        .cgrid-card__description {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.7;
            margin: 0;
        }

        .cgrid-card__overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: var(--gradient-primary);
            opacity: 0.03;
            transition: height 0.4s ease;
        }

        .cgrid-card:hover .cgrid-card__overlay {
            height: 100%;
        }

        @media (max-width: 992px) {
            .cgrid-section {
                padding: 80px 0;
            }

            .cgrid-header__title {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .cgrid-section {
                padding: 60px 0;
            }

            .cgrid-header__title {
                font-size: 28px;
            }

            .cgrid-card {
                padding: 30px 25px;
            }
        }
    </style>
@endpush