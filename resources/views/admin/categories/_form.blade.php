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
    {{-- Sol Taraf: Kategori Bilgileri ve SEO --}}
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- DİL SEKMELERİ (DİNAMİK) --}}
                <ul class="nav nav-tabs nav-tabs-sm" id="langTab" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#{{ $langCode }}-tab-pane" type="button">{{ $lang['name'] }} ({{ strtoupper($langCode) }})</button>
                        </li>
                    @endforeach
                </ul>

                {{-- DİNAMİK İÇERİK SEKMELERİ --}}
                <div class="tab-content mt-3" id="langTabContent">
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $langCode }}-tab-pane" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Kategori Adı ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" name="name[{{ $langCode }}]" value="{{ old('name.' . $langCode, $category->getTranslation('name', $langCode)) }}" {{ $loop->first ? 'required' : '' }}>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Açıklama ({{ strtoupper($langCode) }})</label>
                                <textarea class="form-control" name="description[{{ $langCode }}]" rows="3">{{ old('description.' . $langCode, $category->getTranslation('description', $langCode)) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">SEO Alanları (Anlık Analiz)</h5>
                {{-- SEO için dil sekmeleri --}}
                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation"><button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#seo-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button></li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3">
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="seo-{{ $langCode }}" role="tabpanel">
                            <div class="mb-3">
                                <label for="seo_title_{{ $langCode }}" class="form-label">SEO Başlığı ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" id="seo_title_{{ $langCode }}" name="seo_title[{{ $langCode }}]"
                                       value="{{ old('seo_title.' . $langCode, $category->getTranslation('seo_title', $langCode)) }}">
                                <small id="seo-title-feedback-{{ $langCode }}" class="form-text text-muted">Karakter: <span id="seo-title-counter-{{ $langCode }}">0</span> (İdeal: 40-60)</small>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description_{{ $langCode }}" class="form-label">Meta Açıklaması ({{ strtoupper($langCode) }})</label>
                                <textarea class="form-control" id="meta_description_{{ $langCode }}" name="meta_description[{{ $langCode }}]" rows="2">{{ old('meta_description.' . $langCode, $category->getTranslation('meta_description', $langCode)) }}</textarea>
                                <small id="meta-description-feedback-{{ $langCode }}" class="form-text text-muted">Karakter: <span
                                        id="meta-description-counter-{{ $langCode }}">0</span> (İdeal: 100-160)</small>
                            </div>
                            <div class="mb-3">
                                <label for="keywords_{{ $langCode }}" class="form-label">Anahtar Kelimeler ({{ strtoupper($langCode) }})</label>
                                <input name="keywords[{{ $langCode }}]" id="keywords_{{ $langCode }}" class="form-control tagify-input"
                                       value="{{ old('keywords.' . $langCode, $category->getTranslation('keywords', $langCode)) }}">
                                <small>Kelimeleri yazıp Enter'a basın veya aralarına virgül koyun.</small>
                            </div>
                            <div class="mb-3">
                                <h6>SEO Analizi Sonuçları ({{ strtoupper($langCode) }}):</h6>
                                <ul id="seo-analysis-results-{{ $langCode }}" class="list-unstyled">
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- Sağ Taraf: Durum, Görünürlük ve Resimler --}}
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
                     src="{{ isset($category) && $category->logo_path ? asset($category->logo_path) : '#' }}"
                     alt="Logo Önizleme" class="img-thumbnail mt-2" width="100"
                     style="{{ isset($category) && $category->logo_path ? '' : 'display:none;' }}">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Banner</h5>
                <input type="file" name="banner" id="banner" class="form-control" accept="image/*">
                <img id="banner-preview"
                     src="{{ isset($category) && $category->banner_path ? asset($category->banner_path) : '#' }}"
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
        document.addEventListener('DOMContentLoaded', function() {
            // --- Resim Önizleme Fonksiyonu ---
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector(previewId).src = e.target.result;
                        document.querySelector(previewId).style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            document.getElementById('logo').addEventListener('change', function() { readURL(this, '#logo-preview'); });
            document.getElementById('banner').addEventListener('change', function() { readURL(this, '#banner-preview'); });

            // --- SEO Analiz Fonksiyonu (Dinamik Dil Desteği ile) ---
            @foreach($activeLanguages as $langCode => $lang)
            const seoTitleInput_{{ $langCode }} = document.getElementById('seo_title_{{ $langCode }}');
            const metaDescriptionInput_{{ $langCode }} = document.getElementById('meta_description_{{ $langCode }}');
            const titleFeedback_{{ $langCode }} = document.getElementById('seo-title-feedback-{{ $langCode }}');
            const titleCounter_{{ $langCode }} = document.getElementById('seo-title-counter-{{ $langCode }}');
            const descriptionFeedback_{{ $langCode }} = document.getElementById('meta-description-feedback-{{ $langCode }}');
            const descriptionCounter_{{ $langCode }} = document.getElementById('meta-description-counter-{{ $langCode }}');
            const analysisResults_{{ $langCode }} = document.getElementById('seo-analysis-results-{{ $langCode }}');
            const keywordsInput_{{ $langCode }} = document.getElementById('keywords_{{ $langCode }}');
            const tagify_{{ $langCode }} = new Tagify(keywordsInput_{{ $langCode }});

            function runSeoChecks_{{ $langCode }}() {
                const title = seoTitleInput_{{ $langCode }}.value;
                const description = metaDescriptionInput_{{ $langCode }}.value;
                const keyword = tagify_{{ $langCode }}.value.length > 0 ? tagify_{{ $langCode }}.value[0].value.trim().toLowerCase() : '';
                const titleLength = title.length;
                const descriptionLength = description.length;
                let resultsHtml = '';

                // SEO Başlığı Uzunluk Kontrolü
                titleCounter_{{ $langCode }}.textContent = titleLength;
                titleFeedback_{{ $langCode }}.className = 'form-text'; // Reset classes
                if (titleLength > 0 && titleLength < 40) {
                    titleFeedback_{{ $langCode }}.textContent = 'Çok kısa';
                    titleFeedback_{{ $langCode }}.classList.add('text-warning');
                } else if (titleLength >= 40 && titleLength <= 60) {
                    titleFeedback_{{ $langCode }}.textContent = 'İdeal';
                    titleFeedback_{{ $langCode }}.classList.add('text-success');
                } else if (titleLength > 60) {
                    titleFeedback_{{ $langCode }}.textContent = 'Çok uzun';
                    titleFeedback_{{ $langCode }}.classList.add('text-danger');
                } else {
                    titleFeedback_{{ $langCode }}.textContent = 'Karakter: ' + titleLength + ' (İdeal: 40-60)';
                    titleFeedback_{{ $langCode }}.classList.add('text-muted');
                }


                // Meta Açıklaması Uzunluk Kontrolü
                descriptionCounter_{{ $langCode }}.textContent = descriptionLength;
                descriptionFeedback_{{ $langCode }}.className = 'form-text'; // Reset classes
                if (descriptionLength > 0 && descriptionLength < 100) {
                    descriptionFeedback_{{ $langCode }}.textContent = 'Çok kısa';
                    descriptionFeedback_{{ $langCode }}.classList.add('text-warning');
                } else if (descriptionLength >= 100 && descriptionLength <= 160) {
                    descriptionFeedback_{{ $langCode }}.textContent = 'İdeal';
                    descriptionFeedback_{{ $langCode }}.classList.add('text-success');
                } else if (descriptionLength > 160) {
                    descriptionFeedback_{{ $langCode }}.textContent = 'Çok uzun';
                    descriptionFeedback_{{ $langCode }}.classList.add('text-danger');
                } else {
                    descriptionFeedback_{{ $langCode }}.textContent = 'Karakter: ' + descriptionLength + ' (İdeal: 100-160)';
                    descriptionFeedback_{{ $langCode }}.classList.add('text-muted');
                }

                // Odak Anahtar Kelime Kontrolü
                if (keyword.length > 0) {
                    if (title.toLowerCase().includes(keyword)) {
                        resultsHtml += '<li class="text-success">✅ Odak anahtar kelime SEO başlığında bulunuyor.</li>';
                    } else {
                        resultsHtml += '<li class="text-danger">❌ Odak anahtar kelime SEO başlığında bulunmuyor.</li>';
                    }
                    if (description.toLowerCase().includes(keyword)) {
                        resultsHtml += '<li class="text-success">✅ Odak anahtar kelime meta açıklamasında bulunuyor.</li>';
                    } else {
                        resultsHtml += '<li class="text-danger">❌ Odak anahtar kelime meta açıklamasında bulunmuyor.</li>';
                    }
                } else {
                    resultsHtml = '<li><small class="text-muted">Analiz için bir odak anahtar kelime girin.</small></li>';
                }

                analysisResults_{{ $langCode }}.innerHTML = resultsHtml;
            }

            seoTitleInput_{{ $langCode }}.addEventListener('keyup', runSeoChecks_{{ $langCode }});
            metaDescriptionInput_{{ $langCode }}.addEventListener('keyup', runSeoChecks_{{ $langCode }});
            tagify_{{ $langCode }}.on('add remove change', runSeoChecks_{{ $langCode }});

            runSeoChecks_{{ $langCode }}(); // Sayfa yüklendiğinde ilk kontrolü yap
            @endforeach
        });
    </script>
@endpush
