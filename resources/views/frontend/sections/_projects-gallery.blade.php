@php
    // Admin panelinden gelen veriler
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'Projelerimiz');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Başarıyla Tamamlanan Projeler');
    $description = data_get($content, 'description.' . app()->getLocale(), '');
    $layoutStyle = data_get($content, 'layout_style', 'grid');
    
    // Repeater'dan gelen projeler
    $projects = data_get($content, 'projects', []);
    
    // Kategorileri topla (filtreleme için)
    $categories = collect($projects)
        ->pluck('project_category.' . app()->getLocale())
        ->filter()
        ->unique()
        ->values();
@endphp

<section class="izokoc-projects-gallery-section commonSection">
    <div class="container">
        {{-- Başlık Bölümü --}}
        <div class="row">
            <div class="col-xl-12 text-center">
                <h6 class="sub_title izokoc-projects-subtitle">{{ $subTitle }}</h6>
                <h2 class="sec_title with_bar izokoc-projects-maintitle">
                    <span>{{ $mainTitle }}</span>
                </h2>
                @if($description)
                    <p class="izokoc-projects-description">{!! $description !!}</p>
                @endif
            </div>
        </div>

        {{-- Kategori Filtreleri --}}
        @if($categories->isNotEmpty())
            <div class="row">
                <div class="col-xl-12">
                    <div class="izokoc-projects-filter-bar text-center mb-5">
                        <button class="izokoc-filter-button active" data-filter="all">
                            <i class="fas fa-th"></i> {{ __('All') }}
                        </button>
                        @foreach($categories as $index => $category)
                            <button class="izokoc-filter-button" data-filter="izokoc-cat-{{ $index }}">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Projeler Grid --}}
        <div class="row izokoc-projects-container {{ $layoutStyle === 'masonry' ? 'izokoc-masonry-layout' : 'izokoc-grid-layout' }}"
             id="izokocProjectsGrid">
            @forelse($projects as $projectIndex => $project)
                @php
                    $companyName = data_get($project, 'company_name.' . app()->getLocale(), 'Firma İsmi');
                    $projectCategory = data_get($project, 'project_category.' . app()->getLocale(), '');
                    $projectDate = data_get($project, 'project_date', '');
                    $projectLocation = data_get($project, 'project_location.' . app()->getLocale(), '');
                    $projectSummary = data_get($project, 'project_summary.' . app()->getLocale(), '');
                    $projectLink = data_get($project, 'project_link', '#');
                    
                    $categoryIndex = $categories->search($projectCategory);
                    $categorySlug = $categoryIndex !== false ? 'izokoc-cat-' . $categoryIndex : '';
                    
                    // Görselleri topla
                    $mainImage = data_get($project, 'main_image') 
                        ? asset(data_get($project, 'main_image')) 
                        : 'https://placehold.co/800x600/FF3131/ffffff?text=' . urlencode($companyName);
                    
                    $galleryImages = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $imgPath = data_get($project, "gallery_image_{$i}");
                        if ($imgPath) {
                            $galleryImages[] = asset($imgPath);
                        }
                    }
                    
                    // Unique ID oluştur
                    $uniqueId = 'izokoc-project-' . $projectIndex . '-' . Str::slug($companyName);
                @endphp

                <div class="col-xl-4 col-md-6 col-lg-4 izokoc-project-item"
                     data-category='["all"{{ $categorySlug ? ', "' . $categorySlug . '"' : '' }}]'
                     data-aos="fade-up"
                     data-aos-delay="{{ $projectIndex * 100 }}">

                    <div class="izokoc-project-card" id="{{ $uniqueId }}">
                        {{-- Ana Görsel --}}
                        <div class="izokoc-project-image-wrapper">
                            <img src="{{ $mainImage }}"
                                 alt="{{ $companyName }}"
                                 class="izokoc-project-main-image"
                                 loading="lazy">

                            <div class="izokoc-project-overlay">
                                <div class="izokoc-overlay-content">
                                    @if($projectCategory)
                                        <span class="izokoc-project-badge">
                                            <i class="fas fa-tag"></i> {{ $projectCategory }}
                                        </span>
                                    @endif

                                    <button class="izokoc-gallery-trigger"
                                            data-project-id="{{ $uniqueId }}"
                                            data-company-name="{{ $companyName }}">
                                        <i class="fas fa-images"></i>
                                        <span>{{ count($galleryImages) }} {{ __('Fotoğraf') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Proje Bilgileri --}}
                        <div class="izokoc-project-info">
                            <h3 class="izokoc-project-company-name">
                                <a href="{{ $projectLink }}">{{ $companyName }}</a>
                            </h3>

                            <div class="izokoc-project-meta">
                                @if($projectDate)
                                    <span class="izokoc-meta-item">
                                        <i class="far fa-calendar-alt"></i> {{ $projectDate }}
                                    </span>
                                @endif

                                @if($projectLocation)
                                    <span class="izokoc-meta-item">
                                        <i class="far fa-map-marker-alt"></i> {{ $projectLocation }}
                                    </span>
                                @endif
                            </div>

                            @if($projectSummary)
                                <p class="izokoc-project-summary">
                                    {!! Str::limit($projectSummary, 100) !!}
                                </p>
                            @endif

                        </div>

                        {{-- Gizli Galeri Verileri (Lightbox için) --}}
                        @if(!empty($galleryImages))
                            <div class="izokoc-hidden-gallery-data" data-project-id="{{ $uniqueId }}">
                                @foreach($galleryImages as $galleryIndex => $galleryImage)
                                    <a href="{{ $galleryImage }}"
                                       data-lightbox="{{ $uniqueId }}"
                                       data-title="{{ $companyName }} - {{ __('Görsel') }} {{ $galleryIndex + 1 }}"
                                       style="display:none;">
                                        <img src="{{ $galleryImage }}" alt="{{ $companyName }}">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="izokoc-no-projects">
                        <i class="fas fa-folder-open"></i>
                        <p>{{ __('Henüz proje eklenmemiş.') }}</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Daha Fazla Yükle Butonu --}}
        @if(count($projects) > 6)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="theme-btn izokoc-load-more-btn" id="izokocLoadMoreProjects">
                        <i class="fas fa-sync-alt"></i> {{ __('Show More') }}
                    </button>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- CSS Stilleri --}}
<style>
    :root {
        --izokoc-primary: #FF3131;
        --izokoc-secondary: #1a237e;
        --izokoc-blue: #2962FF;
    }

    .izokoc-projects-gallery-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .izokoc-projects-subtitle {
        color: var(--izokoc-primary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .izokoc-projects-maintitle {
        color: var(--izokoc-secondary);
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .izokoc-projects-description {
        color: #666;
        font-size: 18px;
        max-width: 700px;
        margin: 0 auto 40px;
    }

    /* Filtre Butonları */
    .izokoc-projects-filter-bar {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 50px;
    }

    .izokoc-filter-button {
        padding: 12px 30px;
        border: 2px solid #e0e0e0;
        background: white;
        color: #666;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 15px;
    }

    .izokoc-filter-button:hover,
    .izokoc-filter-button.active {
        background: var(--izokoc-primary);
        color: white;
        border-color: var(--izokoc-primary);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 49, 49, 0.3);
    }

    .izokoc-filter-button i {
        margin-right: 8px;
    }

    /* Proje Kartı */
    .izokoc-project-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        margin-bottom: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .izokoc-project-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    /* Görsel Wrapper */
    .izokoc-project-image-wrapper {
        position: relative;
        height: 280px;
        overflow: hidden;
    }

    .izokoc-project-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .izokoc-project-card:hover .izokoc-project-main-image {
        transform: scale(1.1);
    }

    /* Overlay */
    .izokoc-project-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(26, 35, 126, 0.95), rgba(26, 35, 126, 0.3));
        display: flex;
        align-items: flex-end;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .izokoc-project-card:hover .izokoc-project-overlay {
        opacity: 1;
    }

    .izokoc-overlay-content {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Badge */
    .izokoc-project-badge {
        background: var(--izokoc-primary);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    /* Galeri Butonu */
    .izokoc-gallery-trigger {
        background: white;
        color: var(--izokoc-secondary);
        border: none;
        padding: 12px 25px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .izokoc-gallery-trigger:hover {
        background: var(--izokoc-blue);
        color: white;
        transform: scale(1.05);
    }

    /* Proje Bilgileri */
    .izokoc-project-info {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .izokoc-project-company-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--izokoc-secondary);
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .izokoc-project-company-name a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .izokoc-project-company-name a:hover {
        color: var(--izokoc-primary);
    }

    /* Meta Bilgiler */
    .izokoc-project-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .izokoc-meta-item {
        color: #666;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .izokoc-meta-item i {
        color: var(--izokoc-primary);
        font-size: 16px;
    }

    /* Proje Özeti */
    .izokoc-project-summary {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    /* Detay Butonu */
    .izokoc-project-detail-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--izokoc-blue);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        align-self: flex-start;
    }

    .izokoc-project-detail-btn:hover {
        color: var(--izokoc-primary);
        gap: 15px;
    }

    /* Daha Fazla Yükle Butonu */
    .izokoc-load-more-btn {
        background: var(--izokoc-secondary);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .izokoc-load-more-btn:hover {
        background: var(--izokoc-primary);
        transform: scale(1.05);
    }

    /* Boş Durum */
    .izokoc-no-projects {
        padding: 60px 20px;
        text-align: center;
    }

    .izokoc-no-projects i {
        font-size: 80px;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .izokoc-no-projects p {
        color: #999;
        font-size: 18px;
    }

    /* Masonry Layout */
    .izokoc-masonry-layout {
        column-count: 3;
        column-gap: 30px;
    }

    .izokoc-masonry-layout .izokoc-project-item {
        break-inside: avoid;
        margin-bottom: 30px;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .izokoc-masonry-layout {
            column-count: 2;
        }

        .izokoc-projects-maintitle {
            font-size: 32px;
        }
    }

    @media (max-width: 767px) {
        .izokoc-masonry-layout {
            column-count: 1;
        }

        .izokoc-projects-filter-bar {
            flex-direction: column;
            align-items: center;
        }

        .izokoc-filter-button {
            width: 100%;
            max-width: 300px;
        }

        .izokoc-projects-maintitle {
            font-size: 28px;
        }

        .izokoc-project-company-name {
            font-size: 20px;
        }
    }
</style>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtreleme Sistemi
        const filterButtons = document.querySelectorAll('.izokoc-filter-button');
        const projectItems = document.querySelectorAll('.izokoc-project-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');

                // Aktif buton stilini güncelle
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Projeleri filtrele
                projectItems.forEach(item => {
                    const categories = JSON.parse(item.getAttribute('data-category'));

                    if (filterValue === 'all' || categories.includes(filterValue)) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Galeri Açma
        const galleryTriggers = document.querySelectorAll('.izokoc-gallery-trigger');

        galleryTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const projectId = this.getAttribute('data-project-id');
                const galleryData = document.querySelector(`.izokoc-hidden-gallery-data[data-project-id="${projectId}"]`);

                if (galleryData) {
                    const firstImage = galleryData.querySelector('a');
                    if (firstImage) {
                        firstImage.click();
                    }
                }
            });
        });

        // Daha Fazla Yükle (Lazy Loading)
        const loadMoreBtn = document.getElementById('izokocLoadMoreProjects');
        if (loadMoreBtn) {
            let itemsToShow = 6;
            const allItems = Array.from(projectItems);

            // İlk yükleme
            allItems.forEach((item, index) => {
                if (index >= itemsToShow) {
                    item.style.display = 'none';
                }
            });

            loadMoreBtn.addEventListener('click', function() {
                itemsToShow += 3;

                allItems.forEach((item, index) => {
                    if (index < itemsToShow) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                        }, 10);
                    }
                });

                if (itemsToShow >= allItems.length) {
                    this.style.display = 'none';
                }
            });
        }
    });
</script>