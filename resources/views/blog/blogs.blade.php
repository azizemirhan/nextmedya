@extends('layouts.master')
@section('content')
    <div class="blog-sidebar-slider-area">
        <div class="blog-sidebar-slider-wrapper p-relative">
            <div class="blog-sidebar-scrollbar smooth">
                <a href="#postbox">
                    Keşfetmek için kaydır <span>
                        <svg width="15" height="30" viewBox="0 0 15 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6.26001" width="1.5" height="30" fill="white"></rect>
                            <path d="M14.0464 22.9768C10.1644 22.9768 7.02312 26.118 7.02312 30" stroke="white"
                                stroke-width="1.5" stroke-miterlimit="10"></path>
                            <path d="M7.02319 30C7.02319 26.118 3.88195 22.9768 -7.119e-05 22.9768" stroke="white"
                                stroke-width="1.5" stroke-miterlimit="10"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="blog-sidebar-arrow-box">

            </div>

            <div
                class="swiper-container blog-sidebar-slider-active swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper">
                    @foreach ($posts as $post)
                        <div class="swiper-slide" data-swiper-slide-index="{{ $loop->index }}">
                            <div class="blog-sidebar-slider-bg blog-sidebar-slider-height d-flex align-items-center pt-170 pb-120 position-relative"
                                data-background="{{ asset($post->featured_image) }}"
                                style="background-image: url('{{ asset($post->featured_image) }}');">

                                {{-- Overlay Katmanı --}}
                                <div class="overlay-layer"></div>

                                <div class="container position-relative" style="z-index: 2;">
                                    <div class="row">
                                        <div class="col-xl-9">
                                            <div class="blog-sidebar-content-box">
                                                <div class="blog-sidebar-avatar-box d-flex align-items-center">
                                                    <img src="{{ asset('uploads/avatars/' . $post->author->image) }}"
                                                        alt="">
                                                    <span>{{ $post->author->name ?? 'Next Medya Yazılım & Ajansı' }}</span>
                                                </div>
                                                <div class="blog-sidebar-title-box">
                                                    <h4 class="blog-sidebar-slider-title tp-char-animation"
                                                        style="perspective: 300px;">
                                                        {{ $post->title }}
                                                    </h4>
                                                    <a class="blog-sidebar-slider-link"
                                                        href="{{ route('blog.show', $post->slug) }}">Devamını Oku</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <section id="postbox" class="postbox__area tp-blog-sidebar-sticky-area pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-20">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-size: 20px">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('/bloglar') }}">Bloglar</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="postbox__wrapper">
                        @foreach ($posts as $post)
                            <article class="postbox__item mb-80">
                                <div class="postbox__thumb">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <img src="{{ asset($post->featured_image) }}" width="1000px"
                                            alt="{{ $post->title }}">
                                    </a>
                                </div>
                                <div class="postbox__content">
                                    <div class="postbox__meta">
                                        <span>
                                            {{ $post->published_at->format('d M, Y') }}</span>
                                    </div>
                                    <h3 class="postbox__title">
                                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <div class="postbox__text">
                                        <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                    </div>
                                    <div class="postbox__read-more">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="tp-btn-border-lg">Devamını
                                            Oku
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <div class="basic-pagination">
                            <nav>
                                {{ $posts->onEachSide(1)->links('vendor.pagination.default') }}
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="sidebar__wrapper">
                        <div class="sidebar__widget mb-45">
                            <div class="sidebar__author text-center">
                                <div class="sidebar__author-thumb">
                                    <img src="{{ asset('avatar.png') }}" alt="">
                                </div>
                                <div class="sidebar__author-content">
                                    <h4 class="sidebar__author-title">Next Medya</h4>
                                    <p>Next Medya Blog, dijital dünyadaki en son trendler, inovasyonlar ve iş dünyasına
                                        yönelik stratejiler hakkında derinlemesine bilgiler sunan bir kaynaktır. Blogumuzda,
                                        sektördeki yenilikleri, medya çözümleri ve teknoloji dünyasındaki gelişmeleri
                                        keşfederek, markanızı bir adım öne taşıyacak ipuçlarına ulaşabilirsiniz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__widget mb-65">
                            <h3 class="sidebar__widget-title">Takipte Kalın</h3>
                            <div class="sidebar__widget-content">
                                <div class="sidebar__social">
                                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
