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
                <div>
                    <a href="{{ route('admin.services.trash') }}" class="btn btn-warning me-2">
                        <i class="fas fa-trash"></i> Çöp Kutusu
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Yeni Hizmet Ekle
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="30"><input type="checkbox" id="select-all"></th>
                        <th width="100">Görsel</th>
                        <th>Başlık</th>
                        <th class="text-center" width="100">Sıralama</th>
                        <th class="text-center" width="100">Durum</th>
                        <th class="text-center" width="180">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $service->id }}" form="bulk-action-form"></td>
                            <td>
                                @if($service->cover_image)
                                    <img src="{{ asset($service->cover_image) }}" alt="{{ $service->title }}" width="80" class="img-thumbnail">
                                @else
                                    <span class="badge bg-secondary">Görsel Yok</span>
                                @endif
                            </td>
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
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning" title="Düzenle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu hizmeti çöpe taşımak istediğinizden emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Sil">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
            document.addEventListener('DOMContentLoaded', function() {
                // Tümünü seç/kaldır
                const selectAll = document.getElementById('select-all');
                if (selectAll) {
                    selectAll.addEventListener('change', function() {
                        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });
                }

                // Form gönderiminde en az bir checkbox seçili mi kontrol et
                const bulkForm = document.getElementById('bulk-action-form');
                if (bulkForm) {
                    bulkForm.addEventListener('submit', function(e) {
                        const action = this.querySelector('select[name="action"]').value;
                        const checkedBoxes = this.querySelectorAll('input[name="ids[]"]:checked');

                        if (!action) {
                            e.preventDefault();
                            alert('Lütfen bir işlem seçin!');
                            return false;
                        }

                        if (checkedBoxes.length === 0) {
                            e.preventDefault();
                            alert('Lütfen en az bir hizmet seçin!');
                            return false;
                        }

                        if (action === 'delete') {
                            return confirm(`Seçili ${checkedBoxes.length} hizmeti çöp kutusuna taşımak istediğinizden emin misiniz?`);
                        }

                        return true;
                    });
                }
            });
        </script>
    @endpush
@endsection