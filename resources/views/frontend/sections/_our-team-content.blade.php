@php
    $title = data_get($content, 'title.' . app()->getLocale(), 'Ekibimiz');
    $description = data_get($content, 'description.' . app()->getLocale(), '');

    // Repeater'dan gelen ekip üyeleri
    $teamMembers = data_get($content, 'team_members', []);
    if (is_string($teamMembers)) {
        $teamMembers = json_decode($teamMembers, true) ?? [];
    }

    // Benzersiz ID oluştur
    $uniqueId = 'team-' . uniqid();
@endphp

@if(!empty($teamMembers))
    <section id="team" class="team-section" data-section-id="{{ $uniqueId }}">
        <div class="container">
            {{-- Bölüm Başlıkları --}}
            <div class="section-header">
                <h2 class="eyebrow">{{ $title }}</h2>
                @if($description)
                    <p class="section-description">{{ $description }}</p>
                @endif
            </div>

            <div class="team-slider-container" data-team-container="{{ $uniqueId }}">
                <div class="team-slider" data-team-slider="{{ $uniqueId }}">
                    {{-- Ekip Üyelerini Döngüye Al --}}
                    @foreach($teamMembers as $member)
                        @php
                            $name = data_get($member, 'name.' . app()->getLocale(), 'Team Member');
                            $position = data_get($member, 'position.' . app()->getLocale(), 'Position');
                            $photo = data_get($member, 'photo') ? asset($member['photo']) : 'https://placehold.co/300x350';

                            $socials = [
                                ['url' => data_get($member, 'facebook_url'), 'icon' => 'fa-facebook-f', 'label' => 'Facebook'],
                                ['url' => data_get($member, 'twitter_url'), 'icon' => 'fa-twitter', 'label' => 'Twitter'],
                                ['url' => data_get($member, 'linkedin_url'), 'icon' => 'fa-linkedin-in', 'label' => 'LinkedIn'],
                            ];
                        @endphp

                        <article class="team-card">
                            <div class="media-wrap">
                                <img class="team-photo" src="{{ $photo }}" alt="{{ $name }}" loading="lazy">
                                <div class="overlay-gradient"></div>

                                @if(array_filter(array_column($socials, 'url')))
                                    <ul class="social-links">
                                        @foreach($socials as $social)
                                            @if(!empty($social['url']))
                                                <li>
                                                    <a href="{{ $social['url'] }}" class="social-link" target="_blank" rel="noopener">
                                                        <i class="fab {{ $social['icon'] }}"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="team-info">
                                <h3 class="member-name">{{ $name }}</h3>
                                <p class="member-position">{{ $position }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            {{-- Slider Navigasyon Butonları --}}
            <div class="slider-navigation">
                <button class="nav-btn team-prev-btn" data-team-prev="{{ $uniqueId }}" type="button">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn team-next-btn" data-team-next="{{ $uniqueId }}" type="button">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            {{-- İlerleme Çubuğu --}}
            <div class="progress-indicator">
                <div class="progress-bar" data-team-progress="{{ $uniqueId }}"></div>
            </div>
        </div>
    </section>
@endif

@push('styles')
    <style>
        .team-section {
            padding: 80px 0;
            background-color: #ffffff;
            scroll-margin-top: 100px;
        }

        .team-section .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .eyebrow {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 15px;
        }

        .section-description {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
        }

        .team-slider-container {
            position: relative;
            overflow: hidden;
            margin-bottom: 40px;
        }

        .team-slider {
            display: flex;
            gap: 30px;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }

        .team-card {
            flex: 0 0 300px;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .media-wrap {
            position: relative;
            height: 350px;
            overflow: hidden;
        }

        .team-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .team-card:hover .team-photo {
            transform: scale(1.05);
        }

        .overlay-gradient {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .team-card:hover .overlay-gradient {
            opacity: 1;
        }

        .social-links {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            display: flex;
            gap: 12px;
            opacity: 0;
            transition: all 0.3s ease;
            list-style: none;
            margin: 0;
            padding: 0;
            z-index: 10;
        }

        .team-card:hover .social-links {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #374151;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .social-link:hover {
            background: #ffc107;
            color: #1a1a1a;
            transform: scale(1.15) rotate(10deg);
        }

        .social-link i {
            font-size: 16px;
        }

        .team-info {
            padding: 25px;
            text-align: center;
        }

        .member-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .member-position {
            font-size: 0.9rem;
            color: #ffc107;
            font-weight: 600;
        }

        .slider-navigation {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .nav-btn {
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            background: #f8fafc;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .nav-btn:hover:not(:disabled) {
            background: #ffc107;
            color: #1a1a1a;
            transform: scale(1.1);
        }

        .nav-btn:disabled {
            cursor: not-allowed;
            opacity: 0.3;
        }

        .progress-indicator {
            width: 200px;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ffc107, #ffab00);
            border-radius: 2px;
            transition: width 0.5s ease;
            width: 0%;
        }

        @media (max-width: 768px) {
            .team-section {
                padding: 60px 0;
            }
            .eyebrow {
                font-size: 2rem;
            }
            .team-card {
                flex: 0 0 280px;
            }
            .media-wrap {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .team-section .container {
                padding: 0 15px;
            }
            .team-card {
                flex: 0 0 250px;
            }
            .eyebrow {
                font-size: 1.75rem;
            }
        }
    </style>
@endpush

@once
    @push('scripts')
        <script>
            (function() {
                'use strict';

                function initializeTeamSliders() {
                    // Tüm team section'ları bul
                    const teamSections = document.querySelectorAll('.team-section[data-section-id]');

                    teamSections.forEach(function(section) {
                        const uniqueId = section.getAttribute('data-section-id');
                        const slider = section.querySelector('[data-team-slider="' + uniqueId + '"]');
                        const prevBtn = section.querySelector('[data-team-prev="' + uniqueId + '"]');
                        const nextBtn = section.querySelector('[data-team-next="' + uniqueId + '"]');
                        const progressBar = section.querySelector('[data-team-progress="' + uniqueId + '"]');

                        if (!slider || !prevBtn || !nextBtn || !progressBar) {
                            console.warn('Team slider elements not found for:', uniqueId);
                            return;
                        }

                        const cards = slider.querySelectorAll('.team-card');
                        if (!cards || cards.length === 0) {
                            console.warn('No team cards found for:', uniqueId);
                            return;
                        }

                        const cardWidth = 330;
                        let currentPosition = 0;
                        const totalCards = cards.length;

                        // Eğer tek kart varsa kontrolleri gizle
                        if (totalCards <= 1) {
                            prevBtn.style.display = 'none';
                            nextBtn.style.display = 'none';
                            progressBar.parentElement.style.display = 'none';
                            return;
                        }

                        function getVisibleCards() {
                            const containerWidth = slider.parentElement.offsetWidth;
                            return Math.max(1, Math.floor(containerWidth / cardWidth));
                        }

                        let visibleCards = getVisibleCards();
                        let maxPosition = Math.max(0, totalCards - visibleCards);

                        function updateSlider() {
                            const translateX = -(currentPosition * cardWidth);
                            slider.style.transform = 'translateX(' + translateX + 'px)';

                            const progress = maxPosition > 0 ? (currentPosition / maxPosition) * 100 : 0;
                            progressBar.style.width = Math.min(100, progress) + '%';

                            prevBtn.disabled = currentPosition === 0;
                            nextBtn.disabled = currentPosition >= maxPosition;
                        }

                        function nextSlide() {
                            if (currentPosition < maxPosition) {
                                currentPosition++;
                                updateSlider();
                            }
                        }

                        function prevSlide() {
                            if (currentPosition > 0) {
                                currentPosition--;
                                updateSlider();
                            }
                        }

                        prevBtn.addEventListener('click', prevSlide);
                        nextBtn.addEventListener('click', nextSlide);

                        // Resize handler
                        let resizeTimer;
                        window.addEventListener('resize', function() {
                            clearTimeout(resizeTimer);
                            resizeTimer = setTimeout(function() {
                                visibleCards = getVisibleCards();
                                maxPosition = Math.max(0, totalCards - visibleCards);

                                if (currentPosition > maxPosition) {
                                    currentPosition = maxPosition;
                                }

                                updateSlider();
                            }, 250);
                        });

                        // Touch support
                        let touchStartX = 0;
                        let touchEndX = 0;

                        slider.addEventListener('touchstart', function(e) {
                            touchStartX = e.changedTouches[0].screenX;
                        }, { passive: true });

                        slider.addEventListener('touchend', function(e) {
                            touchEndX = e.changedTouches[0].screenX;
                            const diff = touchStartX - touchEndX;
                            const swipeThreshold = 50;

                            if (Math.abs(diff) > swipeThreshold) {
                                if (diff > 0) {
                                    nextSlide();
                                } else {
                                    prevSlide();
                                }
                            }
                        }, { passive: true });

                        // Initialize
                        updateSlider();
                        console.log('Team slider initialized successfully:', uniqueId);
                    });
                }

                // DOM yüklendikten sonra çalıştır
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initializeTeamSliders);
                } else {
                    // DOM zaten yüklenmişse hemen çalıştır
                    setTimeout(initializeTeamSliders, 100);
                }
            })();
        </script>
    @endpush
@endonce
