@php
    // SlidersListHandler'dan gelen dinamik veriyi alıyoruz.
    $sliders = $dynamicData ?? collect();

    // Geçiş efekti ayarları
    $transitionEffect = data_get($content, 'transition_effect', 'fade');
    $autoplaySpeed = data_get($content, 'autoplay_speed', 5000);
    $transitionSpeed = data_get($content, 'transition_speed', 1000);
@endphp

{{-- Eğer slider mevcutsa section'ı oluştur --}}
@if($sliders->isNotEmpty())
    <section class="izokoc-hero-slider"
             data-transition="{{ $transitionEffect }}"
             data-autoplay-speed="{{ $autoplaySpeed }}"
             data-transition-speed="{{ $transitionSpeed }}">
        <div class="izokoc-slider-wrapper">
            <div class="izokoc-slider-container" id="izokocMainSlider">
                @foreach($sliders as $index => $slider)
                    <div class="izokoc-slide {{ $loop->first ? 'active' : '' }}" data-slide-index="{{ $index }}">
                        {{-- Background Image --}}
                        <div class="izokoc-slide__background">
                            <img src="{{ asset($slider->image_path) }}"
                                 alt="{{ $slider->getTranslation('title', app()->getLocale()) }}"
                                 loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                            <div class="izokoc-slide__overlay"></div>
                        </div>

                        {{-- Content --}}
                        <div class="izokoc-slide__content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-xl-7">
                                        <div class="izokoc-slide__inner">
                                            {{-- Subtitle --}}
                                            @if($slider->getTranslation('subtitle', app()->getLocale()))
                                                <div class="izokoc-slide__subtitle"
                                                     data-animation="fadeInUp"
                                                     data-delay="0.3s">
                                                    {{ $slider->getTranslation('subtitle', app()->getLocale()) }}
                                                </div>
                                            @endif

                                            {{-- Title --}}
                                            @if($slider->getTranslation('title', app()->getLocale()))
                                                <h1 class="izokoc-slide__title"
                                                    data-animation="fadeInUp"
                                                    data-delay="0.5s">
                                                    {{ $slider->getTranslation('title', app()->getLocale()) }}
                                                </h1>
                                            @endif

                                            {{-- Description --}}
                                            @if($slider->getTranslation('description', app()->getLocale()))
                                                <p class="izokoc-slide__description"
                                                   data-animation="fadeInUp"
                                                   data-delay="0.7s">
                                                    {{ $slider->getTranslation('description', app()->getLocale()) }}
                                                </p>
                                            @endif

                                            {{-- Button --}}
                                            @if($slider->button_url && $slider->getTranslation('button_text', app()->getLocale()))
                                                <div class="izokoc-slide__button"
                                                     data-animation="fadeInUp"
                                                     data-delay="0.9s">
                                                    <a href="{{ url($slider->button_url) }}"
                                                       class="izokoc-btn izokoc-btn--primary">
                                                        <span>{{ $slider->getTranslation('button_text', app()->getLocale()) }}</span>
                                                        <i class="icofont-long-arrow-right"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Navigation Controls --}}
            @if($sliders->count() > 1)
                {{-- Arrow Navigation --}}
                <button class="izokoc-slider-nav izokoc-slider-nav--prev" id="izokocSliderPrev">
                    <i class="icofont-rounded-left"></i>
                </button>
                <button class="izokoc-slider-nav izokoc-slider-nav--next" id="izokocSliderNext">
                    <i class="icofont-rounded-right"></i>
                </button>

                {{-- Pagination Dots --}}
                <div class="izokoc-slider-pagination" id="izokocSliderPagination">
                    @foreach($sliders as $index => $slider)
                        <button class="izokoc-slider-pagination__dot {{ $loop->first ? 'active' : '' }}"
                                data-slide-to="{{ $index }}"
                                aria-label="Go to slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @push('styles')
        <style>
            a:hover {
                color: #fff;
            }
            /* Hero Slider Section */
            .izokoc-hero-slider {
                position: relative;
                width: 100%;
                height: 50vh;
                min-height: 600px;
                overflow: hidden;
            }

            /* Slider Wrapper */
            .izokoc-slider-wrapper {
                position: relative;
                width: 100%;
                height: 100%;
            }

            .izokoc-slider-container {
                position: relative;
                width: 100%;
                height: 100%;
            }

            /* Individual Slide - Base Styles */
            .izokoc-slide {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                visibility: hidden;
                transition: none;
            }

            .izokoc-slide.active {
                opacity: 1;
                visibility: visible;
                z-index: 1;
            }

            /* Fade Transition */
            .izokoc-hero-slider[data-transition="fade"] .izokoc-slide {
                transition: opacity 1s ease-in-out, visibility 1s ease-in-out;
            }

            /* Slide Transition */
            .izokoc-hero-slider[data-transition="slide"] .izokoc-slide {
                transition: transform 1s ease-in-out, opacity 0.5s ease-in-out;
            }

            .izokoc-hero-slider[data-transition="slide"] .izokoc-slide:not(.active) {
                transform: translateX(100%);
            }

            .izokoc-hero-slider[data-transition="slide"] .izokoc-slide.active {
                transform: translateX(0);
            }

            .izokoc-hero-slider[data-transition="slide"] .izokoc-slide.slide-out {
                transform: translateX(-100%);
            }

            /* Zoom Transition */
            .izokoc-hero-slider[data-transition="zoom"] .izokoc-slide {
                transition: transform 1s ease-in-out, opacity 1s ease-in-out;
            }

            .izokoc-hero-slider[data-transition="zoom"] .izokoc-slide:not(.active) {
                transform: scale(0.8);
            }

            .izokoc-hero-slider[data-transition="zoom"] .izokoc-slide.active {
                transform: scale(1);
            }

            /* Flip Transition */
            .izokoc-hero-slider[data-transition="flip"] .izokoc-slide {
                transition: transform 1s ease-in-out, opacity 0.5s ease-in-out;
                transform-style: preserve-3d;
                backface-visibility: hidden;
            }

            .izokoc-hero-slider[data-transition="flip"] .izokoc-slide:not(.active) {
                transform: rotateY(-90deg);
            }

            .izokoc-hero-slider[data-transition="flip"] .izokoc-slide.active {
                transform: rotateY(0deg);
            }

            /* Cube Transition */
            .izokoc-hero-slider[data-transition="cube"] .izokoc-slider-container {
                perspective: 1200px;
            }

            .izokoc-hero-slider[data-transition="cube"] .izokoc-slide {
                transition: transform 1s ease-in-out;
                transform-origin: left center;
                transform-style: preserve-3d;
            }

            .izokoc-hero-slider[data-transition="cube"] .izokoc-slide:not(.active) {
                transform: rotateY(90deg) translateZ(50vw);
            }

            .izokoc-hero-slider[data-transition="cube"] .izokoc-slide.active {
                transform: rotateY(0deg);
            }

            .izokoc-hero-slider[data-transition="cube"] .izokoc-slide.slide-out {
                transform: rotateY(-90deg) translateZ(50vw);
            }

            /* Carousel Transition */
            .izokoc-hero-slider[data-transition="carousel"] .izokoc-slider-container {
                perspective: 1200px;
            }

            .izokoc-hero-slider[data-transition="carousel"] .izokoc-slide {
                transition: transform 1s ease-in-out, opacity 1s ease-in-out;
                transform-style: preserve-3d;
            }

            .izokoc-hero-slider[data-transition="carousel"] .izokoc-slide:not(.active) {
                transform: translateX(100%) rotateY(-60deg);
                opacity: 0.5;
            }

            .izokoc-hero-slider[data-transition="carousel"] .izokoc-slide.active {
                transform: translateX(0) rotateY(0deg);
                opacity: 1;
            }

            .izokoc-hero-slider[data-transition="carousel"] .izokoc-slide.slide-out {
                transform: translateX(-100%) rotateY(60deg);
                opacity: 0.5;
            }

            /* Background */
            .izokoc-slide__background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .izokoc-slide__background img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transform: scale(1);
                transition: transform 8s ease-out;
            }

            .izokoc-slide.active .izokoc-slide__background img {
                transform: scale(1.1);
            }

            .izokoc-slide__overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(26, 26, 46, 0.85) 0%, rgba(15, 52, 96, 0.75) 100%);
            }

            /* Content */
            .izokoc-slide__content {
                position: relative;
                display: flex;
                align-items: center;
                width: 100%;
                height: 100%;
                z-index: 2;
            }

            .izokoc-slide__inner {
                padding: 40px 0;
            }

            /* Subtitle */
            .izokoc-slide__subtitle {
                display: inline-block;
                color: #fff;
                font-size: 16px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 20px;
                padding: 10px 25px;
                background: rgba(41, 98, 255, 0.15);
                border-left: 3px solid #2962FF;
                opacity: 0;
                transform: translateY(30px);
            }

            .izokoc-slide.active .izokoc-slide__subtitle {
                animation: fadeInUp 0.8s ease-out 0.3s forwards;
            }

            /* Title */
            .izokoc-slide__title {
                color: #fff;
                font-size: 72px;
                font-weight: 700;
                line-height: 1.2;
                margin-bottom: 25px;
                text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                opacity: 0;
                transform: translateY(30px);
            }

            .izokoc-slide.active .izokoc-slide__title {
                animation: fadeInUp 0.8s ease-out 0.5s forwards;
            }

            /* Description */
            .izokoc-slide__description {
                color: rgba(255, 255, 255, 0.95);
                font-size: 18px;
                line-height: 1.7;
                margin-bottom: 35px;
                max-width: 600px;
                opacity: 0;
                transform: translateY(30px);
            }

            .izokoc-slide.active .izokoc-slide__description {
                animation: fadeInUp 0.8s ease-out 0.7s forwards;
            }

            /* Button */
            .izokoc-slide__button {
                opacity: 0;
                transform: translateY(30px);
            }

            .izokoc-slide.active .izokoc-slide__button {
                animation: fadeInUp 0.8s ease-out 0.9s forwards;
            }

            .izokoc-btn {
                display: inline-flex;
                align-items: center;
                gap: 15px;
                padding: 18px 45px;
                font-size: 16px;
                font-weight: 600;
                text-decoration: none;
                border-radius: 50px;
                transition: all 0.4s ease;
                position: relative;
                overflow: hidden;
                z-index: 1;
            }

            .izokoc-btn--primary {
                background: #2962FF;
                color: #fff;
                box-shadow: 0 10px 30px rgba(41, 98, 255, 0.4);
            }

            .izokoc-btn--primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s ease;
                z-index: -1;
            }

            .izokoc-btn--primary:hover {
                transform: translateY(-3px);
            }

            .izokoc-btn--primary:hover::before {
                left: 100%;
            }

            .izokoc-btn i {
                font-size: 20px;
                transition: transform 0.3s ease;
            }

            .izokoc-btn:hover i {
                transform: translateX(5px);
            }

            /* Navigation Arrows */
            .izokoc-slider-nav {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 2px solid rgba(255, 255, 255, 0.2);
                color: #fff;
                font-size: 24px;
                border-radius: 50%;
                cursor: pointer;
                z-index: 10;
                transition: all 0.3s ease;
            }

            .izokoc-slider-nav:hover {
                background: #2962FF;
                border-color: #2962FF;
                color: #fff;
                transform: translateY(-50%) scale(1.1);
            }

            .izokoc-slider-nav--prev {
                left: 40px;
            }

            .izokoc-slider-nav--next {
                right: 40px;
            }

            /* Pagination Dots */
            .izokoc-slider-pagination {
                position: absolute;
                bottom: 40px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 15px;
                z-index: 10;
            }

            .izokoc-slider-pagination__dot {
                width: 12px;
                height: 12px;
                background: rgba(255, 255, 255, 0.4);
                border: 2px solid rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0;
            }

            .izokoc-slider-pagination__dot:hover {
                background: rgba(255, 255, 255, 0.6);
                transform: scale(1.2);
            }

            .izokoc-slider-pagination__dot.active {
                width: 40px;
                border-radius: 20px;
                background: #2962FF;
                border-color: #1a237e;
            }

            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Responsive */
            @media (max-width: 1200px) {
                .izokoc-slide__title {
                    font-size: 56px;
                }

                .izokoc-slider-nav {
                    width: 50px;
                    height: 50px;
                    font-size: 20px;
                }

                .izokoc-slider-nav--prev {
                    left: 30px;
                }

                .izokoc-slider-nav--next {
                    right: 30px;
                }
            }

            @media (max-width: 992px) {
                .izokoc-hero-slider {
                    height: 80vh;
                    min-height: 500px;
                }

                .izokoc-slide__title {
                    font-size: 48px;
                }

                .izokoc-slide__description {
                    font-size: 16px;
                }

                .izokoc-btn {
                    padding: 15px 35px;
                    font-size: 15px;
                }
            }

            @media (max-width: 768px) {
                .izokoc-hero-slider {
                    height: 70vh;
                    min-height: 450px;
                }

                .izokoc-slide__subtitle {
                    font-size: 14px;
                    padding: 8px 20px;
                }

                .izokoc-slide__title {
                    font-size: 36px;
                    margin-bottom: 20px;
                }

                .izokoc-slide__description {
                    font-size: 15px;
                    margin-bottom: 25px;
                }

                .izokoc-slider-nav {
                    width: 40px;
                    height: 40px;
                    font-size: 18px;
                }

                .izokoc-slider-nav--prev {
                    left: 20px;
                }

                .izokoc-slider-nav--next {
                    right: 20px;
                }

                .izokoc-slider-pagination {
                    bottom: 30px;
                    gap: 10px;
                }

                .izokoc-slider-pagination__dot {
                    width: 10px;
                    height: 10px;
                }

                .izokoc-slider-pagination__dot.active {
                    width: 30px;
                }
            }

            @media (max-width: 576px) {
                .izokoc-hero-slider {
                    height: 60vh;
                    min-height: 400px;
                }

                .izokoc-slide__subtitle {
                    font-size: 12px;
                    letter-spacing: 1px;
                }

                .izokoc-slide__title {
                    font-size: 28px;
                }

                .izokoc-slide__description {
                    font-size: 14px;
                }

                .izokoc-btn {
                    padding: 12px 30px;
                    font-size: 14px;
                    gap: 10px;
                }

                .izokoc-slider-nav {
                    display: none;
                }

                .izokoc-slider-pagination {
                    bottom: 20px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sliderSection = document.querySelector('.izokoc-hero-slider');
                const slider = document.getElementById('izokocMainSlider');
                if (!slider) return;

                const slides = slider.querySelectorAll('.izokoc-slide');
                const prevBtn = document.getElementById('izokocSliderPrev');
                const nextBtn = document.getElementById('izokocSliderNext');
                const dots = document.querySelectorAll('.izokoc-slider-pagination__dot');

                // Ayarları al
                const transitionEffect = sliderSection.dataset.transition || 'fade';
                const autoplaySpeed = parseInt(sliderSection.dataset.autoplaySpeed) || 5000;
                const transitionSpeed = parseInt(sliderSection.dataset.transitionSpeed) || 1000;

                let currentSlide = 0;
                const slideCount = slides.length;
                let autoPlayInterval;
                let isTransitioning = false;

                // Geçiş süresini dinamik olarak ayarla
                if (transitionEffect !== 'fade') {
                    const speedInSeconds = transitionSpeed / 1000;
                    slides.forEach(slide => {
                        slide.style.transitionDuration = `${speedInSeconds}s`;
                    });
                }

                // Slide değiştirme fonksiyonu
                function goToSlide(index, direction = 'next') {
                    if (isTransitioning) return;
                    isTransitioning = true;

                    const oldSlide = currentSlide;

                    // Mevcut aktif slide'ı kaldır
                    slides[currentSlide].classList.remove('active');
                    if (dots.length > 0) {
                        dots[currentSlide].classList.remove('active');
                    }

                    // Özel geçiş efektleri için ek class'lar
                    if (transitionEffect === 'slide' || transitionEffect === 'cube' || transitionEffect === 'carousel') {
                        slides[currentSlide].classList.add('slide-out');
                    }

                    // Index'i normalize et
                    currentSlide = (index + slideCount) % slideCount;

                    // Yeni slide'ı aktif yap
                    setTimeout(() => {
                        slides[currentSlide].classList.add('active');
                        if (dots.length > 0) {
                            dots[currentSlide].classList.add('active');
                        }

                        // Slide-out class'ını temizle
                        setTimeout(() => {
                            slides[oldSlide].classList.remove('slide-out');
                            isTransitioning = false;
                        }, transitionSpeed);
                    }, 50);

                    // Autoplay'i resetle
                    resetAutoPlay();
                }

                // Önceki slide
                function prevSlide() {
                    goToSlide(currentSlide - 1, 'prev');
                }

                // Sonraki slide
                function nextSlide() {
                    goToSlide(currentSlide + 1, 'next');
                }

                // Event listeners
                if (prevBtn) {
                    prevBtn.addEventListener('click', prevSlide);
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', nextSlide);
                }

                // Dot navigation
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        if (index !== currentSlide) {
                            goToSlide(index);
                        }
                    });
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        prevSlide();
                    } else if (e.key === 'ArrowRight') {
                        nextSlide();
                    }
                });

                // Touch/Swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                slider.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                });

                slider.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                });

                function handleSwipe() {
                    const swipeThreshold = 50;
                    const diff = touchStartX - touchEndX;

                    if (Math.abs(diff) > swipeThreshold) {
                        if (diff > 0) {
                            nextSlide();
                        } else {
                            prevSlide();
                        }
                    }
                }

                // Auto play
                function startAutoPlay() {
                    if (slideCount > 1) {
                        autoPlayInterval = setInterval(nextSlide, autoplaySpeed);
                    }
                }

                function stopAutoPlay() {
                    if (autoPlayInterval) {
                        clearInterval(autoPlayInterval);
                    }
                }

                function resetAutoPlay() {
                    stopAutoPlay();
                    startAutoPlay();
                }

                // Mouse hover'da autoplay'i durdur
                slider.addEventListener('mouseenter', stopAutoPlay);
                slider.addEventListener('mouseleave', startAutoPlay);

                // Başlat
                startAutoPlay();

                // Sayfa görünürlük değiştiğinde
                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) {
                        stopAutoPlay();
                    } else {
                        startAutoPlay();
                    }
                });
            });
        </script>
    @endpush
@endif