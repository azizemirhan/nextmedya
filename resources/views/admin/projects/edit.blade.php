@extends('admin.layouts.master')


@section('title', 'Proje Düzenle')


@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Proje Düzenle</h4>
        </div>
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.projects._form')
        </form>
    </div>
@endsection
