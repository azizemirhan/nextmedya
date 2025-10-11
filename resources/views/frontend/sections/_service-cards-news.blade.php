@php
    // Yönetici panelinden girilen verileri daha kolay kullanmak için değişkenlere atıyoruz.
    $title = data_get($content, 'title.' . app()->getLocale());
    $subtitle = data_get($content, 'subtitle.' . app()->getLocale());
    $services = collect(data_get($content, 'services', []));
    $logos = collect(data_get($content, 'logos', []));
@endphp

@if($logos->isNotEmpty())
    <div class="logo-slider">
        <div class="logos-slide">
            @foreach ($logos as $logo)
                <img src="{{ asset($logo) }}" alt="Referans Logo" style="background-color: #fff; border-radius: 20px">
            @endforeach
        </div>
    </div>
@endif


<section class="services-section">
    {{-- Başlık ve alt başlığı dinamik olarak yazdırıyoruz --}}
    <h2 class="section-title shining-effect">{{ $title }}</h2>
    <p class="section-subtitle">{!! $subtitle !!}</p>

    {{-- Eğer hiç hizmet kartı eklenmemişse bu bölümü gösterme --}}
    @if($services->isNotEmpty())
        <div class="services-grid">
            {{-- Yöneticinin eklediği hizmet kartlarını döngüye alıyoruz --}}
            @foreach ($services as $service)
                <div class="service-card">
                    <div class="card-icon">
                        {{-- SVG kodunu doğrudan yazdırıyoruz --}}
                        <i class="{{ data_get($service, 'icon_svg') }}"></i>

                    </div>
                    <h3 class="card-title">{{ data_get($service, 'card_title.' . app()->getLocale()) }}</h3>
                    <p class="card-description">{!! data_get($service, 'card_description.' . app()->getLocale()) !!}</p>
                </div>
            @endforeach
        </div>
    @endif
</section>
