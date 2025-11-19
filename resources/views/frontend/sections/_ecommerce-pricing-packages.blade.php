@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $showAnnualDiscount = data_get($content, 'show_annual_discount', true);
    $annualDiscountText = data_get($content, 'annual_discount_text.' . app()->getLocale(), '');
    $packages = data_get($content, 'packages', []);
@endphp

<section class="nextmedya-pricing-packages">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                @if($sectionSubtitle)
                    <span class="nextmedya-pricing-badge">{{ $sectionSubtitle }}</span>
                @endif
                <h2 class="nextmedya-pricing-title">{{ $sectionTitle }}</h2>
            </div>
        </div>

        <!-- Billing Toggle -->
        @if($showAnnualDiscount)
            <div class="row">
                <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="nextmedya-billing-toggle">
                        <span class="nextmedya-billing-label">Aylık</span>
                        <label class="nextmedya-toggle-switch">
                            <input type="checkbox" id="billingToggle">
                            <span class="nextmedya-toggle-slider"></span>
                        </label>
                        <span class="nextmedya-billing-label">Yıllık</span>
                        @if($annualDiscountText)
                            <span class="nextmedya-discount-badge">{{ $annualDiscountText }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Pricing Cards -->
        <div class="row nextmedya-pricing-row">
            @foreach($packages as $index => $package)
                @php
                    $packageName = data_get($package, 'package_name.' . app()->getLocale());
                    $packageBadge = data_get($package, 'package_badge.' . app()->getLocale());
                    $showBadge = data_get($package, 'show_badge', false);
                    $packageIcon = data_get($package, 'package_icon', 'fas fa-store');
                    $packageDescription = data_get($package, 'package_description.' . app()->getLocale());
                    $monthlyPrice = data_get($package, 'monthly_price');
                    $annualPrice = data_get($package, 'annual_price');
                    $currency = data_get($package, 'currency', '₺');
                    $highlight = data_get($package, 'highlight', false);
                    $buttonText = data_get($package, 'button_text.' . app()->getLocale());
                    $buttonUrl = data_get($package, 'button_url', '#contact');
                    $features = data_get($package, 'features', []);
                @endphp

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="nextmedya-pricing-card {{ $highlight ? 'highlighted' : '' }}">
                        @if($showBadge && $packageBadge)
                            <div class="nextmedya-package-badge">{{ $packageBadge }}</div>
                        @endif

                        <div class="nextmedya-package-header">
                            <div class="nextmedya-package-icon">
                                <i class="{{ $packageIcon }}"></i>
                            </div>
                            <h3 class="nextmedya-package-name">{{ $packageName }}</h3>
                            <p class="nextmedya-package-description">{!! $packageDescription !!}</p>
                        </div>

                        <div class="nextmedya-package-price">
                            <div class="nextmedya-price-wrapper">
                                <span class="nextmedya-price-currency">{{ $currency }}</span>
                                <span class="nextmedya-price-amount" data-monthly="{{ $monthlyPrice }}" data-annual="{{ $annualPrice }}">
                                    {{ $monthlyPrice }}
                                </span>
                                <span class="nextmedya-price-period">/ay</span>
                            </div>
                        </div>

                        <div class="nextmedya-package-features">
                            @foreach($features as $feature)
                                @php
                                    $featureText = data_get($feature, 'feature_text.' . app()->getLocale());
                                    $isIncluded = data_get($feature, 'is_included', true);
                                    $featureTooltip = data_get($feature, 'feature_tooltip.' . app()->getLocale());
                                @endphp
                                <div class="nextmedya-feature-item {{ $isIncluded ? 'included' : 'not-included' }}">
                                    <i class="fas fa-{{ $isIncluded ? 'check-circle' : 'times-circle' }}"></i>
                                    <span>{{ $featureText }}</span>
                                    @if($featureTooltip)
                                        <i class="fas fa-info-circle nextmedya-tooltip-icon"
                                           data-bs-toggle="tooltip"
                                           title="{{ $featureTooltip }}"></i>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="nextmedya-package-action">
                            <a href="{{ $buttonUrl }}" class="nextmedya-package-btn">
                                {{ $buttonText }}
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Additional Info -->
        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="nextmedya-pricing-footer">
                    <p class="nextmedya-pricing-note">
                        <i class="fas fa-shield-alt"></i>
                        Tüm paketlerde 30 gün para iade garantisi • SSL sertifikası dahil • 7/24 teknik destek
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-pricing-packages {
            padding: 100px 0;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .nextmedya-pricing-badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .nextmedya-pricing-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 60px;
        }

        /* Billing Toggle */
        .nextmedya-billing-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 60px;
            padding: 20px;
            background: #ffffff;
            border-radius: 50px;
            display: inline-flex;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .nextmedya-billing-label {
            font-size: 1rem;
            font-weight: 600;
            color: #64748b;
            transition: color 0.3s ease;
        }

        .nextmedya-toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            margin: 0;
            cursor: pointer;
        }

        .nextmedya-toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .nextmedya-toggle-slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #cbd5e1;
            border-radius: 50px;
            transition: 0.4s;
        }

        .nextmedya-toggle-slider:before {
            content: "";
            position: absolute;
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background: #ffffff;
            border-radius: 50%;
            transition: 0.4s;
        }

        .nextmedya-toggle-switch input:checked + .nextmedya-toggle-slider {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .nextmedya-toggle-switch input:checked + .nextmedya-toggle-slider:before {
            transform: translateX(30px);
        }

        .nextmedya-discount-badge {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #ffffff;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 700;
            animation: pulse 2s infinite;
        }

        /* Pricing Cards */
        .nextmedya-pricing-row {
            margin-bottom: 60px;
        }

        .nextmedya-pricing-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            position: relative;
            border: 2px solid #f1f5f9;
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            border-color: #3b82f6;
        }

        .nextmedya-pricing-card.highlighted {
            border: 3px solid #3b82f6;
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.2);
            transform: scale(1.05);
        }

        .nextmedya-pricing-card.highlighted:hover {
            transform: scale(1.08) translateY(-10px);
        }

        .nextmedya-package-badge {
            position: absolute;
            top: -15px;
            right: 30px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        .nextmedya-package-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .nextmedya-package-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .nextmedya-package-icon i {
            font-size: 2rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nextmedya-pricing-card.highlighted .nextmedya-package-icon {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .nextmedya-pricing-card.highlighted .nextmedya-package-icon i {
            -webkit-text-fill-color: #ffffff;
        }

        .nextmedya-package-name {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .nextmedya-package-description {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.6;
        }

        .nextmedya-package-price {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f1f5f9;
        }

        .nextmedya-price-wrapper {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 4px;
        }

        .nextmedya-price-currency {
            font-size: 1.5rem;
            font-weight: 700;
            color: #64748b;
        }

        .nextmedya-price-amount {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            transition: all 0.3s ease;
        }

        .nextmedya-price-period {
            font-size: 1rem;
            color: #64748b;
            font-weight: 600;
        }

        .nextmedya-package-features {
            flex: 1;
            margin-bottom: 30px;
        }

        .nextmedya-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            font-size: 0.95rem;
            color: #1e293b;
        }

        .nextmedya-feature-item i:first-child {
            font-size: 1.125rem;
            flex-shrink: 0;
        }

        .nextmedya-feature-item.included i:first-child {
            color: #10b981;
        }

        .nextmedya-feature-item.not-included {
            opacity: 0.5;
            text-decoration: line-through;
        }

        .nextmedya-feature-item.not-included i:first-child {
            color: #ef4444;
        }

        .nextmedya-tooltip-icon {
            margin-left: auto;
            color: #94a3b8;
            cursor: help;
            font-size: 0.875rem;
        }

        .nextmedya-package-action {
            margin-top: auto;
        }

        .nextmedya-package-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }

        .nextmedya-package-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
            color: #ffffff;
        }

        .nextmedya-pricing-card.highlighted .nextmedya-package-btn {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }

        .nextmedya-pricing-footer {
            background: #f8fafc;
            border-radius: 16px;
            padding: 24px;
        }

        .nextmedya-pricing-note {
            margin: 0;
            color: #64748b;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nextmedya-pricing-note i {
            color: #10b981;
            font-size: 1.125rem;
        }

        @media (max-width: 992px) {
            .nextmedya-pricing-packages {
                padding: 60px 0;
            }

            .nextmedya-pricing-card.highlighted {
                transform: scale(1);
            }

            .nextmedya-pricing-card {
                margin-bottom: 30px;
            }

            .nextmedya-billing-toggle {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const billingToggle = document.getElementById('billingToggle');

            if (billingToggle) {
                billingToggle.addEventListener('change', function() {
                    const isAnnual = this.checked;
                    const priceElements = document.querySelectorAll('.nextmedya-price-amount');

                    priceElements.forEach(element => {
                        const monthlyPrice = element.getAttribute('data-monthly');
                        const annualPrice = element.getAttribute('data-annual');

                        element.style.opacity = '0';
                        setTimeout(() => {
                            element.textContent = isAnnual ? annualPrice : monthlyPrice;
                            element.style.opacity = '1';
                        }, 200);
                    });

                    // Billing label active state
                    const labels = document.querySelectorAll('.nextmedya-billing-label');
                    labels[0].style.color = isAnnual ? '#94a3b8' : '#1e293b';
                    labels[1].style.color = isAnnual ? '#1e293b' : '#94a3b8';
                });
            }

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush