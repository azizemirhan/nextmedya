@extends('admin.layouts.master')

@section('title', 'Slider Düzenle')

@section('content')
    <div class="middle-content container-xxl p-0">
        {{-- BREADCRUMBS --}}
        <div class="secondary-nav">
            <div class="breadcrumbs-container">
                <header class="header navbar navbar-expand-sm">
                    {{-- ... (Verdiğiniz şablondaki header kodunu buraya kopyalayabilirsiniz) ... --}}
                    {{-- Başlık ve Breadcrumb'ları Slider için güncelleyin --}}
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                                <h5 class="mb-0">Slider Düzenle</h5>
                            </div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Slider</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Düzenle</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        {{-- END BREADCRUMBS --}}
        
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Ortak Form Alanlarını Dahil Et --}}
            @include('admin.sliders._form')

            <div class="d-flex gap-2 mx-3 my-3">
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">Vazgeç</a>
                <button type="submit" class="btn btn-success">Güncelle</button>
            </div>
        </form>
    </div>
@endsection