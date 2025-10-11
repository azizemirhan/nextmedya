@extends('frontend.layouts.master')

{{-- SAYFAYA ÖZEL SEO BİLGİLERİ (mantık korunmuştur) --}}
@section('page_meta')
    <title>{{ $service->getTranslation('title', app()->getLocale()) }}</title>
    <meta name="description" content="{{ $service->getTranslation('summary', app()->getLocale()) }}">
    <meta name="keywords" content="hizmet, {{ $service->getTranslation('title', app()->getLocale()) }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $service->getTranslation('title', app()->getLocale()) }}" />
    <meta property="og:description" content="{{ $service->getTranslation('summary', app()->getLocale()) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($service->cover_image)
        <meta property="og:image" content="{{ asset($service->cover_image) }}" />
    @endif
@endsection

@push('styles')
    <style>
        :root{
            --nx-primary:#e8d32a; /* kurumsal sarı */
            --nx-bg:#0f1115;      /* koyu arka plan */
            --nx-card:#151922;    /* kart arka planı */
            --nx-text:#e9edf1;    /* temel metin */
            --nx-muted:#a7b0be;   /* ikincil metin */
            --nx-border:rgba(255,255,255,.08);
            --nx-glow:0 10px 40px rgba(15, 52, 96, .15);
        }
        h2 {
            color: #fff;
        }
        p {
            color: #fff;
        }

        .nx-service{background:radial-gradient(1400px 400px at 10% -10%, rgba(232,211,42,.08), transparent 60%),
        radial-gradient(1200px 350px at 110% -20%, rgba(232,211,42,.06), transparent 60%),
        var(--nx-bg);color:var(--nx-text)}
        .nx-wrap{padding:64px 0}

        /* tipografi */
        .nx-h1{font-size:clamp(26px,2.6vw,34px);font-weight:800;letter-spacing:.2px;margin:0 0 14px}
        .nx-lead{font-size:clamp(16px,1.2vw,18px);color:var(--nx-muted);margin-bottom:24px}

        /* kart */
        .nx-card{background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(255,255,255,.01));
            border:1px solid var(--nx-border);border-radius:16px;box-shadow:var(--nx-glow);
            backdrop-filter:saturate(120%) blur(2px)}
        .nx-card .nx-card-body{padding:22px}
        .nx-card + .nx-card{margin-top:16px}

        /* görsel kapak */
        .nx-cover{display:block;border-radius:14px;overflow:hidden;border:1px solid var(--nx-border)}
        .nx-cover img{width:100%;height:auto;display:block;aspect-ratio:16/9;object-fit:cover;transition:transform .35s ease}
        .nx-cover:hover img{transform:scale(1.02)}

        /* sticky side */
        .nx-sticky{position:sticky;top:110px}

        /* içerik gövdesi */
        .nx-prose{line-height:1.7;color:var(--nx-text)}
        .nx-prose h2{font-size:clamp(20px,1.8vw,26px);margin:28px 0 14px;font-weight:700}
        .nx-prose p{margin:0 0 14px}

        .nx-prose img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 16px 0
        }
        .nx-panel{border:1px dashed rgba(255,255,255,.14);border-radius:12px;padding:18px 18px 2px;margin-top:18px}

        /* faydalar */
        .nx-benefits{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
        @media (max-width:768px){.nx-benefits{grid-template-columns:1fr}}
        .nx-benefit{display:flex;gap:12px;align-items:flex-start;padding:14px;border:1px solid var(--nx-border);border-radius:12px;background:rgba(255,255,255,.02)}
        .nx-benefit i{color:var(--nx-primary);font-size:18px;margin-top:4px}

        /* destek kutuları */
        .nx-support{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
        @media (max-width:768px){.nx-support{grid-template-columns:1fr}}
        .nx-support-item{display:flex;gap:14px;align-items:center;padding:16px;border:1px solid var(--nx-border);border-radius:14px;background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(255,255,255,.01));transition:transform .2s ease,border .2s ease}
        .nx-support-item:hover{transform:translateY(-3px);border-color:rgba(232,211,42,.45)}
        .nx-support-item i{color:var(--nx-primary);font-size:20px}

        /* akordiyon (Bootstrap ile uyumlu) */
        .nx-accordion .accordion-item{background:transparent;border:1px solid var(--nx-border);border-radius:12px;overflow:hidden}
        .nx-accordion .accordion-item + .accordion-item{margin-top:12px}
        .nx-accordion .accordion-button{background:rgba(255,255,255,.02);color:var(--nx-text);font-weight:600}
        .nx-accordion .accordion-button:focus{box-shadow:0 0 0 .25rem rgba(232,211,42,.25)}
        .nx-accordion .accordion-button:not(.collapsed){background:rgba(232,211,42,.15);color:#0d0f14}
        .nx-accordion .accordion-body{color:var(--nx-text)}
        .nx-accordion .accordion-button::after{filter:grayscale(100%)}

        /* TOC */
        .nx-toc{padding:16px}
        .nx-toc h6{font-weight:700;margin:0 0 10px;color:var(--nx-muted);text-transform:uppercase;letter-spacing:.6px;font-size:12px}
        .nx-toc ul{list-style:none;margin:0;padding:0;display:grid;gap:8px}
        .nx-toc a{display:flex;align-items:center;gap:8px;text-decoration:none;color:var(--nx-text);padding:10px 12px;border:1px solid var(--nx-border);border-radius:10px}
        .nx-toc a:hover{border-color:rgba(232,211,42,.5)}
        .nx-dot{width:8px;height:8px;border-radius:999px;background:var(--nx-primary)}

        /* CTA kartı */
        .nx-cta{display:flex;align-items:center;justify-content:space-between;gap:12px}
        .nx-cta .btn{font-weight:700;border-radius:10px; color: #fff}
        .btn-nx{--bs-btn-color:#0d0f14;--bs-btn-bg:var(--nx-primary);--bs-btn-border-color:var(--nx-primary);--bs-btn-hover-bg:#f0e95e;--bs-btn-hover-border-color:#f0e95e}

        /* yardımcı */
        .visually-hidden{position:absolute!important;clip:rect(1px,1px,1px,1px);padding:0;border:0;height:1px;width:1px;overflow:hidden}
        @media (prefers-reduced-motion:reduce){
            *{transition:none!important;animation:none!important}
        }

        /* Diğer Hizmetler mini kartı */
        .nx-card-services .nx-svc-items{display:flex;flex-direction:column;gap:10px}
        .nx-svc-item{display:flex;gap:12px;align-items:center;text-decoration:none;color:var(--nx-text);
            border:1px solid var(--nx-border);border-radius:12px;padding:10px;background:rgba(255,255,255,.02);
            transition:transform .2s ease,border-color .2s ease}
        .nx-svc-item:hover{transform:translateY(-2px);border-color:rgba(232,211,42,.45)}
        .nx-svc-thumb{width:64px;height:64px;border-radius:10px;overflow:hidden;flex:0 0 64px;
            background:rgba(255,255,255,.04);display:grid;place-items:center}
        .nx-svc-thumb img{width:100%;height:100%;object-fit:cover;display:block}
        .nx-svc-placeholder{width:36px;height:36px;border-radius:8px;
            background:linear-gradient(135deg, rgba(232,211,42,.30), rgba(232,211,42,.08));box-shadow:var(--nx-glow)}
        .nx-svc-meta{display:flex;flex-direction:column;gap:2px;min-width:0}
        .nx-svc-title{font-weight:700;font-size:14px;line-height:1.2}
        .nx-svc-desc{font-size:12px;color:var(--nx-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

        /* Öne Çıkan Hizmet Kartı */
        .nx-featured-service {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border: 2px solid rgba(255, 255, 255, .15);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px
        }

        .nx-featured-service h3 {
            color: var(--nx-primary);
            margin-bottom: 12px;
            font-size: 18px;
            font-weight: 800
        }

        .nx-featured-service p {
            color: var(--nx-text);
            margin-bottom: 16px;
            font-size: 14px
        }

        .nx-featured-service .btn {
            width: 100%
        }

        /* Modern Galeri */
        .nx-gallery {
            display: grid;
            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px
        }

        @media (max-width: 768px) {
            .nx-gallery {
                grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
                gap: 15px
            }
        }

        .nx-gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            background: rgba(255, 255, 255, .02);
            border: 1px solid var(--nx-border);
            transition: transform .3s ease, box-shadow .3s ease
        }

        .nx-gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: var(--nx-glow)
        }

        .nx-gallery-image {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden
        }

        .nx-gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .nx-gallery-item:hover .nx-gallery-image img {
            transform: scale(1.1)
        }

        .nx-gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 0, 0, .6), rgba(232, 211, 42, .2));
            opacity: 0;
            transition: opacity .3s ease;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .nx-gallery-item:hover .nx-gallery-overlay {
            opacity: 1
        }

        .nx-gallery-btn {
            background: var(--nx-primary);
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            color: #0d0f14;
            font-size: 20px;
            cursor: pointer;
            transition: transform .2s ease;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .nx-gallery-btn:hover {
            transform: scale(1.1)
        }

        /* Lightbox */
        .nx-lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .95);
            backdrop-filter: blur(10px)
        }

        .nx-lightbox.active {
            display: flex;
            align-items: center;
            justify-content: center
        }

        .nx-lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            margin: auto
        }

        .nx-lightbox-content img {
            width: 100%;
            height: auto;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 12px
        }

        .nx-lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            transition: color .2s ease;
            z-index: 10001
        }

        .nx-lightbox-close:hover {
            color: var(--nx-primary)
        }

        .nx-lightbox-prev, .nx-lightbox-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            color: white;
            padding: 16px 20px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            transition: all .2s ease;
            backdrop-filter: blur(10px)
        }

        .nx-lightbox-prev:hover, .nx-lightbox-next:hover {
            background: var(--nx-primary);
            color: #0d0f14
        }

        .nx-lightbox-prev {
            left: -80px
        }

        .nx-lightbox-next {
            right: -80px
        }

        .nx-lightbox-counter {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 14px;
            background: rgba(0, 0, 0, .7);
            padding: 8px 16px;
            border-radius: 20px
        }

        @media (max-width: 768px) {
            .nx-lightbox-prev {
                left: 10px
            }

            .nx-lightbox-next {
                right: 10px
            }

            .nx-lightbox-close {
                top: 10px;
                right: 20px
            }

            .nx-lightbox-counter {
                bottom: 20px
            }
        }

    </style>
@endpush
@section('content')
    {{-- Üst bant (mevcut bileşen korunur) --}}
    <x-page-banner :title="$pageTitle" :subtitle="$pageSubtitle"/>

    <section class="nx-service">
        <div class="container nx-wrap">
            <div class="row g-4 g-xxl-5">
                {{-- SOL SÜTUN --}}
                <div class="col-lg-8" data-aos="fade-up">

                    <h1 class="visually-hidden">{{ $service->getTranslation('title', app()->getLocale()) }}</h1>

                    {{-- Özet/Kısa Tanım --}}
                    @if($service->getTranslation('summary', app()->getLocale()))
                        <p class="nx-lead">{{ $service->getTranslation('summary', app()->getLocale()) }}</p>
                    @endif

                    {{-- Kapak görseli (varsa) --}}
                    @if($service->cover_image)
                        <a class="nx-cover mb-3 d-block"
                           href="{{ asset($service->cover_image) }}" target="_blank"
                           rel="noopener">
                            <img src="{{ asset($service->cover_image) }}"
                                 alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                        </a>
                    @endif

                    {{-- Ana içerik --}}
                    <article id="details" class="nx-card">
                        <div class="nx-card-body nx-prose">
                            {!! $service->getTranslation('content', app()->getLocale()) !!}

                            @if($service->expectations_content)
                                <div class="nx-panel">
                                    <h2 class="mt-1 mb-2">{{ __('Highest Expectations') }}</h2>
                                    <div
                                        class="nx-prose">{!! $service->getTranslation('expectations_content', app()->getLocale()) !!}</div>
                                </div>
                            @endif
                        </div>
                    </article>

                    {{-- Faydalar --}}
                    @if(!empty($service->benefits))
                        <section id="benefits" class="mt-4" data-aos="fade-up"
                                 data-aos-delay="50">
                            <div class="nx-card">
                                <div class="nx-card-body">
                                    <h2 class="mb-3">{{ __('Benefits of the Service') }}</h2>
                                    <div class="nx-benefits">
                                        @foreach($service->benefits as $benefit)
                                            <div class="nx-benefit">
                                                <i class="fa-solid fa-check-circle"
                                                   aria-hidden="true"></i>
                                                <span>{{ data_get($benefit, 'text.' . app()->getLocale()) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Destek Öğeleri --}}
                    @if(!empty($service->support_items) && collect($service->support_items)->isNotEmpty())
                        <section id="support" class="mt-4" data-aos="fade-up"
                                 data-aos-delay="100">
                            <div class="nx-card">
                                <div class="nx-card-body">
                                    <h2 class="mb-3">{{ __('How Can We Help?') }}</h2>
                                    <div class="nx-support">
                                        @foreach($service->support_items as $item)
                                            <div class="nx-support-item">
                                                <i class="fa-solid fa-shield-halved"
                                                   aria-hidden="true"></i>
                                                <p class="m-0 fw-medium">{{ data_get($item, 'text.' . app()->getLocale()) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- SSS --}}
                    @if(!empty($service->faqs))
                        <section id="faq" class="mt-4" data-aos="fade-up" data-aos-delay="150">
                            <div class="nx-card">
                                <div class="nx-card-body">
                                    <h2 class="mb-3">{{ __('Frequently Asked Questions') }}</h2>
                                    <div class="accordion nx-accordion"
                                         id="accordion-service-faq">
                                        @foreach($service->faqs as $faq)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header"
                                                    id="heading-faq-{{ $loop->index }}">
                                                    <button class="accordion-button collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-faq-{{ $loop->index }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-faq-{{ $loop->index }}">
                                                        {{ data_get($faq, 'question.' . app()->getLocale()) }}
                                                    </button>
                                                </h2>
                                                <div id="collapse-faq-{{ $loop->index }}"
                                                     class="accordion-collapse collapse"
                                                     data-bs-parent="#accordion-service-faq"
                                                     aria-labelledby="heading-faq-{{ $loop->index }}">
                                                    <div
                                                        class="accordion-body nx-prose">{!! data_get($faq, 'answer.' . app()->getLocale()) !!}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Alt CTA --}}
                    <div class="nx-card mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="nx-card-body nx-cta">
                            <div>
                                <div class="fw-bold">{{ __('Schedule a quick discovery call about this service') }}
                                </div>
                                <div class="text-muted">{{ __('Average response: same business day') }}</div>
                            </div>
                            <a href="#" class="btn btn-nx btn-lg" data-contact-trigger>{{ __('Get a Quote') }}</a>
                        </div>
                    </div>

                    {{-- Proje Galerisi --}}
                    @if(!empty($service->gallery_images) && count($service->gallery_images) > 0)
                        <section id="projects" class="mt-4" data-aos="fade-up"
                                 data-aos-delay="250">
                            <div class="nx-card">
                                <div class="nx-card-body">
                                    <h2 class="mb-4">{{ __('Projects Related to This Service') }}</h2>
                                    <div class="nx-gallery">
                                        @foreach($service->gallery_images as $index => $image)
                                            <div class="nx-gallery-item" data-aos="fade-up"
                                                 data-aos-delay="{{ 50 * ($index % 6) }}">
                                                <div class="nx-gallery-image">
                                                    <img src="{{ asset($image) }}"
                                                         alt="Proje {{ $index + 1 }}"
                                                         loading="lazy">
                                                    <div class="nx-gallery-overlay">
                                                        <button class="nx-gallery-btn"
                                                                onclick="openLightbox({{ $index }})">
                                                            <i class="fa-solid fa-expand"
                                                               aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Lightbox Modal --}}
                        <div id="lightbox" class="nx-lightbox" onclick="closeLightbox()">
                            <div class="nx-lightbox-content">
                                <span class="nx-lightbox-close" onclick="closeLightbox()">&times;</span>
                                <button class="nx-lightbox-prev" onclick="changeImage(-1)">
                                    &#10094;
                                </button>
                                <img id="lightbox-image" src="" alt="">
                                <button class="nx-lightbox-next" onclick="changeImage(1)">
                                    &#10095;
                                </button>
                                <div class="nx-lightbox-counter">
                                    <span id="image-counter"></span>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- SAĞ SÜTUN --}}
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="150">
                    <aside class="nx-sticky">

                        {{-- Diğer Hizmetlerimiz Kartı --}}
                        @php
                            // Bir sonraki hizmet (sıra bazında veya ID bazında)
                            $nextService = \App\Models\Service::query()
                                ->where('is_active', true)
                                ->where('id', '!=', $service->id)
                                ->where(function($q) use ($service) {
                                    $q->where('order', '>', $service->order)
                                      ->orWhere(function($subQ) use ($service) {
                                          $subQ->where('order', $service->order)
                                               ->where('id', '>', $service->id);
                                      });
                                })
                                ->orderBy('order')
                                ->orderBy('id')
                                ->first();

                            // Eğer bir sonraki hizmet yoksa, en baştan al
                            if (!$nextService) {
                                $nextService = \App\Models\Service::query()
                                    ->where('is_active', true)
                                    ->where('id', '!=', $service->id)
                                    ->orderBy('order')
                                    ->orderBy('id')
                                    ->first();
                            }
                        @endphp

                        @if($nextService)
                            <div class="nx-featured-service">
                                <div class="d-flex gap-3 align-items-start mb-3">
                                    @if($nextService->cover_image)
                                        <div class="nx-svc-thumb">
                                            <img src="{{ asset($nextService->cover_image) }}"
                                                 alt="{{ $nextService->getTranslation('title', app()->getLocale()) }}">
                                        </div>
                                    @else
                                        <div class="nx-svc-thumb">
                                                                    <span class="nx-svc-placeholder"
                                                                          aria-hidden="true"></span>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: var(--nx-text);">
                                            {{ $nextService->getTranslation('title', app()->getLocale()) }}
                                        </h4>
                                        @if($nextService->getTranslation('summary', app()->getLocale()))
                                            <p style="font-size: 13px; margin-bottom: 0;">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($nextService->getTranslation('summary', app()->getLocale())), 80) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('frontend.services.show', $nextService->slug) }}"
                                   class="btn-contact">
                                    {{ __('Our Other Services')  }}
                                </a>
                            </div>
                        @endif

                        {{-- İçindekiler / TOC --}}
                        <div class="nx-card">
                            <div class="nx-toc">
                                <h6> {{ __('Contents')  }}</h6>
                                <ul>
                                    <li><a href="#details"><span class="nx-dot"></span><span>{{ __('Details')  }}</span></a>
                                    </li>
                                    @if(!empty($service->benefits))
                                        <li><a href="#benefits"><span
                                                    class="nx-dot"></span><span>{{ __('Benefits')  }}</span></a>
                                        </li>
                                    @endif
                                    @if(!empty($service->support_items) && collect($service->support_items)->isNotEmpty())
                                        <li><a href="#support"><span
                                                    class="nx-dot"></span><span>{{ __('Areas of Support')  }}</span></a>
                                        </li>
                                    @endif
                                    @if(!empty($service->faqs))
                                        <li><a href="#faq"><span
                                                    class="nx-dot"></span><span>{{ __('FAQ')  }}</span></a>
                                        </li>
                                    @endif
                                    @if(!empty($service->gallery_images) && count($service->gallery_images) > 0)
                                        <li><a href="#projects"><span
                                                    class="nx-dot"></span><span>{{ __('Projects')  }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        {{-- Hızlı CTA --}}
                        <div class="nx-card">
                            <div class="nx-card-body">
                                <div
                                    class="d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <div class="fw-bold">{{ __('Contact Us Now')  }}</div>
                                        <small class="text-muted">{{ __('Quick Response to Your Questions')  }}</small>
                                    </div>
                                    <a href="#" class="btn btn-nx" data-contact-trigger>{{ __('Get in touch') }}</a>
                                </div>
                            </div>
                        </div>

                        {{-- Diğer Tüm Hizmetler Listesi --}}
                        @php
                            if (!isset($sidebarServices)) {
                                $sidebarServices = \App\Models\Service::query()
                                    ->where('is_active', true)
                                    ->where('id','!=',$service->id)
                                    ->orderBy('order')
                                    ->orderByDesc('id')
                                    ->limit(4)
                                    ->get();
                            }
                        @endphp
                        @if(isset($sidebarServices) && $sidebarServices->isNotEmpty())
                            <div class="nx-card nx-card-services">
                                <div class="nx-card-body">
                                    <h3 class="mb-3" style="font-size:16px;font-weight:800">{{ __('All Our Services')  }}</h3>

                                    <div class="nx-svc-items">
                                        @foreach($sidebarServices as $s)
                                            @php
                                                $title   = $s->getTranslation('title', app()->getLocale());
                                                $summary = $s->getTranslation('summary', app()->getLocale());
                                                $href    = \Illuminate\Support\Facades\Route::has('frontend.services.show')
                                                            ? route('frontend.services.show', $s->slug)
                                                            : url('services/'.$s->slug);
                                            @endphp

                                            <a class="nx-svc-item" href="{{ $href }}"
                                               aria-label="{{ $title }}">
                    <span class="nx-svc-thumb">
                        @if($s->cover_image)
                            <img src="{{ asset($s->cover_image) }}" alt="{{ $title }}">
                        @else
                            <span class="nx-svc-placeholder" aria-hidden="true"></span>
                        @endif
                    </span>
                                                <span class="nx-svc-meta">
                        <span class="nx-svc-title">{{ $title }}</span>
                        @if(!empty($summary))
                                                        <span
                                                            class="nx-svc-desc">{{ \Illuminate\Support\Str::limit(strip_tags($summary), 70) }}</span>
                                                    @endif
                    </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Lightbox functionality
        let currentImageIndex = 0;
        const images = @json($service->gallery_images ?? []);

        function openLightbox(index) {
            currentImageIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const counter = document.getElementById('image-counter');

            lightboxImage.src = "{{ asset('') }}" + images[currentImageIndex];
            counter.textContent = `${currentImageIndex + 1} / ${images.length}`;
            lightbox.classList.add('active');

            // Prevent body scroll when lightbox is open
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function changeImage(direction) {
            currentImageIndex += direction;

            if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            } else if (currentImageIndex < 0) {
                currentImageIndex = images.length - 1;
            }

            const lightboxImage = document.getElementById('lightbox-image');
            const counter = document.getElementById('image-counter');

            lightboxImage.src = "{{ asset('') }}" + images[currentImageIndex];
            counter.textContent = `${currentImageIndex + 1} / ${images.length}`;
        }

        // Keyboard navigation
        document.addEventListener('keydown', function (e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox && lightbox.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    changeImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeImage(1);
                }
            }
        });

        // Prevent event bubbling on lightbox content
        document.querySelector('.nx-lightbox-content')?.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    </script>
@endpush
