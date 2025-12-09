@extends('frontend.layouts.master')
@section('page_meta')
    <x-post-meta-tags :post="$post"/>
@endsection
@section('content')
    {{-- 301 Redirect Check (Middleware tarafından hallediliyor, ama double-check) --}}
    @if($post->redirect_enabled && $post->redirect_url)
        <script>window.location.href = "{{ $post->redirect_url }}";</script>
    @endif

    <x-page-banner :title="$post->title" :subtitle="$post->category ? $post->category->name : ''" />

    <section class="izokoc-blog-single-section">
        <div class="container">
            <div class="row">
                {{-- ANA İÇERİK: YAZI DETAYI --}}
                <div class="col-lg-8">
                    <article class="izokoc-blog-single">
                        {{-- Featured Image --}}
                        @if($post->featured_image)
                            <div class="izokoc-blog-single__featured">
                                <img src="{{ asset($post->featured_image) }}"
                                     alt="{{ $post->featured_image_alt_text ?: $post->title }}">
                            </div>
                        @endif

                        {{-- Meta Bilgiler --}}
                        <div class="izokoc-blog-single__meta">
                            <div class="izokoc-blog-single__meta-item">
                                <i class="icofont-user-alt-7"></i>
                                <span>{{ $post->author->name }}</span>
                            </div>
                            <div class="izokoc-blog-single__meta-item">
                                <i class="icofont-calendar"></i>
                                <span>{{ $post->published_date_formatted }}</span>
                            </div>
                            @if($post->category)
                                <div class="izokoc-blog-single__meta-item">
                                    <i class="icofont-folder"></i>
                                    <a href="{{ route('blog.category', $post->category->slug) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- İçerik --}}
                        <div class="izokoc-blog-single__content">
                            {!! $post->content !!}
                        </div>

                        {{-- Etiketler --}}
                        @if($post->tags->isNotEmpty())
                            <div class="izokoc-blog-single__tags">
                                <strong>{{ __('Tags:') }}</strong>
                                <div class="izokoc-blog-single__tags-wrapper">
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.tag', $tag->slug) }}" class="izokoc-blog-single__tag">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Sosyal Paylaşım --}}
                        <div class="izokoc-blog-single__share">
                            <strong>{{ __('share') }}</strong>
                            <div class="izokoc-social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                                   target="_blank"
                                   class="izokoc-social-share__btn izokoc-social-share__btn--facebook">
                                    <i class="icofont-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
                                   target="_blank"
                                   class="izokoc-social-share__btn izokoc-social-share__btn--twitter">
                                    <i class="icofont-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}"
                                   target="_blank"
                                   class="izokoc-social-share__btn izokoc-social-share__btn--linkedin">
                                    <i class="icofont-linkedin"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . route('blog.show', $post->slug)) }}"
                                   target="_blank"
                                   class="izokoc-social-share__btn izokoc-social-share__btn--whatsapp">
                                    <i class="icofont-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Önceki/Sonraki Yazılar --}}
                        @if(isset($previousPost) || isset($nextPost))
                            <div class="izokoc-blog-navigation">
                                @if(isset($previousPost))
                                    <a href="{{ route('blog.show', $previousPost->slug) }}"
                                       class="izokoc-blog-navigation__link izokoc-blog-navigation__link--prev">
                                        <span class="izokoc-blog-navigation__label">
                                            <i class="icofont-rounded-left"></i>
                                            {{ __('previous_post') }}
                                        </span>
                                        <span class="izokoc-blog-navigation__title">
                                            {{ Str::limit($previousPost->title, 50) }}
                                        </span>
                                    </a>
                                @endif

                                @if(isset($nextPost))
                                    <a href="{{ route('blog.show', $nextPost->slug) }}"
                                       class="izokoc-blog-navigation__link izokoc-blog-navigation__link--next">
                                        <span class="izokoc-blog-navigation__label">
                                            {{ __('next_post') }}
                                            <i class="icofont-rounded-right"></i>
                                        </span>
                                        <span class="izokoc-blog-navigation__title">
                                            {{ Str::limit($nextPost->title, 50) }}
                                        </span>
                                    </a>
                                @endif
                            </div>
                        @endif

                        {{-- İlgili Yazılar --}}
                        @if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
                            <div class="izokoc-related-posts">
                                <h3 class="izokoc-related-posts__title">{{ __('Related Posts') }}</h3>
                                <div class="row">
                                    @foreach($relatedPosts as $relatedPost)
                                        <div class="col-md-6">
                                            <article class="izokoc-related-post">
                                                <a href="{{ route('blog.show', $relatedPost->slug) }}"
                                                   class="izokoc-related-post__thumb">
                                                    <img src="{{ asset($relatedPost->featured_image) }}"
                                                         alt="{{ $relatedPost->title }}"
                                                         loading="lazy">
                                                </a>
                                                <div class="izokoc-related-post__content">
                                                    <span class="izokoc-related-post__date">
                                                        {{ $relatedPost->published_date_formatted }}
                                                    </span>
                                                    <h4 class="izokoc-related-post__title">
                                                        <a href="{{ route('blog.show', $relatedPost->slug) }}">
                                                            {{ $relatedPost->title }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </article>
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
                                       class="izokoc-search-form__input">
                                <button type="submit" class="izokoc-search-form__button">
                                    <i class="icofont-search-1"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Kategoriler Widget'ı --}}
                        @if(isset($categories) && $categories->isNotEmpty())
                            <div class="izokoc-widget izokoc-widget--categories">
                                <h3 class="izokoc-widget__title">{{ __('categories') }}</h3>
                                <ul class="izokoc-category-list">
                                    @foreach($categories as $category)
                                        <li class="izokoc-category-list__item">
                                            <a href="{{ route('blog.category', $category->slug) }}"
                                               class="izokoc-category-list__link {{ $post->category_id == $category->id ? 'active' : '' }}">
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
                        @if(isset($recentPosts) && $recentPosts->isNotEmpty())
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
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Blog Single Section */
        .izokoc-blog-single-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        /* Blog Single */
        .izokoc-blog-single {
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .izokoc-blog-single__featured {
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
        }

        .izokoc-blog-single__featured img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Meta */
        .izokoc-blog-single__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            padding-bottom: 25px;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
        }

        .izokoc-blog-single__meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 15px;
        }

        .izokoc-blog-single__meta-item i {
            color: #0d6efd;
            font-size: 18px;
        }

        .izokoc-blog-single__meta-item a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .izokoc-blog-single__meta-item a:hover {
            color: #0d6efd;
        }

        /* Content */
        .izokoc-blog-single__content {
            color: #444;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .izokoc-blog-single__content h1,
        .izokoc-blog-single__content h2,
        .izokoc-blog-single__content h3,
        .izokoc-blog-single__content h4,
        .izokoc-blog-single__content h5,
        .izokoc-blog-single__content h6 {
            color: #1a1a1a;
            margin-top: 30px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .izokoc-blog-single__content p {
            margin-bottom: 20px;
        }

        .izokoc-blog-single__content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        .izokoc-blog-single__content ul,
        .izokoc-blog-single__content ol {
            margin-bottom: 20px;
            padding-left: 30px;
        }

        .izokoc-blog-single__content li {
            margin-bottom: 10px;
        }

        .izokoc-blog-single__content blockquote {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 20px 30px;
            margin: 30px 0;
            font-style: italic;
            color: #555;
        }

        /* Tags */
        .izokoc-blog-single__tags {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 25px 0;
            border-top: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 30px;
        }

        .izokoc-blog-single__tags strong {
            color: #1a1a1a;
            font-size: 16px;
            flex-shrink: 0;
            padding-top: 8px;
        }

        .izokoc-blog-single__tags-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            flex: 1;
        }

        .izokoc-blog-single__tag {
            display: inline-block;
            background: #f0f0f0;
            color: #666;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .izokoc-blog-single__tag:hover {
            background: #0d6efd;
            color: #1a1a1a;
            transform: translateY(-2px);
        }

        /* Share */
        .izokoc-blog-single__share {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 25px 0;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 40px;
        }

        .izokoc-blog-single__share strong {
            color: #1a1a1a;
            font-size: 16px;
            flex-shrink: 0;
        }

        .izokoc-social-share {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .izokoc-social-share__btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .izokoc-social-share__btn:hover {
            transform: translateY(-3px);
        }

        .izokoc-social-share__btn--facebook {
            background: #3b5998;
        }

        .izokoc-social-share__btn--twitter {
            background: #1da1f2;
        }

        .izokoc-social-share__btn--linkedin {
            background: #0077b5;
        }

        .izokoc-social-share__btn--whatsapp {
            background: #25d366;
        }

        /* Navigation */
        .izokoc-blog-navigation {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 50px;
        }

        .izokoc-blog-navigation__link {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .izokoc-blog-navigation__link:hover {
            background: #0d6efd;
            transform: translateY(-3px);
        }

        .izokoc-blog-navigation__link--next {
            text-align: right;
        }

        .izokoc-blog-navigation__label {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #999;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .izokoc-blog-navigation__link--next .izokoc-blog-navigation__label {
            justify-content: flex-end;
        }

        .izokoc-blog-navigation__title {
            color: #1a1a1a;
            font-size: 16px;
            font-weight: 600;
        }

        /* Related Posts */
        .izokoc-related-posts {
            padding-top: 40px;
            border-top: 2px solid #e0e0e0;
        }

        .izokoc-related-posts__title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
        }

        .izokoc-related-post {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .izokoc-related-post:hover {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .izokoc-related-post__thumb {
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
        }

        .izokoc-related-post__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .izokoc-related-post:hover .izokoc-related-post__thumb img {
            transform: scale(1.1);
        }

        .izokoc-related-post__content {
            flex: 1;
            min-width: 0;
        }

        .izokoc-related-post__date {
            display: block;
            color: #999;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .izokoc-related-post__title {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            line-height: 1.4;
        }

        .izokoc-related-post__title a {
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .izokoc-related-post__title a:hover {
            color: #0d6efd;
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
            color: #1a1a1a;
            cursor: pointer;
            transition: background 0.3s ease;
            flex-shrink: 0;
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

        .izokoc-category-list__link:hover,
        .izokoc-category-list__link.active {
            color: #0d6efd;
            padding-left: 10px;
        }

        .izokoc-category-list__link i {
            font-size: 18px;
            flex-shrink: 0;
        }

        .izokoc-category-list__link > span:first-of-type {
            flex: 1;
            min-width: 0;
        }

        .izokoc-category-list__count {
            background: #f0f0f0;
            color: #666;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 600;
            flex-shrink: 0;
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
            min-width: 0;
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

        /* Responsive */
        @media (max-width: 991px) {
            .izokoc-sidebar {
                position: static;
                margin-top: 50px;
            }
        }

        @media (max-width: 768px) {
            .izokoc-blog-single-section {
                padding: 50px 0;
            }

            .izokoc-blog-single {
                padding: 25px;
            }

            .izokoc-blog-single__meta {
                gap: 15px;
            }

            .izokoc-blog-single__content {
                font-size: 15px;
            }

            .izokoc-blog-single__share,
            .izokoc-blog-single__tags {
                flex-direction: column;
                align-items: flex-start;
            }

            .izokoc-blog-navigation {
                grid-template-columns: 1fr;
            }

            .izokoc-blog-navigation__link--next {
                text-align: left;
            }

            .izokoc-blog-navigation__link--next .izokoc-blog-navigation__label {
                justify-content: flex-start;
            }

            .izokoc-related-post {
                flex-direction: column;
            }

            .izokoc-related-post__thumb {
                width: 100%;
                height: 200px;
            }

            .izokoc-widget {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .izokoc-blog-single {
                padding: 20px;
            }
        }
    </style>
@endpush