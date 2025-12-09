@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionDescription = data_get($content, 'section_description.' . app()->getLocale(), '');
    $comparisonImage = data_get($content, 'comparison_image') ? asset($content['comparison_image']) : 'https://placehold.co/600x600';
    $differentiators = data_get($content, 'differentiators', []);
    $stats = data_get($content, 'stats', []);
    
    if (empty($differentiators)) {
        $differentiators = [
            ['icon' => 'fas fa-code', 'title' => ['tr' => 'Size Özel Altyapı'], 'description' => ['tr' => 'Hazır temalarla değil, size özel geliştirdiğimiz güvenli ve hızlı yazılım altyapısıyla çalışıyoruz.'], 'highlight' => true],
            ['icon' => 'fas fa-sync', 'title' => ['tr' => '360 Derece Hizmet'], 'description' => ['tr' => 'Sitenizi yapıp bırakmıyoruz. SEO, içerik ve teknik destekle yanınızdayız.'], 'highlight' => false],
            ['icon' => 'fas fa-award', 'title' => ['tr' => 'Tecrübeli Ekip'], 'description' => ['tr' => '10+ yıllık tecrübe, 100+ tamamlanan proje.'], 'highlight' => false],
            ['icon' => 'fas fa-handshake', 'title' => ['tr' => 'Güvenilir İş Ortağı'], 'description' => ['tr' => 'Kurumsal yapı, net sözleşme, şeffaf süreç.'], 'highlight' => false],
        ];
    }
    
    if (empty($stats)) {
        $stats = [
            ['number' => '10', 'suffix' => '+', 'label' => ['tr' => 'Yıllık Tecrübe'], 'icon' => 'fas fa-calendar-alt'],
            ['number' => '100', 'suffix' => '+', 'label' => ['tr' => 'Tamamlanan Proje'], 'icon' => 'fas fa-rocket'],
            ['number' => '98', 'suffix' => '%', 'label' => ['tr' => 'Müşteri Memnuniyeti'], 'icon' => 'fas fa-smile'],
            ['number' => '24', 'suffix' => '/7', 'label' => ['tr' => 'Teknik Destek'], 'icon' => 'fas fa-headset'],
        ];
    }
@endphp

<section class="nextmedya-why-choose-us">
    <div class="nextmedya-why-bg-pattern"></div>

    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <div class="nextmedya-section-header">
                    <h2 class="nextmedya-section-title">{{ $sectionTitle }}</h2>
                    @if($sectionDescription)
                        <p class="nextmedya-section-description">{!! $sectionDescription !!}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats -->
        @if(!empty($stats))
            <div class="row nextmedya-stats-row" data-aos="fade-up" data-aos-delay="100">
                @foreach($stats as $stat)
                    <div class="col-lg-3 col-md-6">
                        <div class="nextmedya-stat-card">
                            <div class="nextmedya-stat-icon">
                                <i class="{{ data_get($stat, 'icon', 'fas fa-chart-line') }}"></i>
                            </div>
                            <div class="nextmedya-stat-content">
                                <div class="nextmedya-stat-number">
                                    <span class="counter" data-count="{{ data_get($stat, 'number', '0') }}">0</span>{{ data_get($stat, 'suffix', '') }}
                                </div>
                                <div class="nextmedya-stat-label">{{ data_get($stat, 'label.' . app()->getLocale()) }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Main Content -->
        <div class="row align-items-center nextmedya-why-main">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="nextmedya-why-image-wrapper">
                    <div class="nextmedya-why-image-border"></div>
                    <img src="{{ $comparisonImage }}" alt="Next Medya Farkı" class="nextmedya-why-image">
                    <div class="nextmedya-certified-badge">
                        <i class="fas fa-certificate"></i>
                        <span>Sertifikalı Ekip</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="nextmedya-differentiators-list">
                    @foreach($differentiators as $index => $diff)
                        @php
                            $isHighlight = data_get($diff, 'highlight', false);
                        @endphp
                        <div class="nextmedya-diff-item {{ $isHighlight ? 'highlight' : '' }}"
                             data-aos="fade-up"
                             data-aos-delay="{{ ($index + 3) * 100 }}">
                            @if($isHighlight)
                                <div class="nextmedya-diff-badge">
                                    <i class="fas fa-star"></i>
                                </div>
                            @endif
                            <div class="nextmedya-diff-icon-wrapper">
                                <div class="nextmedya-diff-icon">
                                    <i class="{{ data_get($diff, 'icon', 'fas fa-check') }}"></i>
                                </div>
                            </div>
                            <div class="nextmedya-diff-content">
                                <h4 class="nextmedya-diff-title">{{ data_get($diff, 'title.' . app()->getLocale()) }}</h4>
                                <p class="nextmedya-diff-description">{!! data_get($diff, 'description.' . app()->getLocale()) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-why-choose-us {
            padding: 100px 0;
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .nextmedya-why-bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                    linear-gradient(30deg, #f1f5f9 12%, transparent 12.5%, transparent 87%, #f1f5f9 87.5%, #f1f5f9),
                    linear-gradient(150deg, #f1f5f9 12%, transparent 12.5%, transparent 87%, #f1f5f9 87.5%, #f1f5f9),
                    linear-gradient(30deg, #f1f5f9 12%, transparent 12.5%, transparent 87%, #f1f5f9 87.5%, #f1f5f9),
                    linear-gradient(150deg, #f1f5f9 12%, transparent 12.5%, transparent 87%, #f1f5f9 87.5%, #f1f5f9);
            background-size: 80px 140px;
            background-position: 0 0, 0 0, 40px 70px, 40px 70px;
            opacity: 0.3;
            pointer-events: none;
        }

        .nextmedya-stats-row {
            margin-bottom: 80px;
        }

        .nextmedya-stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #f1f5f9;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.4s ease;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .nextmedya-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transition: width 0.4s ease;
        }

        .nextmedya-stat-card:hover::before {
            width: 100%;
        }

        .nextmedya-stat-card:hover {
            transform: translateY(-10px);
            border-color: #3b82f6;
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
        }

        .nextmedya-stat-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.4s ease;
        }

        .nextmedya-stat-icon i {
            font-size: 2rem;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nextmedya-stat-card:hover .nextmedya-stat-icon {
            transform: scale(1.1) rotate(360deg);
        }

        .nextmedya-stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 12px;
        }

        .nextmedya-stat-label {
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 600;
        }

        .nextmedya-why-main {
            margin-top: 60px;
        }

        .nextmedya-why-image-wrapper {
            position: relative;
            padding: 30px;
        }

        .nextmedya-why-image-border {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 30px;
            transform: translate(20px, 20px);
            z-index: 1;
        }

        .nextmedya-why-image {
            width: 100%;
            border-radius: 30px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
        }

        .nextmedya-certified-badge {
            position: absolute;
            bottom: 50px;
            right: 50px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 50px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 3;
            animation: pulse 3s infinite;
        }

        .nextmedya-certified-badge i {
            font-size: 1.75rem;
            color: #fbbf24;
        }

        .nextmedya-certified-badge span {
            font-weight: 700;
            color: #1e293b;
        }

        .nextmedya-differentiators-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .nextmedya-diff-item {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 20px;
            padding: 30px;
            display: flex;
            gap: 20px;
            transition: all 0.4s ease;
            position: relative;
        }

        .nextmedya-diff-item:hover {
            transform: translateX(10px);
            border-color: #3b82f6;
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.15);
        }

        .nextmedya-diff-item.highlight {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-color: #3b82f6;
            border-width: 3px;
        }

        .nextmedya-diff-badge {
            position: absolute;
            top: -15px;
            right: 30px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(251, 191, 36, 0.4);
        }

        .nextmedya-diff-badge i {
            color: #ffffff;
            font-size: 1.125rem;
        }

        .nextmedya-diff-icon-wrapper {
            flex-shrink: 0;
        }

        .nextmedya-diff-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
        }

        .nextmedya-diff-icon i {
            font-size: 2rem;
            color: #3b82f6;
        }

        .nextmedya-diff-item:hover .nextmedya-diff-icon {
            transform: scale(1.1) rotate(10deg);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .nextmedya-diff-item:hover .nextmedya-diff-icon i {
            color: #ffffff;
        }

        .nextmedya-diff-title {
            font-size: 1.375rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .nextmedya-diff-description {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 992px) {
            .nextmedya-why-choose-us {
                padding: 60px 0;
            }

            .nextmedya-why-image-wrapper {
                margin-bottom: 60px;
            }

            .nextmedya-stat-number {
                font-size: 2.5rem;
            }

            .nextmedya-certified-badge {
                bottom: 30px;
                right: 30px;
                padding: 15px 20px;
            }

            .nextmedya-diff-item {
                padding: 20px;
            }

            .nextmedya-diff-icon {
                width: 60px;
                height: 60px;
            }

            .nextmedya-diff-icon i {
                font-size: 1.75rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-count');
                let count = 0;
                const increment = target / speed;

                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        counter.innerText = Math.ceil(count);
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endpush