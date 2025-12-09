@php
    $footerContactPhone = data_get($settings, 'footer_contact_phone.value', data_get($settings, 'phone', '0850 811 11 22'));
    $contactEmail = data_get($settings, 'contact_email.value', data_get($settings, 'email', 'info@example.com'));
    $siteLogo = data_get($settings, 'site_logo.value');
    $whatsappNumber = data_get($settings, 'whatsapp_number.value', data_get($settings, 'phone', '905xxxxxxxxx'));
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    if(substr($whatsappClean, 0, 1) == '0') {
        $whatsappClean = '90' . substr($whatsappClean, 1);
    }
    if(strlen($whatsappClean) == 10) {
        $whatsappClean = '90' . $whatsappClean;
    }
@endphp

<!-- Mobile Top Banner -->
<div class="mobile-top-banner">
    <div class="gradient-overlay"></div>
    <div class="banner-inner">
        <div class="banner-content">
            <span>{{ __('"Medyanın Geleceği Geleceğin Medyası"') }}</span>
        </div>
        <div class="banner-actions">
            <a href="{{ route('meeting-request.show') }}" class="banner-btn">
                {{ __('Toplantı Planla') }}
            </a>
            <a href="{{ route('service-request.show') }}" class="banner-btn ghost">
                {{ __('Bilgi Al') }}
            </a>
        </div>
    </div>
</div>

<!-- Desktop Top Banner -->
<div class="desktop-top-banner">
    <div class="gradient-overlay"></div>
    <div class="container">
        <div class="banner-inner">
            <div class="banner-content">
                <span>{{ __('"Medyanın Geleceği Geleceğin Medyası"') }}</span>
            </div>
            <div class="banner-actions">
                <a href="{{ route('meeting-request.show') }}" class="banner-btn">
                    <i class="far fa-calendar-check"></i> {{ __('Toplantı Planla') }}
                </a>
                <a href="{{ route('service-request.show') }}" class="banner-btn ghost">
                    <i class="fas fa-clipboard-list"></i> {{ __('Bilgi Al') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Top Bar (Desktop) -->
<div class="top-bar desktop-only">
    <div class="container">
        <div class="top-bar-content">
            <div class="top-bar-left">
                <span class="promo-icon"><i class="fas fa-bullseye"></i></span>
                <span class="promo-text">{{ __('%70\'e Varan İndirimle E-Ticaret Paketleri') }}</span>
            </div>
            <div class="top-bar-right">
                <a href="tel:{{ str_replace(['(', ')', ' '], '', $footerContactPhone) }}" class="phone-link">
                    <span class="link-icon"><i class="fas fa-phone"></i></span>
                    <span>{{ $footerContactPhone }}</span>
                </a>
                <a href="#" class="cta-link">
                    <span class="link-icon"><i class="fas fa-headset"></i></span>
                    <span>{{ __('Sizi Arayalım') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <a href="{{ route('frontend.home') }}">
                    <img src="{{ asset($siteLogo) }}" alt="{{ config('app.name') }}" width="200" height="50" style="width: 200px; height: auto;">
                </a>
            </div>

            {{-- Dinamik Menü --}}
            @if(isset($mainMenu))
                {!! \App\Models\Menu::renderByPlacement('header', 'desktop', 'frontend.partials._menu') !!}
            @else
                <ul class="nav-menu desktop-only">
                    <li class="nav-item">
                        <a href="#" class="nav-link">{{ __('Menü Bulunamadı') }}</a>
                    </li>
                </ul>
            @endif

            <div class="header-actions desktop-only">
                <button class="search-toggle-btn" id="searchToggle" aria-label="{{ __('Arama Yap') }}">
                    <i class="fas fa-search"></i>
                </button>
{{--                <button class="btn-secondary">{{ __('Giriş Yap') }}</button>--}}
                <a href="{{ route('service-request.show') }}" class="btn-primary">
                    {{ __('Bilgi Al') }}
                </a>
                </a>
            </div>

            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="{{ __('Menüyü Aç/Kapat') }}">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </div>
</header>

<!-- Search Modal -->
<div class="search-modal" id="searchModal">
    <div class="search-modal-overlay" id="searchModalOverlay"></div>
    <div class="search-modal-content">
        <button class="search-modal-close" id="searchModalClose">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="search-modal-title">{{ __('Ne aramak istiyorsunuz?') }}</h2>
        <form class="search-modal-form" method="get" action="{{ route('frontend.search') }}">
            <div class="search-input-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input
                        type="search"
                        name="s"
                        placeholder="{{ __('Aramak istediğiniz kelimeyi yazın...') }}"
                        class="search-modal-input"
                        autocomplete="off"
                >
                <button type="submit" class="search-modal-submit">
                    {{ __('Ara') }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Mobile Sidebar Menu -->
<div class="mobile-sidebar" id="mobileSidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset($siteLogo) }}" alt="{{ config('app.name') }}" width="150" height="40" style="width: 150px; height: auto;">
        </div>
        <div class="sidebar-flags">
            @if(isset($activeLanguages) && $activeLanguages->count() > 1)
                @foreach($activeLanguages as $code => $lang)
                    @php $flagCode = $code == 'en' ? 'gb' : $code; @endphp
                    <a href="{{ route('language.swap', $code) }}"
                       class="flag-btn {{ $code == app()->getLocale() ? 'active' : '' }}">
                        <img src="{{ asset('flag-icons-main/flags/1x1/'.$flagCode.'.svg') }}"
                             alt="{{ $lang['native'] }}"
                             width="20">
                    </a>
                @endforeach
            @endif
            <button class="close-sidebar" id="closeSidebar">✕</button>
        </div>
    </div>

    <div class="sidebar-tagline">
        {{ __('Dijital dünyada her adımınızda yanınızdayız!') }}
    </div>

    {{-- Mobil Menü --}}
    @if(isset($mainMenu))
        {!! \App\Models\Menu::renderByPlacement('header', 'mobile', 'frontend.partials._menu') !!}
    @else
        <div class="sidebar-menu">
            <div class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <span>{{ __('Menü Bulunamadı') }}</span>
                </a>
            </div>
        </div>
    @endif

    <div class="sidebar-bottom">
        <div class="team-section">
            <h3>{{ __('Dijital Dünyada') }}</h3>
            <p><strong>{{ __('Tüm Adımlarınızda Yanınızdayız!') }}</strong></p>
            <div class="team-avatars">
                <div class="avatar-circle">
                    <img src="{{ asset('emirhan.webp') }}" loading="lazy" width="150" height="150" alt="{{ __('Emirhan Özdemir') }}">
                </div>
                <div class="avatar-circle">
                    <img src="{{ asset('demirhan.webp') }}" loading="lazy" width="150" height="150" alt="{{ __('Demirhan Özdemir') }}">
                </div>
            </div>
        </div>

        <div class="sidebar-actions">
            <a href="{{ route('service-request.show') }}" class="sidebar-btn primary">
                <span class="btn-icon"><i class="fas fa-clipboard-list"></i></span>
                {{ __('Bilgi Al') }}
            </a>
            <a href="{{ route('meeting-request.show') }}" class="sidebar-btn secondary">
                <span class="btn-icon"><i class="fas fa-calendar-check"></i></span>
                {{ __('Toplantı Planla') }}
            </a>
        </div>
    </div>
</div>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>