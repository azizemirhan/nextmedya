@extends('admin.layouts.master')
@section('title', 'Tüm Yazılar')
@section('breadcrumb')
        <div class="breadcrumb-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Yönetim Paneli</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Tüm Yazılar
                    </li>
                </ol>
            </nav>
        </div>
@endsection
@section('content')
    <div class="widget-content widget-content-area p-3 mb-4"
         style="background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

        <div class="d-flex justify-content-between align-items-center d-md-none mb-3">
            <span class="fs-6 fw-bold">Filtrele</span>
            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                <i class="fa-solid fa-filter me-1"></i> Göster/Gizle
            </button>
        </div>

        <div class="collapse d-md-block" id="filterCollapse">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="d-md-flex gap-2 align-items-center">

                <div class="flex-grow-1 mb-2 mb-md-0">
                    <input type="text" name="search" class="form-control" placeholder="Başlıkta, içerikte ara..."
                           value="{{ request('search') }}">
                </div>

                <div class="mb-2 mb-md-0">
                    <select name="category" class="form-select">
                        <option value="">Tüm Kategoriler</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2 mb-md-0">
                    <select name="author" class="form-select">
                        <option value="">Tüm Yazarlar</option>
                        @foreach ($authors as $author)
                            <option
                                value="{{ $author->id }}" @selected(request('author') == $author->id)>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2 mb-md-0">
                    <select name="status" class="form-select">
                        <option value="">Tüm Durumlar</option>
                        <option value="published" @selected(request('status') == 'published')>Yayınlandı</option>
                        <option value="draft" @selected(request('status') == 'draft')>Taslak</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Filtrele</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Sıfırla</a>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Blog Ekle</a>
                </div>

            </form>
        </div>
        </div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
        </div>
        <div class="widget-content widget-content-area">
            <form action="{{ route('admin.posts.bulkAction') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="row">
                        <div style="display: flex">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#bulkActionModal">
                                Toplu İşlem
                            </button>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Görsel</th>
                                <th>Başlık</th>
                                <th>Yazar</th>
                                <th>Kategori</th>
                                <th class="text-center">Durum</th>
                                <th class="text-center">Tarih</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $post->id }}"></td>
                                    <td>
                                        @if ($post->featured_image)
                                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}"
                                                width="80" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Görsel Yok</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($post->title, 50) }}</td>
                                    <td>{{ $post->user->name ?? 'N/A' }}</td>
                                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        @if ($post->status == 'published')
                                            <span class="badge bg-success">Yayınlandı</span>
                                        @elseif($post->status == 'draft')
                                            <span class="badge bg-secondary">Taslak</span>
                                        @elseif($post->status == 'scheduled')
                                            <span class="badge bg-warning">Zamanlanmış</span>
                                        @else
                                            <span class="badge bg-info">{{ ucfirst($post->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : 'Belirtilmemiş' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                            class="btn btn-sm btn-warning">Düzenle</a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Bu yazıyı çöpe taşımak istediğinizden emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Arama kriterlerine uygun yazı bulunamadı.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="fab d-md-none">
        {{-- Artı ikonu için (opsiyonel, FontAwesome veya Bootstrap Icons kullanabilirsiniz) --}}
        {{-- <i class="fas fa-plus"></i> --}}
        +
    </a>
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
                    <select name="action" id="modalActionSelect" class="form-select">
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
@push('styles')
    <style>
        .card,
        .statbox {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            overflow: hidden; /* Kart içindeki taşmaları engeller */
        }

        .card-header,
        .widget-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            font-size: 1rem;
            padding: 1rem 1.5rem;
        }

        .card-body,
        .widget-content-area {
            padding: 1.5rem;
            background-color: #ffffff;
        }

        /* Form Elemanları */
        .form-control,
        .form-select {
            border-radius: 6px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        /* Butonlar */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-warning {
            color: #fff;
        }

        /* Tablo Stilleri */
        .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .table {
            margin-bottom: 0; /* Responsive container'dan dolayı margin'i sıfırla */
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-align: left;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1; /* Satır üzerine gelince arkaplan rengi */
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 0.9rem;
        }

        .table td:first-child,
        .table th:first-child {
            width: 40px;
            text-align: center;
        }

        .table .img-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            padding: 3px;
            border-radius: 6px;
        }

        /* Tablo İçindeki İşlem Butonları */
        .table .btn-sm {
            padding: 0.25rem 0.6rem;
            font-size: 0.8rem;
        }

        /* Durum Rozetleri (Badges) */
        .badge {
            font-size: 0.8em;
            font-weight: 600;
            padding: 0.5em 0.8em;
        }

        /* Checkbox Stilleri */
        #select-all,
        input[name="ids[]"] {
            cursor: pointer;
            transform: scale(1.2);
        }

        /* Sayfalama (Pagination) */
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

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
        }

        /* Mobil Filtre Butonu için Ekstra Stil */
        @media (max-width: 767.98px) {
            .card-header .btn-light {
                border-color: #ddd;
                font-weight: 500;
            }

            /* Mobil için butonların daha iyi görünmesi */
            .card-body .text-end .btn {
                width: 48%; /* Butonları yan yana sığdırmak için */
                margin-top: 5px;
            }

            .card-body .text-end .btn:first-child {
                margin-right: 2%;
            }
        }

        /* Genel buton iyileştirmesi */
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Floating Action Button (FAB) Stili */
        .fab {
            position: fixed; /* Sayfaya göre sabitler */
            bottom: 25px; /* Alttan boşluk */
            right: 25px; /* Sağdan boşluk */
            width: 60px; /* Genişlik */
            height: 60px; /* Yükseklik */
            background-color: #0d6efd; /* Arkaplan rengi */
            color: white; /* İkon/Yazı rengi */
            border-radius: 50%; /* Yuvarlak yapar */
            text-align: center;
            font-size: 30px; /* İçindeki "+" işaretinin boyutu */
            line-height: 60px; /* Artı işaretini dikeyde ortalar */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1050; /* Diğer elemanların üzerinde kalmasını sağlar */
            text-decoration: none;
            transition: transform 0.2s ease-in-out;
        }

        .fab:hover {
            transform: scale(1.05); /* Üzerine gelince hafifçe büyür */
            color: white;
        }

        /* =================================== */
        /* Modern & Temiz Modal Stilleri    */
        /* =================================== */

        /* Modal'ın genel arkaplanı ve çerçevesi */
        .modal-content {
            border: none;
            border-radius: 12px; /* Daha yumuşak köşeler */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        /* Modal Başlığı (Header) */
        .modal-header {
            background-color: #f8f9fa; /* Hafif gri bir başlık arkaplanı */
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #343a40; /* Koyu gri başlık rengi */
        }

        /* Kapatma Butonu (X) */
        .btn-close {
            background-size: 0.8em;
            transition: transform 0.2s ease;
        }

        .btn-close:hover {
            transform: rotate(90deg);
        }

        /* Modal İçeriği (Body) */
        .modal-body {
            padding: 1.5rem 1.5rem;
            font-size: 0.95rem;
            color: #495057;
        }

        .modal-body p {
            margin-bottom: 1rem;
        }

        /* Modal içindeki Select (Dropdown) */
        .modal-body .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            background-color: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .modal-body .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Modal Alt Bilgisi (Footer) ve Butonlar */
        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 0.75rem 1.5rem;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
            display: flex;
            justify-content: flex-end; /* Butonları sağa yaslar */
        }

        .modal-footer .btn {
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .modal-footer .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* =================================== */
        /* Select2 Kütüphanesi için Stil Düzeltmeleri */
        /* =================================== */

        /* Select2 kutusunun genel görünümü */
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            padding: 0.55rem 1rem !important; /* Dikey hizalama için padding ayarı */
            height: auto !important;
            font-size: 1rem !important;
            border: 1px solid #ced4da !important;
        }

        /* Ok (arrow) ikonunun hizalanması */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            right: 10px !important;
            top: 0 !important;
            display: flex;
            align-items: center;
        }

        /* Seçilen metnin hizalanması */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #495057;
        }

        /* Açılan dropdown menüsü */
        .select2-dropdown {
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08) !important;
        }

        /* Menüdeki seçenekler */
        .select2-results__option {
            padding: 0.75rem 1rem !important;
        }

        /* Seçenek üzerine gelindiğinde */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0d6efd !important;
            color: white !important;
        }
    </style>
@endpush
@push('scripts')
    <script>
        // Tümünü seç checkbox'ı için
        $('#select-all').on('click', function () {
            $('input[name="ids[]"]').prop('checked', this.checked);
        });

        $(document).ready(function () {
            // Select2'yi modal içindeki dropdown için etkinleştir
            $('#modalActionSelect').select2({
                // Bu satır, açılır menünün modal içinde kalmasını sağlar. Çok önemli!
                dropdownParent: $('#bulkActionModal'),
                // Arama kutusunu gizlemek için (opsiyonel)
                minimumResultsForSearch: Infinity,
                // Placeholder metnini ayarla
                placeholder: 'İşlem Seç...'
            });

            $('#confirmBulkActionBtn').on('click', function () {
                var selectedAction = $('#modalActionSelect').val();
                if (selectedAction) {
                    var form = $('#bulkActionForm');
                    form.find('input[name="action"]').remove();
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': 'action',
                        'value': selectedAction
                    }));
                    form.submit();
                } else {
                    alert('Lütfen bir işlem seçin.');
                }
            });
        });
    </script>
@endpush
