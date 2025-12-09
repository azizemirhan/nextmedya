<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('backend/src/assets/img/favicon.ico') }}"/>

    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/loader.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/dark/loader.css') }}" rel="stylesheet"
          type="text/css"/>
    <script src="{{ asset('backend/layouts/horizontal-light-menu/loader.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/light/plugins.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/layouts/horizontal-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
          type="text/css"/>
    {{-- Sayfaya özel stiller için --}}
    @stack('styles')
</head>
<body class="form">

<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
{{-- Ana içerik bu bölüme gelecek --}}
@yield('content')

<script src="{{ asset('backend/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- Sayfaya özel scriptler için --}}
@stack('scripts')
</body>
</html>
