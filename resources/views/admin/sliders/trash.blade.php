@extends('admin.layouts.master')

@section('title', 'Slider Çöp Kutusu')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0 text-gray-800">Slider Çöp Kutusu</h1>
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Slider Listesine Dön
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Başlık (TR)</th>
                            <th>Silinme Tarihi</th>
                            <th class="text-end">Aksiyonlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    <img src="{{ asset($slider->image_path) }}" alt="Slider Görseli"
                                        style="width: 150px; height: auto; border-radius: 5px;">
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $slider->getTranslation('title', 'tr') }}</span>
                                </td>
                                <td>{{ $slider->deleted_at->format('d.m.Y H:i') }}</td>
                                <td class="text-end">
                                    {{-- Geri Yükle Formu --}}
                                    <form action="{{ route('admin.sliders.restore', $slider->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-counterclockwise"></i> Geri Yükle
                                        </button>
                                    </form>

                                    {{-- Kalıcı Sil Formu --}}
                                    <form action="{{ route('admin.sliders.forceDelete', $slider->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Bu slider\'ı KALICI OLARAK silmek istediğinize emin misiniz? Bu işlem geri alınamaz!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i> Kalıcı Olarak Sil
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted p-4">Çöp kutusu boş</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($sliders->hasPages())
                    <div class="mt-3">
                        {{ $sliders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection