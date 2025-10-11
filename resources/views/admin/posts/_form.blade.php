@if ($errors->any())
    <div class="alert alert-danger">
        <h5 class="alert-heading">Formda Hatalar Bulundu!</h5>
        <ul class="mb-0">
            @foreach ($errors->getMessages() as $field => $messages)
                <li>
                    <strong>{{ $field }}:</strong> {{ implode(', ', $messages) }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    {{-- Sol Taraf: İçerik ve SEO Alanları --}}
    <div class="col-lg-8">
        {{-- İçerik Kartı --}}
        <div class="card">
            <div class="card-body">
                {{-- DİL SEKMELERİ (DİNAMİK) --}}
                <ul class="nav nav-tabs nav-tabs-sm" id="langTab" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#{{ $langCode }}-tab-pane" type="button">{{ $lang['name'] }}
                                ({{ strtoupper($langCode) }})
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-3" id="langTabContent">
                    {{-- DİNAMİK İÇERİK SEKMELERİ --}}
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $langCode }}-tab-pane"
                             role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Yazı Başlığı ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" name="title[{{ $langCode }}]"
                                       value="{{ old('title.' . $langCode, $post->getTranslation('title', $langCode)) }}" {{ $loop->first ? 'required' : '' }}>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">İçerik ({{ strtoupper($langCode) }})</label>
                                <div class="editor-container"
                                     style="min-height: 400px;">{!! old('content.' . $langCode, $post->getTranslation('content', $langCode)) !!}</div>
                                <input type="hidden" name="content[{{ $langCode }}]" class="editor-input">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kısa Özet ({{ strtoupper($langCode) }})</label>
                                <textarea class="form-control" name="excerpt[{{ $langCode }}]"
                                          rows="3">{{ old('excerpt.' . $langCode, $post->getTranslation('excerpt', $langCode)) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- SEO Kartı --}}
        <div class="card mt-3">
            <div class="card-body">
                <h5>Gelişmiş SEO Alanları</h5>
                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#seo-{{ $langCode }}"
                                    type="button">{{ strtoupper($langCode) }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-3">
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="seo-{{ $langCode }}"
                             role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">SEO Başlığı ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" name="seo_title[{{ $langCode }}]"
                                       value="{{ old('seo_title.' . $langCode, $post->getTranslation('seo_title', $langCode)) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Açıklaması ({{ strtoupper($langCode) }})</label>
                                <textarea class="form-control" name="meta_description[{{ $langCode }}]"
                                          rows="2">{{ old('meta_description.' . $langCode, $post->getTranslation('meta_description', $langCode)) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anahtar Kelimeler ({{ strtoupper($langCode) }})</label>
                                <input name="keywords[{{ $langCode }}]" class="form-control tagify-input"
                                       value="{{ old('keywords.' . $langCode, $post->getTranslation('keywords', $langCode)) }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label for="canonical_url" class="form-label">Canonical URL</label>
                    <input type="url" class="form-control" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $post->canonical_url ?? '') }}" placeholder="https://ornek.com/orijinal-yazi">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="index_status" class="form-label">Arama Motoru Index</label>
                        <select name="index_status" id="index_status" class="form-select">
                            <option
                                value="index" @selected(old('index_status', $post->index_status ?? 'index') == 'index')>
                                Index (Önerilen)
                            </option>
                            <option
                                value="noindex" @selected(old('index_status', $post->index_status ?? '') == 'noindex')>
                                No Index
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="follow_status" class="form-label">Link Takibi</label>
                        <select name="follow_status" id="follow_status" class="form-select">
                            <option
                                value="follow" @selected(old('follow_status', $post->follow_status ?? 'follow') == 'follow')>
                                Follow (Önerilen)
                            </option>
                            <option
                                value="nofollow" @selected(old('follow_status', $post->follow_status ?? '') == 'nofollow')>
                                No Follow
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sağ Taraf: Yayınlama, Kategori, Görsel vb. --}}
    <div class="col-lg-4">
        {{-- Yayınlama Kartı --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Yayınlama</h5>
                <div class="mb-3">
                    <label for="status" class="form-label">Durum</label>
                    <select name="status" id="status" class="form-select">
                        <option value="published" @selected(old('status', $post->status ?? '') == 'published')>
                            Yayınlandı
                        </option>
                        <option value="draft" @selected(old('status', $post->status ?? 'draft') == 'draft')>Taslak
                        </option>
                        <option value="scheduled" @selected(old('status', $post->status ?? '') == 'scheduled')>
                            Zamanlanmış
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="published_at" class="form-label">Yayın Tarihi</label>
                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                </div>
            </div>
        </div>

        {{-- Kategori ve Etiketler Kartı --}}
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Kategori ve Etiketler</h5>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Kategori Seçin</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>
                                {{ $category->getTranslation('name', config('app.locale')) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Etiketler (Sadece Türkçe)</label>
                    <input name="tags" class="form-control tagify-input" value="{{ old('tags', $post->tags->pluck('name')->implode(',')) }}">
                    <small>Etiketler ana dil (Türkçe) üzerinden yönetilir.</small>
                </div>
            </div>
        </div>

        {{-- Öne Çıkan Görsel Kartı --}}
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Öne Çıkan Görsel</h5>
                <input type="file" name="featured_image" id="featured_image_input" class="form-control mb-2" accept="image/*">

                <label class="form-label">Görsel Alt Metni (Alt Text)</label>
                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#alt-{{$langCode}}"
                                    type="button">{{ strtoupper($langCode) }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-2">
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="alt-{{$langCode}}"
                             role="tabpanel">
                            <input type="text" class="form-control" name="featured_image_alt_text[{{$langCode}}]"
                                   value="{{ old('featured_image_alt_text.' . $langCode, $post->getTranslation('featured_image_alt_text', $langCode)) }}">
                        </div>
                    @endforeach
                </div>

                <div id="image-preview" class="mt-2">
                    @if($post->featured_image)<img src="{{ asset($post->featured_image) }}" alt="Önizleme" class="img-thumbnail" width="200">@endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">İptal</a>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==========================================================
            // DEĞİŞKENLER VE BAŞLANGIÇ AYARLARI
            // ==========================================================
            const UPLOAD_URL = "{{ route('admin.editor.uploadImage') }}";
            const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const defaultSchemaObject = @json($defaultSchema ?? []);

            // ==========================================================
            // QUILL EDITOR KURULUMU (ÇOKLU DİL DESTEKLİ)
            // ==========================================================
            const quillToolbarOptions = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image', 'video'], ['blockquote', 'code-block'], [{ 'align': [] }], ['clean']
            ];

            function imageHandler() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = async () => {
                    const file = input.files[0];
                    if (!file || !file.type.startsWith('image/')) return;

                    const formData = new FormData();
                    formData.append('image', file); // PostController'daki 'image' beklentisine göre güncellendi

                    try {
                        const response = await fetch(UPLOAD_URL, {
                            method: 'POST',
                            body: formData,
                            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
                        });
                        const result = await response.json();
                        if (result.location) {
                            const range = this.quill.getSelection(true);
                            this.quill.insertEmbed(range.index, 'image', result.location);
                            this.quill.setSelection(range.index + 1);
                        } else { throw new Error('Sunucudan URL alınamadı.'); }
                    } catch (error) {
                        console.error('Quill resim yükleme hatası:', error);
                        Swal.fire({ icon: 'error', title: 'Hata!', text: 'Resim yüklenirken bir sorun oluştu.' });
                    }
                };
            }

            document.querySelectorAll('.editor-container').forEach(container => {
                const quill = new Quill(container, {
                    theme: 'snow',
                    modules: {
                        toolbar: {
                            container: quillToolbarOptions,
                            handlers: { 'image': imageHandler }
                        }
                    }
                });
                const input = container.nextElementSibling;
                quill.on('text-change', () => input.value = quill.root.innerHTML);
                container.closest('form').addEventListener('submit', () => input.value = quill.root.innerHTML);
            });

            // ==========================================================
            // TAGIFY KURULUMU (ETİKETLER VE ANAHTAR KELİMELER)
            // ==========================================================
            document.querySelectorAll('.tagify-input').forEach(input => new Tagify(input));

            // SEO analizi için anahtar kelime Tagify nesnesini değişkene ata
            const keywordsTrInput = document.querySelector('input[name="keywords[tr]"]');
            const tagifyKeywords = keywordsTrInput ? new Tagify(keywordsTrInput) : null;


            // ==========================================================
            // ÖNE ÇIKAN GÖRSEL İÇİN ANLIK ÖNİZLEME
            // ==========================================================
            const imageInput = document.getElementById('featured_image_input');
            const imagePreview = document.getElementById('image-preview');
            if (imageInput) {
                imageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" width="200">`;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // ==========================================================
            // SCHEMA TİPİ İÇİN DİNAMİK ALAN MANTIĞI
            // ==========================================================
            const schemaTypeSelect = document.getElementById('schema_type');
            const manualSchemaContainer = document.getElementById('manual_schema_container');
            const manualSchemaTextarea = document.getElementById('manual_schema_json');

            function toggleManualSchema() {
                if (schemaTypeSelect.value === 'manual') {
                    manualSchemaContainer.style.display = 'block';
                    if (manualSchemaTextarea.value.trim() === '') {
                        // Varsayılan Schema'yı doldururken Türkçe başlığı al
                        const titleTr = document.querySelector('input[name="title[tr]"]').value;
                        defaultSchemaObject.headline = titleTr || 'YAZI BAŞLIĞI BURAYA GELECEK';
                        manualSchemaTextarea.value = JSON.stringify(defaultSchemaObject, null, 4);
                    }
                } else {
                    manualSchemaContainer.style.display = 'none';
                }
            }
            if(schemaTypeSelect){
                toggleManualSchema();
                schemaTypeSelect.addEventListener('change', toggleManualSchema);
            }

            // ==========================================================
            // ANLIK SEO ANALİZİ MANTIĞI (ÇOK DİLLİ)
            // ==========================================================
            const mainTitleTr = document.querySelector('input[name="title[tr]"]');
            const seoTitleTr = document.querySelector('input[name="seo_title[tr]"]');
            const metaDescriptionTr = document.querySelector('textarea[name="meta_description[tr]"]');

            const titleFeedback = document.getElementById('seo-title-feedback');
            const titleCounter = document.getElementById('seo-title-counter');
            const descriptionFeedback = document.getElementById('meta-description-feedback');
            const descriptionCounter = document.getElementById('meta-description-counter');
            const analysisResults = document.getElementById('seo-analysis-results');

            function runSeoChecks() {
                // Analiz sadece TR sekmesindeki verilere göre yapılır
                if (!mainTitleTr || !seoTitleTr || !metaDescriptionTr || !tagifyKeywords) return;

                let titleToAnalyze = seoTitleTr.value.trim() !== '' ? seoTitleTr.value : mainTitleTr.value;
                const description = metaDescriptionTr.value;
                const keyword = tagifyKeywords.value.length > 0 ? tagifyKeywords.value[0].value.trim().toLowerCase() : '';
                const titleLength = titleToAnalyze.length;
                const descriptionLength = description.length;
                let resultsHtml = '';

                // SEO Başlığı Uzunluk Kontrolü
                if(titleCounter) titleCounter.textContent = titleLength;
                if(titleFeedback) {
                    titleFeedback.className = 'form-text text-muted'; // Reset
                    if (titleLength > 0 && titleLength < 40) titleFeedback.textContent = 'Çok kısa';
                    else if (titleLength >= 40 && titleLength <= 60) {
                        titleFeedback.textContent = 'İdeal';
                        titleFeedback.classList.add('text-success');
                    }
                    else if (titleLength > 60) {
                        titleFeedback.textContent = 'Çok uzun';
                        titleFeedback.classList.add('text-danger');
                    }
                }

                // Meta Açıklaması Uzunluk Kontrolü
                if(descriptionCounter) descriptionCounter.textContent = descriptionLength;
                if(descriptionFeedback) {
                    descriptionFeedback.className = 'form-text text-muted'; // Reset
                    if (descriptionLength > 0 && descriptionLength < 100) descriptionFeedback.textContent = 'Çok kısa';
                    else if (descriptionLength >= 100 && descriptionLength <= 160) {
                        descriptionFeedback.textContent = 'İdeal';
                        descriptionFeedback.classList.add('text-success');
                    }
                    else if (descriptionLength > 160) {
                        descriptionFeedback.textContent = 'Çok uzun';
                        descriptionFeedback.classList.add('text-danger');
                    }
                }

                // Odak Anahtar Kelime Kontrolü
                if (analysisResults) {
                    if (keyword.length > 0) {
                        resultsHtml += (titleToAnalyze.toLowerCase().includes(keyword))
                            ? '<li class="text-success">✅ Odak anahtar kelime başlıkta bulunuyor.</li>'
                            : '<li class="text-danger">❌ Odak anahtar kelime başlıkta bulunmuyor.</li>';
                        resultsHtml += (description.toLowerCase().includes(keyword))
                            ? '<li class="text-success">✅ Odak anahtar kelime açıklamada bulunuyor.</li>'
                            : '<li class="text-danger">❌ Odak anahtar kelime açıklamada bulunmuyor.</li>';
                    } else {
                        resultsHtml = '<li><small class="text-muted">Analiz için bir anahtar kelime girin.</small></li>';
                    }
                    analysisResults.innerHTML = resultsHtml;
                }
            }

            // Gerekli elemanlar varsa analiz fonksiyonlarını bağla
            if(mainTitleTr) {
                [mainTitleTr, seoTitleTr, metaDescriptionTr].forEach(el => el.addEventListener('keyup', runSeoChecks));
                tagifyKeywords.on('add remove change', runSeoChecks);
                runSeoChecks(); // Sayfa yüklendiğinde ilk kontrol
            }
        });
    </script>
@endpush
