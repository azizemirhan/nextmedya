{{-- resources/views/frontend/forms/meeting-request.blade.php --}}
@extends('frontend.layouts.master')

@section('title', 'Toplantı Planla')

@section('content')

@if(config('recaptcha.enabled'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
@endif

<section class="meeting-request-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                {{-- Form Header --}}
                <div class="form-header text-center mb-5" data-aos="fade-down">
                    <h1 class="form-title">Toplantı Planlayın</h1>
                    <p class="form-subtitle">Sizinle görüşmek için sabırsızlanıyoruz! Uygun zamanınızı seçin.</p>
                </div>

                {{-- Success Message --}}
                @if(session('form_submitted') && session('success'))
                    <div class="alert alert-success alert-dismissible fade show meeting-request-success" 
                         role="alert"
                         id="meeting-success-message"
                         data-lead-name="{{ session('lead_data.name') }}"
                         data-lead-email="{{ session('lead_data.email') }}"
                         data-lead-date="{{ session('lead_data.meeting_date') }}"
                         data-lead-topic="{{ session('lead_data.meeting_topic') }}"
                         data-lead-value="{{ session('lead_data.lead_value', 150) }}"
                         data-lead-source="{{ session('lead_data.lead_source', 'meeting_request_form') }}">
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
                                <div class="step-label">Tarih & Saat</div>
                            </div>
                            <div class="progress-step" data-step="3">
                                <div class="step-circle">3</div>
                                <div class="step-label">Toplantı Detayları</div>
                            </div>
                        </div>
                        <div class="progress-bar-line">
                            <div class="progress-bar-fill" style="width: 33.33%"></div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form id="meetingRequestForm" action="{{ route('meeting-request.submit') }}" method="POST">
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

                        {{-- Step 2: Tarih ve Saat --}}
                        <div class="form-step" data-step="2">
                            <h3 class="step-title">Tercih Ettiğiniz Tarih ve Saat</h3>
                            
                            {{-- Birinci Tercih --}}
                            <div class="datetime-selection mb-4">
                                <label class="section-label">Birinci Tercih <span class="text-danger">*</span></label>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tarih</label>
                                        <input type="date" 
                                               name="preferred_date" 
                                               class="form-control @error('preferred_date') is-invalid @enderror"
                                               min="{{ date('Y-m-d') }}"
                                               value="{{ old('preferred_date') }}"
                                               required>
                                        @error('preferred_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Zaman Dilimi</label>
                                        <select name="preferred_time" 
                                                class="form-select @error('preferred_time') is-invalid @enderror"
                                                required>
                                            <option value="">Seçiniz</option>
                                            <option value="morning" {{ old('preferred_time') == 'morning' ? 'selected' : '' }}>
                                                🌅 Sabah (09:00 - 12:00)
                                            </option>
                                            <option value="afternoon" {{ old('preferred_time') == 'afternoon' ? 'selected' : '' }}>
                                                ☀️ Öğleden Sonra (13:00 - 17:00)
                                            </option>
                                            <option value="evening" {{ old('preferred_time') == 'evening' ? 'selected' : '' }}>
                                                🌆 Akşam (17:00 - 19:00)
                                            </option>
                                        </select>
                                        @error('preferred_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Alternatif Tercih --}}
                            <div class="datetime-selection alternative-section">
                                <label class="section-label">Alternatif Tercih (Opsiyonel)</label>
                                <p class="small text-muted mb-3">İlk tercihinizin müsait olmaması durumunda</p>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Alternatif Tarih</label>
                                        <input type="date" 
                                               name="alternative_date" 
                                               class="form-control"
                                               min="{{ date('Y-m-d') }}"
                                               value="{{ old('alternative_date') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Zaman Dilimi</label>
                                        <select name="alternative_time" class="form-select">
                                            <option value="">Seçiniz</option>
                                            <option value="morning" {{ old('alternative_time') == 'morning' ? 'selected' : '' }}>
                                                🌅 Sabah (09:00 - 12:00)
                                            </option>
                                            <option value="afternoon" {{ old('alternative_time') == 'afternoon' ? 'selected' : '' }}>
                                                ☀️ Öğleden Sonra (13:00 - 17:00)
                                            </option>
                                            <option value="evening" {{ old('alternative_time') == 'evening' ? 'selected' : '' }}>
                                                🌆 Akşam (17:00 - 19:00)
                                            </option>
                                        </select>
                                    </div>
                                </div>
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

                        {{-- Step 3: Toplantı Detayları --}}
                        <div class="form-step" data-step="3">
                            <h3 class="step-title">📝 Toplantı Detayları</h3>
                            
                            <div class="row g-4">
                                {{-- Toplantı Konusu --}}
                                <div class="col-12">
                                    <label class="form-label">Toplantı Konusu <span class="text-danger">*</span></label>
                                    <select name="topic" 
                                            class="form-select @error('topic') is-invalid @enderror"
                                            required>
                                        <option value="">Seçiniz</option>
                                        <option value="new_project" {{ old('topic') == 'new_project' ? 'selected' : '' }}>
                                            🚀 Yeni Proje Görüşmesi
                                        </option>
                                        <option value="consultation" {{ old('topic') == 'consultation' ? 'selected' : '' }}>
                                            💡 Danışmanlık
                                        </option>
                                        <option value="quotation" {{ old('topic') == 'quotation' ? 'selected' : '' }}>
                                            💰 Fiyat Teklifi
                                        </option>
                                        <option value="support" {{ old('topic') == 'support' ? 'selected' : '' }}>
                                            🛠️ Teknik Destek
                                        </option>
                                        <option value="partnership" {{ old('topic') == 'partnership' ? 'selected' : '' }}>
                                            🤝 İş Birliği
                                        </option>
                                        <option value="other" {{ old('topic') == 'other' ? 'selected' : '' }}>
                                            📋 Diğer
                                        </option>
                                    </select>
                                    @error('topic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Toplantı Türü --}}
                                <div class="col-12">
                                    <label class="form-label">Toplantı Türü <span class="text-danger">*</span></label>
                                    <div class="meeting-type-grid">
                                        <label class="meeting-type-card">
                                            <input type="radio" 
                                                   name="meeting_type" 
                                                   value="online" 
                                                   {{ old('meeting_type') == 'online' ? 'checked' : '' }}
                                                   required>
                                            <div class="card-content">
                                                <i class="fas fa-video"></i>
                                                <h5>Online Toplantı</h5>
                                                <p>Video konferans ile</p>
                                            </div>
                                        </label>

                                        <label class="meeting-type-card">
                                            <input type="radio" 
                                                   name="meeting_type" 
                                                   value="office" 
                                                   {{ old('meeting_type') == 'office' ? 'checked' : '' }}>
                                            <div class="card-content">
                                                <i class="fas fa-building"></i>
                                                <h5>Ofisimizde</h5>
                                                <p>Yüz yüze görüşme</p>
                                            </div>
                                        </label>

                                        <label class="meeting-type-card">
                                            <input type="radio" 
                                                   name="meeting_type" 
                                                   value="client_office" 
                                                   {{ old('meeting_type') == 'client_office' ? 'checked' : '' }}>
                                            <div class="card-content">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <h5>Sizin Ofisinizde</h5>
                                                <p>Size geliyoruz</p>
                                            </div>
                                        </label>
                                    </div>
                                    @error('meeting_type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                {{-- Platform Seçimi (Online için) --}}
                                <div class="col-12" id="platformSelection" style="display: none;">
                                    <label class="form-label">Tercih Ettiğiniz Platform</label>
                                    <select name="meeting_platform" class="form-select">
                                        <option value="">Seçiniz</option>
                                        <option value="zoom" {{ old('meeting_platform') == 'zoom' ? 'selected' : '' }}>
                                            🎥 Zoom
                                        </option>
                                        <option value="teams" {{ old('meeting_platform') == 'teams' ? 'selected' : '' }}>
                                            👥 Microsoft Teams
                                        </option>
                                        <option value="google_meet" {{ old('meeting_platform') == 'google_meet' ? 'selected' : '' }}>
                                            📹 Google Meet
                                        </option>
                                        <option value="skype" {{ old('meeting_platform') == 'skype' ? 'selected' : '' }}>
                                            💬 Skype
                                        </option>
                                    </select>
                                </div>

                                {{-- İletişim Yöntemleri --}}
                                <div class="col-12">
                                    <label class="form-label">
                                        Size Nasıl Ulaşalım? <span class="text-danger">*</span>
                                        <small class="text-muted">(Birden fazla seçebilirsiniz)</small>
                                    </label>
                                    <div class="contact-methods-grid">
                                        <label class="contact-method-card">
                                            <input type="checkbox" 
                                                   name="contact_methods[]" 
                                                   value="phone"
                                                   {{ in_array('phone', old('contact_methods', [])) ? 'checked' : '' }}>
                                            <div class="card-content">
                                                <i class="fas fa-phone"></i>
                                                <span>Telefon</span>
                                            </div>
                                        </label>

                                        <label class="contact-method-card">
                                            <input type="checkbox" 
                                                   name="contact_methods[]" 
                                                   value="video"
                                                   {{ in_array('video', old('contact_methods', [])) ? 'checked' : '' }}>
                                            <div class="card-content">
                                                <i class="fas fa-video"></i>
                                                <span>Video Konferans</span>
                                            </div>
                                        </label>

                                        <label class="contact-method-card">
                                            <input type="checkbox" 
                                                   name="contact_methods[]" 
                                                   value="email"
                                                   {{ in_array('email', old('contact_methods', [])) ? 'checked' : '' }}>
                                            <div class="card-content">
                                                <i class="fas fa-envelope"></i>
                                                <span>E-posta</span>
                                            </div>
                                        </label>

                                        <label class="contact-method-card">
                                            <input type="checkbox" 
                                                   name="contact_methods[]" 
                                                   value="whatsapp"
                                                   {{ in_array('whatsapp', old('contact_methods', [])) ? 'checked' : '' }}>
                                            <div class="card-content">
                                                <i class="fab fa-whatsapp"></i>
                                                <span>WhatsApp</span>
                                            </div>
                                        </label>
                                    </div>
                                    @error('contact_methods')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                                </div>

                                {{-- Mesaj --}}
                                <div class="col-12">
                                    <label class="form-label">Ek Notlarınız (Opsiyonel)</label>
                                    <textarea name="message" 
                                              class="form-control" 
                                              rows="4" 
                                              placeholder="Toplantı hakkında bize iletmek istediğiniz notlar...">{{ old('message') }}</textarea>
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
                                        <i class="fas fa-calendar-check me-2"></i> Toplantıyı Planla
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
    .meeting-request-form-section {
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

    /* Progress Bar - Same as service request */
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
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
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
        color: #3b82f6;
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
        background: linear-gradient(90deg, #3b82f6 0%, #1e40af 100%);
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
        border-bottom: 3px solid #3b82f6;
        padding-bottom: 15px;
    }

    .section-label {
        display: block;
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .alternative-section {
        background: #f7fafc;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #3b82f6;
    }

    /* Meeting Type Cards */
    .meeting-type-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 15px;
    }

    .meeting-type-card {
        cursor: pointer;
        position: relative;
    }

    .meeting-type-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .meeting-type-card .card-content {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s;
        background: white;
    }

    .meeting-type-card input[type="radio"]:checked + .card-content {
        border-color: #3b82f6;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
        box-shadow: 0 5px 20px rgba(59, 130, 246, 0.3);
    }

    .meeting-type-card .card-content i {
        font-size: 2.5rem;
        color: #3b82f6;
        margin-bottom: 15px;
    }

    .meeting-type-card .card-content h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .meeting-type-card .card-content p {
        font-size: 0.85rem;
        color: #718096;
        margin: 0;
    }

    /* Contact Methods */
    .contact-methods-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .contact-method-card {
        cursor: pointer;
        position: relative;
    }

    .contact-method-card input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }

    .contact-method-card .card-content {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .contact-method-card input[type="checkbox"]:checked + .card-content {
        border-color: #3b82f6;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
        box-shadow: 0 3px 15px rgba(59, 130, 246, 0.3);
    }

    .contact-method-card .card-content i {
        font-size: 2rem;
        color: #3b82f6;
    }

    .contact-method-card .card-content span {
        font-size: 0.9rem;
        font-weight: 600;
        color: #2d3748;
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

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
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

        .meeting-type-grid,
        .contact-methods-grid {
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
    const form = document.getElementById('meetingRequestForm');
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

    // Meeting type change - show/hide platform selection
    document.querySelectorAll('input[name="meeting_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const platformSelection = document.getElementById('platformSelection');
            if (this.value === 'online') {
                platformSelection.style.display = 'block';
            } else {
                platformSelection.style.display = 'none';
            }
        });
    });

    // Check on page load (for old values)
    const selectedMeetingType = document.querySelector('input[name="meeting_type"]:checked');
    if (selectedMeetingType && selectedMeetingType.value === 'online') {
        document.getElementById('platformSelection').style.display = 'block';
    }

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
            } else if (field.type === 'checkbox') {
                const checkboxGroup = currentStepEl.querySelectorAll(`[name="${field.name}"]`);
                const isChecked = Array.from(checkboxGroup).some(cb => cb.checked);
                if (!isChecked) {
                    isValid = false;
                    alert('Lütfen en az bir seçenek seçin.');
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
                grecaptcha.execute('{{ config('recaptcha.site_key') }}', {action: 'meeting_request'})
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
    const successMessage = document.getElementById('meeting-success-message');
    if (successMessage && typeof window.dataLayer !== 'undefined') {
        window.dataLayer.push({
            event: 'lead_generated',
            lead_type: 'meeting_request',
            lead_source: successMessage.dataset.leadSource,
            lead_value: parseFloat(successMessage.dataset.leadValue),
            meeting_date: successMessage.dataset.leadDate,
            meeting_topic: successMessage.dataset.leadTopic,
            customer_name: successMessage.dataset.leadName,
            customer_email: successMessage.dataset.leadEmail
        });
    }
});
</script>
@endpush

@endsection