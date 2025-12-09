@extends('admin.layouts.master')
@section('title', 'Sayfalar')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0 text-gray-800">Sayfalar</h1>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Yeni Sayfa Ekle
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
                        <th>Başlık</th>
                        <th>URL Uzantısı (Slug)</th>
                        <th>Durum</th>
                        <th>Oluşturulma Tarihi</th>
                        <th class="text-end">Aksiyonlar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pages as $page_item)
                        <tr>
                            <td>
                                <a href="{{ route('admin.pages.edit', $page_item) }}" class="fw-semibold">
                                    {{ $page_item->title }}
                                </a>
                            </td>
                            <td>/{{ $page_item->slug }}</td>
                            <td>
                                @if ($page_item->status == 'published')
                                    <span class="badge bg-success">Yayınlandı</span>
                                @else
                                    <span class="badge bg-secondary">Taslak</span>
                                @endif
                            </td>
                            <td>{{ $page_item->created_at->format('d.m.Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.pages.edit', $page_item) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.pages.destroy', $page_item) }}" method="POST"
                                      class="d-inline" onsubmit="return confirm('Bu sayfayı silmek istediğinize emin misiniz?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted p-4">Hiç sayfa bulunamadı</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                @if ($pages->hasPages())
                    <div class="mt-3">
                        {{ $pages->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
