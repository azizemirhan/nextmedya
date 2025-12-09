@if ($errors->any())
    <div class="alert alert-danger mx-3 my-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row layout-spacing">

    {{-- SOL KOLON: Slider Görseli ve Önizleme --}}
    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
        <div class="user-profile">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Slider Görseli</h3>
                </div>
                <div class="text-center user-info">
                    {{-- Düzenleme modunda mevcut resmi göster --}}
                    @isset($slider)
                        <img id="image-preview" src="{{ Storage::url($slider->image_path) }}" alt="logo"
                             style="display:block; max-width:100%; border-radius:8px;">
                    @else
                        <img id="image-preview" src="#" alt="logo"
                             style="display:none; max-width:100%; border-radius:8px;">
                    @endisset
                    <p class="mt-2 text-muted small">Görsel önizleme (Önerilen boyut: 1920x800px)</p>
                </div>
                <div class="user-info-list">
                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="contacts-block__item">
                                <label class="form-label mb-1">Görsel Yükle <span class="text-danger">*</span></label>
                                {{-- Düzenleme modunda resim zorunlu değil --}}
                                <input type="file" name="image" id="image-input" class="form-control"
                                       accept="image/*" {{ !isset($slider) ? 'required' : '' }}>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SAĞ KOLON: Slider Detayları --}}
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
        <div class="widget-content widget-content-area">
            <h3 class="">Slider Detayları</h3>

            {{-- Dil Sekmeleri (Tabs) --}}
            <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                @foreach($activeLanguages as $code => $language)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#lang-content-{{ $code }}" type="button">
                            {{ $language['native'] }} ({{ strtoupper($code) }})
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-4" id="myTabContent">
                @foreach($activeLanguages as $code => $language)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-content-{{ $code }}" role="tabpanel">

                        <div class="mb-3">
                            <label class="form-label">Başlık @if($loop->first)<span class="text-danger">*</span>@endif</label>
                            <input type="text" name="title[{{ $code }}]" class="form-control"
                                   @if($loop->first) required @endif
                                   value="{{ old('title.'.$code, $slider->getTranslation('title', $code)) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alt Başlık</label>
                            <textarea name="subtitle[{{ $code }}]" class="form-control"
                                      rows="3">{{ old('subtitle.'.$code, $slider->getTranslation('subtitle', $code)) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Buton Yazısı</label>
                            <input type="text" name="button_text[{{ $code }}]" class="form-control"
                                   value="{{ old('button_text.'.$code, $slider->getTranslation('button_text', $code)) }}">
                        </div>

                    </div>
                @endforeach
            </div>

            <hr>

            {{-- Genel Ayarlar --}}
            <div class="row mt-4">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Buton Linki</label>
                    <input type="url" name="button_url" class="form-control" placeholder="https://..."
                           value="{{ old('button_url', $slider->button_url ?? '') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Sıralama <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control" required
                           value="{{ old('order', $slider->order ?? 0) }}">
                </div>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActiveSwitch"
                            @checked(old('is_active', $slider->is_active ?? true))>
                        <label class="form-check-label" for="isActiveSwitch">Aktif</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Görsel önizleme script'i
            const imageInput = document.getElementById('image-input');
            const imagePreview = document.getElementById('image-preview');

            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
        });
    </script>
@endpush
