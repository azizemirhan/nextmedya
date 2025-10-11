@extends('admin.layouts.master')

@section('title', 'Yeni İstatistik Ekle')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Yeni İstatistik Ekle</h4>
        </div>

        <form action="{{ route('admin.statistics.store') }}" method="POST">
            @csrf

            {{-- FORM PARTIAL --}}
            {{-- _form.blade.php içinde ikon pickeri için şu alan olmalı:
                 <div class="mb-3">
                     <label class="form-label">İkon Sınıfı (opsiyonel)</label>
                     <div class="input-group">
                         <button class="btn btn-outline-secondary" role="iconpicker"
                                 data-iconset="fontawesome5"
                                 data-icon="{{ old('icon', $statistic->icon ?? 'fas fa-star') }}"></button>
                         <input type="hidden" name="icon" value="{{ old('icon', $statistic->icon ?? 'fas fa-star') }}">
                     </div>
                 </div>
            --}}
            @include('admin.statistics._form')
        </form>
    </div>
@endsection
