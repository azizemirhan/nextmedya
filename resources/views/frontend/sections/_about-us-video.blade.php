@php
    // İçerik verilerini güvenli bir şekilde al
    $mainImage = data_get($content, 'main_image') ? asset($content['main_image']) : asset('images/home/1.jpg');
    $popupImage = data_get($content, 'popup_image') ? asset($content['popup_image']) : $mainImage;
    $videoUrl = data_get($content, 'video_url', 'https://player.vimeo.com/video/78393586');
    
    // Çok dilli içerikler
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'About Us');
    $title = data_get($content, 'title.' . app()->getLocale(), 'Concerted Efforts To Build Better.');
    $leadText = data_get($content, 'lead_text.' . app()->getLocale(), 'Dream big with get more inspiring solutions from here.');
    $mainText = data_get($content, 'main_text.' . app()->getLocale(), 'Lorem ipsum dolor sit amet...');
    $signatureImage = data_get($content, 'signature_image') ? asset($content['signature_image']) : asset('images/sign.png');
@endphp

<section class="commonSection about-video-section">
    <div class="container">
        <div class="row">
            {{-- Video Bölümü --}}
            <div class="col-xl-6 col-lg-6 noPaddingRight">
                <div class="video_01 mrm15 text-right">
                    <img src="{{ $mainImage }}" alt="{{ $title }}" class="about-main-image">

                    @if($videoUrl)
                        <div class="vp">
                            <a class="video-play-btn" data-fancybox="" href="{{ $videoUrl }}">
                                <span class="play-icon">
                                    <i class="fas fa-play"></i>
                                </span>
                                <span class="play-text">{{ __('Watch Video') }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- İçerik Bölümü --}}
            <div class="col-xl-6 col-lg-6">
                <div class="about_us_content">
                    <h6 class="sub_title">{{ $subTitle }}</h6>
                    <h2 class="sec_title">{!! $title  !!} </h2>

                    @if($leadText)
                        <p class="ind_lead">{{ $leadText }}</p>
                    @endif

                    @if($mainText)
                        <p class="mb28">{!! $mainText !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .about-video-section {
            padding: 100px 0;
            background: #ffffff;
        }

        .about-video-section .noPaddingRight {
            padding-right: 0;
        }

        .video_01 {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .video_01.mrm15 {
            margin-right: 15px;
        }

        .about-main-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.6s ease;
        }

        .video_01:hover .about-main-image {
            transform: scale(1.05);
        }

        /* Video Play Button */
        .vp {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .video-play-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .play-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a1a;
            font-size: 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            padding-left: 5px; /* Play ikonunu ortalamak için */
        }

        .play-icon::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: pulse 2s ease-out infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }


        .play-text {
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            margin-top: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-play-btn:hover .play-text {
            opacity: 1;
        }

        /* About Content */
        .about_us_content {
            padding-left: 30px;
        }

        .sub_title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            display: block;
        }

        .sec_title {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .ind_lead {
            font-size: 18px;
            color: #666;
            font-weight: 500;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .about_us_content p.mb28 {
            color: #666;
            line-height: 1.8;
            margin-bottom: 28px;
            font-size: 16px;
        }

        .signature-image {
            max-width: 200px;
            height: auto;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 1199px) {
            .video_01.mrm15 {
                margin-right: 0;
                margin-bottom: 30px;
            }

            .about_us_content {
                padding-left: 15px;
            }

            .sec_title {
                font-size: 36px;
            }
        }

        @media (max-width: 991px) {
            .about-video-section {
                padding: 60px 0;
            }

            .about-video-section .noPaddingRight {
                padding-right: 15px;
            }

            .sec_title {
                font-size: 32px;
            }

            .play-icon {
                width: 70px;
                height: 70px;
                font-size: 20px;
            }
        }

        @media (max-width: 767px) {
            .sec_title {
                font-size: 28px;
            }

            .ind_lead {
                font-size: 16px;
            }

            .about_us_content p.mb28 {
                font-size: 15px;
            }

            .play-icon {
                width: 60px;
                height: 60px;
                font-size: 18px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Video play animasyonu için ek JavaScript (opsiyonel)
            const playButtons = document.querySelectorAll('.video-play-btn');

            playButtons.forEach(button => {
                button.addEventListener('mouseenter', function () {
                    const icon = this.querySelector('.play-icon i');
                    if (icon) {
                        icon.style.transform = 'scale(1.2)';
                    }
                });

                button.addEventListener('mouseleave', function () {
                    const icon = this.querySelector('.play-icon i');
                    if (icon) {
                        icon.style.transform = 'scale(1)';
                    }
                });
            });
        });
    </script>
@endpush