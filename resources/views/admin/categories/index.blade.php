@extends('admin.layouts.master')

@section('title', 'Blog Kategorileri')

@section('content')
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
                        <h4>Tüm Kategoriler</h4>
                        <div>
                            <a href="{{ route('admin.categories.trash') }}" class="btn btn-dark">Çöp Kutusu</a>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Yeni Kategori Ekle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <form action="{{ route('admin.categories.bulkAction') }}" method="POST">
                    @csrf
                    <div class="d-flex mb-3">
                        <select name="action" class="form-select w-auto me-2">
                            <option value="">Toplu İşlem Seç</option>
                            <option value="delete">Seçilenleri Çöpe Taşı</option>
                        </select>
                        <button type="submit" class="btn btn-danger">Uygula</button>
                    </div>

                    <div class="table-responsive">
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
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Toplu seçim için checkbox
                $('#select-all').on('click', function() {
                    $('input[name="ids[]"]').prop('checked', this.checked);
                });

                // --- YENİ: Status Switch için AJAX Kodu ---
                $('.status-switch').on('change', function() {
                    let isChecked = $(this).is(':checked');
                    let categoryId = $(this).data('id');

                    $.ajax({
                        url: "{{ route('admin.categories.updateStatus') }}",
                        type: 'POST',
                        data: {
                            id: categoryId,
                            is_active: isChecked,
                            _token: "{{ csrf_token() }}" // CSRF token'ı göndermeyi unutma!
                        },
                        success: function(response) {
                            // Başarılı olduğunda SweetAlert ile bildirim göster
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
                        error: function(xhr) {
                            // Hata durumunda konsola yazdır ve bildirim göster
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
            });
        </script>
    @endpush
@endsection
