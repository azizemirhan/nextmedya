@extends('layouts.master')
@section('meta_title', $post->title)
@section('meta_description', $post->meta_description)
@section('meta_keywords', $post->meta_keywords)
@section('og_title', $post->title)
@section('og_description', $post->meta_description)
@section('og_image', asset($post->featured_image))
@section('structured_data')
    @if ($post->schema_markup)
        <script type="application/ld+json">
    {!! json_encode(json_decode($post->schema_markup), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
    @endif

    @if ($post->breadcrumb_schema)
        <script type="application/ld+json">
            {!! $post->breadcrumb_schema !!}
        </script>
    @endif
@endsection
@section('content')
    <div class="blog-details-area">
        <div class="blog-details-bg blog-details-bg-height blog-details-overlay p-relative d-flex align-items-end pt-50 pb-50"
            data-background="{{ asset($post->featured_image) }} "
            style="background-image: url({{ asset($post->featured_image) }});">
            <div class="blog-details-overlay-shape">
                <img src={{ asset('site/assets/img/inner-blog/blog-details/bg-shape/overly.png') }}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-11">
                        <div class="blog-details-content z-index-5">
                            <span class="blog-details-meta"><i> {{ $post->published_at->format('d M, Y') }}</i></span>
                            <h4 class="blog-details-title tp-char-animation" style="perspective: 300px;">{{ $post->title }}
                            </h4>
                            <div class="blog-details-top-author d-flex align-items-center">
                                <img src="{{ asset($post->author->image) }}" alt="">
                                <p style="color: white; font-size:20px">{{ $post->author->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="postbox__area tp-blog-sidebar-sticky-area pt-120 pb-120">
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
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $post->title }}
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="postbox__wrapper">
                        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
                        <p class="text-sm text-gray-500">{{ $post->published_at->format('d M, Y') }}</p>

                        <!-- İçerik -->
                        <div class="post-content mt-6">
                            {!! $post->content !!} <!-- İçeriği html olarak render et -->
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
                                    <a href="https://www.instagram.com/nextmedyacom/"><i
                                            class="fa-brands fa-instagram"></i></a>
                                    <a href="https://www.facebook.com/profile.php?id=61561391530431"><i
                                            class="fa-brands fa-facebook"></i></a>
                                    <a href="https://www.linkedin.com/company/105389610"><i
                                            class="fa-brands fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
