<div class="nextmedya-bento-container" data-animation="{{ $cardAnimation }}">
    <div class="nextmedya-bento-grid">
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

                // Bento grid size patterns (creates asymmetric layout)
                $sizeClass = match($index % 6) {
                    0 => 'bento-large',    // 2x2
                    1 => 'bento-wide',     // 2x1
                    2 => 'bento-tall',     // 1x2
                    3 => 'bento-medium',   // 1x1
                    4 => 'bento-medium',   // 1x1
                    5 => 'bento-wide',     // 2x1
                };
            @endphp

            <div class="nextmedya-bento-item {{ $sizeClass }} category-{{ Str::slug($serviceCategory) }} nextmedya-service-item"
                 data-aos="{{ $cardAnimation }}"
                 data-aos-delay="{{ ($index + 1) * 50 }}"
                 style="--gradient-start: {{ $gradientStart }}; --gradient-end: {{ $gradientEnd }};">

                <div class="nextmedya-bento-card {{ $isFeatured ? 'featured' : '' }}">
                    <!-- Background Pattern -->
                    <div class="nextmedya-bento-pattern"></div>

                    @if($serviceBadge)
                        <div class="nextmedya-bento-badge">
                            <span>{{ $serviceBadge }}</span>
                        </div>
                    @endif

                    <!-- Background Image (if large card) -->
                    @if($serviceImage && $sizeClass === 'bento-large')
                        <div class="nextmedya-bento-bg-image">
                            <img src="{{ asset($serviceImage) }}" alt="{{ $serviceTitle }}">
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="nextmedya-bento-content">
                        <!-- Icon & Category -->
                        <div class="nextmedya-bento-header">
                            <div class="nextmedya-bento-icon">
                                <i class="{{ $serviceIcon }}"></i>
                            </div>
                            <div class="nextmedya-bento-category">
                                {{ $serviceCategory }}
                            </div>
                        </div>

                        <!-- Title & Description -->
                        <h3 class="nextmedya-bento-title">{{ $serviceTitle }}</h3>

                        @if(in_array($sizeClass, ['bento-large', 'bento-wide', 'bento-tall']))
                            <p class="nextmedya-bento-desc">{!! $serviceShortDesc !!}</p>
                        @endif

                        <!-- Features (only for large cards) -->
                        @if($sizeClass === 'bento-large' && !empty($features))
                            <ul class="nextmedya-bento-features">
                                @foreach(array_slice($features, 0, 4) as $feature)
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
                        <div class="nextmedya-bento-footer">
                            @if($servicePrice)
                                <span class="nextmedya-bento-price">{{ $servicePrice }}</span>
                            @endif
                            <a href="{{ $serviceLink }}" class="nextmedya-bento-link">
                                <span>Detaylar</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Hover Effect -->
                    <div class="nextmedya-bento-hover-effect"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        /* Bento Grid Layout */
        .nextmedya-bento-container {
            width: 100%;
            padding: 0 15px;
        }

        .nextmedya-bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 280px;
            gap: 20px;
            grid-auto-flow: dense;
        }

        /* Bento Item Sizes */
        .bento-large {
            grid-column: span 2;
            grid-row: span 2;
        }

        .bento-wide {
            grid-column: span 2;
            grid-row: span 1;
        }

        .bento-tall {
            grid-column: span 1;
            grid-row: span 2;
        }

        .bento-medium {
            grid-column: span 1;
            grid-row: span 1;
        }

        /* Bento Card */
        .nextmedya-bento-card {
            position: relative;
            height: 100%;
            background: #ffffff;
            border-radius: 24px;
            padding: 30px;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid #f1f5f9;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-bento-card:hover {
            transform: translateY(-5px);
            border-color: var(--gradient-start);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-bento-card.featured {
            background: linear-gradient(135deg,
            rgba(102, 126, 234, 0.05) 0%,
            rgba(118, 75, 162, 0.05) 100%);
            border-color: var(--gradient-start);
        }

        /* Background Pattern */
        .nextmedya-bento-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.03;
            background-image: repeating-linear-gradient(45deg, var(--gradient-start) 0, var(--gradient-start) 1px, transparent 0, transparent 50%),
            repeating-linear-gradient(-45deg, var(--gradient-end) 0, var(--gradient-end) 1px, transparent 0, transparent 50%);
            background-size: 20px 20px;
            pointer-events: none;
        }

        /* Badge */
        .nextmedya-bento-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .nextmedya-bento-badge span {
            display: inline-block;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: #ffffff;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Background Image (for large cards) */
        .nextmedya-bento-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
            overflow: hidden;
            opacity: 0.1;
        }

        .nextmedya-bento-bg-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .nextmedya-bento-card:hover .nextmedya-bento-bg-image img {
            transform: scale(1.1);
        }

        /* Content */
        .nextmedya-bento-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Header */
        .nextmedya-bento-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .nextmedya-bento-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .bento-large .nextmedya-bento-icon {
            width: 80px;
            height: 80px;
        }

        .nextmedya-bento-card:hover .nextmedya-bento-icon {
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .nextmedya-bento-icon i {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .bento-large .nextmedya-bento-icon i {
            font-size: 2rem;
        }

        .nextmedya-bento-category {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gradient-start);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 16px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 20px;
        }

        /* Title */
        .nextmedya-bento-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
            line-height: 1.3;
            transition: color 0.3s;
        }

        .bento-large .nextmedya-bento-title {
            font-size: 1.75rem;
        }

        .nextmedya-bento-card:hover .nextmedya-bento-title {
            color: var(--gradient-start);
        }

        /* Description */
        .nextmedya-bento-desc {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .bento-large .nextmedya-bento-desc {
            font-size: 1rem;
        }

        /* Features */
        .nextmedya-bento-features {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .nextmedya-bento-features li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #475569;
        }

        .nextmedya-bento-features li i {
            color: var(--gradient-start);
            font-size: 0.9rem;
        }

        /* Footer */
        .nextmedya-bento-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: auto;
            padding-top: 20px;
            border-top: 2px solid #f1f5f9;
        }

        .nextmedya-bento-price {
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
        }

        .nextmedya-bento-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: #ffffff;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-bento-link:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        .nextmedya-bento-link i {
            transition: transform 0.3s;
        }

        .nextmedya-bento-link:hover i {
            transform: translateX(5px);
        }

        /* Hover Effect */
        .nextmedya-bento-hover-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
            rgba(102, 126, 234, 0.1) 0%,
            transparent 50%);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .nextmedya-bento-card:hover .nextmedya-bento-hover-effect {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .nextmedya-bento-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .bento-large {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .nextmedya-bento-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: 250px;
                gap: 15px;
            }

            .bento-large,
            .bento-wide {
                grid-column: span 2;
                grid-row: span 1;
            }

            .bento-tall,
            .bento-medium {
                grid-column: span 1;
                grid-row: span 1;
            }

            .nextmedya-bento-card {
                padding: 20px;
            }

            .nextmedya-bento-features {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .nextmedya-bento-grid {
                grid-template-columns: 1fr;
            }

            .bento-large,
            .bento-wide,
            .bento-tall,
            .bento-medium {
                grid-column: span 1;
                grid-row: span 1;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mouse follow effect for bento cards
            const bentoCards = document.querySelectorAll('.nextmedya-bento-card');

            bentoCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;

                    card.style.setProperty('--mouse-x', x + '%');
                    card.style.setProperty('--mouse-y', y + '%');
                });
            });
        });
    </script>
@endpush