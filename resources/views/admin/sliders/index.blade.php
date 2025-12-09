@extends('admin.layouts.master')

@section('title', 'Slider Yönetimi')

@section('content')
    <div class="container-fluid mt-4">

        {{-- Üst Başlık & Buton --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0 text-gray-800">Slider Yönetimi</h1>
        </div>

        {{-- Arama & Filtre --}}
        <form method="GET" action="{{ route('admin.sliders.index') }}" class="mb-3">
            <div class="row g-2" style="align-items: center;">
                <div class="col-md-2">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                        placeholder="Başlıkta ara...">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Durum (tümü)</option>
                        <option value="1" @selected(request('status') == '1')>Aktif</option>
                        <option value="0" @selected(request('status') == '0')>Pasif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary w-100" type="submit">
                        <i class="bi bi-search"></i> Ara
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.sliders.trash') }}" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Çöp Kutusu
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle"></i> Yeni Slider
                    </a>
                </div>
            </div>
        </form>

        {{-- Slider Tablosu --}}
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Görsel</th>
                            <th>Başlık (TR)</th>
                            <th>Durum</th>
                            <th class="text-end">Aksiyonlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>{{ $slider->order }}</td>
                                <td>
                                    <img src="{{ asset($slider->image_path) }}" alt="Slider Görseli"
                                        style="width: 100px; height: auto; border-radius: 5px;">
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $slider->getTranslation('title', 'tr') }}</span>
                                </td>
                                <td>
                                    @if ($slider->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Pasif</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Bu slider\'ı silmek istediğinize emin misiniz?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted p-4">Hiç slider bulunamadı</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Sayfalama --}}
                @if ($sliders->hasPages())
                    <div class="mt-3">
                        {{ $sliders->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
