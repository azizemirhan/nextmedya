@extends('admin.layouts.master')

@section('title', 'Çöp Kutusu - Kategoriler')

{{-- YENİ: Breadcrumb alanı eklendi --}}
@section('breadcrumb')
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Yönetim Paneli</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.categories.index') }}">Tüm Kategoriler</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Çöp Kutusu
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')

    {{-- YENİ: Üst Aksiyon Alanı --}}
    <div class="widget-content widget-content-area p-3 mb-4 d-flex justify-content-end"
         style="background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Kategori Listesine Geri Dön</a>
    </div>

    {{-- GÜNCELLENDİ: Ana içerik kutusu ve form yapısı --}}
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <form action="{{ route('admin.categories.bulkAction') }}" method="POST" id="bulkActionForm">
                @csrf
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#bulkActionModal">
                        Toplu İşlem
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>İsim</th>
                            <th>Silinme Tarihi</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $category->id }}"></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->deleted_at->format('d M Y H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.categories.restore', $category->id) }}"
                                       class="btn btn-sm btn-success">Geri Yükle</a>
                                    <form action="{{ route('admin.categories.forceDelete', $category->id) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Bu kategoriyi KALICI olarak silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Kalıcı Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Çöp kutusu boş.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

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
                    <p>Seçili öğeler için uygulamak istediğiniz işlemi seçin.</p>
                    <select id="modalActionSelect" class="form-select">
                        <option value="">İşlem Seç...</option>
                        {{-- GÜNCELLENDİ: Çöp kutusuna özel aksiyonlar --}}
                        <option value="restore">Seçilenleri Geri Yükle</option>
                        <option value="force-delete">Seçilenleri Kalıcı Sil</option>
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

{{-- YENİ: Diğer sayfalarla tutarlı CSS stilleri eklendi --}}
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
            text-align: center;
        }

        .table th {
            text-align: left;
        }

        .table td:first-child, .table th:first-child {
            width: 40px;
            text-align: center;
        }

        #select-all, input[name="ids[]"] {
            cursor: pointer;
            transform: scale(1.2);
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


{{-- YENİ: Modal ve toplu seçim için scriptler eklendi --}}
@push('scripts')
    <script>
        $(document).ready(function () {
            // 1. Toplu seçim için checkbox
            $('#select-all').on('click', function() {
                $('input[name="ids[]"]').prop('checked', this.checked);
            });

            // 2. Modal için Select2'yi etkinleştirme
            $('#modalActionSelect').select2({
                dropdownParent: $('#bulkActionModal'),
                minimumResultsForSearch: Infinity,
                placeholder: 'İşlem Seç...'
            });

            // 3. Modal'daki "Uygula" butonuna tıklandığında formu gönderme
            $('#confirmBulkActionBtn').on('click', function () {
                var selectedAction = $('#modalActionSelect').val();
                if (selectedAction) {
                    var form = $('#bulkActionForm');
                    // Formun içine gizli bir input ile seçilen aksiyonu ekliyoruz
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
