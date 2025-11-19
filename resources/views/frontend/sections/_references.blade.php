@php
    // Admin panelinden girilen çok dilli başlıkları ve alt başlığı alıyoruz.
    // PageSection modelindeki getTranslation helper metodu ile aynı işlevi gören data_get kullanıldı.
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Referanslarımız');
    $subtitle = data_get($content, 'subtitle.' . app()->getLocale(), 'Markaların tercihi olmaktan gurur duyuyoruz.');

    // Repeater alanından referans logolarını alıyoruz.
    $references = $content['references'] ?? [];

    // Kaynak logoları döngüde kullanmak için bir kez hazırlıyoruz.
    // Her logo iki kez eklenecek (seamless loop için).
    $sliderContent = array_merge($references, $references);
@endphp

<section id="nx-references-section" class="nx-references-wrapper">
    <div class="container"> {{-- Kapsayıcı div'in stil sınıfını düzenlemedim, ancak 'container' ekledim --}}
        <div class="nx-references-header">
            <h2 class="nx-references-title">{{ $mainTitle }}</h2>
            <p class="nx-references-subtitle">{{ $subtitle }}</p>
        </div>

        @if (!empty($references))
            <div class="nx-brands-slider-wrapper">
                <div class="nx-brands-slider">
                    @foreach($sliderContent as $reference)
                        @php
                            $logoUrl = isset($reference['logo_image']) ? asset($reference['logo_image']) : 'https://via.placeholder.com/160x50/ffffff/333333?text=LOGO';
                            // Repeater içindeki translatable alan için PageSection'daki getRepeaterTranslation helper'ına ihtiyacımız var.
                            // Eğer `PageSection` modelini kullanıyorsak ve `references` bir repeater ise.
                            // Ancak Blade'deyiz ve `$content` dizisine sahibiz. Eğer content yapısı PageSection'dan geliyorsa,
                            // Translatable alanlar için data_get() kullanacağız:
                            $altText = data_get($reference, 'alt_text.' . app()->getLocale(), 'Marka Logosu');
                        @endphp
                        <div class="nx-brand-card">
                            <img src="{{ $logoUrl }}" alt="{{ $altText }}" class="nx-brand-logo">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="nx-brands-grid">
                @foreach($references as $reference)
                    @php
                        $logoUrl = isset($reference['logo_image']) ? asset($reference['logo_image']) : 'https://via.placeholder.com/120x40/ffffff/333333?text=LOGO';
                        $altText = data_get($reference, 'alt_text.' . app()->getLocale(), 'Marka Logosu');
                    @endphp
                    <div class="nx-brand-card">
                        <img src="{{ $logoUrl }}" alt="{{ $altText }}" class="nx-brand-logo">
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align: center; margin-top: 20px;">Henüz bir referans eklenmemiş.</p>
        @endif
    </div>
</section>