<!doctype html>
<html lang="tr">

<head>
    @include('layouts.meta')
</head>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<body id="body" class="tp-smooth-scroll">
    @include('layouts.form')
    @include('layouts.master_extends')
    <div id="smooth-wrapper">
        <div id="smooth-content">
            @hasSection('custom_header')
                @yield('custom_header')
            @else
                @include('layouts.header')
            @endif
            <main>
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.mobiletoolbar')
    <script src="{{ asset('site/assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('site/assets/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('site/assets/js/gsap.js') }}"></script>
    <script src="{{ asset('site/assets/js/gsap-scroll-to-plugin.js') }}"></script>
    <script src="{{ asset('site/assets/js/gsap-scroll-smoother.js') }}"></script>
    <script src="{{ asset('site/assets/js/gsap-scroll-trigger.js') }}"></script>
    <script src="{{ asset('site/assets/js/gsap-split-text.js') }}"></script>
    <script src="{{ asset('site/assets/js/chroma.min.js') }}"></script>
    <script src='{{ asset('site/assets/js/three.js') }}'></script>
    <script src='{{ asset('site/assets/js/tween-max.js') }}'></script>
    <script src='{{ asset('site/assets/js/scroll-magic.js') }}'></script>
    <script src="{{ asset('site/assets/js/range-slider.js') }}"></script>
    <script src="{{ asset('site/assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('site/assets/js/slick.js') }}"></script>
    <script src="{{ asset('site/assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('site/assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('site/assets/js/purecounter.js') }}"></script>
    <script src="{{ asset('site/assets/js/beforeafter.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@0.5.24/dist/vanta.waves.min.js/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('site/assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('site/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('site/assets/js/webgl.js') }}"></script>
    <script src="{{ asset('site/assets/js/main.js') }}" async fetchpriority="high"></script>
    <script src="{{ asset('site/assets/js/tp-cursor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @include('layouts.javascript')
</body>

</html>
