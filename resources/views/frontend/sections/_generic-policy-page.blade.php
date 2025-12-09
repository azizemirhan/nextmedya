{{-- resources/views/frontend/sections/_generic-policy-page.blade.php --}}
@php
    $lang = app()->getLocale();
    $pageTitle = data_get($content, 'page_title.' . $lang, 'Politika Metni');
    $pageSubtitle = data_get($content, 'page_subtitle.' . $lang, '');
    $contentSections = data_get($content, 'content_sections', []);
    $showTOC = (data_get($content, 'show_table_of_contents', '1') === '1');
    $backgroundStyle = data_get($content, 'background_style', 'light');

    // CSS Class ataması
    $bgClass = match($backgroundStyle) {
        'dark' => 'bg-dark text-white',
        'light' => 'bg-white text-dark',
        'clean' => 'bg-transparent text-dark',
        default => 'bg-white text-dark',
    };
@endphp

<section class="policy-page-section py-5 py-lg-7 {{ $bgClass }}" id="policy-content-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Üst Başlık --}}
                <header class="text-center mb-5 mb-lg-6 policy-header">
                    <h1 class="display-4 fw-bolder policy-title">{{ $pageTitle }}</h1>
                    @if($pageSubtitle)
                        <p class="lead text-muted policy-subtitle">{{ $pageSubtitle }}</p>
                    @endif
                </header>

                <div class="row">

                    {{-- İçindekiler Tablosu (TOC) --}}
                    @if($showTOC && count($contentSections) > 1)
                        <div class="col-lg-3 d-none d-lg-block">
                            <aside class="toc-sidebar sticky-top" style="top: 100px;">
                                <h4 class="toc-title mb-3 fw-bold">İçindekiler</h4>
                                <nav id="policy-toc-nav">
                                    <ul class="toc-list list-unstyled">
                                        {{-- JS tarafından doldurulacak veya elle doldurulacak --}}
                                        @foreach($contentSections as $index => $section)
                                            @php
                                                $sectionSlug = Str::slug(data_get($section, 'section_title.' . $lang, 'bolum-' . $index));
                                            @endphp
                                            <li class="toc-list-item">
                                                <a href="#{{ $sectionSlug }}" class="toc-link">{{ data_get($section, 'section_title.' . $lang, 'Bölüm ' . ($index + 1)) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </aside>
                        </div>
                    @endif

                    {{-- Ana İçerik Bölümü --}}
                    <div class="{{ $showTOC && count($contentSections) > 1 ? 'col-lg-9' : 'col-lg-12' }}">
                        <div class="policy-content-body">

                            @forelse($contentSections as $index => $section)
                                @php
                                    $sectionTitle = data_get($section, 'section_title.' . $lang, 'Bölüm Başlığı');
                                    $sectionContent = data_get($section, 'section_content.' . $lang, '');
                                    $subSections = data_get($section, 'sub_sections', []);
                                    $sectionSlug = Str::slug($sectionTitle);
                                @endphp

                                <article class="content-article mb-5" id="{{ $sectionSlug }}">
                                    {{-- H2 Başlık --}}
                                    <h2 class="section-heading mb-4 fw-bold">{{ ($index + 1) . '. ' . $sectionTitle }}</h2>

                                    {{-- Ana Metin --}}
                                    <div class="section-text mb-4">
                                        {!! $sectionContent !!}
                                    </div>

                                    {{-- Alt Bölümler (H3) --}}
                                    @if(!empty($subSections))
                                        <div class="sub-sections mt-4 ps-md-4 border-start border-2 border-warning">
                                            @foreach($subSections as $subIndex => $sub)
                                                @php
                                                    $subTitle = data_get($sub, 'sub_title.' . $lang, 'Alt Başlık');
                                                    $subContent = data_get($sub, 'sub_content.' . $lang, '');
                                                @endphp
                                                <div class="sub-article mb-4">
                                                    {{-- H3 Başlık --}}
                                                    <h3 class="sub-heading mb-3 fw-semibold">{{ ($index + 1) . '.' . ($subIndex + 1) . ' ' . $subTitle }}</h3>

                                                    {{-- Alt Metin --}}
                                                    <div class="sub-text text-muted">
                                                        {!! $subContent !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>

                            @empty
                                <div class="alert alert-warning text-center">Bu sayfaya henüz içerik eklenmemiştir.</div>
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        /* Modern Policy Page CSS */
        .policy-page-section {
            min-height: 80vh;
        }

        /* Dark Mode Ayarları */
        .policy-page-section.bg-dark {
            background-color: #1a1a2e !important;
            color: #f8f9fa !important;
        }

        .policy-page-section.bg-dark .policy-title {
            color: #ffffff;
        }

        .policy-page-section.bg-dark .policy-subtitle,
        .policy-page-section.bg-dark .section-text,
        .policy-page-section.bg-dark .sub-text {
            color: #ced4da !important;
        }

        .policy-page-section.bg-dark .section-heading,
        .policy-page-section.bg-dark .sub-heading {
            color: #ffffff;
        }

        .policy-page-section.bg-dark .toc-title {
            color: #ffc107;
        }

        .policy-page-section.bg-dark .toc-link {
            color: #ced4da;
        }

        .policy-page-section.bg-dark .toc-link:hover,
        .policy-page-section.bg-dark .toc-link.active {
            color: #ffc107;
        }

        /* Başlıklar */
        .policy-title {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            color: #1a1a1a;
        }

        .policy-subtitle {
            font-size: 1.1rem;
            color: #6c757d !important;
        }

        /* İçindekiler Tablosu (TOC) */
        .toc-sidebar {
            padding-right: 15px;
            border-right: 1px solid #e9ecef;
        }

        .toc-title {
            font-size: 1.25rem;
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 8px;
            margin-bottom: 15px !important;
        }

        .toc-list-item {
            margin-bottom: 8px;
        }

        .toc-link {
            display: block;
            padding: 5px 0;
            color: #495057;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            border-left: 2px solid transparent;
            padding-left: 10px;
        }

        .toc-link:hover {
            color: #0d6efd;
            padding-left: 15px;
            border-left-color: #0d6efd;
        }

        .toc-link.active {
            color: #0d6efd;
            font-weight: 700;
            border-left-color: #0d6efd;
        }

        /* İçerik Stilleri */
        .section-heading {
            color: #212529;
            font-size: 2rem;
            padding-top: 15px; /* Sticky menü offset için */
            scroll-margin-top: 100px;
        }

        .sub-heading {
            font-size: 1.5rem;
            color: #343a40;
            padding-top: 10px;
        }

        .section-text, .sub-text {
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Quill Editor'dan gelen stilleri düzenle */
        .section-text p, .sub-text p, .section-text ul, .sub-text ul, .section-text ol, .sub-text ol {
            margin-bottom: 1rem;
        }

        .sub-sections {
            border-color: #ffc107 !important; /* Vurgu Rengi: Sarı */
            padding-left: 20px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .policy-page-section {
                padding: 40px 0;
            }

            .policy-title {
                font-size: 2.5rem;
            }

            .toc-sidebar {
                display: none; /* Mobil ve tabletlerde gizle */
            }

            .section-heading {
                font-size: 1.75rem;
            }

            .sub-heading {
                font-size: 1.35rem;
            }

            .section-text, .sub-text {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sadece TOC gösteriliyorsa çalışır
            const tocNav = document.getElementById('policy-toc-nav');
            if (!tocNav) return;

            const contentSections = document.querySelectorAll('.content-article');
            const tocLinks = tocNav.querySelectorAll('.toc-link');
            const headerOffset = 100; // Sticky header yüksekliği

            // Smooth Scroll
            tocLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        const offsetPosition = targetElement.offsetTop - headerOffset;
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Scroll Spy
            window.addEventListener('scroll', () => {
                let current = '';
                const scrollY = window.pageYOffset;

                contentSections.forEach(section => {
                    const sectionTop = section.offsetTop - headerOffset;
                    const sectionBottom = sectionTop + section.offsetHeight;

                    if (scrollY >= sectionTop && scrollY < sectionBottom) {
                        current = section.getAttribute('id');
                    }
                });

                tocLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href').substring(1) === current) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
@endpush