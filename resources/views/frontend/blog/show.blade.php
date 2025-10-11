@extends('frontend.layouts.master')

@section('page_meta')
    <title>{{ $post->seo_title ?: $post->title }}</title>
    <meta name="description" content="{{ $post->meta_description ?: $post->excerpt }}">
    <meta name="keywords" content="{{ $post->keywords }}">
    <meta name="robots" content="{{ $post->index_status }},{{ $post->follow_status }}">
    <link rel="canonical" href="{{ $post->canonical_url ?: url()->current() }}"/>
    <meta property="og:title" content="{{ $post->seo_title ?: $post->title }}"/>
    <meta property="og:description" content="{{ $post->meta_description ?: $post->excerpt }}"/>
    @if($post->featured_image)
        <meta property="og:image" content="{{ asset($post->featured_image) }}"/>
    @endif
@endsection

@section('content')
    {{-- Banner'ı yazının kendi başlığı ile oluşturuyoruz --}}
    <x-page-banner :title="$pageTitle"/>
    <section id="nx-post" class="gap blog-style-one blog-detail detail-page">
        <div class="container">
            <div class="row">
                {{-- ANA YAZI İÇERİĞİ --}}
                <div class="col-lg-8">
                    <div class="blog-post">
                        <div class="blog-image">
                            <figure>
                                <img src="{{ asset($post->featured_image) }}"
                                     alt="{{ $post->featured_image_alt_text ?: $post->title }}">
                            </figure>
                        </div>
                        <div class="blog-data">
                            <span class="blog-date">{{ $post->published_date_formatted }}</span>
                            <h2>{{ $post->title }}</h2>
                            <div class="blog-author d-flex-all justify-content-start">
                                <div class="author-img">
                                    <figure>
                                        {{-- Yazar resmi için bir alanınız varsa burayı güncelleyebilirsiniz --}}
                                        <img src="https://placehold.co/55x55" alt="{{ $post->author->name }}">
                                    </figure>
                                </div>
                                <div class="details">
                                    <h3><span>{{ __('Author') }}:</span> {{ $post->author->name }}</h3>
                                </div>
                            </div>
                        </div>

                        {{-- Quill editörden gelen zengin içerik --}}
                        <div class="post-content">
                            {!! $post->content !!}
                        </div>
                        {{-- Sonraki / Önceki Yazı Navigasyonu --}}
                        <div class="post-navigation d-flex justify-content-between border-top pt-4 mt-4">
                            <div>
                                @if($previousPost)
                                    <a href="{{ route('blog.show', $previousPost->slug) }}"
                                       class="theme-btn-two-outline">
                                        <i class="fa-solid fa-arrow-left-long me-2"></i> {{ __('Previous Post') }}
                                    </a>
                                @endif
                            </div>
                            <div>
                                @if($nextPost)
                                    <a href="{{ route('blog.show', $nextPost->slug) }}" class="theme-btn-two">
                                        {{ __('Next Post') }} <i class="fa-solid fa-arrow-right-long ms-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                {{-- KENAR ÇUBUĞU (SIDEBAR) --}}
                <div class="col-lg-4">
                    <aside class="sidebar">
                        {{-- Arama --}}
                        <div class="widget widget-search">
                            <form action="{{ route('blog.index') }}" method="GET">
                                <input type="search" name="q" placeholder="{{ __('Search in Blog...') }}" value="{{ request('q') }}">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>

                        {{-- Kategoriler --}}
                        <div class="widget widget-categories">
                            <h3 class="widget-title">{{ __('Author') }}:</h3>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.category', $category->slug) }}">
                                            <p>{{ $category->name }}</p>
                                            <span>({{ $category->posts_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Son Yazılar --}}
                        <div class="widget widget-recent-posts">
                            <h3 class="widget-title">{{ __('Recent Posts') }}</h3>
                            <ul>
                                @foreach($recentPosts as $recentPost)
                                    <li>
                                        <img src="{{ asset($recentPost->featured_image) }}"
                                             alt="{{ $recentPost->title }}" width="70" height="70"
                                             style="object-fit: cover;">
                                        <div>
                                            <span>{{ $recentPost->published_date_formatted }}</span>
                                            <h6>
                                                <a href="{{ route('blog.show', $recentPost->slug) }}">{{ Str::limit($recentPost->title, 40) }}</a>
                                            </h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <style>
        /* ===== Blog Detay (izole alan) ===== */
        #nx-post {
            --nx-gap: 22px;
            --nx-radius: 16px;
            --nx-border: #eef0f3;
            --nx-card: #fff;
            --nx-shadow: 0 10px 30px rgba(2, 8, 20, .06);
            --nx-muted: #6b7280;
            --nx-ink: #111827
        }

        #nx-post * {
            box-sizing: border-box
        }

        /* Ana kart */
        #nx-post .blog-post {
            background: var(--nx-card);
            border: 1px solid var(--nx-border);
            border-radius: var(--nx-radius);
            box-shadow: var(--nx-shadow);
            overflow: hidden;
        }

        /* Kapak görseli */
        #nx-post .blog-image {
            position: relative
        }

        #nx-post .blog-image figure {
            margin: 0;
            aspect-ratio: 16/9;
            overflow: hidden
        }

        #nx-post .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .35s ease;
        }

        #nx-post .blog-post:hover .blog-image img {
            transform: scale(1.02)
        }

        /* Üst meta + başlık */
        #nx-post .blog-data {
            padding: 18px 18px 8px 18px
        }

        #nx-post .blog-date {
            display: inline-block;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .2px;
            color: #0f172a;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
        }

        #nx-post h2 {
            margin: 12px 0 10px 0;
            font-size: clamp(22px, 3.2vw, 32px);
            line-height: 1.2;
            font-weight: 800;
            color: var(--nx-ink);
        }

        /* Yazar kutusu */
        #nx-post .blog-author {
            gap: 12px;
            margin-top: 6px
        }

        #nx-post .blog-author .author-img figure {
            margin: 0
        }

        #nx-post .blog-author img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--nx-border)
        }

        #nx-post .blog-author .details h3 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: var(--nx-ink)
        }

        #nx-post .blog-author .details h3 span {
            font-weight: 600;
            color: var(--nx-muted);
            margin-right: 6px
        }

        /* İçerik tipografisi */
        #nx-post .post-content {
            padding: 0 18px 18px 18px;
            color: #1f2937;
            font-size: 16px;
            line-height: 1.75;
        }

        #nx-post .post-content p {
            margin: 0 0 1em 0
        }

        #nx-post .post-content h2,
        #nx-post .post-content h3,
        #nx-post .post-content h4 {
            margin: 1.3em 0 .5em 0;
            line-height: 1.25;
            font-weight: 800;
            color: var(--nx-ink)
        }

        #nx-post .post-content h2 {
            font-size: clamp(20px, 2.6vw, 26px)
        }

        #nx-post .post-content h3 {
            font-size: clamp(18px, 2.2vw, 22px)
        }

        #nx-post .post-content h4 {
            font-size: clamp(16px, 2vw, 18px)
        }

        #nx-post .post-content ul,
        #nx-post .post-content ol {
            padding-left: 1.3em;
            margin: 0 0 1em 0
        }

        #nx-post .post-content li {
            margin: .3em 0
        }

        #nx-post .post-content a {
            color: #2563eb;
            text-underline-offset: 3px
        }

        #nx-post .post-content a:hover {
            text-decoration: underline
        }

        #nx-post .post-content blockquote {
            margin: 1.2em 0;
            padding: 14px 16px;
            background: #f8fafc;
            border-left: 4px solid #93c5fd;
            border-radius: 10px;
            color: #0f172a
        }

        #nx-post .post-content code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .95em;
            background: #0f172a0d;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: .15em .4em
        }

        #nx-post .post-content pre {
            overflow: auto;
            padding: 14px;
            background: #0b1220;
            color: #e5e7eb;
            border-radius: 12px;
            border: 1px solid #1c2537
        }

        #nx-post .post-content figure {
            margin: 1em 0
        }

        #nx-post .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            border: 1px solid var(--nx-border)
        }

        #nx-post .post-content figcaption {
            font-size: 13px;
            color: var(--nx-muted);
            text-align: center;
            margin-top: 6px
        }

        #nx-post .post-content table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 1em 0;
            font-size: 15px
        }

        #nx-post .post-content thead th {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 700;
        }

        #nx-post .post-content th, #nx-post .post-content td {
            border: 1px solid var(--nx-border);
            padding: 10px
        }

        #nx-post .post-content hr {
            border: 0;
            height: 1px;
            background: var(--nx-border);
            margin: 1.2em 0
        }

        /* Etiketler & kategori */
        #nx-post .mini-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px
        }

        #nx-post .mini-tags a {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            font-size: 13px;
            color: #0f172a;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            text-decoration: none;
            transition: background .2s ease, transform .2s ease;
        }

        #nx-post .mini-tags a:hover {
            background: #e2e8f0;
            transform: translateY(-1px)
        }

        #nx-post .category.shape p {
            margin: 0
        }

        #nx-post .category.shape a {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            text-decoration: none;
            background: #fff7ed;
            color: #7c2d12;
            border: 1px solid #fed7aa;
        }

        /* Önceki / Sonraki navigasyon */
        #nx-post .post-navigation {
            gap: 12px
        }

        #nx-post .theme-btn-two,
        #nx-post .theme-btn-two-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            font-weight: 700;
            font-size: 14px;
            border-radius: 12px;
            text-decoration: none;
            transition: filter .2s ease, transform .2s ease, box-shadow .2s ease, border-color .2s ease
        }

        #nx-post .theme-btn-two {
            background: #111827;
            color: #fff;
            border: 1px solid #111827;
            box-shadow: 0 8px 18px rgba(17, 24, 39, .18)
        }

        #nx-post .theme-btn-two:hover {
            transform: translateY(-1px);
            filter: saturate(1.05)
        }

        #nx-post .theme-btn-two-outline {
            background: #ffffff;
            color: #111827;
            border: 1px solid var(--nx-border)
        }

        #nx-post .theme-btn-two-outline:hover {
            border-color: #cbd5e1;
            transform: translateY(-1px)
        }

        /* Sidebar (liste sayfasıyla uyumlu) */
        #nx-post .sidebar {
            position: sticky;
            top: 22px
        }

        #nx-post .sidebar .widget {
            background: var(--nx-card);
            border: 1px solid var(--nx-border);
            border-radius: 14px;
            padding: 16px;
            box-shadow: var(--nx-shadow);
            margin-bottom: 18px;
        }

        #nx-post .widget-title {
            margin: 4px 0 14px 0;
            font-size: 16px;
            font-weight: 800
        }

        #nx-post .widget-search form {
            position: relative
        }

        #nx-post .widget-search input[type="search"] {
            width: 100%;
            height: 44px;
            border: 1px solid var(--nx-border);
            border-radius: 999px;
            padding: 0 44px 0 14px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        #nx-post .widget-search input[type="search"]:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .12)
        }

        #nx-post .widget-search button {
            position: absolute;
            right: 4px;
            top: 4px;
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 999px;
            background: #111827;
            color: #fff;
            cursor: pointer;
        }

        /* Kategoriler */
        #nx-post .widget-categories ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 8px
        }

        #nx-post .widget-categories li a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: 1px solid var(--nx-border);
            border-radius: 10px;
            text-decoration: none;
            color: #111827;
            transition: background .2s ease, border-color .2s ease;
        }

        #nx-post .widget-categories li a:hover {
            background: #f8fafc;
            border-color: #e2e8f0
        }

        #nx-post .widget-categories li span {
            color: var(--nx-muted)
        }

        #nx-post .widget-categories li p {
            margin: 0
        }

        /* Son Yazılar */
        #nx-post .widget-recent-posts ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 12px
        }

        #nx-post .widget-recent-posts li {
            display: grid;
            grid-template-columns:70px 1fr;
            gap: 10px;
            align-items: center;
        }

        #nx-post .widget-recent-posts img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--nx-border)
        }

        #nx-post .widget-recent-posts span {
            display: block;
            font-size: 12px;
            color: var(--nx-muted);
            margin-bottom: 4px
        }

        #nx-post .widget-recent-posts h6 {
            margin: 0;
            font-weight: 700;
            line-height: 1.35
        }

        #nx-post .widget-recent-posts a {
            text-decoration: none
        }

        #nx-post .widget-recent-posts a:hover {
            text-decoration: underline
        }

        /* Etiket Bulutu */
        #nx-post .widget-tags .tags-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 8px
        }

        #nx-post .widget-tags .tags-cloud a {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            font-size: 13px;
            color: #0f172a;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            text-decoration: none;
            transition: background .2s ease, transform .2s ease;
        }

        #nx-post .widget-tags .tags-cloud a:hover {
            background: #e2e8f0;
            transform: translateY(-1px)
        }

        /* Grid boşlukları */
        #nx-post .row > [class*="col-"] {
            margin-bottom: var(--nx-gap)
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            #nx-post .sidebar {
                position: static;
                top: auto
            }
        }

        @media (max-width: 575.98px) {
            #nx-post .blog-data {
                padding: 14px 14px 6px 14px
            }

            #nx-post .post-content {
                padding: 0 14px 14px 14px
            }
        }

        /* Dark mode */
        @media (prefers-color-scheme: dark) {
            #nx-post {
                --nx-border: #1c2537;
                --nx-muted: #93a3b8;
                --nx-ink: #000;
            }

            #nx-post .post-content a {
                color: #60a5fa
            }

            #nx-post .post-content blockquote {
                background: #0f172a;
                border-left-color: #60a5fa;
                color: #e5e7eb
            }

            #nx-post .widget-search button {
                background: #2563eb
            }

            #nx-post .theme-btn-two {
                background: #2563eb;
                border-color: #2563eb
            }

            #nx-post .widget-categories li a {
                color: #e5e7eb
            }

            #nx-post .widget-tags .tags-cloud a {
                color: #e5e7eb;
                background: #0f172a;
                border-color: #1f2937
            }

            #nx-post .widget-recent-posts a {
                color: #e5e7eb
            }
        }

    </style>
@endpush
