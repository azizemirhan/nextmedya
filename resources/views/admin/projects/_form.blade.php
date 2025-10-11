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
                <h5 class="mb-0">İçerik</h5>
            </div>
            <div class="card-body">
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
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-content-{{ $code }}" role="tabpanel">

                            <div class="mb-3">
                                <label class="form-label">Başlık @if($loop->first)<span class="text-danger">*</span>@endif</label>
                                <input type="text" name="title[{{ $code }}]" class="form-control"
                                       value="{{ old('title.'.$code, $project->getTranslation('title', $code)) }}"
                                       placeholder="Proje başlığı">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Açıklama</label>
                                <textarea name="description[{{ $code }}]" class="form-control" rows="6"
                                          placeholder="Proje detayları...">{{ old('description.'.$code, $project->getTranslation('description', $code)) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konum</label>
                                <input type="text" name="location[{{ $code }}]" class="form-control"
                                       value="{{ old('location.'.$code, $project->getTranslation('location', $code)) }}"
                                       placeholder="Bornova, İzmir">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tamamlanma Tarihi</label>
                        <input type="date" name="completion_date" class="form-control"
                               value="{{ old('completion_date', optional($project->completion_date)->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                               value="{{ old('slug', $project->slug) }}" placeholder="otomatik üretilecek">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SAĞ KOLON --}}
    <div class="col-12 col-lg-4">
        <div class="card mb-3">
            <div class="card-header"><h5 class="mb-0">Yayın</h5></div>
            <div class="card-body">
                {{-- Görsel --}}
                <div class="mb-3">
                    <label class="form-label">Görsel <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if(isset($project->image_path))
                        <img src="{{ asset('storage/'.$project->image_path) }}" alt="" class="img-fluid mt-2"
                             style="max-width:200px;">
                    @endif
                </div>

                {{-- Durum --}}
                <div class="mb-3">
                    <label class="form-label">Durum</label>
                    <select name="status" class="form-select">
                        <option value="0" @selected(old('status', $project->status) === 0)>Devam Ediyor</option>
                        <option
                            value="1" @selected(old('status', $project->status) === 1 || old('status', $project->status) === '1')>
                            Tamamlandı
                        </option>
                    </select>
                </div>

                {{-- Öne çıkar --}}
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured"
                           value="1" @checked(old('is_featured', $project->is_featured))>
                    <label class="form-check-label" for="is_featured">Ana sayfada öne çıkar</label>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-light">Listeye Dön</a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('input', function (e) {
            if (e.target && e.target.name === 'title[tr]') {
                const v = e.target.value || '';
                const s = v.toLowerCase()
                    .replace(/ç/g, 'c').replace(/ğ/g, 'g').replace(/ı/g, 'i').replace(/ö/g, 'o').replace(/ş/g, 's').replace(/ü/g, 'u')
                    .replace(/[^a-z0-9\\s-]/g, '')
                    .trim()
                    .replace(/\\s+/g, '-')
                    .replace(/-+/g, '-');
                document.getElementById('slug').value = s;
            }
        });
    </script>
@endpush
