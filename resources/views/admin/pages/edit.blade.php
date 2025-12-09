@extends('admin.layouts.master')

@section('title', 'Sayfa Düzenle: ' . $page->getTranslation('title', 'tr'))

@push('styles')
    {{-- Quill Editor CSS --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        .draggable-item {
            cursor: grab;
        }

        .sortable-handle {
            cursor: move;
        }

        #page-canvas .placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 100px;
            margin-bottom: 1rem;
            border-radius: .375rem;
        }

        .ui-draggable-dragging {
            z-index: 1050;
            width: 350px !important;
            opacity: 0.9;
        }

        #page-canvas:empty {
            min-height: 150px;
            border: 2px dashed #ced4da;
            background-color: #f8f9fa;
            border-radius: .375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            float: left;
            width: 100%;
        }

        #page-canvas:empty::before {
            content: "Kullanılabilir Alanları Buraya Sürükleyin";
            color: #6c757d;
            font-style: italic;
        }

        /* Repeater Stil Ayarları */
        .repeater-item {
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #f1f2f3;
        }

        .repeater-item .btn-danger {
            float: right;
        }

        /* Quill Editor Yükseklik Ayarı */
        .ql-editor {
            min-height: 150px;
        }


        #page-canvas {
            min-height: 150px;
            position: relative;
        }

        /* Canvas boşken gösterilecek mesaj */
        #page-canvas:empty {
            border: 2px dashed #ced4da;
            background-color: #f8f9fa;
            border-radius: .375rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #page-canvas:empty::before {
            content: "Kullanılabilir Alanları Buraya Sürükleyin";
            color: #6c757d;
            font-style: italic;
            pointer-events: none; /* Bu satır önemli - metni tıklanamaz yapar */
        }

        /* Sürükleme sırasında gösterilecek placeholder */
        #page-canvas .placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 100px;
            margin-bottom: 1rem;
            border-radius: .375rem;
        }

        /* Repeater Sortable Stilleri */
        .repeater-drag-handle {
            cursor: move !important;
        }

        .repeater-placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 80px;
            margin-bottom: 1rem;
            border-radius: .375rem;
            visibility: visible !important;
        }

        .sortable-repeater .repeater-item {
            transition: all 0.3s ease;
        }

        .sortable-repeater .ui-sortable-helper {
            opacity: 0.8;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Repeater Accordion Stilleri */
        .repeater-item-accordion {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background: #fff;
            transition: all 0.2s ease;
        }

        .repeater-item-accordion:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .repeater-item-header {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            gap: 0.5rem;
        }

        .repeater-drag-handle {
            color: #6c757d;
            font-size: 1.2rem;
            cursor: move;
            flex-shrink: 0;
        }

        .repeater-toggle-btn {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            padding: 0;
            text-align: left;
            cursor: pointer;
            color: #212529;
            font-weight: 500;
        }

        .repeater-toggle-btn:hover {
            color: #0d6efd;
        }

        .collapse-icon {
            transition: transform 0.3s ease;
            font-size: 0.875rem;
        }

        .repeater-toggle-btn[aria-expanded="true"] .collapse-icon {
            transform: rotate(180deg);
        }

        .repeater-title {
            font-size: 0.95rem;
        }

        .btn-close-repeater {
            width: 1.5rem;
            height: 1.5rem;
            padding: 0;
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            border: 0;
            opacity: 0.5;
            cursor: pointer;
            flex-shrink: 0;
        }

        .btn-close-repeater:hover {
            opacity: 1;
        }

        .repeater-item-body {
            padding: 1rem;
        }

        /* Sortable için placeholder */
        .repeater-placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 60px;
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
            visibility: visible !important;
        }

        .sortable-repeater .ui-sortable-helper {
            opacity: 0.9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Hareket animasyonu */
        .canvas-item {
            transition: all 0.3s ease;
        }

        .canvas-item.bg-light {
            background-color: #e3f2fd !important;
        }

        /* Buton stilleri */
        .move-section-up:hover,
        .move-section-down:hover {
            background-color: #e9ecef;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <form id="page-form" action="{{ route('admin.pages.update', $page) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Üst Bar --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0 text-gray-800">Sayfa Düzenle</h1>
                <div>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Vazgeç</a>
                    <button type="submit" class="btn btn-primary">Sayfayı Kaydet</button>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                {{-- SOL KOLON: Kullanılabilir Alanlar --}}
                <div class="col-12 col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Kullanılabilir Alanlar</h5></div>
                        <div class="list-group list-group-flush" id="available-sections">
                            @foreach($availableSections as $key => $section)
                                <div class="list-group-item draggable-item" data-section-key="{{ $key }}">
                                    <i class="bi bi-grip-vertical me-2"></i> {{ $section['name'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- SAĞ KOLON: Sayfa Yapısı --}}
                <div class="col-12 col-lg-8">
                    {{-- Sayfa Ayarları Kartı (Bu kısım aynı kalıyor) --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Sayfa Ayarları</h5>
                        </div>
                        <div class="card-body">
                            @php
                                // View Composer'dan gelmiyorsa veya bir sorun olursa diye varsayılan dilleri belirleyelim.
                                if (!isset($activeLanguages)) {
                                    $activeLanguages = collect(config('languages.supported'))->only(['tr', 'en']);
                                }
                            @endphp

                            {{-- Sayfa Başlığı (Dinamik) --}}
                            <div class="mb-3">
                                <label class="form-label">Sayfa Başlığı <span class="text-danger">*</span></label>
                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                    @foreach($activeLanguages as $code => $lang)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab" data-bs-target="#edit-title-{{ $code }}"
                                                    type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="edit-title-{{ $code }}" role="tabpanel">
                                            <input type="text" name="title[{{ $code }}]" class="form-control"
                                                   value="{{ old('title.'.$code, $page->getTranslation('title', $code)) }}"
                                                    {{-- Sadece ilk dilin zorunlu olmasını sağlıyoruz --}}
                                                    {{ $loop->first ? 'required' : '' }}>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <h5 class="mb-3">Sayfa Banner Ayarları</h5>

                            {{-- Banner Başlığı (Dinamik) --}}
                            <div class="mb-3">
                                <label class="form-label">Banner Başlığı</label>
                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                    @foreach($activeLanguages as $code => $lang)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab" data-bs-target="#edit-banner-title-{{ $code }}"
                                                    type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="edit-banner-title-{{ $code }}" role="tabpanel">
                                            <input type="text" name="banner_title[{{ $code }}]" class="form-control"
                                                   placeholder="Banner'da görünecek {{ $lang['native'] }} başlık"
                                                   value="{{ old('banner_title.'.$code, $page->getTranslation('banner_title', $code)) }}">
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">Bu alanı boş bırakırsanız, sayfa başlığı kullanılır.</small>
                            </div>

                            {{-- Banner Alt Başlığı (Dinamik) --}}
                            <div class="mb-3">
                                <label class="form-label">Banner Alt Başlığı</label>
                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                    @foreach($activeLanguages as $code => $lang)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#edit-banner-subtitle-{{ $code }}"
                                                    type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="edit-banner-subtitle-{{ $code }}" role="tabpanel">
                                            <input type="text" name="banner_subtitle[{{ $code }}]" class="form-control"
                                                   placeholder="Banner'da görünecek {{ $lang['native'] }} alt başlık"
                                                   value="{{ old('banner_subtitle.'.$code, $page->getTranslation('banner_subtitle', $code)) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- SEO Alanları için Accordion --}}
                            <div class="accordion" id="seoAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeo">
                                            Gelişmiş SEO Ayarları
                                        </button>
                                    </h2>
                                    <div id="collapseSeo" class="accordion-collapse collapse" data-bs-parent="#seoAccordion">
                                        <div class="accordion-body">
                                            {{-- Temel SEO --}}
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    {{-- SEO Başlık --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">SEO Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="seo_title[{{ $code }}]"
                                                                   class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} SEO Başlık"
                                                                   value="{{ old('seo_title.'.$code, $page->getTranslation('seo_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    {{-- Meta Açıklaması --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Meta Açıklaması</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="meta_description[{{ $code }}]"
                                                                      class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                      rows="3"
                                                                      placeholder="{{ $lang['native'] }} Meta Açıklaması">{{ old('meta_description.'.$code, $page->getTranslation('meta_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    {{-- Anahtar Kelimeler --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Anahtar Kelimeler</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="keywords[{{ $code }}]"
                                                                   class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} Anahtar Kelimeler"
                                                                   value="{{ old('keywords.'.$code, $page->getTranslation('keywords', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    {{-- Odak Anahtar Kelime --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Odak Anahtar Kelime</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="focus_keyword[{{ $code }}]"
                                                                   class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} Odak Anahtar Kelime"
                                                                   value="{{ old('focus_keyword.'.$code, $page->getTranslation('focus_keyword', $code)) }}">
                                                        @endforeach
                                                        <small class="text-muted">SEO analizinde kullanılacak ana anahtar kelime</small>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="index_status" class="form-label">Arama Motoru Görünürlüğü</label>
                                                        <select name="index_status" id="index_status" class="form-select">
                                                            <option value="index" @selected(old('index_status', $page->index_status) == 'index')>Sayfa indexlensin</option>
                                                            <option value="noindex" @selected(old('index_status', $page->index_status) == 'noindex')>Sayfa indexlenmesin</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="follow_status" class="form-label">Link Takibi</label>
                                                        <select name="follow_status" id="follow_status" class="form-select">
                                                            <option value="follow" @selected(old('follow_status', $page->follow_status) == 'follow')>Sayfadaki linkler takip edilsin</option>
                                                            <option value="nofollow" @selected(old('follow_status', $page->follow_status) == 'nofollow')>Sayfadaki linkler takip edilmesin</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="canonical_url" class="form-label">Canonical URL</label>
                                                        <input type="url" name="canonical_url" id="canonical_url" class="form-control" placeholder="https://..." value="{{ old('canonical_url', $page->canonical_url) }}">
                                                        <small class="text-muted">Bu sayfanın kopya olduğu orijinal sayfanın linki.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Meta Robots --}}
                                            <hr><h6 class="mt-4">Meta Robots Ayarları</h6>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="meta_noindex" id="meta_noindex" value="1" @checked(old('meta_noindex', $page->meta_noindex))>
                                                            <label class="form-check-label" for="meta_noindex">Noindex</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="meta_nofollow" id="meta_nofollow" value="1" @checked(old('meta_nofollow', $page->meta_nofollow))>
                                                            <label class="form-check-label" for="meta_nofollow">Nofollow</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="meta_noarchive" id="meta_noarchive" value="1" @checked(old('meta_noarchive', $page->meta_noarchive))>
                                                            <label class="form-check-label" for="meta_noarchive">Noarchive</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="meta_nosnippet" id="meta_nosnippet" value="1" @checked(old('meta_nosnippet', $page->meta_nosnippet))>
                                                            <label class="form-check-label" for="meta_nosnippet">Nosnippet</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="meta_max_snippet" class="form-label">Max Snippet</label>
                                                        <input type="number" name="meta_max_snippet" id="meta_max_snippet" class="form-control" min="-1" max="320" value="{{ old('meta_max_snippet', $page->meta_max_snippet) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="meta_max_image_preview" class="form-label">Max Image Preview</label>
                                                        <select name="meta_max_image_preview" id="meta_max_image_preview" class="form-select">
                                                            <option value="">Varsayılan</option>
                                                            <option value="none" @selected(old('meta_max_image_preview', $page->meta_max_image_preview) == 'none')>Resim önizleme yok</option>
                                                            <option value="standard" @selected(old('meta_max_image_preview', $page->meta_max_image_preview) == 'standard')>Standart</option>
                                                            <option value="large" @selected(old('meta_max_image_preview', $page->meta_max_image_preview) == 'large')>Büyük</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Open Graph --}}
                                            <hr><h6 class="mt-4">Open Graph Ayarları</h6>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">OG Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="og_title[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="Facebook'ta görünecek {{ $lang['native'] }} başlık"
                                                                   value="{{ old('og_title.'.$code, $page->getTranslation('og_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">OG Açıklama</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="og_description[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}" rows="2"
                                                                      placeholder="{{ $lang['native'] }} OG Açıklaması">{{ old('og_description.'.$code, $page->getTranslation('og_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="og_image" class="form-label">OG Resim</label>
                                                        <input type="file" name="og_image" id="og_image" class="form-control" accept="image/*">
                                                        @if($page->og_image)
                                                            <small class="text-success d-block mt-2">Mevcut: {{ basename($page->og_image) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Twitter Card --}}
                                            <hr><h6 class="mt-4">Twitter Card Ayarları</h6>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="twitter_card_type" class="form-label">Twitter Card Tipi</label>
                                                        <select name="twitter_card_type" id="twitter_card_type" class="form-select">
                                                            <option value="">Varsayılan</option>
                                                            <option value="summary" @selected(old('twitter_card_type', $page->twitter_card_type) == 'summary')>Summary</option>
                                                            <option value="summary_large_image" @selected(old('twitter_card_type', $page->twitter_card_type) == 'summary_large_image')>Summary Large Image</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Twitter Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="twitter_title[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="Twitter'da görünecek {{ $lang['native'] }} başlık"
                                                                   value="{{ old('twitter_title.'.$code, $page->getTranslation('twitter_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Twitter Açıklama</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="twitter_description[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}" rows="2"
                                                                      placeholder="{{ $lang['native'] }} Twitter Açıklaması">{{ old('twitter_description.'.$code, $page->getTranslation('twitter_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="twitter_image" class="form-label">Twitter Resim</label>
                                                        <input type="file" name="twitter_image" id="twitter_image" class="form-control" accept="image/*">
                                                        @if($page->twitter_image)
                                                            <small class="text-success d-block mt-2">Mevcut: {{ basename($page->twitter_image) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Yönlendirme --}}
                                            <hr><h6 class="mt-4">Yönlendirme Ayarları</h6>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="redirect_enabled" id="redirect_enabled" value="1" @checked(old('redirect_enabled', $page->redirect_enabled))>
                                                            <label class="form-check-label" for="redirect_enabled">Yönlendirmeyi Aktif Et</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="redirect_url" class="form-label">Yönlendirme URL'i</label>
                                                        <input type="url" name="redirect_url" id="redirect_url" class="form-control" value="{{ old('redirect_url', $page->redirect_url) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="redirect_type" class="form-label">Yönlendirme Tipi</label>
                                                        <select name="redirect_type" id="redirect_type" class="form-select">
                                                            <option value="301" @selected(old('redirect_type', $page->redirect_type) == 301)>301 (Kalıcı)</option>
                                                            <option value="302" @selected(old('redirect_type', $page->redirect_type) == 302)>302 (Geçici)</option>
                                                            <option value="307" @selected(old('redirect_type', $page->redirect_type) == 307)>307 (Geçici)</option>
                                                            <option value="308" @selected(old('redirect_type', $page->redirect_type) == 308)>308 (Kalıcı)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Slug ve Durum Alanları (Değişiklik Yok) --}}
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">URL Uzantısı (Slug) <span
                                                class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                           value="{{ old('slug', $page->slug) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Durum</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="draft" @selected(old('status', $page->status) == 'draft')>
                                            Taslak
                                        </option>
                                        <option
                                                value="published" @selected(old('status', $page->status) == 'published')>
                                            Yayınlandı
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Sayfa İçeriği Kartı --}}
                    <div class="card">
                        <div class="card-header"><h5 class="mb-0">Sayfa İçeriği (Alanları buraya sürükleyin)</h5>
                            {{-- YENİ YAPIŞTIR BUTONU --}}
                            <button type="button" class="btn btn-sm btn-success" id="paste-section-btn"
                                    title="Kopyalanan bölümü yapıştır">
                                <i class="bi bi-clipboard-plus-fill"></i> Yapıştır
                            </button>
                            {{-- YENİ BUTON BİTİŞİ --}}</div>
                        <div class="card-body">
                            <div class="accordion" id="page-canvas">
                                {{-- Mevcut Section'lar buraya render edilecek --}}
                                {{-- Sayfa İçeriği Kartı içindeki her section için butonları ekleyin --}}
                                @foreach($page->sections as $section)
                                    @php $sectionConfig = $availableSections[$section->section_key] ?? null; @endphp
                                    @if($sectionConfig)
                                        <div class="accordion-item canvas-item" data-id="{{ $section->id }}"
                                             data-section-key="{{ $section->section_key }}">
                                            <h2 class="accordion-header d-flex align-items-center">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $section->id }}">
                                                    <i class="bi bi-arrows-move me-2 sortable-handle"></i>
                                                    {{ $sectionConfig['name'] }}
                                                </button>
                                                <div class="d-flex align-items-center ms-auto pe-3">
                                                    {{-- YENİ BUTONLAR: YUKARI/AŞAĞI --}}
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-secondary me-1 move-section-up"
                                                            title="Yukarı taşı">
                                                        <i class="bi bi-arrow-up"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-secondary me-2 move-section-down"
                                                            title="Aşağı taşı">
                                                        <i class="bi bi-arrow-down"></i>
                                                    </button>
                                                    {{-- MEVCUT BUTONLAR --}}
                                                    <button type="button" class="btn btn-sm btn-outline-primary me-2 copy-section" title="Bu bölümü kopyala">
                                                        <i class="bi bi-clipboard"></i>
                                                    </button>
                                                    <div class="form-check form-switch me-3">
                                                        <input class="form-check-input status-toggle" type="checkbox"
                                                               role="switch" @checked($section->is_active)>
                                                    </div>
                                                    <button type="button" class="btn-close remove-item"></button>
                                                </div>
                                            </h2>
                                            <div id="collapse-{{ $section->id }}" class="accordion-collapse collapse"
                                                 data-bs-parent="#page-canvas">
                                                <div class="accordion-body">
                                                    @include('admin.pages.partials._section_fields', ['fields' => $sectionConfig['fields'], 'section' => $section])
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Repeater Item Template (JS için gizli) --}}
    <template id="repeater-item-template">
        <div class="repeater-item">
            <button type="button" class="btn btn-danger btn-sm remove-repeater-item">&times;</button>
            {{-- Alanlar buraya eklenecek --}}
        </div>
    </template>
@endsection
@push('scripts')
    {{-- Quill Editor JS --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        $(function () {
            const allSectionsConfig = @json($availableSections);
            const activeLanguages = @json($activeLanguages->keys());
            const activeLanguageData = @json($activeLanguages);
            const pageCanvas = $("#page-canvas");
            let quillInstances = new Map();

            function initializeQuill(selectorOrElement) {
                // DÜZELTME BAŞLANGICI: Fonksiyon artık tek bir elementi veya seçiciyi kabul ediyor
                let elements = [];
                if (typeof selectorOrElement === 'string') {
                    elements = document.querySelectorAll(selectorOrElement);
                } else if (selectorOrElement instanceof Element) {
                    elements = [selectorOrElement];
                }
                // DÜZELTME BİTİŞİ

                elements.forEach(el => { // document.querySelectorAll yerine 'elements' kullan
                    if (el && !el.classList.contains('quill-initialized')) {
                        const quill = new Quill(el, {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    [{'header': [1, 2, 3, false]}],
                                    ['bold', 'italic', 'underline'],
                                    [{'list': 'ordered'}, {'list': 'bullet'}],
                                    ['link'],
                                    ['clean']
                                ]
                            }
                        });
                        el.classList.add('quill-initialized');
                        quillInstances.set(el, quill);
                    }
                });
            }

            initializeQuill('#page-canvas .quill-editor');

            $("#available-sections .draggable-item").draggable({
                helper: 'clone',
                connectToSortable: "#page-canvas",
                revert: 'invalid'
            });

            pageCanvas.sortable({
                placeholder: "placeholder",
                handle: ".sortable-handle",
                tolerance: "pointer",
                forcePlaceholderSize: true,
                receive: function (event, ui) {
                    const sectionKey = $(ui.item).data('section-key');
                    const newItemHtml = createSectionHtml(sectionKey, allSectionsConfig[sectionKey]);
                    const newItem = $(newItemHtml);

                    $(this).removeClass('empty-canvas');

                    $(this).find('.draggable-item').replaceWith(newItem);
                    initializeQuill(`#collapse-${newItem.data('unique-id')} .quill-editor`);
                    new bootstrap.Collapse(newItem.find('.accordion-collapse'));
                },
                update: function(event, ui) {
                    // DÜZELTME: Sadece mevcut section'ları sıralarken çalış
                    // Yeni eklenen section'larda çalışmasın (receive eventi zaten var)
                    if (!ui.item.hasClass('draggable-item') && ui.sender === null) {
                        // 500ms gecikme ekle - DOM güncellemesini bekle
                        setTimeout(function() {
                            saveSectionOrder();
                        }, 500);
                    }
                },
                start: function (event, ui) {
                    if ($(this).children().length === 0) {
                        $(this).addClass('ready-for-drop');
                    }
                },
                stop: function (event, ui) {
                    $(this).removeClass('ready-for-drop');
                }
            });

            function checkCanvasEmpty() {
                if (pageCanvas.children().length === 0) {
                    pageCanvas.addClass('empty-canvas');
                } else {
                    pageCanvas.removeClass('empty-canvas');
                }
            }

            checkCanvasEmpty();

            pageCanvas.on('click', '.remove-item', function () {
                $(this).closest('.canvas-item').remove();
                checkCanvasEmpty();
            });

            pageCanvas.on('click', '.remove-repeater-item, .btn-close-repeater', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const repeaterItem = $(this).closest('.repeater-item-accordion');

                if (confirm('Bu öğeyi silmek istediğinizden emin misiniz?')) {
                    repeaterItem.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            });

            function initializeRepeaterSortable() {
                $('.sortable-repeater').each(function () {
                    if (!$(this).hasClass('ui-sortable')) {
                        $(this).sortable({
                            handle: '.repeater-drag-handle',
                            placeholder: 'repeater-placeholder',
                            forcePlaceholderSize: true,
                            tolerance: 'pointer',
                            items: '.repeater-item-accordion',
                            update: function (event, ui) {
                                console.log('Repeater items reordered');
                            }
                        });
                    }
                });
            }

            initializeRepeaterSortable();

            // Add repeater item butonuna event handler
            pageCanvas.on('click', '.add-repeater-item', function () {
                const button = $(this);
                const container = button.prev('.repeater-items-container');
                const repeaterName = container.data('repeater-name');

                const canvasItem = button.closest('.canvas-item');
                const sectionKey = canvasItem.data('section-key');

                const parentRepeaterContainer = button.closest('.repeater-item-body').parent().parent();
                let repeaterField;

                if (parentRepeaterContainer.hasClass('repeater-item-accordion')) {
                    const parentRepeaterName = parentRepeaterContainer.closest('.repeater-items-container').data('repeater-name');
                    const sectionConfig = allSectionsConfig[sectionKey];

                    const findNestedRepeater = (fields, targetName) => {
                        for (let field of fields) {
                            if (field.name === targetName && field.type === 'repeater') {
                                return field;
                            }
                            if (field.type === 'repeater' && field.fields) {
                                const nested = findNestedRepeater(field.fields, targetName);
                                if (nested) return nested;
                            }
                        }
                        return null;
                    };

                    const parentField = findNestedRepeater(sectionConfig.fields, parentRepeaterName);
                    if (parentField) {
                        repeaterField = parentField.fields.find(f => f.name === repeaterName && f.type === 'repeater');
                    }
                } else {
                    repeaterField = allSectionsConfig[sectionKey].fields.find(f => f.name === repeaterName);
                }

                if (repeaterField) {
                    const itemIndex = container.children('.repeater-item-accordion').length;
                    const uniqueId = `${sectionKey}-${repeaterName}-${itemIndex}-${Date.now()}`;
                    const newItemHtml = createRepeaterItemHtml(repeaterField.fields, uniqueId, sectionKey);
                    const newItem = $(newItemHtml);
                    container.append(newItem);
                    initializeQuill(`#${uniqueId}-collapse .quill-editor`);

                    initializeRepeaterSortable();
                }
            });

            $('#page-form').on('submit', function (e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);

                $(form).find('.section-meta-input').remove();

                // Quill editor içeriklerini aktar
                quillInstances.forEach((quill, element) => {
                    const hiddenInput = $(element).next('input[type="hidden"]');
                    if (hiddenInput.length) {
                        hiddenInput.val(quill.root.innerHTML);
                    }
                });

                // Canvas'taki her section'ı işle
                $('#page-canvas .canvas-item').each(function (sectionIndex) {
                    const sectionItem = $(this);
                    const sectionKey = sectionItem.data('section-key');
                    const sectionId = sectionItem.data('id');

                    formData.append(`sections[${sectionIndex}][section_key]`, sectionKey);
                    formData.append(`sections[${sectionIndex}][is_active]`, sectionItem.find('.status-toggle').is(':checked') ? 1 : 0);
                    if (sectionId) {
                        formData.append(`sections[${sectionIndex}][id]`, sectionId);
                    }

                    // Normal input, select, textarea'ları işle
                    sectionItem.find('> .accordion-collapse > .accordion-body > .field-wrapper').each(function() {
                        const fieldWrapper = $(this);

                        // Eğer bu bir repeater container ise, atla (aşağıda işlenecek)
                        if (fieldWrapper.find('.repeater-items-container').length > 0) {
                            return;
                        }

                        // Normal alanları işle
                        fieldWrapper.find('input, select, textarea').each(function () {
                            const input = $(this);
                            const originalName = input.attr('data-name');
                            const lang = input.attr('data-lang');
                            let value = input.val();

                            // Checkbox için özel işlem
                            if (input.attr('type') === 'checkbox') {
                                value = input.is(':checked') ? '1' : '0';
                            }

                            if (!originalName) return;

                            if (input.attr('type') === 'file') {
                                const files = input[0].files;
                                if (files && files.length > 0) {
                                    formData.append(`sections[${sectionIndex}][files][${originalName}]`, files[0]);
                                }
                            } else if (lang) {
                                formData.append(`sections[${sectionIndex}][content][${originalName}][${lang}]`, value || '');
                            } else {
                                formData.append(`sections[${sectionIndex}][content][${originalName}]`, value || '');
                            }
                        });
                    });

                    // Repeater alanlarını işle
                    console.log('Processing repeater items for section:', sectionIndex);
                    console.log('Section DOM:', sectionItem.find('> .accordion-collapse > .accordion-body')[0]);
                    processRepeaterItems(sectionItem.find('> .accordion-collapse > .accordion-body'), sectionIndex, formData, '');
                });

                // Debug - FormData içeriğini göster
                console.log('=== FORM DATA DEBUG ===');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + (pair[1] instanceof File ? pair[1].name : pair[1]));
                }
                console.log('=== END DEBUG ===');

                // AJAX gönder
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        console.error('AJAX Error:', xhr);
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                            Object.values(errors).forEach(error => {
                                errorHtml += `<li>${error[0]}</li>`;
                            });
                            errorHtml += '</ul></div>';

                            $('.container-fluid').prepend(errorHtml);
                            $('html, body').animate({scrollTop: 0}, 'slow');
                        } else {
                            alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                        }
                    }
                });

                return false;
            });

            // RECURSIVE REPEATER PROCESSOR - RADIKAL ÇÖZÜM
            // RECURSIVE REPEATER PROCESSOR - GHOST DATA DÜZELTMESİ
            function processRepeaterItems($container, sectionIndex, formData, parentPath) {
                console.log('processRepeaterItems called with:', {
                    container: $container[0],
                    parentPath: parentPath
                });

                // DÜZELTME:
                // Hangi seçiciyi kullanacağımızı belirle.
                // parentPath boşsa, bu bir L1 çağrısıdır ve $container = .accordion-body
                // .field-wrapper'ların *içindeki* repeater'ları ararız.
                //
                // parentPath doluysa, bu bir L2+ çağrısıdır ve $container = .field-wrapper
                // *Doğrudan* .field-wrapper içindeki repeater'ı ararız.

                let $repeaterContainers;
                if (parentPath === '') {
                    // L1 ARAMA: .accordion-body > .field-wrapper > .repeater-items-container
                    $repeaterContainers = $container.find('> .field-wrapper > .repeater-items-container');
                } else {
                    // L2+ ARAMA: .field-wrapper > .repeater-items-container
                    $repeaterContainers = $container.find('> .repeater-items-container');
                }

                console.log('Found containers:', $repeaterContainers.length);

                $repeaterContainers.each(function () {
                    // BU DÜZELTME SAYESİNDE ARTIK "if" KONTROLÜNE GEREK YOK:
                    // if ($(this).closest('.repeater-item-accordion').length > 0 && parentPath === '') { ... }

                    const repeaterContainer = $(this);
                    const repeaterName = repeaterContainer.data('repeater-name');

                    console.log('Found repeater container:', {
                        repeaterName: repeaterName,
                        items: repeaterContainer.find('> .repeater-item-accordion').length // '>' eklendi
                    });

                    // Yolu PHP array formatında oluştur: [repeaterName]
                    const currentPath = parentPath + `[${repeaterName}]`;

                    repeaterContainer.find('> .repeater-item-accordion').each(function (itemIndex) { // '>' eklendi
                        const repeaterItem = $(this);

                        console.log('Processing repeater item:', {
                            itemIndex: itemIndex,
                            repeaterName: repeaterName
                        });

                        // Yolu PHP array formatında oluştur: [repeaterName][index]
                        const itemPath = `${currentPath}[${itemIndex}]`;

                        // DÜZELTME: Sadece doğrudan alt öğeleri bulmak için '>' seçicilerini ekle
                        repeaterItem.find('> .collapse > .repeater-item-body > .mb-3, > .show > .repeater-item-body > .mb-3').each(function() {
                            const fieldWrapper = $(this);

                            // DÜZELTME: Sadece doğrudan alt öğeleri bulmak için '>' seçicisini ekle
                            if (fieldWrapper.find('> .repeater-items-container').length > 0) {
                                console.log('Found nested repeater, processing recursively with itemPath:', itemPath);
                                processRepeaterItems(fieldWrapper, sectionIndex, formData, itemPath);
                                return;
                            }

                            // Normal inputları işle (direkt child)
                            fieldWrapper.find('> input, > select, > textarea, > .form-check > input[type="checkbox"]').each(function () {
                                processInput($(this), sectionIndex, formData, itemPath);
                            });

                            // Quill editor wrapper içindeki hidden input
                            fieldWrapper.find('> .quill-editor-wrapper > input[type="hidden"]').each(function () {
                                processInput($(this), sectionIndex, formData, itemPath);
                            });

                            // Tab content içindeki inputlar (çok dilli alanlar)
                            fieldWrapper.find('> .tab-content > .tab-pane').each(function() {
                                $(this).find('input, select, textarea').each(function () {
                                    processInput($(this), sectionIndex, formData, itemPath);
                                });
                            });
                        });
                    });
                });
            }

            // Input işleme yardımcı fonksiyonu - DÜZELTİLMİŞ VERSİYON
            function processInput($input, sectionIndex, formData, itemPath) {
                const originalName = $input.attr('data-name');
                const lang = $input.attr('data-lang');
                let value = $input.val();

                // Checkbox için özel işlem
                if ($input.attr('type') === 'checkbox') {
                    value = $input.is(':checked') ? '1' : '0';
                }

                console.log('processInput called:', {
                    originalName: originalName,
                    lang: lang,
                    value: value,
                    itemPath: itemPath,
                    inputType: $input.attr('type'),
                    finalKey: originalName ? `sections[${sectionIndex}][content]${itemPath}[${originalName}]${lang ? `[${lang}]` : ''}` : 'N/A'
                });

                if (!originalName) return;

                // itemPath artık [repeaterName][index][subRepeaterName][subIndex] formatında

                if ($input.attr('type') === 'file') {
                    const files = $input[0].files;
                    if (files && files.length > 0) {
                        // DÜZELTME: sections[index][content][repeater][index]...[files][name]
                        const key = `sections[${sectionIndex}][content]${itemPath}[files][${originalName}]`;
                        formData.append(key, files[0]);
                        console.log('Added file to FormData:', key, files[0].name);
                    }
                } else if (lang) {
                    // DÜZELTME: sections[index][content][repeater][index]...[name][lang]
                    const key = `sections[${sectionIndex}][content]${itemPath}[${originalName}][${lang}]`;
                    formData.append(key, value || '');
                    console.log('Added translatable field to FormData:', key, value);
                } else {
                    // DÜZELTME: sections[index][content][repeater][index]...[name]
                    const key = `sections[${sectionIndex}][content]${itemPath}[${originalName}]`;
                    formData.append(key, value || '');
                    console.log('Added field to FormData:', key, value);
                }
            }

            function createSectionHtml(key, config) {
                const uniqueId = key + '-' + Date.now();
                let fieldsHtml = config.fields && config.fields.length > 0
                    ? config.fields.map(field => createFieldHtml(field, uniqueId)).join('')
                    : '<p class="text-muted">Bu alanın özel bir ayarı yoktur.</p>';

                return `<div class="accordion-item canvas-item" data-unique-id="${uniqueId}" data-section-key="${key}">
        <h2 class="accordion-header d-flex align-items-center">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${uniqueId}">
                <i class="bi bi-arrows-move me-2 sortable-handle"></i> ${config.name}
            </button>
            <div class="d-flex align-items-center ms-auto pe-3">
                {{-- YENİ BUTONLAR --}}
                <button type="button" class="btn btn-sm btn-outline-secondary me-1 move-section-up" title="Yukarı taşı">
                    <i class="bi bi-arrow-up"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary me-2 move-section-down" title="Aşağı taşı">
                    <i class="bi bi-arrow-down"></i>
                </button>
                {{-- MEVCUT BUTONLAR --}}
                <button type="button" class="btn btn-sm btn-outline-primary me-2 copy-section" title="Bu bölümü kopyala">
                    <i class="bi bi-clipboard"></i>
                </button>
                <div class="form-check form-switch me-3">
                    <input class="form-check-input status-toggle" type="checkbox" role="switch" checked>
                </div>
                <button type="button" class="btn-close remove-item"></button>
            </div>
        </h2>
        <div id="collapse-${uniqueId}" class="accordion-collapse collapse" data-bs-parent="#page-canvas">
            <div class="accordion-body">${fieldsHtml}</div>
        </div>
    </div>`;
            }

            function createFieldHtml(field, uniqueId) {
                let fieldHtml = `<div class="mb-3 field-wrapper">`;

                if (field.type === 'repeater') {
                    fieldHtml += `<label class="form-label fw-bold">${field.label}</label>
                                  <div class="repeater-items-container sortable-repeater" data-repeater-name="${field.name}"></div>
                                  <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>`;
                } else if (field.translatable) {
                    const tabId = `${uniqueId}-${field.name}`;
                    fieldHtml += `<label class="form-label">${field.label}</label>
                                  <ul class="nav nav-tabs nav-tabs-sm">`;

                    activeLanguages.forEach((code, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        fieldHtml += `<li class="nav-item"><button class="nav-link ${isActive}" data-bs-toggle="tab" data-bs-target="#${tabId}-${code}" type="button">${code.toUpperCase()}</button></li>`;
                    });

                    fieldHtml += `</ul><div class="tab-content mt-2">`;

                    activeLanguages.forEach((code, index) => {
                        const isActive = index === 0 ? 'show active' : '';
                        fieldHtml += `<div class="tab-pane fade ${isActive}" id="${tabId}-${code}">${createInputElement(field, code)}</div>`;
                    });

                    fieldHtml += `</div>`;
                } else {
                    fieldHtml += `<label class="form-label">${field.label}</label>${createInputElement(field)}`;
                }
                return fieldHtml + `</div>`;
            }

            /**
             * BÖLÜM KOPYALAMA (SERIALIZE) İŞLEMİ
             * BİR ÖNCEKİ SÜRÜMDEN GÜNCELLENDİ - "HAYALET VERİ" SORUNU DÜZELTİLDİ
             */
            function serializeSectionData($container, fieldsConfig) {
                let content = {};

                fieldsConfig.forEach(field => {
                    const fieldName = field.name;

                    if (field.type === 'repeater') {
                        // REPEATER ALANI
                        content[fieldName] = [];
                        // DÜZELTME: Seçiciyi "> .field-wrapper" ile sınırla
                        const $repeaterContainer = $container.find(`> .field-wrapper > .repeater-items-container[data-repeater-name="${fieldName}"]`);

                        $repeaterContainer.find('> .repeater-item-accordion').each(function() {
                            const $repeaterItem = $(this);
                            const $repeaterBody = $repeaterItem.find('> .collapse > .repeater-item-body, > .show > .repeater-item-body');

                            const itemData = serializeSectionData($repeaterBody, field.fields);
                            content[fieldName].push(itemData);
                        });

                    } else if (field.translatable) {
                        // ÇOK DİLLİ ALAN
                        content[fieldName] = {};
                        activeLanguages.forEach(code => {
                            // DÜZELTME: Seçiciyi "> .field-wrapper" ile sınırla
                            const $input = $container.find(`> .field-wrapper [data-name="${fieldName}"][data-lang="${code}"]`);
                            if ($input.length > 0) {
                                if ($input.is('input[type="hidden"]') && $input.prev('.quill-editor').length > 0) {
                                    const quill = quillInstances.get($input.prev('.quill-editor')[0]);
                                    if (quill) {
                                        content[fieldName][code] = quill.root.innerHTML;
                                    }
                                } else {
                                    content[fieldName][code] = $input.val();
                                }
                            }
                        });

                    } else {
                        // TEK DİLLİ ALAN (File hariç)
                        // DÜZELTME: Seçiciyi "> .field-wrapper" ile sınırla
                        const $input = $container.find(`> .field-wrapper [data-name="${fieldName}"]:not([data-lang])`);
                        if ($input.length > 0 && $input.attr('type') !== 'file') {
                            if ($input.is('input[type="hidden"]') && $input.prev('.quill-editor').length > 0) {
                                const quill = quillInstances.get($input.prev('.quill-editor')[0]);
                                if (quill) {
                                    content[fieldName] = quill.root.innerHTML;
                                }
                            } else {
                                content[fieldName] = $input.val();
                            }
                        }
                    }
                });

                return content;
            }

            pageCanvas.on('click', '.copy-section', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $sectionItem = $(this).closest('.canvas-item');
                const sectionKey = $sectionItem.data('section-key');
                const config = allSectionsConfig[sectionKey];

                if (!config) {
                    alert('Bu bölümün yapılandırması bulunamadı.');
                    return;
                }

                console.log('Kopyalanıyor:', sectionKey);

                const $accordionBody = $sectionItem.find('> .accordion-collapse > .accordion-body');
                const sectionContent = serializeSectionData($accordionBody, config.fields);

                const clipboardData = {
                    section_key: sectionKey,
                    content: sectionContent
                };

                // Veriyi localStorage'a JSON string olarak kaydet
                localStorage.setItem('pageBuilderClipboard', JSON.stringify(clipboardData));

                // Basit bir görsel geri bildirim
                const $icon = $(this).find('i');
                $icon.removeClass('bi-clipboard').addClass('bi-check-lg text-success');
                setTimeout(() => {
                    $icon.removeClass('bi-check-lg text-success').addClass('bi-clipboard');
                }, 1500);
            });

            /**
             * BÖLÜM YAPIŞTIRMA (POPULATE) İŞLEMİ
             * GÜNCELLENDİ - Quill editörlerini doldurmadan önce başlatıyor.
             */
            function populateSection($container, content, fieldsConfig) {
                if (!content) return;

                fieldsConfig.forEach(field => {
                    const fieldName = field.name;
                    const value = content[fieldName] || null;

                    if (field.type === 'repeater' && Array.isArray(value)) {
                        // REPEATER ALANI
                        // DÜZELTME: Seçiciyi "> .field-wrapper" ile sınırla
                        const $repeaterContainer = $container.find(`> .field-wrapper > .repeater-items-container[data-repeater-name="${fieldName}"]`);

                        value.forEach((itemData, index) => {
                            const uniqueId = `${$container.closest('.canvas-item').data('unique-id')}-${fieldName}-${index}-${Date.now()}`;
                            const newItemHtml = createRepeaterItemHtml(field.fields, uniqueId);
                            const $newItem = $(newItemHtml);

                            $repeaterContainer.append($newItem);

                            const $repeaterBody = $newItem.find('.repeater-item-body');

                            // Recursive çağrı (Bu çağrı artık Quill'i de başlatacak)
                            populateSection($repeaterBody, itemData, field.fields);
                        });

                    } else if (field.translatable && value) {
                        // ÇOK DİLLİ ALAN
                        activeLanguages.forEach(code => {
                            const langValue = value[code] || '';
                            // DÜZELTME: Seçiciyi "> .field-wrapper" ile sınırla
                            const $input = $container.find(`> .field-wrapper [data-name="${fieldName}"][data-lang="${code}"]`);

                            if ($input.length > 0) {
                                if ($input.is('input[type="hidden"]') && $input.prev('.quill-editor').length > 0) {
                                    // ===== YENİ QUILL LOGIC BAŞLANGIÇ =====
                                    const $quillEditorDiv = $input.prev('.quill-editor');
                                    // 1. Önce Quill'i başlat
                                    initializeQuill($quillEditorDiv[0]);
                                    // 2. Instance'ı al
                                    const quill = quillInstances.get($quillEditorDiv[0]);
                                    if (quill) {
                                        // 3. Sonra içeriği doldur
                                        quill.root.innerHTML = langValue;
                                    }
                                    $input.val(langValue);
                                    // ===== YENİ QUILL LOGIC BİTİŞ =====
                                } else {
                                    $input.val(langValue);
                                }
                            }
                        });

                    } else if (value !== null && field.type !== 'file') {
                        // TEK DİLLİ ALAN (File hariç)
                        // DÜZELTME: Seçiciyi "> .field-wrapper" ile sınırla
                        const $input = $container.find(`> .field-wrapper [data-name="${fieldName}"]:not([data-lang])`);

                        if ($input.length > 0) {
                            if ($input.is('input[type="hidden"]') && $input.prev('.quill-editor').length > 0) {
                                // ===== YENİ QUILL LOGIC BAŞLANGIÇ =====
                                const $quillEditorDiv = $input.prev('.quill-editor');
                                // 1. Önce Quill'i başlat
                                initializeQuill($quillEditorDiv[0]);
                                // 2. Instance'ı al
                                const quill = quillInstances.get($quillEditorDiv[0]);
                                if (quill) {
                                    // 3. Sonra içeriği doldur
                                    quill.root.innerHTML = value;
                                }
                                $input.val(value);
                                // ===== YENİ QUILL LOGIC BİTİŞ =====
                            } else if ($input.is('input[type="checkbox"]')) {
                                // CHECKBOX ALAN
                                $input.prop('checked', value == true || value == 1 || value === 'true' || value === '1');
                            } else {
                                $input.val(value);
                            }
                        }
                    }
                });
            }

            $('#paste-section-btn').on('click', function(e) {
                e.preventDefault();

                const clipboardDataString = localStorage.getItem('pageBuilderClipboard');
                if (!clipboardDataString) {
                    alert('Pano boş. Lütfen önce bir bölümü kopyalayın.');
                    return;
                }

                try {
                    const clipboardData = JSON.parse(clipboardDataString);
                    const sectionKey = clipboardData.section_key;
                    const content = clipboardData.content;
                    const config = allSectionsConfig[sectionKey];

                    if (!config) {
                        alert('Kopyalanan bölümün yapılandırması bu sayfada bulunamadı. (Hata: ' + sectionKey + ')');
                        return;
                    }

                    // 1. Yeni bölüm HTML kabuğunu oluştur
                    const newItemHtml = createSectionHtml(sectionKey, config);
                    const $newItem = $(newItemHtml);

                    // 2. Kabuğu sayfaya ekle
                    pageCanvas.append($newItem);
                    checkCanvasEmpty();

                    // 3. Recursive olarak bölümü doldur (Bu artık Quill'i de BAŞLATIYOR)
                    const $accordionBody = $newItem.find('.accordion-body');
                    populateSection($accordionBody, content, config.fields);

                    // 4. SADECE Sortable'ı yeniden başlat
                    initializeRepeaterSortable();

                    // DÜZELTME: initializeQuill(...) ÇAĞRISI BURADAN KALDIRILDI
                    // ÇÜNKÜ ARTIK populateSection İÇİNDE YAPILIYOR.

                    // 5. Yeni bölümü aç
                    new bootstrap.Collapse($newItem.find('.accordion-collapse'));

                    console.log('Bölüm yapıştırıldı:', sectionKey, content);

                } catch (error) {
                    console.error('Yapıştırma hatası:', error);
                    alert('Panodaki veri bozuk. Yapıştırma işlemi başarısız oldu.');
                }
            });

            function createRepeaterItemHtml(fields, uniqueId, parentSectionKey) {
                let itemFieldsHtml = fields.map(field => {
                    let fieldHtml = `<div class="mb-3 field-wrapper">`;

                    if (field.type === 'repeater') {
                        fieldHtml += `<label class="form-label fw-bold">${field.label}</label>
                                      <div class="repeater-items-container sortable-repeater" data-repeater-name="${field.name}" style="padding-left: 20px; border-left: 3px solid #e0e6ed;"></div>
                                      <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>`;
                    } else if (field.translatable) {
                        const tabId = `${uniqueId}-${field.name}`;
                        fieldHtml += `<label class="form-label">${field.label}</label>
                                      <ul class="nav nav-tabs nav-tabs-sm">`;

                        activeLanguages.forEach((code, index) => {
                            const isActive = index === 0 ? 'active' : '';
                            fieldHtml += `<li class="nav-item"><button class="nav-link ${isActive}" data-bs-toggle="tab" data-bs-target="#${tabId}-${code}" type="button">${code.toUpperCase()}</button></li>`;
                        });

                        fieldHtml += `</ul><div class="tab-content mt-2">`;

                        activeLanguages.forEach((code, index) => {
                            const isActive = index === 0 ? 'show active' : '';
                            fieldHtml += `<div class="tab-pane fade ${isActive}" id="${tabId}-${code}">${createInputElement(field, code)}</div>`;
                        });

                        fieldHtml += `</div>`;
                    } else {
                        fieldHtml += `<label class="form-label">${field.label}</label>${createInputElement(field)}`;
                    }
                    return fieldHtml + `</div>`;
                }).join('');

                return `<div class="repeater-item-accordion mb-2">
                    <div class="repeater-item-header">
                        <i class="bi bi-grip-vertical repeater-drag-handle" style="cursor: move;"></i>
                        <button class="repeater-toggle-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#${uniqueId}-collapse">
                            <i class="bi bi-chevron-down collapse-icon"></i>
                            <span class="repeater-title">Yeni Öğe</span>
                        </button>
                        <button type="button" class="btn-close-repeater remove-repeater-item"></button>
                    </div>

                    <div class="collapse show" id="${uniqueId}-collapse">
                        <div class="repeater-item-body">
                            ${itemFieldsHtml}
                        </div>
                    </div>
                </div>`;
            }

            function createInputElement(field, lang = null) {
                const dataAttrs = `data-name="${field.name}" ${lang ? `data-lang="${lang}"` : ''}`;

                if (field.type === 'textarea') {
                    return `<div class="quill-editor-wrapper"><div class="quill-editor"></div><input type="hidden" ${dataAttrs}></div>`;
                } else if (field.type === 'checkbox') {
                    const checked = field.default ? 'checked' : '';
                    return `<div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" ${dataAttrs} value="1" ${checked}>
                                <label class="form-check-label">${field.label || 'Aktif'}</label>
                            </div>`;
                } else if (field.type === 'file') {
                    return `<input type="file" class="form-control" ${dataAttrs}>`;
                } else if (field.type === 'select' && field.options) {
                    const options = Object.entries(field.options).map(([val, label]) => `<option value="${val}">${label}</option>`).join('');
                    return `<select class="form-select" ${dataAttrs}>${options}</select>`;
                } else {
                    return `<input type="${field.type}" class="form-control" ${dataAttrs} value="">`;
                }
            }

            // Section sıralamasını kaydet
            function saveSectionOrder() {
                const orders = {};

                console.log('saveSectionOrder çağrıldı');

                $('#page-canvas .canvas-item').each(function(index) {
                    const sectionId = $(this).data('id');
                    console.log(`Section ${index}: ID = ${sectionId}`);

                    if (sectionId) {
                        orders[sectionId] = index + 1; // 1'den başlayan order
                    }
                });

                console.log('Kaydedilecek sıralama:', orders);

                // Eğer kaydedilecek section yoksa işlemi durdur
                if (Object.keys(orders).length === 0) {
                    console.warn('Kaydedilecek section ID\'si bulunamadı. Önce sayfayı kaydedin.');
                    return;
                }

                // AJAX ile sıralamayı kaydet
                $.ajax({
                    url: '{{ route("admin.pages.reorder-sections") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        orders: orders
                    },
                    success: function(response) {
                        console.log('✓ Section sıralaması başarıyla kaydedildi:', response);

                        // İsteğe bağlı toast bildirimi
                        if (typeof toastr !== 'undefined') {
                            toastr.success('Sıralama kaydedildi');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('✗ Sıralama kaydedilemedi!');
                        console.error('Status:', status);
                        console.error('Error:', error);
                        console.error('Response:', xhr.responseText);

                        // Hata bildirimi
                        if (typeof toastr !== 'undefined') {
                            toastr.error('Sıralama kaydedilemedi: ' + error);
                        } else {
                            alert('Sıralama kaydedilemedi: ' + error + '\n\nLütfen sayfayı kaydedin.');
                        }
                    }
                });
            }

            // Yukarı taşı butonu
            pageCanvas.on('click', '.move-section-up', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const $currentItem = $(this).closest('.canvas-item');
                const $prevItem = $currentItem.prev('.canvas-item');

                if ($prevItem.length > 0) {
                    $currentItem.insertBefore($prevItem);

                    // Animasyon efekti
                    $currentItem.addClass('bg-light');
                    setTimeout(() => {
                        $currentItem.removeClass('bg-light');
                    }, 300);

                    // Sıralamayı kaydet
                    setTimeout(() => {
                        saveSectionOrder();
                    }, 500);
                } else {
                    // Zaten en üstte
                    showToast('Bu bölüm zaten en üstte', 'info');
                }
            });

// Aşağı taşı butonu
            pageCanvas.on('click', '.move-section-down', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const $currentItem = $(this).closest('.canvas-item');
                const $nextItem = $currentItem.next('.canvas-item');

                if ($nextItem.length > 0) {
                    $currentItem.insertAfter($nextItem);

                    // Animasyon efekti
                    $currentItem.addClass('bg-light');
                    setTimeout(() => {
                        $currentItem.removeClass('bg-light');
                    }, 300);

                    // Sıralamayı kaydet
                    setTimeout(() => {
                        saveSectionOrder();
                    }, 500);
                } else {
                    // Zaten en altta
                    showToast('Bu bölüm zaten en altta', 'info');
                }
            });

// Toast bildirimi gösterme fonksiyonu
            function showToast(message, type = 'success') {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: type,
                        title: message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                } else {
                    alert(message);
                }
            }
        });
    </script>
@endpush