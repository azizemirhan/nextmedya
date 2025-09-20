<!DOCTYPE html>
<html lang="tr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <title>Next Meyda | Müşteri & Site Yönetim CRM</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('2-3.webp') }}" />
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/dark/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('backend/layouts/horizontal-light-menu/loader.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link href="{{ asset('backend/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="layout-boxed enable-secondaryNav">
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    @include('admin.layouts.menu')
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->
        @include('admin.layouts.menu-inside')
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing mt-4">
                <div class="middle-content container-xxl p-0">
                    <div class="row layout-top-spacing">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('backend/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('backend/layouts/horizontal-light-menu/app.js') }}"></script>
    <script src="{{ asset('backend/src/assets/js/dashboard/dash_1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Controller'dan 'success' anahtarıyla gönderilen session mesajını yakalıyoruz.
        @if (session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end', // Bildirimin konumu (sağ üst)
                showConfirmButton: false,
                timer: 3000, // 3 saniye sonra otomatik kapanacak
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success', // İkon tipi
                title: '{{ session('success') }}' // Controller'dan gelen mesaj
            });
        @endif

        // Hata mesajları için de benzer bir yapı kurabilirsiniz ('error' session'ı ile)
        @if (session('error'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            });
        @endif
    </script>
    @stack('scripts')
</body>

</html>
