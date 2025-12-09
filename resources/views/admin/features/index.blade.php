@extends('admin.layouts.master')

@section('title', 'Özellikler')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Özellikler</h5>
                <div>
                    <form method="GET" class="d-inline">
                        <input type="text" name="s" class="form-control d-inline-block w-auto"
                               placeholder="Ara (başlık/açıklama)" value="{{ request('s') }}">
                        <button class="btn btn-outline-secondary">Filtrele</button>
                    </form>
                    <a href="{{ route('admin.features.create') }}" class="btn btn-primary ms-2">+ Yeni Özellik</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>Sıra</th>
                        <th class="text-end">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($features as $f)
                        <tr>
                            <td>{{ $f->id }}</td>
                            <td>{{ $f->title['tr'] ?? $f->title['en'] ?? '' }}</td>
                            <td class="text-truncate" style="max-width:300px;">
                                {{ Str::limit($f->description['tr'] ?? $f->description['en'] ?? '', 100) }}
                            </td>
                            <td>{{ $f->order }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.features.edit', $f) }}" class="btn btn-sm btn-light">Düzenle</a>
                                <form action="{{ route('admin.features.destroy', $f) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">Kayıt bulunamadı.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if ($features->hasPages())
                <div class="card-footer">
                    {{ $features->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
