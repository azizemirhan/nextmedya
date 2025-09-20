@extends('admin.layouts.master')
@section('title', 'Tüm İzinler')

@section('content')
    <div class="card">
        <div class="card-header"><h5 class="mb-0">Sistem İzinleri</h5></div>
        <div class="card-body">
            <p>İzinler seeder dosyası üzerinden yönetilmektedir.</p>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-4">
                        <span class="badge bg-secondary mb-2">{{ $permission->name }} ({{ $permission->slug }})</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
