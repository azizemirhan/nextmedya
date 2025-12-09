<div class="row nextmedya-services-grid" data-animation="{{ $cardAnimation }}">
    @foreach($services as $index => $service)
        @php
            $serviceTitle = data_get($service, 'service_title.' . app()->getLocale());
            $serviceCategory = data_get($service, 'service_category.' . app()->getLocale(), 'Genel');
            $serviceShortDesc = data_get($service, 'service_short_desc.' . app()->getLocale());
            $serviceIcon = data_get($service, 'service_icon', 'fas fa-rocket');
            $serviceImage = data_get($service, 'service_image');
            $serviceVideo = data_get($service, 'service_video');
            $gradientStart = data_get($service, 'gradient_start', '#667eea');
            $gradientEnd = data_get($service, 'gradient_end', '#764ba2');
            $servicePrice = data_get($service, 'service_price.' . app()->getLocale());
            $serviceBadge = data_get($service, 'service_badge.' . app()->getLocale());
            $serviceLink = data_get($service, 'service_link', '#');
            $isFeatured = data_get($service, 'is_featured', false);
            $features = data_get($service, 'service_features', []);
            $stats = data_get($service, 'service_stats', []);
        @endphp

        <div class="col-lg-4 col-md-6 nextmedya-service-item category-{{ Str::slug($serviceCategory) }}"
             data-aos="{{ $cardAnimation }}"
             data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="nextmedya-service-card-3d {{ $isFeatured ? 'featured' : '' }}"
                 style="--gradient-start: {{ $gradientStart }}; --gradient-end: {{ $gradientEnd }};">

                @if($serviceBadge)
                    <div class="nextmedya-service-badge">
                        <span>{{ $serviceBadge }}</span>
                    </div>
                @endif

                <!-- Card Header with Image/Video -->
                <div class="nextmedya-card-media">
                    @if($enableHoverVideo && $serviceVideo)
                        <video class="nextmedya-service-video" loop muted playsinline>
                            <source src="{{ $serviceVideo }}" type="video/mp4">
                        </video>
                    @endif

                    @if($serviceImage)
                        <img src="{{ asset($serviceImage) }}" alt="{{ $serviceTitle }}" class="nextmedya-service-image">
                    @endif

                    <div class="nextmedya-card-overlay">
                        <div class="nextmedya-service-icon-wrapper">
                            <i class="{{ $serviceIcon }}"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="nextmedya-card-content">
                    <div class="nextmedya-card-category">
                        <span>{{ $serviceCategory }}</span>
                    </div>

                    <h3 class="nextmedya-service-name">{{ $serviceTitle }}</h3>

                    <p class="nextmedya-service-desc">{!! $serviceShortDesc !!}</p>

                    @if(!empty($features))
                        <ul class="nextmedya-service-features">
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

                    @if(!empty($stats))
                        <div class="nextmedya-service-stats">
                            @foreach($stats as $stat)
                                @php
                                    $statNumber = data_get($stat, 'stat_number');
                                    $statLabel = data_get($stat, 'stat_label.' . app()->getLocale());
                                    $statIcon = data_get($stat, 'stat_icon', 'fas fa-star');
                                @endphp
                                <div class="nextmedya-stat-item">
                                    <i class="{{ $statIcon }}"></i>
                                    <div>
                                        <strong>{{ $statNumber }}</strong>
                                        <span>{{ $statLabel }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="nextmedya-card-footer">
                        @if($servicePrice)
                            <div class="nextmedya-service-price">
                                <span class="nextmedya-price-label">Başlangıç</span>
                                <span class="nextmedya-price-amount">{{ $servicePrice }}</span>
                            </div>
                        @endif

                        <a href="{{ $serviceLink }}" class="nextmedya-service-btn">
                            <span>Detaylar</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- 3D Effect Elements -->
                <div class="nextmedya-card-shine"></div>
                <div class="nextmedya-card-glow"></div>
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        /* 3D Cards Layout */
        .nextmedya-services-grid {
            perspective: 1000px;
        }

        .nextmedya-service-card-3d {
            position: relative;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-service-card-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            transform: scaleX(0);
            transition: transform 0.6s ease;
        }

        .nextmedya-service-card-3d:hover::before {
            transform: scaleX(1);
        }

        /* DÜZELTME 1: Hover'da sadece yukarı hareket, perspective yok */
        .nextmedya-service-card-3d:hover {
            transform: translateY(-10px); /* rotateX ve rotateY kaldırıldı */
        }

        /* DÜZELTME 2: Featured border tamamen kaldırıldı */
        .nextmedya-service-card-3d.featured {
            /* border ve border-image kaldırıldı */
            /* transform: scale(1.05); - Bu da kaldırıldı */
        }

        .nextmedya-service-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .nextmedya-service-badge span {
            display: inline-block;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #ffffff;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(251, 191, 36, 0.4);
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Card Media */
        .nextmedya-card-media {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        }

        .nextmedya-service-image,
        .nextmedya-service-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .nextmedya-service-card-3d:hover .nextmedya-service-image,
        .nextmedya-service-card-3d:hover .nextmedya-service-video {
            transform: scale(1.1);
        }

        .nextmedya-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
            rgba(102, 126, 234, 0.9),
            rgba(118, 75, 162, 0.9));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .nextmedya-service-card-3d:hover .nextmedya-card-overlay {
            opacity: 1;
        }

        .nextmedya-service-icon-wrapper {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: scale(0) rotate(-180deg);
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .nextmedya-service-card-3d:hover .nextmedya-service-icon-wrapper {
            transform: scale(1) rotate(0deg);
        }

        .nextmedya-service-icon-wrapper i {
            font-size: 3rem;
            color: #ffffff;
        }

        /* Card Content */
        .nextmedya-card-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-card-category {
            margin-bottom: 12px;
        }

        .nextmedya-card-category span {
            display: inline-block;
            background: linear-gradient(135deg,
            rgba(102, 126, 234, 0.1),
            rgba(118, 75, 162, 0.1));
            color: var(--gradient-start);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nextmedya-service-name {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 16px;
            line-height: 1.3;
            /* DÜZELTME 3: Renk değişimi kaldırıldı */
            /* transition: color 0.3s ease; - Kaldırıldı */
        }

        /* DÜZELTME 4: Hover'da başlık rengi değişmesin */
        /* .nextmedya-service-card-3d:hover .nextmedya-service-name - Bu satır tamamen kaldırıldı */

        .nextmedya-service-desc {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .nextmedya-service-features {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .nextmedya-service-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            font-size: 0.9rem;
            color: #475569;
        }

        .nextmedya-service-features li i {
            color: var(--gradient-start);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .nextmedya-service-stats {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-top: 2px solid #f1f5f9;
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 20px;
        }

        .nextmedya-stat-item {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .nextmedya-stat-item i {
            font-size: 1.5rem;
            color: var(--gradient-start);
        }

        .nextmedya-stat-item strong {
            display: block;
            font-size: 1.25rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
        }

        .nextmedya-stat-item span {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
        }

        .nextmedya-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: auto;
            padding-top: 20px;
        }

        .nextmedya-service-price {
            display: flex;
            flex-direction: column;
        }

        .nextmedya-price-label {
            font-size: 0.75rem;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .nextmedya-price-amount {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nextmedya-service-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: #ffffff;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-service-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .nextmedya-service-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .nextmedya-service-btn:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        .nextmedya-service-btn i {
            transition: transform 0.3s;
        }

        .nextmedya-service-btn:hover i {
            transform: translateX(5px);
        }

        /* 3D Effect Elements */
        .nextmedya-card-shine {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                    45deg,
                    transparent 30%,
                    rgba(255, 255, 255, 0.3) 50%,
                    transparent 70%
            );
            transform: rotate(45deg) translate(-100%, -100%);
            transition: transform 0.6s;
        }

        .nextmedya-service-card-3d:hover .nextmedya-card-shine {
            transform: rotate(45deg) translate(100%, 100%);
        }

        .nextmedya-card-glow {
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 24px;
            opacity: 0;
            filter: blur(20px);
            transition: opacity 0.4s;
            z-index: -1;
        }

        .nextmedya-service-card-3d:hover .nextmedya-card-glow {
            opacity: 0.6;
        }

        /* Video Hover Effect */
        .nextmedya-service-video {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
        }

        .nextmedya-service-card-3d:hover .nextmedya-service-video {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .nextmedya-card-media {
                height: 200px;
            }

            .nextmedya-service-stats {
                flex-direction: column;
                gap: 10px;
            }

            .nextmedya-card-footer {
                flex-direction: column;
            }

            .nextmedya-service-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Video hover play/pause
            const serviceCards = document.querySelectorAll('.nextmedya-service-card-3d');

            serviceCards.forEach(card => {
                const video = card.querySelector('.nextmedya-service-video');

                if (video) {
                    card.addEventListener('mouseenter', () => {
                        video.play();
                    });

                    card.addEventListener('mouseleave', () => {
                        video.pause();
                        video.currentTime = 0;
                    });
                }

                /* DÜZELTME 5: 3D tilt effect tamamen kaldırıldı
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const rotateX = (y - centerY) / 20;
                    const rotateY = (centerX - x) / 20;

                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-20px)`;
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                });
                */
            });

            // Filter functionality
            const filterBtns = document.querySelectorAll('.nextmedya-filter-btn');
            const serviceItems = document.querySelectorAll('.nextmedya-service-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    serviceItems.forEach(item => {
                        if (filterValue === '*' || item.classList.contains(filterValue.substring(1))) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 10);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
        });
    </script>
@endpush