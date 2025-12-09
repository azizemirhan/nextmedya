@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $sectionDescription = data_get($content, 'section_description.' . app()->getLocale(), '');
    $layoutStyle = data_get($content, 'layout_style', 'cards-3d');
    $enableFilter = data_get($content, 'enable_filter', true);
    $enableHoverVideo = data_get($content, 'enable_hover_video', false);
    $cardAnimation = data_get($content, 'card_animation', 'slide-up');
    $services = data_get($content, 'services', []);
    
    // Get unique categories
    $categories = collect($services)->pluck('service_category.' . app()->getLocale())->unique()->filter()->values();
@endphp

<section class="nextmedya-premium-services" data-layout="{{ $layoutStyle }}">
    <div class="container position-relative">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                @if($sectionSubtitle)
                    <span class="nextmedya-services-badge">
                        <span class="nextmedya-badge-dot"></span>
                        {{ $sectionSubtitle }}
                    </span>
                @endif
                <h2 class="nextmedya-services-title">
                    {{ $sectionTitle }}
                    <span class="nextmedya-title-underline"></span>
                </h2>
                @if($sectionDescription)
                    <p class="nextmedya-services-description">{!! $sectionDescription  !!}</p>
                @endif
            </div>
        </div>

        <!-- Services Grid -->
        @if($layoutStyle === 'cards-3d')
            @include('frontend.sections.partials._services-cards-3d', ['services' => $services, 'cardAnimation' => $cardAnimation, 'enableHoverVideo' => $enableHoverVideo])
        @elseif($layoutStyle === 'glass-morphism')
            @include('frontend.sections.partials._services-glass-morphism', ['services' => $services, 'cardAnimation' => $cardAnimation])
        @elseif($layoutStyle === 'bento-grid')
            @include('frontend.sections.partials._services-bento-grid', ['services' => $services, 'cardAnimation' => $cardAnimation])
        @elseif($layoutStyle === 'floating-cards')
            @include('frontend.sections.partials._services-floating-cards', ['services' => $services, 'cardAnimation' => $cardAnimation])
        @elseif($layoutStyle === 'split-screen')
            @include('frontend.sections.partials._services-split-screen', ['services' => $services, 'cardAnimation' => $cardAnimation])
        @endif
    </div>
</section>

@push('styles')
    <style>
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 3rem;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }

        .nextmedya-premium-services {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        .nextmedya-services-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
        }



        .nextmedya-bg-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg,
            rgba(102, 126, 234, 0.05) 0%,
            rgba(118, 75, 162, 0.05) 50%,
            rgba(102, 126, 234, 0.05) 100%);
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(-5%) translateY(5%); }
            50% { transform: translateX(5%) translateY(-5%); }
            75% { transform: translateX(-5%) translateY(-5%); }
        }

        .nextmedya-bg-pattern {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                    radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            animation: patternFloat 20s ease-in-out infinite;
        }

        @keyframes patternFloat {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(5deg); }
        }

        /* Section Header */
        .nextmedya-services-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 10px 28px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.2);
            border: 2px solid rgba(102, 126, 234, 0.2);
            position: relative;
            overflow: hidden;
        }

        .nextmedya-services-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            100% { left: 100%; }
        }

        .nextmedya-badge-dot {
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
        }

        .nextmedya-services-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 24px;
            position: relative;
            display: inline-block;
            line-height: 1.2;
        }

        .nextmedya-title-underline {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
            animation: underlineGrow 2s ease-in-out infinite;
        }

        @keyframes underlineGrow {
            0%, 100% { width: 100px; }
            50% { width: 150px; }
        }

        .nextmedya-services-description {
            font-size: 1.25rem;
            color: #64748b;
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        /* Category Filter */
        .nextmedya-services-filter {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 60px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            border-radius: 50px;
            display: inline-flex;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .nextmedya-filter-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: transparent;
            border: 2px solid transparent;
            border-radius: 50px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nextmedya-filter-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
            z-index: -1;
        }

        .nextmedya-filter-btn:hover::before,
        .nextmedya-filter-btn.active::before {
            width: 300px;
            height: 300px;
        }

        .nextmedya-filter-btn:hover,
        .nextmedya-filter-btn.active {
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-3px);
        }

        .nextmedya-filter-icon {
            font-size: 1.25rem;
            transition: transform 0.3s;
        }

        .nextmedya-filter-btn:hover .nextmedya-filter-icon {
            transform: rotate(20deg) scale(1.2);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .nextmedya-premium-services {
                padding: 80px 0;
            }

            .nextmedya-services-filter {
                flex-direction: column;
                border-radius: 20px;
            }

            .nextmedya-filter-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush