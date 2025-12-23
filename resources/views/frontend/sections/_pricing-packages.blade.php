@php
    // Gelen veriyi güvenli bir değişkene alalım (Veri yoksa boş dizi olsun)
    $data = $content ?? [];

    // --- KUPON KODLARI TANIMLAMASI (Sorunu Çözen Kısım) ---
    // Veri dizisinden 'coupon_codes' anahtarını alıyoruz.
    // Eğer anahtar yoksa veya null ise boş dizi [] atıyoruz.
    $couponCodes = $data['coupon_codes'] ?? [];
    // -------------------------------------------------------

    // Diğer değişkenleri de güvenli şekilde tanımlayalım
    $sectionTitle = $data['section_title'][app()->getLocale()] ?? 'Web Sitesi Paketleri';
    $brandsTitle = $data['brands_title'][app()->getLocale()] ?? 'Altyapı Teknolojileri';
    
    // Promo Alanları
    $promoTitle = $data['promo_title'][app()->getLocale()] ?? '';
    $promoSubtitle = $data['promo_subtitle'][app()->getLocale()] ?? '';
    $promoDescription = $data['promo_description'][app()->getLocale()] ?? '';
    
    // Tarih ve Ayarlar
    $countdownEndDate = $data['countdown_end_date'] ?? now()->addDays(1)->format('Y-m-d H:i:s');
    $couponEnabled = $data['coupon_enabled'] ?? false;
    
    $couponPlaceholder = $data['coupon_placeholder'][app()->getLocale()] ?? 'Kupon Kodu';
    $couponButtonText = $data['coupon_button_text'][app()->getLocale()] ?? 'Uygula';

    // Paketler ve Markalar
    $packages = $data['packages'] ?? [];
    $brands = $data['brands'] ?? [];
@endphp
<section class="next-pricing-section" id="nextPricingSection">

    <div class="next-promo-banner" id="nextPromoBanner">
        <div class="next-promo-content">
            <h2 class="next-promo-title">{{ $promoTitle }}</h2>
            <p class="next-promo-subtitle">{{ $promoSubtitle }}</p>
            <p class="next-promo-description">{{ $promoDescription }}</p>
            
            {{-- Kupon Kodu Alanı --}}
            @if($couponEnabled)
                <div class="next-coupon-container">
                    <div class="next-coupon-input-wrapper">
                        <input type="text" 
                               id="nextCouponInput" 
                               class="next-coupon-input" 
                               placeholder="{{ $couponPlaceholder }}" 
                               maxlength="20">
                        <button type="button" 
                                id="nextApplyCoupon" 
                                class="next-coupon-btn">
                            {{ $couponButtonText }}
                        </button>
                    </div>
                    <div id="nextCouponMessage" class="next-coupon-message"></div>
                </div>
            @endif
        </div>

        {{-- Countdown JavaScript ile dinamik olarak doldurulacağı varsayılıyor. Sadece yapıyı tutuyoruz. --}}
        <div class="next-countdown-wrapper" id="nextCountdown">
            <div class="next-countdown-item">
                <span class="next-countdown-number">0</span>
                <span class="next-countdown-label">Gün</span>
            </div>
            <div class="next-countdown-item">
                <span class="next-countdown-number">0</span>
                <span class="next-countdown-label">Saat</span>
            </div>
            <div class="next-countdown-item">
                <span class="next-countdown-number">0</span>
                <span class="next-countdown-label">Dakika</span>
            </div>
            <div class="next-countdown-item">
                <span class="next-countdown-number">0</span>
                <span class="next-countdown-label">Saniye</span>
            </div>
        </div>
    </div>

    @if (!empty($packages))
        <div class="next-packages-container" id="nextPackagesContainer">

            @foreach($packages as $package)
                @php
                    // Paket detayları
                    $packageName = data_get($package, 'package_name.' . app()->getLocale());
                    $packagePrice = data_get($package, 'package_price', '0');
                    $priceCurrency = data_get($package, 'price_currency', '₺');
                    $pricePeriod = data_get($package, 'price_period.' . app()->getLocale(), '/aylık');
                    $priceOld = data_get($package, 'price_old.' . app()->getLocale());
                    $priceNew = data_get($package, 'price_new.' . app()->getLocale());
                    $packageExtra = data_get($package, 'package_extra.' . app()->getLocale());
                    $isFeatured = data_get($package, 'is_featured', false);
                    $featuredBadgeText = data_get($package, 'featured_badge_text.' . app()->getLocale(), 'En Popüler');
                    $callButtonText = data_get($package, 'call_button_text.' . app()->getLocale(), 'Sizi Arayalım');
                    $whatsappNumber = data_get($package, 'whatsapp_number', '905555555555'); // WhatsApp numarası
                    $whatsappMessage = data_get($package, 'whatsapp_message.' . app()->getLocale(), 'Merhaba, %s paketi hakkında bilgi almak istiyorum.'); // WhatsApp mesajı

                    // İç içe repeater'lar
                    $features = $package['features'] ?? [];
                    $techLogos = $package['tech_logos'] ?? [];
                    $techTitle = data_get($package, 'tech_title.' . app()->getLocale(), 'Altyapı Teknolojileri');

                    // CSS Sınıfları
                    $cardClass = 'next-package-card';
                    if ($isFeatured) {
                        $cardClass .= ' next-package-featured';
                    }
                @endphp

                <div class="{{ $cardClass }}" data-package-index="{{ $loop->index }}">
                    @if($isFeatured)
                        <div class="next-featured-badge">{{ $featuredBadgeText }}</div>
                    @endif

                    <div class="next-package-header">
                        <h3 class="next-package-name">{{ $packageName }}</h3>
                        {{-- Sizi Arayalım butonu (WhatsApp'a yönlendirme) --}}
                        <button class="next-call-button" 
                                data-whatsapp-number="{{ $whatsappNumber }}" 
                                data-whatsapp-message="{{ sprintf($whatsappMessage, $packageName) }}"
                                onclick="openWhatsApp(this)">
                            <svg class="next-call-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            {{ $callButtonText }}
                        </button>
                    </div>

                    <div class="next-price-wrapper">
                        <div class="next-price-main">
                            <span class="next-price-currency">{{ $priceCurrency }}</span>
                            <span class="next-price-amount" 
                                  data-original-price="{{ $packagePrice }}" 
                                  data-package-index="{{ $loop->index }}">{{ $packagePrice }}</span>
                            <span class="next-price-period">{{ $pricePeriod }}</span>
                        </div>
                        
                        {{-- İndirim Badge (gizli, kupon uygulandığında gösterilecek) --}}
                        <div class="next-discount-badge" id="discountBadge{{ $loop->index }}" style="display: none;">
                            <span class="next-discount-text"></span>
                        </div>

                        {{-- Orijinal fiyat çizgili gösterimi --}}
                        <div class="next-original-price" id="originalPrice{{ $loop->index }}" style="display: none;">
                            <span class="next-price-strikethrough"></span>
                        </div>

                        @if($priceOld)
                            <p class="next-price-installment">
                                <span class="next-price-old">{{ $priceOld }}</span>
                            </p>
                        @endif
                        @if($priceNew)
                            <p class="next-price-installment">
                                <span class="next-price-new">{{ $priceNew }}</span>
                            </p>
                        @endif
                    </div>

                    @if($packageExtra)
                        <div class="next-package-extra">
                            {!! $packageExtra !!}
                        </div>
                    @endif

                    <ul class="next-features-list">
                        @foreach($features as $feature)
                            @php
                                $featureText = data_get($feature, 'feature_text.' . app()->getLocale());
                                $featureDescription = data_get($feature, 'feature_description.' . app()->getLocale(), '');
                                $isNew = data_get($feature, 'is_new', false);
                                $isPro = data_get($feature, 'is_pro', false);
                                $badgeText = '';
                                if ($isNew) $badgeText = 'YENİ';
                                if ($isPro) $badgeText = 'PRO';
                            @endphp

                            <li class="next-feature-item">
                                <span class="next-feature-icon">✓</span>
                                <span class="next-feature-content">
                                    {{ $featureText }}
                                    @if($isNew || $isPro)
                                        <span class="next-feature-badge">{{ $badgeText }}</span>
                                    @endif
                                    @if($featureDescription)
                                        <button class="next-feature-info-btn" 
                                                data-feature-title="{{ $featureText }}" 
                                                data-feature-description="{{ $featureDescription }}"
                                                onclick="openFeatureModal(this)"
                                                aria-label="{{ __('Detaylı Bilgi: :feature', ['feature' => $featureText]) }}">
                                            <svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    @if (!empty($techLogos))
                        <div class="next-tech-section">
                            <h3 class="next-tech-title">{{ $techTitle }}</h3>
                            <div class="next-tech-logos">
                                @foreach($techLogos as $techLogo)
                                    @php
                                        $logoFile = data_get($techLogo, 'tech_logo_text');
                                        $imageUrl = $logoFile ? asset($logoFile) : 'https://via.placeholder.com/60x30/cccccc/333333?text=LOGO';
                                        $techLogoAltText = data_get($techLogo, 'tech_alt_text.' . app()->getLocale());
                                    @endphp
                                    <div class="next-tech-logo-link">
                                        <img src="{{ $imageUrl }}" alt="{{ $techLogoAltText }}" class="next-tech-logo">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</section>

{{-- Feature Modal --}}
<div id="featureModal" class="next-feature-modal" style="display: none;">
    
    <div class="next-feature-modal-content">
        <div class="next-feature-modal-header">
            <h3 id="featureModalTitle"></h3>
            <button class="next-feature-modal-close" onclick="closeFeatureModal()">
                <svg viewBox="0 0 20 20" fill="currentColor" width="24" height="24">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="next-feature-modal-body">
            <div id="featureModalDescription"></div>
        </div>
    </div>
</div>

<style>
    /* Existing styles remain the same */
    .next-pricing-section {
        padding: 60px 20px;
        position: relative;
        overflow: hidden;
    }

    .next-promo-banner {
        linear-gradient(135deg, #00d2ff 0%, #3a47d5 100%);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 30px;
        animation: slideDown 0.8s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .next-promo-content {
        flex: 1;
        min-width: 300px;
    }

    .next-promo-title {
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 10px 0;
        line-height: 1.2;
    }

    .next-promo-subtitle {
        font-size: 26px;
        color: #fff;
        margin: 0 0 10px 0;
    }

    .next-promo-description {
        font-size: 20px;
        color: #fff;
        margin: 0 0 20px 0;
    }

    .next-coupon-container {
        margin-top: 20px;
    }

    .next-coupon-input-wrapper {
        display: flex;
        gap: 10px;
        max-width: 400px;
    }

    .next-coupon-input {
        flex: 1;
        padding: 12px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        transition: all 0.3s ease;
        background: #fff;
    }

    .next-coupon-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .next-coupon-input:disabled {
        background: #f7fafc;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .next-coupon-btn {
        padding: 12px 30px;
        background: #48bb78;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .next-coupon-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
    }

    .next-coupon-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .next-coupon-message {
        margin-top: 10px;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        display: none;
    }

    .next-coupon-message.success {
        background: #c6f6d5;
        color: #22543d;
        border: 1px solid #9ae6b4;
        display: block;
    }

    .next-coupon-message.error {
        background: #fed7d7;
        color: #742a2a;
        border: 1px solid #fc8181;
        display: block;
    }

    .next-countdown-wrapper {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .next-countdown-item {
        
        padding: 15px 20px;
        border-radius: 12px;
        text-align: center;
        min-width: 70px;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .next-countdown-number {
        display: block;
        font-size: 28px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }

    .next-countdown-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .next-packages-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .next-package-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: relative;
        transition: all 0.4s ease;
        overflow: hidden;
    }

    .next-package-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(135deg, #0e1327 0%, #1e40af 50%, #3b82f6 100%);
    }

    .next-package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .next-package-featured {
        border: 3px solid #0d6efd;
        transform: scale(1.05);
    }

    .next-featured-badge {
        position: absolute;
        top: 20px;
        right: -30px;
        background: #fbbf24;
        color: #78350f;
        padding: 5px 40px;
        font-size: 12px;
        font-weight: 800;
        transform: rotate(45deg);
        box-shadow: 0 5px 10px rgba(251, 191, 36, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .next-package-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .next-package-name {
        font-size: 24px;
        font-weight: 800;
        color: #1a202c;
        margin: 0;
    }

    .next-call-button {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 8px 15px;
        background: #48bb78;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .next-call-button:hover {
        background: #38a169;
        transform: translateY(-2px);
    }

    .next-call-icon {
        width: 16px;
        height: 16px;
    }

    .next-price-wrapper {
        margin-bottom: 25px;
    }

    .next-price-main {
        display: flex;
        align-items: baseline;
        gap: 5px;
        margin-bottom: 10px;
    }

    .next-price-currency {
        font-size: 24px;
        font-weight: 700;
        color: #4a5568;
    }

    .next-price-amount {
        font-size: 48px;
        font-weight: 900;
        color: #1a202c;
        line-height: 1;
    }

    .next-price-period {
        font-size: 16px;
        color: #718096;
        font-weight: 600;
    }

    .next-discount-badge {
        display: inline-block;
        background: #48bb78;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        margin-top: 8px;
    }

    .next-original-price {
        margin-top: 5px;
    }

    .next-price-strikethrough {
        font-size: 18px;
        color: #a0aec0;
        text-decoration: line-through;
    }

    .next-price-installment {
        font-size: 14px;
        color: #718096;
        margin: 5px 0;
    }

    .next-price-old {
        display: inline-block;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
    }

    .next-price-new {
        color: #48bb78;
        font-weight: 700;
    }

    .next-package-extra {
        background: #f7fafc;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #4a5568;
    }

    .next-features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
    }

    .next-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 6px 0;
        border-bottom: 1px solid #e2e8f0;
        font-size: 15px;
        color: #2d3748;
    }

    .next-feature-item:last-child {
        border-bottom: none;
    }

    .next-feature-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        background: #48bb78;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        margin-top: 2px;
    }

    .next-feature-content {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .next-feature-badge {
        display: inline-block;
        background: linear-gradient(135deg, #0e1327 0%, #1e40af 50%, #3b82f6 100%);
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .next-feature-info-btn {
        flex-shrink: 0;
        background: transparent;
        border: none;
        color: #3b82f6;
        cursor: pointer;
        padding: 2px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border-radius: 50%;
    }

    .next-feature-info-btn:hover {
        background: #eff6ff;
        color: #2563eb;
    }

    .next-tech-section {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid #e2e8f0;
    }

    .next-tech-title {
        font-size: 16px;
        font-weight: 700;
        color: #2d3748;
        margin: 0 0 15px 0;
    }

    .next-tech-logos {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
    }

    .next-tech-logo-link {
        display: block;
        transition: transform 0.3s ease;
    }

    .next-tech-logo-link:hover {
        transform: scale(1.1);
    }

    .next-tech-logo {
        height: 80px;
        width: auto;
        filter: grayscale(100%);
        opacity: 0.6;
        transition: all 0.3s ease;
    }

    .next-tech-logo:hover {
        filter: grayscale(0%);
        opacity: 1;
    }

    .next-brands-section {
        margin-top: 60px;
        text-align: center;
    }

    .next-brands-title {
        font-size: 28px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 30px;
    }

    .next-brands-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .next-brand-item {
        display: block;
        transition: transform 0.3s ease;
    }

    .next-brand-item:hover {
        transform: scale(1.1);
    }

    .next-brand-item img {
        height: 50px;
        width: auto;
        filter: brightness(0) invert(1);
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .next-brand-item:hover img {
        opacity: 1;
    }

    /* Feature Modal Styles */
    .next-feature-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .next-feature-modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        animation: fadeIn 0.3s ease;
    }

    .next-feature-modal-content {
        position: relative;
        background: white;
        border-radius: 20px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        animation: modalSlideIn 0.3s ease;
    }

    .next-feature-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 25px 30px;
        border-bottom: 2px solid #e2e8f0;
    }

    .next-feature-modal-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        color: #1a202c;
    }

    .next-feature-modal-close {
        background: transparent;
        border: none;
        color: #718096;
        cursor: pointer;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .next-feature-modal-close:hover {
        background: #f7fafc;
        color: #2d3748;
    }

    .next-feature-modal-body {
        padding: 30px;
    }

    .next-feature-modal-body p {
        font-size: 16px;
        line-height: 1.8;
        color: #4a5568;
        margin: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .next-pricing-section {
            padding: 40px 15px;
        }

        .next-promo-banner {
            padding: 25px;
            flex-direction: column;
        }

        .next-promo-title {
            font-size: 24px;
        }

        .next-coupon-input-wrapper {
            flex-direction: column;
        }

        .next-countdown-wrapper {
            justify-content: center;
        }

        .next-packages-container {
            grid-template-columns: 1fr;
        }

        .next-package-featured {
            transform: scale(1);
        }

        .next-package-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .next-price-amount {
            font-size: 36px;
        }
    }

    /* Additional Animations */
    @keyframes confettiFall {
        0% {
            opacity: 1;
            transform: translateY(-20px) scale(0) rotate(0deg);
        }
        25% {
            opacity: 1;
            transform: translateY(100px) scale(1) rotate(90deg);
        }
        50% {
            opacity: 1;
            transform: translateY(300px) scale(1.1) rotate(180deg);
        }
        75% {
            opacity: 0.8;
            transform: translateY(500px) scale(0.9) rotate(270deg);
        }
        100% {
            opacity: 0;
            transform: translateY(100vh) scale(0.5) rotate(360deg);
        }
    }

    .spinner {
        display: inline-block;
        width: 12px;
        height: 12px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .next-total-savings {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: #fff;
        padding: 15px 25px;
        border-radius: 15px;
        margin-top: 15px;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        animation: bounceIn 0.6s ease;
        box-shadow: 0 5px 20px rgba(72, 187, 120, 0.3);
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .next-total-savings i:first-child {
        font-size: 18px;
        animation: wiggle 2s infinite;
    }

    .next-total-savings i:last-child {
        font-size: 16px;
    }

    @keyframes wiggle {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        75% { transform: rotate(10deg); }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3) translateY(20px);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .next-coupon-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .next-price-amount.updating {
        animation: priceUpdate 0.5s ease;
    }

    @keyframes priceUpdate {
        0% { transform: scale(1); color: inherit; }
        50% { transform: scale(1.05); color: #48bb78; }
        100% { transform: scale(1); color: inherit; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // LocalStorage Key
        const COUPON_STORAGE_KEY = 'applied_coupon_data';
        const COUPON_APPLIED_FLAG = 'coupon_applied_once';

        // Kupon kodlarını backend'den al
        const fallbackCouponCodes = @json($couponCodes);

        // DOM Elements
        const couponInput = document.getElementById('nextCouponInput');
        const applyCouponBtn = document.getElementById('nextApplyCoupon');
        const couponMessage = document.getElementById('nextCouponMessage');
        const priceElements = document.querySelectorAll('.next-price-amount');

        let appliedCoupon = null;
        let isProcessing = false;

        // WhatsApp fonksiyonu
        window.openWhatsApp = function(button) {
            const number = button.dataset.whatsappNumber;
            const message = button.dataset.whatsappMessage;
            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${number}?text=${encodedMessage}`;
            window.open(whatsappUrl, '_blank');
        };

        // Feature Modal fonksiyonları
        window.openFeatureModal = function(button) {
            const title = button.dataset.featureTitle;
            const description = button.dataset.featureDescription;
            
            document.getElementById('featureModalTitle').textContent = title;
            document.getElementById('featureModalDescription').innerHTML = description;
            document.getElementById('featureModal').style.display = 'flex';
            
            // Animasyon için body overflow hidden
            document.body.style.overflow = 'hidden';
        };

        window.closeFeatureModal = function() {
            document.getElementById('featureModal').style.display = 'none';
            document.body.style.overflow = '';
        };

        // ESC tuşu ile modal kapatma
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFeatureModal();
            }
        });

        // Sayfa yüklendiğinde kaydedilmiş kuponu kontrol et
        function loadSavedCoupon() {
            try {
                const savedCoupon = localStorage.getItem(COUPON_STORAGE_KEY);
                const couponApplied = localStorage.getItem(COUPON_APPLIED_FLAG);
                
                if (savedCoupon && couponApplied === 'true') {
                    const couponData = JSON.parse(savedCoupon);
                    appliedCoupon = couponData;
                    
                    // UI'ı güncelle
                    if (couponInput) {
                        couponInput.value = couponData.code;
                        couponInput.disabled = true;
                    }
                    
                    if (applyCouponBtn) {
                        applyCouponBtn.textContent = '✓ Uygulandı';
                        applyCouponBtn.disabled = true;
                    }
                    
                    // Fiyatları güncelle
                    applyDiscountToUI(couponData);
                    
                    // Başarı mesajını göster
                    showCouponMessage(`Kupon uygulandı: ${couponData.name}`, 'success');
                    
                    console.log('✅ Kaydedilmiş kupon yüklendi:', couponData.code);
                }
            } catch (error) {
                console.error('Kupon yükleme hatası:', error);
                // Hatalı veri varsa temizle
                localStorage.removeItem(COUPON_STORAGE_KEY);
                localStorage.removeItem(COUPON_APPLIED_FLAG);
            }
        }

        // Sayfa yüklendiğinde kaydedilmiş kuponu yükle
        loadSavedCoupon();

        // Kupon uygulama fonksiyonu
        async function applyCoupon() {
            // Kupon zaten uygulanmışsa
            if (localStorage.getItem(COUPON_APPLIED_FLAG) === 'true') {
                showCouponMessage('Kupon zaten uygulanmış!', 'error');
                return;
            }

            if (isProcessing) return;

            const couponCode = couponInput.value.trim().toUpperCase();
            
            if (!couponCode) {
                showCouponMessage('Lütfen bir kupon kodu girin', 'error');
                return;
            }

            isProcessing = true;
            applyCouponBtn.disabled = true;
            applyCouponBtn.innerHTML = '<span class="spinner"></span>';

            // Paket fiyatlarını topla
            const packagePrices = Array.from(priceElements).map(el => 
                parseFloat(el.dataset.originalPrice) || 0
            );

            try {
                const response = await fetch('/api/validate-coupon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        coupon_code: couponCode,
                        package_prices: packagePrices
                    })
                });

                const data = await response.json();

                if (data.success) {
                    appliedCoupon = {
                        code: data.coupon.code,
                        name: data.coupon.name,
                        discount_type: data.coupon.discount_type,
                        discount_amount: data.coupon.discount_amount,
                        discounted_prices: data.discounted_prices,
                        savings: data.savings
                    };

                    // LocalStorage'a kaydet
                    localStorage.setItem(COUPON_STORAGE_KEY, JSON.stringify(appliedCoupon));
                    localStorage.setItem(COUPON_APPLIED_FLAG, 'true');

                    // UI'ı güncelle
                    applyDiscountToUI(appliedCoupon);
                    
                    // İnput'u devre dışı bırak
                    couponInput.disabled = true;
                    applyCouponBtn.textContent = '✓ Uygulandı';
                    applyCouponBtn.disabled = true;

                    // Başarı mesajını göster - data.message kullanıldı (FİX #1)
                    showCouponMessage(data.message, 'success');

                    // Confetti animasyonu
                    createConfetti();

                    console.log('✅ Kupon başarıyla uygulandı ve kaydedildi');
                } else {
                    // Hata mesajını göster - data.message kullanıldı (FİX #1)
                    showCouponMessage(data.message, 'error');
                }
            } catch (error) {
                console.error('Kupon doğrulama hatası:', error);
                showCouponMessage('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
            } finally {
                isProcessing = false;
                if (!appliedCoupon) {
                    applyCouponBtn.disabled = false;
                    applyCouponBtn.textContent = '{{ $couponButtonText }}';
                }
            }
        }

        // İndirimi UI'a uygula
        function applyDiscountToUI(couponData) {
            priceElements.forEach((el, index) => {
                const originalPrice = parseFloat(el.dataset.originalPrice);
                const discountedPrice = couponData.discounted_prices[index];
                
                if (discountedPrice !== undefined && discountedPrice < originalPrice) {
                    // Fiyatı güncelle
                    el.textContent = discountedPrice.toFixed(2);
                    el.classList.add('updating');
                    
                    // İndirim badge'ini göster
                    const discountBadge = document.getElementById(`discountBadge${index}`);
                    if (discountBadge) {
                        const discountPercent = ((originalPrice - discountedPrice) / originalPrice * 100).toFixed(0);
                        discountBadge.querySelector('.next-discount-text').textContent = `%${discountPercent} İndirim`;
                        discountBadge.style.display = 'block';
                    }
                    
                    // Orijinal fiyatı çizgili göster
                    const originalPriceEl = document.getElementById(`originalPrice${index}`);
                    if (originalPriceEl) {
                        originalPriceEl.querySelector('.next-price-strikethrough').textContent = `₺${originalPrice}`;
                        originalPriceEl.style.display = 'block';
                    }
                    
                    setTimeout(() => el.classList.remove('updating'), 500);
                }
            });

            // Toplam tasarrufu göster
            if (couponData.savings > 0) {
                showTotalSavings(couponData.savings);
            }
        }

        // Kupon mesajını göster
        function showCouponMessage(message, type) {
            couponMessage.textContent = message;
            couponMessage.className = `next-coupon-message ${type}`;
            couponMessage.style.display = 'block';

            setTimeout(() => {
                couponMessage.style.display = 'none';
            }, 5000);
        }

        // Toplam tasarrufu göster
        function showTotalSavings(savings) {
            const existingSavings = document.querySelector('.next-total-savings');
            if (existingSavings) {
                existingSavings.remove();
            }

            const savingsEl = document.createElement('div');
            savingsEl.className = 'next-total-savings';
            savingsEl.innerHTML = `
                <i>🎉</i>
                <span>Toplam Tasarruf: ₺${savings.toFixed(2)}</span>
                <i>💰</i>
            `;

            couponMessage.parentElement.appendChild(savingsEl);

            setTimeout(() => {
                savingsEl.style.opacity = '1';
                savingsEl.style.transform = 'translateY(0)';
            }, 100);
        }

        // Kuponu sıfırla (sadece geliştirme için)
        function resetCoupon() {
            appliedCoupon = null;
            localStorage.removeItem(COUPON_STORAGE_KEY);
            localStorage.removeItem(COUPON_APPLIED_FLAG);
            
            // UI'ı sıfırla
            if (couponInput) {
                couponInput.value = '';
                couponInput.disabled = false;
            }
            
            if (applyCouponBtn) {
                applyCouponBtn.textContent = '{{ $couponButtonText }}';
                applyCouponBtn.disabled = false;
            }

            // Fiyatları orijinal haline döndür
            priceElements.forEach((el, index) => {
                const originalPrice = el.dataset.originalPrice;
                el.textContent = originalPrice;
                
                const discountBadge = document.getElementById(`discountBadge${index}`);
                if (discountBadge) discountBadge.style.display = 'none';
                
                const originalPriceEl = document.getElementById(`originalPrice${index}`);
                if (originalPriceEl) originalPriceEl.style.display = 'none';
            });

            // Tasarruf bilgisini kaldır
            const savingsEl = document.querySelector('.next-total-savings');
            if (savingsEl) savingsEl.remove();
        }

        // Confetti animasyonu
        function createConfetti() {
            const colors = ['#fbbf24', '#48bb78', '#3b82f6', '#ef4444', '#8b5cf6'];
            const confettiCount = 50;
            
            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * window.innerWidth + 'px';
                confetti.style.top = '-20px';
                confetti.style.opacity = '1';
                confetti.style.pointerEvents = 'none';
                confetti.style.animation = `confettiFall ${2 + Math.random() * 2}s ease-out forwards`;
                confetti.style.zIndex = '9999';
                
                document.body.appendChild(confetti);
                
                setTimeout(() => confetti.remove(), 4000);
            }
        }

        // Event Listeners
        if (applyCouponBtn) {
            applyCouponBtn.addEventListener('click', applyCoupon);
        }

        if (couponInput) {
            couponInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyCoupon();
                }
            });

            // Çift tıklayınca kupon sıfırla (geliştirici için)
            couponInput.addEventListener('dblclick', function() {
                if (appliedCoupon && window.location.hostname === 'localhost') {
                    resetCoupon();
                    showCouponMessage('Kupon kaldırıldı (Dev Mode)', 'error');
                }
            });

            // Focus olduğunda placeholder animasyonu
            couponInput.addEventListener('focus', function() {
                this.style.borderColor = '#3b82f6';
            });

            couponInput.addEventListener('blur', function() {
                this.style.borderColor = '';
            });
        }

        // Klavye kısayolları (geliştirici için - localhost'ta)
        document.addEventListener('keydown', function(e) {
            // CTRL + SHIFT + R = Reset coupons (development)
            if (e.ctrlKey && e.shiftKey && e.key === 'R' && window.location.hostname === 'localhost') {
                resetCoupon();
                console.log('🔄 Kuponlar sıfırlandı (Dev shortcut)');
                showCouponMessage('Kuponlar sıfırlandı (Dev Mode)', 'error');
                e.preventDefault();
            }
        });

        // Development ortamında console'a kupon bilgilerini yazdır
        if (window.location.hostname === 'localhost' || window.location.hostname.includes('127.0.0.1') || window.location.hostname.includes('.test')) {
            console.log('🎁 Mevcut Kupon Kodları:', fallbackCouponCodes.map(c => ({
                kod: c.coupon_code,
                indirim: `${c.discount_amount}${c.discount_type === 'percent' ? '%' : '₺'}`,
                aktif: c.is_active ? '✅' : '❌',
                gecerlilikTarihi: c.valid_until || 'Sınırsız',
                minimumTutar: c.minimum_amount || 0
            })));
            
            console.log('🔧 Geliştirici İpuçları:');
            console.log('- Kupon sıfırlamak için: CTRL + SHIFT + R');
            console.log('- Input\'a çift tıklayarak mevcut kuponu kaldırabilirsiniz (sadece localhost)');
        }

        // Countdown Timer
        function updateCountdown() {
            const countdownDate = '{{ $countdownEndDate }}';
            const targetDate = new Date(countdownDate.replace(' ', 'T')).getTime();
            const now = new Date().getTime();
            const distance = targetDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const countdownItems = document.querySelectorAll('.next-countdown-number');
            if (countdownItems.length >= 4) {
                countdownItems[0].textContent = days;
                countdownItems[1].textContent = hours;
                countdownItems[2].textContent = minutes;
                countdownItems[3].textContent = seconds;
            }

            if (distance < 0) {
                clearInterval(countdownInterval);
                const promoBanner = document.querySelector('.next-promo-banner');
                if (promoBanner) {
                    promoBanner.style.opacity = '0.7';
                    setTimeout(() => {
                        promoBanner.style.display = 'none';
                    }, 1000);
                }
            }
        }

        const countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown();

        // Card animations
        const cards = document.querySelectorAll('.next-package-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150 + 300);
        });
    });
</script>