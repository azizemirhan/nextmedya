{{-- resources/views/frontend/sections/_image-gallery.blade.php --}}

@php
    // Panelden girilen veriler
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Galerimiz');
    $description = data_get($content, 'description.' . app()->getLocale());

    // Data handler'dan gelen resimler - Media modeli kullanılıyor
    $images = $dynamicData['images'] ?? collect();
@endphp

<section class="gallery-section" id="gallery">
    <div class="container">
        {{-- Başlık ve Açıklama --}}
        <div class="gallery-header">
            <h2 class="gallery-title">{{ $mainTitle }}</h2>

            @if($description)
                <div class="gallery-description">
                    {!! $description !!}
                </div>
            @endif
        </div>

        {{-- Galeri İçeriği --}}
        @if($images->isNotEmpty())
            <div class="gallery-wrapper">
                @foreach($images as $index => $image)
                    @php
                        // Media modelinden gelen çok dilli başlık ve alt metinleri parse et
                        $titleData = is_string($image->title) ? json_decode($image->title, true) : $image->title;
                        $altData = is_string($image->alt) ? json_decode($image->alt, true) : $image->alt;
                        $captionData = is_string($image->caption) ? json_decode($image->caption, true) : $image->caption;

                        $imageTitle = $titleData[app()->getLocale()] ?? $titleData['tr'] ?? '';
                        $imageAlt = $altData[app()->getLocale()] ?? $altData['tr'] ?? $imageTitle;
                        $imageCaption = $captionData[app()->getLocale()] ?? $captionData['tr'] ?? '';

                        // Resim URL'lerini belirle
                        $imageUrl = $image->cdn_url ?? $image->url ?? '';

                        // Varyantları kontrol et (thumbnail için)
                        $variants = is_string($image->variants) ? json_decode($image->variants, true) : $image->variants;
                        $thumbnailUrl = isset($variants['medium'])
                            ? asset('storage/' . $variants['medium']['path'])
                            : $imageUrl;
                    @endphp

                    <div class="gallery-item"
                         data-aos="fade-up"
                         data-aos-delay="{{ $index * 100 }}"
                         data-lightbox="gallery"
                         data-title="{{ $imageTitle }}"
                         data-full-image="{{ $imageUrl }}"
                         tabindex="0"
                         role="button"
                         aria-label="{{ $imageAlt ?: 'Galeri resmi ' . ($index + 1) }}">

                        <div class="image-container">
                            <img src="{{ $thumbnailUrl }}"
                                 alt="{{ $imageAlt }}"
                                 class="gallery-image"
                                 loading="lazy"
                                 data-src="{{ $imageUrl }}"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}';">
                        </div>

                        {{-- Resim başlığı veya açıklaması varsa göster --}}
                        @if($imageTitle || $imageCaption)
                            <div class="gallery-item-overlay">
                                @if($imageTitle)
                                    <h3 class="gallery-item-title">
                                        {{ $imageTitle }}
                                    </h3>
                                @endif

                                @if($imageCaption)
                                    <p class="gallery-item-description">
                                        {{ $imageCaption }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Opsiyonel: Load More Butonu (eğer çok fazla resim varsa) --}}
            @if($images->count() > 12)
                <div class="gallery-load-more">
                    <button class="btn-load-more" id="loadMoreGallery">
                        <span>{{ __('Show More') }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            @endif
        @else
            {{-- Boş Durum --}}
            <div class="empty-gallery">
                <p>{{ __('No image found to display.') }}</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        /* Overlay için ek stiller (opsiyonel başlık/açıklama gösterimi) */
        .gallery-item-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 100%);
            color: white;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 3;
        }

        .gallery-item:hover .gallery-item-overlay {
            transform: translateY(0);
        }

        .gallery-item-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .gallery-item-description {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.4;
        }

        /* Load More Button */
        .gallery-load-more {
            text-align: center;
            margin-top: 50px;
        }

        .btn-load-more {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%)
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-load-more:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-load-more i {
            transition: transform 0.3s ease;
        }

        .btn-load-more:hover i {
            transform: translateY(2px);
        }

        /* Initially hide items after 12th */
        .gallery-wrapper .gallery-item:nth-child(n+13) {
            display: none;
        }

        .gallery-wrapper.show-all .gallery-item {
            display: block;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lightbox için tıklama eventi
            const galleryItems = document.querySelectorAll('.gallery-item');

            galleryItems.forEach(item => {
                item.addEventListener('click', function () {
                    const imgSrc = this.querySelector('.gallery-image').src;
                    const title = this.dataset.title || '';

                    // Lightbox gösterme kodu (lightbox kütüphanesi entegre edilmişse)
                    if (typeof lightbox !== 'undefined') {
                        // Lightbox açma kodu
                    } else {
                        // Basit modal açma (opsiyonel)
                        openImageModal(imgSrc, title);
                    }
                });

                // Keyboard accessibility
                item.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });

            // Load More fonksiyonalitesi
            const loadMoreBtn = document.getElementById('loadMoreGallery');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function () {
                    const wrapper = document.querySelector('.gallery-wrapper');
                    wrapper.classList.toggle('show-all');

                    if (wrapper.classList.contains('show-all')) {
                        this.querySelector('span').textContent = '{{ __('Show Less') }}';
                        this.querySelector('i').style.transform = 'rotate(180deg)';
                    } else {
                        this.querySelector('span').textContent = '{{ __('Show More') }}';
                        this.querySelector('i').style.transform = 'rotate(0)';

                        // Sayfayı galeri bölümüne kaydır
                        document.getElementById('gallery').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // Lazy loading for images
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('.gallery-image').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        });

        // Basit modal fonksiyonu (opsiyonel)
        function openImageModal(src, title) {
            // Modal oluştur
            const modal = document.createElement('div');
            modal.className = 'image-modal';
            modal.innerHTML = `
        <div class="modal-overlay" onclick="closeImageModal()"></div>
        <div class="modal-content">
            <span class="modal-close" onclick="closeImageModal()">&times;</span>
            <img src="${src}" alt="${title}">
            ${title ? `<div class="modal-caption">${title}</div>` : ''}
        </div>
    `;

            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';

            // ESC tuşu ile kapatma
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        }

        function closeImageModal() {
            const modal = document.querySelector('.image-modal');
            if (modal) {
                modal.remove();
                document.body.style.overflow = '';
            }
        }
    </script>

    {{-- Modal CSS --}}
    <style>
        .image-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            cursor: pointer;
        }

        .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            z-index: 1;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: -40px;
            color: white;
            font-size: 40px;
            font-weight: 300;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .modal-close:hover {
            transform: rotate(90deg);
        }

        .modal-caption {
            text-align: center;
            color: white;
            margin-top: 20px;
            font-size: 18px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .modal-close {
                top: 10px;
                right: 10px;
                background: rgba(0, 0, 0, 0.5);
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                font-size: 30px;
            }
        }
    </style>
@endpush

{{-- AOS (Animate On Scroll) Library (opsiyonel) --}}
@push('scripts')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
@endpush
