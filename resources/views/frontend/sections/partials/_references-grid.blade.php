<div class="row g-4 nextmedya-references-grid">
    @foreach($references as $index => $reference)
        @php
            $companyName = data_get($reference, 'company_name.' . app()->getLocale(), '');
            $companyLogo = data_get($reference, 'company_logo', '');
            $companyWebsite = data_get($reference, 'company_website', '#');
            $companyCategory = data_get($reference, 'company_category.' . app()->getLocale(), 'Genel');
            $companyDescription = data_get($reference, 'company_description.' . app()->getLocale(), '');
            $projectType = data_get($reference, 'project_type.' . app()->getLocale(), '');
            $projectDate = data_get($reference, 'project_date', '');
            $isFeatured = data_get($reference, 'is_featured', false);
            $caseStudyUrl = data_get($reference, 'case_study_url', '');
        @endphp

        <div class="col-lg-3 col-md-4 col-sm-6 nextmedya-ref-item category-{{ Str::slug($companyCategory) }}"
             data-aos="fade-up"
             data-aos-delay="{{ ($index + 1) * 50 }}">

            <div class="nextmedya-ref-card {{ $isFeatured ? 'featured' : '' }}">
                <!-- Logo Container -->
                <div class="nextmedya-ref-logo-container">
                    @if($companyLogo)
                        <img src="{{ asset($companyLogo) }}"
                             alt="{{ $companyName }}"
                             class="nextmedya-ref-logo">
                    @else
                        <div class="nextmedya-ref-placeholder">
                            <i class="fas fa-building"></i>
                        </div>
                    @endif

                    @if($isFeatured)
                        <span class="nextmedya-ref-featured-badge">
                            <i class="fas fa-star"></i>
                        </span>
                    @endif
                </div>

                <!-- Hover Overlay -->
                <div class="nextmedya-ref-overlay">
                    <div class="nextmedya-ref-overlay-content">
                        <h5 class="nextmedya-ref-name">{{ $companyName }}</h5>

                        @if($projectType)
                            <p class="nextmedya-ref-type">
                                <i class="fas fa-tag me-1"></i>
                                {{ $projectType }}
                            </p>
                        @endif

                        @if($projectDate)
                            <p class="nextmedya-ref-date">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $projectDate }}
                            </p>
                        @endif

                        <div class="nextmedya-ref-actions">
                            @if($companyWebsite)
                                <a href="{{ $companyWebsite }}"
                                   target="_blank"
                                   class="nextmedya-ref-action-btn"
                                   title="Web Sitesini Ziyaret Et">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @endif

                            @if($caseStudyUrl)
                                <a href="{{ $caseStudyUrl }}"
                                   class="nextmedya-ref-action-btn"
                                   title="Vaka Çalışması">
                                    <i class="fas fa-book-open"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        .nextmedya-references-grid {
            position: relative;
            z-index: 1;
        }

        .nextmedya-ref-item {
            transition: all 0.3s ease;
        }

        .nextmedya-ref-card {
            position: relative;
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .nextmedya-ref-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-ref-card.featured {
            border: 3px solid;
            border-image: linear-gradient(135deg, #667eea, #764ba2) 1;
        }

        .nextmedya-ref-logo-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nextmedya-ref-logo {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.4s ease;
        }

        .nextmedya-ref-card:hover .nextmedya-ref-logo {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.1);
        }

        .nextmedya-ref-placeholder {
            font-size: 3rem;
            color: #e2e8f0;
        }

        .nextmedya-ref-featured-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 0.75rem;
            animation: badgePulse 2s ease-in-out infinite;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Overlay */
        .nextmedya-ref-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95), rgba(118, 75, 162, 0.95));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            border-radius: 15px;
        }

        .nextmedya-ref-card:hover .nextmedya-ref-overlay {
            opacity: 1;
            visibility: visible;
        }

        .nextmedya-ref-overlay-content {
            text-align: center;
            color: #ffffff;
            padding: 20px;
        }

        .nextmedya-ref-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .nextmedya-ref-type,
        .nextmedya-ref-date {
            font-size: 0.875rem;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .nextmedya-ref-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
        }

        .nextmedya-ref-action-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nextmedya-ref-action-btn:hover {
            background: #ffffff;
            color: #667eea;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .nextmedya-ref-card {
                height: 150px;
            }
        }
    </style>
@endpush