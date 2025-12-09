@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $leftImage = data_get($content, 'left_image') ? asset($content['left_image']) : 'https://placehold.co/600x700';
    $showPaymentMethods = data_get($content, 'show_payment_methods', true);
    $showSecurityFeatures = data_get($content, 'show_security_features', true);
    $paymentMethods = data_get($content, 'payment_methods', []);
    $securityFeatures = data_get($content, 'security_features', []);
    $trustBadges = data_get($content, 'trust_badges', []);
@endphp

<section class="nextmedya-payment-security">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Image -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="nextmedya-payment-image-wrapper">
                    <img src="{{ $leftImage }}" alt="Güvenli Ödeme" class="nextmedya-payment-image">
                    <div class="nextmedya-security-badge">
                        <i class="fas fa-lock"></i>
                        <div>
                            <strong>SSL Şifreli</strong>
                            <span>256-bit Güvenlik</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="nextmedya-payment-content">
                    @if($sectionSubtitle)
                        <span class="nextmedya-payment-badge">{{ $sectionSubtitle }}</span>
                    @endif
                    <h2 class="nextmedya-payment-title">{{ $sectionTitle }}</h2>

                    <!-- Payment Methods -->
                    @if($showPaymentMethods && !empty($paymentMethods))
                        <div class="nextmedya-payment-methods">
                            <h4 class="nextmedya-subsection-title">
                                <i class="fas fa-credit-card"></i>
                                Desteklenen Ödeme Yöntemleri
                            </h4>
                            <div class="nextmedya-payment-grid">
                                @foreach($paymentMethods as $method)
                                    @php
                                        $methodName = data_get($method, 'method_name.' . app()->getLocale());
                                        $methodLogo = data_get($method, 'method_logo');
                                        $methodDescription = data_get($method, 'method_description.' . app()->getLocale());
                                        $isPopular = data_get($method, 'is_popular', false);
                                    @endphp
                                    <div class="nextmedya-payment-method {{ $isPopular ? 'popular' : '' }}">
                                        @if($isPopular)
                                            <span class="nextmedya-popular-tag">Popüler</span>
                                        @endif
                                        @if($methodLogo)
                                            <img src="{{ asset($methodLogo) }}" alt="{{ $methodName }}">
                                        @endif
                                        <div class="nextmedya-method-info">
                                            <strong>{{ $methodName }}</strong>
                                            @if($methodDescription)
                                                <span>{{ $methodDescription }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Security Features -->
                    @if($showSecurityFeatures && !empty($securityFeatures))
                        <div class="nextmedya-security-features">
                            <h4 class="nextmedya-subsection-title">
                                <i class="fas fa-shield-check"></i>
                                Güvenlik Önlemleri
                            </h4>
                            <div class="nextmedya-security-list">
                                @foreach($securityFeatures as $feature)
                                    @php
                                        $featureIcon = data_get($feature, 'feature_icon', 'fas fa-shield-alt');
                                        $featureTitle = data_get($feature, 'feature_title.' . app()->getLocale());
                                        $featureDescription = data_get($feature, 'feature_description.' . app()->getLocale());
                                    @endphp
                                    <div class="nextmedya-security-item">
                                        <div class="nextmedya-security-icon">
                                            <i class="{{ $featureIcon }}"></i>
                                        </div>
                                        <div class="nextmedya-security-text">
                                            <h5>{{ $featureTitle }}</h5>
                                            <p>{!! $featureDescription !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Trust Badges -->
                    @if(!empty($trustBadges))
                        <div class="nextmedya-trust-badges">
                            @foreach($trustBadges as $badge)
                                @php
                                    $badgeImage = data_get($badge, 'badge_image');
                                    $badgeText = data_get($badge, 'badge_text.' . app()->getLocale());
                                @endphp
                                <div class="nextmedya-trust-badge">
                                    @if($badgeImage)
                                        <img src="{{ asset($badgeImage) }}" alt="{{ $badgeText }}">
                                    @endif
                                    @if($badgeText)
                                        <span>{{ $badgeText }}</span>
                                    @endif
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
        .nextmedya-payment-security {
            padding: 100px 0;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        .nextmedya-payment-image-wrapper {
            position: relative;
            padding: 20px;
        }

        .nextmedya-payment-image {
            width: 100%;
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.12);
        }

        .nextmedya-security-badge {
            position: absolute;
            bottom: 40px;
            left: 40px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 15px;
            animation: float 3s ease-in-out infinite;
        }

        .nextmedya-security-badge i {
            font-size: 2rem;
            color: #10b981;
        }

        .nextmedya-security-badge strong {
            display: block;
            font-size: 1rem;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .nextmedya-security-badge span {
            font-size: 0.875rem;
            color: #64748b;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .nextmedya-payment-badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .nextmedya-payment-title {
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 40px;
            line-height: 1.3;
        }

        .nextmedya-subsection-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nextmedya-subsection-title i {
            color: #10b981;
            font-size: 1.5rem;
        }

        /* Payment Methods */
        .nextmedya-payment-methods {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            border: 2px solid #f1f5f9;
        }

        .nextmedya-payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
        }

        .nextmedya-payment-method {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .nextmedya-payment-method:hover {
            transform: translateY(-3px);
            border-color: #10b981;
            box-shadow: 0 5px 20px rgba(16, 185, 129, 0.15);
        }

        .nextmedya-payment-method.popular {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .nextmedya-popular-tag {
            position: absolute;
            top: -10px;
            right: -10px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .nextmedya-payment-method img {
            max-width: 100%;
            height: 40px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .nextmedya-method-info strong {
            display: block;
            font-size: 0.875rem;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .nextmedya-method-info span {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Security Features */
        .nextmedya-security-features {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            border: 2px solid #f1f5f9;
        }

        .nextmedya-security-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .nextmedya-security-item {
            display: flex;
            gap: 20px;
            align-items: start;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .nextmedya-security-item:hover {
            background: #f0fdf4;
            transform: translateX(5px);
        }

        .nextmedya-security-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nextmedya-security-icon i {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .nextmedya-security-text h5 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .nextmedya-security-text p {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        /* Trust Badges */
        .nextmedya-trust-badges {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            padding-top: 20px;
        }

        .nextmedya-trust-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 50px;
            border: 2px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .nextmedya-trust-badge:hover {
            border-color: #10b981;
            transform: translateY(-2px);
        }

        .nextmedya-trust-badge img {
            height: 30px;
            width: auto;
        }

        .nextmedya-trust-badge span {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
        }

        @media (max-width: 992px) {
            .nextmedya-payment-security {
                padding: 60px 0;
            }

            .nextmedya-payment-image-wrapper {
                margin-bottom: 40px;
            }

            .nextmedya-security-badge {
                bottom: 20px;
                left: 20px;
                padding: 15px 20px;
            }

            .nextmedya-payment-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .nextmedya-security-item {
                flex-direction: column;
                text-align: center;
            }

            .nextmedya-trust-badges {
                justify-content: center;
            }
        }
    </style>
@endpush