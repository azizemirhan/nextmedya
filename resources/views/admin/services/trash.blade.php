@extends('admin.layouts.master')
@section('title', 'Hizmetler - Çöp Kutusu')
@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <form action="{{ route('admin.services.bulkAction') }}" method="POST">
                @csrf
                <div class="d-flex mb-3">
                    <select name="action" class="form-select w-auto me-2"><option value="">Toplu İşlem Seç</option><option value="restore">Seçilenleri Geri Yükle</option><option value="force-delete">Seçilenleri Kalıcı Sil</option></select>
                    <button type="submit" class="btn btn-danger">Uygula</button>
                </div>
                <table class="table table-bordered">
                    <thead><tr><th><input type="checkbox" id="select-all"></th><th>Başlık</th><th>Silinme Tarihi</th><th class="text-center">İşlemler</th></tr></thead>
                    <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $service->id }}"></td>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->deleted_at->format('d M Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.services.restore', $service->id) }}" class="btn btn-sm btn-success">Geri Yükle</a>
                                <form action="{{ route('admin.services.forceDelete', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu hizmeti KALICI olarak silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Kalıcı Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Çöp kutusu boş.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </form>
            <div class="mt-4">{{ $services->links() }}</div>
        </div>
    </div>
    @push('scripts')<script>$('#select-all').on('click', function() { $('input[name="ids[]"]').prop('checked', this.checked); });</script>@endpush
@endsection
