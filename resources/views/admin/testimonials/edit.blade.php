@extends('admin.layouts.master')

@section('title', 'Görüşü Düzenle')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Görüşü Düzenle</h4>
        </div>

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.testimonials._form')
        </form>
    </div>
@endsection
