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
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#edit-title-{{ $code }}" type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="edit-title-{{ $code }}" role="tabpanel">
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
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#edit-banner-title-{{ $code }}" type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="edit-banner-title-{{ $code }}" role="tabpanel">
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
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#edit-banner-subtitle-{{ $code }}" type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="edit-banner-subtitle-{{ $code }}" role="tabpanel">
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeo">
                                            Gelişmiş SEO Ayarları
                                        </button>
                                    </h2>
                                    <div id="collapseSeo" class="accordion-collapse collapse" data-bs-parent="#seoAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                {{-- Temel SEO Alanları (Dinamik) --}}
                                                <div class="col-12 col-md-6">
                                                    {{-- SEO Başlık --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">SEO Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="seo_title[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} SEO Başlık"
                                                                   value="{{ old('seo_title.'.$code, $page->getTranslation('seo_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    {{-- Meta Açıklaması --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Meta Açıklaması</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="meta_description[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}" rows="3"
                                                                      placeholder="{{ $lang['native'] }} Meta Açıklaması">{{ old('meta_description.'.$code, $page->getTranslation('meta_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    {{-- Anahtar Kelimeler --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Anahtar Kelimeler (Virgülle ayırın)</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="keywords[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} Anahtar Kelimeler"
                                                                   value="{{ old('keywords.'.$code, $page->getTranslation('keywords', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                </div>

                                                {{-- Gelişmiş SEO Alanları (Tek Dilli - Değişiklik Yok) --}}
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
                                                        <small class="text-muted">Bu sayfanın kopya olduğu orijinal sayfanın linki. Genellikle boş bırakılır.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <h6 class="mt-4 px-3">Sosyal Medya Paylaşım (Open Graph) Ayarları</h6>
                                            <div class="row p-3">
                                                <div class="col-12">
                                                    {{-- OG Başlık (Dinamik) --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">OG Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="og_title[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="Facebook, LinkedIn'de görünecek {{ $lang['native'] }} başlık"
                                                                   value="{{ old('og_title.'.$code, $page->getTranslation('og_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    {{-- OG Açıklama (Dinamik) --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">OG Açıklama</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="og_description[{{ $code }}]" class="form-control {{ !$loop->first ? 'mt-2' : '' }}" rows="2"
                                                                      placeholder="{{ $lang['native'] }} OG Açıklaması">{{ old('og_description.'.$code, $page->getTranslation('og_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    {{-- OG Resim (Tek Dilli - Değişiklik Yok) --}}
                                                    <div class="mb-3">
                                                        <label for="og_image" class="form-label">OG Resim</label>
                                                        <input type="text" name="og_image" id="og_image" class="form-control"
                                                               placeholder="Paylaşımda görünecek resmin tam URL'si"
                                                               value="{{ old('og_image', $page->og_image) }}">
                                                        <small class="text-muted">Bu alanı boş bırakırsanız, sayfanın öne çıkan görseli kullanılır.</small>
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
                                    <label for="slug" class="form-label">URL Uzantısı (Slug) <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Durum</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="draft" @selected(old('status', $page->status) == 'draft')>Taslak</option>
                                        <option value="published" @selected(old('status', $page->status) == 'published')>Yayınlandı</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Sayfa İçeriği Kartı --}}
                    <div class="card">
                        <div class="card-header"><h5 class="mb-0">Sayfa İçeriği (Alanları buraya sürükleyin)</h5></div>
                        <div class="card-body">
                            <div class="accordion" id="page-canvas">
                                {{-- Mevcut Section'lar buraya render edilecek --}}
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
            const activeLanguages = @json($activeLanguages->keys()); // Sadece dil kodları
            const activeLanguageData = @json($activeLanguages); // Tam dil verisi
            const pageCanvas = $("#page-canvas");
            let quillInstances = new Map();

            function initializeQuill(selector) {
                document.querySelectorAll(selector).forEach(el => {
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
                tolerance: "pointer", // Bu satırı ekleyin
                forcePlaceholderSize: true, // Bu satırı ekleyin
                receive: function (event, ui) {
                    const sectionKey = $(ui.item).data('section-key');
                    const newItemHtml = createSectionHtml(sectionKey, allSectionsConfig[sectionKey]);
                    const newItem = $(newItemHtml);

                    // Canvas'ın boş olmadığını belirtmek için class ekle
                    $(this).removeClass('empty-canvas');

                    $(this).find('.draggable-item').replaceWith(newItem);
                    initializeQuill(`#collapse-${newItem.data('unique-id')} .quill-editor`);
                    new bootstrap.Collapse(newItem.find('.accordion-collapse'));
                },
                start: function (event, ui) {
                    // Sürükleme başladığında canvas'ı hazırla
                    if ($(this).children().length === 0) {
                        $(this).addClass('ready-for-drop');
                    }
                },
                stop: function (event, ui) {
                    $(this).removeClass('ready-for-drop');
                }
            });

            // Canvas boş mu kontrolü
            function checkCanvasEmpty() {
                if (pageCanvas.children().length === 0) {
                    pageCanvas.addClass('empty-canvas');
                } else {
                    pageCanvas.removeClass('empty-canvas');
                }
            }

            // Sayfa yüklendiğinde kontrol et
            checkCanvasEmpty();

            // Remove item event handler'ı güncelle
            pageCanvas.on('click', '.remove-item', function () {
                $(this).closest('.canvas-item').remove();
                checkCanvasEmpty(); // Canvas boş kaldı mı kontrol et
            });


            pageCanvas.on('click', '.remove-repeater-item', function () {
                $(this).closest('.repeater-item').remove();
            });

            pageCanvas.on('click', '.add-repeater-item', function () {
                const container = $(this).prev('.repeater-items-container');
                const repeaterName = container.data('repeater-name');
                const sectionKey = $(this).closest('.canvas-item').data('section-key');
                const repeaterField = allSectionsConfig[sectionKey].fields.find(f => f.name === repeaterName);
                if (repeaterField) {
                    const itemIndex = container.children('.repeater-item').length;
                    const uniqueId = `${sectionKey}-${repeaterName}-${itemIndex}-${Date.now()}`;
                    const newItemHtml = createRepeaterItemHtml(repeaterField.fields, uniqueId);
                    const newItem = $(newItemHtml);
                    container.append(newItem);
                    initializeQuill(`#${uniqueId} .quill-editor`);
                }
            });

            $('#page-form').on('submit', function (e) {
                e.preventDefault(); // Önce formu durdur

                const form = this;
                const formData = new FormData(form);

                // Önce mevcut section-meta-input'ları temizle
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

                    // Section meta bilgilerini FormData'ya ekle
                    formData.append(`sections[${sectionIndex}][section_key]`, sectionKey);
                    formData.append(`sections[${sectionIndex}][is_active]`, sectionItem.find('.status-toggle').is(':checked') ? 1 : 0);
                    if (sectionId) {
                        formData.append(`sections[${sectionIndex}][id]`, sectionId);
                    }

                    // Multi-image alanlarını işle
                    sectionItem.find('.multi-image-field').each(function () {
                        const fieldName = $(this).data('field-name');
                        const sortableContainer = $(this).find('.sortable-images-container');

                        let imageIndex = 0;

                        // Mevcut resimleri işle (hidden input'lar)
                        sortableContainer.find('input[type="hidden"]').each(function () {
                            const imagePath = $(this).val();
                            formData.append(`sections[${sectionIndex}][content][${fieldName}][${imageIndex}]`, imagePath);
                            imageIndex++;
                        });

                        // Yeni yüklenen resimleri işle
                        sortableContainer.find('.sortable-image-item').each(function () {
                            const file = $(this).data('file');
                            if (file) {
                                formData.append(`sections[${sectionIndex}][files][${fieldName}][${imageIndex}]`, file);
                                imageIndex++;
                            }
                        });
                    });

                    // Normal input, select, textarea'ları işle (repeater dışında)
                    sectionItem.find('> .accordion-collapse > .accordion-body > .field-wrapper').not('.multi-image-field').find('input, select, textarea').each(function () {
                        const input = $(this);
                        const originalName = input.attr('data-name');
                        const lang = input.attr('data-lang');
                        const value = input.val();

                        if (input.attr('type') === 'file') {
                            const files = input[0].files;
                            if (files && files.length > 0) {
                                formData.append(`sections[${sectionIndex}][files][${originalName}]`, files[0]);
                            }
                        } else if (lang) {
                            formData.append(`sections[${sectionIndex}][content][${originalName}][${lang}]`, value || '');
                        } else if (originalName) {
                            formData.append(`sections[${sectionIndex}][content][${originalName}]`, value || '');
                        }
                    });

                    // Repeater alanlarını işle
                    sectionItem.find('.repeater-items-container').each(function () {
                        const repeaterContainer = $(this);
                        const repeaterName = repeaterContainer.data('repeater-name');

                        repeaterContainer.find('.repeater-item').each(function (itemIndex) {
                            $(this).find('input, select, textarea').each(function () {
                                const input = $(this);
                                const originalName = input.attr('data-name');
                                const lang = input.attr('data-lang');
                                const value = input.val();

                                if (input.attr('type') === 'file') {
                                    const files = input[0].files;
                                    if (files && files.length > 0) {
                                        formData.append(`sections[${sectionIndex}][content][${repeaterName}][${itemIndex}][files][${originalName}]`, files[0]);
                                    }
                                } else if (lang) {
                                    formData.append(`sections[${sectionIndex}][content][${repeaterName}][${itemIndex}][${originalName}][${lang}]`, value || '');
                                } else if (originalName) {
                                    formData.append(`sections[${sectionIndex}][content][${repeaterName}][${itemIndex}][${originalName}]`, value || '');
                                }
                            });
                        });
                    });
                });

                // FormData ile AJAX gönder
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Başarılı olursa sayfayı yenile
                        location.reload();
                    },
                    error: function (xhr) {
                        // Hata mesajlarını göster
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

                if (field.type === 'multi_image') {
                    // Multi-image alanı için özel HTML
                    fieldHtml += `
            <div class="multi-image-field" data-field-name="${field.name}">
                <label class="form-label fw-bold">${field.label}</label>

                <div class="sortable-images-container row g-2 mb-3" id="sortable-${field.name}">
                    <!-- Mevcut resimler buraya eklenecek -->
                </div>

                <div class="upload-area">
                    <input type="file"
                           class="form-control multi-image-input"
                           data-field-name="${field.name}"
                           multiple
                           accept="image/*">
                    <small class="text-muted">Birden fazla resim seçebilirsiniz. Sürükle-bırak ile sıralayabilirsiniz.</small>
                </div>
            </div>
        `;
                } else if (field.type === 'repeater') {
                    fieldHtml += `<label class="form-label fw-bold">${field.label}</label>
                      <div class="repeater-items-container" data-repeater-name="${field.name}"></div>
                      <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>`;
                } else if (field.translatable) {
                    const tabId = `${uniqueId}-${field.name}`;
                    fieldHtml += `<label class="form-label">${field.label}</label>
                      <ul class="nav nav-tabs nav-tabs-sm">`;

                    // Tüm aktif diller için sekme oluştur
                    activeLanguages.forEach((code, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        fieldHtml += `<li class="nav-item"><button class="nav-link ${isActive}" data-bs-toggle="tab" data-bs-target="#${tabId}-${code}" type="button">${code.toUpperCase()}</button></li>`;
                    });

                    fieldHtml += `</ul><div class="tab-content mt-2">`;

                    // Tüm aktif diller için içerik alanları oluştur
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

            function createRepeaterItemHtml(fields, uniqueId) {
                let itemFieldsHtml = `<div id="${uniqueId}">` + fields.map(field => {
                    let fieldHtml = `<div class="mb-3 field-wrapper">`;
                    if (field.translatable) {
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
                }).join('') + `</div>`;

                return `<div class="repeater-item border p-3 mb-3 rounded bg-light position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 p-2 remove-repeater-item"></button>
                            ${itemFieldsHtml}
                        </div>`;
            }

            function createInputElement(field, lang = null) {
                const dataAttrs = `data-name="${field.name}" ${lang ? `data-lang="${lang}"` : ''}`;

                if (field.type === 'textarea') {
                    return `<div class="quill-editor-wrapper"><div class="quill-editor"></div><input type="hidden" ${dataAttrs}></div>`;
                } else if (field.type === 'file') {
                    return `<input type="file" class="form-control" ${dataAttrs}>`;
                } else if (field.type === 'multi_image') {
                    // Multi-image için özel işlem yapma, sadece boş döndür
                    return '';
                } else if (field.type === 'select' && field.options) {
                    const options = Object.entries(field.options).map(([val, label]) => `<option value="${val}">${label}</option>`).join('');
                    return `<select class="form-select" ${dataAttrs}>${options}</select>`;
                } else {
                    return `<input type="${field.type}" class="form-control" ${dataAttrs} value="">`;
                }
            }
        });


    </script>
    <script>
        // Multi-image field için fonksiyonlar
        // Multi-image field için fonksiyonlar
        function initializeMultiImageFields() {
            // Her multi-image field için sortable yap
            $('.sortable-images-container').each(function () {
                if (!$(this).hasClass('ui-sortable')) {
                    $(this).sortable({
                        handle: '.drag-handle',
                        placeholder: 'sortable-placeholder col-md-3',
                        forcePlaceholderSize: true,
                        update: function (event, ui) {
                            updateImageIndexes($(this));
                        }
                    });
                }
            });

            // Resim kaldırma
            $(document).off('click', '.remove-image').on('click', '.remove-image', function () {
                const container = $(this).closest('.sortable-images-container');
                $(this).closest('.sortable-image-item').fadeOut(300, function () {
                    $(this).remove();
                    updateImageIndexes(container);
                });
            });

            // Yeni resim seçildiğinde
            $(document).off('change', '.multi-image-input').on('change', '.multi-image-input', function (e) {
                const files = Array.from(e.target.files);
                const fieldName = $(this).data('field-name');
                const container = $(this).closest('.multi-image-field');
                const sortableContainer = container.find('.sortable-images-container');

                files.forEach((file) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        const currentIndex = sortableContainer.find('.sortable-image-item').length;
                        const uniqueId = `img-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;

                        reader.onload = function (e) {
                            const imageHtml = `
                        <div class="col-md-3 sortable-image-item" data-index="${currentIndex}" data-unique-id="${uniqueId}">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <i class="bi bi-grip-vertical drag-handle mb-2" style="cursor: move;"></i>
                                    <img src="${e.target.result}" class="img-fluid rounded mb-2" style="max-height: 100px; object-fit: cover;">
                                    <span class="badge bg-info mb-2">Yeni</span>
                                    <button type="button" class="btn btn-sm btn-danger w-100 remove-image">
                                        <i class="bi bi-trash"></i> Kaldır
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

                            const newElement = $(imageHtml);
                            sortableContainer.append(newElement);

                            // File objesini data olarak sakla
                            newElement.data('file', file);
                            newElement.data('field-name', fieldName);

                            // Sortable'ı yenile
                            if (sortableContainer.hasClass('ui-sortable')) {
                                sortableContainer.sortable('refresh');
                            }
                        };

                        reader.readAsDataURL(file);
                    }
                });

                // Input'u temizle
                $(this).val('');
            });
        }

        // Index'leri güncelle
        function updateImageIndexes(container) {
            container.find('.sortable-image-item').each(function (index) {
                $(this).attr('data-index', index);
            });
        }

        // Sayfa yüklendiğinde ve yeni section eklendiğinde çalıştır
        $(document).ready(function () {
            initializeMultiImageFields();

            // Observer ile yeni eklenen elementleri izle
            const observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.addedNodes.length) {
                        mutation.addedNodes.forEach(function (node) {
                            if (node.nodeType === 1 && ($(node).hasClass('multi-image-field') || $(node).find('.multi-image-field').length)) {
                                initializeMultiImageFields();
                            }
                        });
                    }
                });
            });

            observer.observe(document.getElementById('page-canvas'), {
                childList: true,
                subtree: true
            });
        });
    </script>
@endpush
