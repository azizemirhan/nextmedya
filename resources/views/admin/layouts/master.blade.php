<!DOCTYPE html>
<html lang="tr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
    <title>@yield('title', 'Next Medya | Müşteri & Site Yönetim CRM')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('2-3.webp') }}"/>
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/loader.css') }}" rel="stylesheet"
          type="text/css"/>
    <script src="{{ asset('backend/layouts/horizontal-light-menu/loader.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="{{ asset('backend/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('backend/src/assets/css/light/apps/mailbox.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.10.0/dist/css/bootstrap-iconpicker.min.css"/>

    <style>
        :root {
            --primary-color: #000;
            --primary-light: #000;
            --primary-dark: #4f46e5;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--light-bg);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Modern Loader */
        #load_screen {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .loader .spinner-grow {
            background-color: white !important;
        }

        /* Container Styles */
        .main-container {
            min-height: 100vh;
            background: var(--light-bg);
        }

        #content {
            padding-top: 80px;
            transition: all 0.3s ease;
        }

        .layout-px-spacing {
            padding: 2rem 1.5rem;
        }

        /* Card Styles */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stat Cards */
        .border-left-success {
            border-left: 4px solid var(--success-color) !important;
        }

        .border-left-warning {
            border-left: 4px solid var(--warning-color) !important;
        }

        .border-left-danger {
            border-left: 4px solid var(--danger-color) !important;
        }

        .border-left-primary {
            border-left: 4px solid var(--primary-color) !important;
        }

        .border-left-info {
            border-left: 4px solid var(--info-color) !important;
        }

        .border-left-secondary {
            border-left: 4px solid var(--secondary-color) !important;
        }

        .border-left-dark {
            border-left: 4px solid var(--text-primary) !important;
        }

        /* Text Colors */
        .text-success {
            color: var(--success-color) !important;
        }

        .text-warning {
            color: var(--warning-color) !important;
        }

        .text-danger {
            color: var(--danger-color) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-info {
            color: var(--info-color) !important;
        }

        .text-secondary {
            color: var(--secondary-color) !important;
        }

        .text-dark {
            color: var(--text-primary) !important;
        }

        /* Button Styles */
        .btn {
            border-radius: 10px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-info {
            background: var(--info-color);
            color: white;
        }

        .btn-info:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #7c3aed;
            transform: translateY(-2px);
        }

        .btn-dark {
            background: var(--text-primary);
            color: white;
        }

        .btn-dark:hover {
            background: #0f172a;
            transform: translateY(-2px);
        }

        /* Breadcrumb Container */
        .breadcrumb-container {
            background: var(--card-bg);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .breadcrumb {
            margin-bottom: 0;
            background: transparent;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Form Elements */
        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.625rem 1rem;
            transition: all 0.3s ease;
            background: var(--card-bg);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        /* Table Styles */
        .table {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Badge Styles */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .middle-content > .row > * {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .layout-px-spacing {
                padding: 1rem;
            }

            #content {
                padding-top: 70px;
            }

            .card-body {
                padding: 1rem;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
    </style>

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

{{-- TEMEL KÜTÜPHANELER --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('backend/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- jQuery EKLENTİLERİ --}}
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- TEMA'NIN ANA SCRİPTLERİ --}}
<script src="{{ asset('backend/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('backend/layouts/horizontal-light-menu/app.js') }}"></script>
<script src="{{ asset('backend/src/assets/js/apps/mailbox.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="{{ asset('backend/additional.js') }}"></script>

@stack('scripts')

<script>
    // Session Mesajları
    @if (session('success'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: @json(session('success')),
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#ffffff',
        iconColor: '#10b981'
    });
    @endif

    @if (session('error'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: @json(session('error')),
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        background: '#ffffff',
        iconColor: '#ef4444'
    });
    @endif

    // Icon Picker Başlatıcı
    $(function () {
        const iconpicker = $('[role="iconpicker"]');
        if(iconpicker.length) {
            iconpicker.iconpicker();
        }
    });
</script>

</body>
</html>
