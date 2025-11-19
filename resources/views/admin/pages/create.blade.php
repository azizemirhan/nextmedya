@extends('admin.layouts.master')

@section('title', 'Yeni Sayfa Oluştur')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0 text-gray-800">Yeni Sayfa Oluştur</h1>
                <div>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Vazgeç</a>
                    <button type="submit" class="btn btn-primary">Kaydet ve Devam Et</button>
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

            <div class="card">
                <div class="card-body">
                    @php
                        // Setting modelinde value array olarak cast edildiği için direkt kullan
                        $activeLanguagesArray = setting('active_languages', ['tr', 'en']);

                        // Eğer string gelirse array'e çevir (geriye dönük uyumluluk için)
                        if (is_string($activeLanguagesArray)) {
                            $activeLanguagesArray = json_decode($activeLanguagesArray, true) ?? ['tr', 'en'];
                        }

                        $allLanguages = config('languages.supported', []);

                        $activeLanguages = collect($allLanguages)
                            ->filter(fn($lang, $code) => in_array($code, $activeLanguagesArray))
                            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguagesArray));
                    @endphp

                    {{-- Sayfa Başlığı (Çok Dilli Tab Sistemi) --}}
                    <div class="mb-3">
                        <label class="form-label">Sayfa Başlığı <span class="text-danger">*</span></label>
                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $code => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#create-title-{{ $code }}"
                                            type="button">{{ strtoupper($code) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-2">
                            @foreach($activeLanguages as $code => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="create-title-{{ $code }}"
                                     role="tabpanel">
                                    <input type="text"
                                           name="title[{{ $code }}]"
                                           class="form-control"
                                           placeholder="{{ $lang['native'] }} Başlık"
                                           value="{{ old('title.'.$code) }}"
                                        {{ $loop->first ? 'required' : '' }}>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <h5 class="mb-3">Sayfa Banner Ayarları</h5>

                    {{-- Banner Başlığı (Çok Dilli Tab Sistemi) --}}
                    <div class="mb-3">
                        <label class="form-label">Banner Başlığı</label>
                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $code => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#create-banner-title-{{ $code }}"
                                            type="button">{{ strtoupper($code) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-2">
                            @foreach($activeLanguages as $code => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="create-banner-title-{{ $code }}"
                                     role="tabpanel">
                                    <input type="text"
                                           name="banner_title[{{ $code }}]"
                                           class="form-control"
                                           placeholder="Banner'da görünecek {{ $lang['native'] }} başlık"
                                           value="{{ old('banner_title.'.$code) }}">
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Bu alanı boş bırakırsanız, sayfa başlığı kullanılır.</small>
                    </div>

                    {{-- Banner Alt Başlığı (Çok Dilli Tab Sistemi) --}}
                    <div class="mb-3">
                        <label class="form-label">Banner Alt Başlığı</label>
                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $code => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#create-banner-subtitle-{{ $code }}"
                                            type="button">{{ strtoupper($code) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-2">
                            @foreach($activeLanguages as $code => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="create-banner-subtitle-{{ $code }}"
                                     role="tabpanel">
                                    <input type="text"
                                           name="banner_subtitle[{{ $code }}]"
                                           class="form-control"
                                           placeholder="Banner'da görünecek {{ $lang['native'] }} alt başlık"
                                           value="{{ old('banner_subtitle.'.$code) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Mevcut banner alanlarından sonra, slug'dan önce --}}

                    {{-- Sayfa Durumu --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Sayfa Durumu</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft" @selected(old('status') == 'draft' || old('status') === null)>Taslak</option>
                            <option value="published" @selected(old('status') == 'published')>Yayınlandı</option>
                        </select>
                    </div>

                    {{-- SEO Alanları için Accordion --}}
                    <div class="accordion mb-3" id="seoAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeo">
                                    SEO Ayarları (İsteğe bağlı)
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
                                                           value="{{ old('seo_title.'.$code) }}">
                                                @endforeach
                                                <small class="text-muted">Boş bırakırsanız sayfa başlığı kullanılır</small>
                                            </div>

                                            {{-- Meta Açıklaması --}}
                                            <div class="mb-3">
                                                <label class="form-label">Meta Açıklaması</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <textarea name="meta_description[{{ $code }}]"
                                                              class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                              rows="3"
                                                              placeholder="{{ $lang['native'] }} Meta Açıklaması">{{ old('meta_description.'.$code) }}</textarea>
                                                @endforeach
                                                <small class="text-muted">Arama sonuçlarında görünecek açıklama (160 karakter)</small>
                                            </div>

                                            {{-- Anahtar Kelimeler --}}
                                            <div class="mb-3">
                                                <label class="form-label">Anahtar Kelimeler</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <input type="text" name="keywords[{{ $code }}]"
                                                           class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                           placeholder="{{ $lang['native'] }} Anahtar Kelimeler (virgülle ayırın)"
                                                           value="{{ old('keywords.'.$code) }}">
                                                @endforeach
                                            </div>

                                            {{-- Odak Anahtar Kelime --}}
                                            <div class="mb-3">
                                                <label class="form-label">Odak Anahtar Kelime</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <input type="text" name="focus_keyword[{{ $code }}]"
                                                           class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                           placeholder="{{ $lang['native'] }} Ana Anahtar Kelime"
                                                           value="{{ old('focus_keyword.'.$code) }}">
                                                @endforeach
                                                <small class="text-muted">SEO analizinde kullanılacak ana anahtar kelime</small>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            {{-- Arama Motoru Ayarları --}}
                                            <div class="mb-3">
                                                <label for="index_status" class="form-label">Arama Motoru Görünürlüğü</label>
                                                <select name="index_status" id="index_status" class="form-select">
                                                    <option value="index" @selected(old('index_status') == 'index' || old('index_status') === null)>Sayfa indexlensin</option>
                                                    <option value="noindex" @selected(old('index_status') == 'noindex')>Sayfa indexlenmesin</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="follow_status" class="form-label">Link Takibi</label>
                                                <select name="follow_status" id="follow_status" class="form-select">
                                                    <option value="follow" @selected(old('follow_status') == 'follow' || old('follow_status') === null)>Sayfadaki linkler takip edilsin</option>
                                                    <option value="nofollow" @selected(old('follow_status') == 'nofollow')>Sayfadaki linkler takip edilmesin</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="canonical_url" class="form-label">Canonical URL</label>
                                                <input type="url" name="canonical_url" id="canonical_url" class="form-control"
                                                       placeholder="https://..." value="{{ old('canonical_url') }}">
                                                <small class="text-muted">Bu sayfanın kopya olduğu orijinal sayfanın linki</small>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Sosyal Medya Ayarları --}}
                                    <hr><h6 class="mt-4">Sosyal Medya Paylaşım Ayarları</h6>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            {{-- Open Graph --}}
                                            <h6>Facebook (Open Graph)</h6>
                                            <div class="mb-3">
                                                <label class="form-label">OG Başlık</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <input type="text" name="og_title[{{ $code }}]"
                                                           class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                           placeholder="Facebook'ta görünecek {{ $lang['native'] }} başlık"
                                                           value="{{ old('og_title.'.$code) }}">
                                                @endforeach
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">OG Açıklama</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <textarea name="og_description[{{ $code }}]"
                                                              class="form-control {{ !$loop->first ? 'mt-2' : '' }}" rows="2"
                                                              placeholder="{{ $lang['native'] }} OG Açıklaması">{{ old('og_description.'.$code) }}</textarea>
                                                @endforeach
                                            </div>
                                            <div class="mb-3">
                                                <label for="og_image" class="form-label">OG Resim</label>
                                                <input type="file" name="og_image" id="og_image" class="form-control" accept="image/*">
                                                <small class="text-muted">Facebook paylaşımlarında görünecek resim</small>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            {{-- Twitter Card --}}
                                            <h6>Twitter</h6>
                                            <div class="mb-3">
                                                <label for="twitter_card_type" class="form-label">Twitter Card Tipi</label>
                                                <select name="twitter_card_type" id="twitter_card_type" class="form-select">
                                                    <option value="">Varsayılan</option>
                                                    <option value="summary" @selected(old('twitter_card_type') == 'summary')>Summary</option>
                                                    <option value="summary_large_image" @selected(old('twitter_card_type') == 'summary_large_image')>Summary Large Image</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Twitter Başlık</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <input type="text" name="twitter_title[{{ $code }}]"
                                                           class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                           placeholder="Twitter'da görünecek {{ $lang['native'] }} başlık"
                                                           value="{{ old('twitter_title.'.$code) }}">
                                                @endforeach
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Twitter Açıklama</label>
                                                @foreach($activeLanguages as $code => $lang)
                                                    <textarea name="twitter_description[{{ $code }}]"
                                                              class="form-control {{ !$loop->first ? 'mt-2' : '' }}" rows="2"
                                                              placeholder="{{ $lang['native'] }} Twitter Açıklaması">{{ old('twitter_description.'.$code) }}</textarea>
                                                @endforeach
                                            </div>
                                            <div class="mb-3">
                                                <label for="twitter_image" class="form-label">Twitter Resim</label>
                                                <input type="file" name="twitter_image" id="twitter_image" class="form-control" accept="image/*">
                                                <small class="text-muted">Twitter paylaşımlarında görünecek resim</small>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Gelişmiş Ayarlar --}}
                                    <hr><h6 class="mt-4">Gelişmiş Ayarlar</h6>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="meta_noindex" id="meta_noindex" value="1" @checked(old('meta_noindex'))>
                                                    <label class="form-check-label" for="meta_noindex">Meta Noindex</label>
                                                </div>
                                                <small class="text-muted">Arama motorlarında görünmesin</small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="meta_nofollow" id="meta_nofollow" value="1" @checked(old('meta_nofollow'))>
                                                    <label class="form-check-label" for="meta_nofollow">Meta Nofollow</label>
                                                </div>
                                                <small class="text-muted">Sayfadaki linkler takip edilmesin</small>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="redirect_enabled" id="redirect_enabled" value="1" @checked(old('redirect_enabled'))>
                                                    <label class="form-check-label" for="redirect_enabled">Yönlendirme Aktif</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="redirect_url" class="form-label">Yönlendirme URL'i</label>
                                                <input type="url" name="redirect_url" id="redirect_url" class="form-control"
                                                       value="{{ old('redirect_url') }}" placeholder="https://...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- URL Uzantısı (Slug) --}}
                    <div class="mb-3">
                        <label for="slug" class="form-label">URL Uzantısı (Slug) <span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="slug" class="form-control"
                               value="{{ old('slug') }}"
                               placeholder="ornek-sayfa-url"
                               required>
                        <small class="text-muted">Örn: hakkimizda, kurumsal, iletisim</small>
                    </div>

                    {{-- Şablon Seçimi --}}
                    <div class="mb-3">
                        <label for="template" class="form-label">Başlangıç Şablonu (İsteğe bağlı)</label>
                        <select name="template" id="template" class="form-select">
                            <option value="">Boş Sayfa Olarak Başla</option>
                            @foreach($templates as $key => $template)
                                <option value="{{ $key }}" @selected(old('template') == $key)>
                                    {{ $template['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Bir şablon seçerseniz, sayfanız seçili bölümler eklenmiş olarak başlar.</small>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Otomatik slug oluşturma
        document.addEventListener('DOMContentLoaded', function() {
            // Türkçe karakterleri değiştir
            function turkishToEnglish(text) {
                const charMap = {
                    'ç': 'c', 'ğ': 'g', 'ı': 'i', 'ö': 'o', 'ş': 's', 'ü': 'u',
                    'Ç': 'C', 'Ğ': 'G', 'İ': 'I', 'Ö': 'O', 'Ş': 'S', 'Ü': 'U'
                };

                return text.replace(/[çğıöşüÇĞİÖŞÜ]/g, match => charMap[match]);
            }

            // İlk dil inputunu al (genelde TR)
            const firstTitleInput = document.querySelector('input[name^="title["]');
            const slugInput = document.getElementById('slug');

            if (firstTitleInput && slugInput) {
                firstTitleInput.addEventListener('input', function() {
                    if (!slugInput.value || slugInput.dataset.manual !== 'true') {
                        const slug = turkishToEnglish(this.value)
                            .toLowerCase()
                            .replace(/[^a-z0-9]+/g, '-')
                            .replace(/^-+|-+$/g, '');
                        slugInput.value = slug;
                    }
                });

                // Manuel değiştirildiğini işaretle
                slugInput.addEventListener('input', function() {
                    this.dataset.manual = 'true';
                });
            }
        });
    </script>
@endpush
