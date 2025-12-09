@extends('admin.layouts.master')

@section('title', 'Özellik Düzenle')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Özellik Düzenle</h4>
        </div>

        <form action="{{ route('admin.features.update', $feature) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.features._form')
        </form>
    </div>
@endsection
