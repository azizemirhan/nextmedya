@php
// Admin panelinden girilen statik başlıklar
$smallTitle = $content['small_title_'.app()->getLocale()] ?? 'Our services';
$mainTitle = $content['main_title_'.app()->getLocale()] ?? 'What We Do';

// DataHandler'dan gelen Service koleksiyonu
$services = $dynamicData ?? collect();
@endphp

<section class="gap project-style-one light-bg-color">
    <div class="heading">
        <figure>
            <img src="/site/assets/images/heading-icon.png" alt="Heading Icon">
        </figure>
        <span>{{ $smallTitle }}</span>
        <h2>{{ $mainTitle }}</h2>
    </div>
    <div class="container">
        @if($services->isNotEmpty())
        {{-- Owl Carousel'u başlatmak için gerekli class'ları ekleyin --}}
        <div class="row project-slider owl-carousel">
            @foreach($services as $service)
            <div class="col-lg-12">
                <div class="project-post"> {{-- Proje stili aynı kalabilir --}}
                    <figure>
                        {{-- Service modelinizde bir 'image' alanı olduğunu varsayıyoruz --}}
                        <img src="{{ isset($service->image) ? asset($service->image) : 'https://placehold.co/640x395' }}" alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                    </figure>
                    <div class="project-data">
                        {{-- Service için bir detay sayfası varsa link verebilirsiniz --}}
                        <h3><a href="#">{{ $service->getTranslation('title', app()->getLocale()) }}</a></h3>
                        {{-- Service modelinizde 'summary' alanı varsa --}}
                        <p>{{ $service->getTranslation('summary', app()->getLocale()) }}</p>
                        <a class="project-icon" href="#">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center">Gösterilecek hizmet bulunamadı.</p>
        @endif
    </div>
</section>
