@extends('admin.layouts.master')


@section('title', 'Proje Ekle')


@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Proje Ekle</h4>
        </div>


        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            @include('admin.projects._form')
        </form>
    </div>
@endsection
