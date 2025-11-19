@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), '');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $layoutStyle = data_get($content, 'layout_style', 'grid');
    $featureCategories = data_get($content, 'feature_categories', []);
@endphp

<section class="nextmedya-ecommerce-features">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <div class="nextmedya-section-header">
                    @if($sectionSubtitle)
                        <span class="nextmedya-section-badge">{{ $sectionSubtitle }}</span>
                    @endif
                    <h2 class="nextmedya-section-title">{{ $sectionTitle }}</h2>
                </div>
            </div>
        </div>

        @if($layoutStyle === 'tabs')
            <!-- Tabs Layout -->
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nextmedya-feature-tabs nav nav-pills" role="tablist">
                        @foreach($featureCategories as $index => $category)
                            @php
                                $categoryName = data_get($category, 'category_name.' . app()->getLocale());
                                $categoryIcon = data_get($category, 'category_icon', 'fas fa-shopping-cart');
                                $categoryColor = data_get($category, 'category_color', '#3b82f6');
                            @endphp
                            <li class="nav-item" role="presentation">
                                <button class="nextmedya-feature-tab nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ $index }}"
                                        data-bs-toggle="pill"
                                        data-bs-target="#content-{{ $index }}"
                                        type="button"
                                        role="tab"
                                        style="--tab-color: {{ $categoryColor }}">
                                    <i class="{{ $categoryIcon }}"></i>
                                    <span>{{ $categoryName }}</span>
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content nextmedya-feature-tab-content">
                        @foreach($featureCategories as $index => $category)
                            @php
                                $features = data_get($category, 'features', []);
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                 id="content-{{ $index }}"
                                 role="tabpanel">
                                <div class="row">
                                    @foreach($features as $feature)
                                        @php
                                            $featureIcon = data_get($feature, 'feature_icon', 'fas fa-check');
                                            $featureTitle = data_get($feature, 'feature_title.' . app()->getLocale());
                                            $featureDescription = data_get($feature, 'feature_description.' . app()->getLocale());
                                            $featureImage = data_get($feature, 'feature_image');
                                        @endphp
                                        <div class="col-lg-6">
                                            <div class="nextmedya-feature-card">
                                                <div class="nextmedya-feature-icon">
                                                    <i class="{{ $featureIcon }}"></i>
                                                </div>
                                                <div class="nextmedya-feature-content">
                                                    <h4 class="nextmedya-feature-title">{{ $featureTitle }}</h4>
                                                    <p class="nextmedya-feature-description">{!! $featureDescription !!}</p>
                                                </div>
                                                @if($featureImage)
                                                    <img src="{{ asset($featureImage) }}" alt="{{ $featureTitle }}" class="nextmedya-feature-img">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @elseif($layoutStyle === 'accordion')
            <!-- Accordion Layout -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="accordion nextmedya-feature-accordion" id="featureAccordion">
                        @foreach($featureCategories as $index => $category)
                            @php
                                $categoryName = data_get($category, 'category_name.' . app()->getLocale());
                                $categoryIcon = data_get($category, 'category_icon', 'fas fa-shopping-cart');
                                $features = data_get($category, 'features', []);
                            @endphp
                            <div class="accordion-item nextmedya-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $index }}">
                                        <i class="{{ $categoryIcon }}"></i>
                                        <span>{{ $categoryName }}</span>
                                    </button>
                                </h2>
                                <div id="collapse-{{ $index }}"
                                     class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                     data-bs-parent="#featureAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @foreach($features as $feature)
                                                @php
                                                    $featureIcon = data_get($feature, 'feature_icon', 'fas fa-check');
                                                    $featureTitle = data_get($feature, 'feature_title.' . app()->getLocale());
                                                    $featureDescription = data_get($feature, 'feature_description.' . app()->getLocale());
                                                @endphp
                                                <div class="col-md-6">
                                                    <div class="nextmedya-feature-item">
                                                        <i class="{{ $featureIcon }}"></i>
                                                        <div>
                                                            <strong>{{ $featureTitle }}</strong>
                                                            <p>{{ $featureDescription }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @else
            <!-- Grid Layout (Default) -->
            <div class="row nextmedya-features-grid">
                @foreach($featureCategories as $category)
                    @php
                        $categoryName = data_get($category, 'category_name.' . app()->getLocale());
                        $categoryIcon = data_get($category, 'category_icon', 'fas fa-shopping-cart');
                        $categoryColor = data_get($category, 'category_color', '#3b82f6');
                        $features = data_get($category, 'features', []);
                    @endphp
                    <div class="col-lg-12" data-aos="fade-up">
                        <div class="nextmedya-feature-category" style="--category-color: {{ $categoryColor }}">
                            <div class="nextmedya-category-header">
                                <i class="{{ $categoryIcon }}"></i>
                                <h3>{{ $categoryName }}</h3>
                            </div>
                            <div class="row">
                                @foreach($features as $feature)
                                    @php
                                        $featureIcon = data_get($feature, 'feature_icon', 'fas fa-check');
                                        $featureTitle = data_get($feature, 'feature_title.' . app()->getLocale());
                                        $featureDescription = data_get($feature, 'feature_description.' . app()->getLocale());
                                    @endphp
                                    <div class="col-lg-4 col-md-6">
                                        <div class="nextmedya-feature-box">
                                            <div class="nextmedya-feature-icon">
                                                <i class="{{ $featureIcon }}"></i>
                                            </div>
                                            <h5>{{ $featureTitle }}</h5>
                                            <p>{{ $featureDescription }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-ecommerce-features {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .nextmedya-section-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .nextmedya-section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 60px;
        }

        /* Grid Layout */
        .nextmedya-feature-category {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--category-color);
        }

        .nextmedya-category-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }

        .nextmedya-category-header i {
            font-size: 2.5rem;
            color: var(--category-color);
        }

        .nextmedya-category-header h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .nextmedya-feature-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .nextmedya-feature-box:hover {
            transform: translateY(-5px);
            border-color: var(--category-color);
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .nextmedya-feature-box .nextmedya-feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--category-color), color-mix(in srgb, var(--category-color) 80%, black));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .nextmedya-feature-box .nextmedya-feature-icon i {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .nextmedya-feature-box h5 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .nextmedya-feature-box p {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        /* Tabs Layout */
        .nextmedya-feature-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            justify-content: center;
            border: none;
        }

        .nextmedya-feature-tab {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            padding: 16px 28px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s ease;
        }

        .nextmedya-feature-tab i {
            font-size: 1.25rem;
        }

        .nextmedya-feature-tab.active {
            background: var(--tab-color);
            color: #ffffff;
            border-color: var(--tab-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-feature-tab:hover:not(.active) {
            border-color: var(--tab-color);
            color: var(--tab-color);
        }

        .nextmedya-feature-tab-content {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .nextmedya-feature-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            display: flex;
            gap: 20px;
            align-items: start;
            transition: all 0.3s ease;
        }

        .nextmedya-feature-card:hover {
            transform: translateX(10px);
            background: #ffffff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .nextmedya-feature-card .nextmedya-feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nextmedya-feature-card .nextmedya-feature-icon i {
            color: #ffffff;
            font-size: 1.25rem;
        }

        .nextmedya-feature-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .nextmedya-feature-description {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        /* Accordion Layout */
        .nextmedya-feature-accordion .nextmedya-accordion-item {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            margin-bottom: 16px;
            overflow: hidden;
        }

        .nextmedya-feature-accordion .accordion-button {
            padding: 24px 30px;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            background: #ffffff;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nextmedya-feature-accordion .accordion-button i {
            font-size: 1.5rem;
            color: #667eea;
        }

        .nextmedya-feature-accordion .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
        }

        .nextmedya-feature-accordion .accordion-button:not(.collapsed) i {
            color: #ffffff;
        }

        .nextmedya-feature-item {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
        }

        .nextmedya-feature-item i {
            font-size: 1.5rem;
            color: #667eea;
            flex-shrink: 0;
        }

        .nextmedya-feature-item strong {
            display: block;
            font-size: 1rem;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .nextmedya-feature-item p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0;
            line-height: 1.6;
        }

        @media (max-width: 992px) {
            .nextmedya-ecommerce-features {
                padding: 60px 0;
            }

            .nextmedya-feature-category {
                padding: 30px 20px;
            }

            .nextmedya-category-header {
                flex-direction: column;
                text-align: center;
            }

            .nextmedya-feature-tabs {
                flex-direction: column;
            }

            .nextmedya-feature-tab {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush