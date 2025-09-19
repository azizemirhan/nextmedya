@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Yazı Başlığı</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $post->title ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">İçerik</label>

                    <div id="editor" style="min-height: 400px;">{!! old('content', $post->content ?? '') !!}</div>

                    <input type="hidden" id="content" name="content"
                        value="{{ old('content', $post->content ?? '') }}">
                </div>
                <div class="mb-3">
                    <label for="excerpt" class="form-label">Kısa Özet</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5>Gelişmiş SEO Alanları</h5>
                <div class="mb-3">
                    <label for="seo_title" class="form-label">SEO Başlığı</label>
                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                        value="{{ old('seo_title', $post->seo_title ?? '') }}">
                </div>
                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Açıklaması</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="canonical_url" class="form-label">Canonical URL</label>
                    <input type="url" class="form-control" id="canonical_url" name="canonical_url"
                        value="{{ old('canonical_url', $post->canonical_url ?? '') }}"
                        placeholder="https://ornek.com/orijinal-yazi">
                    <small>Bu yazı başka bir yerden alınmışsa, orijinal URL'i buraya girin.</small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="index_status" class="form-label">Arama Motoru Index</label>
                        <select name="index_status" id="index_status" class="form-select">
                            <option value="index" @selected(old('index_status', $post->index_status ?? 'index') == 'index')>Index (Önerilen)</option>
                            <option value="noindex" @selected(old('index_status', $post->index_status ?? '') == 'noindex')>No Index</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="follow_status" class="form-label">Link Takibi</label>
                        <select name="follow_status" id="follow_status" class="form-select">
                            <option value="follow" @selected(old('follow_status', $post->follow_status ?? 'follow') == 'follow')>Follow (Önerilen)</option>
                            <option value="nofollow" @selected(old('follow_status', $post->follow_status ?? '') == 'nofollow')>No Follow</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5>Schema (Yapısal Veri)</h5>
                <div class="mb-3">
                    <label for="schema_type" class="form-label">Schema Tipi</label>
                    <select name="schema_type" id="schema_type" class="form-select">
                        <option value="auto" @selected(old('schema_type', $post->schema_type ?? 'auto') == 'auto')>Otomatik (Article)</option>
                        <option value="manual" @selected(old('schema_type', $post->schema_type ?? '') == 'manual')>Manuel JSON-LD</option>
                        <option value="none" @selected(old('schema_type', $post->schema_type ?? '') == 'none')>Hiçbiri</option>
                    </select>
                </div>
                <div id="manual_schema_container" class="mb-3" style="display: none;">
                    <label for="manual_schema_json" class="form-label">Manuel JSON-LD Kodu</label>
                    <textarea class="form-control" id="manual_schema_json" name="manual_schema_json" rows="50">{{ old('manual_schema_json', isset($post->manual_schema_json) ? json_encode($post->manual_schema_json, JSON_PRETTY_PRINT) : '') }}</textarea>
                    <small>Geçerli bir JSON-LD kodu girin. Hatalı kod sitenize zarar verebilir.</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Yayınlama</h5>
                <div class="mb-3">
                    <label for="status" class="form-label">Durum</label>
                    <select name="status" id="status" class="form-select">
                        <option value="published" @selected(old('status', $post->status ?? '') == 'published')>Yayınlandı</option>
                        <option value="draft" @selected(old('status', $post->status ?? 'draft') == 'draft')>Taslak</option>
                        <option value="scheduled" @selected(old('status', $post->status ?? '') == 'scheduled')>Zamanlanmış</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="published_at" class="form-label">Yayın Tarihi</label>
                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                        value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Kategori ve Etiketler</h5>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Kategori Seçin</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Etiketler</label>
                    <input name="tags" id="tags" class="form-control"
                        value="{{ old('tags', isset($post) ? $post->tags->pluck('name')->implode(',') : '') }}">
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Öne Çıkan Görsel</h5>
                <input type="file" name="featured_image" id="featured_image" class="form-control mb-2"
                    accept="image/*">
                <label for="featured_image_alt_text" class="form-label">Görsel Alt Metni (Alt Text)</label>
                <input type="text" class="form-control" id="featured_image_alt_text"
                    name="featured_image_alt_text"
                    value="{{ old('featured_image_alt_text', $post->featured_image_alt_text ?? '') }}">
                <img id="image-preview"
                    src="{{ isset($post) && $post->featured_image ? asset( $post->featured_image) : '#' }}"
                    alt="Önizleme" class="img-thumbnail mt-2" width="200"
                    style="{{ isset($post) && $post->featured_image ? '' : 'display:none;' }}">
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
        $(document.body).ready(function() {

            const quill = new Quill('#editor', {
                theme: 'snow', // 'snow' en popüler ve zengin özellikli temadır
                modules: {
                    toolbar: {
                        container: [
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link', 'image', 'video'],
                            ['blockquote', 'code-block'],
                            [{
                                'align': []
                            }],
                            ['clean']
                        ],
                        handlers: {
                            'image': imageHandler // Resim butonuna basıldığında kendi fonksiyonumuzu çağır
                        }
                    }
                }
            });
            const hiddenContentInput = document.querySelector('input[name=content]');
            quill.on('text-change', function(delta, oldDelta, source) {
                hiddenContentInput.value = quill.root.innerHTML;
            });

            // --- 3. Quill Resim Yükleme Mantığı ---
            function imageHandler() {
                // Gizli bir dosya input'u oluştur
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                // Dosya seçildiğinde çalışacak olan kod
                input.onchange = function() {
                    const file = input.files[0];

                    // Dosya varsa ve resimse sunucuya gönder
                    if (file && file.type.startsWith('image/')) {
                        const formData = new FormData();
                        formData.append('file', file);
                        formData.append('_token', '{{ csrf_token() }}');

                        // AJAX isteği
                        fetch("{{ route('admin.editor.uploadImage') }}", {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(result => {
                                if (result.location) {
                                    // İmlecin o anki konumunu al
                                    const range = quill.getSelection(true);
                                    // Sunucudan gelen resim URL'ini imlecin olduğu yere ekle
                                    quill.insertEmbed(range.index, 'image', result.location);
                                    quill.setSelection(range.index + 1);
                                } else {
                                    throw new Error('Sunucudan geçerli bir URL dönmedi.');
                                }
                            })
                            .catch(error => {
                                console.error('Quill resim yükleme hatası:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Hata!',
                                    text: 'Resim yüklenirken bir sorun oluştu.'
                                });
                            });
                    }
                };
            }

            var tagsInputEle = document.querySelector('#tags');
            var keywordsInputEle = document.querySelector('#keywords');
            var tagifyTags = new Tagify(tagsInputEle);
            var tagifyKeywords = new Tagify(keywordsInputEle);

            // --- Öne Çıkan Görsel İçin Anlık Önizleme ---
            $('#featured_image').change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // --- Schema Tipi İçin Dinamik Alan Mantığı ---
            const schemaTypeSelect = $('#schema_type');
            const manualSchemaContainer = $('#manual_schema_container');
            const manualSchemaTextarea = $('#manual_schema_json');
            const defaultSchemaObject = @json($defaultSchema ?? []);

            function toggleManualSchema() {
                if (schemaTypeSelect.val() === 'manual') {
                    manualSchemaContainer.slideDown();
                    if (manualSchemaTextarea.val().trim() === '') {
                        manualSchemaTextarea.val(JSON.stringify(defaultSchemaObject, null, 4));
                    }
                } else {
                    manualSchemaContainer.slideUp();
                }
            }
            toggleManualSchema();
            schemaTypeSelect.on('change', toggleManualSchema);

            // --- Anlık SEO Analizi Mantığı ---
            const mainTitleInput = $('#title');
            const seoTitleInput = $('#seo_title');
            const metaDescriptionInput = $('#meta_description');

            const titleFeedback = $('#seo-title-feedback');
            const titleCounter = $('#seo-title-counter');
            const descriptionFeedback = $('#meta-description-feedback');
            const descriptionCounter = $('#meta-description-counter');
            const analysisResults = $('#seo-analysis-results');

            function runSeoChecks() {
                let titleToAnalyze = seoTitleInput.val().trim() !== '' ? seoTitleInput.val() :
                    mainTitleInput.val();
                const description = metaDescriptionInput.val();
                const keyword = tagifyKeywords.value.length > 0 ? tagifyKeywords.value[0].value.trim()
                    .toLowerCase() : '';
                const titleLength = titleToAnalyze.length;
                const descriptionLength = description.length;
                let resultsHtml = '';

                // SEO Başlığı Uzunluk Kontrolü
                titleCounter.text(titleLength);
                titleFeedback.attr('class', 'form-text').addClass('text-muted'); // Reset classes
                if (titleLength > 0 && titleLength < 40) {
                    titleFeedback.text('Çok kısa').addClass('text-warning');
                } else if (titleLength >= 40 && titleLength <= 60) {
                    titleFeedback.text('İdeal').addClass('text-success');
                } else if (titleLength > 60) {
                    titleFeedback.text('Çok uzun').addClass('text-danger');
                }

                // Meta Açıklaması Uzunluk Kontrolü
                descriptionCounter.text(descriptionLength);
                descriptionFeedback.attr('class', 'form-text').addClass('text-muted'); // Reset classes
                if (descriptionLength > 0 && descriptionLength < 100) {
                    descriptionFeedback.text('Çok kısa').addClass('text-warning');
                } else if (descriptionLength >= 100 && descriptionLength <= 160) {
                    descriptionFeedback.text('İdeal').addClass('text-success');
                } else if (descriptionLength > 160) {
                    descriptionFeedback.text('Çok uzun').addClass('text-danger');
                }

                // Odak Anahtar Kelime Kontrolü
                if (keyword.length > 0) {
                    if (titleToAnalyze.toLowerCase().includes(keyword)) {
                        resultsHtml +=
                            '<li class="text-success">✅ Odak anahtar kelime başlıkta bulunuyor.</li>';
                    } else {
                        resultsHtml +=
                            '<li class="text-danger">❌ Odak anahtar kelime başlıkta bulunmuyor.</li>';
                    }
                    if (description.toLowerCase().includes(keyword)) {
                        resultsHtml +=
                            '<li class="text-success">✅ Odak anahtar kelime açıklamada bulunuyor.</li>';
                    } else {
                        resultsHtml +=
                            '<li class="text-danger">❌ Odak anahtar kelime açıklamada bulunmuyor.</li>';
                    }
                } else {
                    resultsHtml =
                        '<li><small class="text-muted">Analiz için bir anahtar kelime girin.</small></li>';
                }

                analysisResults.html(resultsHtml);
            }

            // Analizi tetikleyecek olay dinleyicileri
            mainTitleInput.on('keyup', runSeoChecks);
            seoTitleInput.on('keyup', runSeoChecks);
            metaDescriptionInput.on('keyup', runSeoChecks);
            tagifyKeywords.on('add remove change', runSeoChecks);

            // Sayfa yüklendiğinde ilk kontrolü yap
            runSeoChecks();
        });
    </script>
@endpush
