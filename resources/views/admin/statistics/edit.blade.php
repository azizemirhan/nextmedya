@extends('admin.layouts.master')

@section('title', 'İstatistik Düzenle')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">İstatistik Düzenle</h4>
        </div>

        <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.statistics._form')
        </form>
    </div>
@endsection
