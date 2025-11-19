@php
    $image = data_get($content, 'image') ? asset($content['image']) : 'https://placehold.co/580x640';
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Key Benefits');

    // === DÜZELTİLEN KISIM BAŞLANGICI ===
    $benefits = data_get($content, 'benefits', []);
    if (is_string($benefits)) {
        $benefits = json_decode($benefits, true) ?? [];
    }
    // === DÜZELTİLEN KISIM BİTİŞİ ===
@endphp

<section class="gap about-key-benefits">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="data">
                    <figure>
                        <img class="w-100" src="{{ $image }}" alt="{{ $mainTitle }}">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="data">
                    <h2>{{ $mainTitle }}</h2>
                    @if(!empty($benefits))
                        <ul>
                            @foreach($benefits as $benefit)
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <p>{{ data_get($benefit, 'benefit_text.' . app()->getLocale()) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
