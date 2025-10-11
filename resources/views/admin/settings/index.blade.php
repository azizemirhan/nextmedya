@extends('admin.layouts.master')

@section('title', 'Site Ayarları')

@section('content')
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                {{-- SOL KOLON: Metin İçerikleri --}}
                <div class="col-12 col-lg-8">
                    {{-- HEADER & FOOTER METİNLERİ --}}
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Header & Footer Metinleri</h5></div>
                        <div class="card-body">

                            {{-- DİNAMİK DİL SEKMELERİ --}}
                            <ul class="nav nav-tabs" id="langTab" role="tablist">
                                @foreach($activeLanguages as $code => $language)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                                data-bs-target="#tab-content-{{ $code }}" type="button">
                                            {{ $language['native'] }} ({{ strtoupper($code) }})
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- DİNAMİK SEKME İÇERİKLERİ --}}
                            <div class="tab-content mt-4" id="langTabContent">
                                @foreach($activeLanguages as $code => $language)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                         id="tab-content-{{ $code }}" role="tabpanel">

                                        <div class="mb-3">
                                            <label class="form-label">Header Buton Yazısı ({{ strtoupper($code) }}
                                                )</label>
                                            <input type="text" name="header_cta_text[{{$code}}]" class="form-control"
                                                   value="{{ old('header_cta_text.'.$code, $settings['header_cta_text']->value[$code] ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Footer İletişim Metni ({{ strtoupper($code) }}
                                                )</label>
                                            <input type="text" name="footer_contact_text[{{$code}}]"
                                                   class="form-control"
                                                   value="{{ old('footer_contact_text.'.$code, $settings['footer_contact_text']->value[$code] ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Footer Bilgi Alanı ({{ strtoupper($code) }}
                                                )</label>
                                            <textarea name="footer_info_text[{{$code}}]" class="form-control"
                                                      rows="3">{{ old('footer_info_text.'.$code, $settings['footer_info_text']->value[$code] ?? '') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Bülten Başlığı ({{ strtoupper($code) }})</label>
                                            <input type="text" name="newsletter_title[{{$code}}]" class="form-control"
                                                   value="{{ old('newsletter_title.'.$code, $settings['newsletter_title']->value[$code] ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Bülten Alt Başlığı ({{ strtoupper($code) }}
                                                )</label>
                                            <textarea name="newsletter_subtitle[{{$code}}]" class="form-control"
                                                      rows="2">{{ old('newsletter_subtitle.'.$code, $settings['newsletter_subtitle']->value[$code] ?? '') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Copyright Metni ({{ strtoupper($code) }})</label>
                                            <input type="text" name="copyright_text[{{$code}}]" class="form-control"
                                                   value="{{ old('copyright_text.'.$code, $settings['copyright_text']->value[$code] ?? '') }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- İLETİŞİM & SOSYAL MEDYA --}}
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">İletişim & Sosyal Medya Linkleri</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Footer Telefon</label>
                                    <input type="text" name="footer_contact_phone" class="form-control"
                                           value="{{ $settings['footer_contact_phone']->value ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Genel E-posta Adresi</label>
                                    <input type="email" name="contact_email" class="form-control"
                                           value="{{ $settings['contact_email']->value ?? '' }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Adres</label>
                                    <textarea name="contact_address" class="form-control"
                                              rows="2">{{ $settings['contact_address']->value ?? '' }}</textarea>
                                </div>
                                <hr class="my-2">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Facebook URL</label>
                                    <input type="url" name="social_facebook" class="form-control"
                                           value="{{ $settings['social_facebook']->value ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Twitter URL</label>
                                    <input type="url" name="social_twitter" class="form-control"
                                           value="{{ $settings['social_twitter']->value ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Instagram URL</label>
                                    <input type="url" name="social_instagram" class="form-control"
                                           value="{{ $settings['social_instagram']->value ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">LinkedIn URL</label>
                                    <input type="url" name="social_linkedin" class="form-control"
                                           value="{{ $settings['social_linkedin']->value ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SOL KOLONDA, "İletişim & Sosyal Medya" kartından sonra ekleyin --}}
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">SEO & Harici Servis Kodları</h5></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Google Search Console Onay Kodu</label>
                                <input type="text" name="google_site_verification" class="form-control"
                                       value="{{ $settings['google_site_verification']->value ?? '' }}"
                                       placeholder="<meta name='google-site-verification' content='...'> kodundaki content değeri">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bing Webmaster Tools Onay Kodu</label>
                                <input type="text" name="bing_site_verification" class="form-control"
                                       value="{{ $settings['bing_site_verification']->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Yandex Webmaster Onay Kodu</label>
                                <input type="text" name="yandex_site_verification" class="form-control"
                                       value="{{ $settings['yandex_site_verification']->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Google Analytics ID</label>
                                <input type="text" name="google_analytics_id" class="form-control"
                                       value="{{ $settings['google_analytics_id']->value ?? '' }}" placeholder="G-XXXXXXXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Genel Ayarlar</h5></div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="maintenance_mode_switch"
                                       name="maintenance_mode" value="on"
                                    @checked(isset($settings['maintenance_mode']) && $settings['maintenance_mode']->value === 'on')>
                                <label class="form-check-label" for="maintenance_mode_switch">Site Bakım Modu</label>
                            </div>
                            <small class="text-muted">Aktif edildiğinde, yönetici girişi yapmamış olan tüm ziyaretçiler "Bakımdayız" sayfasını görür.</small>
                        </div>
                    </div>
                    {{-- SAĞ KOLONDA, "Genel Ayarlar" kartından sonra ekleyin --}}
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Site Renk Ayarları</h5></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="primary_color" class="form-label">Ana Tema Rengi</label>
                                <input type="color" class="form-control form-control-color" id="primary_color"
                                       name="primary_color"
                                       value="{{ $settings['primary_color']->value ?? '#ffee02' }}">
                            </div>
                            <div class="mb-3">
                                <label for="primary_color_light" class="form-label">Açık Tema Rengi</label>
                                <input type="color" class="form-control form-control-color" id="primary_color_light"
                                       name="primary_color_light"
                                       value="{{ $settings['primary_color_light']->value ?? '#fffab3' }}">
                            </div>
                            <small class="text-muted">Burada yaptığınız değişiklikler sitenin genelindeki sarı tonlarını etkileyecektir.</small>
                        </div>
                    </div>
                    {{-- Dil Ayarları Formu --}}

                    {{-- Dil Ayarları Formu --}}

                </div>

                {{-- SAĞ KOLON: Görsel ve Buton --}}
                <div class="col-12 col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Görsel Ayarları</h5></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="logo_input" class="form-label">Header Logo</label>
                                <input type="file" name="site_logo" id="logo_input" class="form-control"
                                       accept="image/*">
                                <div class="mt-2">
                                    <img id="logo_preview"
                                         src="{{ isset($settings['site_logo']->value) ? asset($settings['site_logo']->value) : 'https://placehold.co/600x400' }}"
                                         alt="Logo Önizleme" class="img-thumbnail"
                                         style="max-height: 60px; {{ !isset($settings['site_logo']->value) ? 'display:none;' : '' }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="footer_logo_input" class="form-label">Footer Logo</label>
                                <input type="file" name="footer_logo" id="footer_logo_input" class="form-control"
                                       accept="image/*">
                                <div class="mt-2">
                                    <img id="footer_logo_preview"
                                         src="{{ isset($settings['footer_logo']->value) ? asset($settings['footer_logo']->value) : 'https://placehold.co/600x400' }}"
                                         alt="Footer Logo Önizleme" class="img-thumbnail"
                                         style="max-height: 60px; {{ !isset($settings['footer_logo']->value) ? 'display:none;' : '' }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="favicon_input" class="form-label">Favicon</label>
                                <input type="file" name="site_favicon" id="favicon_input" class="form-control"
                                       accept="image/x-icon, image/png, image/svg+xml">
                                <div class="mt-2">
                                    <img id="favicon_preview"
                                         src="{{ isset($settings['site_favicon']->value) ? asset($settings['site_favicon']->value) : 'https://placehold.co/600x400' }}"
                                         alt="Favicon Önizleme" class="img-thumbnail"
                                         style="max-height: 48px; {{ !isset($settings['site_favicon']->value) ? 'display:none;' : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Araçlar</h5></div>
                        <div class="card-body">
                            <a href="{{ route('admin.settings.generateSitemap') }}" class="btn btn-info w-100">
                                <i class="bi bi-diagram-3-fill me-2"></i> Sitemap.xml Oluştur/Güncelle
                            </a>
                            <small class="text-muted d-block mt-2">Sitenize yeni bir sayfa, hizmet veya blog yazısı ekledikten sonra arama motorlarına bildirmek için bu butonu kullanın.</small>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Ayarları Kaydet</button>
                    </div>
                </div>
            </div>
        </form>
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Dil Ayarları</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.languages.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="active_languages" class="form-label">Sitede Aktif Olacak Diller</label>
                            <p class="form-text">İçerik gireceğiniz ve sitede görünecek dilleri seçin.</p>
                            <select name="active_languages[]" id="active_languages" class="form-control"
                                    multiple required>
                                @php
                                    // config/languages.php dosyasından tüm olası dilleri al
                                    $allSupportedLanguages = config('languages.supported', []);

                                    // Controller'dan gelen ve şu an aktif olan dillerin kodlarını al
                                    // $activeLanguages değişkeni SettingController@index metodundan geliyor
                                    $currentActiveLanguageCodes = array_keys($activeLanguages);
                                @endphp

                                @foreach($allSupportedLanguages as $code => $lang)
                                    <option
                                        value="{{ $code }}" @selected(in_array($code, $currentActiveLanguageCodes))>
                                        {{ $lang['native'] }} ({{ strtoupper($code) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Dil Ayarlarını Kaydet</button>
                    </form>
                </div>
            </div>
    </div>
@endsection
@push('styles')
    {{-- TomSelect veya benzeri bir kütüphane kullanıyorsanız CSS dosyalarını ekleyin --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect("#active_languages", {
                plugins: ['remove_button'],
                persist: false,
                create: false
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('active_languages')) {
                new TomSelect("#active_languages", {
                    plugins: ['remove_button'],
                    persist: false,
                    create: false
                });
            }

            function setupImagePreview(inputId, previewId) {
                const inputElement = document.getElementById(inputId);
                const previewElement = document.getElementById(previewId);
                if (inputElement && previewElement) {
                    inputElement.addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                previewElement.src = e.target.result;
                                previewElement.style.display = 'block';
                            }
                            reader.readAsDataURL(file);
                        }
                    });
                }
            }

            setupImagePreview('logo_input', 'logo_preview');
            setupImagePreview('footer_logo_input', 'footer_logo_preview');
            setupImagePreview('favicon_input', 'favicon_preview');
        });
    </script>

@endpush
