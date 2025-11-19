@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionDescription = data_get($content, 'section_description.' . app()->getLocale(), '');
    $mainImage = data_get($content, 'main_image') ? asset($content['main_image']) : 'https://placehold.co/600x700';
    $valueBenefits = data_get($content, 'value_benefits', []);
    
    if (empty($valueBenefits)) {
        $valueBenefits = [
            ['icon' => 'fas fa-trophy', 'title' => ['tr' => 'Prestij Kazanın'], 'description' => ['tr' => 'Marka kimliğinize özel, ödüllü tasarımlar'], 'color' => 'blue'],
            ['icon' => 'fas fa-rocket', 'title' => ['tr' => 'Hız Kazanın'], 'description' => ['tr' => 'Işık hızında açılan, yüksek performanslı siteler'], 'color' => 'green'],
            ['icon' => 'fas fa-users', 'title' => ['tr' => 'Müşteri Kazanın'], 'description' => ['tr' => 'SEO uyumlu altyapı ile Google\'da bulunun'], 'color' => 'purple'],
            ['icon' => 'fas fa-sliders-h', 'title' => ['tr' => 'Kontrol Kazanın'], 'description' => ['tr' => 'Size özel kolay yönetim paneli ile anında güncelleme'], 'color' => 'orange'],
        ];
    }

    $colorMap = [
        'blue' => ['from' => '#3b82f6', 'to' => '#2563eb', 'bg' => '#eff6ff'],
        'green' => ['from' => '#10b981', 'to' => '#059669', 'bg' => '#f0fdf4'],
        'purple' => ['from' => '#8b5cf6', 'to' => '#7c3aed', 'bg' => '#f5f3ff'],
        'orange' => ['from' => '#f59e0b', 'to' => '#d97706', 'bg' => '#fffbeb'],
    ];
@endphp

<section id="solution" class="nextmedya-value-proposition">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="nextmedya-value-image-wrapper">
                    <div class="nextmedya-value-image-bg"></div>
                    <img src="{{ $mainImage }}" alt="Next Medya Farkı" class="nextmedya-value-image">
                    <div class="nextmedya-value-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>%100 Müşteri Memnuniyeti</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="nextmedya-value-content">
                    <h2 class="nextmedya-value-title">{{ $sectionTitle }}</h2>
                    @if($sectionDescription)
                        <p class="nextmedya-value-description">{!! $sectionDescription !!}</p>
                    @endif

                    <div class="nextmedya-benefits-list">
                        @foreach($valueBenefits as $index => $benefit)
                            @php
                                $color = data_get($benefit, 'color', 'blue');
                                $colors = $colorMap[$color];
                            @endphp
                            <div class="nextmedya-benefit-item nextmedya-benefit-{{ $color }}"
                                 data-aos="fade-up"
                                 data-aos-delay="{{ ($index + 1) * 100 }}">
                                <div class="nextmedya-benefit-icon" style="background: {{ $colors['bg'] }};">
                                    <i class="{{ data_get($benefit, 'icon', 'fas fa-check') }}"
                                       style="background: linear-gradient(135deg, {{ $colors['from'] }} 0%, {{ $colors['to'] }} 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                                </div>
                                <div class="nextmedya-benefit-content">
                                    <h4 class="nextmedya-benefit-title">{{ data_get($benefit, 'title.' . app()->getLocale()) }}</h4>
                                    <p class="nextmedya-benefit-description">{!! data_get($benefit, 'description.' . app()->getLocale())  !!}</p>
                                </div>
                                <div class="nextmedya-benefit-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-value-proposition {
            padding: 100px 0;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
        }

        .nextmedya-value-proposition::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .nextmedya-value-image-wrapper {
            position: relative;
            padding: 40px 40px 40px 0;
        }

        .nextmedya-value-image-bg {
            position: absolute;
            top: 0;
            left: -40px;
            width: calc(100% + 40px);
            height: 100%;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 30px;
            z-index: 1;
        }

        .nextmedya-value-image {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
        }

        .nextmedya-value-badge {
            position: absolute;
            bottom: 60px;
            left: -20px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 50px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 3;
            animation: floatBadge 3s ease-in-out infinite;
        }

        .nextmedya-value-badge i {
            font-size: 1.75rem;
            color: #10b981;
        }

        .nextmedya-value-badge span {
            font-weight: 700;
            color: #1e293b;
            font-size: 1rem;
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .nextmedya-value-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #1e293b;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .nextmedya-value-description {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .nextmedya-benefits-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .nextmedya-benefit-item {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .nextmedya-benefit-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background: linear-gradient(180deg, #3b82f6, #2563eb);
            transition: height 0.4s ease;
        }

        .nextmedya-benefit-item:hover::before {
            height: 100%;
        }

        .nextmedya-benefit-item:hover {
            transform: translateX(10px);
            border-color: transparent;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .nextmedya-benefit-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.4s ease;
        }

        .nextmedya-benefit-icon i {
            font-size: 2rem;
        }

        .nextmedya-benefit-item:hover .nextmedya-benefit-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .nextmedya-benefit-content {
            flex: 1;
        }

        .nextmedya-benefit-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .nextmedya-benefit-description {
            font-size: 0.95rem;
            color: #64748b;
            margin: 0;
            line-height: 1.6;
        }

        .nextmedya-benefit-arrow {
            width: 40px;
            height: 40px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .nextmedya-benefit-arrow i {
            color: #3b82f6;
            font-size: 1.125rem;
        }

        .nextmedya-benefit-item:hover .nextmedya-benefit-arrow {
            opacity: 1;
            transform: translateX(5px);
        }

        @media (max-width: 992px) {
            .nextmedya-value-proposition {
                padding: 60px 0;
            }

            .nextmedya-value-image-wrapper {
                margin-bottom: 60px;
                padding: 20px 20px 20px 0;
            }

            .nextmedya-value-badge {
                bottom: 40px;
                left: 10px;
                padding: 15px 20px;
            }

            .nextmedya-benefit-item {
                padding: 20px;
            }

            .nextmedya-benefit-icon {
                width: 60px;
                height: 60px;
            }

            .nextmedya-benefit-icon i {
                font-size: 1.75rem;
            }
        }
    </style>
@endpush