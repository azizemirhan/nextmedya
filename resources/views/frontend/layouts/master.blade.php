<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(request()->cookie('gtm_tracking') == 'submitted')
        <script>
        // GTM Data Layer Push - Form Submit Success via Cookie
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'event': 'lead_form_submit',
            'form_id': 'contact_form',
            'form_name': 'İletişim Formu',
            'form_type': '{{ request()->cookie("gtm_form_type") }}',
            'lead_type': 'contact_inquiry',
            'page_url': '{{ url()->current() }}',
            'event_id': '{{ request()->cookie("gtm_event_id") }}',
            'value': {{ request()->cookie('gtm_value', 50) }},
            'currency': '{{ request()->cookie("gtm_currency", "TRY") }}',
            'lead_source': 'website_contact_form',
            'user_data': {!! request()->cookie('gtm_user_data', '{}') !!}, // Yeni!
            @auth
            'authenticated_user_data': {!! json_encode($gtmUser) !!},
            @endauth
        });
        
        // Cookie'leri temizle
        document.cookie = "gtm_tracking=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "gtm_user_data=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        
        console.log('GTM Lead Form Submit Event Fired via Cookie:', {
            event: 'lead_form_submit',
            event_id: '{{ request()->cookie("gtm_event_id") }}',
            value: {{ request()->cookie('gtm_value', 50) }}
        });
        </script>
    @endif

    <!-- DNS Prefetch & Preconnect for Performance -->
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.google-analytics.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Analytics - Deferred -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
    </script>

    <!-- Google Tag Manager - Deferred -->
    <!-- Google Tag Manager - Lazy Loaded (Interaction/Timeout) -->
    <script>
        // Define GTM ID
        const gtmId = 'GTM-WB4GNHTX';
        
        // Flag to prevent double firing
        let gtmLoaded = false;
        
        // Main GTM Loader Function
        function loadGTM() {
            if (gtmLoaded) return;
            gtmLoaded = true;
            
            // Standard GTM Snippet with dynamic injection
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer', gtmId);
            
            // Remove listeners to clean up
            window.removeEventListener('mousemove', loadGTM);
            window.removeEventListener('scroll', loadGTM);
            window.removeEventListener('touchstart', loadGTM);
        }

        // Add Event Listeners for User Interaction
        window.addEventListener('mousemove', loadGTM, {once: true});
        window.addEventListener('scroll', loadGTM, {once: true});
        window.addEventListener('touchstart', loadGTM, {once: true});

        // Fallback: Load after 4 seconds if no interaction
        setTimeout(loadGTM, 4000);
    </script>
    @hasSection ('page_meta')

        @yield('page_meta')

    @else

        @isset($page)

            <title>{{ $page->getTranslation('seo_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale()) }}</title>

            <meta name="description" content="{{ $page->getTranslation('meta_description', app()->getLocale()) }}">

            <meta name="keywords" content="{{ $page->getTranslation('keywords', app()->getLocale()) }}">

            <meta name="robots" content="{{ $page->index_status }},{{ $page->follow_status }}">

            <link rel="canonical" href="{{ $page->canonical_url ?: url()->current() }}"/>

            <meta property="og:title"

                  content="{{ $page->getTranslation('og_title', app()->getLocale()) ?: $page->getTranslation('seo_title', app()->getLocale()) }}"/>

            <meta property="og:description"

                  content="{{ $page->getTranslation('og_description', app()->getLocale()) ?: $page->getTranslation('meta_description', app()->getLocale()) }}"/>

            @if($page->og_image)

                <meta property="og:image" content="{{ asset($page->og_image) }}"/>

            @endif

        @else

            <title>{{ $settings['site_title']->value[app()->getLocale()] ?? config('app.name') }}</title>

            <meta name="description" content="{{ $settings['site_description']->value[app()->getLocale()] ?? '' }}">

        @endif

        <meta property="og:type" content="website"/>

        <meta property="og:url" content="{{ url()->current() }}"/>

    @endif



    @if(!empty($settings['google_site_verification']->value))

        <meta name="google-site-verification" content="{{ $settings['google_site_verification']->value }}"/>

    @endif

    @if(!empty($settings['bing_site_verification']->value))

        <meta name="msvalidate.01" content="{{ $settings['bing_site_verification']->value }}"/>

    @endif

    @if(!empty($settings['yandex_site_verification']->value))

        <meta name="yandex-verification" content="{{ $settings['yandex_site_verification']->value }}"/>

    @endif

    <link rel="icon" href="{{ isset($settings['site_favicon']) ? asset($settings['site_favicon']->value) : '/favicon.ico' }}">

    <!-- Font Preloading for Critical Performance -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"></noscript>

    <!-- Page-specific preload hints (for LCP optimization) -->
    @stack('preload')

    <!-- Critical CSS - Inline for Above-the-Fold Content -->
    <style>
        /* Critical above-the-fold styles */
        body{margin:0;font-family:'Inter',system-ui,-apple-system,sans-serif;-webkit-font-smoothing:antialiased}
        .container{max-width:1200px;margin:0 auto;padding:0 15px}
        img{max-width:100%;height:auto}
    </style>

    <!-- Bootstrap CSS - Deferred with media trick -->
    <!-- Bootstrap CSS - Local Build with PurgeCSS -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <!-- Main CSS - Deferred -->
    <link rel="preload" href="{{ asset('site/css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('site/css/mega-menu-enhanced.css') }}">
    <link rel="preload" href="{{ asset('site/css/footer.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('site/css/google.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Icon Fonts - Deferred (Consolidated FontAwesome only) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <!-- WhatsApp Widget CSS - Deferred -->
    <link rel="preload" href="{{ asset('site/css/whatsapp-widget.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Fallback for browsers that don't support preload -->
    <script>
        !function(e){"use strict";var t=function(t,n,o){var i,r=e.document,a=r.createElement("link");if(n)i=n;else{var l=(r.body||r.getElementsByTagName("head")[0]).childNodes;i=l[l.length-1]}var d=r.styleSheets;a.rel="stylesheet",a.href=t,a.media="only x",function e(t){if(r.body)return t();setTimeout(function(){e(t)})}(function(){i.parentNode.insertBefore(a,n?i:i.nextSibling)});var f=function(e){for(var t=a.href,n=d.length;n--;)if(d[n].href===t)return e();setTimeout(function(){f(e)})};return a.addEventListener&&a.addEventListener("load",function(){this.media=o||"all"}),a.onloadcssdefined=f,f(function(){a.media!==o&&(a.media=o)}),a};"undefined"!=typeof exports?exports.loadCSS=t:e.loadCSS=t}("undefined"!=typeof global?global:this);
    </script>
    @stack('styles')

</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WB4GNHTX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

@include('frontend.layouts._header')


@if (!Route::is('frontend.home', 'frontend.home.text', 'frontend.services.show', 'blog.index', 'blog.show', 'blog.category', 'frontend.search'))

    <x-page-banner :title="$pageTitle ?? 'Next Medya'" :subtitle="$pageSubtitle ?? ''"/>

@endif

@yield('content')

@include('frontend.layouts._footer')

@auth('admin')

    @include('admin.bar')

@endauth
<div class="whatsapp-float-wrapper">
    <!-- Tooltip -->
    <div class="whatsapp-tooltip">
        Bize WhatsApp'tan yazın!
    </div>

    <!-- Main Button -->
    <div class="whatsapp-button" onclick="toggleWhatsAppPopup()">
        <!-- WhatsApp Icon SVG -->
        <svg class="whatsapp-icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 0c-8.837 0-16 7.163-16 16 0 2.825 0.737 5.607 2.137 8.048l-2.137 7.952 7.933-2.127c2.42 1.37 5.173 2.127 8.067 2.127 8.837 0 16-7.163 16-16s-7.163-16-16-16zM16 29.467c-2.482 0-4.908-0.646-7.07-1.87l-0.507-0.292-5.247 1.408 1.417-5.267-0.325-0.528c-1.302-2.144-1.989-4.599-1.989-7.109 0-7.369 5.996-13.365 13.365-13.365s13.365 5.996 13.365 13.365c0 7.369-5.996 13.365-13.365 13.365zM22.918 19.669c-0.297-0.149-1.757-0.867-2.029-0.967s-0.47-0.149-0.669 0.149c-0.198 0.297-0.768 0.967-0.941 1.166s-0.347 0.223-0.644 0.074c-0.297-0.149-1.255-0.462-2.39-1.475-0.883-0.788-1.48-1.761-1.653-2.059s-0.018-0.458 0.13-0.606c0.134-0.133 0.297-0.347 0.446-0.521s0.198-0.297 0.297-0.496c0.099-0.198 0.050-0.372-0.025-0.521s-0.669-1.612-0.916-2.207c-0.242-0.579-0.487-0.5-0.669-0.51-0.173-0.008-0.372-0.01-0.571-0.01s-0.52 0.074-0.793 0.372c-0.272 0.297-1.040 1.016-1.040 2.479s1.065 2.876 1.213 3.074c0.149 0.198 2.095 3.2 5.076 4.487 0.709 0.306 1.263 0.489 1.694 0.626 0.712 0.226 1.36 0.194 1.872 0.118 0.571-0.085 1.758-0.719 2.006-1.413s0.248-1.289 0.173-1.413c-0.074-0.124-0.272-0.198-0.57-0.347z"/>
        </svg>

        <!-- Notification Badge -->
        <span class="notification-badge">1</span>
    </div>

    <!-- Popup Chat Box -->
    <div class="whatsapp-popup" id="whatsappPopup">
        <!-- Header -->
        <div class="popup-header">
            <button class="popup-close" onclick="closeWhatsAppPopup()">✕</button>
            <div class="popup-header-title">
                <svg width="20" height="20" viewBox="0 0 32 32" fill="white">
                    <path d="M16 0c-8.837 0-16 7.163-16 16 0 2.825 0.737 5.607 2.137 8.048l-2.137 7.952 7.933-2.127c2.42 1.37 5.173 2.127 8.067 2.127 8.837 0 16-7.163 16-16s-7.163-16-16-16z"/>
                </svg>
                WhatsApp Destek
            </div>
            <div class="popup-header-subtitle">
                Size nasıl yardımcı olabiliriz?
            </div>
        </div>

        <!-- Body -->
        <div class="popup-body">
            <div class="popup-message">
                👋 Merhaba! Sorularınız için buradayız. Size en kısa sürede dönüş yapacağız.
            </div>

            <div class="response-time">
                ⚡ Ortalama yanıt süresi: ~5 dakika
            </div>

            <!-- Contact List -->
            <div class="contact-list">
                <!-- Contact 1 -->
                <a href="https://wa.me/905300215291?text=Merhaba,%20yardım%20almak%20istiyorum" 
                   class="contact-item" 
                   target="_blank"
                   onclick="trackWhatsAppClick(this, 'popup_contact_1', '905300215291', 'sales_team'); return true;">
                    <div class="contact-avatar">
                        <svg viewBox="0 0 24 24" fill="white">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">Satış Ekibi</div>
                        <div class="contact-role">Ürün ve Hizmetler</div>
                        <div class="contact-status">
                            <span class="status-dot"></span>
                            <span>Çevrimiçi</span>
                        </div>
                    </div>
                    <div class="contact-arrow">›</div>
                </a>

                <!-- Contact 2 -->
                <a href="https://wa.me/905300215291?text=Merhaba,%20teknik%20destek%20almak%20istiyorum" 
                   class="contact-item" 
                   target="_blank"
                   onclick="trackWhatsAppClick(this, 'popup_contact_2', '905050267127', 'support_team'); return true;">
                    <div class="contact-avatar">
                        <svg viewBox="0 0 24 24" fill="white">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
                        </svg>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">Teknik Destek</div>
                        <div class="contact-role">7/24 Yardım Hattı</div>
                        <div class="contact-status">
                            <span class="status-dot"></span>
                            <span>Çevrimiçi</span>
                        </div>
                    </div>
                    <div class="contact-arrow">›</div>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript - All Deferred for Performance -->
<!-- Bundled via Vite (resources/js/app.js) -->

<!-- Mega Menu Enhanced JS -->
<script defer src="{{ asset('site/js/mega-menu-enhanced.js') }}"></script>

<!-- Google Analytics Script - Deferred -->
<script defer src="https://www.googletagmanager.com/gtag/js?id=G-XP6H673X4B"></script>
<script defer>
    window.addEventListener('load', function() {
        if (typeof gtag !== 'undefined') {
            gtag('js', new Date());
            gtag('config', 'G-XP6H673X4B');
        }
    });
</script>
{{-- JavaScript for Advanced Coupon System with Turkish Routes --}}
@stack('scripts')
</body>
</html>