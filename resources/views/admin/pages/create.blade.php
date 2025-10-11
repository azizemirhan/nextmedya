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
