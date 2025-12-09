@extends('admin.layouts.master')

@section('title', 'Yeni Özellik Ekle')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Yeni Özellik Ekle</h4>
        </div>

        <form action="{{ route('admin.features.store') }}" method="POST">
            @csrf
            @include('admin.features._form')
        </form>
    </div>
@endsection
