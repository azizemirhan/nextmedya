@extends('admin.layouts.blank') {{-- Sadece temel CSS ve JS içeren boş bir layout dosyası --}}

@section('title', 'Oturum Kilitli')

@push('styles')
    {{-- Bu sayfa için özel CSS dosyaları --}}
    <link href="{{ asset('backend/src/assets/css/light/authentication/auth-boxed.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/src/assets/css/dark/authentication/auth-boxed.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="auth-container d-flex h-100">
        <div class="container mx-auto align-self-center">
            <div class="row">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            {{-- auth() -> auth('admin') olarak güncellendi --}}
                            @if(auth('admin')->check())
                                <form action="{{ route('unlock') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="media mb-4">
                                                <div class="avatar avatar-lg me-3">
                                                    <img alt="avatar"
                                                         src="{{ auth('admin')->user()->image ? asset(auth('admin')->user()->image) : asset('backend/src/assets/img/profile-30.png') }}"
                                                         class="rounded-circle">
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <h3 class="mb-0">{{ auth('admin')->user()->name }}</h3>
                                                    <p class="mb-0">Oturumunuzu açmak için şifrenizi girin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label class="form-label">Şifre</label>
                                                <input type="password" name="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       required>
                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <button class="btn btn-secondary w-100" type="submit">KİLİDİ AÇ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <p class="text-center text-danger">Kullanıcı oturumu bulunamadı. Lütfen tekrar giriş yapın.</p>
                                <a href="{{ route('admin.login') }}" class="btn btn-primary w-100">Giriş Sayfasına Dön</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
