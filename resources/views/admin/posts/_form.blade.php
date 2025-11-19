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
    {{-- Sol Taraf: İçerik ve SEO Alanları --}}
    <div class="col-lg-8">
        {{-- İçerik Kartı --}}
        <div class="card">
            <div class="card-body">
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
                                <label class="form-label">Yazı Başlığı ({{ strtoupper($langCode) }})</label>
                                <input type="text" class="form-control" name="title[{{ $langCode }}]"
                                       value="{{ old('title.' . $langCode, $post->getTranslation('title', $langCode)) }}"
                                       {{ $loop->first ? 'required' : '' }} data-seo-field="title" data-locale="{{ $langCode }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">İçerik ({{ strtoupper($langCode) }})</label>
                                <div class="editor-container" style="min-height: 400px;" data-locale="{{ $langCode }}">
                                    {!! old('content.' . $langCode, $post->getTranslation('content', $langCode)) !!}
                                </div>
                                <input type="hidden" name="content[{{ $langCode }}]" class="editor-input" data-seo-field="content" data-locale="{{ $langCode }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kısa Özet ({{ strtoupper($langCode) }})</label>
                                <textarea class="form-control" name="excerpt[{{ $langCode }}]" rows="3">{{ old('excerpt.' . $langCode, $post->getTranslation('excerpt', $langCode)) }}</textarea>
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
                                               value="{{ old('focus_keyword.' . $langCode, $post->getTranslation('focus_keyword', $langCode)) }}"
                                               placeholder="örn: wordpress seo eklentisi" data-seo-field="focus_keyword" data-locale="{{ $langCode }}">
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
                                    <span class="serp-preview__breadcrumb"> › blog › <span id="serp-slug-preview">ornek-yazi</span></span>
                                </div>
                                <div class="serp-preview__title" id="serp-title-preview">
                                    Başlık buraya gelecek
                                </div>
                                <div class="serp-preview__description" id="serp-description-preview">
                                    Meta açıklama buraya gelecek...
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
                                               value="{{ old('seo_title.' . $langCode, $post->getTranslation('seo_title', $langCode)) }}"
                                               maxlength="70" data-seo-field="seo_title" data-locale="{{ $langCode }}">
                                        <div class="form-text">
                                            <span id="seo-title-counter-{{ $langCode }}">0</span>/70 karakter
                                            <span id="seo-title-feedback-{{ $langCode }}" class="ms-2"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Meta Açıklaması ({{ strtoupper($langCode) }})</label>
                                        <textarea class="form-control" name="meta_description[{{ $langCode }}]" rows="3" maxlength="160"
                                                  data-seo-field="meta_description" data-locale="{{ $langCode }}">{{ old('meta_description.' . $langCode, $post->getTranslation('meta_description', $langCode)) }}</textarea>
                                        <div class="form-text">
                                            <span id="meta-description-counter-{{ $langCode }}">0</span>/160 karakter
                                            <span id="meta-description-feedback-{{ $langCode }}" class="ms-2"></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label for="canonical_url" class="form-label">Canonical URL</label>
                            <input type="url" class="form-control" id="canonical_url" name="canonical_url"
                                   value="{{ old('canonical_url', $post->canonical_url ?? '') }}"
                                   placeholder="https://ornek.com/orijinal-yazi">
                            <small class="form-text text-muted">Yinelenen içerik sorununu önlemek için orijinal URL'yi belirtin.</small>
                        </div>
                    </div>

                    {{-- SOSYAL MEDYA --}}
                    <div class="tab-pane fade" id="seo-social">
                        <div class="alert alert-info">
                            <i class="icofont-info-circle"></i> Sosyal medyada paylaşıldığında nasıl görüneceğini özelleştirin.
                        </div>

                        <h6 class="mb-3">Open Graph (Facebook, LinkedIn)</h6>
                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $langCode => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                            data-bs-target="#og-{{ $langCode }}" type="button">{{ strtoupper($langCode) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-3 mb-4">
                            @foreach($activeLanguages as $langCode => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="og-{{ $langCode }}">
                                    <div class="mb-3">
                                        <label class="form-label">OG Başlık ({{ strtoupper($langCode) }})</label>
                                        <input type="text" class="form-control" name="og_title[{{ $langCode }}]"
                                               value="{{ old('og_title.' . $langCode, $post->getTranslation('og_title', $langCode)) }}"
                                               placeholder="Boş bırakılırsa SEO başlığı kullanılır">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">OG Açıklama ({{ strtoupper($langCode) }})</label>
                                        <textarea class="form-control" name="og_description[{{ $langCode }}]" rows="2"
                                                  placeholder="Boş bırakılırsa meta açıklama kullanılır">{{ old('og_description.' . $langCode, $post->getTranslation('og_description', $langCode)) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label class="form-label">OG Görseli (1200x630px önerilir)</label>
                            <input type="file" class="form-control" name="og_image" accept="image/*">
                            @if($post->og_image)
                                <div class="mt-2">
                                    <img src="{{ asset($post->og_image) }}" alt="OG Image" class="img-thumbnail" width="200">
                                </div>
                            @endif
                            <small class="form-text text-muted">Boş bırakılırsa öne çıkan görsel kullanılır.</small>
                        </div>

                        <hr>

                        <h6 class="mb-3">Twitter Card</h6>
                        <div class="mb-3">
                            <label class="form-label">Kart Tipi</label>
                            <select name="twitter_card_type" class="form-select">
                                <option value="summary" @selected(old('twitter_card_type', $post->twitter_card_type ?? 'summary_large_image') == 'summary')>Summary (Küçük Görsel)</option>
                                <option value="summary_large_image" @selected(old('twitter_card_type', $post->twitter_card_type ?? 'summary_large_image') == 'summary_large_image')>Summary Large Image (Büyük Görsel)</option>
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
                                               value="{{ old('twitter_title.' . $langCode, $post->getTranslation('twitter_title', $langCode)) }}"
                                               placeholder="Boş bırakılırsa SEO başlığı kullanılır">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Twitter Açıklama ({{ strtoupper($langCode) }})</label>
                                        <textarea class="form-control" name="twitter_description[{{ $langCode }}]" rows="2"
                                                  placeholder="Boş bırakılırsa meta açıklama kullanılır">{{ old('twitter_description.' . $langCode, $post->getTranslation('twitter_description', $langCode)) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Twitter Görseli</label>
                            <input type="file" class="form-control" name="twitter_image" accept="image/*">
                            @if($post->twitter_image)
                                <div class="mt-2">
                                    <img src="{{ asset($post->twitter_image) }}" alt="Twitter Image" class="img-thumbnail" width="200">
                                </div>
                            @endif
                            <small class="form-text text-muted">Boş bırakılırsa OG görseli kullanılır.</small>
                        </div>
                    </div>

                    {{-- YAPILANDIRILMIŞ VERİ (SCHEMA) --}}
                    <div class="tab-pane fade" id="seo-schema">
                        <div class="alert alert-info">
                            <i class="icofont-info-circle"></i> Schema.org yapılandırılmış verisi, Google'ın içeriğinizi daha iyi anlamasını sağlar.
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Schema Tipi</label>
                            <select name="schema_article_type" id="schema_article_type" class="form-select">
                                <option value="BlogPosting" @selected(old('schema_article_type', $post->schema_article_type ?? 'BlogPosting') == 'BlogPosting')>Blog Yazısı (BlogPosting)</option>
                                <option value="Article" @selected(old('schema_article_type', $post->schema_article_type) == 'Article')>Makale (Article)</option>
                                <option value="NewsArticle" @selected(old('schema_article_type', $post->schema_article_type) == 'NewsArticle')>Haber (NewsArticle)</option>
                                <option value="Product" @selected(old('schema_article_type', $post->schema_article_type) == 'Product')>Ürün (Product)</option>
                                <option value="Service" @selected(old('schema_article_type', $post->schema_article_type) == 'Service')>Hizmet (Service)</option>
                                <option value="FAQPage" @selected(old('schema_article_type', $post->schema_article_type) == 'FAQPage')>SSS Sayfası (FAQPage)</option>
                                <option value="HowTo" @selected(old('schema_article_type', $post->schema_article_type) == 'HowTo')>Nasıl Yapılır (HowTo)</option>
                                <option value="LocalBusiness" @selected(old('schema_article_type', $post->schema_article_type) == 'LocalBusiness')>Yerel İşletme (LocalBusiness)</option>
                                <option value="Person" @selected(old('schema_article_type', $post->schema_article_type) == 'Person')>Kişi (Person)</option>
                            </select>
                        </div>

                        {{-- Dinamik Schema Alanları --}}
                        <div id="schema-fields-container">
                            {{-- FAQ Schema --}}
                            <div id="schema-faq-fields" class="schema-fields" style="display: none;">
                                <h6>SSS (FAQ) Alanları</h6>
                                <div id="faq-items-container">
                                    {{-- JavaScript ile dinamik olarak eklenecek --}}
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFaqItem()">
                                    <i class="icofont-plus"></i> Soru Ekle
                                </button>
                                <input type="hidden" name="schema_faq_items" id="schema_faq_items" value="{{ old('schema_faq_items', json_encode($post->schema_faq_items ?? [])) }}">
                            </div>

                            {{-- Product Schema --}}
                            <div id="schema-product-fields" class="schema-fields" style="display: none;">
                                <h6>Ürün Bilgileri</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fiyat</label>
                                        <input type="number" step="0.01" class="form-control" name="schema_product_price"
                                               value="{{ old('schema_product_price', $post->schema_product_price) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Para Birimi</label>
                                        <select name="schema_product_currency" class="form-select">
                                            <option value="TRY" @selected(old('schema_product_currency', $post->schema_product_currency ?? 'TRY') == 'TRY')>TRY</option>
                                            <option value="USD" @selected(old('schema_product_currency', $post->schema_product_currency) == 'USD')>USD</option>
                                            <option value="EUR" @selected(old('schema_product_currency', $post->schema_product_currency) == 'EUR')>EUR</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Stok Durumu</label>
                                        <select name="schema_product_availability" class="form-select">
                                            <option value="InStock" @selected(old('schema_product_availability', $post->schema_product_availability ?? 'InStock') == 'InStock')>Stokta</option>
                                            <option value="OutOfStock" @selected(old('schema_product_availability', $post->schema_product_availability) == 'OutOfStock')>Stokta Yok</option>
                                            <option value="PreOrder" @selected(old('schema_product_availability', $post->schema_product_availability) == 'PreOrder')>Ön Sipariş</option>
                                            <option value="Discontinued" @selected(old('schema_product_availability', $post->schema_product_availability) == 'Discontinued')>Üretimi Durduruldu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Değerlendirme (1-5)</label>
                                        <input type="number" step="0.1" min="1" max="5" class="form-control" name="schema_product_rating"
                                               value="{{ old('schema_product_rating', $post->schema_product_rating) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Değerlendirme Sayısı</label>
                                        <input type="number" class="form-control" name="schema_product_review_count"
                                               value="{{ old('schema_product_review_count', $post->schema_product_review_count) }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Service Schema --}}
                            <div id="schema-service-fields" class="schema-fields" style="display: none;">
                                <h6>Hizmet Bilgileri</h6>
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
                                                <label class="form-label">Hizmet Alanı ({{ strtoupper($langCode) }})</label>
                                                <input type="text" class="form-control" name="schema_service_area[{{ $langCode }}]"
                                                       value="{{ old('schema_service_area.' . $langCode, $post->getTranslation('schema_service_area', $langCode)) }}"
                                                       placeholder="örn: İstanbul, Ankara">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Hizmet Sağlayıcı ({{ strtoupper($langCode) }})</label>
                                                <input type="text" class="form-control" name="schema_service_provider[{{ $langCode }}]"
                                                       value="{{ old('schema_service_provider.' . $langCode, $post->getTranslation('schema_service_provider', $langCode)) }}"
                                                       placeholder="örn: Next Medya">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TEKNİK / GELİŞMİŞ --}}
                    <div class="tab-pane fade" id="seo-advanced">
                        <div class="alert alert-warning">
                            <i class="icofont-warning"></i> <strong>Dikkat:</strong> Bu ayarlar sitenizin arama motorlarındaki görünürlüğünü etkiler.
                        </div>

                        <h6 class="mb-3">Meta Robots Ayarları</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="meta_noindex" id="meta_noindex" value="1"
                                            @checked(old('meta_noindex', $post->meta_noindex ?? false))>
                                    <label class="form-check-label" for="meta_noindex">
                                        <strong>No Index</strong> <small class="text-muted">(Sayfayı indexleme)</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="meta_nofollow" id="meta_nofollow" value="1"
                                            @checked(old('meta_nofollow', $post->meta_nofollow ?? false))>
                                    <label class="form-check-label" for="meta_nofollow">
                                        <strong>No Follow</strong> <small class="text-muted">(Linkleri takip etme)</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="meta_noarchive" id="meta_noarchive" value="1"
                                            @checked(old('meta_noarchive', $post->meta_noarchive ?? false))>
                                    <label class="form-check-label" for="meta_noarchive">
                                        <strong>No Archive</strong> <small class="text-muted">(Önbelleğe alma)</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="meta_nosnippet" id="meta_nosnippet" value="1"
                                            @checked(old('meta_nosnippet', $post->meta_nosnippet ?? false))>
                                    <label class="form-check-label" for="meta_nosnippet">
                                        <strong>No Snippet</strong> <small class="text-muted">(Açıklama gösterme)</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Max Snippet Uzunluğu</label>
                                <input type="number" class="form-control" name="meta_max_snippet"
                                       value="{{ old('meta_max_snippet', $post->meta_max_snippet) }}"
                                       placeholder="-1 = limitsiz">
                                <small class="form-text text-muted">Arama sonucunda gösterilecek maksimum karakter sayısı</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Max Image Preview</label>
                                <select name="meta_max_image_preview" class="form-select">
                                    <option value="none" @selected(old('meta_max_image_preview', $post->meta_max_image_preview ?? 'large') == 'none')>None</option>
                                    <option value="standard" @selected(old('meta_max_image_preview', $post->meta_max_image_preview ?? 'large') == 'standard')>Standard</option>
                                    <option value="large" @selected(old('meta_max_image_preview', $post->meta_max_image_preview ?? 'large') == 'large')>Large (Önerilen)</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <h6 class="mb-3">301 Yönlendirme</h6>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="redirect_enabled" id="redirect_enabled" value="1"
                                    @checked(old('redirect_enabled', $post->redirect_enabled ?? false))>
                            <label class="form-check-label" for="redirect_enabled">
                                <strong>Yönlendirmeyi Etkinleştir</strong>
                            </label>
                        </div>
                        <div id="redirect-fields" style="display: {{ old('redirect_enabled', $post->redirect_enabled ?? false) ? 'block' : 'none' }};">
                            <div class="mb-3">
                                <label class="form-label">Yönlendirme URL'si</label>
                                <input type="url" class="form-control" name="redirect_url"
                                       value="{{ old('redirect_url', $post->redirect_url) }}"
                                       placeholder="https://example.com/yeni-sayfa">
                                <small class="form-text text-muted">Bu sayfaya gelen ziyaretçiler belirtilen URL'ye yönlendirilir.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Yönlendirme Tipi</label>
                                <select name="redirect_type" class="form-select">
                                    <option value="301" @selected(old('redirect_type', $post->redirect_type ?? 301) == 301)>301 (Kalıcı)</option>
                                    <option value="302" @selected(old('redirect_type', $post->redirect_type) == 302)>302 (Geçici)</option>
                                    <option value="307" @selected(old('redirect_type', $post->redirect_type) == 307)>307 (Geçici - POST korunur)</option>
                                    <option value="308" @selected(old('redirect_type', $post->redirect_type) == 308)>308 (Kalıcı - POST korunur)</option>
                                </select>
                            </div>
                        </div>
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
                        <option value="published" @selected(old('status', $post->status ?? '') == 'published')>Yayınlandı</option>
                        <option value="draft" @selected(old('status', $post->status ?? 'draft') == 'draft')>Taslak</option>
                        <option value="scheduled" @selected(old('status', $post->status ?? '') == 'scheduled')>Zamanlanmış</option>
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
                    <label for="tags" class="form-label">Etiketler</label>
                    <input name="tags" class="form-control tagify-input" value="{{ old('tags', $post->tags->pluck('name')->implode(',')) }}">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">URL (Slug)</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                           value="{{ old('slug', $post->slug) }}"
                           placeholder="ornek-yazi-basligi" data-seo-field="slug">
                    <small class="form-text text-muted">Boş bırakılırsa otomatik oluşturulur</small>
                </div>
            </div>
        </div>

        {{-- Öne Çıkan Görsel Kartı --}}
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Öne Çıkan Görsel</h5>
                <input type="file" name="featured_image" id="featured_image_input" class="form-control mb-2" accept="image/*">
                <label class="form-label">Görsel Alt Metni</label>
                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                    @foreach($activeLanguages as $langCode => $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#alt-{{$langCode}}" type="button">{{ strtoupper($langCode) }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-2">
                    @foreach($activeLanguages as $langCode => $lang)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="alt-{{$langCode}}">
                            <input type="text" class="form-control" name="featured_image_alt_text[{{$langCode}}]"
                                   value="{{ old('featured_image_alt_text.' . $langCode, $post->getTranslation('featured_image_alt_text', $langCode)) }}"
                                   data-seo-field="featured_image_alt" data-locale="{{$langCode}}">
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
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="icofont-save"></i> Kaydet ve Yayınla
        </button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary btn-lg">
            <i class="icofont-close"></i> İptal
        </a>
    </div>
</div>
@push('styles')
    <style>
        /* SERP Önizlemesi */
        .serp-preview {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .serp-preview__url {
            font-size: 14px;
            line-height: 1.3;
            margin-bottom: 4px;
        }

        .serp-preview__domain {
            color: #202124;
            font-weight: 400;
        }

        .serp-preview__breadcrumb {
            color: #5f6368;
        }

        .serp-preview__title {
            font-size: 20px;
            line-height: 1.3;
            color: #1a0dab;
            margin-bottom: 4px;
            cursor: pointer;
            font-weight: 400;
        }

        .serp-preview__title:hover {
            text-decoration: underline;
        }

        .serp-preview__description {
            font-size: 14px;
            line-height: 1.58;
            color: #4d5156;
            max-width: 600px;
        }

        /* SEO Score Widget */
        .seo-score-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 320px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 1000;
            color: white;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .seo-score-widget__header {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .seo-score-widget__header h6 {
            margin: 0;
            font-size: 16px;
            color:#fff;
            font-weight: 600;
        }

        .seo-score-widget__body {
            padding: 20px;
        }

        .seo-score-circle {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
        }

        .seo-score-circle svg {
            transform: rotate(-90deg);
        }

        .seo-score-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 32px;
            font-weight: 700;
        }

        .seo-rating {
            text-align: center;
            margin-bottom: 15px;
        }

        .seo-rating .badge {
            font-size: 14px;
            padding: 8px 16px;
        }

        .seo-checks-list {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 300px;
            overflow-y: auto;
        }

        .seo-checks-list li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .seo-checks-list li:last-child {
            border-bottom: none;
        }

        .seo-check-icon {
            font-size: 16px;
        }

        /* Schema Fields */
        .schema-fields {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .faq-item {
            background: white;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
        }

        .faq-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .btn-remove-faq {
            color: #dc3545;
            cursor: pointer;
            font-size: 20px;
        }

        .btn-remove-faq:hover {
            color: #c82333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .seo-score-widget {
                width: calc(100% - 40px);
                bottom: 10px;
                right: 10px;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==========================================
            // DEĞİŞKENLER VE BAŞLANGIÇ AYARLARI
            // ==========================================
            const UPLOAD_URL = "{{ route('admin.editor.uploadImage') }}";
            const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const quillToolbarOptions = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image', 'video'],
                ['blockquote', 'code-block'],
                [{ 'align': [] }],
                ['clean']
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
                    formData.append('image', file);

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
                        }
                    } catch (error) {
                        console.error('Quill resim yükleme hatası:', error);
                    }
                };
            }

            // ==========================================
            // QUILL EDITOR KURULUMU
            // ==========================================
            const quillEditors = {};
            document.querySelectorAll('.editor-container').forEach(container => {
                const locale = container.dataset.locale;
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

                // ✅ İlk yüklemede mevcut içeriği hidden input'a aktar
                input.value = quill.root.innerHTML;

                quill.on('text-change', () => {
                    input.value = quill.root.innerHTML;
                    triggerSeoAnalysis({ target: input });
                });

                container.closest('form').addEventListener('submit', () => {
                    input.value = quill.root.innerHTML;
                });

                quillEditors[locale] = quill;
            });

            // ==========================================
            // TAGIFY KURULUMU
            // ==========================================
            document.querySelectorAll('.tagify-input').forEach(input => new Tagify(input));

            // ==========================================
            // GÖRSEL ÖNİZLEME
            // ==========================================
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

            // ==========================================
            // SCHEMA TİPİ DEĞİŞİMİ
            // ==========================================
            const schemaTypeSelect = document.getElementById('schema_article_type');
            function toggleSchemaFields() {
                document.querySelectorAll('.schema-fields').forEach(el => el.style.display = 'none');

                const selectedType = schemaTypeSelect?.value;
                if (selectedType === 'FAQPage') {
                    document.getElementById('schema-faq-fields').style.display = 'block';
                    loadFaqItems();
                } else if (selectedType === 'Product') {
                    document.getElementById('schema-product-fields').style.display = 'block';
                } else if (selectedType === 'Service') {
                    document.getElementById('schema-service-fields').style.display = 'block';
                }
            }

            if (schemaTypeSelect) {
                toggleSchemaFields();
                schemaTypeSelect.addEventListener('change', toggleSchemaFields);
            }

            // ==========================================
            // FAQ İTEMLER YÖNETİMİ
            // ==========================================
            let faqItemIndex = 0;

            window.addFaqItem = function() {
                faqItemIndex++;
                const container = document.getElementById('faq-items-container');
                const itemHtml = `
                    <div class="faq-item" data-faq-index="${faqItemIndex}">
                        <div class="faq-item-header">
                            <strong>Soru ${faqItemIndex}</strong>
                            <span class="btn-remove-faq" onclick="removeFaqItem(${faqItemIndex})">&times;</span>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Soru</label>
                            <input type="text" class="form-control faq-question" placeholder="Soruyu yazın...">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Cevap</label>
                            <textarea class="form-control faq-answer" rows="3" placeholder="Cevabı yazın..."></textarea>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', itemHtml);
            };

            window.removeFaqItem = function(index) {
                const item = document.querySelector(`.faq-item[data-faq-index="${index}"]`);
                if (item) item.remove();
                saveFaqItems();
            };

            function loadFaqItems() {
                const faqData = document.getElementById('schema_faq_items')?.value;
                if (!faqData || faqData === '[]') return;

                const items = JSON.parse(faqData);
                items.forEach((item, idx) => {
                    addFaqItem();
                    const faqItem = document.querySelector(`.faq-item[data-faq-index="${idx + 1}"]`);
                    if (faqItem) {
                        faqItem.querySelector('.faq-question').value = item.question || '';
                        faqItem.querySelector('.faq-answer').value = item.answer || '';
                    }
                });
            }

            function saveFaqItems() {
                const items = [];
                document.querySelectorAll('.faq-item').forEach(item => {
                    const question = item.querySelector('.faq-question').value;
                    const answer = item.querySelector('.faq-answer').value;
                    if (question && answer) {
                        items.push({ question, answer });
                    }
                });
                document.getElementById('schema_faq_items').value = JSON.stringify(items);
            }

            document.querySelector('form').addEventListener('submit', function() {
                const faqFields = document.getElementById('schema-faq-fields');
                if (faqFields && faqFields.style.display !== 'none') {
                    saveFaqItems();
                }
            });

            // ==========================================
            // YÖNLENDİRME CHECKBOX
            // ==========================================
            const redirectCheckbox = document.getElementById('redirect_enabled');
            const redirectFields = document.getElementById('redirect-fields');
            if (redirectCheckbox) {
                redirectCheckbox.addEventListener('change', function() {
                    redirectFields.style.display = this.checked ? 'block' : 'none';
                });
            }

            // ==========================================
            // GOOGLE SERP ÖNİZLEMESİ
            // ==========================================
            function updateSerpPreview() {
                const currentLocale = document.querySelector('.nav-link.active[data-bs-target*="seo-"]')?.dataset.bsTarget?.replace('#seo-', '').replace('#focus-', '') || '{{ $activeLanguages->keys()->first() ?? 'tr' }}';

                const title = document.querySelector(`input[name="seo_title[${currentLocale}]"]`)?.value ||
                    document.querySelector(`input[name="title[${currentLocale}]"]`)?.value ||
                    'Başlık buraya gelecek';

                const description = document.querySelector(`textarea[name="meta_description[${currentLocale}]"]`)?.value ||
                    'Meta açıklama buraya gelecek...';

                const slug = document.getElementById('slug')?.value || 'ornek-yazi';

                document.getElementById('serp-title-preview').textContent = title.length > 60 ? title.substring(0, 60) + '...' : title;
                document.getElementById('serp-description-preview').textContent = description.length > 155 ? description.substring(0, 155) + '...' : description;
                document.getElementById('serp-slug-preview').textContent = slug;
            }

            ['seo_title', 'title', 'meta_description', 'slug'].forEach(fieldName => {
                document.querySelectorAll(`[name*="${fieldName}"]`).forEach(field => {
                    field.addEventListener('input', updateSerpPreview);
                });
            });

            updateSerpPreview();

            // ==========================================
            // CANLI SEO ANALİZİ
            // ==========================================
            let seoAnalysisTimeout;

            function triggerSeoAnalysis(event) {
                clearTimeout(seoAnalysisTimeout);
                const target = event?.target;
                seoAnalysisTimeout = setTimeout(() => runSeoAnalysis(target), 1000);
            }

            async function runSeoAnalysis(targetElement) {
                let currentLocale;

                if (targetElement && targetElement.dataset && targetElement.dataset.locale) {
                    currentLocale = targetElement.dataset.locale;
                } else {
                    // ✅ DÜZELTİLDİ: Collection için doğru syntax
                    currentLocale = '{{ $activeLanguages->keys()->first() ?? 'tr' }}';
                }

                const formData = {
                    locale: currentLocale,
                    focus_keyword: document.querySelector(`input[name="focus_keyword[${currentLocale}]"]`)?.value || '',
                    title: document.querySelector(`input[name="title[${currentLocale}]"]`)?.value || '',
                    seo_title: document.querySelector(`input[name="seo_title[${currentLocale}]"]`)?.value || '',
                    meta_description: document.querySelector(`textarea[name="meta_description[${currentLocale}]"]`)?.value || '',
                    content: document.querySelector(`.editor-input[data-locale="${currentLocale}"]`)?.value || '',
                    slug: document.getElementById('slug')?.value || '',
                    featured_image_alt: document.querySelector(`input[name="featured_image_alt_text[${currentLocale}]"]`)?.value || ''
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
                field.addEventListener('input', (event) => triggerSeoAnalysis(event));
                field.addEventListener('change', (event) => triggerSeoAnalysis(event));
            });

            // ⚡ KRİTİK: Quill editörleri yüklendikten sonra ilk analizi çalıştır
            setTimeout(() => {
                // İlk yüklemede tüm Quill editörlerin içeriğini hidden input'lara aktar
                Object.keys(quillEditors).forEach(locale => {
                    const quill = quillEditors[locale];
                    const input = document.querySelector(`.editor-input[data-locale="${locale}"]`);
                    if (input) {
                        input.value = quill.root.innerHTML;
                    }
                });

                // Şimdi analizi çalıştır
                runSeoAnalysis();
            }, 1500);

            // ==========================================
            // KARAKTER SAYAÇLARI
            // ==========================================
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