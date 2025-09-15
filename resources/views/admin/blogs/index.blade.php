@extends('admin.layouts.master')
@section('content3')
    <div class="col-xxl-8 col-lg-8">
        <h1 class="my-4">Blog Yazıları</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">Yeni Yazı Ekle</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bu yazıyı silmek istediğinizden emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
