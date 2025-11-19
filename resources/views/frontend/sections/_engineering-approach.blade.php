@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $description = data_get($content, 'description.' . app()->getLocale(), '');
    $steps = data_get($content, 'steps', []);
@endphp

<section class="izokoc-engineering-approach">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @if($subTitle)
                    <h6 class="izokoc-section__subtitle">{{ $subTitle }}</h6>
                @endif
                @if($mainTitle)
                    <h2 class="izokoc-section__title">{{ $mainTitle }}</h2>
                @endif
                @if($description)
                    <p class="izokoc-section__description">{!! $description !!}</p>
                @endif
                <br>
            </div>
        </div>

        @if(!empty($steps))
            <div class="row">
                <div class="col-lg-12">
                    <div class="izokoc-process-timeline">
                        @foreach($steps as $index => $step)
                            @php
                                $stepNumber = data_get($step, 'step_number', $index + 1);
                                $stepIcon = data_get($step, 'step_icon', 'icofont-gear');
                                $stepTitle = data_get($step, 'step_title.' . app()->getLocale(), '');
                                $stepDescription = data_get($step, 'step_description.' . app()->getLocale(), '');
                            @endphp

                            <div class="izokoc-process-step" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="izokoc-process-step__number">{{ $stepNumber }}</div>
                                <div class="izokoc-process-step__icon">
                                    <i class="{{ $stepIcon }}"></i>
                                </div>
                                <div class="izokoc-process-step__content">
                                    <h4 class="izokoc-process-step__title">{{ $stepTitle }}</h4>
                                    <p class="izokoc-process-step__description">{!! $stepDescription !!}</p>
                                </div>
                                @if(!$loop->last)
                                    <div class="izokoc-process-step__connector"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .izokoc-engineering-approach {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .izokoc-section__subtitle {
            color: #1a237e;
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
            margin-bottom: 20px;
        }

        .izokoc-section__description {
            font-size: 18px;
            color: #666;
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .izokoc-process-timeline {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: center;
            position: relative;
        }

        .izokoc-process-step {
            position: relative;
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            width: calc(33.333% - 27px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .izokoc-process-step:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .izokoc-process-step__number {
            position: absolute;
            top: -20px;
            left: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--izokoc-primary), var(--izokoc-blue));
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }

        .izokoc-process-step__icon {
            font-size: 48px;
            color: #1a237e;
            margin-bottom: 20px;
        }

        .izokoc-process-step__title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .izokoc-process-step__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        .izokoc-process-step__connector {
            display: none;
        }

        @media (max-width: 992px) {
            .izokoc-process-step {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .izokoc-engineering-approach {
                padding: 60px 0;
            }

            .izokoc-section__title {
                font-size: 32px;
            }

            .izokoc-process-step {
                width: 100%;
            }
        }
    </style>
@endpush