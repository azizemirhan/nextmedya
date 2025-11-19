@extends('admin.layouts.master')

@section('title', 'Yeni Kişi Ekle')

@section('content')
    <div class="middle-content container-xxl p-0">
        {{-- BEGIN BREADCRUMBS --}}
        <div class="secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Contacts">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                                <h5 class="mb-0">Yeni Kişi</h5>
                            </div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.contacts.index') }}">Kişiler</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Oluştur</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        {{-- END BREADCRUMBS --}}

        @if ($errors->any())
            <div class="alert alert-danger mx-3 my-3">
                <ul class="mb-0">@foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.contacts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row layout-spacing">
                {{-- SOL: Temel Bilgiler --}}
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                    <div class="user-profile">
                        <div class="widget-content widget-content-area">
                            <div class="d-flex justify-content-between">
                                <h3 class="">Kişi Profili</h3>
                            </div>
                            <div class="text-center user-info">
                                <img id="photo-preview" src="#" alt="profil resmi"
                                     style="display:none; width: 160px; height: 160px; object-fit: cover; border-radius: 8px;">
                                <p id="preview-text" class="mt-2 text-muted small" style="display: none;">Profil resmi
                                    önizlemesi</p>
                            </div>
                            <div class="user-info-list">
                                <ul class="contacts-block list-unstyled">
                                    <li class="contacts-block__item">
                                        <label class="form-label mb-1">Profil Fotoğrafı</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="form-control"
                                               accept="image/*">
                                    </li>
                                    <li class="contacts-block__item mt-3">
                                        <label class="form-label mb-1">Ad <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control" required
                                               value="{{ old('first_name') }}">
                                    </li>
                                    <li class="contacts-block__item mt-3">
                                        <label class="form-label mb-1">Soyad</label>
                                        <input type="text" name="last_name" class="form-control"
                                               value="{{ old('last_name') }}">
                                    </li>
                                    <li class="contacts-block__item mt-3">
                                        <label class="form-label mb-1">Unvan</label>
                                        <input type="text" name="job_title" class="form-control"
                                               placeholder="örn: Satış Müdürü" value="{{ old('job_title') }}">
                                    </li>
                                    <li class="contacts-block__item mt-3">
                                        <label class="form-label mb-1">Departman</label>
                                        <input type="text" name="department" class="form-control"
                                               placeholder="örn: Pazarlama" value="{{ old('department') }}">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">Özel Notlar</h3>
                        <div class="form-group">
                            <textarea name="notes" class="form-control" rows="6"
                                      placeholder="Bu kişiyle ilgili özel notlarınızı buraya ekleyebilirsiniz...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">Hassas Giriş Bilgileri (Şifreli)</h3>
                        <div class="table-responsive scrollable-table-container">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Giriş URL</th>
                                    <th>Kullanıcı Adı / E-posta</th>
                                    <th>Şifre</th>
                                    <th>Müşteri No</th>
                                    <th>2FA Durumu</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="credentials-tbody">
                                @php
                                    // Validasyon hatası durumunda formda kalan eski veriyi, yoksa veritabanından gelen asıl veriyi kullan.
                                    $credentialsData = old('credentials', $contact->credentials ?? []);
                                @endphp

                                @forelse($credentialsData as $index => $credential)
                                    <tr class="credential-row">
                                        <td>
                                            <input type="url" name="credentials[{{ $index }}][login_url]"
                                                   class="form-control" placeholder="https://ornek.com/login"
                                                   value="{{ $credential['login_url'] ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="text" name="credentials[{{ $index }}][username]"
                                                   class="form-control" value="{{ $credential['username'] ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="password" name="credentials[{{ $index }}][password]"
                                                   class="form-control" placeholder="Değiştirmek için doldurun">
                                        </td>
                                        <td>
                                            <input type="text" name="credentials[{{ $index }}][customer_no]"
                                                   class="form-control"
                                                   value="{{ $credential['customer_no'] ?? '' }}">
                                        </td>
                                        <td>
                                            <select name="credentials[{{ $index }}][two_fa_status]"
                                                    class="form-select">
                                                <option
                                                    value="yok" @selected(($credential['two_fa_status'] ?? 'yok') == 'yok')>
                                                    Yok
                                                </option>
                                                <option
                                                    value="var" @selected(($credential['two_fa_status'] ?? '') == 'var')>
                                                    Var
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-outline-danger remove-credential-row">X
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="credential-row">
                                        <td><input type="url" name="credentials[0][login_url]" class="form-control"
                                                   placeholder="https://ornek.com/login"></td>
                                        <td><input type="text" name="credentials[0][username]" class="form-control">
                                        </td>
                                        <td><input type="password" name="credentials[0][password]"
                                                   class="form-control"></td>
                                        <td><input type="text" name="credentials[0][customer_no]"
                                                   class="form-control"></td>
                                        <td>
                                            <select name="credentials[0][two_fa_status]" class="form-select">
                                                <option value="yok" selected>Yok</option>
                                                <option value="var">Var</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-outline-danger remove-credential-row">X
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <button type="button" id="add-credential-row" class="btn btn-primary mt-2">
                            <i class="bi bi-plus-circle"></i> Yeni Giriş Bilgisi Ekle
                        </button>
                    </div>
                </div>

                {{-- SAĞ: Form Kartları --}}
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                    {{-- İLETİŞİM --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">İletişim Bilgileri</h3>
                        {{-- E-posta Alanları --}}
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">E-posta</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-email"><i
                                        class="bi bi-plus-circle"></i> Ekle
                                </button>
                            </div>
                            <div id="email-fields" class="mt-2" data-next-index="1">
                                <div class="input-group mb-2">
                                    <input type="email" name="emails[0][value]" class="form-control"
                                           placeholder="ornek@firma.com" value="{{ old('emails.0.value') }}">
                                    <input type="text" name="emails[0][label]" class="form-control"
                                           placeholder="Etiket (iş/kişisel)" value="{{ old('emails.0.label') }}">
                                    <button type="button" class="btn btn-outline-danger remove-field"><i
                                            class="bi bi-x"></i></button>
                                </div>
                            </div>
                        </div>
                        {{-- Telefon Alanları --}}
                        <div>
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label mb-0">Telefon</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-phone"><i
                                        class="bi bi-plus-circle"></i> Ekle
                                </button>
                            </div>
                            <div id="phone-fields" class="mt-2" data-next-index="1">
                                <div class="input-group mb-2">
                                    <input type="text" name="phones[0][number]" class="form-control"
                                           placeholder="05xxxxxxxxx" value="{{ old('phones.0.number') }}">
                                    <input type="text" name="phones[0][label]" class="form-control"
                                           placeholder="Etiket (cep/ofis)" value="{{ old('phones.0.label') }}">
                                    <button type="button" class="btn btn-outline-danger remove-field"><i
                                            class="bi bi-x"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ADRES & SOSYAL MEDYA --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">Adres & Sosyal Medya</h3>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Adres Satırı</label>
                                <input type="text" name="addresses[0][line1]" class="form-control"
                                       placeholder="Sokak, No, Daire" value="{{ old('addresses.0.line1') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">İlçe</label>
                                <input type="text" name="addresses[0][city]" class="form-control" placeholder="İlçe"
                                       value="{{ old('addresses.0.city') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">İl</label>
                                <input type="text" name="addresses[0][state]" class="form-control" placeholder="İl"
                                       value="{{ old('addresses.0.state') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Posta Kodu</label>
                                <input type="text" name="addresses[0][zip]" class="form-control"
                                       placeholder="Posta Kodu" value="{{ old('addresses.0.zip') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">LinkedIn</label>
                                <input type="url" name="socials[linkedin]" class="form-control"
                                       placeholder="https://linkedin.com/in/..." value="{{ old('socials.linkedin') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">X (Twitter)</label>
                                <input type="url" name="socials[x]" class="form-control" placeholder="https://x.com/..."
                                       value="{{ old('socials.x') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Instagram</label>
                                <input type="url" name="socials[instagram]" class="form-control"
                                       placeholder="https://instagram.com/..." value="{{ old('socials.instagram') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="url" name="socials[facebook]" class="form-control"
                                       placeholder="https://facebook.com/..." value="{{ old('socials.facebook') }}">
                            </div>
                        </div>
                    </div>

                    {{-- ŞİRKET İLİŞKİSİ VE LEAD BİLGİSİ --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">İlişki ve Lead Bilgisi</h3>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Bağlı Olduğu Şirket</label>
                                <select name="account_id" id="select-account" class="form-select"
                                        placeholder="Şirket ara ve seç...">
                                    <option value="">Şirket Seçiniz (isteğe bağlı)</option>
                                    @foreach ($accounts as $account)
                                        <option
                                            value="{{ $account->id }}" @selected(old('account_id') == $account->id)>{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kaynak</label>
                                <input type="text" name="source" class="form-control"
                                       placeholder="webform / referans ..." value="{{ old('source') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Skor</label>
                                <input type="number" name="score" class="form-control" min="0" max="100"
                                       value="{{ old('score', 0) }}">
                            </div>
                        </div>
                    </div>

                    {{-- İZİNLER --}}
                    <div class="widget-content widget-content-area mb-3">
                        <h3 class="">İzinler ve Tercihler</h3>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="is_decision_maker"
                                   name="is_decision_maker" value="1" @checked(old('is_decision_maker'))>
                            <label class="form-check-label" for="is_decision_maker">Karar Verici</label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="consent_email" name="consent_email"
                                   value="1" @checked(old('consent_email'))>
                            <label class="form-check-label" for="consent_email">E-posta İzni</label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="consent_sms" name="consent_sms"
                                   value="1" @checked(old('consent_sms'))>
                            <label class="form-check-label" for="consent_sms">SMS İzni</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">Vazgeç</a>
                        <button type="submit" class="btn btn-success">Kişiyi Kaydet</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('styles')
    <style>
        @media (max-width: 991.98px) {
            .scrollable-table-container {
                display: block;
                width: 100%;
                overflow-x: auto; /* En önemli kural: Gerektiğinde yatay scrollbar çıkar */
                -webkit-overflow-scrolling: touch; /* iOS için daha akıcı bir kaydırma deneyimi sağlar */
            }
        }

        .scrollable-table-container {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Bu sarmalayıcının içindeki tablonun sütunları için stiller */
        .scrollable-table-container table th,
        .scrollable-table-container table td {
            white-space: nowrap; /* Metinlerin alt satıra inmesini engeller */
            min-width: 250px; /* YENİ: Her sütun için minimum genişlik belirler */
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Tom Select'i Başlatma
            new TomSelect("#select-account", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            const credentialsTbody = document.getElementById('credentials-tbody');

// Yeni satır ekleme
            document.getElementById('add-credential-row')?.addEventListener('click', function () {
                const newIndex = credentialsTbody.querySelectorAll('.credential-row').length;
                const newRow = document.createElement('tr');
                newRow.className = 'credential-row';
                newRow.innerHTML = `
        <td><input type="url" name="credentials[${newIndex}][login_url]" class="form-control" placeholder="https://ornek.com/login"></td>
        <td><input type="text" name="credentials[${newIndex}][username]" class="form-control"></td>
        <td><input type="password" name="credentials[${newIndex}][password]" class="form-control"></td>
        <td><input type="text" name="credentials[${newIndex}][customer_no]" class="form-control"></td>
        <td>
            <select name="credentials[${newIndex}][two_fa_status]" class="form-select">
                <option value="yok">Yok</option>
                <option value="var">Var</option>
            </select>
        </td>
        <td><button type="button" class="btn btn-outline-danger remove-credential-row">X</button></td>
    `;
                credentialsTbody.appendChild(newRow);
            });

// Satır silme (olay delegasyonu ile)
            credentialsTbody.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-credential-row')) {
                    const row = e.target.closest('.credential-row');
                    // Eğer son satırsa silme, içini temizle
                    if (credentialsTbody.querySelectorAll('.credential-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll('input, select').forEach(input => input.value = '');
                    }
                }
            });

            // Profil Fotoğrafı Önizleme
            const photoInput = document.getElementById('profile_photo');
            const photoPreview = document.getElementById('photo-preview');
            const previewText = document.getElementById('preview-text');
            if (photoInput) {
                photoInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            photoPreview.src = e.target.result;
                            photoPreview.style.display = 'block';
                            previewText.style.display = 'block';
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // Dinamik E-posta/Telefon Alanları
            function addField(containerId, builder) {
                const container = document.getElementById(containerId);
                if (!container) return;
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
    <input type="text"   name="emails[${i}][label]" class="form-control" placeholder="Etiket (iş/kişisel)">
    <button type="button" class="btn btn-outline-danger remove-field"><i class="bi bi-x"></i></button>
`);
            });

            document.getElementById('add-phone')?.addEventListener('click', () => {
                addField('phone-fields', (i) => `
    <input type="text" name="phones[${i}][number]" class="form-control" placeholder="05xxxxxxxxx">
    <input type="text" name="phones[${i}][label]"  class="form-control" placeholder="Etiket (cep/ofis)">
<button type="button" class="btn btn-outline-danger remove-field"><i class="bi bi-x"></i></button>
`);
            });

            document.body.addEventListener('click', function (e) {
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
@endpush
