@extends('admin.layouts.master')
@section('title', 'Tüm Hizmetler')
@section('content')
    {{-- Filtreleme Formu --}}
    <div class="card mb-4">
        <div class="card-header">Filtrele</div>
        <div class="card-body">
            <form action="{{ route('admin.services.index') }}" method="GET" class="row">
                <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Başlıkta Ara..." value="{{ request('search') }}"></div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tüm Durumlar</option>
                        <option value="active" @selected(request('status') == 'active')>Aktif</option>
                        <option value="inactive" @selected(request('status') == 'inactive')>Pasif</option>
                    </select>
                </div>
                <div class="col-md-3"><button type="submit" class="btn btn-primary">Filtrele</button><a href="{{ route('admin.services.index') }}" class="btn btn-secondary ms-2">Sıfırla</a></div>
            </form>
        </div>
    </div>

    {{-- Ana İçerik --}}
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <form action="{{ route('admin.services.bulkAction') }}" method="POST" id="bulk-action-form">
                        @csrf
                        <select name="action" class="form-select w-auto d-inline-block me-2">
                            <option value="">Toplu İşlem Seç</option>
                            <option value="delete">Seçilenleri Çöpe Taşı</option>
                        </select>
                        <button type="submit" class="btn btn-danger">Uygula</button>
                    </form>
                </div>
                <a href="{{ route('admin.services.create') }}" class="btn btn-success">Yeni Hizmet Ekle</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Görsel</th>
                        <th>Başlık</th>
                        <th class="text-center">Sıralama</th>
                        <th class="text-center">Durum</th>
                        <th class="text-center">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $service->id }}" form="bulk-action-form"></td>
                            <td><img src="{{ asset($service->cover_image) }}" alt="{{ $service->title }}" width="80" class="img-thumbnail"></td>
                            <td>{{ Str::limit($service->title, 50) }}</td>
                            <td class="text-center">{{ $service->order }}</td>
                            <td class="text-center">
                                @if ($service->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Pasif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">Düzenle</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu hizmeti çöpe taşımak istediğinizden emin misiniz?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Kayıtlı hizmet bulunamadı.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $services->links() }}</div>
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
