@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $backgroundStyle = data_get($content, 'background_style', 'gradient');
    $backgroundImage = data_get($content, 'background_image');
    $enableCounterAnimation = data_get($content, 'enable_counter_animation', true);
    $metrics = data_get($content, 'metrics', []);
    $testimonialHighlight = data_get($content, 'testimonial_highlight', []);
@endphp

<section class="nextmedya-success-metrics"
         data-background-style="{{ $backgroundStyle }}"
         @if($backgroundStyle === 'image' && $backgroundImage)
             style="background-image: url('{{ asset($backgroundImage) }}');"
        @endif>
    <div class="nextmedya-metrics-overlay"></div>
    <div class="container position-relative">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                @if($sectionSubtitle)
                    <span class="nextmedya-metrics-badge">{{ $sectionSubtitle }}</span>
                @endif
                <h2 class="nextmedya-metrics-title">{{ $sectionTitle }}</h2>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="row nextmedya-metrics-grid">
            @foreach($metrics as $index => $metric)
                @php
                    $metricIcon = data_get($metric, 'metric_icon', 'fas fa-shopping-cart');
                    $metricNumber = data_get($metric, 'metric_number');
                    $metricSuffix = data_get($metric, 'metric_suffix', '+');
                    $metricTitle = data_get($metric, 'metric_title.' . app()->getLocale());
                    $metricDescription = data_get($metric, 'metric_description.' . app()->getLocale());
                    $metricColor = data_get($metric, 'metric_color', '#3b82f6');
                @endphp
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="nextmedya-metric-card" style="--metric-color: {{ $metricColor }}">
                        <div class="nextmedya-metric-icon">
                            <i class="{{ $metricIcon }}"></i>
                        </div>
                        <div class="nextmedya-metric-number">
                            @if($enableCounterAnimation)
                                <span class="nextmedya-counter" data-target="{{ $metricNumber }}">0</span>
                            @else
                                <span>{{ $metricNumber }}</span>
                            @endif
                            <span class="nextmedya-metric-suffix">{{ $metricSuffix }}</span>
                        </div>
                        <h4 class="nextmedya-metric-title">{{ $metricTitle }}</h4>
                        @if($metricDescription)
                            <p class="nextmedya-metric-description">{{ $metricDescription }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Testimonial Highlight -->
        @if(!empty($testimonialHighlight))
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="nextmedya-testimonial-carousel" data-aos="fade-up">
                        <div class="swiper nextmedya-testimonial-swiper">
                            <div class="swiper-wrapper">
                                @foreach($testimonialHighlight as $testimonial)
                                    @php
                                        $clientName = data_get($testimonial, 'client_name.' . app()->getLocale());
                                        $clientCompany = data_get($testimonial, 'client_company.' . app()->getLocale());
                                        $clientPhoto = data_get($testimonial, 'client_photo');
                                        $testimonialText = data_get($testimonial, 'testimonial_text.' . app()->getLocale());
                                        $rating = data_get($testimonial, 'rating', 5);
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="nextmedya-testimonial-highlight">
                                            <div class="nextmedya-quote-icon">
                                                <i class="fas fa-quote-left"></i>
                                            </div>
                                            <p class="nextmedya-testimonial-text">{!! $testimonialText !!}</p>
                                            <div class="nextmedya-testimonial-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="nextmedya-testimonial-author">
                                                @if($clientPhoto)
                                                    <img src="{{ asset($clientPhoto) }}" alt="{{ $clientName }}">
                                                @endif
                                                <div>
                                                    <strong>{{ $clientName }}</strong>
                                                    <span>{{ $clientCompany }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-success-metrics {
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .nextmedya-success-metrics[data-background-style="gradient"] {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
        }

        .nextmedya-success-metrics[data-background-style="solid"] {
            background: #1e293b;
        }

        .nextmedya-success-metrics[data-background-style="image"] {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .nextmedya-metrics-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(30, 41, 59, 0.9);
            z-index: 1;
        }

        .nextmedya-success-metrics .container {
            z-index: 2;
        }

        .nextmedya-metrics-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nextmedya-metrics-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 60px;
        }

        /* Metrics Grid */
        .nextmedya-metrics-grid {
            margin-bottom: 60px;
        }

        .nextmedya-metric-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .nextmedya-metric-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--metric-color) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .nextmedya-metric-card:hover::before {
            opacity: 0.1;
        }

        .nextmedya-metric-card:hover {
            transform: translateY(-10px);
            border-color: var(--metric-color);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .nextmedya-metric-icon {
            width: 80px;
            height: 80px;
            background: var(--metric-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
            z-index: 1;
        }

        .nextmedya-metric-icon i {
            font-size: 2rem;
            color: #ffffff;
        }

        .nextmedya-metric-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .nextmedya-metric-suffix {
            font-size: 2.5rem;
            margin-left: 5px;
            color: var(--metric-color);
        }

        .nextmedya-metric-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .nextmedya-metric-description {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* Testimonial Highlight */
        .nextmedya-testimonial-carousel {
            margin-top: 40px;
        }

        .nextmedya-testimonial-highlight {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 50px 60px;
            text-align: center;
            position: relative;
        }
        .nextmedya-testimonial-highlight p {
            color: #fff;
        }

        .nextmedya-quote-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }

        .nextmedya-quote-icon i {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .nextmedya-testimonial-text {
            font-size: 1.25rem;
            line-height: 1.8;
            color: #ffffff;
            font-style: italic;
            margin-bottom: 30px;
        }

        .nextmedya-testimonial-rating {
            margin-bottom: 30px;
        }

        .nextmedya-testimonial-rating i {
            font-size: 1.25rem;
            color: #cbd5e1;
            margin: 0 3px;
        }

        .nextmedya-testimonial-rating i.active {
            color: #fbbf24;
        }

        .nextmedya-testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .nextmedya-testimonial-author img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #3b82f6;
        }

        .nextmedya-testimonial-author div {
            text-align: left;
        }

        .nextmedya-testimonial-author strong {
            display: block;
            font-size: 1.125rem;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .nextmedya-testimonial-author span {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .nextmedya-testimonial-swiper .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
        }

        .nextmedya-testimonial-swiper .swiper-pagination-bullet-active {
            background: #3b82f6;
        }

        @media (max-width: 992px) {
            .nextmedya-success-metrics {
                padding: 60px 0;
            }

            .nextmedya-testimonial-highlight {
                padding: 40px 30px;
            }

            .nextmedya-testimonial-text {
                font-size: 1.125rem;
            }

            .nextmedya-testimonial-author {
                flex-direction: column;
            }

            .nextmedya-testimonial-author div {
                text-align: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Counter Animation
            @if($enableCounterAnimation)
            const counters = document.querySelectorAll('.nextmedya-counter');

            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            };

            // Intersection Observer for counter animation
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        animateCounter(counter);
                        counterObserver.unobserve(counter);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => {
                counterObserver.observe(counter);
            });
            @endif

            // Testimonial Swiper
            @if(!empty($testimonialHighlight))
            new Swiper('.nextmedya-testimonial-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
            @endif
        });
    </script>
@endpush