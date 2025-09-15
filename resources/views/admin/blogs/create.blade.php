@extends('admin.layouts.master')
@section('content3')
    <div class="col-xxl-8 col-lg-8">
        <div class="container">
            <h1 class="my-4">Yeni Blog Yazısı Ekle</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Başlık</label>
                    <input type="text" class="form-control" id="title" name="title" required
                        value="{{ old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">İçerik</label>
                    <textarea class="form-control" id="summernote" name="content" rows="5" required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="meta_title" class="form-label">SEO Başlığı</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ old('meta_title') }}">
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">SEO Açıklaması</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">SEO Anahtar Kelimeleri</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                        value="{{ old('meta_keywords') }}">
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Öne Çıkan Görsel</label>
                    <input type="file" class="form-control" id="featured_image" name="featured_image">
                </div>

                <div class="mb-3">
                    <label for="published_at" class="form-label">Yayın Tarihi</label>
                    <input type="date" class="form-control" id="published_at" name="published_at"
                        value="{{ old('published_at') }}">
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">Yazar</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('author_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Durum</label>
                    <select class="form-control" id="status" name="status">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Taslak</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Yayınlandı</option>
                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Arşivlendi</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Yazıyı Kaydet</button>
            </form>
        </div>
    </div>
@endsection
