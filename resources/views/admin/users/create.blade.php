@extends('admin.layouts.master')
@section('title', 'Yeni Kullanıcı Oluştur')
@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- Genel Bilgiler ve Notlar --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header"><h5 class="mb-0">Genel Bilgiler</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label for="name" class="form-label">Ad Soyad</label><input type="text" class="form-control" id="name" name="name" required></div>
                            <div class="col-md-6 mb-3"><label for="profession" class="form-label">Meslek</label><input type="text" class="form-control" id="profession" name="profession"></div>
                            <div class="col-md-6 mb-3"><label for="country" class="form-label">Ülke</label><input type="text" class="form-control" id="country" name="country"></div>
                            <div class="col-md-6 mb-3"><label for="address" class="form-label">Adres</label><input type="text" class="form-control" id="address" name="address"></div>
                            <div class="col-md-6 mb-3"><label for="location" class="form-label">Konum</label><input type="text" class="form-control" id="location" name="location"></div>
                            <div class="col-md-6 mb-3"><label for="phone" class="form-label">Telefon</label><input type="text" class="form-control" id="phone" name="phone"></div>
                            <div class="col-md-6 mb-3"><label for="email" class="form-label">E-posta</label><input type="email" class="form-control" id="email" name="email" required></div>
                            <div class="col-md-6 mb-3"><label for="website" class="form-label">Website</label><input type="url" class="form-control" id="website" name="website"></div>
                            <div class="col-md-6 mb-3"><label for="password" class="form-label">Şifre</label><input type="password" class="form-control" id="password" name="password" required></div>
                            <div class="col-md-6 mb-3"><label for="password_confirmation" class="form-label">Şifre Tekrar</label><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header"><h5 class="mb-0">Sosyal Medya</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label for="social_linkedin" class="form-label">LinkedIn</label><input type="text" class="form-control" id="social_linkedin" name="socials[linkedin]"></div>
                            <div class="col-md-6 mb-3"><label for="social_twitter" class="form-label">Twitter</label><input type="text" class="form-control" id="social_twitter" name="socials[twitter]"></div>
                            <div class="col-md-6 mb-3"><label for="social_facebook" class="form-label">Facebook</label><input type="text" class="form-control" id="social_facebook" name="socials[facebook]"></div>
                            <div class="col-md-6 mb-3"><label for="social_github" class="form-label">Github</label><input type="text" class="form-control" id="social_github" name="socials[github]"></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Notlar</h5></div>
                    <div class="card-body"><textarea name="notes" class="form-control" rows="5"></textarea></div>
                </div>
            </div>
            {{-- Profil Resmi ve Roller --}}
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header"><h5 class="mb-0">Profil Resmi</h5></div>
                    <div class="card-body"><input type="file" name="image" class="form-control"></div>
                </div>
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Roller ve Yetkiler</h5></div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" role="switch" id="is_admin" name="is_admin" value="1"><label class="form-check-label" for="is_admin">Yönetici (Admin) mi?</label></div><hr>
                        <h6>Roller</h6>
                        @foreach ($roles as $role)
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}"><label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label></div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-3"><button type="submit" class="btn btn-primary w-100">Kullanıcıyı Oluştur</button></div>
            </div>
        </div>
    </form>
@endsection
