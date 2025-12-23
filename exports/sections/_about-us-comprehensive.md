@php
    // Hero
    $heroTitle = data_get($content, 'hero_title.' . app()->getLocale(), 'Hakkımızda');
    $heroSubtitle = data_get($content, 'hero_subtitle.' . app()->getLocale(), '');
    $heroDescription = data_get($content, 'hero_description.' . app()->getLocale(), '');
    $heroImage = data_get($content, 'hero_image', '');
    $heroVideoUrl = data_get($content, 'hero_video_url', '');
    
    // Story
    $storyTitle = data_get($content, 'story_title.' . app()->getLocale(), 'Hikayemiz');
    $storyContent = data_get($content, 'story_content.' . app()->getLocale(), '');
    $storyImage = data_get($content, 'story_image', '');
    $foundedYear = data_get($content, 'founded_year', '2015');
    
    // Values
    $valuesTitle = data_get($content, 'values_title.' . app()->getLocale(), 'Değerlerimiz');
    $values = data_get($content, 'values', []);
    
    // Stats
    $statsTitle = data_get($content, 'stats_title.' . app()->getLocale(), 'Rakamlarla Biz');
    $statistics = data_get($content, 'statistics', []);
    
    // Team
    $teamTitle = data_get($content, 'team_title.' . app()->getLocale(), 'Ekibimiz');
    $teamSubtitle = data_get($content, 'team_subtitle.' . app()->getLocale(), '');
    $teamMembers = data_get($content, 'team_members', []);
    
    // Awards
    $awardsTitle = data_get($content, 'awards_title.' . app()->getLocale(), 'Ödüller & Sertifikalar');
    $awards = data_get($content, 'awards', []);
    
    // Timeline
    $timelineTitle = data_get($content, 'timeline_title.' . app()->getLocale(), 'Yolculuğumuz');
    $milestones = data_get($content, 'milestones', []);
    
    // CTA
    $ctaTitle = data_get($content, 'cta_title.' . app()->getLocale(), '');
    $ctaDescription = data_get($content, 'cta_description.' . app()->getLocale(), '');
    $ctaButtonText = data_get($content, 'cta_button_text.' . app()->getLocale(), 'İletişime Geçin');
    $ctaButtonUrl = data_get($content, 'cta_button_url', '/contact');
@endphp

        <!-- Hero Section -->
<section class="about-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-primary mb-3">{{ $heroSubtitle }}</span>
                <h1 class="display-3 fw-bold mb-4">{{ $heroTitle }}</h1>
                @if($heroDescription)
                    <p class="lead text-muted mb-4">{!! $heroDescription  !!}</p>
                @endif

{{--                @if($heroVideoUrl)--}}
{{--                    <button class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#videoModal">--}}
{{--                        <i class="fas fa-play me-2"></i>--}}
{{--                        Tanıtım Videomuz--}}
{{--                    </button>--}}
{{--                @endif--}}
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                @if($heroImage)
                    <img src="{{ asset($heroImage) }}" alt="{{ $heroTitle }}" class="img-fluid rounded-4 shadow-lg">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
@if($storyContent)
    <section class="about-story py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    @if($storyImage)
                        <img src="{{ asset($storyImage) }}" alt="{{ $storyTitle }}" class="img-fluid rounded-4 shadow">
                    @endif
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <div class="about-year-badge">
                        <span class="display-1 fw-bold text-primary">{{ $foundedYear }}</span>
                        <p class="text-muted mb-0">Kuruluş Yılı</p>
                    </div>
                    <h2 class="display-5 fw-bold mb-4">{{ $storyTitle }}</h2>
                    <div class="story-content">
                        {!! $storyContent !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Values Section -->
@if(!empty($values))
    <section class="about-values py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">{{ $valuesTitle }}</h2>
            </div>

            <div class="row g-4">
                @foreach($values as $index => $value)
                    @php
                        $valueIcon = data_get($value, 'value_icon', 'fas fa-heart');
                        $valueTitle = data_get($value, 'value_title.' . app()->getLocale(), '');
                        $valueDescription = data_get($value, 'value_description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="value-card h-100 p-4 bg-white rounded-4 shadow-sm">
                            <div class="value-icon mb-3">
                                <i class="{{ $valueIcon }} fa-3x text-primary"></i>
                            </div>
                            <h4 class="fw-bold mb-3">{{ $valueTitle }}</h4>
                            <p class="text-muted mb-0">{!! $valueDescription !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{--<!-- Statistics Section -->--}}
{{--@if(!empty($statistics))--}}
{{--    <section class="about-stats py-5 bg-primary text-white">--}}
{{--        <div class="container">--}}
{{--            <div class="text-center mb-5" data-aos="fade-up">--}}
{{--                <h2 class="display-5 fw-bold mb-3">{{ $statsTitle }}</h2>--}}
{{--            </div>--}}

{{--            <div class="row g-4">--}}
{{--                @foreach($statistics as $stat)--}}
{{--                    @php--}}
{{--                        $statNumber = data_get($stat, 'stat_number', '0');--}}
{{--                        $statSuffix = data_get($stat, 'stat_suffix', '');--}}
{{--                        $statLabel = data_get($stat, 'stat_label.' . app()->getLocale(), '');--}}
{{--                        $statIcon = data_get($stat, 'stat_icon', 'fas fa-star');--}}
{{--                    @endphp--}}

{{--                    <div class="col-lg-3 col-md-6" data-aos="zoom-in">--}}
{{--                        <div class="stat-card text-center p-4">--}}
{{--                            <i class="{{ $statIcon }} fa-3x mb-3 opacity-75"></i>--}}
{{--                            <h2 class="display-4 fw-bold mb-2">--}}
{{--                                <span class="counter" data-count="{{ $statNumber }}">0</span>{{ $statSuffix }}--}}
{{--                            </h2>--}}
{{--                            <p class="mb-0 text-uppercase">{{ $statLabel }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endif--}}

{{--<!-- Team Section -->--}}
{{--@if(!empty($teamMembers))--}}
{{--    <section class="about-team py-5">--}}
{{--        <div class="container">--}}
{{--            <div class="text-center mb-5" data-aos="fade-up">--}}
{{--                <h2 class="display-5 fw-bold mb-3">{{ $teamTitle }}</h2>--}}
{{--                @if($teamSubtitle)--}}
{{--                    <p class="lead text-muted">{{ $teamSubtitle }}</p>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="row g-4">--}}
{{--                @foreach($teamMembers as $index => $member)--}}
{{--                    @php--}}
{{--                        $memberName = data_get($member, 'member_name.' . app()->getLocale(), '');--}}
{{--                        $memberPosition = data_get($member, 'member_position.' . app()->getLocale(), '');--}}
{{--                        $memberPhoto = data_get($member, 'member_photo', '');--}}
{{--                        $memberBio = data_get($member, 'member_bio.' . app()->getLocale(), '');--}}
{{--                        $memberLinkedin = data_get($member, 'member_linkedin', '');--}}
{{--                        $memberTwitter = data_get($member, 'member_twitter', '');--}}
{{--                        $memberInstagram = data_get($member, 'member_instagram', '');--}}
{{--                    @endphp--}}

{{--                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">--}}
{{--                        <div class="team-card text-center">--}}
{{--                            <div class="team-photo mb-3">--}}
{{--                                @if($memberPhoto)--}}
{{--                                    <img src="{{ asset($memberPhoto) }}" alt="{{ $memberName }}" class="img-fluid rounded-circle">--}}
{{--                                @else--}}
{{--                                    <div class="team-placeholder rounded-circle">--}}
{{--                                        <i class="fas fa-user fa-3x text-muted"></i>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <h5 class="fw-bold mb-1">{{ $memberName }}</h5>--}}
{{--                            <p class="text-primary mb-3">{{ $memberPosition }}</p>--}}

{{--                            @if($memberBio)--}}
{{--                                <p class="text-muted small mb-3">{{ Str::limit($memberBio, 100) }}</p>--}}
{{--                            @endif--}}

{{--                            <div class="team-social">--}}
{{--                                @if($memberLinkedin)--}}
{{--                                    <a href="{{ $memberLinkedin }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">--}}
{{--                                        <i class="fab fa-linkedin-in"></i>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                @if($memberTwitter)--}}
{{--                                    <a href="{{ $memberTwitter }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">--}}
{{--                                        <i class="fab fa-twitter"></i>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                @if($memberInstagram)--}}
{{--                                    <a href="{{ $memberInstagram }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">--}}
{{--                                        <i class="fab fa-instagram"></i>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endif--}}

<!-- Timeline Section -->
@if(!empty($milestones))
    <section class="about-timeline py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">{{ $timelineTitle }}</h2>
            </div>

            <div class="timeline">
                @foreach($milestones as $index => $milestone)
                    @php
                        $year = data_get($milestone, 'milestone_year', '');
                        $title = data_get($milestone, 'milestone_title.' . app()->getLocale(), '');
                        $description = data_get($milestone, 'milestone_description.' . app()->getLocale(), '');
                        $icon = data_get($milestone, 'milestone_icon', 'fas fa-flag');
                        $image = data_get($milestone, 'milestone_image', '');
                        $isLeft = $index % 2 === 0;
                    @endphp

                    <div class="timeline-item {{ $isLeft ? 'left' : 'right' }}" data-aos="fade-{{ $isLeft ? 'right' : 'left' }}">
                        <div class="timeline-icon">
                            <i class="{{ $icon }}"></i>
                        </div>
                        <div class="timeline-content">
                            <span class="timeline-year">{{ $year }}</span>
                            <h4 class="fw-bold mb-2">{{ $title }}</h4>
                            <p class="text-muted mb-3">{!! $description !!}</p>
                            @if($image)
                                <img src="{{ asset($image) }}" alt="{{ $title }}" class="img-fluid rounded-3">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Awards Section -->
@if(!empty($awards))
    <section class="about-awards py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">{{ $awardsTitle }}</h2>
            </div>

            <div class="row g-4">
                @foreach($awards as $index => $award)
                    @php
                        $awardName = data_get($award, 'award_name.' . app()->getLocale(), '');
                        $awardOrg = data_get($award, 'award_organization.' . app()->getLocale(), '');
                        $awardYear = data_get($award, 'award_year', '');
                        $awardImage = data_get($award, 'award_image', '');
                        $awardDesc = data_get($award, 'award_description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="award-card h-100 p-4 bg-white rounded-4 shadow-sm text-center">
                            @if($awardImage)
                                <img src="{{ asset($awardImage) }}" alt="{{ $awardName }}" class="award-logo mb-3">
                            @endif
                            <h5 class="fw-bold mb-2">{{ $awardName }}</h5>
                            <p class="text-primary mb-2">{{ $awardOrg }}</p>
                            <span class="badge bg-secondary mb-3">{{ $awardYear }}</span>
                            @if($awardDesc)
                                <p class="text-muted small mb-0">{!! $awardDesc !!}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- CTA Section -->
@if($ctaTitle)
    <section class="about-cta py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-3">{{ $ctaTitle }}</h2>
                    @if($ctaDescription)
                        <p class="lead mb-0">{{ $ctaDescription }}</p>
                    @endif
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                    <a href="{{ $ctaButtonUrl }}" class="btn btn-light btn-lg px-5">
                        {{ $ctaButtonText }}
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Video Modal -->
@if($heroVideoUrl)
    <div class="modal fade" id="videoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white" data-bs-dismiss="modal"></button>
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $heroVideoUrl }}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@push('styles')
    <style>
        /* Value Cards */
        .value-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .value-card:hover {
            transform: translateY(-10px);
            border-color: #0d6efd;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }

        .value-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Team Cards */
        .team-photo img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border: 5px solid #f8f9fa;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .team-placeholder {
            width: 180px;
            height: 180px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .team-social a {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding: 50px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 3px;
            height: 100%;
            background: #dee2e6;
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 50px;
            width: 50%;
            padding: 0 40px;
        }

        .timeline-item.left {
            left: 0;
            text-align: right;
        }

        .timeline-item.right {
            left: 50%;
            text-align: left;
        }

        .timeline-icon {
            position: absolute;
            top: 0;
            width: 50px;
            height: 50px;
            background: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .timeline-item.left .timeline-icon {
            right: -25px;
        }

        .timeline-item.right .timeline-icon {
            left: -25px;
        }

        .timeline-content {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .timeline-year {
            display: inline-block;
            padding: 5px 15px;
            background: #0d6efd;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Awards */
        .award-logo {
            max-width: 120px;
            max-height: 80px;
            object-fit: contain;
            filter: grayscale(100%);
            transition: all 0.3s ease;
        }

        .award-card:hover .award-logo {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        /* Stats Counter */
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 80px;
                padding-right: 20px;
                text-align: left !important;
            }

            .timeline-item.left,
            .timeline-item.right {
                left: 0;
            }

            .timeline-item .timeline-icon {
                left: 5px !important;
                right: auto !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Counter Animation
        const counters = document.querySelectorAll('.counter');

        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target;
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current);
                }
            }, 16);
        };

        // Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    </script>
@endpush