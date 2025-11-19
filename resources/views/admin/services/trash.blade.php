@extends('admin.layouts.master')
@section('title', 'Hizmetler - Çöp Kutusu')
@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Çöp Kutusundaki Hizmetler</h4>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Hizmetlere Dön
                </a>
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

            <form action="{{ route('admin.services.bulkAction') }}" method="POST" id="bulk-action-form">
                @csrf
                <div class="d-flex mb-3">
                    <select name="action" class="form-select w-auto me-2">
                        <option value="">Toplu İşlem Seç</option>
                        <option value="restore">Seçilenleri Geri Yükle</option>
                        <option value="force-delete">Seçilenleri Kalıcı Sil</option>
                    </select>
                    <button type="submit" class="btn btn-danger">Uygula</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="select-all"></th>
                            <th width="100">Görsel</th>
                            <th>Başlık</th>
                            <th width="150">Silinme Tarihi</th>
                            <th class="text-center" width="200">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $service->id }}"></td>
                                <td>
                                    @if($service->cover_image)
                                        <img src="{{ asset($service->cover_image) }}" alt="{{ $service->title }}" width="60" class="img-thumbnail">
                                    @else
                                        <span class="badge bg-secondary">Görsel Yok</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($service->title, 60) }}</td>
                                <td>{{ $service->deleted_at->format('d.m.Y H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.services.restore', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Geri Yükle" onclick="return confirm('Bu hizmeti geri yüklemek istediğinizden emin misiniz?');">
                                            <i class="fas fa-undo"></i> Geri Yükle
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.services.forceDelete', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu hizmeti KALICI olarak silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Kalıcı Sil">
                                            <i class="fas fa-trash-alt"></i> Kalıcı Sil
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Çöp kutusu boş.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

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

                        if (action === 'restore') {
                            return confirm(`Seçili ${checkedBoxes.length} hizmeti geri yüklemek istediğinizden emin misiniz?`);
                        }

                        if (action === 'force-delete') {
                            return confirm(`UYARI: Seçili ${checkedBoxes.length} hizmet KALICI olarak silinecek!\n\nBu işlem geri alınamaz. Devam etmek istediğinizden emin misiniz?`);
                        }

                        return true;
                    });
                }
            });
        </script>
    @endpush
@endsection