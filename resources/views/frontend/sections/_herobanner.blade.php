@php
    // Badge
    $badgeIcon = data_get($content, 'badge_icon', 'fas fa-trophy');
    $badgeText = data_get($content, 'badge_text.' . app()->getLocale(), 'Türkiye\'nin #1 Dijital Ajansı');

    // Ana Başlık
    $mainTitlePart1 = data_get($content, 'main_title_part1.' . app()->getLocale(), 'Dijitalleşmeye');
    $mainTitlePart2 = data_get($content, 'main_title_part2.' . app()->getLocale(), 'Hazır Mısınız?');

    // Açıklama
    $description = data_get($content, 'description.' . app()->getLocale(), 'Türkiye\'nin en iyi müşteri hizmetlerine sahip ödüllü dijital ajans.');

    // İstatistikler
    $stats = data_get($content, 'stats', []);
    if (is_string($stats)) {
        $stats = json_decode($stats, true) ?? [];
    }
    
    // Varsayılan istatistikler
    if (empty($stats)) {
        $stats = [
            ['stat_number' => '36.000+', 'stat_label' => ['tr' => 'Mutlu Müşteri', 'en' => 'Happy Customers']],
            ['stat_number' => '₺2.3M+', 'stat_label' => ['tr' => 'Toplam Satış', 'en' => 'Total Sales']],
            ['stat_number' => '%99.9', 'stat_label' => ['tr' => 'Uptime Oranı', 'en' => 'Uptime Rate']],
        ];
    }

    // Butonlar
    $button1Text = data_get($content, 'button1_text.' . app()->getLocale(), 'Hemen Başlayın');
    $button1Icon = data_get($content, 'button1_icon', 'fas fa-rocket');
    $button1Link = data_get($content, 'button1_link', '#');
    
    $button2Text = data_get($content, 'button2_text.' . app()->getLocale(), 'Sizi Arayalım');
    $button2Icon = data_get($content, 'button2_icon', 'fas fa-comments');
    $button2Link = data_get($content, 'button2_link', '#contact');

    // Güven Badge'leri
    $trustText = data_get($content, 'trust_text.' . app()->getLocale(), 'Güvenilir Ortaklarımız:');
    $brandLogos = data_get($content, 'brand_logos', []);
    if (is_string($brandLogos)) {
        $brandLogos = json_decode($brandLogos, true) ?? [];
    }

    // Floating Cards
    $floatingCards = data_get($content, 'floating_cards', []);
    if (is_string($floatingCards)) {
        $floatingCards = json_decode($floatingCards, true) ?? [];
    }
    
    // Varsayılan floating cards
    if (empty($floatingCards)) {
        $floatingCards = [
            [
                'card_icon' => 'fas fa-chart-line',
                'card_value' => ['tr' => '+%90', 'en' => '+90%'],
                'card_label' => ['tr' => 'Seo Sıralama Artışı', 'en' => 'SEO Ranking Increase'],
                'card_position' => 'card-1'
            ],
            [
                'card_icon' => 'fas fa-users',
                'card_value' => ['tr' => 'Yeni', 'en' => 'New'],
                'card_label' => ['tr' => 'Müşteriler Edinin', 'en' => 'Müşteriler Edinin'],
                'card_position' => 'card-2'
            ]
        ];
    }

    // Video Ayarları - YENİ EKLENEN BÖLÜM
    $displayType = data_get($content, 'display_type', 'dashboard'); // 'dashboard' veya 'video'
    $videoUrl = data_get($content, 'hero_video_url', '');
    $videoFile = data_get($content, 'hero_video_file', '');
    $videoAutoplay = data_get($content, 'video_autoplay', '1');
    $videoMuted = data_get($content, 'video_muted', '1');
    $videoLoop = data_get($content, 'video_loop', '1');
    $videoControls = data_get($content, 'video_controls', '0');

    // Görsel Ayarları
    $gradientColor1 = data_get($content, 'background_gradient_color1', '#667eea');
    $gradientColor2 = data_get($content, 'background_gradient_color2', '#764ba2');
@endphp

<section class="hero-banner">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                {{-- Badge --}}
                <div class="hero-badge" data-aos="fade-down" data-aos-delay="100">
                    <span class="badge-icon"><i class="{{ $badgeIcon }}"></i></span>
                    <span>{{ $badgeText }}</span>
                </div>

                {{-- Ana Başlık --}}
                <h1 class="hero-title" data-aos="fade-up" data-aos-delay="200">
                    {{ $mainTitlePart1 }}<br>
                    <span class="highlight">{{ $mainTitlePart2 }}</span>
                </h1>

                {{-- Açıklama --}}
                <p class="hero-description" data-aos="fade-up" data-aos-delay="300">
                    {{ $description }}
                </p>

                {{-- İstatistikler --}}
                @if(!empty($stats))
                    <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
                        @foreach($stats as $stat)
                            <div class="stat-item">
                                <span class="stat-number">{{ data_get($stat, 'stat_number') }}</span>
                                <span class="stat-label">{{ data_get($stat, 'stat_label.' . app()->getLocale()) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Butonlar --}}
                <div class="hero-actions" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ $button1Link }}" class="btn-large-primary">
                        <i class="{{ $button1Icon }}"></i> {{ $button1Text }}
                    </a>
                    <a href="{{ $button2Link }}" class="btn-large-secondary">
                        <i class="{{ $button2Icon }}"></i> {{ $button2Text }}
                    </a>
                </div>

                {{-- Güven Badge'leri --}}
                @if(!empty($brandLogos))
                    <div class="trust-badges" data-aos="fade-up" data-aos-delay="600">
                        <span class="trust-text">{{ $trustText }}</span>
                        <div class="brand-logos">
                            @foreach($brandLogos as $logo)
                                @if(data_get($logo, 'logo_image'))
                                    <img src="{{ asset(data_get($logo, 'logo_image')) }}"
                                         alt="{{ data_get($logo, 'logo_alt.' . app()->getLocale(), 'Brand Logo') }}"
                                         class="brand-logo">
                                @else
                                    <span class="brand-logo">{{ data_get($logo, 'logo_alt.' . app()->getLocale(), 'LOGO') }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Görsel Alan --}}
            <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                <div class="visual-container">
                    {{-- Floating Cards --}}
                    @foreach($floatingCards as $index => $card)
                        <div class="floating-card {{ data_get($card, 'card_position', 'card-' . ($index + 1)) }}"
                             data-aos="zoom-in"
                             data-aos-delay="{{ 600 + ($index * 100) }}">
                            <div class="card-icon">
                                <i class="{{ data_get($card, 'card_icon', 'fas fa-chart-line') }}"></i>
                            </div>
                            <div class="card-text">
                                <span class="card-value">{{ data_get($card, 'card_value.' . app()->getLocale()) }}</span>
                                <span class="card-label">{{ data_get($card, 'card_label.' . app()->getLocale()) }}</span>
                            </div>
                        </div>
                    @endforeach

                    {{-- Ana İçerik: Video veya Dashboard --}}
                    <div class="main-visual">
                        @if($displayType === 'video' && ($videoUrl || $videoFile))
                            {{-- Video Player --}}
                            <div class="hero-video-container">
                                @if($videoUrl)
                                    {{-- YouTube/Vimeo Embed --}}
                                    @php
                                        $embedUrl = '';
                                        $autoplayParam = $videoAutoplay == '1' ? '1' : '0';
                                        $muteParam = $videoMuted == '1' ? '1' : '0';
                                        $loopParam = $videoLoop == '1' ? '1' : '0';

                                        // YouTube URL düzenleme
                                        if(strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false) {
                                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches);
                                            $videoId = $matches[1] ?? '';
                                            if($videoId) {
                                                $embedUrl = "https://www.youtube.com/embed/{$videoId}?autoplay={$autoplayParam}&mute={$muteParam}&loop={$loopParam}&playlist={$videoId}&rel=0&modestbranding=1";
                                            }
                                        }
                                        // Vimeo URL düzenleme
                                        elseif(strpos($videoUrl, 'vimeo.com') !== false) {
                                            preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches);
                                            $videoId = $matches[1] ?? '';
                                            if($videoId) {
                                                $embedUrl = "https://player.vimeo.com/video/{$videoId}?autoplay={$autoplayParam}&muted={$muteParam}&loop={$loopParam}&background=1";
                                            }
                                        }
                                    @endphp

                                    @if($embedUrl)
                                        <iframe
                                                src="{{ $embedUrl }}"
                                                class="hero-video-iframe"
                                                frameborder="0"
                                                allow="autoplay; fullscreen; picture-in-picture"
                                                allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="video-error">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <p>Geçersiz video URL'si</p>
                                        </div>
                                    @endif
                                @elseif($videoFile)
                                    {{-- Yerli Video Dosyası --}}
                                    <video
                                            class="hero-video-file"
                                            {{ $videoAutoplay == '1' ? 'autoplay' : '' }}
                                            {{ $videoMuted == '1' ? 'muted' : '' }}
                                            {{ $videoLoop == '1' ? 'loop' : '' }}
                                            {{ $videoControls == '1' ? 'controls' : '' }}
                                            playsinline>
                                        <source src="{{ asset($videoFile) }}" type="video/mp4">
                                        Tarayıcınız video etiketini desteklemiyor.
                                    </video>
                                @endif

                                {{-- Video Overlay (İsteğe bağlı) --}}
                                <div class="video-overlay"></div>
                            </div>
                        @else
                            {{-- Dashboard Preview (Varsayılan) --}}
                            <div class="dashboard-preview">
                                <div class="dashboard-header">
                                    <span class="dot red"></span>
                                    <span class="dot yellow"></span>
                                    <span class="dot green"></span>
                                </div>
                                <div class="dashboard-content">
                                    <div class="chart-container">
                                        <div class="chart-bar" style="height: 40%"></div>
                                        <div class="chart-bar" style="height: 65%"></div>
                                        <div class="chart-bar" style="height: 55%"></div>
                                        <div class="chart-bar" style="height: 80%"></div>
                                        <div class="chart-bar" style="height: 90%"></div>
                                        <div class="chart-bar" style="height: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Dekoratif Şekiller --}}
                    <div class="decorative-elements">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Animated Background --}}
    <div class="hero-background">
        <div class="gradient-bg" style="background: linear-gradient(135deg, {{ $gradientColor1 }} 0%, {{ $gradientColor2 }} 100%);"></div>
        <div class="pattern-overlay"></div>
    </div>
</section>