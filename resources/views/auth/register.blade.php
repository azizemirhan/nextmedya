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
                            <h3 class="tp-login-title">Hesap Oluştur</h3>
                            <p>Hesabınız var mı? <span><a href="{{ route('login') }}" style="font-weight: 600; color: #000">Giriş Yap</a></span></p>
                        </div>
                        <div class="tp-login-option">
                            <div id="register-errors" class="text-danger mb-3" style="display: none;"></div>
                            <div class="tp-login-input-wrapper">
                                <form id="register-form" method="POST">
                                    @csrf
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input-title">
                                            <label for="name">Adınız & Soyadınız</label>
                                        </div>
                                        <div class="tp-login-input">
                                            <input id="name" name="name" type="text"
                                                required>
                                        </div>
                                    </div>
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
                                        <div class="tp-login-input">
                                            <input id="password" name="password" type="password"
                                                required>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input-title">
                                            <label for="password_confirmation">Şifre Tekrar</label>
                                        </div>
                                        <div class="tp-login-input">
                                            <input id="password_confirmation" name="password_confirmation" type="password"
                                                required>
                                        </div>
                                    </div>

                                    <div class="tp-login-bottom mt-4">
                                        <button type="submit" class="tp-login-btn w-100">Kayıt Ol</button>
                                    </div>
                                </form>
                            </div>
                            <div id="register-success" class="alert alert-success mt-3" style="display: none;">
                                Registration successful! Redirecting...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('register-form');
            const errorContainer = document.getElementById('register-errors');
            const successContainer = document.getElementById('register-success');

            registerForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                errorContainer.style.display = 'none';
                successContainer.style.display = 'none';

                const formData = new FormData(registerForm);

                try {
                    const response = await fetch("{{ route('register') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        successContainer.style.display = 'block';
                        setTimeout(() => {
                            window.location.href =
                            "{{ route('dashboard') }}"; // Kayıttan sonra yönlendirme
                        }, 1500);
                    } else {
                        let messages = '';
                        if (data.errors) {
                            Object.values(data.errors).forEach(errorArray => {
                                errorArray.forEach(error => {
                                    messages += `<div>${error}</div>`;
                                });
                            });
                        } else {
                            messages = '<div>An unexpected error occurred.</div>';
                        }
                        errorContainer.innerHTML = messages;
                        errorContainer.style.display = 'block';
                    }
                } catch (error) {
                    errorContainer.innerHTML = '<div>Network error. Please try again.</div>';
                    errorContainer.style.display = 'block';
                }
            });
        });
    </script>
@endsection
