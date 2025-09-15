@extends('admin.layouts.master')
@section('content3')
    <div class="col-xxl-8 col-lg-8">
        <div class="container">
            <h2>Kategori Ekle</h2>

            <!-- Kategori ekleme formu -->
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Kategori Adı:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Kategori Adı"
                        required>
                </div>

                <div class="form-group">
                    <label for="slug">SEO Uyumlu Slug:</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Kategori Ekle</button>
            </form>
        </div>
    </div>
@endsection
