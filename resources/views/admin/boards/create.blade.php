@extends('admin.layouts.master')
@section('title', 'Create New Board')

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="secondary-nav">
            {{-- Breadcrumb --}}
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Yeni Pano Oluştur</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.boards.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Pano Adı</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Açıklama</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="visibility" class="form-label">Görünürlük</label>
                                <select class="form-select" id="visibility" name="visibility">
                                    <option value="private" selected>Özel (Sadece üyeler)</option>
                                    <option value="team">Takım (Tüm takım üyeleri)</option>
                                    <option value="public">Herkese Açık</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Oluştur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
