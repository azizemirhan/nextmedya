@extends('user.layouts.master')
@section('content2')
    <div class="col-xxl-8 col-lg-8">
        <div class="profile__tab-content">
            <div class="tab-content" id="profile-tabContent">
                <div class="tab-pane fade active show">
                    <div class="profile__info">
                        <h3 class="profile__info-title">Kullanıcı Bilgileri</h3>
                        <div class="profile__info-content">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="text" name="name" placeholder="Adınız"
                                                    value="{{ old('name', auth()->user()->name) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="email" name="email" placeholder="Email"
                                                    value="{{ old('email', auth()->user()->email) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="text" name="facebook"
                                                    placeholder="Facebook kullanıcı adınız"
                                                    value="{{ old('facebook', auth()->user()->facebook) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="text" name="twitter" placeholder="Twitter kullanıcı adınız"
                                                    value="{{ old('twitter', auth()->user()->twitter) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="text" name="phone" placeholder="Telefon Numaranız"
                                                    value="{{ old('phone', auth()->user()->phone) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <select name="gender">
                                                    <option value="">Cinsiyet Seçin</option>
                                                    <option value="Erkek"
                                                        {{ auth()->user()->gender == 'Erkek' ? 'selected' : '' }}>Erkek
                                                    </option>
                                                    <option value="Kadın"
                                                        {{ auth()->user()->gender == 'Kadın' ? 'selected' : '' }}>Kadın
                                                    </option>
                                                    <option value="SöylemeyiTercihEtmiyorum"
                                                        {{ auth()->user()->gender == 'SöylemeyiTercihEtmiyorum' ? 'selected' : '' }}>Söylemeyi Tercih Etmiyorum
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <input type="text" name="address" placeholder="Adresiniz"
                                                    value="{{ old('address', auth()->user()->address) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="profile__input-box">
                                            <div class="profile__input">
                                                <textarea name="bio" placeholder="Biyografiniz">{{ old('bio', auth()->user()->bio) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="profile__btn">
                                            <button type="submit" class="tp-btn-cart sm">Profili Güncelle</button>
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
