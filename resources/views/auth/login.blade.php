@extends('layouts.master')
@section('custom_header')
    @include('layouts.header-dark')
@endsection
@section('content')
    <section class="tp-login-area pt-180 pb-140 p-relative z-index-1 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="tp-login-wrapper">
                        <div class="tp-login-top text-center mb-30">
                            <h3 class="tp-login-title">Müşteri Paneli</h3>
                            <p>Hesabınız yok mu? <span><a href="{{ route('register') }}" style="font-weight: 600; color: #000"> Şimdi kayıt olun</a></span></p>
                        </div>

                        <div class="tp-login-option">
                            <div class="tp-login-mail text-center mb-40">
                                <p>veya giriş yap</p>
                            </div>

                            <form id="login-form">
                                @csrf

                                <div class="tp-login-input-wrapper">
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input-title">
                                            <label for="email">Email Adresiniz</label>
                                        </div>
                                        <div class="tp-login-input">
                                            <input id="email" name="email" type="email"
                                                required>
                                        </div>
                                    </div>

                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input-title">
                                            <label for="password">Şifre</label>
                                        </div>
                                        <div class="tp-login-input p-relative">
                                            <input id="password" name="password" type="password"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                                    <div class="tp-login-remeber">
                                        <input id="remember" name="remember" type="checkbox">
                                        <label for="remember">Beni Hatırla</label>
                                    </div>
                                    <div class="tp-login-forgot">
                                        <a href="{{ route('password.request') }}">Şifremi Unuttum?</a>
                                    </div>
                                </div>

                                <div id="login-error" class="text-danger mb-3" style="display: none;"></div>

                                <div class="tp-login-bottom">
                                    <button type="submit" class="tp-login-btn w-100">Giriş Yap</button>
                                </div>
                                <div class="tp-login-bottom">
                                    <a href="{{ route('register') }}" class="tp-login-btn w-100 mt-20">Kayıt Ol</a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JQuery veya kendi JS'in -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(e) {
                e.preventDefault();

                var formData = {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    remember: $('#remember').is(':checked')
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('login') }}",
                    data: formData,
                    beforeSend: function(xhr) {
                        // CSRF token'ını header'a ekliyoruz
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr(
                            'content'));
                    },
                    success: function(response) {
                        // Yönlendirme işlemi
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Login failed. Please check your credentials.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#login-error').text(errorMessage).show();
                    }
                });
            });
        });
    </script>
@endsection
