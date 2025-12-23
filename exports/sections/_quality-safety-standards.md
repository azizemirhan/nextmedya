@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $description = data_get($content, 'description.' . app()->getLocale(), '');
    $certificates = data_get($content, 'certificates', []);
    $standards = data_get($content, 'standards', []);
@endphp

<section class="izokoc-quality-section">
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

        {{-- Sertifikalar --}}
        @if(!empty($certificates))
            <div class="row">
                <div class="col-lg-12">
                    <div class="izokoc-certificates">
                        @foreach($certificates as $index => $cert)
                            @php
                                $certLogo = data_get($cert, 'certificate_logo');
                                $certName = data_get($cert, 'certificate_name.' . app()->getLocale(), '');
                                $certDescription = data_get($cert, 'certificate_description.' . app()->getLocale(), '');
                            @endphp

                            <div class="izokoc-certificate-item" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                @if($certLogo)
                                    <div class="izokoc-certificate-item__logo">
                                        <img src="{{ asset($certLogo) }}" alt="{{ $certName }}">
                                    </div>
                                @endif
                                <h5 class="izokoc-certificate-item__name">{{ $certName }}</h5>
                                <p class="izokoc-certificate-item__description">{{ $certDescription }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Standartlar --}}
        @if(!empty($standards))
            <div class="row" style="margin-top: 60px;">
                @foreach($standards as $index => $standard)
                    @php
                        $standardIcon = data_get($standard, 'standard_icon', 'icofont-check-circled');
                        $standardTitle = data_get($standard, 'standard_title.' . app()->getLocale(), '');
                        $standardDescription = data_get($standard, 'standard_description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="izokoc-standard-item">
                            <div class="izokoc-standard-item__icon">
                                <i class="{{ $standardIcon }}"></i>
                            </div>
                            <div class="izokoc-standard-item__content">
                                <h5 class="izokoc-standard-item__title">{{ $standardTitle }}</h5>
                                <p class="izokoc-standard-item__description">{{ $standardDescription }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .izokoc-quality-section {
            padding: 100px 0;
            background: #fff;
        }

        .izokoc-certificates {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            margin-top: 50px;
        }

        .izokoc-certificate-item {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            width: calc(25% - 23px);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .izokoc-certificate-item:hover {
            border-color: #ffc107;
            transform: translateY(-10px);
            background: #fff;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .izokoc-certificate-item__logo {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .izokoc-certificate-item__logo img {
            max-width: 120px;
            max-height: 100px;
            object-fit: contain;
        }

        .izokoc-certificate-item__name {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .izokoc-certificate-item__description {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .izokoc-standard-item {
            display: flex;
            gap: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .izokoc-standard-item:hover {
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateX(10px);
        }

        .izokoc-standard-item__icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ffc107, #ffab00);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #1a1a1a;
        }

        .izokoc-standard-item__title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .izokoc-standard-item__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 1200px) {
            .izokoc-certificate-item {
                width: calc(33.333% - 20px);
            }
        }

        @media (max-width: 768px) {
            .izokoc-quality-section {
                padding: 60px 0;
            }

            .izokoc-certificate-item {
                width: calc(50% - 15px);
            }

            .izokoc-standard-item {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .izokoc-certificate-item {
                width: 100%;
            }
        }
    </style>
@endpush