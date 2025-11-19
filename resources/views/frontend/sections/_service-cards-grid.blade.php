@php
    // Admin panelinden gelen veriler
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'Our Services');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'What We Offer');
    $showFilters = data_get($content, 'show_filters', '0') == '1';
    
    // Repeater'dan gelen hizmetler
    $serviceCards = data_get($content, 'service_cards', []);

    // Kategorileri topla (eğer filtreleme açıksa)
    $categories = collect();
    if ($showFilters && !empty($serviceCards)) {
        $categories = collect($serviceCards)
            ->pluck('service_category.' . app()->getLocale())
            ->filter()
            ->unique()
            ->values();
    }
@endphp

<section class="commonSection casestudysection service-cards-grid-section">
    <div class="container">
        {{-- Başlık Bölümü --}}
        <div class="row">
            <div class="col-xl-12 text-center">
                <h6 class="sub_title">{{ $subTitle }}</h6>
                <h2 class="sec_title with_bar">
                    <span>{{ $mainTitle }}</span>
                </h2>
            </div>
        </div>

        {{-- Kategori Filtreleri --}}
        @if($showFilters && $categories->isNotEmpty())
            <div class="row">
                <div class="col-xl-12">
                    <div class="simplefilter text-center mb-4">
                        <button class="filter-btn active" data-filter="all">
                            {{ __('All Services') }}
                        </button>
                        @foreach($categories as $index => $category)
                            <button class="filter-btn" data-filter="category-{{ $index }}">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Hizmet Kartları Grid --}}
        <div class="row shuffle-wrapper" id="serviceGrid">
            @forelse($serviceCards as $index => $service)
                @php
                    $serviceCategory = data_get($service, 'service_category.' . app()->getLocale(), '');
                    $categoryIndex = $categories->search($serviceCategory);
                    $categorySlug = $categoryIndex !== false ? 'category-' . $categoryIndex : '';

                    $serviceImage = data_get($service, 'service_image')
                        ? asset(data_get($service, 'service_image'))
                        : 'https://placehold.co/370x280';

                    $serviceTitle = data_get($service, 'service_title.' . app()->getLocale(), '');
                    $serviceSummary = data_get($service, 'service_summary.' . app()->getLocale(), '');
                    $serviceLink = data_get($service, 'service_link', '#');
                @endphp

                <div class="col-xl-4 col-md-6 col-lg-4 service-item shuffle-item"
                     data-groups='["all"{{ $categorySlug ? ', "' . $categorySlug . '"' : '' }}]'
                     data-aos="fade-up"
                     data-aos-delay="{{ $index * 100 }}">
                    <div class="singlefolio service-card">
                        <div class="service-image-wrapper">
                            <img src="{{ $serviceImage }}"
                                 alt="{{ $serviceTitle }}"
                                 loading="lazy">
                        </div>

                        <div class="folioHover service-overlay">
                            @if($serviceCategory)
                                <p class="service-category">
                                    <span class="cate">{{ $serviceCategory }}</span>
                                </p>
                            @endif

                            <h4 class="service-title">
                                <a href="{{ $serviceLink }}">
                                    {{ $serviceTitle }}
                                </a>
                            </h4>

                            @if($serviceSummary)
                                <p class="service-summary">
                                    {!! Str::limit($serviceSummary, 80) !!}
                                </p>
                            @endif

                            <a href="{{ $serviceLink }}" class="service-link-btn">
                                {{ __('Learn More') }}
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('No services found.') }}</p>
                </div>
            @endforelse
        </div>

        {{-- Tümünü Gör Butonu (Opsiyonel) --}}
        @if(!empty($serviceCards))
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="#" class="theme-btn">
                        {{ __('View All Services') }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

