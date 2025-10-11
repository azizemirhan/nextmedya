<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{--    <script>--}}
    {{--        window.addEventListener('load', function () {--}}
    {{--            if (localStorage.getItem('loaderShown')) {--}}
    {{--                document.getElementById('loader-wrapper').style.display = 'none';--}}
    {{--                document.getElementById('main-content').style.display = 'block';--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @hasSection ('page_meta')
        @yield('page_meta')
    @else
        @isset($page)
            <title>{{ $page->getTranslation('seo_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale()) }}</title>
            <meta name="description" content="{{ $page->getTranslation('meta_description', app()->getLocale()) }}">
            <meta name="keywords" content="{{ $page->getTranslation('keywords', app()->getLocale()) }}">
            <meta name="robots" content="{{ $page->index_status }},{{ $page->follow_status }}">
            <link rel="canonical" href="{{ $page->canonical_url ?: url()->current() }}"/>
            <meta property="og:title"
                  content="{{ $page->getTranslation('og_title', app()->getLocale()) ?: $page->getTranslation('seo_title', app()->getLocale()) }}"/>
            <meta property="og:description"
                  content="{{ $page->getTranslation('og_description', app()->getLocale()) ?: $page->getTranslation('meta_description', app()->getLocale()) }}"/>
            @if($page->og_image)
                <meta property="og:image" content="{{ asset($page->og_image) }}"/>
            @endif
        @else
            {{-- Eğer $page değişkeni yoksa (anasayfa gibi), genel ayarlardan SEO bilgisi çekilebilir --}}
            <title>{{ $settings['site_title']->value[app()->getLocale()] ?? config('app.name') }}</title>
            <meta name="description" content="{{ $settings['site_description']->value[app()->getLocale()] ?? '' }}">
        @endif
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="{{ url()->current() }}"/>
    @endif

    @if(!empty($settings['google_site_verification']->value))
        <meta name="google-site-verification" content="{{ $settings['google_site_verification']->value }}"/>
    @endif
    {{-- Bing Webmaster Tools --}}
    @if(!empty($settings['bing_site_verification']->value))
        <meta name="msvalidate.01" content="{{ $settings['bing_site_verification']->value }}"/>
    @endif
    {{-- Yandex Webmaster --}}
    @if(!empty($settings['yandex_site_verification']->value))
        <meta name="yandex-verification" content="{{ $settings['yandex_site_verification']->value }}"/>
    @endif
    <link rel="stylesheet" href="{{ asset('custom-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/pricing-table.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('site/assets/loader.css') }}">--}}
    @stack('styles')
</head>
<body>
{{--<div id="main">--}}
{{--    <div id="blue-dark">--}}
{{--        <!-- Glow efekti -->--}}
{{--        <div class="glow"></div>--}}

{{--        <!-- Logo -->--}}
{{--        <div class="logo-container">--}}
{{--            <!-- BURAYA KENDI LOGO RESMİNİZİN YOLUNU YAZIN -->--}}
{{--            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo-image">--}}
{{--        </div>--}}

{{--        <!-- Loading dots -->--}}
{{--        <div class="loading-dots">--}}
{{--            <div class="dot"></div>--}}
{{--            <div class="dot"></div>--}}
{{--            <div class="dot"></div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div id="blue-light"></div>--}}
{{--    <div id="white"></div>--}}
{{--</div>--}}
@include('frontend.layouts._header')
@if (!Route::is('frontend.home', 'frontend.services.show', 'blog.index', 'blog.show', 'blog.category'))
    <x-page-banner :title="$pageTitle ?? 'Kurumsal'" :subtitle="$pageSubtitle ?? ''"/>
@endif
@yield('content')
@include('frontend.layouts._footer')
<script type="module" src="{{ asset('site/assets/animation.js') }}"></script>
<script src="{{ asset('site/assets/footer.js') }}"></script>
<script src="{{ asset('site/assets/pricing-table.js') }}"></script>
{{--<script src="{{ asset('site/assets/loader.js') }}"></script>--}}
<script>
    const logosSlide = document.querySelector('.logos-slide');
    const logos = logosSlide.querySelectorAll('img');

    logos.forEach((logo) => {
        const clone = logo.cloneNode(true);
        logosSlide.appendChild(clone);
    });
</script>
@stack('scripts')
</body>
</html>


