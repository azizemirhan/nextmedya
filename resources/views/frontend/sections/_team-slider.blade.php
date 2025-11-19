@php
    // Statik başlıklar ve repeater alanı için CMS'ten gelen verileri alıyoruz.
    $smallTitle  = data_get($content, 'small_title.' . app()->getLocale(), 'Our Skilled Team');
    $mainTitle   = data_get($content, 'main_title.' . app()->getLocale(), 'Meet The Expert Team');
    $teamMembers = collect(data_get($content, 'team_members', []));
@endphp

{{-- Sadece gösterilecek ekip üyesi varsa bölümü render et --}}
@if($teamMembers->isNotEmpty())
    <section class="team-section">
        <div class="container">
            {{-- Bölüm Başlıkları --}}
            <div class="section-header">
                <span class="eyebrow">{{ $smallTitle }}</span>
                <h2 class="section-title">{{ $mainTitle }}</h2>
            </div>

            <div class="team-slider-container">
                <div class="team-slider" id="teamSlider">
                    {{-- Ekip Üyelerini Döngüye Al --}}
                    @foreach($teamMembers as $member)
                        @php
                            // Her bir üye için verileri hazırla
                            $name     = data_get($member, 'name.' . app()->getLocale());
                            $position = data_get($member, 'position.' . app()->getLocale());
                            $photo    = asset(data_get($member, 'photo'));

                            // Sosyal medya linklerini bir diziye ata
                            $socials = [
                                ['key' => data_get($member, 'facebook_url'), 'icon' => 'fa-facebook-f', 'label' => 'Facebook'],
                                ['key' => data_get($member, 'twitter_url'),  'icon' => 'fa-twitter',      'label' => 'Twitter'],
                                ['key' => data_get($member, 'linkedin_url'), 'icon' => 'fa-linkedin-in',  'label' => 'LinkedIn'],
                            ];
                        @endphp

                        <article class="team-card">
                            <div class="media-wrap">
                                <img
                                    class="team-photo"
                                    src="{{ $photo }}"
                                    alt="{{ $name }}"
                                    loading="lazy"
                                >
                                <div class="overlay-gradient"></div>

                                {{-- Sosyal Medya İkonları --}}
                                <ul class="social-links">
                                    @foreach($socials as $social)
                                        @if(!empty($social['key']))
                                            <li>
                                                <a href="{{ $social['key'] }}" class="social-link" target="_blank" rel="noopener" aria-label="{{ $name }}'s {{ $social['label'] }} profile">
                                                    <i class="fab {{ $social['icon'] }}"></i>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
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
                <button class="nav-btn" id="prevBtn" aria-label="Previous team member">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn" id="nextBtn" aria-label="Next team member">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            {{-- İlerleme Çubuğu --}}
            <div class="progress-indicator">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        </div>
    </section>
@endif
