@extends('admin.layouts.master')
@section('title', 'Yeni Hizmet Ekle')
@section('content')
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.services._form', ['service' => new \App\Models\Service(), 'activeLanguages' => $activeLanguages])
    </form>
@endsection
