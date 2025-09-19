@extends('admin.layouts.master')
@section('title', 'Tüm Yazılar')
@section('content')

    <div class="card mb-4">
        <div class="card-header">
            Filtrele
        </div>
        <div class="card-body">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Başlıkta Ara..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Tüm Kategoriler</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="author" class="form-select">
                        <option value="">Tüm Yazarlar</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" @selected(request('author') == $author->id)>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tüm Durumlar</option>
                        <option value="published" @selected(request('status') == 'published')>Yayınlandı</option>
                        <option value="draft" @selected(request('status') == 'draft')>Taslak</option>
                        <option value="scheduled" @selected(request('status') == 'scheduled')>Zamanlanmış</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtrele</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Sıfırla</a>
                </div>
            </form>
        </div>
    </div>

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
        </div>
        <div class="widget-content widget-content-area">
            <form action="{{ route('admin.posts.bulkAction') }}" method="POST">
                @csrf
                <div class="d-flex mb-3">
                    <select name="action" class="form-select w-auto me-2">
                        <option value="">Toplu İşlem Seç</option>
                        <option value="delete">Seçilenleri Çöpe Taşı</option>
                    </select>
                    <button type="submit" class="btn btn-danger">Uygula</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Görsel</th>
                                <th>Başlık</th>
                                <th>Yazar</th>
                                <th>Kategori</th>
                                <th class="text-center">Durum</th>
                                <th class="text-center">Tarih</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $post->id }}"></td>
                                    <td>
                                        @if ($post->featured_image)
                                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}"
                                                width="80" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Görsel Yok</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($post->title, 50) }}</td>
                                    <td>{{ $post->user->name ?? 'N/A' }}</td>
                                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        @if ($post->status == 'published')
                                            <span class="badge bg-success">Yayınlandı</span>
                                        @elseif($post->status == 'draft')
                                            <span class="badge bg-secondary">Taslak</span>
                                        @elseif($post->status == 'scheduled')
                                            <span class="badge bg-warning">Zamanlanmış</span>
                                        @else
                                            <span class="badge bg-info">{{ ucfirst($post->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : 'Belirtilmemiş' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                            class="btn btn-sm btn-warning">Düzenle</a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Bu yazıyı çöpe taşımak istediğinizden emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Arama kriterlerine uygun yazı bulunamadı.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="mt-4">{{ $posts->links() }}</div>
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
