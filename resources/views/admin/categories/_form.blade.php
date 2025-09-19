@if ($errors->any())
    <div class="alert alert-danger">
        <p><strong>Lütfen aşağıdaki hataları düzeltin:</strong></p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="mb-3">
            <label for="name" class="form-label">Kategori Adı</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $category->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
        </div>
        <hr>
        <h5>SEO Alanları (Anlık Analiz)</h5>
        <div class="mb-3">
            <label for="keywords" class="form-label">Anahtar Kelimeler</label>
            <input name="keywords" id="keywords" class="form-control"
                value="{{ old('keywords', $category->keywords ?? '') }}">
            <small>Kelimeleri yazıp Enter'a basın veya aralarına virgül koyun.</small>
        </div>
        <div class="mb-3">
            <label for="seo_title" class="form-label">SEO Başlığı</label>
            <input type="text" class="form-control" id="seo_title" name="seo_title"
                value="{{ old('seo_title', $category->seo_title ?? '') }}">
            <small id="seo-title-feedback" class="form-text text-muted">Karakter: <span id="seo-title-counter">0</span>
                (İdeal: 40-60)</small>
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Açıklaması</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
            <small id="meta-description-feedback" class="form-text text-muted">Karakter: <span
                    id="meta-description-counter">0</span> (İdeal: 100-160)</small>
        </div>
        <div class="mb-3">
            <h6>SEO Analizi Sonuçları:</h6>
            <ul id="seo-analysis-results" class="list-unstyled">
            </ul>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Durum ve Görünürlük</h5>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                        @checked(old('is_active', $category->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="show_in_sidebar" name="show_in_sidebar"
                        value="1" @checked(old('show_in_sidebar', $category->show_in_sidebar ?? true))>
                    <label class="form-check-label" for="show_in_sidebar">Sidebar'da Göster</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="show_in_menu" name="show_in_menu" value="1"
                        @checked(old('show_in_menu', $category->show_in_menu ?? false))>
                    <label class="form-check-label" for="show_in_menu">Menüde Göster</label>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Logo</h5>
                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                <img id="logo-preview"
                    src="{{ isset($category) && $category->logo_path ? asset('storage/' . $category->logo_path) : '#' }}"
                    alt="Logo Önizleme" class="img-thumbnail mt-2" width="100"
                    style="{{ isset($category) && $category->logo_path ? '' : 'display:none;' }}">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Banner</h5>
                <input type="file" name="banner" id="banner" class="form-control" accept="image/*">
                <img id="banner-preview"
                    src="{{ isset($category) && $category->banner_path ? asset('storage/' . $category->banner_path) : '#' }}"
                    alt="Banner Önizleme" class="img-thumbnail mt-2" width="200"
                    style="{{ isset($category) && $category->banner_path ? '' : 'display:none;' }}">
            </div>
        </div>
    </div>
</div>

<div class="col-12 mt-4">
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">İptal</a>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // --- 1. Tagify Başlatma ---
            var keywordsInput = document.querySelector('#keywords');
            var tagify = new Tagify(keywordsInput);

            // --- 2. Resim Önizleme Fonksiyonu ---
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(previewId).attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#logo").change(function() {
                readURL(this, '#logo-preview');
            });
            $("#banner").change(function() {
                readURL(this, '#banner-preview');
            });

            // --- 3. SEO Analiz Fonksiyonu ---
            const seoTitleInput = $('#seo_title');
            const metaDescriptionInput = $('#meta_description');
            const titleFeedback = $('#seo-title-feedback');
            const titleCounter = $('#seo-title-counter');
            const descriptionFeedback = $('#meta-description-feedback');
            const descriptionCounter = $('#meta-description-counter');
            const analysisResults = $('#seo-analysis-results');

            function runSeoChecks() {
                const title = seoTitleInput.val();
                const description = metaDescriptionInput.val();
                const keyword = tagify.value.length > 0 ? tagify.value[0].value.trim().toLowerCase() : '';
                const titleLength = title.length;
                const descriptionLength = description.length;
                let resultsHtml = '';

                // SEO Başlığı Uzunluk Kontrolü
                titleCounter.text(titleLength);
                titleFeedback.removeClass('text-success text-warning text-danger').addClass('text-muted');
                if (titleLength > 0 && titleLength < 40) {
                    titleFeedback.text('Çok kısa').addClass('text-warning');
                } else if (titleLength >= 40 && titleLength <= 60) {
                    titleFeedback.text('İdeal').addClass('text-success');
                } else if (titleLength > 60) {
                    titleFeedback.text('Çok uzun').addClass('text-danger');
                }

                // Meta Açıklaması Uzunluk Kontrolü
                descriptionCounter.text(descriptionLength);
                descriptionFeedback.removeClass('text-success text-warning text-danger').addClass('text-muted');
                if (descriptionLength > 0 && descriptionLength < 100) {
                    descriptionFeedback.text('Çok kısa').addClass('text-warning');
                } else if (descriptionLength >= 100 && descriptionLength <= 160) {
                    descriptionFeedback.text('İdeal').addClass('text-success');
                } else if (descriptionLength > 160) {
                    descriptionFeedback.text('Çok uzun').addClass('text-danger');
                }

                // Odak Anahtar Kelime Kontrolü
                if (keyword.length > 0) {
                    if (title.toLowerCase().includes(keyword)) {
                        resultsHtml +=
                            '<li class="text-success">✅ Odak anahtar kelime SEO başlığında bulunuyor.</li>';
                    } else {
                        resultsHtml +=
                            '<li class="text-danger">❌ Odak anahtar kelime SEO başlığında bulunmuyor.</li>';
                    }
                    if (description.toLowerCase().includes(keyword)) {
                        resultsHtml +=
                            '<li class="text-success">✅ Odak anahtar kelime meta açıklamasında bulunuyor.</li>';
                    } else {
                        resultsHtml +=
                            '<li class="text-danger">❌ Odak anahtar kelime meta açıklamasında bulunmuyor.</li>';
                    }
                } else {
                    resultsHtml =
                        '<li><small class="text-muted">Analiz için bir odak anahtar kelime girin.</small></li>';
                }

                analysisResults.html(resultsHtml);
            }

            seoTitleInput.on('keyup', runSeoChecks);
            metaDescriptionInput.on('keyup', runSeoChecks);
            tagify.on('add remove change', runSeoChecks); // Tagify'ın tüm değişikliklerini dinle

            runSeoChecks(); // Sayfa yüklendiğinde ilk kontrolü yap
        });
    </script>
@endpush
