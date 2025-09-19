@extends('admin.layouts.master')

@section('title', 'Çöp Kutusu')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Silinmiş Kategoriler</h5>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Geri Dön</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.bulkAction') }}" method="POST">
                @csrf
                <div class="d-flex mb-3">
                    <select name="action" class="form-select w-auto me-2">
                        <option value="">Toplu İşlem Seç</option>
                        <option value="restore">Seçilenleri Geri Yükle</option>
                        <option value="force-delete">Seçilenleri Kalıcı Sil</option>
                    </select>
                    <button type="submit" class="btn btn-danger">Uygula</button>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>İsim</th>
                            <th>Silinme Tarihi</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $category->id }}"></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->deleted_at->format('d M Y H:i') }}</td>
                                <td>
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
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#select-all').on('click', function() {
                $('input[name="ids[]"]').prop('checked', this.checked);
            });
        </script>
    @endpush
@endsection
