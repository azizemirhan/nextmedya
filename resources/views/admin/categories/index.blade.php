@extends('admin.layouts.master')

@section('title', 'Blog Kategorileri')

{{-- YENİ: Breadcrumb alanı eklendi --}}
@section('breadcrumb')
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Yönetim Paneli</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Tüm Kategoriler
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')

    {{-- YENİ: Postlardaki gibi minimal filtre/aksiyon alanı eklendi --}}
    <div class="widget-content widget-content-area p-3 mb-4"
         style="background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

        <div class="d-flex justify-content-between align-items-center">
            {{-- Arama Formu --}}
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex-grow-1 me-2">
                <input type="text" name="search" class="form-control" placeholder="Kategorilerde ara..."
                       value="{{ request('search') }}">
            </form>
            {{-- Aksiyon Butonları (Masaüstü) --}}
            <div class="d-none d-md-flex gap-2">
                <a href="{{ route('admin.categories.trash') }}" class="btn btn-primary">Çöp Kutusu</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Yeni Kategori Ekle</a>
            </div>
        </div>
    </div>

    {{-- GÜNCELLENDİ: Ana içerik kutusu ve form yapısı --}}
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">

            {{-- Form artık tüm tabloyu ve toplu işlem butonunu kapsıyor --}}
            <form action="{{ route('admin.categories.bulkAction') }}" method="POST" id="bulkActionForm">
                @csrf
                <div class="mb-3">
                    {{-- Modal'ı tetikleyen toplu işlem butonu --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#bulkActionModal">
                        Toplu İşlem
                    </button>
                </div>

                <div class="table-responsive">
                    {{-- TABLO İÇERİĞİ DEĞİŞTİRİLMEDİ --}}
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>İsim</th>
                            <th class="text-center">Durum (Aktif/Pasif)</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $category->id }}"></td>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input status-switch" type="checkbox"
                                               data-id="{{ $category->id }}" @checked($category->is_active)>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-sm btn-warning">Düzenle</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Bu kategoriyi silmek istediğinizden emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Kategori bulunamadı.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="mt-3">{{ $categories->links() }}</div>
        </div>
    </div>

    {{-- YENİ: Mobilde yeni kategori eklemek için FAB (Floating Action Button) --}}
    <a href="{{ route('admin.categories.create') }}" class="fab d-md-none">+</a>

    {{-- YENİ: Toplu işlem için Modal --}}
    <div class="modal fade" id="bulkActionModal" tabindex="-1" aria-labelledby="bulkActionModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkActionModalLabel">Toplu İşlem Uygula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Seçili kategoriler için uygulamak istediğiniz işlemi seçin.</p>
                    <select id="modalActionSelect" class="form-select">
                        <option value="">İşlem Seç...</option>
                        <option value="delete">Seçilenleri Çöpe Taşı</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="confirmBulkActionBtn">Uygula</button>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- YENİ: Postlar sayfasındaki tüm CSS stilleri buraya eklendi --}}
@push('styles')
    <style>
        .widget-content-area {
            padding: 1.5rem;
            background-color: #ffffff;
        }

        .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table td, .table th {
            vertical-align: middle;
            padding: 0.9rem;
        }

        #select-all, input[name="ids[]"] {
            cursor: pointer;
            transform: scale(1.2);
        }

        .pagination .page-item .page-link {
            border-radius: 6px;
            margin: 0 3px;
            border: 1px solid #dee2e6;
            color: #0d6efd;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .fab {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background-color: #0d6efd;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            line-height: 60px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1050;
            text-decoration: none;
            transition: transform 0.2s ease-in-out;
        }

        .fab:hover {
            transform: scale(1.05);
            color: white;
        }

        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            padding: 0.55rem 1rem !important;
            height: auto !important;
            border: 1px solid #ced4da !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            right: 10px !important;
            display: flex;
            align-items: center;
        }

        .select2-dropdown {
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
        }
    </style>
@endpush


{{-- GÜNCELLENDİ: Mevcut scriptler, modal scriptleri ile birleştirildi --}}
@push('scripts')
    <script>
        $(document).ready(function () {
            // 1. Toplu seçim için checkbox
            $('#select-all').on('click', function () {
                $('input[name="ids[]"]').prop('checked', this.checked);
            });

            // 2. Status Switch için AJAX Kodu
            $('.status-switch').on('change', function () {
                // DEĞİŞİKLİK BURADA: true/false yerine 1/0 gönderiyoruz
                let isChecked = $(this).is(':checked') ? 1 : 0;
                let categoryId = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.categories.updateStatus') }}",
                    type: 'POST',
                    data: {
                        id: categoryId,
                        is_active: isChecked, // Artık 1 veya 0 olarak gidecek
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                    },
                    error: function (xhr) {
                        // Hata durumunda checkbox'ı eski haline getir (opsiyonel ama önerilir)
                        $(this).prop('checked', !$(this).is(':checked'));

                        console.error('Bir hata oluştu:', xhr.responseText);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Durum güncellenemedi!'
                        });
                    }
                });
            });

            // 3. Modal için Select2'yi etkinleştirme
            $('#modalActionSelect').select2({
                dropdownParent: $('#bulkActionModal'),
                minimumResultsForSearch: Infinity,
                placeholder: 'İşlem Seç...'
            });

            // 4. Modal'daki "Uygula" butonuna tıklandığında formu gönderme
            $('#confirmBulkActionBtn').on('click', function () {
                var selectedAction = $('#modalActionSelect').val();
                if (selectedAction) {
                    var form = $('#bulkActionForm');
                    form.find('input[name="action"]').remove();
                    form.append($('<input>', {type: 'hidden', name: 'action', value: selectedAction}));
                    form.submit();
                } else {
                    alert('Lütfen bir işlem seçin.');
                }
            });
        });
    </script>
@endpush
