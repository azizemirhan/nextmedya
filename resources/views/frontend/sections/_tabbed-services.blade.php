@php
    // Admin panelinden girilen çok dilli başlığı al
    $mainTitle = data_get($content, 'title.' . app()->getLocale(), 'Hizmetlerimiz');
    // Bölüme yüklenen "cover_image" alanını al.
    // asset() fonksiyonu burada bir kere kullanılır.
    $sectionImage = !empty($content['background_image']) ? asset($content['background_image']) : 'https://placehold.co/620x630';

    // Data handler'dan gelen hizmetleri al
    $services = $dynamicData ?? collect();
@endphp

<section class="gap no-top construction-services">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="services-nav">
                    <h2>{{ $mainTitle }}</h2>
                    @if($services->isNotEmpty())
                        <ul class="nav nav-pills mb-3" id="pills-tab-{{ $section->id }}" role="tablist">
                            @foreach($services as $service)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-service-{{ $service->id }}-tab" data-bs-toggle="pill" data-bs-target="#pills-service-{{ $service->id }}" type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $service->getTranslation('title', app()->getLocale()) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                @if($services->isNotEmpty())
                    <div class="tab-content" id="pills-tabContent-{{ $section->id }}">
                        @foreach($services as $service)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-service-{{ $service->id }}" role="tabpanel">
                                <figure>
                                    {{-- DÜZELTME: asset() tekrar çağrılmıyor, değişken direkt kullanılıyor --}}
                                    <img class="w-100" src="{{ $sectionImage }}" alt="{{ $mainTitle }}">
                                    <figcaption>
                                        <h3>{{ $service->getTranslation('title', app()->getLocale()) }}</h3>
                                        <p>{{ $service->getTranslation('summary', app()->getLocale()) }}</p>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
