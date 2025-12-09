@extends('admin.layouts.master')
@section('title', 'Profilimi Düzenle')

@section('content')
    {{-- DOSYA YÜKLEME İÇİN ENCTYPE EKLENDİ --}}
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Profil Resmi</h5></div>
            <div class="card-body text-center">
                @if ($user->image)
                    <img src="{{ asset($user->image) }}" alt="Profil Resmi" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    {{-- Varsayılan resim yolu --}}
                    <img src="{{ asset('backend/src/assets/img/profile-30.png') }}" alt="Profil Resmi" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px;">
                @endif
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Profil Bilgileri</h5></div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Ad Soyad</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                           required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-posta Adresi</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', $user->email) }}" required>
                </div>
                <hr>
                <p class="text-muted">Şifrenizi değiştirmek istemiyorsanız bu alanları boş bırakın.</p>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Yeni Şifre</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Yeni Şifre Tekrar</label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation">
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </div>
    </form>
@endsection
