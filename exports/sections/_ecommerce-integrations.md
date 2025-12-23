@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $sectionDescription = data_get($content, 'section_description.' . app()->getLocale(), '');
    $layoutType = data_get($content, 'layout_type', 'categories');
    $integrationCategories = data_get($content, 'integration_categories', []);
@endphp

<section class="nextmedya-integrations">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                @if($sectionSubtitle)
                    <span class="nextmedya-integration-badge">{{ $sectionSubtitle }}</span>
                @endif
                <h2 class="nextmedya-integration-title">{{ $sectionTitle }}</h2>
                @if($sectionDescription)
                    <p class="nextmedya-integration-description">{!! $sectionDescription !!}</p>
                @endif
            </div>
        </div>

        @if($layoutType === 'carousel')
            <!-- Carousel Layout -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="nextmedya-integration-carousel" data-aos="fade-up">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($integrationCategories as $category)
                                    @php $integrations = data_get($category, 'integrations', []); @endphp
                                    @foreach($integrations as $integration)
                                        @php
                                            $integrationName = data_get($integration, 'integration_name.' . app()->getLocale());
                                            $integrationLogo = data_get($integration, 'integration_logo');
                                            $integrationDescription = data_get($integration, 'integration_description.' . app()->getLocale());
                                            $isPremium = data_get($integration, 'is_premium', false);
                                            $setupTime = data_get($integration, 'setup_time.' . app()->getLocale());
                                        @endphp
                                        <div class="swiper-slide">
                                            <div class="nextmedya-integration-item">
                                                @if($isPremium)
                                                    <span class="nextmedya-premium-badge">Premium</span>
                                                @endif
                                                @if($integrationLogo)
                                                    <img src="{{ asset($integrationLogo) }}" alt="{{ $integrationName }}" class="nextmedya-integration-logo">
                                                @endif
                                                <h5>{{ $integrationName }}</h5>
                                                <p>{{ $integrationDescription }}</p>
                                                @if($setupTime)
                                                    <span class="nextmedya-setup-time">
                                                        <i class="fas fa-clock"></i> {{ $setupTime }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($layoutType === 'grid')
            <!-- Grid Layout -->
            <div class="row nextmedya-integration-grid">
                @foreach($integrationCategories as $category)
                    @php $integrations = data_get($category, 'integrations', []); @endphp
                    @foreach($integrations as $integration)
                        @php
                            $integrationName = data_get($integration, 'integration_name.' . app()->getLocale());
                            $integrationLogo = data_get($integration, 'integration_logo');
                            $integrationDescription = data_get($integration, 'integration_description.' . app()->getLocale());
                            $isPremium = data_get($integration, 'is_premium', false);
                            $setupTime = data_get($integration, 'setup_time.' . app()->getLocale());
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up">
                            <div class="nextmedya-integration-card">
                                @if($isPremium)
                                    <span class="nextmedya-premium-badge">Premium</span>
                                @endif
                                @if($integrationLogo)
                                    <div class="nextmedya-integration-logo-wrapper">
                                        <img src="{{ asset($integrationLogo) }}" alt="{{ $integrationName }}">
                                    </div>
                                @endif
                                <h5>{{ $integrationName }}</h5>
                                <p>{{ $integrationDescription }}</p>
                                @if($setupTime)
                                    <span class="nextmedya-setup-time">
                                        <i class="fas fa-clock"></i> {{ $setupTime }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

        @else
            <!-- Categories Layout (Default) -->
            @foreach($integrationCategories as $categoryIndex => $category)
                @php
                    $categoryName = data_get($category, 'category_name.' . app()->getLocale());
                    $categoryIcon = data_get($category, 'category_icon', 'fas fa-plug');
                    $categoryDescription = data_get($category, 'category_description.' . app()->getLocale());
                    $integrations = data_get($category, 'integrations', []);
                @endphp
                <div class="row nextmedya-integration-category" data-aos="fade-up" data-aos-delay="{{ $categoryIndex * 100 }}">
                    <div class="col-lg-12">
                        <div class="nextmedya-category-header">
                            <div class="nextmedya-category-title-wrapper">
                                <i class="{{ $categoryIcon }}"></i>
                                <div>
                                    <h3>{{ $categoryName }}</h3>
                                    @if($categoryDescription)
                                        <p>{!! $categoryDescription !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($integrations as $integration)
                                @php
                                    $integrationName = data_get($integration, 'integration_name.' . app()->getLocale());
                                    $integrationLogo = data_get($integration, 'integration_logo');
                                    $integrationDescription = data_get($integration, 'integration_description.' . app()->getLocale());
                                    $isPremium = data_get($integration, 'is_premium', false);
                                    $setupTime = data_get($integration, 'setup_time.' . app()->getLocale());
                                @endphp
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="nextmedya-integration-box">
                                        @if($isPremium)
                                            <span class="nextmedya-premium-badge">
                                                <i class="fas fa-crown"></i> Premium
                                            </span>
                                        @endif
                                        @if($integrationLogo)
                                            <div class="nextmedya-integration-logo-box">
                                                <img src="{{ asset($integrationLogo) }}" alt="{{ $integrationName }}">
                                            </div>
                                        @endif
                                        <div class="nextmedya-integration-info">
                                            <h5>{{ $integrationName }}</h5>
                                            <p>{!! $integrationDescription !!}</p>
                                            @if($setupTime)
                                                <div class="nextmedya-integration-meta">
                                                    <i class="fas fa-clock"></i>
                                                    <span>{{ $setupTime }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Call to Action -->
        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="nextmedya-integration-cta">
                    <h4>Aradığınız Entegrasyonu Bulamadınız mı?</h4>
                    <p>Özel entegrasyon çözümlerimiz için bizimle iletişime geçin</p>
                    <a href="#contact" class="nextmedya-btn nextmedya-btn-primary">
                        Entegrasyon Talebi
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-integrations {
            padding: 100px 0;
            background: #ffffff;
        }

        .nextmedya-integration-badge {
            display: inline-block;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .nextmedya-integration-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .nextmedya-integration-description {
            font-size: 1.125rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 60px;
            line-height: 1.8;
        }

        /* Categories Layout */
        .nextmedya-integration-category {
            margin-bottom: 60px;
        }

        .nextmedya-category-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
        }

        .nextmedya-category-title-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nextmedya-category-title-wrapper > i {
            font-size: 2.5rem;
            color: #8b5cf6;
            flex-shrink: 0;
        }

        .nextmedya-category-header h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .nextmedya-category-header p {
            font-size: 1rem;
            color: #64748b;
            margin: 0;
        }

        .nextmedya-integration-box {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-integration-box:hover {
            transform: translateY(-5px);
            border-color: #8b5cf6;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.15);
        }

        .nextmedya-premium-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nextmedya-integration-logo-box {
            width: 80px;
            height: 80px;
            background: #f8fafc;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            padding: 15px;
        }

        .nextmedya-integration-logo-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .nextmedya-integration-info h5 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .nextmedya-integration-info p {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 15px;
            flex: 1;
        }

        .nextmedya-integration-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #8b5cf6;
            font-size: 0.875rem;
            font-weight: 600;
            margin-top: auto;
        }

        .nextmedya-integration-meta i {
            font-size: 1rem;
        }

        /* Grid Layout */
        .nextmedya-integration-grid {
            margin-bottom: 60px;
        }

        .nextmedya-integration-card {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            margin-bottom: 30px;
        }

        .nextmedya-integration-card:hover {
            transform: translateY(-5px);
            border-color: #8b5cf6;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.15);
        }

        .nextmedya-integration-logo-wrapper {
            width: 100px;
            height: 100px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            padding: 20px;
        }

        .nextmedya-integration-logo-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .nextmedya-integration-card h5 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .nextmedya-integration-card p {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .nextmedya-setup-time {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #8b5cf6;
            font-size: 0.875rem;
            font-weight: 600;
        }

        /* CTA Section */
        .nextmedya-integration-cta {
            background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
            border: 2px dashed #8b5cf6;
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
        }

        .nextmedya-integration-cta h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .nextmedya-integration-cta p {
            font-size: 1.125rem;
            color: #64748b;
            margin-bottom: 30px;
        }

        .nextmedya-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nextmedya-btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }

        .nextmedya-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.4);
            color: #ffffff;
        }

        @media (max-width: 992px) {
            .nextmedya-integrations {
                padding: 60px 0;
            }

            .nextmedya-category-header {
                padding: 20px;
            }

            .nextmedya-category-title-wrapper {
                flex-direction: column;
                text-align: center;
            }

            .nextmedya-integration-cta {
                padding: 40px 20px;
            }
        }
    </style>
@endpush