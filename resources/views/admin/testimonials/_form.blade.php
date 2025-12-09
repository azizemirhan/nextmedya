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
    {{-- SOL KOLON --}}
    <div class="col-12 col-lg-8">
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Müşteri Görüşü</h5>
            </div>
            <div class="card-body">
                {{-- Dil sekmeleri --}}
                <ul class="nav nav-tabs" id="langTab" role="tablist">
                    @foreach($activeLanguages as $code => $language)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#lang-content-{{ $code }}" type="button">
                                {{ $language['native'] }} ({{ strtoupper($code) }})
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-4" id="langTabContent">
                    @foreach($activeLanguages as $code => $language)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-content-{{ $code }}"
                             role="tabpanel">

                            <div class="mb-3">
                                <label class="form-label">İsim ({{ strtoupper($code) }}) @if($loop->first)
                                        <span class="text-danger">*</span>
                                    @endif</label>
                                <input type="text" name="name[{{ $code }}]" class="form-control"
                                       value="{{ old('name.'.$code, $testimonial->getTranslation('name', $code)) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ünvan/Şirket ({{ strtoupper($code) }})</label>
                                <input type="text" name="company[{{ $code }}]" class="form-control"
                                       value="{{ old('company.'.$code, $testimonial->getTranslation('company', $code)) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Yorum ({{ strtoupper($code) }}) @if($loop->first)
                                        <span class="text-danger">*</span>
                                    @endif</label>
                                <textarea name="content[{{ $code }}]" class="form-control"
                                          rows="4">{{ old('content.'.$code, $testimonial->getTranslation('content', $code)) }}</textarea>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- SAĞ KOLON --}}
    <div class="col-12 col-lg-4">
        <div class="card mb-3">
            <div class="card-header"><h5 class="mb-0">Yayın</h5></div>
            <div class="card-body">
                {{-- Avatar --}}
                <div class="mb-3">
                    <label class="form-label">Avatar (Görsel) <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if(isset($testimonial->image_path))
                        <img src="{{ asset($testimonial->image_path) }}" alt="" class="img-fluid mt-2" style="max-width:120px;border-radius:50%;object-fit:cover;">
                    @endif
                </div>

                {{-- Sıralama --}}
                <div class="mb-3">
                    <label class="form-label">Sıralama <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $testimonial->order ?? 0) }}">
                </div>

                {{-- Durum --}}
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active"
                           value="1" @checked(old('is_active', $testimonial->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">Listeye Dön</a>
        </div>
    </div>
</div>
