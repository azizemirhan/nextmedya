@php
    $site_logo = data_get($settings, 'site_logo.value', 'logo');
    $headerTopEmail = data_get($settings, 'contact_email.value', 'info@example.com');
    $headerTopPhone = data_get($settings, 'footer_contact_phone.value', '+90 555 123 45 67');
    $socialFacebook = data_get($settings, 'social_facebook.value', 'https://facebook.com/');
    $socialTwitter = data_get($settings, 'social_twitter.value', 'https://twitter.com/');
    $socialInstagram = data_get($settings, 'social_instagram.value', 'https://instagram.com/');
    $socialLinkedin = data_get($settings, 'social_linkedin.value', 'https://linkedin.com/');
@endphp

    <!-- Skip to Content (Accessibility) -->
<a href="#main-content" class="skip-to-content">{{ __('Skip to main content') }}</a>

<!-- Announcement Bar -->
<div class="announcement-bar" id="announcementBar">
    🎉 {{ data_get($settings, 'announcement_text.value', 'Özel Fırsat: İlk 3 ay %50 indirim!') }}
    <button class="announcement-close" onclick="closeAnnouncement()">✕</button>
</div>

<!-- Scroll Progress -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Header Top -->
<div class="header-top">
    <div class="header-top-container">
        <div class="welcome-text">
            {{ data_get($settings, 'header_welcome_text.value', 'Welcome To Professional Creative Agency') }}
        </div>
        <div class="header-contact">
            <a href="mailto:{{ $headerTopEmail }}" class="contact-item">
                <span class="contact-icon"><i class="fa-regular fa-envelope"></i></span>
                {{ $headerTopEmail }}
            </a>
            <a href="tel:{{ str_replace(' ', '', $headerTopPhone) }}" class="contact-item">
                <span class="contact-icon"><i class="fa-solid fa-phone-volume"></i></span>
                {{ $headerTopPhone }}
            </a>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header site-header" id="mainHeader">
    <div class="header-container">
        <nav class="navbar">
            <!-- Logo -->
            <div class="header-logo">
                <a href="{{ route('frontend.home') }}" class="logo">

                    <div class="logo-text">
                        <img src="{{ asset($site_logo) }}" width="150">
                    </div>
                </a>
            </div>

            <!-- Navigation Menu -->
            <div class="nav-menu" data-phone="{{ $headerTopPhone }}" data-email="{{ $headerTopEmail }}">
                @if(isset($mainMenu))
                    {!! \App\Models\Menu::renderByPlacement('header') !!}
                @else
                    <ul class="nav-menu">
                        <li class="nav-item"><a href="#" class="nav-link">{{ __('Menu Not Found') }}</a></li>
                    </ul>
                @endif
            </div>

            <!-- Header Actions -->
            <div class="header-actions header-extras">
                <!-- Language Selector -->
                @if(isset($activeLanguages) && $activeLanguages->count() > 1)
                    <div class="language-selector language-switcher">
                        <div class="language-btn current-language" data-tooltip="{{ __('Dil Değiştirme') }}">
                            @php
                                $currentLocale = app()->getLocale();
                                $currentFlagCode = $currentLocale == 'en' ? 'gb' : $currentLocale;
                                $currentLangData = $activeLanguages->get($currentLocale);
                            @endphp
                            <img src="{{ asset('flag-icons-main/flags/1x1/'.$currentFlagCode.'.svg') }}"
                                 alt="{{ $currentLocale }}"
                                 style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;">
                            {{ strtoupper($currentLocale) }}
                        </div>
                        <div class="language-dropdown dropdown-menu">
                            @foreach($activeLanguages as $code => $lang)
                                <a href="{{ route('language.swap', $code) }}"
                                   class="language-option dropdown-item {{ $code == app()->getLocale() ? 'active' : '' }}">
                                    @php
                                        $flagCode = $code == 'en' ? 'gb' : $code;
                                    @endphp
                                    <img src="{{ asset('flag-icons-main/flags/1x1/'.$flagCode.'.svg') }}"
                                         alt="{{ $lang['native'] }}"
                                         style="width: 18px; height: 18px; border-radius: 50%; object-fit: cover; margin-right: 8px;">
                                    {{ $lang['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

{{--                <!-- Social Links -->--}}
{{--                <div class="social-links">--}}
{{--                    <a href="{{ $socialFacebook }}" class="social-link" data-tooltip="Facebook" target="_blank">f</a>--}}
{{--                    <a href="{{ $socialInstagram }}" class="social-link" data-tooltip="Instagram" target="_blank">📷</a>--}}
{{--                    <a href="{{ $socialLinkedin }}" class="social-link" data-tooltip="LinkedIn" target="_blank">in</a>--}}
{{--                </div>--}}

                <!-- Mobile Toggle -->
                <button class="mobile-toggle mobile-menu-toggle" id="mobileToggle" aria-label="{{ __('Toggle Menu') }}">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </div>

    <!-- Particles -->
    <div class="header-particles">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 1s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 1s;"></div>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <button type="button" class="nav-close" aria-label="{{ __('Close Menu') }}"
            onclick="document.getElementById('mobileToggle').click()">
        <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>

    <ul class="mobile-nav-list">
        @if(isset($mainMenu) && is_iterable($mainMenu))
            @foreach($mainMenu as $item)
                @if(is_object($item))
                    @include('frontend.partials._mobile_submenu', ['item' => $item])
                @endif
            @endforeach
        @else
            <li class="mobile-nav-item">
                <a href="#" class="mobile-nav-link">{{ __('Menu Not Found') }}</a>
            </li>
        @endif
    </ul>

    <div class="mobile-contact">
        <h4>{{ __('Contact') }}</h4>
        <a href="mailto:{{ $headerTopEmail }}" class="mobile-contact-item">
            <i class="fa-solid fa-user"></i>
            {{ $headerTopEmail }}
        </a>
        <a href="tel:{{ str_replace(' ', '', $headerTopPhone) }}" class="mobile-contact-item">
            <i class="fa-solid fa-phone-volume"></i>
            {{ $headerTopPhone }}
        </a>
    </div>

    <div class="mobile-social">
        <a href="{{ $socialFacebook }}" class="social-link" target="_blank">f</a>
        <a href="{{ $socialTwitter }}" class="social-link" target="_blank">𝕏</a>
        <a href="{{ $socialInstagram }}" class="social-link" target="_blank">📷</a>
        <a href="{{ $socialLinkedin }}" class="social-link" target="_blank">in</a>
    </div>
</div>

<!-- Context Menu -->
<div class="context-menu" id="contextMenu">
    <div class="context-menu-item" onclick="handleContextAction('new-tab')">
        <span>🔗</span>
        {{ __('Open in New Tab') }}
    </div>
    <div class="context-menu-item" onclick="handleContextAction('copy')">
        <span>📋</span>
        {{ __('Copy Link') }}
    </div>
    <div class="context-menu-divider"></div>
    <div class="context-menu-item" onclick="handleContextAction('share')">
        <span>📤</span>
        {{ __('Share') }}
    </div>
    <div class="context-menu-item" onclick="handleContextAction('bookmark')">
        <span>⭐</span>
        {{ __('Add to Favorites') }}
    </div>
</div>
