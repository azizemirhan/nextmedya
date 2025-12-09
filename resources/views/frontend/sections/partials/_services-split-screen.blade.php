<div class="nextmedya-split-container" data-animation="{{ $cardAnimation }}">
    @foreach($services as $index => $service)
        @php
            $serviceTitle = data_get($service, 'service_title.' . app()->getLocale());
            $serviceCategory = data_get($service, 'service_category.' . app()->getLocale(), 'Genel');
            $serviceShortDesc = data_get($service, 'service_short_desc.' . app()->getLocale());
            $serviceIcon = data_get($service, 'service_icon', 'fas fa-rocket');
            $serviceImage = data_get($service, 'service_image');
            $gradientStart = data_get($service, 'gradient_start', '#667eea');
            $gradientEnd = data_get($service, 'gradient_end', '#764ba2');
            $servicePrice = data_get($service, 'service_price.' . app()->getLocale());
            $serviceBadge = data_get($service, 'service_badge.' . app()->getLocale());
            $serviceLink = data_get($service, 'service_link', '#');
            $isFeatured = data_get($service, 'is_featured', false);
            $features = data_get($service, 'service_features', []);
            $stats = data_get($service, 'service_stats', []);

            // Alternate layout direction
            $isReversed = $index % 2 !== 0;
        @endphp

        <div class="nextmedya-split-item category-{{ Str::slug($serviceCategory) }} nextmedya-service-item {{ $isReversed ? 'reversed' : '' }}"
             data-aos="{{ $cardAnimation }}"
             data-aos-delay="{{ ($index + 1) * 100 }}"
             style="--gradient-start: {{ $gradientStart }}; --gradient-end: {{ $gradientEnd }};">

            <div class="row align-items-center g-0">
                <!-- Visual Side -->
                <div class="col-lg-6 {{ $isReversed ? 'order-lg-2' : '' }}">
                    <div class="nextmedya-split-visual">
                        <!-- Background Pattern -->
                        <div class="nextmedya-split-pattern"></div>

                        <!-- Gradient Overlay -->
                        <div class="nextmedya-split-gradient"></div>

                        <!-- Image -->
                        @if($serviceImage)
                            <div class="nextmedya-split-image">
                                <img src="{{ asset($serviceImage) }}" alt="{{ $serviceTitle }}">
                            </div>
                        @endif

                        <!-- Floating Icon -->
                        <div class="nextmedya-split-floating-icon">
                            <div class="nextmedya-icon-wrapper">
                                <div class="nextmedya-icon-circle circle-1"></div>
                                <div class="nextmedya-icon-circle circle-2"></div>
                                <div class="nextmedya-icon-circle circle-3"></div>
                                <i class="{{ $serviceIcon }}"></i>
                            </div>
                        </div>

                        <!-- Badge -->
                        @if($serviceBadge)
                            <div class="nextmedya-split-badge">
                                <span>{{ $serviceBadge }}</span>
                            </div>
                        @endif

                        <!-- Stats Overlay -->
                        @if(!empty($stats))
                            <div class="nextmedya-split-stats-overlay">
                                @foreach($stats as $stat)
                                    @php
                                        $statNumber = data_get($stat, 'stat_number');
                                        $statLabel = data_get($stat, 'stat_label.' . app()->getLocale());
                                        $statIcon = data_get($stat, 'stat_icon', 'fas fa-star');
                                    @endphp
                                    <div class="nextmedya-overlay-stat">
                                        <i class="{{ $statIcon }}"></i>
                                        <div>
                                            <strong>{{ $statNumber }}</strong>
                                            <span>{{ $statLabel }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Content Side -->
                <div class="col-lg-6 {{ $isReversed ? 'order-lg-1' : '' }}">
                    <div class="nextmedya-split-content">
                        <!-- Category -->
                        <div class="nextmedya-split-category">
                            <span class="nextmedya-category-line"></span>
                            {{ $serviceCategory }}
                        </div>

                        <!-- Title -->
                        <h3 class="nextmedya-split-title">{{ $serviceTitle }}</h3>

                        <!-- Description -->
                        <p class="nextmedya-split-desc">{!! $serviceShortDesc !!}</p>

                        <!-- Features List -->
                        @if(!empty($features))
                            <ul class="nextmedya-split-features">
                                @foreach($features as $fIndex => $feature)
                                    @php
                                        $featureText = data_get($feature, 'feature_text.' . app()->getLocale());
                                        $featureIcon = data_get($feature, 'feature_icon', 'fas fa-check');
                                    @endphp
                                    <li class="nextmedya-split-feature"
                                        style="--feature-index: {{ $fIndex }};">
                                        <div class="nextmedya-split-feature-icon">
                                            <i class="{{ $featureIcon }}"></i>
                                        </div>
                                        <span>{{ $featureText }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Price & CTA -->
                        <div class="nextmedya-split-footer">
                            @if($servicePrice)
                                <div class="nextmedya-split-price-tag">
                                    <span class="nextmedya-price-from">Başlangıç</span>
                                    <span class="nextmedya-price-amount">{{ $servicePrice }}</span>
                                </div>
                            @endif

                            <a href="{{ $serviceLink }}" class="nextmedya-split-btn">
                                <span class="nextmedya-btn-content">
                                    <span class="nextmedya-btn-icon">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="nextmedya-btn-label">Detaylı Bilgi</span>
                                </span>
                                <span class="nextmedya-btn-hover-bg"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="nextmedya-split-decorations">
                <div class="nextmedya-deco-circle circle-1"></div>
                <div class="nextmedya-deco-circle circle-2"></div>
                <div class="nextmedya-deco-line line-1"></div>
                <div class="nextmedya-deco-line line-2"></div>
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        /* Split Screen Layout */
        .nextmedya-split-container {
            position: relative;
        }

        .nextmedya-split-item {
            position: relative;
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nextmedya-split-item:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        /* Visual Side */
        .nextmedya-split-visual {
            position: relative;
            height: 600px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            overflow: hidden;
        }

        /* Background Pattern */
        .nextmedya-split-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            background-image:
                    repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, 0.1) 35px, rgba(255, 255, 255, 0.1) 70px);
        }

        /* Gradient Overlay */
        .nextmedya-split-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 50%,
            rgba(255, 255, 255, 0.1) 0%,
            transparent 50%);
        }

        /* Image */
        .nextmedya-split-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.2;
        }

        .nextmedya-split-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            mix-blend-mode: overlay;
            transition: transform 0.6s ease;
        }

        .nextmedya-split-item:hover .nextmedya-split-image img {
            transform: scale(1.1);
        }

        /* Floating Icon */
        .nextmedya-split-floating-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .nextmedya-icon-wrapper {
            position: relative;
            width: 160px;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: iconRotate 20s linear infinite;
        }

        @keyframes iconRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .nextmedya-icon-circle {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .circle-1 {
            width: 100%;
            height: 100%;
            animation: pulseCircle 3s ease-in-out infinite;
        }

        .circle-2 {
            width: 80%;
            height: 80%;
            animation: pulseCircle 3s ease-in-out infinite 1s;
        }

        .circle-3 {
            width: 60%;
            height: 60%;
            animation: pulseCircle 3s ease-in-out infinite 2s;
        }

        @keyframes pulseCircle {
            0%, 100% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
        }

        .nextmedya-icon-wrapper i {
            font-size: 4rem;
            color: #ffffff;
            z-index: 1;
            animation: iconFloat 4s ease-in-out infinite;
            text-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* Badge */
        .nextmedya-split-badge {
            position: absolute;
            top: 30px;
            right: 30px;
            z-index: 3;
        }

        .nextmedya-split-badge span {
            display: block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        /* Stats Overlay */
        .nextmedya-split-stats-overlay {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            display: flex;
            gap: 20px;
            z-index: 3;
        }

        .nextmedya-overlay-stat {
            flex: 1;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nextmedya-overlay-stat i {
            font-size: 2rem;
            color: #ffffff;
        }

        .nextmedya-overlay-stat strong {
            display: block;
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .nextmedya-overlay-stat span {
            display: block;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            text-transform: uppercase;
            margin-top: 5px;
        }

        /* Content Side */
        .nextmedya-split-content {
            padding: 60px;
        }

        /* Category */
        .nextmedya-split-category {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--gradient-start);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .nextmedya-category-line {
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            border-radius: 2px;
        }

        /* Title */
        .nextmedya-split-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 24px;
            line-height: 1.2;
            transition: all 0.3s ease;
        }

        .nextmedya-split-item:hover .nextmedya-split-title {
            color: var(--gradient-start);
        }

        /* Description */
        .nextmedya-split-desc {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        /* Features */
        .nextmedya-split-features {
            list-style: none;
            padding: 0;
            margin: 0 0 35px 0;
        }

        .nextmedya-split-feature {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            font-size: 1rem;
            color: #475569;
            border-bottom: 1px solid #f1f5f9;
            opacity: 0;
            animation: featureReveal 0.5s ease forwards;
            animation-delay: calc(var(--feature-index) * 0.1s);
        }

        @keyframes featureReveal {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nextmedya-split-feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .nextmedya-split-feature:hover .nextmedya-split-feature-icon {
            transform: rotate(360deg) scale(1.1);
        }

        .nextmedya-split-feature-icon i {
            font-size: 1rem;
            color: #ffffff;
        }

        /* Footer */
        .nextmedya-split-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            padding-top: 30px;
            border-top: 2px solid #f1f5f9;
        }

        /* Price Tag */
        .nextmedya-split-price-tag {
            display: flex;
            flex-direction: column;
        }

        .nextmedya-price-from {
            font-size: 0.75rem;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        .nextmedya-price-amount {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* CTA Button */
        .nextmedya-split-btn {
            position: relative;
            display: inline-flex;
            padding: 18px 40px;
            border-radius: 50px;
            overflow: hidden;
            text-decoration: none;
            background: #ffffff;
            border: 3px solid var(--gradient-start);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nextmedya-btn-content {
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .nextmedya-btn-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
        }

        .nextmedya-btn-icon i {
            font-size: 1rem;
            color: #ffffff;
            transition: transform 0.4s ease;
        }

        .nextmedya-btn-label {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gradient-start);
            transition: color 0.4s ease;
        }

        .nextmedya-btn-hover-bg {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            transition: left 0.4s ease;
            z-index: 0;
        }

        .nextmedya-split-btn:hover .nextmedya-btn-hover-bg {
            left: 0;
        }

        .nextmedya-split-btn:hover .nextmedya-btn-label {
            color: #ffffff;
        }

        .nextmedya-split-btn:hover .nextmedya-btn-icon {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .nextmedya-split-btn:hover .nextmedya-btn-icon i {
            transform: translateX(5px);
        }

        /* Decorative Elements */
        .nextmedya-split-decorations {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .nextmedya-deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(102, 126, 234, 0.1);
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation: decorFloat 8s ease-in-out infinite;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation: decorFloat 10s ease-in-out infinite 2s;
        }

        @keyframes decorFloat {
            0%, 100% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(20px, -20px);
            }
        }

        .nextmedya-deco-line {
            position: absolute;
            height: 2px;
            background: linear-gradient(90deg,
            transparent,
            rgba(102, 126, 234, 0.2),
            transparent);
        }

        .line-1 {
            width: 200px;
            top: 30%;
            left: 0;
            animation: lineSlide 5s ease-in-out infinite;
        }

        .line-2 {
            width: 250px;
            bottom: 40%;
            right: 0;
            animation: lineSlide 6s ease-in-out infinite 1s;
        }

        @keyframes lineSlide {
            0%, 100% {
                transform: translateX(0);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .nextmedya-split-visual {
                height: 400px;
            }

            .nextmedya-split-content {
                padding: 40px 30px;
            }

            .nextmedya-split-title {
                font-size: 2rem;
            }

            .nextmedya-split-stats-overlay {
                flex-direction: column;
            }

            .nextmedya-split-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .nextmedya-split-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .nextmedya-icon-wrapper {
                width: 120px;
                height: 120px;
            }

            .nextmedya-icon-wrapper i {
                font-size: 3rem;
            }

            .nextmedya-split-content {
                padding: 30px 20px;
            }
        }
    </style>
@endpush