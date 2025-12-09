@php
    $title = data_get($content, 'title.' . app()->getLocale(), 'Çalışma Prensibimiz');
    $description = data_get($content, 'description.' . app()->getLocale(), '');

    $processSteps = data_get($content, 'process_steps', []);
    if (is_string($processSteps)) {
        $processSteps = json_decode($processSteps, true) ?? [];
    }

    // Varsayılan adımlar
    if (empty($processSteps)) {
        $processSteps = [
            [
                'step_number' => '01',
                'step_title' => ['tr' => 'Planlama', 'en' => 'Planning'],
                'step_description' => ['tr' => 'Projenizi detaylı bir şekilde analiz eder ve en uygun çözümü sunarız.', 'en' => 'We analyze your project in detail and offer the most suitable solution.'],
                'step_icon' => 'fas fa-clipboard-list'
            ],
            [
                'step_number' => '02',
                'step_title' => ['tr' => 'Tasarım', 'en' => 'Design'],
                'step_description' => ['tr' => 'İhtiyaçlarınıza özel tasarım çözümleri geliştiririz.', 'en' => 'We develop custom design solutions for your needs.'],
                'step_icon' => 'fas fa-pencil-ruler'
            ],
            [
                'step_number' => '03',
                'step_title' => ['tr' => 'Uygulama', 'en' => 'Implementation'],
                'step_description' => ['tr' => 'Uzman ekibimizle projenizi zamanında ve kaliteli bir şekilde hayata geçiririz.', 'en' => 'We implement your project on time and with quality with our expert team.'],
                'step_icon' => 'fas fa-tools'
            ],
            [
                'step_number' => '04',
                'step_title' => ['tr' => 'Teslim', 'en' => 'Delivery'],
                'step_description' => ['tr' => 'Projenizi eksiksiz teslim eder ve sonrası için destek sağlarız.', 'en' => 'We deliver your project completely and provide support afterwards.'],
                'step_icon' => 'fas fa-check-circle'
            ],
        ];
    }
@endphp

<section id="work-principle" class="content-section work-process-content">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">{{ $title }}</h2>
                @if($description)
                    <p class="section-description">{!! $description !!}</p>
                @endif
            </div>
        </div>

        <div class="row process-timeline">
            @foreach($processSteps as $index => $step)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step">
                        <div class="step-number">{{ data_get($step, 'step_number', str_pad($index + 1, 2, '0', STR_PAD_LEFT)) }}</div>

                        @if(data_get($step, 'step_icon'))
                            <div class="step-icon">
                                <i class="{{ data_get($step, 'step_icon') }}"></i>
                            </div>
                        @endif

                        <h4 class="step-title">{{ data_get($step, 'step_title.' . app()->getLocale()) }}</h4>
                        <p class="step-description">{!! data_get($step, 'step_description.' . app()->getLocale()) !!}</p>

                        @if($index < count($processSteps) - 1)
                            <div class="step-arrow">
                                <i class="fas fa-arrow-right"></i>
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
        .work-process-content {
            background: #fff;
            position: relative;
        }

        .work-process-content::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            transform: translateY(-50%);
            z-index: 0;
        }

        .process-timeline {
            position: relative;
            z-index: 1;
        }

        .process-step {
            text-align: center;
            position: relative;
            padding: 30px 20px;
            background: #f8f8f8;
            border-radius: 15px;
            transition: all 0.4s ease;
            height: 100%;
        }

        .process-step:hover {
            background: #fff;
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .step-number {
            font-size: 3rem;
            font-weight: 800;
            color: #16213e;
            line-height: 1;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .process-step:hover .step-number {
            opacity: 1;
        }

        .step-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.4s ease;
        }

        .process-step:hover .step-icon {
            transform: rotate(360deg) scale(1.1);
        }

        .step-icon i {
            font-size: 2rem;
            color: #fff;
        }

        .step-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .step-description {
            color: #666;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .step-arrow {
            position: absolute;
            right: -30px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            color: #16213e;
            opacity: 0.3;
        }

        .process-step:hover .step-arrow {
            animation: arrowMove 1s ease-in-out infinite;
        }

        @keyframes arrowMove {
            0%, 100% {
                transform: translateY(-50%) translateX(0);
            }
            50% {
                transform: translateY(-50%) translateX(10px);
            }
        }

        @media (max-width: 992px) {
            .work-process-content::before {
                display: none;
            }

            .step-arrow {
                display: none;
            }
        }
    </style>
@endpush
