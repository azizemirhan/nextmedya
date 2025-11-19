<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
// WhatsApp Popup Açılışını İzleme
function trackWhatsAppPopupOpen() {
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'whatsapp_popup_open',
        'element_type': 'popup_button',
        'page_url': window.location.href,
        'timestamp': new Date().toISOString()
    });
    
    console.log('WhatsApp Popup Open Tracked:', {
        event: 'whatsapp_popup_open',
        page_url: window.location.href
    });
}

// WhatsApp Link Tıklamasını İzleme (Geliştirilmiş Versiyon)
function trackWhatsAppClick(element, position, phoneNumber, contactType) {
    window.dataLayer = window.dataLayer || [];
    
    // Telefon numarasını formatla
    const formattedPhone = phoneNumber.startsWith('+') ? phoneNumber : '+' + phoneNumber;
    
    // Event data
    const eventData = {
        'event': 'whatsapp_click',
        'whatsapp_number': formattedPhone,
        'contact_type': contactType || 'support',
        'intent': 'contact',
        'page_url': window.location.href,
        'element_position': position,
        'element_text': element.querySelector('.wa__member_name')?.textContent.trim() || 'WhatsApp Contact',
        'timestamp': new Date().toISOString(),
        // Meta CAPI için ek veriler
        'currency': 'TRY',
        'value': 25
    };
    
    // DataLayer'a push
    dataLayer.push(eventData);
    
    // Debug
    console.log('WhatsApp Click Tracked:', eventData);
    
    // Meta Pixel için (eğer varsa)
    if (typeof fbq !== 'undefined') {
        fbq('track', 'Contact', {
            contact_method: 'whatsapp',
            phone_number: formattedPhone
        });
        console.log('Facebook Pixel Contact event triggered');
    }
    
    return true;
}

// Sayfa yüklendiğinde popup'ı izlemeye hazır hale getir
document.addEventListener('DOMContentLoaded', function() {
    console.log('WhatsApp tracking initialized');
    
    // Tüm WhatsApp linklerini otomatik izle (fallback)
    const waLinks = document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"]');
    waLinks.forEach(function(link) {
        if (!link.hasAttribute('onclick')) {
            link.addEventListener('click', function() {
                const phone = this.href.match(/phone=(\d+)/)?.[1] || 'unknown';
                trackWhatsAppClick(this, 'auto_detected', phone, 'general');
            });
        }
    });
});
</script>
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

    <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XP6H673X4B"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-XP6H673X4B');
        </script>
   <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WB4GNHTX');</script>
    <!-- End Google Tag Manager -->
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

    <link rel="icon"

          href="{{ isset($settings['site_favicon']) ? asset($settings['site_favicon']->value) : '/favicon.ico' }}">

    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('site/css/footer.css') }}">

    <link rel="stylesheet" href="{{ asset('site/css/google.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/fontawesome-all.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/line-awesome.css') }}"/>

    <script src="https://cdn.jsdelivr.net/npm/icofont@1.0.0/main.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"

          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>
        /* WhatsApp Floating Button */
        .whatsapp-float-wrapper {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        /* Ana Buton */
        .whatsapp-button {
            position: relative;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: pulse 2s infinite;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }

        .whatsapp-button:active {
            transform: scale(0.95);
        }

        /* WhatsApp İkonu */
        .whatsapp-icon {
            width: 32px;
            height: 32px;
            fill: white;
        }

        /* Pulse Animasyonu */
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            }
            50% {
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.7);
            }
        }

        /* Bildirim Badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff3e4e;
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            border: 2px solid white;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Tooltip */
        .whatsapp-tooltip {
            position: absolute;
            right: 75px;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            color: #333;
            padding: 10px 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid white;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
        }

        .whatsapp-button:hover .whatsapp-tooltip {
            opacity: 1;
            visibility: visible;
            right: 70px;
        }

        /* Popup Chat Box */
        .whatsapp-popup {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 320px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8) translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .whatsapp-popup.active {
            opacity: 1;
            visibility: visible;
            transform: scale(1) translateY(0);
        }

        /* Popup Header */
        .popup-header {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            padding: 20px;
            color: white;
        }

        .popup-header-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .popup-header-subtitle {
            font-size: 13px;
            opacity: 0.9;
        }

        .popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .popup-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Popup Body */
        .popup-body {
            padding: 20px;
        }

        .popup-message {
            background: #f0f2f5;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }

        /* Contact List */
        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            transition: all 0.2s;
            border: 2px solid transparent;
        }

        .contact-item:hover {
            background: #e9f7ef;
            border-color: #25D366;
            transform: translateX(-4px);
        }

        .contact-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25D366, #128C7E);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .contact-avatar svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .contact-info {
            flex: 1;
        }

        .contact-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .contact-role {
            font-size: 12px;
            color: #666;
        }

        .contact-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: #25D366;
            margin-top: 3px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #25D366;
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .contact-arrow {
            color: #999;
            font-size: 18px;
        }

        /* Response Time Badge */
        .response-time {
            text-align: center;
            padding: 8px;
            background: #fff3cd;
            color: #856404;
            font-size: 11px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        /* Mobile Responsive */
        @media (max-width: 480px) {
            .whatsapp-float-wrapper {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-popup {
                width: calc(100vw - 40px);
                right: -10px;
            }

            .whatsapp-tooltip {
                display: none;
            }
        }

        /* Smooth Animations */
        * {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
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


<script src="

https://cdn.jsdelivr.net/npm/icofont@1.0.0/main.min.js

"></script>

<script src="{{ asset('site/js/script.js') }}"></script>

<script src="{{ asset('site/js/footer.js') }}"></script>

<script src="{{ asset('site/js/google.js') }}"></script>
<script>
// ==========================================
// GTM ENTEGRE WHATSAPP TRACKING
// ==========================================

// Popup Açma/Kapama
let popupOpenTime = null;
let isPopupOpen = false;

function toggleWhatsAppPopup() {
    const popup = document.getElementById('whatsappPopup');
    isPopupOpen = !isPopupOpen;
    
    if (isPopupOpen) {
        popup.classList.add('active');
        popupOpenTime = Date.now();
        trackWhatsAppPopupOpen();
    } else {
        popup.classList.remove('active');
        trackWhatsAppPopupClose();
    }
}

function closeWhatsAppPopup() {
    const popup = document.getElementById('whatsappPopup');
    popup.classList.remove('active');
    isPopupOpen = false;
    trackWhatsAppPopupClose();
}

// Popup dışına tıklandığında kapat
document.addEventListener('click', function(event) {
    const popup = document.getElementById('whatsappPopup');
    const button = document.querySelector('.whatsapp-button');
    
    if (isPopupOpen && 
        !popup.contains(event.target) && 
        !button.contains(event.target)) {
        closeWhatsAppPopup();
    }
});

// ==========================================
// GTM TRACKING FUNCTIONS
// ==========================================

// 1. Popup Açılış Tracking
function trackWhatsAppPopupOpen() {
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'whatsapp_popup_open',
        'element_type': 'floating_button',
        'page_url': window.location.href,
        'page_title': document.title,
        'timestamp': new Date().toISOString()
    });
    
    console.log('✅ WhatsApp Popup Opened:', {
        event: 'whatsapp_popup_open',
        page_url: window.location.href
    });
}

// 2. Popup Kapanış Tracking
function trackWhatsAppPopupClose() {
    const timeOnPopup = popupOpenTime ? Math.round((Date.now() - popupOpenTime) / 1000) : 0;
    
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'whatsapp_popup_close',
        'element_type': 'popup',
        'time_on_popup': timeOnPopup + 's',
        'page_url': window.location.href,
        'timestamp': new Date().toISOString()
    });
    
    console.log('✅ WhatsApp Popup Closed:', {
        event: 'whatsapp_popup_close',
        time_on_popup: timeOnPopup + 's'
    });
}

// 3. WhatsApp Link Click Tracking
function trackWhatsAppClick(element, position, phoneNumber, contactType) {
    const timeOnPopup = popupOpenTime ? Math.round((Date.now() - popupOpenTime) / 1000) : 0;
    const formattedPhone = phoneNumber.startsWith('+') ? phoneNumber : '+' + phoneNumber;
    
    // Contact bilgilerini al
    const contactName = element.querySelector('.contact-name')?.textContent.trim() || 'Unknown';
    const contactRole = element.querySelector('.contact-role')?.textContent.trim() || 'Unknown';
    
    // DataLayer Event
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'whatsapp_click',
        'whatsapp_number': formattedPhone,
        'contact_type': contactType,
        'contact_name': contactName,
        'contact_role': contactRole,
        'element_position': position,
        'intent': 'contact',
        'page_url': window.location.href,
        'page_title': document.title,
        'time_to_click': timeOnPopup + 's',
        'timestamp': new Date().toISOString(),
        // E-commerce tracking için
        'currency': 'TRY',
        'value': 25,
        // Meta CAPI için
        'event_source_url': window.location.href,
        'action_source': 'website'
    });
    
    console.log('✅ WhatsApp Click Tracked:', {
        event: 'whatsapp_click',
        number: formattedPhone,
        contact: contactName,
        position: position,
        time_to_click: timeOnPopup + 's'
    });
    
    // Meta Pixel tracking (eğer varsa)
    if (typeof fbq !== 'undefined') {
        fbq('track', 'Contact', {
            contact_method: 'whatsapp',
            phone_number: formattedPhone,
            content_name: contactName
        });
        console.log('✅ Facebook Pixel Contact event triggered');
    }
    
    return true;
}

// ==========================================
// SAYFA YÜKLENME TRACKING
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ WhatsApp Widget Initialized');
    console.log('📊 GTM Tracking Ready');
    
    // DataLayer hazır mı kontrol et
    window.dataLayer = window.dataLayer || [];
    
    // Widget görünüm tracking (opsiyonel)
    dataLayer.push({
        'event': 'whatsapp_widget_view',
        'page_url': window.location.href,
        'timestamp': new Date().toISOString()
    });
    
    // Tüm WhatsApp linklerini otomatik bul ve izle (fallback)
    const waLinks = document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"], a[href*="api.whatsapp.com"]');
    console.log(`🔍 Found ${waLinks.length} WhatsApp links`);
    
    waLinks.forEach(function(link, index) {
        if (!link.hasAttribute('onclick')) {
            link.addEventListener('click', function(e) {
                const phone = this.href.match(/phone=(\d+)|wa\.me\/(\d+)/)?.[1] || 
                             this.href.match(/phone=(\d+)|wa\.me\/(\d+)/)?.[2] || 
                             'unknown';
                trackWhatsAppClick(this, 'auto_detected_' + index, phone, 'general');
            });
            console.log(`✅ Auto-tracking added to link ${index + 1}`);
        }
    });
});

// ESC tuşu ile popup'ı kapat
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && isPopupOpen) {
        closeWhatsAppPopup();
    }
});

// ==========================================
// DEBUG FUNCTIONS (Test için)
// ==========================================

// Console'da test etmek için
window.testWhatsAppTracking = function() {
    console.log('🧪 Testing WhatsApp Tracking...');
    console.log('DataLayer:', window.dataLayer);
    console.log('Current Events:', window.dataLayer.filter(e => e.event && e.event.includes('whatsapp')));
};

// console'da çalıştırın: testWhatsAppTracking()
</script>
{{-- JavaScript for Advanced Coupon System with Turkish Routes --}}

@stack('scripts')

</body>

</html>