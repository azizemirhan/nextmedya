@php
    $popularBadgeText = data_get($content, 'popular_badge_text.' . app()->getLocale(), '🏆 En Çok Tercih Edilen');
    $callButtonText = data_get($content, 'call_button_text.' . app()->getLocale(), 'Sizi Arayalım');
    $plans = collect(data_get($content, 'plans', []));
@endphp

<div class="container">
    @if ($plans->contains('is_popular', '1'))
        <div class="most-popular-badge">{{ $popularBadgeText }}</div>
    @endif

    <div class="pricing-grid">
        {{-- 1. DÖNGÜ (ANA TEKRARLAYICI): Her bir fiyat paketini oluşturur. --}}
        @foreach ($plans as $plan)
            <div class="pricing-card @if(data_get($plan, 'is_popular') == '1') popular @endif">
                {{-- ... (Paket başlığı, fiyatı vb. dinamik alanlar) --}}

                <div class="features-divider"></div>

                @if($featuresTitle = data_get($plan, 'features_title.' . app()->getLocale()))
                    <p class="features-title">{{ $featuresTitle }}</p>
                @endif

                @php
                    // O anki pakete ait özellikleri bir koleksiyona alıyoruz.
                    $features = collect(data_get($plan, 'features', []));
                @endphp

                @if($features->isNotEmpty())
                    <ul class="features-list">
                        {{-- ↓↓↓ 2. DÖNGÜ (İÇ TEKRARLAYICI): O pakete ait özellikleri listeler. ↓↓↓ --}}
                        @foreach ($features as $feature)
                            <li class="feature-item">
                                <span class="checkmark">✓</span>
                                <span>{!! data_get($feature, 'feature_item.' . app()->getLocale()) !!}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <button class="cta-button">
                    <span>{{ $callButtonText }}</span>
                    <span>📞</span>
                </button>
            </div>
        @endforeach
    </div>
</div>
