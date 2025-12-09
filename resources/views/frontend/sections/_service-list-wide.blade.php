@php
    // Admin panelinden girilen başlıkları alıyoruz
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'What We Provide');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Exclusive services');

    // ServicesListHandler'dan gelen hizmetler koleksiyonu
    $services = $dynamicData ?? collect();
@endphp

<section class="gap service-style-two">
    <div class="heading">
        <span>{{ $smallTitle }}</span>
        <h2>{{ $mainTitle }}</h2>
    </div>
    <div class="container">
        <div class="row g-0">
            @foreach($services as $service)
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="service-two-box">
                        {{-- Service modelinizin 'slug' alanı olduğunu varsayıyoruz --}}
                        <h3><a href="{{ route('frontend.services.show', $service->slug) }}">{{ $service->getTranslation('title', app()->getLocale()) }}</a></h3>

                        {{-- Service modelinizin 'summary' alanı olduğunu varsayıyoruz --}}
                        <p>{{ $service->getTranslation('summary', app()->getLocale()) }}</p>

                        <div class="service-two-icon d-flex-all justify-content-start">
                            {{-- Service modelinizin 'icon' alanı (SVG kodu içeriyor) olduğunu varsayıyoruz --}}
                            {!! $service->icon !!}

                            <a href="{{ route('frontend.services.show', $service->slug) }}">
                                <i class="fa-solid fa-arrow-up-long"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
