// ==========================================
// GTM ENTEGRE WHATSAPP TRACKING
// ==========================================

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
        'element_text': element.querySelector('.wa__member_name')?.textContent.trim() || element.querySelector('.contact-name')?.textContent.trim() || 'WhatsApp Contact',
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

// Popup Açma/Kapama
let popupOpenTime = null;
let isPopupOpen = false;

function toggleWhatsAppPopup() {
    const popup = document.getElementById('whatsappPopup');
    isPopupOpen = !isPopupOpen;

    if (isPopupOpen) {
        popup.classList.add('active');
        popupOpenTime = Date.now();
        trackWhatsAppPopupOpenDetailed();
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

// Popup Açılış Tracking (Detaylı)
function trackWhatsAppPopupOpenDetailed() {
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

// Popup Kapanış Tracking
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

// Sayfa yüklendiğinde popup'ı izlemeye hazır hale getir
document.addEventListener('DOMContentLoaded', function () {
    console.log('WhatsApp tracking initialized');

    // Tüm WhatsApp linklerini otomatik izle (fallback)
    const waLinks = document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"], a[href*="api.whatsapp.com"]');
    waLinks.forEach(function (link, index) {
        if (!link.hasAttribute('onclick')) {
            link.addEventListener('click', function () {
                const phone = this.href.match(/phone=(\d+)|wa\.me\/(\d+)/)?.[1] ||
                    this.href.match(/phone=(\d+)|wa\.me\/(\d+)/)?.[2] ||
                    'unknown';
                trackWhatsAppClick(this, 'auto_detected_' + index, phone, 'general');
            });
        }
    });

    // Popup dışına tıklandığında kapat
    document.addEventListener('click', function (event) {
        const popup = document.getElementById('whatsappPopup');
        const button = document.querySelector('.whatsapp-button');

        if (popup && button && isPopupOpen &&
            !popup.contains(event.target) &&
            !button.contains(event.target)) {
            closeWhatsAppPopup();
        }
    });

    // ESC tuşu ile popup'ı kapat
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && isPopupOpen) {
            closeWhatsAppPopup();
        }
    });

    // Widget görünüm tracking
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'whatsapp_widget_view',
        'page_url': window.location.href,
        'timestamp': new Date().toISOString()
    });

    console.log('✅ WhatsApp Widget Initialized');
    console.log('📊 GTM Tracking Ready');
});

// Debug function
window.testWhatsAppTracking = function () {
    console.log('🧪 Testing WhatsApp Tracking...');
    console.log('DataLayer:', window.dataLayer);
    console.log('Current Events:', window.dataLayer.filter(e => e.event && e.event.includes('whatsapp')));
};

// Make functions global for HTML onclick attributes
window.trackWhatsAppPopupOpen = trackWhatsAppPopupOpen;
window.trackWhatsAppClick = trackWhatsAppClick;
window.toggleWhatsAppPopup = toggleWhatsAppPopup;
window.closeWhatsAppPopup = closeWhatsAppPopup;
window.trackWhatsAppPopupOpenDetailed = trackWhatsAppPopupOpenDetailed;
window.trackWhatsAppPopupClose = trackWhatsAppPopupClose;
