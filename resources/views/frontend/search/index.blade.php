@extends('frontend.layouts.master')

@section('title', 'Arama Sonuçları: ' . $query)

@section('content')
    <div class="izokoc_search_page">
        <div class="izokoc_container">
            {{-- Arama Başlığı --}}
            <div class="izokoc_search_header">
                <h1 class="izokoc_search_title">
                    @if(!empty($query))
                        "<span class="izokoc_search_query">{{ $query }}</span>" {{ __('search_results_for') }}
                    @else
                    {{ __('search-only') }}
                    @endif
                </h1>

                @if(!empty($query))
                    <div class="izokoc_search_meta">
                    <span class="izokoc_results_count">
                        <i class="fas fa-search"></i>
                        {{ number_format($totalResults, 0, ',', '.') }} {{ __('results_found') }}
                    </span>
                        <span class="izokoc_execution_time">
                        <i class="fas fa-clock"></i>
                        {{ $executionTime }} ms
                    </span>
                    </div>
                @endif
            </div>

            {{-- Arama Formu --}}
            <div class="izokoc_search_form_wrapper">
                <form action="{{ route('frontend.search') }}" method="GET" class="izokoc_search_form_page">
                    <div class="izokoc_search_input_group">
                        <i class="fas fa-search izokoc_search_icon"></i>
                        <input
                                type="search"
                                name="s"
                                value="{{ $query }}"
                                placeholder="{{ __('search_placeholder') }}"
                                class="izokoc_search_input_page"
                                autocomplete="off"
                                autofocus
                        >
                        <button type="submit" class="izokoc_search_btn_page">
                            <i class="fas fa-arrow-right"></i>
                            {{ __('search-only') }}
                        </button>
                    </div>
                </form>
            </div>

            {{-- Sonuçlar --}}
            @if(!empty($query))
                @if($results->count() > 0)
                    <div class="izokoc_search_results">
                        @foreach($results as $index => $result)
                            <article class="izokoc_search_result_item" data-type="{{ $result['type'] }}">
                                {{-- Tip Badge --}}
                                <div class="izokoc_result_header">
                                <span class="izokoc_result_type {{ $result['type'] }}">
                                    <i class="{{ $result['icon'] }}"></i>
                                    {{ $result['type_label'] }}
                                </span>
                                    <span class="izokoc_result_date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $result['date'] }}
                                </span>
                                </div>

                                {{-- Başlık --}}
                                <h2 class="izokoc_result_title">
                                    <a href="{{ $result['url'] }}" class="izokoc_result_link">
                                        {!! $result['title'] !!}
                                    </a>
                                </h2>

                                {{-- Breadcrumb --}}
                                <div class="izokoc_result_breadcrumb">
                                    <i class="fas fa-folder-open"></i>
                                    {{ $result['breadcrumb'] }}
                                </div>

                                {{-- URL --}}
                                <div class="izokoc_result_url">
                                    {{ parse_url($result['url'], PHP_URL_HOST) }}{{ parse_url($result['url'], PHP_URL_PATH) }}
                                </div>

                                {{-- Açıklama/Snippet --}}
                                <p class="izokoc_result_description">
                                    {!! $result['description'] !!}
                                </p>

                                {{-- Post ve Service için özel: Featured Image --}}
                                @if(($result['type'] === 'post' || $result['type'] === 'service') && !empty($result['image']))
                                    <div class="izokoc_result_image">
                                        <img src="{{ asset($result['image']) }}" alt="{{ $result['title'] }}" loading="lazy">
                                    </div>
                                @endif

                                {{-- Relevance Score (Debug için - production'da kaldırabilirsiniz) --}}
                                @if(config('app.debug'))
                                    <span class="izokoc_relevance_badge" title="Relevance Score">
                                    {{ $result['relevance'] }}
                                </span>
                                @endif
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination (eğer eklemek isterseniz) --}}
                    {{-- <div class="izokoc_search_pagination">
                        {{ $results->links() }}
                    </div> --}}

                @else
                    {{-- Sonuç Bulunamadı --}}
                    <div class="izokoc_no_results">
                        <div class="izokoc_no_results_icon">
                            <i class="fas fa-search-minus"></i>
                        </div>
                        <h2 class="izokoc_no_results_title">{{ __('no_results_title') }}</h2>
                        <p class="izokoc_no_results_text">
                            "<strong>{{ $query }}</strong>" {{ __('no_results_text') }}
                        </p>
                        <div class="izokoc_search_suggestions">
                            <h3>{{ __('search_tips_title') }}</h3>
                            <ul>
                                <li><i class="fas fa-check"></i>{{ __('tip_1') }}</li>
                                <li><i class="fas fa-check"></i>{{ __('tip_2') }}</li>
                                <li><i class="fas fa-check"></i>{{ __('tip_3') }}</li>
                                <li><i class="fas fa-check"></i>{{ __('tip_4') }}</li>
                            </ul>
                        </div>
                    </div>
                @endif
            @else
                {{-- İlk Arama Ekranı --}}
                <div class="izokoc_search_welcome">
                    <div class="izokoc_search_welcome_icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2>{{ __('initial_search_title') }}</h2>
                    <p>{{ __('initial_search_text') }}</p>

                    <div class="izokoc_popular_searches">
                        <h3>{{ __('popular_searches_title') }}</h3>
                        <div class="izokoc_popular_tags">
                            <a href="{{ route('frontend.search', ['s' => 'izolasyon']) }}" class="izokoc_popular_tag">
                                <i class="fas fa-fire"></i> {{ __('popular_search_1') }}
                            </a>
                            <a href="{{ route('frontend.search', ['s' => 'mantolama']) }}" class="izokoc_popular_tag">
                                <i class="fas fa-fire"></i> {{ __('popular_search_2') }}
                            </a>
                            <a href="{{ route('frontend.search', ['s' => 'yalıtım']) }}" class="izokoc_popular_tag">
                                <i class="fas fa-fire"></i> {{ __('popular_search_3') }}
                            </a>
                            <a href="{{ route('frontend.search', ['s' => 'çatı']) }}" class="izokoc_popular_tag">
                                <i class="fas fa-fire"></i> {{ __('popular_search_4') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @push('styles')
        <style>
            /* ========================================
               İZOKOÇ SEARCH PAGE STYLES
            ======================================== */

            .izokoc_search_page {
                padding: 60px 0 100px;
                background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
                min-height: 70vh;
            }

            /* ========== SEARCH HEADER ========== */
            .izokoc_search_header {
                text-align: center;
                margin-bottom: 40px;
            }

            .izokoc_search_title {
                font-size: 32px;
                color: #1a237e;
                margin-bottom: 15px;
                font-weight: 700;
            }

            .izokoc_search_query {
                color: var(--primary-color);
            }

            .izokoc_search_meta {
                display: flex;
                justify-content: center;
                gap: 30px;
                font-size: 14px;
                color: #7f8c8d;
            }

            .izokoc_search_meta span {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .izokoc_search_meta i {
                font-size: 16px;
            }

            /* ========== SEARCH FORM ========== */
            .izokoc_search_form_wrapper {
                max-width: 800px;
                margin: 0 auto 50px;
            }

            .izokoc_search_input_group {
                position: relative;
                display: flex;
                align-items: center;
                background: #fff;
                border-radius: 50px;
                padding: 8px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .izokoc_search_icon {
                position: absolute;
                left: 25px;
                color: #7f8c8d;
                font-size: 18px;
            }

            .izokoc_search_input_page {
                flex: 1;
                border: none;
                outline: none;
                padding: 15px 20px 15px 55px;
                font-size: 16px;
                background: transparent;
                color: #2c3e50;
            }

            .izokoc_search_btn_page {
                background: var(--gradient-primary);
                border: none;
                color: #fff;
                padding: 15px 35px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 15px;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 10px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .izokoc_search_btn_page:hover {
                transform: translateX(5px);
                box-shadow: 0 5px 15px rgba(255, 49, 49, 0.4);
            }

            /* ========== SEARCH RESULTS ========== */
            .izokoc_search_results {
                max-width: 900px;
                margin: 0 auto;
            }

            .izokoc_search_result_item {
                background: #fff;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                position: relative;
                border-left: 4px solid transparent;
            }

            .izokoc_search_result_item:hover {
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                border-left-color: #FF3131;
                transform: translateX(5px);
            }

            .izokoc_result_header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
            }

            .izokoc_result_type {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 15px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .izokoc_result_type.page {
                background: linear-gradient(135deg, #e3f2fd, #bbdefb);
                color: #1976d2;
            }

            .izokoc_result_type.section {
                background: linear-gradient(135deg, #f3e5f5, #e1bee7);
                color: #7b1fa2;
            }

            .izokoc_result_type.service {
                background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
                color: #00695c;
            }

            .izokoc_result_type.post {
                background: linear-gradient(135deg, #fff3e0, #ffe0b2);
                color: #f57c00;
            }

            .izokoc_result_type.category {
                background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
                color: #388e3c;
            }

            .izokoc_result_date {
                font-size: 13px;
                color: #7f8c8d;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .izokoc_result_title {
                font-size: 22px;
                margin-bottom: 10px;
                line-height: 1.4;
            }

            .izokoc_result_link {
                color: #1a237e;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .izokoc_result_link:hover {
                color: #FF3131;
            }

            .izokoc_result_breadcrumb {
                font-size: 13px;
                color: #7f8c8d;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .izokoc_result_url {
                font-size: 14px;
                color: #2962FF;
                margin-bottom: 12px;
                font-family: monospace;
            }

            .izokoc_result_description {
                font-size: 15px;
                line-height: 1.6;
                color: #555;
                margin: 0;
            }

            .izokoc_result_description mark {
                background: #fff59d;
                padding: 2px 4px;
                border-radius: 3px;
                font-weight: 600;
                color: #1a237e;
            }

            .izokoc_result_image {
                margin-top: 15px;
                border-radius: 8px;
                overflow: hidden;
                max-width: 200px;
            }

            .izokoc_result_image img {
                width: 100%;
                height: auto;
                display: block;
                transition: transform 0.3s ease;
            }

            .izokoc_search_result_item:hover .izokoc_result_image img {
                transform: scale(1.05);
            }

            .izokoc_relevance_badge {
                position: absolute;
                top: 10px;
                right: 10px;
                background: #e0e0e0;
                color: #666;
                padding: 4px 10px;
                border-radius: 12px;
                font-size: 11px;
                font-weight: 600;
            }

            /* ========== NO RESULTS ========== */
            .izokoc_no_results {
                text-align: center;
                padding: 60px 20px;
                max-width: 600px;
                margin: 0 auto;
            }

            .izokoc_no_results_icon {
                font-size: 80px;
                color: #e0e0e0;
                margin-bottom: 20px;
            }

            .izokoc_no_results_title {
                font-size: 28px;
                color: #1a237e;
                margin-bottom: 15px;
            }

            .izokoc_no_results_text {
                font-size: 16px;
                color: #7f8c8d;
                margin-bottom: 30px;
            }

            .izokoc_search_suggestions {
                background: #f8f9fa;
                border-radius: 12px;
                padding: 30px;
                text-align: left;
            }

            .izokoc_search_suggestions h3 {
                font-size: 18px;
                color: #1a237e;
                margin-bottom: 20px;
            }

            .izokoc_search_suggestions ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .izokoc_search_suggestions li {
                padding: 10px 0;
                color: #555;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .izokoc_search_suggestions li i {
                color: #4caf50;
                font-size: 14px;
            }

            /* ========== WELCOME SCREEN ========== */
            .izokoc_search_welcome {
                text-align: center;
                padding: 80px 20px;
            }

            .izokoc_search_welcome_icon {
                font-size: 100px;
                color: #e0e0e0;
                margin-bottom: 30px;
            }

            .izokoc_search_welcome h2 {
                font-size: 32px;
                color: #1a237e;
                margin-bottom: 15px;
            }

            .izokoc_search_welcome p {
                font-size: 18px;
                color: #7f8c8d;
                margin-bottom: 50px;
            }

            .izokoc_popular_searches {
                max-width: 600px;
                margin: 0 auto;
            }

            .izokoc_popular_searches h3 {
                font-size: 18px;
                color: #1a237e;
                margin-bottom: 20px;
            }

            .izokoc_popular_tags {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                justify-content: center;
            }

            .izokoc_popular_tag {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 12px 24px;
                background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
                border-radius: 25px;
                color: #1a237e;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .izokoc_popular_tag:hover {
                background: linear-gradient(135deg, #FF3131, #2962FF);
                color: #fff;
                transform: translateY(-3px);
                box-shadow: 0 5px 20px rgba(255, 49, 49, 0.3);
            }

            .izokoc_popular_tag i {
                color: #ff9800;
            }

            .izokoc_popular_tag:hover i {
                color: #fff;
            }

            /* ========== RESPONSIVE ========== */
            @media screen and (max-width: 768px) {
                .izokoc_search_page {
                    padding: 40px 0 60px;
                }

                .izokoc_search_title {
                    font-size: 24px;
                }

                .izokoc_search_meta {
                    flex-direction: column;
                    gap: 10px;
                }

                .izokoc_search_input_page {
                    padding: 12px 15px 12px 50px;
                    font-size: 14px;
                }

                .izokoc_search_btn_page {
                    padding: 12px 25px;
                    font-size: 14px;
                }

                .izokoc_search_result_item {
                    padding: 20px;
                }

                .izokoc_result_title {
                    font-size: 18px;
                }

                .izokoc_result_header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 10px;
                }

                .izokoc_popular_tags {
                    flex-direction: column;
                }

                .izokoc_popular_tag {
                    width: 100%;
                    justify-content: center;
                }
            }

            @media screen and (max-width: 576px) {
                .izokoc_search_btn_page span {
                    display: none;
                }

                .izokoc_search_btn_page {
                    width: 50px;
                    height: 50px;
                    padding: 0;
                    justify-content: center;
                }
            }
        </style>
    @endpush
@endsection