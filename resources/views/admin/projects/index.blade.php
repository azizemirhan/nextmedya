@extends('admin.layouts.master')
@section('title', 'Projeler')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <h5 class="mb-0">Projeler</h5>
                <div class="d-flex gap-2">
                    <form method="GET" class="d-flex gap-2">
                        <input type="text" name="s" class="form-control" placeholder="Ara (başlık/slug)"
                            value="{{ request('s') }}">
                        <select name="status" class="form-select">
                            <option value="">Durum</option>
                            <option value="0" @selected(request('status') === '0')>Devam</option>
                            <option value="1" @selected(request('status') === '1')>Tamam</option>
                        </select>
                        <select name="is_featured" class="form-select">
                            <option value="">Öne çıkar?</option>
                            <option value="1" @selected(request('is_featured') === '1')>Evet</option>
                            <option value="0" @selected(request('is_featured') === '0')>Hayır</option>
                        </select>
                        <button class="btn btn-outline-secondary">Filtrele</button>
                    </form>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Yeni Proje</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Resim</th>
                            <th>Başlık</th>
                            <th>Slug</th>
                            <th>Durum</th>
                            <th>Öne Çıkar</th>
                            <th class="text-end">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td><img src="{{ asset($p->image_path) }}" style="width:100px;"></td>
                                <td>{{ $p->title['tr'] ?? '-' }}</td>
                                <td>{{ $p->slug }}</td>
                                <td>
                                    @if ($p->status === 1)
                                        <span class="badge bg-success">Tamam</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Devam</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($p->is_featured)
                                        <span class="badge bg-primary">Evet</span>
                                    @else
                                        <span class="badge bg-secondary">Hayır</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.projects.edit', $p) }}" class="btn btn-sm btn-light">Düzenle</a>
                                    <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Silmek istediğine emin misin?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Kayıt bulunamadı.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($projects->hasPages())
                <div class="card-footer">{{ $projects->withQueryString()->links() }}</div>
            @endif
        </div>
    </div>
@endsection
