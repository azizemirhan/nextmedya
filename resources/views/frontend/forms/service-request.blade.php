{{-- resources/views/frontend/forms/service-request.blade.php --}}
@extends('frontend.layouts.master')

@section('title', 'Bilgi Al - Hizmet Talebi')

@section('content')

@if(config('recaptcha.enabled'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
@endif

<section class="service-request-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                {{-- Form Header --}}
                <div class="form-header text-center mb-5" data-aos="fade-down">
                    <h1 class="form-title">📋 Hizmet Talebi Oluştur</h1>
                    <p class="form-subtitle">Size en uygun çözümü sunabilmemiz için lütfen formu doldurun</p>
                </div>

                {{-- Success Message --}}
                @if(session('form_submitted') && session('success'))
                    <div class="alert alert-success alert-dismissible fade show service-request-success" 
                         role="alert"
                         id="service-success-message"
                         data-lead-name="{{ session('lead_data.name') }}"
                         data-lead-email="{{ session('lead_data.email') }}"
                         data-lead-service="{{ session('lead_data.service_type') }}"
                         data-lead-package="{{ session('lead_data.package_type') }}"
                         data-lead-value="{{ session('lead_data.lead_value', 100) }}"
                         data-lead-source="{{ session('lead_data.lead_source', 'service_request_form') }}">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Lütfen aşağıdaki hataları düzeltin:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Multistep Form Container --}}
                <div class="multistep-form-container" data-aos="fade-up">
                    
                    {{-- Progress Bar --}}
                    <div class="progress-bar-container">
                        <div class="progress-bar-steps">
                            <div class="progress-step active" data-step="1">
                                <div class="step-circle">1</div>
                                <div class="step-label">Bilgileriniz</div>
                            </div>
                            <div class="progress-step" data-step="2">
                                <div class="step-circle">2</div>
                                <div class="step-label">Hizmet Seçimi</div>
                            </div>
                            <div class="progress-step" data-step="3">
                                <div class="step-circle">3</div>
                                <div class="step-label">Detaylar</div>
                            </div>
                        </div>
                        <div class="progress-bar-line">
                            <div class="progress-bar-fill" style="width: 33.33%"></div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form id="serviceRequestForm" action="{{ route('service-request.submit') }}" method="POST">
                        @csrf
                        
                        {{-- Honeypot --}}
                        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                        {{-- Step 1: Kişisel Bilgiler --}}
                        <div class="form-step active" data-step="1">
                            <h3 class="step-title">👤 Kişisel Bilgileriniz</h3>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Ad Soyad <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           name="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">E-posta <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Telefon <span class="text-danger">*</span></label>
                                    <input type="tel" 
                                           name="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}"
                                           placeholder="0555 123 45 67"
                                           required>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Firma Adı (Opsiyonel)</label>
                                    <input type="text" 
                                           name="company" 
                                           class="form-control @error('company') is-invalid @enderror" 
                                           value="{{ old('company') }}">
                                    @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="form-navigation mt-4">
                                <button type="button" class="btn btn-primary btn-next">
                                    İleri <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 2: Hizmet Seçimi --}}
                        <div class="form-step" data-step="2">
                            <h3 class="step-title">🎨 Hizmet ve Paket Seçimi</h3>
                            
                            {{-- Hizmet Türü --}}
                            <div class="mb-4">
                                <label class="form-label">Hangi hizmeti almak istiyorsunuz? <span class="text-danger">*</span></label>
                                <div class="service-type-grid">
                                    <label class="service-card">
                                        <input type="radio" name="service_type" value="web_design" {{ old('service_type') == 'web_design' ? 'checked' : '' }} required>
                                        <div class="card-content">
                                            <i class="fas fa-laptop-code"></i>
                                            <h5>Web Tasarım</h5>
                                            <p>Modern ve responsive web siteleri</p>
                                        </div>
                                    </label>

                                    <label class="service-card">
                                        <input type="radio" name="service_type" value="mobile_app" {{ old('service_type') == 'mobile_app' ? 'checked' : '' }}>
                                        <div class="card-content">
                                            <i class="fas fa-mobile-alt"></i>
                                            <h5>Mobil Uygulama</h5>
                                            <p>iOS ve Android uygulamaları</p>
                                        </div>
                                    </label>

                                    <label class="service-card">
                                        <input type="radio" name="service_type" value="seo" {{ old('service_type') == 'seo' ? 'checked' : '' }}>
                                        <div class="card-content">
                                            <i class="fas fa-search"></i>
                                            <h5>SEO Optimizasyonu</h5>
                                            <p>Arama motoru optimizasyonu</p>
                                        </div>
                                    </label>

                                    <label class="service-card">
                                        <input type="radio" name="service_type" value="e_commerce" {{ old('service_type') == 'e_commerce' ? 'checked' : '' }}>
                                        <div class="card-content">
                                            <i class="fas fa-shopping-cart"></i>
                                            <h5>E-Ticaret</h5>
                                            <p>Online mağaza çözümleri</p>
                                        </div>
                                    </label>
                                </div>
                                @error('service_type')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                            </div>

                            {{-- Paket Seçimi (Web Design için gösterilecek) --}}
                            <div id="packageSelection" class="package-selection" style="display: none;">
                                <label class="form-label">Paket Seçimi</label>
                                <div class="package-grid">
                                    <label class="package-card">
                                        <input type="radio" name="package_type" value="basic">
                                        <div class="package-content">
                                            <h5>Temel Paket</h5>
                                            <div class="package-price">₺5,000</div>
                                            <ul class="package-features">
                                                <li>✓ 5 Sayfa</li>
                                                <li>✓ Responsive Tasarım</li>
                                                <li>✓ 3 Revizyon</li>
                                            </ul>
                                        </div>
                                    </label>

                                    <label class="package-card featured">
                                        <div class="package-badge">EN POPÜLER</div>
                                        <input type="radio" name="package_type" value="professional">
                                        <div class="package-content">
                                            <h5>Profesyonel</h5>
                                            <div class="package-price">₺8,000</div>
                                            <ul class="package-features">
                                                <li>✓ 10 Sayfa</li>
                                                <li>✓ SEO Optimizasyonu</li>
                                                <li>✓ Blog Modülü</li>
                                                <li>✓ 5 Revizyon</li>
                                            </ul>
                                        </div>
                                    </label>

                                    <label class="package-card">
                                        <input type="radio" name="package_type" value="premium">
                                        <div class="package-content">
                                            <h5>Premium</h5>
                                            <div class="package-price">₺12,000</div>
                                            <ul class="package-features">
                                                <li>✓ Sınırsız Sayfa</li>
                                                <li>✓ E-Ticaret Entegrasyonu</li>
                                                <li>✓ Özel Tasarım</li>
                                                <li>✓ 10 Revizyon</li>
                                            </ul>
                                        </div>
                                    </label>
                                </div>
                                <input type="hidden" name="package_price" id="packagePrice">
                            </div>

                            <div class="form-navigation mt-4">
                                <button type="button" class="btn btn-secondary btn-prev">
                                    <i class="fas fa-arrow-left me-2"></i> Geri
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    İleri <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 3: Detaylar --}}
                        <div class="form-step" data-step="3">
                            <h3 class="step-title">📝 Proje Detayları</h3>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Bütçe Aralığı</label>
                                    <select name="budget_range" class="form-select">
                                        <option value="">Seçiniz</option>
                                        <option value="0-5000" {{ old('budget_range') == '0-5000' ? 'selected' : '' }}>0 - 5.000 TL</option>
                                        <option value="5000-10000" {{ old('budget_range') == '5000-10000' ? 'selected' : '' }}>5.000 - 10.000 TL</option>
                                        <option value="10000-20000" {{ old('budget_range') == '10000-20000' ? 'selected' : '' }}>10.000 - 20.000 TL</option>
                                        <option value="20000+" {{ old('budget_range') == '20000+' ? 'selected' : '' }}>20.000 TL+</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Ne Zaman Başlamak İstersiniz?</label>
                                    <select name="timeline" class="form-select">
                                        <option value="">Seçiniz</option>
                                        <option value="hemen" {{ old('timeline') == 'hemen' ? 'selected' : '' }}>Hemen</option>
                                        <option value="1-ay" {{ old('timeline') == '1-ay' ? 'selected' : '' }}>1 Ay İçinde</option>
                                        <option value="2-3-ay" {{ old('timeline') == '2-3-ay' ? 'selected' : '' }}>2-3 Ay İçinde</option>
                                        <option value="belirsiz" {{ old('timeline') == 'belirsiz' ? 'selected' : '' }}>Belirsiz</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Proje Hakkında Detaylı Bilgi</label>
                                    <textarea name="project_details" 
                                              class="form-control" 
                                              rows="5" 
                                              placeholder="Projeniz hakkında bize bilgi verin...">{{ old('project_details') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Ek Özellikler (Varsa seçiniz)</label>
                                    <div class="features-checkbox-group">
                                        <label class="feature-checkbox">
                                            <input type="checkbox" name="selected_features[]" value="Google Analytics">
                                            <span>Google Analytics</span>
                                        </label>
                                        <label class="feature-checkbox">
                                            <input type="checkbox" name="selected_features[]" value="İletişim Formu">
                                            <span>İletişim Formu</span>
                                        </label>
                                        <label class="feature-checkbox">
                                            <input type="checkbox" name="selected_features[]" value="Blog">
                                            <span>Blog Modülü</span>
                                        </label>
                                        <label class="feature-checkbox">
                                            <input type="checkbox" name="selected_features[]" value="Çoklu Dil">
                                            <span>Çoklu Dil Desteği</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @if(config('recaptcha.enabled'))
                                <div class="mt-4">
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt me-1"></i>
                                        Bu site reCAPTCHA ile korunmaktadır.
                                    </small>
                                </div>
                            @endif

                            <div class="form-navigation mt-4">
                                <button type="button" class="btn btn-secondary btn-prev">
                                    <i class="fas fa-arrow-left me-2"></i> Geri
                                </button>
                                <button type="submit" class="btn btn-success btn-submit" id="submitBtn">
                                    <span id="submitText">
                                        <i class="fas fa-paper-plane me-2"></i> Talebi Gönder
                                    </span>
                                    <span id="submitLoader" style="display:none;">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        Gönderiliyor...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .service-request-form-section {
        padding: 80px 0;
        min-height: 100vh;
    }

    .form-header {
        margin-bottom: 40px;
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .form-subtitle {
        font-size: 1.1rem;
        color: #718096;
    }

    .multistep-form-container {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    /* Progress Bar */
    .progress-bar-container {
        margin-bottom: 50px;
        position: relative;
    }

    .progress-bar-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .progress-step {
        text-align: center;
        flex: 1;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #a0aec0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        margin: 0 auto 10px;
        transition: all 0.3s;
    }

    .progress-step.active .step-circle {
        background: #0d6efd;
        color: white;
        transform: scale(1.1);
    }

    .progress-step.completed .step-circle {
        background: #48bb78;
        color: white;
    }

    .step-label {
        font-size: 0.9rem;
        color: #718096;
        font-weight: 500;
    }

    .progress-step.active .step-label {
        color: #667eea;
        font-weight: 600;
    }

    .progress-bar-line {
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        height: 4px;
        background: #e2e8f0;
        z-index: 1;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transition: width 0.3s ease;
    }

    /* Form Steps */
    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
        animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .step-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 30px;
        border-bottom: 3px solid #667eea;
        padding-bottom: 15px;
    }

    /* Service Cards */
    .service-type-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .service-card {
        cursor: pointer;
        position: relative;
    }

    .service-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .service-card .card-content {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s;
        background: white;
    }

    .service-card input[type="radio"]:checked + .card-content {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .service-card .card-content i {
        font-size: 2.5rem;
        color: #667eea;
        margin-bottom: 15px;
    }

    .service-card .card-content h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .service-card .card-content p {
        font-size: 0.85rem;
        color: #718096;
        margin: 0;
    }

    /* Package Cards */
    .package-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .package-card {
        cursor: pointer;
        position: relative;
    }

    .package-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .package-card .package-content {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s;
        background: white;
        height: 100%;
    }

    .package-card.featured .package-content {
        border-color: #667eea;
    }

    .package-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: #667eea;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .package-card input[type="radio"]:checked + .package-content {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .package-content h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .package-price {
        font-size: 2rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 20px;
    }

    .package-features {
        list-style: none;
        padding: 0;
        text-align: left;
    }

    .package-features li {
        padding: 8px 0;
        color: #4a5568;
        font-size: 0.9rem;
    }

    /* Features Checkboxes */
    .features-checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .feature-checkbox {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .feature-checkbox:hover {
        border-color: #667eea;
        background: #f7fafc;
    }

    .feature-checkbox input[type="checkbox"] {
        margin-right: 10px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .feature-checkbox input[type="checkbox"]:checked + span {
        color: #667eea;
        font-weight: 600;
    }

    /* Form Navigation */
    .form-navigation {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding-top: 30px;
        border-top: 1px solid #e2e8f0;
    }

    .btn {
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s;
    }


    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border: none;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(72, 187, 120, 0.4);
    }

    @media (max-width: 768px) {
        .multistep-form-container {
            padding: 25px;
        }

        .form-title {
            font-size: 2rem;
        }

        .service-type-grid,
        .package-grid {
            grid-template-columns: 1fr;
        }

        .form-navigation {
            flex-direction: column;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('serviceRequestForm');
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const progressFill = document.querySelector('.progress-bar-fill');
    const nextBtns = document.querySelectorAll('.btn-next');
    const prevBtns = document.querySelectorAll('.btn-prev');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitLoader = document.getElementById('submitLoader');
    
    let currentStep = 1;
    const totalSteps = steps.length;

    // Package prices
    const packagePrices = {
        'basic': 5000,
        'professional': 8000,
        'premium': 12000
    };

    // Service type change
    document.querySelectorAll('input[name="service_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const packageSelection = document.getElementById('packageSelection');
            if (this.value === 'web_design') {
                packageSelection.style.display = 'block';
            } else {
                packageSelection.style.display = 'none';
                // Clear package selection
                document.querySelectorAll('input[name="package_type"]').forEach(p => p.checked = false);
                document.getElementById('packagePrice').value = '';
            }
        });
    });

    // Package selection
    document.querySelectorAll('input[name="package_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const price = packagePrices[this.value] || 0;
            document.getElementById('packagePrice').value = price;
        });
    });

    // Next button
    nextBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                currentStep++;
                updateStep();
            }
        });
    });

    // Previous button
    prevBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            currentStep--;
            updateStep();
        });
    });

    function updateStep() {
        // Update steps
        steps.forEach((step, index) => {
            step.classList.remove('active');
            if (index === currentStep - 1) {
                step.classList.add('active');
            }
        });

        // Update progress
        progressSteps.forEach((step, index) => {
            step.classList.remove('active', 'completed');
            if (index < currentStep - 1) {
                step.classList.add('completed');
            } else if (index === currentStep - 1) {
                step.classList.add('active');
            }
        });

        // Update progress bar
        const progress = ((currentStep) / totalSteps) * 100;
        progressFill.style.width = progress + '%';

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep(step) {
        const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
        const requiredFields = currentStepEl.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (field.type === 'radio') {
                const radioGroup = currentStepEl.querySelectorAll(`[name="${field.name}"]`);
                const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                if (!isChecked) {
                    isValid = false;
                    alert('Lütfen bir seçenek seçin.');
                }
            } else if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        return isValid;
    }

    // reCAPTCHA + Form Submit
    form.addEventListener('submit', function(e) {
        @if(config('recaptcha.enabled'))
            e.preventDefault();
            
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitLoader.style.display = 'inline';
            
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('recaptcha.site_key') }}', {action: 'service_request'})
                    .then(function(token) {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'g-recaptcha-response';
                        input.value = token;
                        form.appendChild(input);
                        
                        form.submit();
                    });
            });
        @endif
    });

    // GTM Success Event
    const successMessage = document.getElementById('service-success-message');
    if (successMessage && typeof window.dataLayer !== 'undefined') {
        window.dataLayer.push({
            event: 'lead_generated',
            lead_type: 'service_request',
            lead_source: successMessage.dataset.leadSource,
            lead_value: parseFloat(successMessage.dataset.leadValue),
            service_type: successMessage.dataset.leadService,
            package_type: successMessage.dataset.leadPackage,
            customer_name: successMessage.dataset.leadName,
            customer_email: successMessage.dataset.leadEmail
        });
    }
});
</script>
@endpush

@endsection