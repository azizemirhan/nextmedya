@extends('admin.layouts.master')
@section('content3')
    <div class="col-xxl-8 col-lg-8">
        <div class="container">
            <h1 class="my-4">Blog Yazısını Düzenle</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Başlık</label>
                    <input type="text" class="form-control" id="title" name="title" required
                        value="{{ old('title', $post->title) }}">
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required
                        value="{{ old('slug', $post->slug) }}">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">İçerik</label>
                    <textarea class="form-control" id="summernote" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="meta_title" class="form-label">SEO Başlığı</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $post->meta_title) }}">
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">SEO Açıklaması</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">SEO Anahtar Kelimeleri</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                        value="{{ old('meta_keywords', $post->meta_keywords) }}">
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Öne Çıkan Görsel</label>
                    @if ($post->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset($post->featured_image) }}" alt="Öne Çıkan Görsel" class="img-fluid rounded"
                                style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="featured_image" name="featured_image">
                </div>

                <div class="mb-3">
                    <label for="published_at" class="form-label">Yayın Tarihi</label>
                    <input type="date" class="form-control" id="published_at" name="published_at"
                        value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">Yazar</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('author_id', $post->author_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Durum</label>
                    <select class="form-control" id="status" name="status">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Taslak
                        </option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                            Yayınlandı</option>
                        <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>
                            Arşivlendi</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Yazıyı Güncelle</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#summernote').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        uploadImage(files[i]);
                    }
                }
            }
        });

        function uploadImage(file) {
            var data = new FormData();
            data.append("file", file);
            $.ajax({
                url: "{{ route('admin.posts.uploadImage') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#summernote').summernote('insertImage', response.url);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
    </script>
@endpush
