@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Referanslarımız');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Güvenilir İş Ortakları');
    $sectionDescription = data_get($content, 'section_description.' . app()->getLocale(), '');
    $layoutStyle = data_get($content, 'layout_style', 'grid');
    $showCategoryFilter = data_get($content, 'show_category_filter', true);
    $showStats = data_get($content, 'show_stats', true);
    $stats = data_get($content, 'stats', []);
    $references = data_get($content, 'references', []);

    // Kategorileri topla
    $categories = collect($references)->pluck('company_category.' . app()->getLocale())->unique()->filter()->values();
@endphp

<section class="nextmedya-references-section py-5">
    <div class="nextmedya-ref-bg">
        <div class="nextmedya-ref-shape shape-1"></div>
        <div class="nextmedya-ref-shape shape-2"></div>
    </div>

    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                @if($sectionSubtitle)
                    <span class="nextmedya-ref-badge">
                        <i class="fas fa-award me-2"></i>
                        {{ $sectionSubtitle }}
                    </span>
                @endif

                <h2 class="nextmedya-ref-title">{{ $sectionTitle }}</h2>

                @if($sectionDescription)
                    <p class="nextmedya-ref-description">{!! $sectionDescription !!}</p>
                @endif
            </div>
        </div>

        @if($showStats && !empty($stats))
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="nextmedya-ref-stats" data-aos="fade-up">
                        @foreach($stats as $stat)
                            @php
                                $statNumber = data_get($stat, 'stat_number', '0');
                                $statSuffix = data_get($stat, 'stat_suffix', '');
                                $statLabel = data_get($stat, 'stat_label.' . app()->getLocale(), '');
                                $statIcon = data_get($stat, 'stat_icon', 'fas fa-star');
                            @endphp
                            <div class="nextmedya-stat-item">
                                <div class="nextmedya-stat-icon">
                                    <i class="{{ $statIcon }}"></i>
                                </div>
                                <div class="nextmedya-stat-content">
                                    <h3 class="nextmedya-stat-number" data-count="{{ $statNumber }}">0</h3>
                                    <span class="nextmedya-stat-suffix">{{ $statSuffix }}</span>
                                    <p class="nextmedya-stat-label">{{ $statLabel }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($showCategoryFilter && $categories->isNotEmpty())
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="nextmedya-ref-filters text-center" data-aos="fade-up">
                        <button class="nextmedya-filter-btn active" data-filter="*">
                            <i class="fas fa-th me-2"></i>
                            Tümü
                        </button>
                        @foreach($categories as $category)
                            <button class="nextmedya-filter-btn" data-filter=".category-{{ Str::slug($category) }}">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="row" id="references-grid">
            @foreach($references as $index => $reference)
                @php
                    $companyName = data_get($reference, 'company_name.' . app()->getLocale(), '');
                    $companyLogo = data_get($reference, 'company_logo', '');
                    $companyWebsite = data_get($reference, 'company_website', '');
                    $companyCategory = data_get($reference, 'company_category.' . app()->getLocale(), 'Genel');
                    $isFeatured = data_get($reference, 'is_featured', false);
                    $galleryImages = data_get($reference, 'gallery_images', []);
                @endphp

                <div class="col-lg-4 col-md-6 mb-4 nextmedya-ref-item category-{{ Str::slug($companyCategory) }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="nextmedya-ref-card {{ $isFeatured ? 'featured' : '' }}">

                        @if($isFeatured)
                            <div class="nextmedya-ref-badge-featured">
                                <i class="fas fa-star"></i>
                                Öne Çıkan
                            </div>
                        @endif

                        <div class="nextmedya-ref-logo">
                            @if($companyLogo)
                                <img src="{{ asset($companyLogo) }}" alt="{{ $companyName }}" loading="lazy">
                            @else
                                <div class="nextmedya-ref-placeholder">
                                    <i class="fas fa-building"></i>
                                </div>
                            @endif
                        </div>

                        <div class="nextmedya-ref-info">
                            <h3 class="nextmedya-ref-company-name">{{ $companyName }}</h3>
                            <span class="nextmedya-ref-category">{{ $companyCategory }}</span>

                            <div class="nextmedya-ref-actions">
                                @if(!empty($galleryImages))
                                    <button type="button" class="nextmedya-ref-gallery-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#referenceModal"
                                            data-reference-index="{{ $index }}">
                                        <i class="fas fa-palette me-1"></i>
                                        Tasarımlar ({{ count($galleryImages) }})
                                    </button>
                                @endif

                                @if($companyWebsite)
                                    <a href="{{ $companyWebsite }}" class="nextmedya-ref-website" target="_blank" onclick="event.stopPropagation();">
                                        <i class="fas fa-external-link-alt me-1"></i>
                                        Web Sitesi
                                    </a>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="referenceModal" tabindex="-1" aria-labelledby="referenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="referenceModalLabel">Referans Galerisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="nextmedya-modal-main-image">
                    <img id="modalMainImage" src="" alt="" class="w-100">
                    <div class="nextmedya-modal-nav">
                        <button class="nextmedya-modal-nav-btn prev" id="modalPrevBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="nextmedya-modal-nav-btn next" id="modalNextBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="nextmedya-modal-thumbnails p-3" id="modalThumbnails">
                </div>

                <div class="nextmedya-modal-image-info p-3">
                    <h6 id="modalImageTitle">Resim Başlığı</h6>
                    <p id="modalImageDescription">Resim açıklaması</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .nextmedya-references-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        /* Background Shapes */
        .nextmedya-ref-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .nextmedya-ref-shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(30, 64, 175, 0.05));
            animation: floatShape 20s ease-in-out infinite;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            bottom: -100px;
            right: -100px;
            animation-delay: 5s;
        }

        @keyframes floatShape {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(20px, -20px) rotate(90deg);
            }
            50% {
                transform: translate(-20px, 20px) rotate(180deg);
            }
            75% {
                transform: translate(20px, 20px) rotate(270deg);
            }
        }

        /* Section Header */
        .nextmedya-ref-badge {
            display: inline-flex;
            align-items: center;
            padding: 10px 25px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(30, 64, 175, 0.1));
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #3b82f6;
            margin-bottom: 20px;
        }

        .nextmedya-ref-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .nextmedya-ref-description {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Statistics */
        .nextmedya-ref-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            padding: 40px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .nextmedya-stat-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .nextmedya-stat-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(30, 64, 175, 0.05));
            transform: translateY(-5px);
        }

        .nextmedya-stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nextmedya-stat-icon i {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .nextmedya-stat-content {
            display: flex;
            flex-direction: column;
        }

        .nextmedya-stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: #1e293b;
            line-height: 1;
            margin: 0;
            display: inline;
        }

        .nextmedya-stat-suffix {
            font-size: 1.5rem;
            font-weight: 900;
            color: #3b82f6;
            margin-left: 5px;
        }

        .nextmedya-stat-label {
            font-size: 0.875rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
            margin-bottom: 0;
        }

        /* Category Filters */
        .nextmedya-ref-filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 20px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .nextmedya-filter-btn {
            padding: 12px 30px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nextmedya-filter-btn:hover {
            background: #3b82f6;
            border-color: #3b82f6;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .nextmedya-filter-btn.active {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
        }

        /* Reference Cards */
        .nextmedya-ref-item {
            transition: all 0.3s ease;
        }

        .nextmedya-ref-card {
            position: relative;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-ref-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-ref-card.featured {
            border: 3px solid #3b82f6;
        }

        .nextmedya-ref-badge-featured {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 2;
        }

        .nextmedya-ref-logo {
            height: 200px;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .nextmedya-ref-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: grayscale(100%);
            transition: all 0.3s ease;
        }

        .nextmedya-ref-card:hover .nextmedya-ref-logo img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        .nextmedya-ref-placeholder {
            width: 80px;
            height: 80px;
            background: #e2e8f0;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 2rem;
        }

        .nextmedya-ref-info {
            padding: 25px 30px;
            text-align: center;
            flex-grow: 1;

            /* DEĞİŞİKLİK BURADA: Butonları en alta itmek için eklendi */
            display: flex;
            flex-direction: column;
        }

        .nextmedya-ref-company-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .nextmedya-ref-category {
            display: inline-block;
            padding: 5px 15px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(30, 64, 175, 0.1));
            color: #3b82f6;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* DEĞİŞİKLİK BURADA: Eski galeri sayısı stili kaldırıldı (artık kullanılmıyor) */
        /*
        .nextmedya-ref-gallery-count {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 10px;
        }
        */

        /* DEĞİŞİKLİK BURADA: Butonları sarmalayan ve en alta iten alan */
        .nextmedya-ref-actions {
            margin-top: auto; /* Kartın en altına iter */
            padding-top: 15px; /* Üstündeki kategoriyle arayı açar */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        /* DEĞİŞİKLİK BURADA: Yeni "Tasarımlar" butonu stili */
        .nextmedya-ref-gallery-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 15px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border: none;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nextmedya-ref-gallery-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        /* DEĞİŞİKLİK BURADA: Web sitesi linkine buton stili verildi */
        .nextmedya-ref-website {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 15px;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nextmedya-ref-website:hover {
            color: #3b82f6;
            border-color: #3b82f6;
        }

        /* DEĞİŞİKLİK BURADA: İstenmeyen overlay stilleri kaldırıldı */
        /*
        .nextmedya-ref-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(30, 64, 175, 0.95));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .nextmedya-ref-card:hover .nextmedya-ref-overlay {
            opacity: 1;
        }

        .nextmedya-ref-action {
            color: #ffffff;
            text-align: center;
        }

        .nextmedya-ref-action i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }

        .nextmedya-ref-action span {
            font-size: 1.125rem;
            font-weight: 600;
        }
        */

        /* Modal Styles */
        .nextmedya-modal-main-image {
            position: relative;
            background: #000;
        }

        .nextmedya-modal-main-image img {
            max-height: 500px;
            object-fit: contain;
        }

        .nextmedya-modal-nav {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            transform: translateY(-50%);
        }

        .nextmedya-modal-nav-btn {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nextmedya-modal-nav-btn:hover {
            background: #ffffff;
            transform: scale(1.1);
        }

        .nextmedya-modal-thumbnails {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 20px !important;
            background: #f8fafc;
        }

        .nextmedya-modal-thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
            opacity: 0.6;
        }

        .nextmedya-modal-thumbnail.active {
            opacity: 1;
            border: 3px solid #3b82f6;
        }

        .nextmedya-modal-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nextmedya-modal-image-info {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        .nextmedya-modal-image-info h6 {
            color: #1e293b;
            margin-bottom: 10px;
        }

        .nextmedya-modal-image-info p {
            color: #64748b;
            margin-bottom: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nextmedya-ref-stats {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .nextmedya-ref-filters {
                flex-direction: column;
            }

            .nextmedya-filter-btn {
                width: 100%;
            }

            .nextmedya-modal-nav {
                padding: 0 10px;
            }

            .nextmedya-modal-nav-btn {
                width: 40px;
                height: 40px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Script bölümünde herhangi bir değişiklik gerekmiyor --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const references = @json($references);
            let currentReferenceIndex = 0;
            let currentImageIndex = 0;

            // Counter Animation
            const counters = document.querySelectorAll('.nextmedya-stat-number');

            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 16);
            };

            // Intersection Observer for counter animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {threshold: 0.5});

            counters.forEach(counter => observer.observe(counter));

            // Category Filter
            const filterBtns = document.querySelectorAll('.nextmedya-filter-btn');
            const refItems = document.querySelectorAll('.nextmedya-ref-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const filter = this.getAttribute('data-filter');

                    // Update active button
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Filter items
                    refItems.forEach(item => {
                        if (filter === '*' || item.classList.contains(filter.substring(1))) {
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

            // Modal Gallery
            const referenceModal = document.getElementById('referenceModal');
            const modalMainImage = document.getElementById('modalMainImage');
            const modalThumbnails = document.getElementById('modalThumbnails');
            const modalImageTitle = document.getElementById('modalImageTitle');
            const modalImageDescription = document.getElementById('modalImageDescription');
            const modalPrevBtn = document.getElementById('modalPrevBtn');
            const modalNextBtn = document.getElementById('modalNextBtn');

            // Modal açıldığında
            referenceModal.addEventListener('show.bs.modal', function (event) {
                const trigger = event.relatedTarget;
                currentReferenceIndex = parseInt(trigger.getAttribute('data-reference-index'));
                currentImageIndex = 0;

                const reference = references[currentReferenceIndex];
                const galleryImages = reference.gallery_images || [];

                // Modal başlığını güncelle
                const companyName = reference.company_name['{{ app()->getLocale() }}'] || reference.company_name.tr || 'Referans';
                document.getElementById('referenceModalLabel').textContent = companyName + ' Galerisi';

                if (galleryImages.length === 0) {
                    modalMainImage.src = '';
                    modalThumbnails.innerHTML = '<p class="text-center text-muted">Bu referans için galeri resmi bulunmuyor.</p>';
                    modalImageTitle.textContent = '';
                    modalImageDescription.textContent = '';
                    modalPrevBtn.style.display = 'none';
                    modalNextBtn.style.display = 'none';
                    return;
                }

                // İlk resmi göster
                updateModalImage();
                updateThumbnails();

                // Nav butonlarını göster
                modalPrevBtn.style.display = galleryImages.length > 1 ? 'flex' : 'none';
                modalNextBtn.style.display = galleryImages.length > 1 ? 'flex' : 'none';
            });

            // Resim güncelleme
            function updateModalImage() {
                const reference = references[currentReferenceIndex];
                const galleryImages = reference.gallery_images || [];

                if (galleryImages.length === 0) return;

                const currentImage = galleryImages[currentImageIndex];
                const imageUrl = currentImage.image ? `{{ asset('') }}${currentImage.image}` : '';
                const imageTitle = currentImage.image_title ? (currentImage.image_title['{{ app()->getLocale() }}'] || currentImage.image_title.tr || '') : '';
                const imageDescription = currentImage.image_description ? (currentImage.image_description['{{ app()->getLocale() }}'] || currentImage.image_description.tr || '') : '';

                modalMainImage.src = imageUrl;
                modalImageTitle.textContent = imageTitle || 'Resim ' + (currentImageIndex + 1);
                modalImageDescription.textContent = imageDescription;

                // Thumbnail'ları güncelle
                updateThumbnailsActive();
            }

            // Thumbnail'ları oluştur
            function updateThumbnails() {
                const reference = references[currentReferenceIndex];
                const galleryImages = reference.gallery_images || [];

                modalThumbnails.innerHTML = '';

                galleryImages.forEach((image, index) => {
                    const thumbnailDiv = document.createElement('div');
                    thumbnailDiv.className = 'nextmedya-modal-thumbnail' + (index === 0 ? ' active' : '');
                    thumbnailDiv.onclick = () => {
                        currentImageIndex = index;
                        updateModalImage();
                    };

                    const img = document.createElement('img');
                    img.src = `{{ asset('') }}${image.image}`;
                    img.alt = image.image_title ? (image.image_title['{{ app()->getLocale() }}'] || image.image_title.tr || '') : '';

                    thumbnailDiv.appendChild(img);
                    modalThumbnails.appendChild(thumbnailDiv);
                });
            }

            // Thumbnail aktifliğini güncelle
            function updateThumbnailsActive() {
                const thumbnails = modalThumbnails.querySelectorAll('.nextmedya-modal-thumbnail');
                thumbnails.forEach((thumb, index) => {
                    thumb.classList.toggle('active', index === currentImageIndex);
                });
            }

            // Önceki resim
            modalPrevBtn.addEventListener('click', function() {
                const reference = references[currentReferenceIndex];
                const galleryImages = reference.gallery_images || [];

                currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : galleryImages.length - 1;
                updateModalImage();
            });

            // Sonraki resim
            modalNextBtn.addEventListener('click', function() {
                const reference = references[currentReferenceIndex];
                const galleryImages = reference.gallery_images || [];

                currentImageIndex = currentImageIndex < galleryImages.length - 1 ? currentImageIndex + 1 : 0;
                updateModalImage();
            });

            // Klavye navigasyonu
            document.addEventListener('keydown', function(event) {
                if (referenceModal.classList.contains('show')) {
                    if (event.key === 'ArrowLeft') {
                        modalPrevBtn.click();
                    } else if (event.key === 'ArrowRight') {
                        modalNextBtn.click();
                    }
                }
            });
        });
    </script>
@endpush