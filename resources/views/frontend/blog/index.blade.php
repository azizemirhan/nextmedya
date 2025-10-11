@extends('frontend.layouts.master')
@section('page_meta')
    <title>{{ $pageTitle }} | Blog</title>
    <meta name="description" content="{{ __('Read our latest blog posts and breaking news.') }}">
@endsection
@section('content')
    <x-page-banner :title="$pageTitle" subtitle="{{ __('The latest developments and news in the industry.') }}" />
    <section id="nx-blog" class="gap">
        <div class="container">
            <div class="row">
                {{-- ANA İÇERİK: YAZI LİSTESİ --}}
                <div class="col-lg-8">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                                <div class="blog-post-style-one">
                                    <div class="blog-image">
                                        <figure>
                                            <a href="{{ route('blog.show', $post->slug) }}">
                                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->featured_image_alt_text ?: $post->title }}" class="img-fluid w-100">
                                            </a>
                                        </figure>
                                        @if($post->category)
                                            <a href="{{ route('blog.category', $post->category->slug) }}" class="category-tag">{{ $post->category->name }}</a>
                                        @endif
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <span><i class="fa-solid fa-user"></i> {{ $post->author->name }}</span>
                                            <span><i class="fa-solid fa-calendar-days"></i> {{ $post->published_date_formatted }}</span>
                                        </div>
                                        <h3 class="blog-title">
                                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h3>
                                        <p>{{ $post->excerpt }}</p>
                                        <a href="{{ route('blog.show', $post->slug) }}" class="theme-btn-two">{{ __('Read more') }} <i class="fa-solid fa-angles-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    Aradığınız kriterlere uygun yazı bulunamadı.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Sayfalama Linkleri --}}
                    <div class="mt-4">
                        {{ $posts->links('pagination::bootstrap-5') }}
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
                            <h3 class="widget-title">{{ __('Categories') }}</h3>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.category', $category->slug) }}" style="color: #000">
                                            {{ $category->name }}
                                            <span style="color: #000">({{ $category->posts_count }})</span>
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
                                        <img src="{{ asset($recentPost->featured_image) }}" alt="{{ $recentPost->title }}" width="70" height="70" style="object-fit: cover;">
                                        <div>
                                            <span>{{ $recentPost->published_date_formatted }}</span>
                                            <h6><a href="{{ route('blog.show', $recentPost->slug) }}">{{ $recentPost->title }}</a></h6>
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
@push('styles') @endpush
