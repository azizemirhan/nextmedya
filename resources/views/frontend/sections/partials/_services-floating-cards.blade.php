<div class="nextmedya-floating-container" data-animation="{{ $cardAnimation }}">
    <div class="row nextmedya-floating-grid">
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

                // Random floating animation delays
                $floatDelay = ($index % 3) * 1;
            @endphp

            <div class="col-lg-4 col-md-6 nextmedya-service-item category-{{ Str::slug($serviceCategory) }}"
                 data-aos="{{ $cardAnimation }}"
                 data-aos-delay="{{ ($index + 1) * 100 }}">

                <div class="nextmedya-floating-card {{ $isFeatured ? 'featured' : '' }}"
                     style="--gradient-start: {{ $gradientStart }};
                            --gradient-end: {{ $gradientEnd }};
                            --float-delay: {{ $floatDelay }}s;">

                    <!-- Floating Elements Background -->
                    <div class="nextmedya-floating-bg">
                        <div class="nextmedya-float-element element-1"></div>
                        <div class="nextmedya-float-element element-2"></div>
                        <div class="nextmedya-float-element element-3"></div>
                    </div>

                    <!-- Badge -->
                    @if($serviceBadge)
                        <div class="nextmedya-floating-badge">
                            <span>{{ $serviceBadge }}</span>
                            <div class="nextmedya-badge-shine"></div>
                        </div>
                    @endif

                    <!-- Card Inner -->
                    <div class="nextmedya-floating-inner">
                        <!-- Header with Icon -->
                        <div class="nextmedya-floating-header">
                            <div class="nextmedya-floating-icon-container">
                                <div class="nextmedya-icon-orbit orbit-1"></div>
                                <div class="nextmedya-icon-orbit orbit-2"></div>
                                <div class="nextmedya-icon-orbit orbit-3"></div>
                                <div class="nextmedya-floating-icon">
                                    <i class="{{ $serviceIcon }}"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Category Badge -->
                        <div class="nextmedya-floating-category">
                            <span class="nextmedya-category-dot"></span>
                            {{ $serviceCategory }}
                        </div>

                        <!-- Content -->
                        <div class="nextmedya-floating-content">
                            <h3 class="nextmedya-floating-title">{{ $serviceTitle }}</h3>
                            <p class="nextmedya-floating-desc">{{ $serviceShortDesc }}</p>

                            <!-- Features with animated check -->
                            @if(!empty($features))
                                <ul class="nextmedya-floating-features">
                                    @foreach(array_slice($features, 0, 3) as $fIndex => $feature)
                                        @php
                                            $featureText = data_get($feature, 'feature_text.' . app()->getLocale());
                                            $featureIcon = data_get($feature, 'feature_icon', 'fas fa-check');
                                        @endphp
                                        <li style="--feature-delay: {{ $fIndex * 0.1 }}s;">
                                            <div class="nextmedya-feature-icon">
                                                <i class="{{ $featureIcon }}"></i>
                                            </div>
                                            <span>{{ $featureText }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <!-- Stats (if available) -->
                            @if(!empty($stats))
                                <div class="nextmedya-floating-stats">
                                    @foreach($stats as $stat)
                                        @php
                                            $statNumber = data_get($stat, 'stat_number');
                                            $statLabel = data_get($stat, 'stat_label.' . app()->getLocale());
                                            $statIcon = data_get($stat, 'stat_icon', 'fas fa-star');
                                        @endphp
                                        <div class="nextmedya-stat">
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

                        <!-- Footer -->
                        <div class="nextmedya-floating-footer">
                            @if($servicePrice)
                                <div class="nextmedya-floating-price">
                                    <span class="nextmedya-price-label">Başlangıç</span>
                                    <span class="nextmedya-price-value">{{ $servicePrice }}</span>
                                </div>
                            @endif

                            <a href="{{ $serviceLink }}" class="nextmedya-floating-btn">
                                <span class="nextmedya-btn-bg"></span>
                                <span class="nextmedya-btn-text">
                                    <span>İncele</span>
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Card Shadow -->
                    <div class="nextmedya-floating-shadow"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        /* Floating Cards Layout */
        .nextmedya-floating-container {
            position: relative;
        }

        .nextmedya-floating-grid {
            position: relative;
        }

        .nextmedya-floating-card {
            position: relative;
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            margin-bottom: 30px;
            animation: cardFloat 6s ease-in-out infinite;
            animation-delay: var(--float-delay);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            25% {
                transform: translateY(-15px) rotate(1deg);
            }
            50% {
                transform: translateY(-10px) rotate(-1deg);
            }
            75% {
                transform: translateY(-20px) rotate(0.5deg);
            }
        }

        .nextmedya-floating-card:hover {
            animation-play-state: paused;
            transform: translateY(-25px) scale(1.02);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        }

        .nextmedya-floating-card.featured {
            border: 3px solid;
            border-image: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)) 1;
        }

        /* Floating Background Elements */
        .nextmedya-floating-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            opacity: 0.15;
        }

        .nextmedya-float-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            animation: floatElement 10s ease-in-out infinite;
        }

        .element-1 {
            width: 100px;
            height: 100px;
            top: -30px;
            left: -30px;
            animation-delay: 0s;
        }

        .element-2 {
            width: 150px;
            height: 150px;
            bottom: -50px;
            right: -50px;
            animation-delay: 2s;
        }

        .element-3 {
            width: 80px;
            height: 80px;
            top: 50%;
            right: -20px;
            animation-delay: 4s;
        }

        @keyframes floatElement {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(20px, -20px) scale(1.1);
            }
            66% {
                transform: translate(-15px, 15px) scale(0.9);
            }
        }

        /* Badge */
        .nextmedya-floating-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            z-index: 10;
            overflow: hidden;
            border-radius: 50px;
        }

        .nextmedya-floating-badge span {
            display: block;
            position: relative;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: #ffffff;
            padding: 8px 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .nextmedya-badge-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            animation: badgeShine 3s infinite;
        }

        @keyframes badgeShine {
            0% { left: -100%; }
            50%, 100% { left: 200%; }
        }

        /* Card Inner */
        .nextmedya-floating-inner {
            position: relative;
            padding: 40px 30px;
            z-index: 1;
        }

        /* Header with Orbiting Icon */
        .nextmedya-floating-header {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }

        .nextmedya-floating-icon-container {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .nextmedya-icon-orbit {
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            border: 2px solid;
            opacity: 0.3;
            animation: orbitRotate 8s linear infinite;
        }

        .orbit-1 {
            width: 100%;
            height: 100%;
            border-color: var(--gradient-start);
            transform: translate(-50%, -50%);
            animation-delay: 0s;
        }

        .orbit-2 {
            width: 80%;
            height: 80%;
            border-color: var(--gradient-end);
            transform: translate(-50%, -50%);
            animation-delay: 1s;
            animation-direction: reverse;
        }

        .orbit-3 {
            width: 60%;
            height: 60%;
            border-color: var(--gradient-start);
            transform: translate(-50%, -50%);
            animation-delay: 2s;
        }

        @keyframes orbitRotate {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .nextmedya-floating-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: iconPulse 3s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                box-shadow: 0 15px 60px rgba(0, 0, 0, 0.3);
                transform: translate(-50%, -50%) scale(1.05);
            }
        }

        .nextmedya-floating-icon i {
            font-size: 2rem;
            color: #ffffff;
            animation: iconFloat 4s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Category */
        .nextmedya-floating-category {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg,
            rgba(102, 126, 234, 0.1),
            rgba(118, 75, 162, 0.1));
            color: var(--gradient-start);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .nextmedya-category-dot {
            width: 8px;
            height: 8px;
            background: var(--gradient-start);
            border-radius: 50%;
            animation: dotPulse 2s ease-in-out infinite;
        }

        @keyframes dotPulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.7;
            }
        }

        /* Content */
        .nextmedya-floating-content {
            margin-bottom: 25px;
        }

        .nextmedya-floating-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 16px;
            line-height: 1.3;
            transition: all 0.3s ease;
        }

        .nextmedya-floating-card:hover .nextmedya-floating-title {
            color: var(--gradient-start);
            transform: translateX(5px);
        }

        .nextmedya-floating-desc {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        /* Features */
        .nextmedya-floating-features {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .nextmedya-floating-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            font-size: 0.9rem;
            color: #475569;
            opacity: 0;
            animation: featureSlideIn 0.5s ease forwards;
            animation-delay: var(--feature-delay);
        }

        @keyframes featureSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nextmedya-feature-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-feature-icon i {
            font-size: 0.75rem;
            color: #ffffff;
        }

        /* Stats */
        .nextmedya-floating-stats {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-top: 2px dashed #e2e8f0;
            border-bottom: 2px dashed #e2e8f0;
            margin-bottom: 20px;
        }

        .nextmedya-stat {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .nextmedya-stat i {
            font-size: 1.5rem;
            color: var(--gradient-start);
        }

        .nextmedya-stat strong {
            display: block;
            font-size: 1.25rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
        }

        .nextmedya-stat span {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
        }

        /* Footer */
        .nextmedya-floating-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .nextmedya-floating-price {
            display: flex;
            flex-direction: column;
        }

        .nextmedya-price-label {
            font-size: 0.7rem;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .nextmedya-price-value {
            font-size: 1.125rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nextmedya-floating-btn {
            position: relative;
            padding: 14px 28px;
            border-radius: 50px;
            overflow: hidden;
            text-decoration: none;
            border: 2px solid var(--gradient-start);
            transition: all 0.4s ease;
        }

        .nextmedya-btn-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            transition: width 0.4s ease;
            z-index: 0;
        }

        .nextmedya-floating-btn:hover .nextmedya-btn-bg {
            width: 100%;
        }

        .nextmedya-btn-text {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--gradient-start);
            transition: color 0.4s ease;
            z-index: 1;
        }

        .nextmedya-floating-btn:hover .nextmedya-btn-text {
            color: #ffffff;
        }

        .nextmedya-btn-text i {
            transition: transform 0.3s ease;
        }

        .nextmedya-floating-btn:hover .nextmedya-btn-text i {
            transform: translateX(5px);
        }

        /* Card Shadow */
        .nextmedya-floating-shadow {
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 40px;
            background: radial-gradient(ellipse, rgba(0, 0, 0, 0.2), transparent 70%);
            border-radius: 50%;
            filter: blur(15px);
            transition: all 0.5s ease;
            z-index: -1;
        }

        .nextmedya-floating-card:hover .nextmedya-floating-shadow {
            width: 90%;
            height: 50px;
            bottom: -30px;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .nextmedya-floating-inner {
                padding: 30px 20px;
            }

            .nextmedya-floating-icon-container {
                width: 100px;
                height: 100px;
            }

            .nextmedya-floating-icon {
                width: 70px;
                height: 70px;
            }

            .nextmedya-floating-stats {
                flex-direction: column;
            }

            .nextmedya-floating-footer {
                flex-direction: column;
            }

            .nextmedya-floating-btn {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            .nextmedya-btn-text {
                justify-content: center;
            }
        }
    </style>
@endpush