@extends('admin.layouts.master')

@section('title', 'İstatistikler')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">İstatistikler</h5>
                <div>
                    <form method="GET" class="d-inline">
                        <input type="text" name="s" class="form-control d-inline-block w-auto"
                               placeholder="Ara (başlık/sayı)" value="{{ request('s') }}">
                        <button class="btn btn-outline-secondary">Filtrele</button>
                    </form>
                    <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary ms-2">+ Yeni İstatistik</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>İkon</th>
                        <th>Başlık</th>
                        <th>Sayı</th>
                        <th>Sıra</th>
                        <th class="text-end">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($statistics as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>
                                @if($s->icon)
                                    {{-- Basit preview: icon class varsa i etiketiyle göster --}}
                                    <i class="{{ $s->icon }}" style="font-size:20px"></i>
                                    <div class="text-muted small">{{ $s->icon }}</div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $s->title['tr'] ?? $s->title['en'] ?? '' }}</td>
                            <td>{{ $s->number }}</td>
                            <td>{{ $s->order }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.statistics.edit', $s) }}" class="btn btn-sm btn-light">Düzenle</a>
                                <form action="{{ route('admin.statistics.destroy', $s) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">Kayıt bulunamadı.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if ($statistics->hasPages())
                <div class="card-footer">
                    {{ $statistics->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
