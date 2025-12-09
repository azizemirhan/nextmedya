@extends('admin.layouts.master')

@section('title', 'Yeni Slider')

@section('content')
    <div class="middle-content container-xxl p-0 mt-4">
        {{-- BREADCRUMBS --}}
        <div class="secondary-nav">
            <div class="breadcrumbs-container">
                <header class="header navbar navbar-expand-sm">
                    {{-- ... (Verdiğiniz şablondaki header kodunu buraya kopyalayabilirsiniz) ... --}}
                    {{-- Başlık ve Breadcrumb'ları Slider için güncelleyin --}}
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                                <h5 class="mb-0">Yeni Slider</h5>
                            </div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Slider</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        {{-- END BREADCRUMBS --}}

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Ortak Form Alanlarını Dahil Et --}}
            @include('admin.projects._form', ['slider' => new \App\Models\Slider()])

            <div class="d-flex gap-2 mx-3 my-3">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Vazgeç</a>
                <button type="submit" class="btn btn-success">Kaydet</button>
            </div>
        </form>
    </div>
@endsection
