@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Sizi 4 Adımda Dijital Dünyaya Taşıyoruz');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $ctaText = data_get($content, 'cta_text.' . app()->getLocale(), 'Hemen Başlayalım');
    $ctaUrl = data_get($content, 'cta_url', '#contact');
    $processSteps = data_get($content, 'process_steps', []);
    
    if (empty($processSteps)) {
        $processSteps = [
            [
                'step_number' => '01',
                'step_icon' => 'fas fa-search',
                'step_title' => ['tr' => 'Analiz & Strateji'],
                'step_description' => ['tr' => 'İhtiyaçlarınızı dinliyor, hedef kitlenizi analiz ediyor ve size özel dijital strateji oluşturuyoruz.'],
                'step_duration' => ['tr' => '3-5 Gün'],
                'step_features' => [
                    ['feature_text' => ['tr' => 'İhtiyaç Analizi']],
                    ['feature_text' => ['tr' => 'Rakip Analizi']],
                    ['feature_text' => ['tr' => 'Hedef Kitle Belirleme']],
                    ['feature_text' => ['tr' => 'Proje Yol Haritası']],
                ]
            ],
            [
                'step_number' => '02',
                'step_icon' => 'fas fa-pencil-ruler',
                'step_title' => ['tr' => 'Tasarım & Onay'],
                'step_description' => ['tr' => 'Markanıza özel, modern ve kullanıcı dostu arayüz tasarımları hazırlıyor ve onayınıza sunuyoruz.'],
                'step_duration' => ['tr' => '7-10 Gün'],
                'step_features' => [
                    ['feature_text' => ['tr' => 'UX/UI Tasarım']],
                    ['feature_text' => ['tr' => 'Mobil Uyumlu Mockup']],
                    ['feature_text' => ['tr' => 'Renk & Tipografi']],
                    ['feature_text' => ['tr' => 'Revizyon Hakkı']],
                ]
            ],
            [
                'step_number' => '03',
                'step_icon' => 'fas fa-code',
                'step_title' => ['tr' => 'Yazılım & Test'],
                'step_description' => ['tr' => 'Onaylanan tasarımı en güncel teknolojilerle kodluyor ve tüm cihazlarda test ediyoruz.'],
                'step_duration' => ['tr' => '10-15 Gün'],
                'step_features' => [
                    ['feature_text' => ['tr' => 'Temiz Kod Yapısı']],
                    ['feature_text' => ['tr' => 'Hız Optimizasyonu']],
                    ['feature_text' => ['tr' => 'SEO Altyapısı']],
                    ['feature_text' => ['tr' => 'Güvenlik Testleri']],
                ]
            ],
            [
                'step_number' => '04',
                'step_icon' => 'fas fa-rocket',
                'step_title' => ['tr' => 'Yayın & Destek'],
                'step_description' => ['tr' => 'Sitenizi yayına alıyor, yönetim panelini eğitiyoruz ve sürekli destek sağlıyoruz.'],
                'step_duration' => ['tr' => '2-3 Gün'],
                'step_features' => [
                    ['feature_text' => ['tr' => 'Domain & Hosting']],
                    ['feature_text' => ['tr' => 'Admin Panel Eğitimi']],
                    ['feature_text' => ['tr' => 'Google Analytics']],
                    ['feature_text' => ['tr' => '6 Ay Ücretsiz Destek']],
                ]
            ],
        ];
    }
@endphp

<section class="nextmedya-process-section">
    <div class="nextmedya-process-bg"></div>

    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <div class="nextmedya-section-header">
                    @if($sectionSubtitle)
                        <span class="nextmedya-section-badge">{{ $sectionSubtitle }}</span>
                    @endif
                    <h2 class="nextmedya-section-title">{{ $sectionTitle }}</h2>
                </div>
            </div>
        </div>

        <!-- Process Steps -->
        <div class="nextmedya-process-timeline">
            @foreach($processSteps as $index => $step)
                @php
                    $stepNumber = data_get($step, 'step_number', '0' . ($index + 1));
                    $stepIcon = data_get($step, 'step_icon', 'fas fa-check');
                    $stepTitle = data_get($step, 'step_title.' . app()->getLocale());
                    $stepDescription = data_get($step, 'step_description.' . app()->getLocale());
                    $stepDuration = data_get($step, 'step_duration.' . app()->getLocale());
                    $stepFeatures = data_get($step, 'step_features', []);
                @endphp

                <div class="nextmedya-process-step" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                    <div class="nextmedya-step-line"></div>

                    <div class="nextmedya-step-number-wrapper">
                        <div class="nextmedya-step-number">{{ $stepNumber }}</div>
                        <div class="nextmedya-step-icon-circle">
                            <i class="{{ $stepIcon }}"></i>
                        </div>
                    </div>

                    <div class="nextmedya-step-card">
                        <div class="nextmedya-step-header">
                            <h3 class="nextmedya-step-title">{{ $stepTitle }}</h3>
                            @if($stepDuration)
                                <span class="nextmedya-step-duration">
                                    <i class="fas fa-clock"></i> {{ $stepDuration }}
                                </span>
                            @endif
                        </div>

                        <p class="nextmedya-step-description">{!! $stepDescription !!}</p>

                        @if(!empty($stepFeatures))
                            <div class="nextmedya-step-features">
                                @foreach($stepFeatures as $feature)
                                    <div class="nextmedya-step-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ data_get($feature, 'feature_text.' . app()->getLocale()) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="nextmedya-step-badge">Adım {{ $index + 1 }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA -->
        <div class="row" data-aos="fade-up" data-aos-delay="600">
            <div class="col-lg-12 text-center">
                <div class="nextmedya-process-cta">
                    <h3 class="nextmedya-cta-title">Projenize Bugün Başlayalım!</h3>
                    <p class="nextmedya-cta-subtitle">Ücretsiz danışmanlık için hemen iletişime geçin</p>
                    <a href="{{ $ctaUrl }}" class="nextmedya-btn nextmedya-btn-primary nextmedya-btn-lg">
                        {{ $ctaText }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-process-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            position: relative;
            overflow: hidden;
        }

        .nextmedya-process-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                    radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .nextmedya-section-badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .nextmedya-process-section .nextmedya-section-title {
            color: #ffffff;
            margin-bottom: 80px;
        }

        .nextmedya-process-timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto 80px;
        }

        .nextmedya-process-step {
            position: relative;
            margin-bottom: 60px;
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 40px;
            align-items: start;
        }

        .nextmedya-step-line {
            position: absolute;
            left: 60px;
            top: 100px;
            width: 2px;
            height: calc(100% + 60px);
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            opacity: 0.3;
        }

        .nextmedya-process-step:last-child .nextmedya-step-line {
            display: none;
        }

        .nextmedya-step-number-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            position: relative;
            z-index: 2;
        }

        .nextmedya-step-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .nextmedya-step-icon-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
            transition: all 0.4s ease;
        }

        .nextmedya-process-step:hover .nextmedya-step-icon-circle {
            transform: scale(1.1) rotate(360deg);
        }

        .nextmedya-step-icon-circle i {
            font-size: 2rem;
            color: #ffffff;
        }

        .nextmedya-step-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .nextmedya-step-card p {
            color: #fff;
        }

        .nextmedya-step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .nextmedya-process-step:hover .nextmedya-step-card::before {
            transform: scaleX(1);
        }

        .nextmedya-process-step:hover .nextmedya-step-card {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(10px);
        }

        .nextmedya-step-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .nextmedya-step-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .nextmedya-step-duration {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nextmedya-step-description {
            font-size: 1rem;
            color: #cbd5e1;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .nextmedya-step-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .nextmedya-step-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #e2e8f0;
            font-size: 0.95rem;
        }

        .nextmedya-step-feature i {
            color: #10b981;
            font-size: 1rem;
        }

        .nextmedya-step-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(139, 92, 246, 0.2);
            color: #a78bfa;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nextmedya-process-cta {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 30px;
            padding: 60px 40px;
            text-align: center;
        }

        .nextmedya-cta-title {
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .nextmedya-cta-subtitle {
            font-size: 1.125rem;
            color: #cbd5e1;
            margin-bottom: 30px;
        }

        .nextmedya-btn-lg {
            padding: 18px 40px;
            font-size: 1.125rem;
        }

        @media (max-width: 992px) {
            .nextmedya-process-section {
                padding: 60px 0;
            }

            .nextmedya-process-step {
                grid-template-columns: 80px 1fr;
                gap: 20px;
            }

            .nextmedya-step-line {
                left: 40px;
            }

            .nextmedya-step-number {
                font-size: 2rem;
            }

            .nextmedya-step-icon-circle {
                width: 60px;
                height: 60px;
            }

            .nextmedya-step-icon-circle i {
                font-size: 1.5rem;
            }

            .nextmedya-step-card {
                padding: 30px 20px;
            }

            .nextmedya-step-title {
                font-size: 1.5rem;
            }

            .nextmedya-step-features {
                grid-template-columns: 1fr;
            }

            .nextmedya-cta-title {
                font-size: 1.5rem;
            }

            .nextmedya-process-cta {
                padding: 40px 20px;
            }
        }
    </style>
@endpush