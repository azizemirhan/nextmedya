<div class="row nextmedya-services-glass-grid" data-animation="{{ $cardAnimation }}">
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
        @endphp

        <div class="col-lg-4 col-md-6 nextmedya-service-item category-{{ Str::slug($serviceCategory) }}"
             data-aos="{{ $cardAnimation }}"
             data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="nextmedya-glass-card {{ $isFeatured ? 'featured' : '' }}"
                 style="--gradient-start: {{ $gradientStart }}; --gradient-end: {{ $gradientEnd }};">

                <!-- Animated Background Blobs -->
                <div class="nextmedya-glass-bg">
                    <div class="nextmedya-blob blob-1"></div>
                    <div class="nextmedya-blob blob-2"></div>
                </div>

                @if($serviceBadge)
                    <div class="nextmedya-glass-badge">
                        {{ $serviceBadge }}
                    </div>
                @endif

                <!-- Icon -->
                <div class="nextmedya-glass-icon-wrapper">
                    <div class="nextmedya-glass-icon">
                        <i class="{{ $serviceIcon }}"></i>
                    </div>
                    <div class="nextmedya-glass-icon-glow"></div>
                </div>

                <!-- Category Tag -->
                <div class="nextmedya-glass-category">
                    <span>{{ $serviceCategory }}</span>
                </div>

                <!-- Content -->
                <h3 class="nextmedya-glass-title">{{ $serviceTitle }}</h3>
                <p class="nextmedya-glass-desc">{!! $serviceShortDesc  !!}</p>

                <!-- Features -->
                @if(!empty($features))
                    <ul class="nextmedya-glass-features">
                        @foreach(array_slice($features, 0, 3) as $feature)
                            @php
                                $featureText = data_get($feature, 'feature_text.' . app()->getLocale());
                                $featureIcon = data_get($feature, 'feature_icon', 'fas fa-check');
                            @endphp
                            <li>
                                <i class="{{ $featureIcon }}"></i>
                                <span>{{ $featureText }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Footer -->
                <div class="nextmedya-glass-footer">
                    @if($servicePrice)
                        <div class="nextmedya-glass-price">{{ $servicePrice }}</div>
                    @endif
                    <a href="{{ $serviceLink }}" class="nextmedya-glass-btn">
                        <span>Keşfet</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Glass Border -->
                <div class="nextmedya-glass-border"></div>
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        /* Glass Morphism Layout */
        .nextmedya-services-glass-grid {
            position: relative;
        }

        .nextmedya-glass-card {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 40px 30px;
            margin-bottom: 30px;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .nextmedya-glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent
            );
            transition: left 0.5s;
        }

        .nextmedya-glass-card:hover::before {
            left: 100%;
        }

        .nextmedya-glass-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .nextmedya-glass-card.featured {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* Animated Background Blobs */
        .nextmedya-glass-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .nextmedya-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.6;
            animation: blobFloat 8s ease-in-out infinite;
        }

        .blob-1 {
            width: 200px;
            height: 200px;
            background: var(--gradient-start);
            top: -50px;
            left: -50px;
            animation-delay: 0s;
        }

        .blob-2 {
            width: 150px;
            height: 150px;
            background: var(--gradient-end);
            bottom: -50px;
            right: -50px;
            animation-delay: 2s;
        }

        @keyframes blobFloat {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -30px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        /* Badge */
        .nextmedya-glass-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            color: #0a0a0a;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Icon */
        .nextmedya-glass-icon-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
        }

        .nextmedya-glass-icon {
            position: relative;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
            z-index: 1;
        }

        .nextmedya-glass-card:hover .nextmedya-glass-icon {
            transform: rotate(360deg) scale(1.1);
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .nextmedya-glass-icon i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .nextmedya-glass-icon-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: radial-gradient(circle, var(--gradient-start), transparent 70%);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s;
            z-index: 0;
        }

        .nextmedya-glass-card:hover .nextmedya-glass-icon-glow {
            opacity: 0.6;
            animation: pulse 2s infinite;
        }

        /* Category */
        .nextmedya-glass-category {
            text-align: center;
            margin-bottom: 20px;
        }

        .nextmedya-glass-category span {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #0a0a0a;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Content */
        .nextmedya-glass-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0a0a0a;
            text-align: center;
            margin-bottom: 16px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            line-height: 1.3;
        }

        .nextmedya-glass-desc {
            font-size: 0.95rem;
            color: #0a0a0a;
            text-align: center;
            line-height: 1.7;
            margin-bottom: 25px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Features */
        .nextmedya-glass-features {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
        }

        .nextmedya-glass-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px;
            margin-bottom: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            font-size: 0.9rem;
            color: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
        }

        .nextmedya-glass-features li:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .nextmedya-glass-features li i {
            color: #0a0a0a;
            font-size: 1rem;
            flex-shrink: 0;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        /* Footer */
        .nextmedya-glass-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nextmedya-glass-price {
            font-size: 0.9rem;
            font-weight: 700;
            color: #0a0a0a;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .nextmedya-glass-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #ffffff;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nextmedya-glass-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateX(5px);
            color: #0a0a0a;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .nextmedya-glass-btn i {
            transition: transform 0.3s;
        }

        .nextmedya-glass-btn:hover i {
            transform: translateX(5px);
        }

        /* Glass Border Effect */
        .nextmedya-glass-border {
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.4),
                    rgba(255, 255, 255, 0.1),
                    rgba(255, 255, 255, 0.4)
            );
            border-radius: 30px;
            opacity: 0;
            transition: opacity 0.4s;
            z-index: -1;
            filter: blur(10px);
        }

        .nextmedya-glass-card:hover .nextmedya-glass-border {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .nextmedya-glass-card {
                padding: 30px 20px;
            }

            .nextmedya-glass-footer {
                flex-direction: column;
            }

            .nextmedya-glass-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush