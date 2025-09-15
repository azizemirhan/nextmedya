
@extends('user.layouts.master')
@section('custom_header')
    @include('layouts.header-dark')
@endsection
@section('content2')
    <div class="col-xxl-8 col-lg-8">
        <div class="profile__tab-content">
            <div class="tab-content" id="profile-tabContent">
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="profile__main">
                        <div class="profile__main-top pb-80">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <div class="profile__main-inner d-flex flex-wrap align-items-center">
                                        <?php $user = auth()->user(); ?>
                                        <form action="{{ route('profile.image.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="profile__main-thumb">
                                                <img src="{{ $user->image ? asset('uploads/avatars/' . $user->image) : asset('site/assets/img/avatar/avata.jpg') }}"
                                                    alt="">
                                                <div class="profile__main-thumb-edit">
                                                    <input id="profile-thumb-input" class="profile-img-popup" name="image"
                                                        type="file" onchange="this.form.submit();">
                                                    <label for="profile-thumb-input"><i
                                                            class="fa-light fa-camera"></i></label>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="profile__main-content">

                                            <h4 class="profile__main-title mt-30">{{ $user->name }}</h4>
                                            <p> projelerinizin yönetimi, hizmet taleplerinizin takibi ve ödeme
                                                işlemlerinizin hızlıca gerçekleştirilebilmesi için tasarlanmış kapsamlı bir
                                                yönetim platformudur. Tüm dijital çözümlerimize tek bir merkezden
                                                erişebilir, proje ilerlemelerini anlık olarak izleyebilir, destek
                                                taleplerinizi yönetebilir ve iş süreçlerinizi kolaylıkla optimize
                                                edebilirsiniz.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="profile__main-logout text-sm-end">

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-responsive-nav-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                {{ __('Çıkış Yap') }}
                                            </x-responsive-nav-link>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile__main-info">
                            <div class="row gx-3">
                                <div class="col-md-3 col-sm-6">
                                    <div class="profile__main-info-item">
                                        <div class="profile__main-info-icon">
                                            <span>
                                                <img width="50" height="50"
                                                    src="https://img.icons8.com/ios-filled/100/domain.png" alt="domain" />
                                            </span>
                                        </div>
                                        <h4 class="profile__main-info-title">Sitelerim</h4>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="profile__main-info-item">
                                        <div class="profile__main-info-icon">
                                            <span>
                                                <img width="50" height="50"
                                                    src="https://img.icons8.com/dotty/80/laptop-settings.png"
                                                    alt="laptop-settings" /> </span>
                                        </div>
                                        <h4 class="profile__main-info-title">Yazılımlarım</h4>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="profile__main-info-item">
                                        <div class="profile__main-info-icon">
                                            <span>
                                                <img width="50" height="50"
                                                    src="https://img.icons8.com/ios/50/licence.png" alt="licence" />
                                            </span>
                                        </div>
                                        <h4 class="profile__main-info-title">Lisanslarım</h4>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="profile__main-info-item">
                                        <div class="profile__main-info-icon">
                                            <span>
                                                <img width="50" height="50"
                                                    src="https://img.icons8.com/ios/50/signing-a-document.png"
                                                    alt="signing-a-document" />
                                            </span>
                                        </div>
                                        <h4 class="profile__main-info-title">Sözleşmelerim</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
