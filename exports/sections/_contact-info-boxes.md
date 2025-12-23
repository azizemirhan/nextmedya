@php
    $infoBoxes = data_get($content, 'info_boxes', []);
    if (is_string($infoBoxes)) {
        $infoBoxes = json_decode($infoBoxes, true) ?? [];
    }

    // Varsayılan bilgi kutuları
    if (empty($infoBoxes)) {
        $infoBoxes = [
            [
                'icon' => 'fal fa-map-marker-alt',
                'title' => ['tr' => 'Ofis Konumu', 'en' => 'Office Location'],
                'content' => ['tr' => '475/W 13th Street, Cooper<br>New York, United States', 'en' => '475/W 13th Street, Cooper<br>New York, United States'],
                'link_text' => ['tr' => 'Haritada Bul', 'en' => 'Find Us On Map'],
                'link_url' => '#'
            ],
            [
                'icon' => 'fal fa-clock',
                'title' => ['tr' => 'Çalışma Saatleri', 'en' => 'Office Hours'],
                'content' => ['tr' => 'Pzt - Cum: 09:00 - 19:00<br>Cmt - Paz: Kapalı', 'en' => 'Mon - Fri: 09:00am to 07:00pm<br>Sat - Sun: Off Day'],
                'link_text' => ['tr' => 'Yol Tarifi Al', 'en' => 'Get Directions'],
                'link_url' => '#'
            ],
            [
                'icon' => 'fal fa-phone',
                'title' => ['tr' => 'Bizi Arayın', 'en' => 'Call Us'],
                'content' => ['tr' => '+909 797 6896<br>+(786) 7876 5675', 'en' => '+909 797 6896<br>+(786) 7876 5675'],
                'link_text' => ['tr' => 'Hemen Ara', 'en' => 'Call Now'],
                'link_url' => 'tel:+9097976896'
            ],
            [
                'icon' => 'fal fa-envelope',
                'title' => ['tr' => 'E-posta Adresi', 'en' => 'Email Address'],
                'content' => ['tr' => 'info@webmail.com<br>info@example.web.com', 'en' => 'info@webmail.com<br>info@example.web.com'],
                'link_text' => ['tr' => 'Mail Gönder', 'en' => 'Mail Us'],
                'link_url' => 'mailto:info@webmail.com'
            ],
        ];
    }
@endphp

<section class="commonSection contactInfoSection noPaddingBottom bgtp">
    <div class="container">
        <div class="row">
            @foreach($infoBoxes as $box)
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="icon_box_05">
                        <i class="{{ data_get($box, 'icon', 'fal fa-info-circle') }}"></i>
                        <div class="ib5_inner">
                            <h3>{{ data_get($box, 'title.' . app()->getLocale(), 'Title') }}</h3>
                            <p>{!! data_get($box, 'content.' . app()->getLocale(), '') !!}</p>

                            @if(data_get($box, 'link_url'))
                                <a href="{{ data_get($box, 'link_url') }}">
                                    {{ data_get($box, 'link_text.' . app()->getLocale(), 'Learn More') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
    <style>
        .contactInfoSection {
            padding: 100px 0 50px;
            position: relative;
        }

        .contactInfoSection.noPaddingBottom {
            padding-bottom: 0;
        }

        .contactInfoSection.bgtp {
            background: #f8f9fa;
        }

        .icon_box_05 {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            text-align: center;
            max-height: 350px;
        }

        .icon_box_05::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            transition: left 0.4s ease;
        }

        .icon_box_05:hover::before {
            left: 0;
        }

        .icon_box_05:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .icon_box_05 > i {
            font-size: 48px;
            color: #1a237e;
            margin-bottom: 25px;
            display: block;
            transition: all 0.4s ease;
        }

        .icon_box_05:hover > i {
            transform: scale(1.1) rotateY(360deg);
            color: #16213e;
        }

        .ib5_inner h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .icon_box_05:hover .ib5_inner h3 {
            color: #16213e;
        }

        .ib5_inner p {
            font-size: 15px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .ib5_inner p span {
            display: block;
            margin-top: 5px;
        }

        .ib5_inner a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            padding-bottom: 2px;
        }

        .ib5_inner a::after {
            content: '→';
            transition: transform 0.3s ease;
        }

        .ib5_inner a:hover {
            color: #1a237e;
            border-bottom-color: #1a237e;
        }

        .ib5_inner a:hover::after {
            transform: translateX(5px);
        }

        @media (max-width: 991px) {
            .contactInfoSection {
                padding: 60px 0 30px;
            }

            .icon_box_05 {
                padding: 30px 20px;
            }
        }

        @media (max-width: 767px) {
            .icon_box_05 > i {
                font-size: 40px;
            }

            .ib5_inner h3 {
                font-size: 18px;
            }

            .ib5_inner p {
                font-size: 14px;
            }
        }
    </style>
@endpush