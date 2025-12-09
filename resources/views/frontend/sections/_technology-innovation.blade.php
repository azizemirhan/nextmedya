@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $mainImage = data_get($content, 'main_image');
    $technologies = data_get($content, 'technologies', []);
@endphp

<section class="izokoc-technology-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                @if($mainImage)
                    <div class="izokoc-tech-image">
                        <img src="{{ asset($mainImage) }}" alt="{{ $mainTitle }}">
                        <div class="izokoc-tech-image__shape"></div>
                    </div>
                @endif
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="izokoc-tech-content">
                    @if($subTitle)
                        <h6 class="izokoc-section__subtitle">{{ $subTitle }}</h6>
                    @endif
                    @if($mainTitle)
                        <h2 class="izokoc-section__title">{{ $mainTitle }}</h2>
                    @endif

                    @if(!empty($technologies))
                        <div class="izokoc-tech-list">
                            @foreach($technologies as $tech)
                                @php
                                    $techIcon = data_get($tech, 'tech_icon', 'icofont-architecture');
                                    $techTitle = data_get($tech, 'tech_title.' . app()->getLocale(), '');
                                    $techDescription = data_get($tech, 'tech_description.' . app()->getLocale(), '');
                                @endphp

                                <div class="izokoc-tech-item">
                                    <div class="izokoc-tech-item__icon">
                                        <i class="{{ $techIcon }}"></i>
                                    </div>
                                    <div class="izokoc-tech-item__content">
                                        <h5 class="izokoc-tech-item__title">{{ $techTitle }}</h5>
                                        <p class="izokoc-tech-item__description">{!! $techDescription !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .izokoc-technology-section {
            padding: 100px 0;
            background: #f8f9fa;
            overflow: hidden;
        }

        .izokoc-tech-image {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
        }

        .izokoc-tech-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .izokoc-tech-image__shape {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #ffc107, #ffab00);
            border-radius: 50%;
            opacity: 0.2;
            z-index: -1;
        }

        .izokoc-tech-content {
            padding-left: 30px;
        }

        .izokoc-tech-list {
            margin-top: 40px;
        }

        .izokoc-tech-item {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .izokoc-tech-item:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .izokoc-tech-item__icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--izokoc-primary), var(--izokoc-blue));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
        }

        .izokoc-tech-item__title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .izokoc-tech-item__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 992px) {
            .izokoc-tech-content {
                padding-left: 0;
                margin-top: 50px;
            }
        }

        @media (max-width: 768px) {
            .izokoc-technology-section {
                padding: 60px 0;
            }

            .izokoc-tech-item {
                flex-direction: column;
                text-align: center;
            }

            .izokoc-tech-item:hover {
                transform: translateY(-5px);
            }
        }
    </style>
@endpush