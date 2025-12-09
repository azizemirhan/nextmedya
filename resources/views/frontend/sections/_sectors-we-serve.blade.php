@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $sectors = data_get($content, 'sectors', []);
@endphp

<section class="izokoc-sectors-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @if($subTitle)
                    <h6 class="izokoc-section__subtitle">{{ $subTitle }}</h6>
                @endif
                @if($mainTitle)
                    <h2 class="izokoc-section__title">{{ $mainTitle }}</h2>
                @endif
            </div>
        </div>

        @if(!empty($sectors))
            <div class="row">
                @foreach($sectors as $index => $sector)
                    @php
                        $sectorIcon = data_get($sector, 'sector_icon', 'icofont-building');
                        $sectorImage = data_get($sector, 'sector_image');
                        $sectorName = data_get($sector, 'sector_name.' . app()->getLocale(), '');
                        $sectorDescription = data_get($sector, 'sector_description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="izokoc-sector-card">
                            <div class="izokoc-sector-card__image">
                                @if($sectorImage)
                                    <img src="{{ asset($sectorImage) }}" alt="{{ $sectorName }}">
                                @endif
                                <div class="izokoc-sector-card__overlay"></div>
                            </div>
                            <div class="izokoc-sector-card__content">
                                <h4 class="izokoc-sector-card__title">{{ $sectorName }}</h4>
                                <p class="izokoc-sector-card__description">{!! $sectorDescription !!}</p>
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
        .izokoc-sectors-section {
            padding: 100px 0;
            background: #fff;
        }

        .izokoc-sector-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .izokoc-sector-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .izokoc-sector-card__image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .izokoc-sector-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .izokoc-sector-card:hover .izokoc-sector-card__image img {
            transform: scale(1.1);
        }


        .izokoc-sector-card__icon {
            position: absolute;
            bottom: -30px;
            left: 30px;
            width: 60px;
            height: 60px;
            background: #1a237e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
            z-index: 99999;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }

        .izokoc-sector-card__content {
            padding: 50px 30px 30px;
            flex: 1;
        }

        .izokoc-sector-card__title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .izokoc-sector-card__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 768px) {
            .izokoc-sectors-section {
                padding: 60px 0;
            }
        }
    </style>
@endpush