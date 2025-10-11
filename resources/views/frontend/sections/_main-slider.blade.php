@php
    $slides = $section->meta['slides'] ?? [];
@endphp
@php
    $slides = collect(data_get($content, 'slides', []));
@endphp
<div class="hero-slider">
    @foreach ($slides as $index => $slide)
        <div class="slide @if($loop->first) active @endif" data-slide="{{ $index }}">
            <div class="slide-background"></div>
            <div class="container">
                <div class="slide-content">
                    {{-- Metin İçerikleri --}}
                    <div class="text-content">
                        <span class="label">{{ data_get($slide, 'label.' . app()->getLocale()) }}</span>
                        <h1 class="hero-title">
                            {{ data_get($slide, 'title.' . app()->getLocale()) }}
                            <span
                                class="highlight">{{ data_get($slide, 'highlight_text.' . app()->getLocale()) }}</span>
                        </h1>
                        <p class="hero-description">
                            {!! data_get($slide, 'description.' . app()->getLocale()) !!}
                        </p>
                        <div class="cta-group">
                            <a href="{{ data_get($slide, 'primary_button_link') ?: '#' }}" class="btn btn-primary">
                                {{ data_get($slide, 'primary_button_text.' . app()->getLocale()) }}
                                <span>→</span>
                            </a>
                            <a href="{{ data_get($slide, 'secondary_button_link') ?: '#' }}" class="btn btn-secondary">
                                {{ data_get($slide, 'secondary_button_text.' . app()->getLocale()) }}
                                <span>→</span>
                            </a>
                        </div>
                        <div class="stats">
                            <div class="stat-item">
                                <div class="stat-number">200+</div>
                                <div class="stat-label">Proje</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Müşteri</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">15+</div>
                                <div class="stat-label">Ödül</div>
                            </div>
                        </div>
                    </div>

                    {{-- Görsel İçerikler --}}
                    <div class="visual-content">
                        <div class="image-wrapper">
                            <img src="{{ asset(data_get($slide, 'image')) }}"
                                 alt="{{ data_get($slide, 'title.' . app()->getLocale()) }}"/>
                        </div>
                        <div class="floating-card card-1">
                            <div class="card-number">98%</div>
                            <div class="card-text">Müşteri Memnuniyeti</div>
                        </div>
                        <div class="floating-card card-2">
                            <div class="card-number">5 Yıldız</div>
                            <div class="card-text">Ortalama Puan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Slider Navigasyonu --}}
    <div class="slider-nav">
        @foreach ($slides as $index => $slide)
            <div class="nav-dot @if($loop->first) active @endif" data-slide="{{ $index }}"
                 data-title="{{ data_get($slide, 'label.' . app()->getLocale()) }}"></div>
        @endforeach
    </div>
    {{-- Kaydırma Göstergesi --}}
    <div class="scroll-indicator">
        <span>Kaydır</span>
        <div class="scroll-line"></div>
    </div>

</div>
@push('styles')
@endpush
@push('scripts')
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll(".slide");
        const navDots = document.querySelectorAll(".nav-dot");
        const totalSlides = slides.length;
        let isAnimating = false;

        function goToSlide(index) {
            if (isAnimating || index === currentSlide) return;

            isAnimating = true;

            slides[currentSlide].classList.remove("active");
            navDots[currentSlide].classList.remove("active");

            currentSlide = index;

            slides[currentSlide].classList.add("active");
            navDots[currentSlide].classList.add("active");

            setTimeout(() => {
                isAnimating = false;
            }, 1000);
        }

        navDots.forEach((dot, index) => {
            dot.addEventListener("click", () => goToSlide(index));
        });

        setInterval(() => {
            const nextSlide = (currentSlide + 1) % totalSlides;
            goToSlide(nextSlide);
        }, 6000);

        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowRight") {
                goToSlide((currentSlide + 1) % totalSlides);
            } else if (e.key === "ArrowLeft") {
                goToSlide((currentSlide - 1 + totalSlides) % totalSlides);
            }
        });
    </script>
@endpush
