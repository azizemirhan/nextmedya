@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $description = data_get($content, 'description.' . app()->getLocale(), '');
    $mainImage = data_get($content, 'main_image');
    $videoUrl = data_get($content, 'video_url');
    $sustainabilityFeatures = data_get($content, 'sustainability_features', []);
    $greenInitiatives = data_get($content, 'green_initiatives', []);
@endphp

<section class="izokoc-sustainability-section">
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
                    <p class="izokoc-section__description">{{ $description }}</p>
                @endif
            </div>
        </div>

        {{-- Hero Image/Video --}}
        @if($mainImage || $videoUrl)
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div class="izokoc-sustainability-hero">
                        @if($mainImage)
                            <img src="{{ asset($mainImage) }}" alt="{{ $mainTitle }}">
                        @endif
                        @if($videoUrl)
                            <a href="{{ $videoUrl }}" class="izokoc-video-play-btn" data-fancybox>
                                <i class="icofont-ui-play"></i>
                            </a>
                        @endif
                        <div class="izokoc-sustainability-hero__overlay"></div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Sustainability Features (İstatistikler) --}}
        @if(!empty($sustainabilityFeatures))
            <div class="row">
                <div class="col-lg-12">
                    <div class="izokoc-stats-grid">
                        @foreach($sustainabilityFeatures as $index => $feature)
                            @php
                                $featureIcon = data_get($feature, 'feature_icon', 'icofont-leaf');
                                $featureTitle = data_get($feature, 'feature_title.' . app()->getLocale(), '');
                                $featureValue = data_get($feature, 'feature_value.' . app()->getLocale(), '');
                                $featureDescription = data_get($feature, 'feature_description.' . app()->getLocale(), '');
                            @endphp

                            <div class="izokoc-stat-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="izokoc-stat-card__icon">
                                    <i class="{{ $featureIcon }}"></i>
                                </div>
                                <div class="izokoc-stat-card__value">{{ $featureValue }}</div>
                                <h5 class="izokoc-stat-card__title">{{ $featureTitle }}</h5>
                                <p class="izokoc-stat-card__description">{!! $featureDescription !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Green Initiatives --}}
        @if(!empty($greenInitiatives))
            <div class="row" style="margin-top: 80px;">
                @foreach($greenInitiatives as $index => $initiative)
                    @php
                        $initiativeIcon = data_get($initiative, 'initiative_icon', 'icofont-recycle-alt');
                        $initiativeTitle = data_get($initiative, 'initiative_title.' . app()->getLocale(), '');
                        $initiativeDescription = data_get($initiative, 'initiative_description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="izokoc-green-card">
                            <div class="izokoc-green-card__icon">
                                <i class="{{ $initiativeIcon }}"></i>
                            </div>
                            <h5 class="izokoc-green-card__title">{{ $initiativeTitle }}</h5>
                            <p class="izokoc-green-card__description">{!! $initiativeDescription !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .izokoc-sustainability-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f0f9f4 0%, #e8f5e9 100%);
            position: relative;
            overflow: hidden;
        }

        .izokoc-sustainability-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: rgba(76, 175, 80, 0.1);
            border-radius: 50%;
        }

        .izokoc-sustainability-hero {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            margin: 50px 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .izokoc-sustainability-hero img {
            width: 100%;
            display: block;
        }

        .izokoc-sustainability-hero__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.3), rgba(46, 125, 50, 0.3));
        }

        .izokoc-video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #4caf50;
            z-index: 2;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .izokoc-video-play-btn:hover {
            transform: translate(-50%, -50%) scale(1.1);
            box-shadow: 0 10px 30px rgba(76, 175, 80, 0.4);
        }

        .izokoc-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }

        .izokoc-stat-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .izokoc-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #4caf50, #8bc34a);
        }

        .izokoc-stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(76, 175, 80, 0.3);
        }

        .izokoc-stat-card__icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #4caf50, #8bc34a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #fff;
            margin: 0 auto 20px;
        }

        .izokoc-stat-card__value {
            font-size: 42px;
            font-weight: 700;
            color: #4caf50;
            margin-bottom: 15px;
            line-height: 1;
        }

        .izokoc-stat-card__title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .izokoc-stat-card__description {
            font-size: 15px;
            color: #666;
            margin: 0;
        }

        .izokoc-green-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 30px;
        }

        .izokoc-green-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(76, 175, 80, 0.2);
        }

        .izokoc-green-card__icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #4caf50;
            margin: 0 auto 25px;
        }

        .izokoc-green-card__title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .izokoc-green-card__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 768px) {
            .izokoc-sustainability-section {
                padding: 60px 0;
            }

            .izokoc-stats-grid {
                grid-template-columns: 1fr;
            }

            .izokoc-video-play-btn {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
        }
    </style>
@endpush