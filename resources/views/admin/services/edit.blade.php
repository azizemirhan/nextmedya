@extends('admin.layouts.master')
@section('title', 'Hizmet Düzenle')
@section('content')
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.services._form', ['service' => $service, 'activeLanguages' => $activeLanguages])
    </form>
@endsection
