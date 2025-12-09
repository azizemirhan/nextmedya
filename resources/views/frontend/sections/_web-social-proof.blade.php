@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Başarı Hikayelerimiz');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $caseStudies = data_get($content, 'case_studies', []);
    $testimonials = data_get($content, 'testimonials', []);
    
    // Varsayılan case study
    if (empty($caseStudies)) {
        $caseStudies = [
            [
                'company_name' => ['tr' => 'ABC Tekstil'],
                'industry' => ['tr' => 'Tekstil & İmalat'],
                'problem' => ['tr' => 'Eski siteleri yavaştı ve hiç mobil ziyaretçi alamıyorlardı.'],
                'solution' => ['tr' => 'Modern, mobil öncelikli ve SEO altyapılı bir site kodladık.'],
                'result_metric_1' => '200%',
                'result_metric_1_label' => ['tr' => 'Trafik Artışı'],
                'result_metric_2' => '3.2sn',
                'result_metric_2_label' => ['tr' => 'Yükleme Süresi'],
                'result_metric_3' => '85%',
                'result_metric_3_label' => ['tr' => 'Mobil Kullanım'],
            ]
        ];
    }
    
    // Varsayılan testimonial
    if (empty($testimonials)) {
        $testimonials = [
            [
                'client_name' => ['tr' => 'Mehmet Yılmaz'],
                'client_position' => ['tr' => 'Genel Müdür'],
                'client_company' => ['tr' => 'ABC Tekstil'],
                'rating' => '5',
                'testimonial_text' => ['tr' => 'Next Medya ile çalışmak harika bir deneyimdi. Sadece bir web sitesi değil, gerçek bir dijital varlık kazandık.'],
            ]
        ];
    }
@endphp

<section class="nextmedya-social-proof">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="nextmedya-section-header">
                    <h2 class="nextmedya-section-title">{{ $sectionTitle }}</h2>
                    @if($sectionSubtitle)
                        <p class="nextmedya-section-subtitle">{{ $sectionSubtitle }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Case Studies -->
        @if(!empty($caseStudies))
            <div class="nextmedya-case-studies">
                @foreach($caseStudies as $index => $case)
                    @php
                        $companyName = data_get($case, 'company_name.' . app()->getLocale());
                        $companyLogo = data_get($case, 'company_logo');
                        $projectImage = data_get($case, 'project_image') ? asset($case['project_image']) : 'https://placehold.co/800x500';
                        $industry = data_get($case, 'industry.' . app()->getLocale());
                        $problem = data_get($case, 'problem.' . app()->getLocale());
                        $solution = data_get($case, 'solution.' . app()->getLocale());
                        $projectUrl = data_get($case, 'project_url', '#');
                    @endphp

                    <div class="nextmedya-case-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="row align-items-center">
                            <div class="col-lg-6 {{ $index % 2 == 0 ? 'order-lg-1' : 'order-lg-2' }}">
                                <div class="nextmedya-case-image-wrapper">
                                    <img src="{{ $projectImage }}" alt="{{ $companyName }}" class="nextmedya-case-image">
                                    <div class="nextmedya-case-overlay">
                                        <a href="{{ $projectUrl }}" class="nextmedya-case-view-btn">
                                            <i class="fas fa-external-link-alt"></i>
                                            <span>Projeyi İncele</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 {{ $index % 2 == 0 ? 'order-lg-2' : 'order-lg-1' }}">
                                <div class="nextmedya-case-content">
                                    <div class="nextmedya-case-header">
                                        @if($companyLogo)
                                            <img src="{{ asset($companyLogo) }}" alt="{{ $companyName }}" class="nextmedya-case-logo">
                                        @else
                                            <h3 class="nextmedya-case-company">{{ $companyName }}</h3>
                                        @endif
                                        @if($industry)
                                            <span class="nextmedya-case-industry">{{ $industry }}</span>
                                        @endif
                                    </div>

                                    <div class="nextmedya-case-section">
                                        <h4 class="nextmedya-case-label">
                                            <i class="fas fa-exclamation-circle"></i> Problem
                                        </h4>
                                        <p class="nextmedya-case-text">{!! $problem !!}</p>
                                    </div>

                                    <div class="nextmedya-case-section">
                                        <h4 class="nextmedya-case-label">
                                            <i class="fas fa-lightbulb"></i> Çözüm
                                        </h4>
                                        <p class="nextmedya-case-text">{!! $solution !!}</p>
                                    </div>

                                    <div class="nextmedya-case-results">
                                        @for($i = 1; $i <= 3; $i++)
                                            @php
                                                $metric = data_get($case, "result_metric_{$i}");
                                                $label = data_get($case, "result_metric_{$i}_label." . app()->getLocale());
                                            @endphp
                                            @if($metric && $label)
                                                <div class="nextmedya-result-item">
                                                    <div class="nextmedya-result-value">{{ $metric }}</div>
                                                    <div class="nextmedya-result-label">{{ $label }}</div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Testimonials -->
        @if(!empty($testimonials))
            <div class="row" data-aos="fade-up">
                <div class="col-lg-12">
                    <div class="nextmedya-testimonials-wrapper">
                        <div class="nextmedya-testimonials-slider">
                            @foreach($testimonials as $testimonial)
                                @php
                                    $clientName = data_get($testimonial, 'client_name.' . app()->getLocale());
                                    $clientPosition = data_get($testimonial, 'client_position.' . app()->getLocale());
                                    $clientCompany = data_get($testimonial, 'client_company.' . app()->getLocale());
                                    $clientPhoto = data_get($testimonial, 'client_photo') ? asset($testimonial['client_photo']) : 'https://placehold.co/100x100';
                                    $rating = data_get($testimonial, 'rating', 5);
                                    $testimonialText = data_get($testimonial, 'testimonial_text.' . app()->getLocale());
                                @endphp

                                <div class="nextmedya-testimonial-card">
                                    <div class="nextmedya-testimonial-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating ? 'active' : '' }}"></i>
                                        @endfor
                                    </div>

                                    <blockquote class="nextmedya-testimonial-quote">
                                        <i class="fas fa-quote-left nextmedya-quote-icon"></i>
                                        {!! $testimonialText !!}
                                    </blockquote>

                                    <div class="nextmedya-testimonial-author">
                                        <img src="{{ $clientPhoto }}" alt="{{ $clientName }}" class="nextmedya-author-photo">
                                        <div class="nextmedya-author-info">
                                            <h5 class="nextmedya-author-name">{{ $clientName }}</h5>
                                            <p class="nextmedya-author-position">{{ $clientPosition }}</p>
                                            <p class="nextmedya-author-company">{{ $clientCompany }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-social-proof {
            padding: 100px 0;
            background: #f8fafc;
        }

        .nextmedya-case-studies {
            margin-bottom: 80px;
        }

        .nextmedya-case-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 60px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
        }

        .nextmedya-case-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .nextmedya-case-image-wrapper {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-case-image {
            width: 100%;
            display: block;
            transition: transform 0.6s ease;
        }

        .nextmedya-case-image-wrapper:hover .nextmedya-case-image {
            transform: scale(1.05);
        }

        .nextmedya-case-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(30, 41, 59, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .nextmedya-case-image-wrapper:hover .nextmedya-case-overlay {
            opacity: 1;
        }

        .nextmedya-case-view-btn {
            background: #ffffff;
            color: #1e293b;
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .nextmedya-case-image-wrapper:hover .nextmedya-case-view-btn {
            transform: translateY(0);
        }

        .nextmedya-case-view-btn:hover {
            background: #3b82f6;
            color: #ffffff;
        }

        .nextmedya-case-content {
            padding: 20px;
        }

        .nextmedya-case-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .nextmedya-case-logo {
            height: 50px;
            width: auto;
        }

        .nextmedya-case-company {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
        }

        .nextmedya-case-industry {
            background: #eff6ff;
            color: #3b82f6;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .nextmedya-case-section {
            margin-bottom: 24px;
        }

        .nextmedya-case-label {
            font-size: 1rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nextmedya-case-text {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        .nextmedya-case-results {
            display: flex;
            gap: 30px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f1f5f9;
            flex-wrap: wrap;
        }

        .nextmedya-result-item {
            text-align: center;
        }

        .nextmedya-result-value {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 8px;
        }

        .nextmedya-result-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 600;
        }

        /* Testimonials */
        .nextmedya-testimonials-wrapper {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            border-radius: 24px;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .nextmedya-testimonials-wrapper::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
        }

        .nextmedya-testimonials-slider {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 20px;
            scrollbar-width: thin;
            scrollbar-color: #3b82f6 #334155;
        }

        .nextmedya-testimonials-slider::-webkit-scrollbar {
            height: 8px;
        }

        .nextmedya-testimonials-slider::-webkit-scrollbar-track {
            background: #334155;
            border-radius: 10px;
        }

        .nextmedya-testimonials-slider::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }

        .nextmedya-testimonial-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            min-width: 500px;
            scroll-snap-align: start;
            transition: all 0.4s ease;
        }

        .nextmedya-testimonial-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
        }

        .nextmedya-testimonial-rating {
            margin-bottom: 20px;
        }

        .nextmedya-testimonial-rating i {
            color: #94a3b8;
            font-size: 1.125rem;
            margin-right: 4px;
        }

        .nextmedya-testimonial-rating i.active {
            color: #fbbf24;
        }

        .nextmedya-testimonial-quote {
            position: relative;
            font-size: 1.125rem;
            color: #f1f5f9;
            line-height: 1.8;
            margin-bottom: 30px;
            font-style: italic;
        }

        .nextmedya-quote-icon {
            position: absolute;
            top: -10px;
            left: -30px;
            font-size: 2rem;
            color: #3b82f6;
            opacity: 0.3;
        }

        .nextmedya-testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nextmedya-author-photo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #3b82f6;
            object-fit: cover;
        }

        .nextmedya-author-name {
            font-size: 1.125rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 4px 0;
        }

        .nextmedya-author-position {
            font-size: 0.875rem;
            color: #94a3b8;
            margin: 0 0 4px 0;
        }

        .nextmedya-author-company {
            font-size: 0.875rem;
            color: #3b82f6;
            font-weight: 600;
            margin: 0;
        }

        @media (max-width: 992px) {
            .nextmedya-social-proof {
                padding: 60px 0;
            }

            .nextmedya-case-card {
                padding: 30px 20px;
            }

            .nextmedya-case-content {
                margin-top: 30px;
                padding: 0;
            }

            .nextmedya-case-results {
                gap: 20px;
            }

            .nextmedya-result-value {
                font-size: 2rem;
            }

            .nextmedya-testimonial-card {
                min-width: 350px;
                padding: 30px 20px;
            }

            .nextmedya-testimonials-wrapper {
                padding: 40px 20px;
            }
        }
    </style>
@endpush