<!DOCTYPE html>
<html lang="tr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
    <title>@yield('title', 'Next Medya | Müşteri & Site Yönetim CRM')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('2-3.webp') }}"/>

    {{-- TEMA YÜKLEYİCİ (LOADER) --}}
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('backend/layouts/horizontal-light-menu/loader.js') }}"></script>

    {{-- =============================================== --}}
    {{-- CSS BÖLÜMÜ (DOĞRU SIRALAMA İLE) --}}
    {{-- =============================================== --}}

    {{-- 1. TEMEL CSS DOSYALARI --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"/>
    <link href="{{ asset('backend/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css"/>

    {{-- 2. EKLENTİ (PLUGIN) CSS DOSYALARI --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

    <link href="{{ asset('backend/src/assets/css/light/apps/mailbox.css') }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ asset('backend/src/assets/css/light/apps/chat.css') }}" rel="stylesheet" type="text/css"/>--}}
    {{-- Bootstrap Iconpicker CSS (EKSİK OLAN KÜTÜPHANE) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.10.0/dist/css/bootstrap-iconpicker.min.css"/>
    <style>
        .navbar-expand .navbar-nav {
            gap: 10px
        }

        /* Breadcrumb Stilleri */
        .breadcrumb-container {
            background-color: #fff;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .breadcrumb {
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #0d6efd;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #6c757d;
            font-weight: 500;
        }


    </style>
    {{-- Sayfaya Özel stillerin yükleneceği yer --}}
    @stack('styles')
</head>
<body class="layout-boxed enable-secondaryNav">
<div id="load_screen">
    <div class="loader"><div class="loader-content"><div class="spinner-grow align-self-center"></div></div></div>
</div>
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    @include('admin.layouts.menu-inside')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @yield('breadcrumb')
            <div class="middle-content container-xxl p-0">
                <div class="row layout-top-spacing">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- =============================================== --}}
{{-- SCRIPT BÖLÜMÜ (DOĞRU SIRALAMA İLE) --}}
{{-- =============================================== --}}

{{-- 1. TEMEL KÜTÜPHANELER --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('backend/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- 2. jQuery EKLENTİLERİ (Plugins) --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- 3. TEMA'NIN ANA SCRIPTLERİ (Eklentilerden sonra yüklenmeli) --}}
<script src="{{ asset('backend/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('backend/layouts/horizontal-light-menu/app.js') }}"></script>
<script src="{{ asset('backend/src/assets/js/apps/mailbox.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="{{ asset('backend/additional.js') }}"></script>
{{--<script src="{{ asset('backend/src/assets/js/apps/chat.js') }}"></script>--}}

{{-- Sayfaya Özel Scriptlerin yükleneceği yer --}}
@stack('scripts')

{{-- 4. GENEL AMA BAĞIMSIZ SCRIPTLER (En sonda çalışabilir) --}}
<script>
    // Session (Başarı/Hata) Mesajları
    @if (session('success'))
    Swal.fire({
        toast: true, position: 'top-end', icon: 'success', title: @json(session('success')),
        showConfirmButton: false, timer: 3000, timerProgressBar: true
    });
    @endif
    @if (session('error'))
    Swal.fire({
        toast: true, position: 'top-end', icon: 'error', title: @json(session('error')),
        showConfirmButton: false, timer: 4000, timerProgressBar: true
    });
    @endif

    // Genel Icon Picker Başlatıcı
    // Bu kod, sayfada [role="iconpicker"] elementi varsa çalışır
    $(function () {
        const iconpicker = $('[role="iconpicker"]');
        if(iconpicker.length) {
            iconpicker.iconpicker();
        }
    });
</script>

</body>
</html>
