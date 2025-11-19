@php
    $mainHeadline = data_get($content, 'main_headline.' . app()->getLocale(), 'Web Siteniz, 7/24 Çalışan En İyi Satış Personeliniz Olsun');
    $subHeadline = data_get($content, 'sub_headline.' . app()->getLocale(), '');
    $heroImage = data_get($content, 'hero_image') ? asset($content['hero_image']) : 'https://placehold.co/800x600';
    $ctaPrimaryText = data_get($content, 'cta_primary_text.' . app()->getLocale(), 'Ücretsiz Analiz İste');
    $ctaPrimaryUrl = data_get($content, 'cta_primary_url', '#contact');
    $ctaSecondaryText = data_get($content, 'cta_secondary_text.' . app()->getLocale(), 'Portfolyo');
    $ctaSecondaryUrl = data_get($content, 'cta_secondary_url', '#portfolio');
    $trustBadges = data_get($content, 'trust_badges', []);
@endphp

<section class="nextmedya-corporate-hero">
    <div class="nextmedya-hero-bg-pattern"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="nextmedya-hero-content">
                    <h1 class="nextmedya-hero-title">{!! $mainHeadline  !!}</h1>
                    <p class="nextmedya-hero-subtitle">{!! $subHeadline  !!}</p>

                    <div class="nextmedya-hero-cta-group">
                        <a href="{{ $ctaPrimaryUrl }}" class="nextmedya-btn nextmedya-btn-primary">
                            {{ $ctaPrimaryText }}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ $ctaSecondaryUrl }}" class="nextmedya-btn nextmedya-btn-outline">
                            {{ $ctaSecondaryText }}
                        </a>
                    </div>

                    @if(!empty($trustBadges))
                        <div class="nextmedya-trust-badges">
                            @foreach($trustBadges as $badge)
                                <div class="nextmedya-trust-badge">
                                    <i class="{{ data_get($badge, 'badge_icon', 'fas fa-award') }}"></i>
                                    <span>{{ data_get($badge, 'badge_text.' . app()->getLocale()) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="nextmedya-hero-image-wrapper">
                    <img src="{{ $heroImage }}" alt="Kurumsal Web Tasarım" class="nextmedya-hero-image">
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-corporate-hero {
            position: relative;
            padding: 120px 0 100px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f0f4ff 100%);
            overflow: hidden;
        }

        .nextmedya-hero-bg-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background-image:
                    radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .nextmedya-hero-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.2;
            color: #1e293b;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nextmedya-hero-subtitle {
            font-size: 1.25rem;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 40px;
            max-width: 540px;
        }

        .nextmedya-hero-cta-group {
            display: flex;
            gap: 16px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .nextmedya-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .nextmedya-btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .nextmedya-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
            color: #ffffff;
        }

        .nextmedya-btn-outline {
            background: transparent;
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .nextmedya-btn-outline:hover {
            background: #3b82f6;
            color: #ffffff;
            transform: translateY(-3px);
        }

        .nextmedya-trust-badges {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .nextmedya-trust-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 0.95rem;
        }

        .nextmedya-trust-badge i {
            color: #3b82f6;
            font-size: 1.25rem;
        }

        .nextmedya-hero-image-wrapper {
            position: relative;
            padding: 40px;
        }

        .nextmedya-hero-image {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.12);
            position: relative;
            z-index: 2;
        }

        .nextmedya-floating-card {
            position: absolute;
            background: #ffffff;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: float 3s ease-in-out infinite;
            z-index: 3;
        }

        .nextmedya-floating-card i {
            font-size: 1.5rem;
            color: #3b82f6;
        }

        .nextmedya-floating-card span {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.95rem;
        }

        .nextmedya-card-1 {
            top: 10%;
            right: -10px;
            animation-delay: 0s;
        }

        .nextmedya-card-2 {
            bottom: 25%;
            left: -20px;
            animation-delay: 1s;
        }

        .nextmedya-card-3 {
            top: 50%;
            right: -30px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @media (max-width: 992px) {
            .nextmedya-corporate-hero {
                padding: 80px 0 60px;
            }

            .nextmedya-hero-image-wrapper {
                margin-top: 60px;
                padding: 20px;
            }

            .nextmedya-floating-card {
                padding: 12px 16px;
            }

            .nextmedya-card-1 { top: -10px; right: 10px; }
            .nextmedya-card-2 { bottom: -10px; left: 10px; }
            .nextmedya-card-3 { display: none; }
        }
    </style>
@endpush