{{-- Detaylı İletişim Formu Blade Template --}}
@php
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Nasıl Yardımcı Olabiliriz?');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Kalite & Tutku ile İletişim Formu');
    $mainContent = data_get($content, 'content.' . app()->getLocale(), 'Sorularınız mı var veya sohbet etmek mi istiyorsunuz? İletişim formumuzu doldurun ve size en kısa sürede geri dönelim. Deneyimli ekibimiz her zaman yardımınıza hazır.');

    $contactInfo = data_get($content, 'contact_info', []);
@endphp

<section class="gap contact-form-detailed">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-container">
                    <div class="form-header">
                        <span class="small-title">{{ $smallTitle }}</span>
                        <h2 class="main-title">{{ $mainTitle }}</h2>
                        <p class="main-content">{!! $mainContent  !!}</p>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form id="contactForm" action="{{ route('frontend.contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="message" class="form-label">
                                    <i class="fas fa-comment-dots"></i>
                                    {{ __('Your message')  }}
                                </label>
                                <textarea
                                    id="message"
                                    name="message"
                                    placeholder="{{ __('Write your message here...')  }}"
                                    required
                                    class="form-control"
                                ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    {{ __('First & Last Name')  }}
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="{{ __('Name Surname') }}"
                                    required
                                    class="form-control"
                                >
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    {{ __('Your Email Address') }}
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="{{ __('example@email.com') }}"
                                    required
                                    class="form-control"
                                >
                            </div>

                            <div class="form-group full-width">
                                <label for="subject" class="form-label">
                                    <i class="fas fa-tag"></i>
                                    {{ __('Subject') }}
                                </label>
                                <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    placeholder="{{ __('Message Subject') }}"
                                    required
                                    class="form-control"
                                >
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">
                            <span class="btn-text">{{ __('Send Message') }}</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="contact-info-container">
                    <div class="info-header">
                        <h3>{{ __('Contact Information') }}</h3>
                        <p>{{ __('Different ways to reach you') }}</p>
                    </div>

                    @if(!empty($contactInfo) && is_array($contactInfo))
                        <div class="contact-info-list">
                            @foreach($contactInfo as $index => $info)
                                <div class="info-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="info-icon">
                                        @php
                                            // DOĞRU: Önce sitenin mevcut diline göre doğru metni alıyoruz,
                                            // sonra küçük harfe çeviriyoruz.
                                            $title = strtolower(data_get($info, 'info_title.' . app()->getLocale(), ''));
                                            $iconClass = 'fas fa-info-circle'; // default

                                            if (str_contains($title, 'telefon') || str_contains($title, 'phone')) {
                                                $iconClass = 'fas fa-phone';
                                            } elseif (str_contains($title, 'mail') || str_contains($title, 'email')) {
                                                $iconClass = 'fas fa-envelope';
                                            } elseif (str_contains($title, 'adres') || str_contains($title, 'address')) {
                                                $iconClass = 'fas fa-map-marker-alt';
                                            } elseif (str_contains($title, 'saat') || str_contains($title, 'time') || str_contains($title, 'çalışma')) {
                                                $iconClass = 'fas fa-clock';
                                            } elseif (str_contains($title, 'fax')) {
                                                $iconClass = 'fas fa-fax';
                                            }
                                        @endphp
                                        <i class="{{ $iconClass }}"></i>
                                    </div>
                                    <div class="info-content">
                                        {{-- DOĞRU: .app()->getLocale() ile doğru dildeki metni çekiyoruz --}}
                                        <h4>{{ data_get($info, 'info_title.' . app()->getLocale(), '') }}</h4>
                                        <p>{{ data_get($info, 'info_line1.' . app()->getLocale(), '') }}</p>
                                        @if(data_get($info, 'info_line2.' . app()->getLocale()))
                                            <p>{{ data_get($info, 'info_line2.' . app()->getLocale(), '') }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- Varsayılan iletişim bilgileri --}}
                        <div class="contact-info-list">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Telefon</h4>
                                    <p>+90 (212) 555 0123</p>
                                    <p>+90 (532) 555 0123</p>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h4>E-posta</h4>
                                    <p>info@example.com</p>
                                    <p>destek@example.com</p>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Adres</h4>
                                    <p>Örnek Mahallesi, No: 123</p>
                                    <p>34000 İstanbul/Türkiye</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --text-light: #94a3b8;
            --border-color: #e2e8f0;
            --background-light: #f8fafc;
            --white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.02);
            --shadow-md: 0 8px 32px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 32px 64px rgba(0, 0, 0, 0.02);
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--background-light) 0%, #f1f5f9 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .contact-form-detailed {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .contact-form-detailed::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 25% 75%, rgba(59, 130, 246, 0.03), transparent 50%),
                radial-gradient(circle at 75% 25%, rgba(139, 92, 246, 0.03), transparent 50%);
            pointer-events: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .row {
            display: flex;
            gap: 80px;
            align-items: flex-start;
        }

        .col-lg-7 {
            flex: 1;
            max-width: 60%;
        }

        .col-lg-5 {
            flex: 0 0 40%;
            max-width: 40%;
        }

        /* Form Container */
        .form-container {
            background: var(--white);
            padding: 60px;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-sm), var(--shadow-md), var(--shadow-lg);
            border: 1px solid rgba(226, 232, 240, 0.6);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient( 135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }

        /* Form Header */
        .form-header {
            margin-bottom: 48px;
            text-align: left;
        }

        .small-title {
            display: inline-block;
            background: linear-gradient( 135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: var(--white);
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }

        .main-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
            line-height: 1.1;
            background: linear-gradient(135deg, var(--text-dark), #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .main-content {
            font-size: 18px;
            color: var(--text-gray);
            line-height: 1.7;
            max-width: 90%;
        }

        /* Form Styles */
        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
            transition: var(--transition);
        }

        .form-label i {
            color:#16213e;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 20px 24px;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 16px;
            font-family: inherit;
            background: var(--white);
            transition: var(--transition);
            outline: none;
            resize: none;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow:
                0 0 0 3px rgba(59, 130, 246, 0.1),
                0 4px 12px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        .form-control:focus + .form-label {
            color: var(--primary-color);
        }

        textarea.form-control {
            min-height: 140px;
            font-family: inherit;
            resize: vertical;
        }

        .form-control::placeholder {
            color: var(--text-light);
            font-weight: 400;
        }

        /* Submit Button */
        .submit-btn {
            background: linear-gradient( 135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: var(--white);
            border: none;
            padding: 20px 40px;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
            align-self: flex-start;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, var(--primary-dark), #1e40af);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn i {
            transition: transform 0.3s ease;
        }

        .submit-btn:hover i {
            transform: translateX(4px);
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: var(--white);
            padding: 18px 24px;
            border-radius: var(--border-radius);
            display: none;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease-out;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.2);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Contact Info Container */
        .contact-info-container {
            background: var(--white);
            padding: 50px;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-sm), var(--shadow-md);
            border: 1px solid rgba(226, 232, 240, 0.6);
            height: fit-content;
            position: sticky;
            top: 40px;
        }

        .info-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 24px;
            border-bottom: 2px solid var(--border-color);
            position: relative;
        }

        .info-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .info-header h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .info-header p {
            color: var(--text-gray);
            font-size: 16px;
        }

        /* Contact Info List */
        .contact-info-list {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 24px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .info-item:hover {
            background: var(--background-light);
            border-color: var(--border-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .info-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            background: linear-gradient( 135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .info-content h4 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .info-content p {
            color: var(--text-gray);
            font-size: 15px;
            margin: 4px 0;
            line-height: 1.5;
        }

        /* Loading Animation */
        .form-loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .form-loading .submit-btn {
            position: relative;
        }

        .form-loading .submit-btn .btn-text {
            opacity: 0;
        }

        .form-loading .submit-btn::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid var(--white);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .row {
                gap: 60px;
            }

            .form-container,
            .contact-info-container {
                padding: 40px;
            }
        }

        @media (max-width: 992px) {
            .row {
                flex-direction: column;
                gap: 40px;
            }

            .col-lg-7, .col-lg-5 {
                max-width: 100%;
                flex: 1;
            }

            .contact-info-container {
                position: static;
            }

            .main-title {
                font-size: 2.25rem;
            }

            .contact-form-detailed {
                padding: 80px 0;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .form-container,
            .contact-info-container {
                padding: 30px 24px;
            }

            .main-title {
                font-size: 1.875rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-control {
                padding: 16px 20px;
            }

            .submit-btn {
                padding: 16px 32px;
                font-size: 15px;
            }

            .info-item {
                padding: 20px;
            }

            .info-icon {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .contact-form-detailed {
                padding: 60px 0;
            }

            .form-header {
                margin-bottom: 32px;
            }

            .main-title {
                font-size: 1.625rem;
            }

            .small-title {
                padding: 8px 20px;
                font-size: 13px;
            }
        }
    </style>
@endpush

@push('scripts')
@endpush
