@if ($errors->any())
    <div class="alert alert-danger">
        <h5 class="alert-heading">Formda Hatalar Bulundu!</h5>
        <ul class="mb-0">
            @foreach ($errors->getMessages() as $field => $messages)
                <li><strong>{{ $field }}:</strong> {{ implode(', ', $messages) }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- SEO SKOR WİDGET --}}
<div id="seo-score-widget" class="seo-score-widget">
    <div class="seo-score-widget__header">
        <h6>SEO Skoru</h6>
        <button type="button" class="btn-close btn-close-white" onclick="document.getElementById('seo-score-widget').style.display='none'"></button>
    </div>
    <div class="seo-score-widget__body">
        <div class="seo-score-circle">
            <svg viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="none" stroke="#e0e0e0" stroke-width="10"></circle>
                <circle id="seo-score-progress" cx="50" cy="50" r="45" fill="none" stroke="#28a745" stroke-width="10"
                        stroke-dasharray="283" stroke-dashoffset="283" transform="rotate(-90 50 50)"></circle>
            </svg>
            <div class="seo-score-text">
                <span id="seo-score-value">0</span>%
            </div>
        </div>
        <div id="seo-rating" class="seo-rating">
            <span class="badge bg-secondary">Analiz bekleniyor</span>
        </div>
        <ul id="seo-checks-list" class="seo-checks-list"></ul>
    </div>
</div>

<div class="row">
    {{-- Sol Taraf: Sayfa Bilgileri ve SEO --}}
    <div class="col-lg-8">
        {{-- Temel Bilgiler Kartı --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Sayfa Bilgileri</h5>

                {{-- Dil Tabları --}}
                <ul class="nav nav-tabs nav-tabs-sm" id="langTab" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#{{ $langCode }}-tab-pane" type="button">{{ $lang['name'] }} ({{ strtoupper($langCode) }})
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3" id="langTabContent">
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $langCode }}-tab-pane" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Sayfa Başlığı ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" name="title[{{ $langCode }}]"
                                       value="{{ old('title.' . $langCode, $page->getTranslation('title', $langCode)) }}"
                                       {{ $loop->first ? 'required' : '' }} data-seo-field="title" data-locale="{{ $langCode }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banner Başlık ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" name="banner_title[{{ $langCode }}]"
                                       value="{{ old('banner_title.' . $langCode, $page->getTranslation('banner_title', $langCode)) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banner Alt Başlık ({{ strtoupper($langCode) }})</label>
                                <textarea class="form-control" name="banner_subtitle[{{ $langCode }}]" rows="2">{{ old('banner_subtitle.' . $langCode, $page->getTranslation('banner_subtitle', $langCode)) }}</textarea>
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

                {{-- Ana SEO Tabları --}}
                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#seo-general" type="button">Genel</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo-social" type="button">Sosyal Medya</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo-schema" type="button">Yapılandırılmış Veri</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo-advanced" type="button">Teknik</button>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    {{-- GENEL SEO --}}
                    <div class="tab-pane fade show active" id="seo-general">
                        {{-- Odak Anahtar Kelime --}}
                        <div class="alert alert-info mb-3">
                            <i class="icofont-info-circle"></i> <strong>Odak Anahtar Kelime:</strong> Sayfanızın sıralanmasını istediğiniz ana anahtar kelimeyi girin.
                        </div>

                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $langCode => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                            data-bs-target="#focus-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-3">
                            @foreach($activeLanguages as $langCode => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="focus-{{ $langCode }}">
                                    <div class="mb-3">
                                        <label class="form-label">Odak Anahtar Kelime ({{ strtoupper($langCode) }})</label>
                                        <input type="text" class="form-control" name="focus_keyword[{{ $langCode }}]"
                                               value="{{ old('focus_keyword.' . $langCode, $page->getTranslation('focus_keyword', $langCode)) }}"
                                               placeholder="örn: kurumsal web tasarım" data-seo-field="focus_keyword" data-locale="{{ $langCode }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Google SERP Önizlemesi --}}
                        <div class="mb-4 mt-4">
                            <h6 class="mb-3">Google Arama Önizlemesi</h6>
                            <div class="serp-preview">
                                <div class="serp-preview__url">
                                    <span class="serp-preview__domain">{{ parse_url(config('app.url'), PHP_URL_HOST) }}</span>
                                    <span class="serp-preview__breadcrumb"> › <span id="serp-slug-preview">{{ $page->slug ?? 'ornek-sayfa' }}</span></span>
                                </div>
                                <div class="serp-preview__title" id="serp-title-preview">
                                    {{ $page->getTranslation('seo_title', 'tr') ?: $page->getTranslation('title', 'tr') ?: 'Başlık buraya gelecek' }}
                                </div>
                                <div class="serp-preview__description" id="serp-description-preview">
                                    {{ $page->getTranslation('meta_description', 'tr') ?: 'Meta açıklama buraya gelecek...' }}
                                </div>
                            </div>
                        </div>

                        {{-- Dil Bazlı SEO Alanları --}}
                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $langCode => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                            data-bs-target="#seo-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-3">
                            @foreach($activeLanguages as $langCode => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="seo-{{ $langCode }}">
                                    <div class="mb-3">
                                        <label class="form-label">SEO Başlığı ({{ strtoupper($langCode) }})</label>
                                        <input type="text" class="form-control" name="seo_title[{{ $langCode }}]"
                                               value="{{ old('seo_title.' . $langCode, $page->getTranslation('seo_title', $langCode)) }}"
                                               maxlength="60" data-seo-field="seo_title" data-locale="{{ $langCode }}">
                                        <small class="form-text text-muted">
                                            <span id="seo-title-counter-{{ $langCode }}">0</span>/60 karakter
                                            <span id="seo-title-feedback-{{ $langCode }}" class="ms-2"></span>
                                        </small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Meta Açıklama ({{ strtoupper($langCode) }})</label>
                                        <textarea class="form-control" name="meta_description[{{ $langCode }}]" rows="3"
                                                  maxlength="160" data-seo-field="meta_description" data-locale="{{ $langCode }}">{{ old('meta_description.' . $langCode, $page->getTranslation('meta_description', $langCode)) }}</textarea>
                                        <small class="form-text text-muted">
                                            <span id="meta-description-counter-{{ $langCode }}">0</span>/160 karakter
                                            <span id="meta-description-feedback-{{ $langCode }}" class="ms-2"></span>
                                        </small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Anahtar Kelimeler ({{ strtoupper($langCode) }})</label>
                                        <input type="text" class="form-control" name="keywords[{{ $langCode }}]"
                                               value="{{ old('keywords.' . $langCode, $page->getTranslation('keywords', $langCode)) }}"
                                               placeholder="kelime1, kelime2, kelime3">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Canonical URL</label>
                            <input type="url" class="form-control" name="canonical_url" value="{{ old('canonical_url', $page->canonical_url) }}">
                            <small class="form-text text-muted">Boş bırakılırsa otomatik oluşturulur</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Index Durumu</label>
                                    <select class="form-select" name="index_status">
                                        <option value="index" {{ old('index_status', $page->index_status) === 'index' ? 'selected' : '' }}>Index (İzin ver)</option>
                                        <option value="noindex" {{ old('index_status', $page->index_status) === 'noindex' ? 'selected' : '' }}>NoIndex (İzin verme)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Follow Durumu</label>
                                    <select class="form-select" name="follow_status">
                                        <option value="follow" {{ old('follow_status', $page->follow_status) === 'follow' ? 'selected' : '' }}>Follow (Takip et)</option>
                                        <option value="nofollow" {{ old('follow_status', $page->follow_status) === 'nofollow' ? 'selected' : '' }}>NoFollow (Takip etme)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SOSYAL MEDYA --}}
                    <div class="tab-pane fade" id="seo-social">
                        <h6 class="mb-3">Open Graph (Facebook)</h6>

                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $langCode => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                            data-bs-target="#og-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-3">
                            @foreach($activeLanguages as $langCode => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="og-{{ $langCode }}">
                                    <div class="mb-3">
                                        <label class="form-label">OG Başlık ({{ strtoupper($langCode) }})</label>
                                        <input type="text" class="form-control" name="og_title[{{ $langCode }}]"
                                               value="{{ old('og_title.' . $langCode, $page->getTranslation('og_title', $langCode)) }}">
                                        <small class="form-text text-muted">Boş bırakılırsa SEO başlığı kullanılır</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">OG Açıklama ({{ strtoupper($langCode) }})</label>
                                        <textarea class="form-control" name="og_description[{{ $langCode }}]" rows="3">{{ old('og_description.' . $langCode, $page->getTranslation('og_description', $langCode)) }}</textarea>
                                        <small class="form-text text-muted">Boş bırakılırsa meta açıklama kullanılır</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label">OG Görsel</label>
                            <input type="text" class="form-control" name="og_image" value="{{ old('og_image', $page->og_image) }}">
                            <small class="form-text text-muted">Önerilen boyut: 1200x630 piksel</small>
                        </div>

                        <hr class="my-4">

                        <h6 class="mb-3">Twitter Card</h6>
                        <div class="mb-3">
                            <label class="form-label">Card Tipi</label>
                            <select class="form-select" name="twitter_card_type">
                                <option value="summary" {{ old('twitter_card_type', $page->twitter_card_type) === 'summary' ? 'selected' : '' }}>Summary</option>
                                <option value="summary_large_image" {{ old('twitter_card_type', $page->twitter_card_type) === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                            </select>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $langCode => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                            data-bs-target="#twitter-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-3">
                            @foreach($activeLanguages as $langCode => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="twitter-{{ $langCode }}">
                                    <div class="mb-3">
                                        <label class="form-label">Twitter Başlık ({{ strtoupper($langCode) }})</label>
                                        <input type="text" class="form-control" name="twitter_title[{{ $langCode }}]"
                                               value="{{ old('twitter_title.' . $langCode, $page->getTranslation('twitter_title', $langCode)) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Twitter Açıklama ({{ strtoupper($langCode) }})</label>
                                        <textarea class="form-control" name="twitter_description[{{ $langCode }}]" rows="3">{{ old('twitter_description.' . $langCode, $page->getTranslation('twitter_description', $langCode)) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Twitter Görsel</label>
                            <input type="text" class="form-control" name="twitter_image" value="{{ old('twitter_image', $page->twitter_image) }}">
                        </div>
                    </div>

                    {{-- YAPILANDIRILMIŞ VERİ (SCHEMA) --}}
                    <div class="tab-pane fade" id="seo-schema">
                        <div class="mb-3">
                            <label class="form-label">Schema Tipi</label>
                            <select class="form-select" name="schema_article_type" id="schema-type-select">
                                <option value="WebPage" {{ old('schema_article_type', $page->schema_article_type ?? 'WebPage') === 'WebPage' ? 'selected' : '' }}>WebPage</option>
                                <option value="Article" {{ old('schema_article_type', $page->schema_article_type) === 'Article' ? 'selected' : '' }}>Article</option>
                                <option value="Product" {{ old('schema_article_type', $page->schema_article_type) === 'Product' ? 'selected' : '' }}>Product</option>
                                <option value="Service" {{ old('schema_article_type', $page->schema_article_type) === 'Service' ? 'selected' : '' }}>Service</option>
                                <option value="FAQPage" {{ old('schema_article_type', $page->schema_article_type) === 'FAQPage' ? 'selected' : '' }}>FAQPage</option>
                                <option value="LocalBusiness" {{ old('schema_article_type', $page->schema_article_type) === 'LocalBusiness' ? 'selected' : '' }}>LocalBusiness</option>
                            </select>
                        </div>

                        {{-- Product Schema Alanları --}}
                        <div id="schema-product-fields" style="display: none;">
                            <h6 class="mb-3">Ürün Bilgileri</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Fiyat</label>
                                        <input type="number" step="0.01" class="form-control" name="schema_product_price"
                                               value="{{ old('schema_product_price', $page->schema_product_price) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Para Birimi</label>
                                        <select class="form-select" name="schema_product_currency">
                                            <option value="TRY" {{ old('schema_product_currency', $page->schema_product_currency ?? 'TRY') === 'TRY' ? 'selected' : '' }}>TRY</option>
                                            <option value="USD" {{ old('schema_product_currency', $page->schema_product_currency) === 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ old('schema_product_currency', $page->schema_product_currency) === 'EUR' ? 'selected' : '' }}>EUR</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Stok Durumu</label>
                                        <select class="form-select" name="schema_product_availability">
                                            <option value="InStock" {{ old('schema_product_availability', $page->schema_product_availability ?? 'InStock') === 'InStock' ? 'selected' : '' }}>Stokta</option>
                                            <option value="OutOfStock" {{ old('schema_product_availability', $page->schema_product_availability) === 'OutOfStock' ? 'selected' : '' }}>Tükendi</option>
                                            <option value="PreOrder" {{ old('schema_product_availability', $page->schema_product_availability) === 'PreOrder' ? 'selected' : '' }}>Ön Sipariş</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Değerlendirme (1-5)</label>
                                        <input type="number" step="0.1" min="1" max="5" class="form-control" name="schema_product_rating"
                                               value="{{ old('schema_product_rating', $page->schema_product_rating) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Service Schema Alanları --}}
                        <div id="schema-service-fields" style="display: none;">
                            <h6 class="mb-3">Hizmet Bilgileri</h6>
                            <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                @foreach($activeLanguages as $langCode => $lang)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                                data-bs-target="#service-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content mt-3">
                                @foreach($activeLanguages as $langCode => $lang)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="service-{{ $langCode }}">
                                        <div class="mb-3">
                                            <label class="form-label">Hizmet Sağlayıcı ({{ strtoupper($langCode) }})</label>
                                            <input type="text" class="form-control" name="schema_service_provider[{{ $langCode }}]"
                                                   value="{{ old('schema_service_provider.' . $langCode, $page->getTranslation('schema_service_provider', $langCode)) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Hizmet Alanı ({{ strtoupper($langCode) }})</label>
                                            <input type="text" class="form-control" name="schema_service_area[{{ $langCode }}]"
                                                   value="{{ old('schema_service_area.' . $langCode, $page->getTranslation('schema_service_area', $langCode)) }}"
                                                   placeholder="örn: İstanbul, Türkiye">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- FAQ Schema Alanları --}}
                        <div id="schema-faq-fields" style="display: none;">
                            <h6 class="mb-3">SSS (Sık Sorulan Sorular)</h6>
                            <div id="faq-items-container"></div>
                            <button type="button" class="btn btn-sm btn-success" id="add-faq-item">+ SSS Ekle</button>
                        </div>
                    </div>

                    {{-- TEKNİK SEO --}}
                    <div class="tab-pane fade" id="seo-advanced">
                        <h6 class="mb-3">Meta Robots</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="meta_noindex" value="1" id="meta_noindex"
                                            {{ old('meta_noindex', $page->meta_noindex) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="meta_noindex">NoIndex (Arama motorları bu sayfayı indekslemesin)</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="meta_nofollow" value="1" id="meta_nofollow"
                                            {{ old('meta_nofollow', $page->meta_nofollow) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="meta_nofollow">NoFollow (Linkleri takip etme)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="meta_noarchive" value="1" id="meta_noarchive"
                                            {{ old('meta_noarchive', $page->meta_noarchive) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="meta_noarchive">NoArchive (Önbellek kopyası oluşturma)</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="meta_nosnippet" value="1" id="meta_nosnippet"
                                            {{ old('meta_nosnippet', $page->meta_nosnippet) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="meta_nosnippet">NoSnippet (Özet gösterme)</label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="mb-3">Yönlendirme (Redirect)</h6>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="redirect_enabled" value="1" id="redirect_enabled"
                                    {{ old('redirect_enabled', $page->redirect_enabled) ? 'checked' : '' }}>
                            <label class="form-check-label" for="redirect_enabled">
                                Yönlendirme Aktif
                            </label>
                        </div>
                        <div id="redirect-fields" style="display: {{ old('redirect_enabled', $page->redirect_enabled) ? 'block' : 'none' }};">
                            <div class="mb-3">
                                <label class="form-label">Yönlendirme URL'si</label>
                                <input type="url" class="form-control" name="redirect_url" value="{{ old('redirect_url', $page->redirect_url) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Yönlendirme Tipi</label>
                                <select class="form-select" name="redirect_type">
                                    <option value="301" {{ old('redirect_type', $page->redirect_type ?? '301') == '301' ? 'selected' : '' }}>301 (Kalıcı)</option>
                                    <option value="302" {{ old('redirect_type', $page->redirect_type) == '302' ? 'selected' : '' }}>302 (Geçici)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sağ Taraf: Yayın Ayarları --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Yayın Ayarları</h5>

                <div class="mb-3">
                    <label class="form-label">Durum</label>
                    <select class="form-select" name="status">
                        <option value="draft" {{ old('status', $page->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Taslak</option>
                        <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Yayında</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" required>
                    <small class="form-text text-muted">URL dostu adres</small>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="icofont-save"></i> Kaydet
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* SEO Score Widget */
        .seo-score-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            color: white;
            z-index: 1050;
            overflow: hidden;
        }

        .seo-score-widget__header {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .seo-score-widget__header h6 {
            margin: 0;
            color: white;
            font-weight: 600;
        }

        .seo-score-widget__body {
            padding: 20px;
        }

        .seo-score-circle {
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
            position: relative;
        }

        .seo-score-circle svg {
            transform: rotate(-90deg);
            width: 100%;
            height: 100%;
        }

        .seo-score-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 28px;
            font-weight: bold;
            color: white;
        }

        .seo-rating {
            text-align: center;
            margin-bottom: 15px;
        }

        .seo-checks-list {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 200px;
            overflow-y: auto;
        }

        .seo-checks-list li {
            padding: 5px 0;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .seo-check-icon {
            flex-shrink: 0;
        }

        /* SERP Preview */
        .serp-preview {
            background: #fff;
            border: 1px solid #dfe1e5;
            border-radius: 8px;
            padding: 20px;
            font-family: arial, sans-serif;
        }

        .serp-preview__url {
            font-size: 14px;
            line-height: 1.3;
            color: #5f6368;
            margin-bottom: 5px;
        }

        .serp-preview__domain {
            color: #202124;
        }

        .serp-preview__breadcrumb {
            color: #5f6368;
        }

        .serp-preview__title {
            font-size: 20px;
            line-height: 1.3;
            color: #1a0dab;
            font-weight: 400;
            margin-bottom: 3px;
            cursor: pointer;
        }

        .serp-preview__title:hover {
            text-decoration: underline;
        }

        .serp-preview__description {
            font-size: 14px;
            line-height: 1.58;
            color: #4d5156;
            word-wrap: break-word;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const CSRF_TOKEN = '{{ csrf_token() }}';
            let seoAnalysisTimeout;
            let currentLocale = '{{ array_key_first($activeLanguages) }}';

            // Dil değişimi izle
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(e) {
                    const target = e.target.getAttribute('data-bs-target');
                    const match = target.match(/-(tr|en|de)-tab-pane/);
                    if (match) {
                        currentLocale = match[1];
                        runSeoAnalysis();
                    }
                });
            });

            // Schema tip değişimi
            document.getElementById('schema-type-select')?.addEventListener('change', function() {
                const value = this.value;
                document.getElementById('schema-product-fields').style.display = value === 'Product' ? 'block' : 'none';
                document.getElementById('schema-service-fields').style.display = value === 'Service' ? 'block' : 'none';
                document.getElementById('schema-faq-fields').style.display = value === 'FAQPage' ? 'block' : 'none';
            });

            // Sayfa yüklendiğinde aktif schema alanlarını göster
            const initialSchemaType = document.getElementById('schema-type-select')?.value;
            if (initialSchemaType) {
                document.getElementById('schema-product-fields').style.display = initialSchemaType === 'Product' ? 'block' : 'none';
                document.getElementById('schema-service-fields').style.display = initialSchemaType === 'Service' ? 'block' : 'none';
                document.getElementById('schema-faq-fields').style.display = initialSchemaType === 'FAQPage' ? 'block' : 'none';
            }

            // Redirect alanlarını göster/gizle
            document.getElementById('redirect_enabled')?.addEventListener('change', function() {
                document.getElementById('redirect-fields').style.display = this.checked ? 'block' : 'none';
            });

            // SEO Analizi Tetikleme
            function triggerSeoAnalysis(event) {
                clearTimeout(seoAnalysisTimeout);
                seoAnalysisTimeout = setTimeout(() => runSeoAnalysis(), 1000);
            }

            async function runSeoAnalysis() {
                const formData = {
                    locale: currentLocale,
                    focus_keyword: document.querySelector(`input[name="focus_keyword[${currentLocale}]"]`)?.value || '',
                    title: document.querySelector(`input[name="title[${currentLocale}]"]`)?.value || '',
                    seo_title: document.querySelector(`input[name="seo_title[${currentLocale}]"]`)?.value || '',
                    meta_description: document.querySelector(`textarea[name="meta_description[${currentLocale}]"]`)?.value || '',
                    content: '', // Page'de content yok, boş gönder
                    slug: document.getElementById('slug')?.value || ''
                };

                if (!formData.focus_keyword) {
                    document.getElementById('seo-score-value').textContent = '0';
                    document.getElementById('seo-rating').innerHTML = '<span class="badge bg-secondary">Odak kelime giriniz</span>';
                    document.getElementById('seo-checks-list').innerHTML = '';
                    return;
                }

                try {
                    const response = await fetch('/admin/api/seo-analysis', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();
                    updateSeoWidget(result);
                } catch (error) {
                    console.error('SEO Analiz Hatası:', error);
                }
            }

            function updateSeoWidget(data) {
                document.getElementById('seo-score-value').textContent = data.percentage;

                const circle = document.getElementById('seo-score-progress');
                const circumference = 2 * Math.PI * 45;
                const offset = circumference - (data.percentage / 100) * circumference;
                circle.style.strokeDashoffset = offset;

                const ratingBadge = document.getElementById('seo-rating');
                ratingBadge.innerHTML = `<span class="badge bg-${data.rating.color}">${data.rating.icon} ${data.rating.label}</span>`;

                const checksList = document.getElementById('seo-checks-list');
                checksList.innerHTML = '';

                Object.values(data.checks).forEach(check => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                    <span class="seo-check-icon">${check.status ? '✅' : '❌'}</span>
                    <span>${check.label}</span>
                `;
                    checksList.appendChild(li);
                });

                if (data.percentage >= 80) {
                    circle.style.stroke = '#28a745';
                } else if (data.percentage >= 60) {
                    circle.style.stroke = '#17a2b8';
                } else if (data.percentage >= 40) {
                    circle.style.stroke = '#ffc107';
                } else {
                    circle.style.stroke = '#dc3545';
                }
            }

            // SEO analizi tetikleyen alanlar
            document.querySelectorAll('[data-seo-field]').forEach(field => {
                field.addEventListener('input', triggerSeoAnalysis);
                field.addEventListener('change', triggerSeoAnalysis);
            });

            // İlk yüklemede analizi çalıştır
            setTimeout(runSeoAnalysis, 500);

            // Karakter Sayaçları
            function updateCharCounter(input, counterId, feedbackId) {
                const counter = document.getElementById(counterId);
                const feedback = document.getElementById(feedbackId);
                if (!counter || !input) return;

                const length = input.value.length;
                counter.textContent = length;

                if (feedbackId.includes('title')) {
                    if (length < 40) {
                        feedback.textContent = 'Çok kısa';
                        feedback.className = 'ms-2 text-warning';
                    } else if (length >= 40 && length <= 60) {
                        feedback.textContent = 'İdeal';
                        feedback.className = 'ms-2 text-success';
                    } else {
                        feedback.textContent = 'Çok uzun';
                        feedback.className = 'ms-2 text-danger';
                    }
                } else {
                    if (length < 120) {
                        feedback.textContent = 'Çok kısa';
                        feedback.className = 'ms-2 text-warning';
                    } else if (length >= 120 && length <= 160) {
                        feedback.textContent = 'İdeal';
                        feedback.className = 'ms-2 text-success';
                    } else {
                        feedback.textContent = 'Çok uzun';
                        feedback.className = 'ms-2 text-danger';
                    }
                }
            }

            // Tüm diller için sayaçları bağla
            @foreach($activeLanguages as $langCode => $lang)
            const seoTitleInput_{{ $langCode }} = document.querySelector('input[name="seo_title[{{ $langCode }}]"]');
            const metaDescInput_{{ $langCode }} = document.querySelector('textarea[name="meta_description[{{ $langCode }}]"]');

            if (seoTitleInput_{{ $langCode }}) {
                seoTitleInput_{{ $langCode }}.addEventListener('input', function() {
                    updateCharCounter(this, 'seo-title-counter-{{ $langCode }}', 'seo-title-feedback-{{ $langCode }}');
                });
                updateCharCounter(seoTitleInput_{{ $langCode }}, 'seo-title-counter-{{ $langCode }}', 'seo-title-feedback-{{ $langCode }}');
            }

            if (metaDescInput_{{ $langCode }}) {
                metaDescInput_{{ $langCode }}.addEventListener('input', function() {
                    updateCharCounter(this, 'meta-description-counter-{{ $langCode }}', 'meta-description-feedback-{{ $langCode }}');
                });
                updateCharCounter(metaDescInput_{{ $langCode }}, 'meta-description-counter-{{ $langCode }}', 'meta-description-feedback-{{ $langCode }}');
            }
            @endforeach
        });
    </script>
@endpush