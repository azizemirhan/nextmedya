@extends('admin.layouts.master')

@section('title', 'Müşteri Görüşleri')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <h5 class="mb-0">Müşteri Görüşleri</h5>
                <div class="d-flex gap-2">
                    {{-- Filtre Formu --}}
                    <form method="GET" class="d-flex gap-2">
                        <input type="text" name="s" class="form-control"
                               placeholder="Ara (isim/şirket/içerik)"
                               value="{{ request('s') }}">
                        <select name="is_active" class="form-select">
                            <option value="">Durum</option>
                            <option value="1" @selected(request('is_active')==='1')>Aktif</option>
                            <option value="0" @selected(request('is_active')==='0')>Pasif</option>
                        </select>
                        <button class="btn btn-outline-secondary">Filtrele</button>
                    </form>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Yeni Görüş</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>İsim</th>
                        <th>Şirket</th>
                        <th>Yorum</th>
                        <th>Sıra</th>
                        <th>Durum</th>
                        <th class="text-end">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($testimonials as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>
                                @if($t->image_path)
                                    <img src="{{ asset($t->image_path) }}" alt=""
                                         style="width:56px;height:56px;object-fit:cover;border-radius:50%;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $t->name['tr'] ?? $t->name['en'] ?? '' }}</td>
                            <td>{{ $t->company['tr'] ?? $t->company['en'] ?? '' }}</td>
                            <td class="text-truncate" style="max-width:260px;">
                                {{ Str::limit($t->content['tr'] ?? $t->content['en'] ?? '', 120) }}
                            </td>
                            <td>{{ $t->order }}</td>
                            <td>
                                @if ($t->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Pasif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.testimonials.edit', $t) }}"
                                   class="btn btn-sm btn-light">Düzenle</a>
                                <form action="{{ route('admin.testimonials.destroy', $t) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Silmek istediğine emin misin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Kayıt bulunamadı.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if ($testimonials->hasPages())
                <div class="card-footer">
                    {{ $testimonials->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
