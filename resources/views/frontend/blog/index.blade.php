@extends('frontend.layouts.master')

@section('page_meta')
    <title>{{ $pageTitle }} | Blog</title>
    <meta name="description" content="{{ __('Read our latest blog posts and breaking news.') }}">
@endsection

@section('content')
    <x-page-banner :title="$pageTitle" subtitle="{{ __('The latest developments and news in the industry.') }}" />

    <section class="izokoc-blog-list-section">
        <div class="container">
            <div class="row">
                {{-- ANA İÇERİK: YAZI LİSTESİ --}}
                <div class="col-lg-8">
                    <div class="izokoc-blog-grid">
                        @forelse($posts as $post)
                            <article class="izokoc-blog-card" data-aos="fade-up"
                                     data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="izokoc-blog-card__image">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <img src="{{ asset($post->featured_image) }}"
                                             alt="{{ $post->featured_image_alt_text ?: $post->title }}"
                                             loading="lazy">
                                    </a>
                                    @if($post->category)
                                        <a href="{{ route('blog.category', $post->category->slug) }}"
                                           class="izokoc-blog-card__category">
                                            {{ $post->category->name }}
                                        </a>
                                    @endif
                                </div>

                                <div class="izokoc-blog-card__content">
                                    <div class="izokoc-blog-card__meta">
                                        <span class="izokoc-blog-card__meta-item">
                                            <i class="icofont-user-alt-7"></i>
                                            {{ $post->author->name }}
                                        </span>
                                        <span class="izokoc-blog-card__meta-item">
                                            <i class="icofont-calendar"></i>
                                            {{ $post->published_date_formatted }}
                                        </span>
                                    </div>

                                    <h3 class="izokoc-blog-card__title">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    @if($post->excerpt)
                                        <p class="izokoc-blog-card__excerpt">
                                            {{ Str::limit($post->excerpt, 120) }}
                                        </p>
                                    @endif

                                    <a href="{{ route('blog.show', $post->slug) }}"
                                       class="izokoc-blog-card__readmore">
                                        {{ __('read_more') }}
                                        <i class="icofont-long-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="izokoc-no-results">
                                <i class="icofont-search-document"></i>
                                <h4>{{ __('no_posts_found') }}</h4>
                                <p>{{ __('Try adjusting your search or filter to find what you are looking for.') }}</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Sayfalama --}}
                    @if($posts->hasPages())
                        <div class="izokoc-pagination">
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <div class="col-lg-4">
                    <aside class="izokoc-sidebar">
                        {{-- Arama Widget'ı --}}
                        <div class="izokoc-widget izokoc-widget--search">
                            <form action="{{ route('blog.index') }}" method="GET" class="izokoc-search-form">
                                <input type="search"
                                       name="q"
                                       placeholder="{{ __('search_articles') }}"
                                       value="{{ request('q') }}"
                                       class="izokoc-search-form__input">
                                <button type="submit" class="izokoc-search-form__button">
                                    <i class="icofont-search-1"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Kategoriler Widget'ı --}}
                        @if($categories->isNotEmpty())
                            <div class="izokoc-widget izokoc-widget--categories">
                                <h3 class="izokoc-widget__title">{{ __('categories') }}</h3>
                                <ul class="izokoc-category-list">
                                    @foreach($categories as $category)
                                        <li class="izokoc-category-list__item">
                                            <a href="{{ route('blog.category', $category->slug) }}"
                                               class="izokoc-category-list__link">
                                                <i class="icofont-folder"></i>
                                                <span>{{ $category->name }}</span>
                                                <span class="izokoc-category-list__count">{{ $category->posts_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Son Yazılar Widget'ı --}}
                        @if($recentPosts->isNotEmpty())
                            <div class="izokoc-widget izokoc-widget--recent">
                                <h3 class="izokoc-widget__title">{{ __('recent_posts') }}</h3>
                                <ul class="izokoc-recent-posts">
                                    @foreach($recentPosts as $recentPost)
                                        <li class="izokoc-recent-posts__item">
                                            <a href="{{ route('blog.show', $recentPost->slug) }}"
                                               class="izokoc-recent-posts__link">
                                                <div class="izokoc-recent-posts__thumb">
                                                    <img src="{{ asset($recentPost->featured_image) }}"
                                                         alt="{{ $recentPost->title }}"
                                                         loading="lazy">
                                                </div>
                                                <div class="izokoc-recent-posts__content">
                                                    <span class="izokoc-recent-posts__date">
                                                        <i class="icofont-calendar"></i>
                                                        {{ $recentPost->published_date_formatted }}
                                                    </span>
                                                    <h6 class="izokoc-recent-posts__title">
                                                        {{ Str::limit($recentPost->title, 50) }}
                                                    </h6>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Etiketler Widget'ı (İsteğe bağlı) --}}
                        @if(isset($tags) && $tags->isNotEmpty())
                            <div class="izokoc-widget izokoc-widget--tags">
                                <h3 class="izokoc-widget__title">{{ __('popular_tags') }}</h3>
                                <div class="izokoc-tag-cloud">
                                    @foreach($tags as $tag)
                                        <a href="{{ route('blog.tag', $tag->slug) }}" class="izokoc-tag-cloud__item">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Blog List Section */
        .izokoc-blog-list-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        /* Blog Grid */
        .izokoc-blog-grid {
            display: grid;
            gap: 30px;
            margin-bottom: 50px;
        }

        /* Blog Card */
        .izokoc-blog-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .izokoc-blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .izokoc-blog-card__image {
            position: relative;
            height: 280px;
            overflow: hidden;
        }

        .izokoc-blog-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .izokoc-blog-card:hover .izokoc-blog-card__image img {
            transform: scale(1.1);
        }

        .izokoc-blog-card__category {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #0d6efd;
            color: #fff;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .izokoc-blog-card__category:hover {
            background: #ffab00;
            transform: translateY(-2px);
        }

        .izokoc-blog-card__content {
            padding: 30px;
        }

        .izokoc-blog-card__meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .izokoc-blog-card__meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 14px;
        }

        .izokoc-blog-card__meta-item i {
            color: #0d6efd;
            font-size: 16px;
        }

        .izokoc-blog-card__title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .izokoc-blog-card__title a {
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .izokoc-blog-card__title a:hover {
            color: #0d6efd;
        }

        .izokoc-blog-card__excerpt {
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .izokoc-blog-card__readmore {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #1a1a1a;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .izokoc-blog-card__readmore:hover {
            color: #0d6efd;
            border-bottom-color: #0d6efd;
            gap: 15px;
        }

        /* No Results */
        .izokoc-no-results {
            text-align: center;
            padding: 80px 20px;
            background: #fff;
            border-radius: 12px;
        }

        .izokoc-no-results i {
            font-size: 80px;
            color: #e0e0e0;
            margin-bottom: 20px;
        }

        .izokoc-no-results h4 {
            font-size: 24px;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .izokoc-no-results p {
            color: #666;
            font-size: 16px;
        }

        /* Pagination */
        .izokoc-pagination {
            display: flex;
            justify-content: center;
        }

        /* Sidebar */
        .izokoc-sidebar {
            position: sticky;
            top: 100px;
        }

        /* Widget Base */
        .izokoc-widget {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .izokoc-widget__title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #0d6efd;
        }

        /* Search Widget */
        .izokoc-search-form {
            display: flex;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            overflow: hidden;
            transition: border-color 0.3s ease;
        }

        .izokoc-search-form:focus-within {
            border-color: #0d6efd;
        }

        .izokoc-search-form__input {
            flex: 1;
            border: none;
            padding: 12px 20px;
            font-size: 15px;
            outline: none;
        }

        .izokoc-search-form__button {
            background: #0d6efd;
            border: none;
            padding: 0 25px;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .izokoc-search-form__button:hover {
            background: #ffab00;
        }

        /* Category List */
        .izokoc-category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .izokoc-category-list__item {
            border-bottom: 1px solid #e0e0e0;
        }

        .izokoc-category-list__item:last-child {
            border-bottom: none;
        }

        .izokoc-category-list__link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .izokoc-category-list__link:hover {
            color: #0d6efd;
            padding-left: 10px;
        }

        .izokoc-category-list__link i {
            font-size: 18px;
        }

        .izokoc-category-list__link span:first-of-type {
            flex: 1;
        }

        .izokoc-category-list__count {
            background: #f0f0f0;
            color: #666;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Recent Posts */
        .izokoc-recent-posts {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .izokoc-recent-posts__item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .izokoc-recent-posts__item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .izokoc-recent-posts__link {
            display: flex;
            gap: 15px;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .izokoc-recent-posts__link:hover {
            opacity: 0.8;
        }

        .izokoc-recent-posts__thumb {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
        }

        .izokoc-recent-posts__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .izokoc-recent-posts__content {
            flex: 1;
        }

        .izokoc-recent-posts__date {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #999;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .izokoc-recent-posts__date i {
            font-size: 14px;
        }

        .izokoc-recent-posts__title {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            line-height: 1.4;
            margin: 0;
        }

        /* Tag Cloud */
        .izokoc-tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .izokoc-tag-cloud__item {
            display: inline-block;
            background: #f0f0f0;
            color: #666;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .izokoc-tag-cloud__item:hover {
            background: #0d6efd;
            color: #1a1a1a;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .izokoc-sidebar {
                position: static;
                margin-top: 50px;
            }
        }

        @media (max-width: 768px) {
            .izokoc-blog-list-section {
                padding: 50px 0;
            }

            .izokoc-blog-card__image {
                height: 220px;
            }

            .izokoc-blog-card__content {
                padding: 20px;
            }

            .izokoc-blog-card__title {
                font-size: 20px;
            }

            .izokoc-widget {
                padding: 20px;
            }
        }
    </style>
@endpush