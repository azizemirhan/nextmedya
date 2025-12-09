@extends('admin.layouts.master')

@section('title', 'Yeni Görüş Ekle')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Yeni Görüş Ekle</h4>
        </div>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.testimonials._form')
        </form>
    </div>
@endsection
