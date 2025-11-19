@props([
    'title' => 'Sayfa Başlığı',
    'subtitle' => '',
    'backgroundImage' => null,
    'style' => 'gradient', // gradient, overlay, minimal, animated
    'height' => 'medium', // small, medium, large
    'breadcrumbs' => true,
    'pattern' => true,
    'animation' => true
])

@php
    $heightClasses = [
        'small' => 'pgban-section--small',
        'medium' => 'pgban-section--medium',
        'large' => 'pgban-section--large'
    ];

    $heightClass = $heightClasses[$height] ?? 'pgban-section--medium';
@endphp

<section class="pgban-section pgban-section--{{ $style }} {{ $heightClass }}"
         @if($backgroundImage)
             style="background-image: url('{{ asset($backgroundImage) }}');"
        @endif
>
    <!-- Overlay Layer -->
    <div class="pgban-overlay"></div>

    <!-- Pattern Layer -->
    @if($pattern && $style !== 'minimal')
        <div class="pgban-pattern">
            <div class="pgban-pattern__grid"></div>
        </div>
    @endif

    <!-- Animated Particles -->
    @if($animation && $style === 'animated')
        <div class="pgban-particles">
            @for($i = 0; $i < 15; $i++)
                <div class="pgban-particle" style="
                    left: {{ rand(0, 100) }}%;
                    top: {{ rand(0, 100) }}%;
                    width: {{ rand(6, 15) }}px;
                    height: {{ rand(6, 15) }}px;
                    animation-duration: {{ rand(15, 30) }}s;
                    animation-delay: {{ rand(0, 10) }}s;
                "></div>
            @endfor
        </div>
    @endif

    <!-- Decorative Shapes -->
    <div class="pgban-shapes">
        <div class="pgban-shape pgban-shape--1"></div>
        <div class="pgban-shape pgban-shape--2"></div>
        <div class="pgban-shape pgban-shape--3"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pgban-content" data-aos="fade-up">
                    <!-- Breadcrumbs (üstte) -->
                    @if($breadcrumbs)
                        <nav class="pgban-breadcrumbs" aria-label="breadcrumb" data-aos="fade-down" data-aos-delay="100">
                            <ol class="pgban-breadcrumbs__list">
                                <li class="pgban-breadcrumbs__item">
                                    <a href="{{ route('frontend.home') }}" class="pgban-breadcrumbs__link">
                                        <i class="fas fa-home"></i>
                                        <span>{{ __('Home') }}</span>
                                    </a>
                                </li>
                                <li class="pgban-breadcrumbs__separator">
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                <li class="pgban-breadcrumbs__item pgban-breadcrumbs__item--active">
                                    <span>{{ $title }}</span>
                                </li>
                            </ol>
                        </nav>
                    @endif

                    <!-- Main Title -->
                    <h1 class="pgban-title" data-aos="fade-up" data-aos-delay="200">
                        {{ $title }}
                    </h1>

                    <!-- Subtitle -->
                    @if($subtitle)
                        <p class="pgban-subtitle" data-aos="fade-up" data-aos-delay="300">
                            {{ $subtitle }}
                        </p>
                    @endif

                    <!-- Additional Content Slot -->
                    @if(isset($slot) && !empty(trim($slot)))
                        <div class="pgban-extra" data-aos="fade-up" data-aos-delay="400">
                            {{ $slot }}
                        </div>
                    @endif

                    <!-- Decorative Line -->
                    <div class="pgban-decorative-line" data-aos="zoom-in" data-aos-delay="500">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@push('styles')

@endpush