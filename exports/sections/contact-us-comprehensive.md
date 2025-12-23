{{-- resources/views/frontend/sections/contact-us-comprehensive.blade.php --}}
@php
    // Bölüm Başlıkları
    $lang = app()->getLocale();
    $subTitle = data_get($content, 'sub_title.' . $lang, 'İletişim');
    $mainTitle = data_get($content, 'main_title.' . $lang, 'Bize Ulaşın');
    $description = data_get($content, 'description.' . $lang, 'Dijital çözümleriniz için uzman ekibimizle hemen irtibata geçin.');
    
    // Form ayarları
    $formTitle = data_get($content, 'form_title.' . $lang, 'Teklif Talep Formu');
    $adminFormAction = data_get($content, 'form_action');
    
    if (empty($adminFormAction)) {
        $formAction = route('frontend.contact.submit');
    } else {
        if (filter_var($adminFormAction, FILTER_VALIDATE_URL)) {
            $formAction = $adminFormAction;
        } elseif (Str::startsWith($adminFormAction, '/')) {
            $formAction = $adminFormAction;
        } else {
            try {
                $formAction = route($adminFormAction);
            } catch (\Exception $e) {
                $formAction = route('frontend.contact.submit');
            }
        }
    }
    
    $showMap = (data_get($content, 'show_map', '1') === '1');
    $infoBoxes = data_get($content, 'info_boxes', []);
    $mapEmbedUrl = data_get($content, 'map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d153013.91890382346!2d32.721471342616235!3d39.90799636618474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d347c0500742f9%3A0xc3af7a52230a108!2sAnkara!5e0!3m2!1str!2str!4v1700000000000!5m2!1str!2str');
    $mapHeight = data_get($content, 'map_height', '500');
@endphp

{{-- reCAPTCHA v3 Script --}}
@if(config('recaptcha.enabled'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
@endif

<section class="section-contact-comprehensive">
    <div class="container">

        {{-- Başlık Bölümü --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                @if($subTitle)
                    <p class="section-subtitle text-uppercase fw-bold">{{ $subTitle }}</p>
                @endif
                @if($mainTitle)
                    <h2 class="section-title fw-bolder">{{ $mainTitle }}</h2>
                @endif
                @if($description)
                    <p class="lead text-muted mt-3">{!! $description !!}</p>
                @endif
            </div>
        </div>

        <div class="row g-5">
            {{-- İletişim Bilgi Kutuları --}}
            <div class="col-lg-4">
                <div class="contact-info-boxes">
                    @forelse($infoBoxes as $box)
                        <div class="info-box bg-white shadow-sm p-4 mb-4 rounded-3 border-start border-5 border-primary" data-aos="fade-up">
                            <i class="{{ data_get($box, 'icon', 'fas fa-info-circle') }} fa-2x text-primary mb-3"></i>
                            <h5 class="fw-bold">{{ data_get($box, 'title.' . $lang) }}</h5>
                            <p class="text-muted small mb-3">{!! data_get($box, 'content.' . $lang) !!}</p>
                            @if(!empty(data_get($box, 'link_url')))
                                <a href="{{ data_get($box, 'link_url') }}" class="text-decoration-none text-primary fw-semibold">
                                    {{ data_get($box, 'link_text.' . $lang, 'Detay Gör') }} <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="alert alert-info">İletişim bilgi kutusu eklenmemiş.</div>
                    @endforelse
                </div>
            </div>

            {{-- İletişim Formu --}}
            <div class="col-lg-8">
                {{-- SUCCESS MESAJI --}}
                @if(session('form_submitted') && session('success'))
                    <div class="alert alert-success alert-dismissible fade show contact-form-success" 
                         role="alert"
                         id="contact-success-message"
                         data-lead-name="{{ session('lead_data.name') }}"
                         data-lead-email="{{ session('lead_data.email') }}"
                         data-lead-subject="{{ session('lead_data.subject') }}"
                         data-lead-value="{{ session('lead_data.lead_value', 100) }}"
                         data-lead-source="{{ session('lead_data.lead_source', 'website_contact_form') }}">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- ERROR MESAJI --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Lütfen aşağıdaki hataları düzeltin:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- FORM --}}
                <div class="contact-form-wrapper bg-white shadow-lg p-4 p-md-5 rounded-3" data-aos="fade-left">
                    @if($formTitle)
                        <h3 class="mb-4 fw-bold text-center text-lg-start">{{ $formTitle }}</h3>
                    @endif

                    <form action="{{ $formAction }}" method="POST" class="row g-3" id="contactForm">
                        @csrf

                        {{-- Honeypot --}}
                        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                        {{-- Ad Soyad --}}
                        <div class="col-md-6">
                            <label for="name" class="form-label">
                                {{ __('Adınız Soyadınız') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- E-Posta --}}
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                {{ __('E-Posta Adresiniz') }} <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konu --}}
                        <div class="col-12">
                            <label for="subject" class="form-label">{{ __('Konu') }}</label>
                            <input type="text" 
                                   class="form-control @error('subject') is-invalid @enderror" 
                                   id="subject" 
                                   name="subject"
                                   value="{{ old('subject') }}">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mesaj --}}
                        <div class="col-12">
                            <label for="message" class="form-label">
                                {{ __('Mesajınız') }} <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" 
                                      name="message" 
                                      rows="5" 
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- reCAPTCHA v3 Badge Info --}}
                        @if(config('recaptcha.enabled'))
                            <div class="col-12">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Bu site reCAPTCHA ile korunmaktadır. Google 
                                    <a href="https://policies.google.com/privacy" target="_blank">Gizlilik Politikası</a> ve 
                                    <a href="https://policies.google.com/terms" target="_blank">Kullanım Şartları</a> geçerlidir.
                                </small>
                            </div>
                        @endif

                        {{-- Submit Button --}}
                        <div class="col-12 mt-4 text-center text-md-start">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitContactForm">
                                <span id="submitText">{{ __('Gönder') }}</span>
                                <span id="submitLoader" style="display:none;">
                                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    Gönderiliyor...
                                </span>
                                <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Google Harita --}}
@if($showMap && $mapEmbedUrl)
    <section class="p-0 mt-5">
        <div class="ratio ratio-21x9" style="height: {{ $mapHeight }}px;">
            <iframe src="{{ $mapEmbedUrl }}"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
@endif

@push('styles')
    <style>
        .section-contact-comprehensive {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .section-subtitle {
            color: #0d6efd;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .section-title {
            font-size: 2.5rem;
            color: #212529;
        }

        .info-box {
            transition: all 0.3s ease;
            cursor: pointer;
            border-color: #0d6efd !important;
        }

        .info-box:hover {
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15) !important;
            transform: translateY(-5px);
        }

        .contact-form-wrapper {
            transition: box-shadow 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .contact-form-success {
            animation: slideInDown 0.5s ease-out;
            font-size: 1.1rem;
            border-left: 5px solid #198754;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 992px) {
            .section-contact-comprehensive {
                padding: 60px 0;
            }
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@push('scripts')
<script>
// reCAPTCHA v3 + GTM Integration
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitContactForm');
    const submitText = document.getElementById('submitText');
    const submitLoader = document.getElementById('submitLoader');
    
    // GTM Lead Event Tracking
    const successMessage = document.getElementById('contact-success-message');
    if (successMessage && typeof window.dataLayer !== 'undefined') {
        const leadData = {
            event: 'lead_generated',
            lead_type: 'contact_form',
            lead_source: successMessage.dataset.leadSource || 'website_contact_form',
            lead_value: parseFloat(successMessage.dataset.leadValue) || 100,
            customer_name: successMessage.dataset.leadName || '',
            customer_email: successMessage.dataset.leadEmail || '',
            form_subject: successMessage.dataset.leadSubject || 'Genel Bilgi'
        };
        
        window.dataLayer.push(leadData);
        console.log('GTM Lead Event Pushed:', leadData);
        
        setTimeout(function() {
            const alert = bootstrap.Alert.getOrCreateInstance(successMessage);
            alert.close();
        }, 10000);
    }
    
    // reCAPTCHA v3 Form Submit
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            @if(config('recaptcha.enabled'))
                e.preventDefault();
                
                // Loading state
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitLoader.style.display = 'inline';
                
                // reCAPTCHA execute
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('recaptcha.site_key') }}', {action: 'contact_form'})
                        .then(function(token) {
                            // Token'ı forma ekle
                            let input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'g-recaptcha-response';
                            input.value = token;
                            contactForm.appendChild(input);
                            
                            // GTM event
                            if (typeof window.dataLayer !== 'undefined') {
                                window.dataLayer.push({
                                    event: 'form_submit_attempt',
                                    form_type: 'contact_form',
                                    recaptcha_verified: true
                                });
                            }
                            
                            // Formu gönder
                            contactForm.submit();
                        })
                        .catch(function(error) {
                            console.error('reCAPTCHA Error:', error);
                            
                            // Hata durumunda butonu eski haline getir
                            submitBtn.disabled = false;
                            submitText.style.display = 'inline';
                            submitLoader.style.display = 'none';
                            
                            alert('reCAPTCHA doğrulaması başarısız. Lütfen sayfayı yenileyin ve tekrar deneyin.');
                        });
                });
            @else
                // reCAPTCHA kapalıysa direkt GTM event
                if (typeof window.dataLayer !== 'undefined') {
                    window.dataLayer.push({
                        event: 'form_submit_attempt',
                        form_type: 'contact_form'
                    });
                }
            @endif
        });
    }
});
</script>
@endpush