@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $sectionDescription = data_get($content, 'section_description.' . app()->getLocale(), '');
    $showContactCta = data_get($content, 'show_contact_cta', true);
    $ctaTitle = data_get($content, 'cta_title.' . app()->getLocale(), '');
    $ctaDescription = data_get($content, 'cta_description.' . app()->getLocale(), '');
    $ctaButtonText = data_get($content, 'cta_button_text.' . app()->getLocale(), '');
    $ctaButtonUrl = data_get($content, 'cta_button_url', '#contact');
    $faqCategories = data_get($content, 'faq_categories', []);
@endphp

<section class="nextmedya-ecommerce-faq">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                @if($sectionSubtitle)
                    <span class="nextmedya-faq-badge">{{ $sectionSubtitle }}</span>
                @endif
                <h2 class="nextmedya-faq-title">{{ $sectionTitle }}</h2>
            </div>
        </div>

        <div class="row">
            <!-- FAQ Categories Sidebar -->
            @if(count($faqCategories) > 1)
                <div class="col-lg-3" data-aos="fade-right">
                    <div class="nextmedya-faq-categories">
                        <h4 class="nextmedya-categories-title">Kategoriler</h4>
                        <ul class="nextmedya-category-list">
                            @foreach($faqCategories as $index => $category)
                                @php
                                    $categoryName = data_get($category, 'category_name.' . app()->getLocale());
                                    $categoryIcon = data_get($category, 'category_icon', 'fas fa-question-circle');
                                @endphp
                                <li>
                                    <a href="#faq-category-{{ $index }}" class="nextmedya-category-link {{ $loop->first ? 'active' : '' }}">
                                        <i class="{{ $categoryIcon }}"></i>
                                        <span>{{ $categoryName }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- FAQ Content -->
            <div class="col-lg-{{ count($faqCategories) > 1 ? '9' : '12' }}">
                @foreach($faqCategories as $categoryIndex => $category)
                    @php
                        $categoryName = data_get($category, 'category_name.' . app()->getLocale());
                        $categoryIcon = data_get($category, 'category_icon', 'fas fa-question-circle');
                        $questions = data_get($category, 'questions', []);
                    @endphp

                    <div class="nextmedya-faq-category-section" id="faq-category-{{ $categoryIndex }}" data-aos="fade-up">
                        <div class="nextmedya-faq-category-header">
                            <i class="{{ $categoryIcon }}"></i>
                            <h3>{{ $categoryName }}</h3>
                        </div>

                        <div class="accordion nextmedya-faq-accordion" id="faqAccordion-{{ $categoryIndex }}">
                            @foreach($questions as $questionIndex => $faq)
                                @php
                                    $question = data_get($faq, 'question.' . app()->getLocale());
                                    $answer = data_get($faq, 'answer.' . app()->getLocale());
                                    $isHighlighted = data_get($faq, 'is_highlighted', false);
                                    $accordionId = "faq-{$categoryIndex}-{$questionIndex}";
                                @endphp
                                <div class="accordion-item nextmedya-faq-item {{ $isHighlighted ? 'highlighted' : '' }}">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $loop->first && $categoryIndex === 0 ? '' : 'collapsed' }}"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#{{ $accordionId }}"
                                                aria-expanded="{{ $loop->first && $categoryIndex === 0 ? 'true' : 'false' }}">
                                            @if($isHighlighted)
                                                <i class="fas fa-star nextmedya-highlight-icon"></i>
                                            @endif
                                            {{ $question }}
                                        </button>
                                    </h2>
                                    <div id="{{ $accordionId }}"
                                         class="accordion-collapse collapse {{ $loop->first && $categoryIndex === 0 ? 'show' : '' }}"
                                         data-bs-parent="#faqAccordion-{{ $categoryIndex }}">
                                        <div class="accordion-body">
                                            <p>{!! $answer !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Contact CTA -->
        @if($showContactCta)
            <div class="row">
                <div class="col-lg-10 mx-auto" data-aos="fade-up">
                    <div class="nextmedya-faq-cta">
                        <div class="nextmedya-cta-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="nextmedya-cta-content">
                            <h4>{{ $ctaTitle }}</h4>
                            <p>{{ $ctaDescription }}</p>
                        </div>
                        <a href="{{ $ctaButtonUrl }}" class="nextmedya-cta-btn">
                            {{ $ctaButtonText }}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-ecommerce-faq {
            padding: 100px 0;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        }

        .nextmedya-faq-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .nextmedya-faq-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .nextmedya-faq-description {
            font-size: 1.125rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 60px;
            line-height: 1.8;
        }

        /* FAQ Categories Sidebar */
        .nextmedya-faq-categories {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 100px;
        }

        .nextmedya-categories-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .nextmedya-category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nextmedya-category-list li {
            margin-bottom: 10px;
        }

        .nextmedya-category-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .nextmedya-category-link i {
            font-size: 1.125rem;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .nextmedya-category-link:hover,
        .nextmedya-category-link.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #ffffff;
        }

        .nextmedya-category-link:hover i,
        .nextmedya-category-link.active i {
            color: #ffffff;
        }

        /* FAQ Category Section */
        .nextmedya-faq-category-section {
            margin-bottom: 50px;
        }

        .nextmedya-faq-category-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 30px;
            padding: 20px 30px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .nextmedya-faq-category-header i {
            font-size: 2rem;
            color: #f59e0b;
        }

        .nextmedya-faq-category-header h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* FAQ Accordion */
        .nextmedya-faq-accordion .nextmedya-faq-item {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            margin-bottom: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .nextmedya-faq-accordion .nextmedya-faq-item:hover {
            border-color: #f59e0b;
            box-shadow: 0 5px 20px rgba(245, 158, 11, 0.1);
        }

        .nextmedya-faq-accordion .nextmedya-faq-item.highlighted {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%);
        }

        .nextmedya-faq-accordion .accordion-button {
            padding: 24px 30px;
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            background: transparent;
            box-shadow: none;
            position: relative;
        }

        .nextmedya-highlight-icon {
            color: #f59e0b;
            margin-right: 12px;
            font-size: 1rem;
            animation: pulse 2s infinite;
        }

        .nextmedya-faq-accordion .accordion-button:not(.collapsed) {
            background: transparent;
            color: #f59e0b;
        }

        .nextmedya-faq-accordion .accordion-button::after {
            width: 1.5rem;
            height: 1.5rem;
            background-size: 1.5rem;
        }

        .nextmedya-faq-accordion .accordion-body {
            padding: 0 30px 30px 30px;
        }

        .nextmedya-faq-accordion .accordion-body p {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.8;
            margin: 0;
        }

        /* Contact CTA */
        .nextmedya-faq-cta {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 24px;
            padding: 50px 60px;
            display: flex;
            align-items: center;
            gap: 30px;
            margin-top: 60px;
            box-shadow: 0 20px 60px rgba(245, 158, 11, 0.3);
        }

        .nextmedya-cta-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nextmedya-cta-icon i {
            font-size: 2.5rem;
            color: #ffffff;
        }

        .nextmedya-cta-content {
            flex: 1;
        }

        .nextmedya-cta-content h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .nextmedya-cta-content p {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        .nextmedya-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: #ffffff;
            color: #f59e0b;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .nextmedya-cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #d97706;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @media (max-width: 992px) {
            .nextmedya-ecommerce-faq {
                padding: 60px 0;
            }

            .nextmedya-faq-categories {
                margin-bottom: 40px;
                position: static;
            }

            .nextmedya-faq-category-header {
                flex-direction: column;
                text-align: center;
            }

            .nextmedya-faq-cta {
                flex-direction: column;
                text-align: center;
                padding: 40px 30px;
            }

            .nextmedya-cta-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for category links
            const categoryLinks = document.querySelectorAll('.nextmedya-category-link');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all links
                    categoryLinks.forEach(l => l.classList.remove('active'));

                    // Add active class to clicked link
                    this.classList.add('active');

                    // Scroll to target
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        const offset = 100;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - offset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Update active category on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        categoryLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, { threshold: 0.5 });

            document.querySelectorAll('.nextmedya-faq-category-section').forEach(section => {
                observer.observe(section);
            });
        });
    </script>
@endpush