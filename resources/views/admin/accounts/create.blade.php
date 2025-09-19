@extends('admin.layouts.master')

@section('title', 'Yeni Şirket')

@section('content')
    <div class="middle-content container-xxl p-0">

        {{-- BEGIN BREADCRUMBS --}}
        <div class="secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Accounts">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                                <h5 class="mb-0">Yeni Şirket</h5>
                            </div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">Accounts</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <ul class="navbar-nav flex-row ms-auto breadcrumb-action-dropdown">
                        <li class="nav-item more-dropdown">
                            <div class="dropdown custom-dropdown-icon">
                                <a class="dropdown-toggle btn _effect--ripple waves-effect waves-light" href="#"
                                    data-bs-toggle="dropdown">
                                    <span>Actions</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-chevron-down custom-dropdown-arrow">
                                        <polyline points="6 9 12 15 18 9" />
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('admin.accounts.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-list">
                                            <line x1="8" y1="6" x2="21" y2="6" />
                                            <line x1="8" y1="12" x2="21" y2="12" />
                                            <line x1="8" y1="18" x2="21" y2="18" />
                                            <line x1="3" y1="6" x2="3.01" y2="6" />
                                            <line x1="3" y1="12" x2="3.01" y2="12" />
                                            <line x1="3" y1="18" x2="3.01" y2="18" />
                                        </svg> Listeye Dön
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </header>
            </div>
        </div>
        {{-- END BREADCRUMBS --}}

        @if ($errors->any())
            <div class="alert alert-danger mx-3 my-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.accounts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="draft_key" name="draft_key" value="{{ old('draft_key') }}">

            <div class="row layout-spacing">

                {{-- SOL: Profil / Logo --}}
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                    <div class="user-profile">
                        <div class="widget-content widget-content-area">
                            <div class="d-flex justify-content-between">
                                <h3 class="">Profil</h3>
                            </div>

                            <div class="text-center user-info">
                                <img id="logo-preview" src="#" alt="logo"
                                    style="display:none; max-width:160px; border-radius:8px;">
                                <p class="mt-2 text-muted small">Logo önizleme</p>
                            </div>

                            <div class="user-info-list">
                                <div class="">
                                    <ul class="contacts-block list-unstyled">
                                        <li class="contacts-block__item">
                                            <label class="form-label mb-1">Logo Yükle</label>
                                            <input type="file" name="logo" id="logo" class="form-control"
                                                accept="image/*">
                                        </li>

                                        <li class="contacts-block__item mt-3">
                                            <label class="form-label mb-1">Şirket Adı <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required
                                                value="{{ old('name') }}">
                                        </li>

                                        <li class="contacts-block__item mt-3">
                                            <label class="form-label mb-1">Ticari Unvan</label>
                                            <input type="text" name="legal_name" class="form-control"
                                                value="{{ old('legal_name') }}">
                                        </li>

                                        <li class="contacts-block__item mt-3">
                                            <label class="form-label mb-1">Web Sitesi</label>
                                            <input type="url" name="website" class="form-control"
                                                placeholder="https://..." value="{{ old('website') }}">
                                        </li>
                                    </ul>

                                    <ul class="list-inline mt-4">
                                        <li class="list-inline-item mb-0">
                                            <select name="status" class="form-select">
                                                @foreach (['active' => 'Aktif', 'inactive' => 'Pasif', 'prospect' => 'Aday', 'churned' => 'Kaybedildi'] as $k => $v)
                                                    <option value="{{ $k }}" @selected(old('status') === $k)>
                                                        {{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <select name="lifecycle_stage" class="form-select">
                                                @foreach (['lead' => 'Lead', 'customer' => 'Müşteri', 'partner' => 'Partner', 'vendor' => 'Tedarikçi', 'other' => 'Diğer'] as $k => $v)
                                                    <option value="{{ $k }}" @selected(old('lifecycle_stage', 'lead') === $k)>
                                                        {{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SAĞ: Form Kartları --}}
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                    {{-- GENEL BİLGİLER --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">Genel Bilgiler</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vergi No</label>
                                <input type="text" name="tax_number" class="form-control"
                                    value="{{ old('tax_number') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sicil No</label>
                                <input type="text" name="registration_no" class="form-control"
                                    value="{{ old('registration_no') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sektör</label>
                                <input type="text" name="industry" class="form-control"
                                    value="{{ old('industry') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Çalışan Sayısı</label>
                                <input type="number" name="employee_count" class="form-control"
                                    value="{{ old('employee_count') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Yıllık Ciro</label>
                                <input type="number" name="annual_revenue" class="form-control"
                                    value="{{ old('annual_revenue') }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Kaynak</label>
                                <input type="text" name="source" class="form-control"
                                    placeholder="webform / referans / ads ..." value="{{ old('source') }}">
                            </div>
                        </div>
                    </div>

                    {{-- İLETİŞİM (Çoğaltılabilir) --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">İletişim</h3>

                        {{-- E-POSTA --}}
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">E-posta</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-email">
                                    <i class="bi bi-plus-circle"></i> Ekle
                                </button>
                            </div>
                            <div id="email-fields" class="mt-2" data-next-index="1">
                                <div class="input-group mb-2">
                                    <input type="email" name="emails[0][value]" class="form-control"
                                        placeholder="ornek@firma.com" value="{{ old('emails.0.value') }}">
                                    <input type="text" name="emails[0][label]" class="form-control"
                                        placeholder="Etiket (work/billing)" value="{{ old('emails.0.label') }}">
                                    <button type="button" class="btn btn-outline-danger remove-field"><i
                                            class="bi bi-x"></i></button>
                                </div>
                            </div>
                        </div>

                        {{-- TELEFON --}}
                        <div>
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Telefon</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-phone">
                                    <i class="bi bi-plus-circle"></i> Ekle
                                </button>
                            </div>
                            <div id="phone-fields" class="mt-2" data-next-index="1">
                                <div class="input-group mb-2">
                                    <input type="text" name="phones[0][number]" class="form-control"
                                        placeholder="05xxxxxxxxx" value="{{ old('phones.0.number') }}">
                                    <input type="text" name="phones[0][label]" class="form-control"
                                        placeholder="Etiket (mobile/office)" value="{{ old('phones.0.label') }}">
                                    <button type="button" class="btn btn-outline-danger remove-field"><i
                                            class="bi bi-x"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SAHİP & ZAMANLAMA --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">Sahip & Zamanlama</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sahip</label>
                                <select name="owner_id" class="form-select">
                                    <option value="">Seçiniz</option>
                                    @foreach ($owners as $owner)
                                        <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id)>
                                            {{ $owner->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Skor</label>
                                <input type="number" name="score" class="form-control" min="0" max="100"
                                    value="{{ old('score', 0) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Son Temas</label>
                                <input type="datetime-local" name="last_contacted_at" class="form-control"
                                    value="{{ old('last_contacted_at') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sonraki Aktivite</label>
                                <input type="datetime-local" name="next_activity_at" class="form-control"
                                    value="{{ old('next_activity_at') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.accounts.index') }}" class="btn btn-outline-secondary">Vazgeç</a>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                        <button type="button" class="btn btn-warning" id="save-draft-btn">
                            <i class="bi bi-save"></i> Taslak Olarak Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logo önizleme
            const logoInput = document.getElementById('logo');
            const logoPreview = document.getElementById('logo-preview');
            if (logoInput) {
                logoInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            logoPreview.src = e.target.result;
                            logoPreview.style.display = 'inline-block';
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // Dinamik alan çoğaltma
            function addField(containerId, builder) {
                const container = document.getElementById(containerId);
                let idx = parseInt(container.getAttribute('data-next-index') || '0', 10);
                const group = document.createElement('div');
                group.className = 'input-group mb-2';
                group.innerHTML = builder(idx);
                container.appendChild(group);
                container.setAttribute('data-next-index', String(idx + 1));
            }

            document.getElementById('add-email')?.addEventListener('click', () => {
                addField('email-fields', (i) => `
            <input type="email" name="emails[${i}][value]" class="form-control" placeholder="ornek@firma.com">
            <input type="text"   name="emails[${i}][label]" class="form-control" placeholder="Etiket (work/billing)">
            <button type="button" class="btn btn-outline-danger remove-field"><i class="bi bi-x"></i></button>
        `);
            });

            document.getElementById('add-phone')?.addEventListener('click', () => {
                addField('phone-fields', (i) => `
            <input type="text" name="phones[${i}][number]" class="form-control" placeholder="05xxxxxxxxx">
            <input type="text" name="phones[${i}][label]"  class="form-control" placeholder="Etiket (mobile/office)">
            <button type="button" class="btn btn-outline-danger remove-field"><i class="bi bi-x"></i></button>
        `);
            });

            // Sil / tek satır kaldıysa temizle
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-field');
                if (btn) {
                    const group = btn.closest('.input-group');
                    const container = group.parentElement;
                    if (container.querySelectorAll('.input-group').length > 1) {
                        group.remove();
                    } else {
                        group.querySelectorAll('input').forEach(i => i.value = '');
                    }
                }
            });
        });
    </script>

    <script>
        (function() {
            const form = document.querySelector('form');
            const token = '{{ csrf_token() }}';
            const draftKeyEl = document.getElementById('draft_key');

            // draft_key üret
            if (!draftKeyEl.value) {
                draftKeyEl.value = (self.crypto?.randomUUID?.() || Math.random().toString(36).slice(2));
            }
            const draftKey = draftKeyEl.value;

            // FormData → JSON (nested destekli)
            function formDataToJson(form) {
                const fd = new FormData(form);
                const obj = {};
                fd.forEach((value, key) => {
                    if (key === '_token' || key === '_method') return;
                    const keys = key.replace(/\]/g, "").split("[");
                    let cur = obj;
                    keys.forEach((k, i) => {
                        if (i === keys.length - 1) {
                            cur[k] = value;
                        } else {
                            if (!cur[k]) cur[k] = {};
                            cur = cur[k];
                        }
                    });
                });
                return obj;
            }

            // Taslak kaydet
            async function saveDraft() {
                const payload = formDataToJson(form);
                try {
                    const res = await fetch('{{ route('admin.drafts.upsert') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            draft_key: draftKey,
                            context: '{{ Route::currentRouteName() }}', // admin.accounts.create
                            payload: payload ?? {}
                        })
                    });
                    const data = await res.json();
                    if (data.ok) {
                        draftKeyEl.value = data.draft_key;
                        alert('Taslak başarıyla kaydedildi ✅');
                    } else {
                        alert('Taslak kaydedilemedi ❌');
                        console.error(data);
                    }
                } catch (e) {
                    alert('Sunucu hatası ❌');
                    console.error(e);
                }
            }

            document.getElementById('save-draft-btn').addEventListener('click', saveDraft);
        })();
    </script>
@endpush
