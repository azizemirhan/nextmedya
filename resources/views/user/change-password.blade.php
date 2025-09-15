@extends('user.layouts.master')
@section('content2')
    <div class="col-xxl-8 col-lg-8">
        <div class="profile__tab-content">
            <div class="tab-content" id="profile-tabContent">
                <div class="tab-pane fade active show">
                    <div class="profile__info">
                        <h3 class="profile__info-title">Şifre Sıfırlama</h3>
                        <div class="profile__info-content">
                            <form action="{{ route('profile.change-password') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-xxl-12">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="password" name="current_password" placeholder="Mevcut Şifre"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="password" name="new_password" placeholder="Yeni Şifre"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="password" name="new_password_confirmation"
                                                    placeholder="Yeni Şifre (Tekrar)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="profile__btn">
                                            <button type="submit" class="tp-btn-cart sm">Şifreyi Güncelle</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
