@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'Get In Touch');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Contact Form');
    $formAction = data_get($content, 'form_action', route('frontend.contact.submit'));
@endphp

<section class="formSections">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h6 class="sub_title dark_sub_title">{{ $subTitle }}</h6>
                <h2 class="sec_title dark_sec_title mb45">
                    <span>{{ $mainTitle }}</span>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="cotactForm">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form id="contactForm" method="POST" action="{{ route('frontend.contact.submit') }}" class="row">
                        @csrf

                        {{-- Honeypot for spam protection --}}
                        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="iconInput">
                                <input
                                        class="required"
                                        type="text"
                                        name="name"
                                        id="con_name"
                                        placeholder="{{ __('ENTER YOUR NAME HERE') }}"
                                        value="{{ old('name') }}"
                                        required
                                >
                                <i class="fal fa-user"></i>
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="iconInput">
                                <input
                                        class="required"
                                        type="tel"
                                        name="phone"
                                        id="con_phone"
                                        placeholder="{{ __('ENTER YOUR NUMBER HERE') }}"
                                        value="{{ old('phone') }}"
                                >
                                <i class="fal fa-phone"></i>
                            </div>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="iconInput">
                                <input
                                        class="required"
                                        type="email"
                                        name="email"
                                        id="con_email"
                                        placeholder="{{ __('ENTER YOUR EMAIL HERE') }}"
                                        value="{{ old('email') }}"
                                        required
                                >
                                <i class="fal fa-envelope"></i>
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="iconInput">
                                <input
                                        class="required"
                                        type="text"
                                        name="subject"
                                        id="con_subject"
                                        placeholder="{{ __('ENTER YOUR SUBJECT HERE') }}"
                                        value="{{ old('subject') }}"
                                        required
                                >
                                <i class="fal fa-edit"></i>
                            </div>
                            @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-12">
                            <div class="iconInput">
                                <textarea
                                        class="required"
                                        name="message"
                                        id="con_message"
                                        placeholder="{{ __('ENTER YOUR MESSAGE HERE') }}"
                                        required
                                >{{ old('message') }}</textarea>
                                <i class="fal fa-pencil-alt"></i>
                            </div>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- reCAPTCHA v3 Hatası --}}
                        @error('recaptcha-response')
                        <div class="col-xl-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-shield-alt"></i> {{ $message }}
                            </div>
                        </div>
                        @enderror

                        <div class="col-xl-12 text-center">
                            <input
                                    type="submit"
                                    value="{{ __('Send Message') }}"
                                    id="con_submit"
                                    name="con_submit"
                            >
                        </div>
                    </form>

                    {{-- reCAPTCHA v3 Badge Bilgilendirmesi --}}
                    <div class="recaptcha-info text-center mt-3">
                        <small class="text-muted">
                            Bu site Google reCAPTCHA ile korunmaktadır.
                            <a href="https://policies.google.com/privacy" target="_blank">Gizlilik Politikası</a> ve
                            <a href="https://policies.google.com/terms" target="_blank">Hizmet Şartları</a> geçerlidir.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .formSections {
            padding: 100px 0;
            background: #ffffff;
        }

        .sub_title {
            font-size: 14px;
            font-weight: 600;
            color: #1a237e;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            display: block;
        }

        .sub_title.dark_sub_title {
            color: #1a237e;
        }

        .sec_title {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.2;
            margin-bottom: 60px;
        }

        .sec_title.dark_sec_title span {
            position: relative;
            display: inline-block;
        }

        .sec_title.dark_sec_title span::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #1a237e;
        }

        .mb45 {
            margin-bottom: 45px;
        }

        .cotactForm {
            max-width: 1000px;
            margin: 0 auto;
        }

        .cotactForm .row {
            gap: 20px 0;
        }

        .iconInput {
            position: relative;
        }

        .iconInput input,
        .iconInput textarea {
            width: 100%;
            padding: 18px 20px 18px 55px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #666;
            background: #ffffff;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .iconInput input::placeholder,
        .iconInput textarea::placeholder {
            color: #999;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .iconInput textarea {
            min-height: 150px;
            resize: vertical;
        }

        .iconInput i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #999;
            transition: color 0.3s ease;
        }

        .iconInput textarea + i {
            top: 25px;
            transform: none;
        }

        .iconInput input:focus,
        .iconInput textarea:focus {
            border-color: #1a237e;
            outline: none;
        }

        .iconInput input:focus + i,
        .iconInput textarea:focus + i {
            color: #1a237e;
        }

        input[type="submit"] {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #ffffff;
            border: none;
            padding: 18px 50px;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(26, 26, 46, 0.3);
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(26, 26, 46, 0.4);
            background: linear-gradient(135deg, #0f3460 0%, #16213e 50%, #1a1a2e 100%);
        }

        input[type="submit"]:active {
            transform: translateY(-1px);
        }

        input[type="submit"]:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            margin-bottom: 30px;
            padding: 15px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 20px;
        }

        .text-danger {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #dc3545;
        }

        .recaptcha-info {
            margin-top: 20px;
        }

        .recaptcha-info small {
            font-size: 12px;
        }

        .recaptcha-info a {
            color: #1a237e;
            text-decoration: none;
        }

        .recaptcha-info a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .formSections {
                padding: 60px 0;
            }

            .sec_title {
                font-size: 36px;
            }
        }

        @media (max-width: 767px) {
            .sec_title {
                font-size: 28px;
                margin-bottom: 40px;
            }

            .iconInput input,
            .iconInput textarea {
                padding: 15px 15px 15px 50px;
                font-size: 13px;
            }

            input[type="submit"] {
                padding: 15px 40px;
                font-size: 14px;
            }
        }
    </style>
@endpush

@push('scripts')
    {{-- reCAPTCHA v3 Script'ini yükle --}}
    {!! recaptcha_script() !!}

    {{-- Form submit işlemi --}}
    {!! recaptcha_v3('contactForm', 'contact_form_submit') !!}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('contactForm');

            if (form) {
                // Form submit'e ek işlemler (loading state vb.)
                form.addEventListener('submit', function (e) {
                    const submitBtn = document.getElementById('con_submit');

                    // Button'ı disable et (reCAPTCHA scripti zaten submit'i engeller)
                    setTimeout(() => {
                        submitBtn.disabled = true;
                        submitBtn.value = '{{ __("Sending...") }}';
                    }, 100);
                });
            }
        });
    </script>
@endpush