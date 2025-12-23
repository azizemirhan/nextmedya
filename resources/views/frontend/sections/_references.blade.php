@php
    $references = $content['references'] ?? [];
    $sliderContent = array_merge($references, $references);
@endphp

<section id="nx-references-section" class="nx-references-minimal">
    @if (!empty($references))
        <div class="nx-logo-slider">
            <div class="nx-logo-track">
                @foreach($sliderContent as $reference)
                    @php
                        $logoUrl = isset($reference['logo_image']) ? asset($reference['logo_image']) : 'https://via.placeholder.com/160x60/ffffff/333333?text=LOGO';
                        $altText = data_get($reference, 'alt_text.' . app()->getLocale(), 'Marka Logosu');
                    @endphp
                    <div class="nx-logo-item">
                        <img src="{{ $logoUrl }}" alt="{{ $altText }}" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>

<style>
.nx-references-minimal {
    padding: 20px 0;
    background: #fff;
    overflow: hidden;
}

.nx-logo-slider {
    width: 100%;
    overflow: hidden;
    mask-image: linear-gradient(90deg, transparent, #000 5%, #000 95%, transparent);
    -webkit-mask-image: linear-gradient(90deg, transparent, #000 5%, #000 95%, transparent);
}

.nx-logo-track {
    display: flex;
    gap: 50px;
    animation: scrollLogos 35s linear infinite;
    width: max-content;
}

.nx-logo-track:hover {
    animation-play-state: paused;
}

@keyframes scrollLogos {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.nx-logo-item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
}

.nx-logo-item img {
    max-width: 180px;
    max-height: 70px;
    width: auto;
    height: auto;
    object-fit: contain;
    opacity: 0.85;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.nx-logo-item:hover img {
    opacity: 1;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .nx-references-minimal {
        padding: 15px 0;
    }
    
    .nx-logo-track {
        gap: 30px;
    }
    
    .nx-logo-item img {
        max-width: 100px;
        max-height: 40px;
    }
}
</style>