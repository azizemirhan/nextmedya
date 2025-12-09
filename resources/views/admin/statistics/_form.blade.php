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
            <div class="card-header">
                <h5 class="mb-0">İstatistik Bilgileri</h5>
            </div>
            <div class="card-body">
                {{-- Dil sekmeleri --}}
                <ul class="nav nav-tabs" id="langTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tr-tab" data-bs-toggle="tab" data-bs-target="#tr-content"
                                type="button" role="tab">Türkçe (TR)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-content"
                                type="button" role="tab">İngilizce (EN)
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="langTabContent">
                    {{-- TR --}}
                    <div class="tab-pane fade show active" id="tr-content" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Başlık (TR) <span class="text-danger">*</span></label>
                            <input type="text" name="title[tr]" class="form-control"
                                   value="{{ old('title.tr', $statistic->title['tr'] ?? '') }}">
                        </div>
                    </div>
                    {{-- EN --}}
                    <div class="tab-pane fade" id="en-content" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Title (EN)</label>
                            <input type="text" name="title[en]" class="form-control"
                                   value="{{ old('title.en', $statistic->title['en'] ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Sayı (örn: 15+ veya 120)</label>
                        <input type="text" name="number" class="form-control"
                               value="{{ old('number', $statistic->number ?? '') }}" placeholder="15+">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label d-flex align-items-center justify-content-between">
                            <span>İkon Sınıfı (opsiyonel)</span>
                            <small class="text-muted ms-2">FA5 örn: <code>fas fa-star</code></small>
                        </label>

                        <div class="input-group">
                            <input type="text" name="icon" id="iconInput" class="form-control"
                                   value="{{ old('icon', $statistic->icon ?? '') }}"
                                   placeholder="fas fa-star">
                            <button type="button" class="btn btn-outline-secondary" id="openIconPicker">
                                Seç…
                            </button>
                        </div>
                        <div class="mt-2" id="iconPreview">
                            @if(!empty(old('icon', $statistic->icon ?? '')))
                                <i class="{{ old('icon', $statistic->icon ?? '') }}" style="font-size:20px"></i>
                                <span class="text-muted small ms-2">{{ old('icon', $statistic->icon ?? '') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- SAĞ KOLON --}}
    <div class="col-12 col-lg-4">
        <div class="card mb-3">
            <div class="card-header"><h5 class="mb-0">Ayarlar</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Sıralama <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $statistic->order ?? 0) }}">
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="{{ route('admin.statistics.index') }}" class="btn btn-light">Listeye Dön</a>
        </div>
    </div>
</div>

{{-- ICON PICKER MODAL (BS5) --}}
<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-labelledby="iconPickerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconPickerLabel">İkon Seç</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 d-flex gap-2">
                    <input type="text" id="iconSearch" class="form-control"
                           placeholder="Ara: star, trophy, chart, users...">
                    <select id="styleFilter" class="form-select" style="max-width: 180px;">
                        <option value="">Tümü</option>
                        <option value="fas">Solid (fas)</option>
                        <option value="far">Regular (far)</option>
                        <option value="fab">Brands (fab)</option>
                    </select>
                </div>
                <div class="row g-2" id="iconGrid">
                    {{-- JS ile doldurulacak --}}
                </div>
            </div>
            <div class="modal-footer">
                <small class="text-muted me-auto">Listeyi genişletmek için JS’teki <code>FA_ICONS</code> dizisini
                    artırabilirsin.</small>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function () {
            // Basit FA5 ikon listesi (isteğine göre artır)
            const FA_ICONS = [
                // Solid (fas)
                'fas fa-star', 'fas fa-star-half-alt', 'fas fa-trophy', 'fas fa-award', 'fas fa-medal',
                'fas fa-users', 'fas fa-user-friends', 'fas fa-user', 'fas fa-briefcase', 'fas fa-building',
                'fas fa-chart-line', 'fas fa-chart-bar', 'fas fa-chart-pie', 'fas fa-bolt', 'fas fa-check',
                'fas fa-clock', 'fas fa-calendar', 'fas fa-cogs', 'fas fa-cube', 'fas fa-cubes',
                'fas fa-globe', 'fas fa-map-marker-alt', 'fas fa-shield-alt', 'fas fa-thumbs-up', 'fas fa-heart',
                // Regular (far)
                'far fa-star', 'far fa-smile', 'far fa-thumbs-up', 'far fa-clock', 'far fa-calendar',
                // Brands (fab)
                'fab fa-apple', 'fab fa-android', 'fab fa-chrome', 'fab fa-figma', 'fab fa-github', 'fab fa-laravel'
            ];

            const iconInput = document.getElementById('iconInput');
            const iconPreview = document.getElementById('iconPreview');
            const openBtn = document.getElementById('openIconPicker');

            const modalEl = document.getElementById('iconPickerModal');
            let iconModal;
            if (window.bootstrap && bootstrap.Modal) {
                iconModal = new bootstrap.Modal(modalEl);
            }

            // Modal aç
            openBtn?.addEventListener('click', () => {
                populateGrid();
                iconModal?.show();
                // Arama inputuna odak
                setTimeout(() => document.getElementById('iconSearch')?.focus(), 250);
            });

            // Arama & filtre
            document.getElementById('iconSearch')?.addEventListener('input', populateGrid);
            document.getElementById('styleFilter')?.addEventListener('change', populateGrid);

            function populateGrid() {
                const grid = document.getElementById('iconGrid');
                if (!grid) return;

                const q = (document.getElementById('iconSearch')?.value || '').toLowerCase().trim();
                const style = (document.getElementById('styleFilter')?.value || '').trim();

                grid.innerHTML = '';

                const filtered = FA_ICONS.filter(cls => {
                    const hitsQuery = q ? cls.includes(q) : true;
                    const hitsStyle = style ? cls.startsWith(style + ' ') : true;
                    return hitsQuery && hitsStyle;
                });

                if (filtered.length === 0) {
                    grid.innerHTML = '<div class="col-12 text-muted">Eşleşen ikon bulunamadı.</div>';
                    return;
                }

                filtered.forEach(cls => {
                    const col = document.createElement('div');
                    col.className = 'col-3 col-sm-2 col-md-2 text-center';
                    col.innerHTML = `
                <button type="button" class="btn btn-light w-100 py-3 pick-icon" data-icon="${cls}">
                    <i class="${cls}" style="font-size:22px"></i>
                    <div class="small text-muted mt-2" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${cls}</div>
                </button>
            `;
                    grid.appendChild(col);
                });

                // Seçim handler
                grid.querySelectorAll('.pick-icon').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const cls = btn.getAttribute('data-icon');
                        iconInput.value = cls;
                        iconPreview.innerHTML = `<i class="${cls}" style="font-size:20px"></i><span class="text-muted small ms-2">${cls}</span>`;
                        iconModal?.hide();
                    });
                });
            }

            // Manuel class yazınca önizlemeyi güncelle
            iconInput?.addEventListener('input', () => {
                const cls = iconInput.value.trim();
                iconPreview.innerHTML = cls
                    ? `<i class="${cls}" style="font-size:20px"></i><span class="text-muted small ms-2">${cls}</span>`
                    : '';
            });
        })();
    </script>
@endpush
