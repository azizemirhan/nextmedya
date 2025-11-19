@extends('frontend.layouts.master')

@section('title', $service->getTranslation('title', app()->getLocale()))

{{-- SEO Meta Tags --}}
@section('meta')
    <meta name="description" content="{{ $service->getTranslation('summary', app()->getLocale()) }}">
    <meta name="keywords" content="hizmet, {{ $service->getTranslation('title', app()->getLocale()) }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $service->getTranslation('title', app()->getLocale()) }}" />
    <meta property="og:description" content="{{ $service->getTranslation('summary', app()->getLocale()) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($service->cover_image)
        <meta property="og:image" content="{{ asset($service->cover_image) }}" />
    @endif
@endsection

{{-- Bootstrap CSS (eğer master layout'ta yoksa) --}}
@push('styles')
    {{-- Bootstrap CSS ekleme (eğer master'da yoksa) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ========================================
           İZOKOÇ SERVICE DETAIL STYLES
        ======================================== */

        :root {
            --izokoc-primary: #FF3131;
            --izokoc-secondary: #1a237e;
            --izokoc-blue: #2962FF;
            --izokoc-white: #ffffff;
            --izokoc-black: #000000;
            --izokoc-text-dark: #2c3e50;
            --izokoc-text-light: #7f8c8d;
            --izokoc-border: #e0e0e0;
            --izokoc-bg-light: #f8f9fa;
            --izokoc-shadow: rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            color: #fff;
        }
        /* ========== SERVICE DETAIL LAYOUT ========== */
        .izokoc_service_detail {
            padding: 60px 0 100px;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        /* ========== SERVICE HEADER ========== */
        .izokoc_service_header {
            margin-bottom: 40px;
        }

        .izokoc_service_category {
            display: inline-block;
            background: linear-gradient(135deg, var(--izokoc-primary), var(--izokoc-blue));
            color: var(--izokoc-white);
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .izokoc_service_category:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 49, 49, 0.3);
        }

        .izokoc_service_title {
            font-size: clamp(28px, 3vw, 38px);
            color: var(--izokoc-secondary);
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .izokoc_service_summary {
            font-size: 18px;
            color: var(--izokoc-text-light);
            line-height: 1.7;
            margin-bottom: 30px;
        }

        /* ========== COVER IMAGE ========== */
        .izokoc_service_cover {
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px var(--izokoc-shadow);
            position: relative;
        }

        .izokoc_service_cover img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .izokoc_service_cover:hover img {
            transform: scale(1.05);
        }

        /* ========== CONTENT CARD ========== */
        .izokoc_content_card {
            background: var(--izokoc-white);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px var(--izokoc-shadow);
            border: 1px solid var(--izokoc-border);
        }

        .izokoc_content_card h2 {
            font-size: clamp(22px, 2vw, 28px);
            color: var(--izokoc-secondary);
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }

        .izokoc_content_card h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--izokoc-primary), var(--izokoc-blue));
            border-radius: 2px;
        }

        .izokoc_content_card h3 {
            font-size: clamp(18px, 1.5vw, 22px);
            color: var(--izokoc-text-dark);
            margin: 25px 0 15px;
            font-weight: 600;
        }

        .izokoc_content_card p {
            font-size: 16px;
            line-height: 1.8;
            color: var(--izokoc-text-dark);
            margin-bottom: 16px;
        }

        .izokoc_content_card ul,
        .izokoc_content_card ol {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .izokoc_content_card li {
            margin-bottom: 10px;
            color: var(--izokoc-text-dark);
            line-height: 1.7;
        }

        .izokoc_content_card img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
        }

        /* ========== EXPECTATIONS PANEL ========== */
        .izokoc_expectations_panel {
            background: linear-gradient(135deg, rgba(255, 49, 49, 0.05), rgba(41, 98, 255, 0.05));
            border: 2px dashed var(--izokoc-border);
            border-radius: 16px;
            padding: 30px;
            margin-top: 30px;
        }

        /* ========== BENEFITS GRID ========== */
        .izokoc_benefits_grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        @media (max-width: 768px) {
            .izokoc_benefits_grid {
                grid-template-columns: 1fr;
            }
        }

        .izokoc_benefit_item {
            display: flex;
            gap: 15px;
            align-items: flex-start;
            padding: 20px;
            background: var(--izokoc-white);
            border: 2px solid var(--izokoc-border);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .izokoc_benefit_item:hover {
            border-color: var(--izokoc-primary);
            transform: translateY(-5px);
            box-shadow: 0 5px 20px var(--izokoc-shadow);
        }

        .izokoc_benefit_item i {
            color: var(--izokoc-primary);
            font-size: 22px;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .izokoc_benefit_item span {
            color: var(--izokoc-text-dark);
            font-size: 15px;
            line-height: 1.6;
        }

        /* ========== SUPPORT GRID ========== */
        .izokoc_support_grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        @media (max-width: 768px) {
            .izokoc_support_grid {
                grid-template-columns: 1fr;
            }
        }

        .izokoc_support_item {
            display: flex;
            gap: 15px;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, rgba(255, 49, 49, 0.05), rgba(41, 98, 255, 0.05));
            border: 1px solid var(--izokoc-border);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .izokoc_support_item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px var(--izokoc-shadow);
            background: linear-gradient(135deg, rgba(255, 49, 49, 0.1), rgba(41, 98, 255, 0.1));
        }

        .izokoc_support_item i {
            color: var(--izokoc-blue);
            font-size: 24px;
            flex-shrink: 0;
        }

        .izokoc_support_item p {
            margin: 0;
            color: var(--izokoc-text-dark);
            font-weight: 600;
            font-size: 15px;
        }

        /* ========== FAQ ACCORDION - DÜZELTİLMİŞ ========== */
        .izokoc_faq_accordion {
            margin-top: 25px;
        }

        /* Bootstrap Accordion Override */
        .izokoc_faq_accordion .accordion-item {
            background: var(--izokoc-white) !important;
            border: 1px solid var(--izokoc-border) !important;
            border-radius: 12px !important;
            margin-bottom: 15px !important;
            overflow: hidden;
        }

        .izokoc_faq_accordion .accordion-header {
            margin-bottom: 0 !important;
        }

        .izokoc_faq_accordion .accordion-button {
            background: var(--izokoc-bg-light) !important;
            color: var(--izokoc-text-dark) !important;
            font-weight: 600 !important;
            font-size: 16px !important;
            padding: 20px 25px !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            text-align: left;
            width: 100%;
            position: relative;
        }

        .izokoc_faq_accordion .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, var(--izokoc-primary), var(--izokoc-blue)) !important;
            color: var(--izokoc-white) !important;
            box-shadow: none !important;
        }

        .izokoc_faq_accordion .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 49, 49, 0.25) !important;
            border: none !important;
        }

        .izokoc_faq_accordion .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23FF3131'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }

        .izokoc_faq_accordion .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
            transform: rotate(180deg);
        }

        .izokoc_faq_accordion .accordion-collapse {
            border-top: 1px solid var(--izokoc-border);
        }

        .izokoc_faq_accordion .accordion-body {
            padding: 20px 25px !important;
            color: var(--izokoc-text-dark);
            line-height: 1.7;
            background: var(--izokoc-white);
        }

        /* FAQ Debug Styles - Geçici olarak ekleyin */
        .faq-debug {
            border: 2px solid red !important;
            background: yellow !important;
            padding: 10px !important;
            margin: 10px 0 !important;
        }

        /* ========== CTA CARD ========== */
        .izokoc_cta_card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 30px;
            background: linear-gradient(135deg, var(--izokoc-secondary), var(--izokoc-blue));
            border-radius: 16px;
            margin-top: 30px;
            color: var(--izokoc-white);
        }

        .izokoc_cta_content h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--izokoc-white);
        }

        .izokoc_cta_content p {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
        }

        .izokoc_cta_button {
            background: var(--izokoc-white);
            color: var(--izokoc-secondary);
            padding: 15px 35px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .izokoc_cta_button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            color: var(--izokoc-primary);
        }

        /* ========== GALLERY ========== */
        .izokoc_gallery_grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .izokoc_gallery_item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: var(--izokoc-bg-light);
            border: 2px solid var(--izokoc-border);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .izokoc_gallery_item:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 40px var(--izokoc-shadow);
            border-color: var(--izokoc-primary);
        }

        .izokoc_gallery_image {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
        }

        .izokoc_gallery_image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .izokoc_gallery_item:hover .izokoc_gallery_image img {
            transform: scale(1.1);
        }

        .izokoc_gallery_overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(26, 35, 126, 0.8), rgba(255, 49, 49, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .izokoc_gallery_item:hover .izokoc_gallery_overlay {
            opacity: 1;
        }

        .izokoc_gallery_btn {
            background: var(--izokoc-white);
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            color: var(--izokoc-primary);
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .izokoc_gallery_btn:hover {
            transform: scale(1.1) rotate(90deg);
        }

        /* ========== LIGHTBOX ========== */
        .izokoc_lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
        }

        .izokoc_lightbox.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .izokoc_lightbox_content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
        }

        .izokoc_lightbox_content img {
            width: 100%;
            height: auto;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 12px;
        }

        .izokoc_lightbox_close {
            position: absolute;
            top: -50px;
            right: 0;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .izokoc_lightbox_close:hover {
            color: var(--izokoc-primary);
        }

        .izokoc_lightbox_prev,
        .izokoc_lightbox_next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 16px 20px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.2s ease;
            backdrop-filter: blur(10px);
        }

        .izokoc_lightbox_prev:hover,
        .izokoc_lightbox_next:hover {
            background: var(--izokoc-primary);
            border-color: var(--izokoc-primary);
        }

        .izokoc_lightbox_prev {
            left: -80px;
        }

        .izokoc_lightbox_next {
            right: -80px;
        }

        .izokoc_lightbox_counter {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 14px;
            background: rgba(0, 0, 0, 0.7);
            padding: 8px 16px;
            border-radius: 20px;
        }

        /* ========== SIDEBAR ========== */
        .izokoc_sidebar {
            position: sticky;
            top: 110px;
        }

        /* ========== SIDEBAR: Featured Service ========== */
        .izokoc_featured_service {
            background: linear-gradient(135deg, var(--izokoc-secondary), var(--izokoc-blue));
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            color: var(--izokoc-white);
        }

        .izokoc_featured_service h3 {
            color: var(--izokoc-white);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .izokoc_featured_service p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            line-height: 1.6;
        }

        .izokoc_featured_service .izokoc_feature_thumb {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .izokoc_featured_service .izokoc_feature_thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .izokoc_featured_service .btn {
            background: var(--izokoc-white);
            color: var(--izokoc-secondary);
            font-weight: 700;
            border-radius: 30px;
            padding: 12px 30px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .izokoc_featured_service .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            color: var(--izokoc-primary);
        }

        /* ========== SIDEBAR: TOC ========== */
        .izokoc_toc_card {
            background: var(--izokoc-white);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            border: 2px solid var(--izokoc-border);
        }

        .izokoc_toc_card h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--izokoc-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .izokoc_toc_list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .izokoc_toc_list a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border: 1px solid var(--izokoc-border);
            border-radius: 10px;
            text-decoration: none;
            color: var(--izokoc-text-dark);
            transition: all 0.3s ease;
        }

        .izokoc_toc_list a:hover {
            border-color: var(--izokoc-primary);
            background: rgba(255, 49, 49, 0.05);
            transform: translateX(5px);
        }

        .izokoc_toc_dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--izokoc-primary);
            flex-shrink: 0;
        }

        /* ========== SIDEBAR: Quick CTA ========== */
        .izokoc_quick_cta {
            background: var(--izokoc-white);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            border: 2px solid var(--izokoc-border);
        }

        .izokoc_quick_cta h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--izokoc-secondary);
            margin-bottom: 8px;
        }

        .izokoc_quick_cta p {
            font-size: 13px;
            color: var(--izokoc-text-light);
            margin-bottom: 15px;
        }

        .izokoc_quick_cta .btn {
            width: 100%;
            background: linear-gradient(135deg, var(--izokoc-primary), var(--izokoc-blue));
            color: var(--izokoc-white);
            font-weight: 700;
            border-radius: 30px;
            padding: 12px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            text-align: center;
        }

        .izokoc_quick_cta .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(255, 49, 49, 0.3);
        }

        /* ========== SIDEBAR: Services List ========== */
        .izokoc_services_list {
            background: var(--izokoc-white);
            border-radius: 16px;
            padding: 25px;
            border: 2px solid var(--izokoc-border);
        }

        .izokoc_services_list h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--izokoc-secondary);
            margin-bottom: 20px;
        }

        .izokoc_service_item {
            display: flex;
            gap: 15px;
            align-items: center;
            padding: 15px;
            border: 1px solid var(--izokoc-border);
            border-radius: 12px;
            margin-bottom: 12px;
            text-decoration: none;
            color: var(--izokoc-text-dark);
            transition: all 0.3s ease;
            background: var(--izokoc-bg-light);
        }

        .izokoc_service_item:hover {
            transform: translateY(-3px);
            border-color: var(--izokoc-primary);
            box-shadow: 0 5px 15px var(--izokoc-shadow);
        }

        .izokoc_service_thumb {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            background: var(--izokoc-white);
        }

        .izokoc_service_thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .izokoc_service_placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 49, 49, 0.2), rgba(41, 98, 255, 0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--izokoc-primary);
            font-size: 24px;
        }

        .izokoc_service_meta h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--izokoc-secondary);
        }

        .izokoc_service_meta p {
            font-size: 12px;
            color: var(--izokoc-text-light);
            margin: 0;
            line-height: 1.4;
        }

        /* ========== RESPONSIVE ========== */
        @media screen and (max-width: 991px) {
            .izokoc_sidebar {
                position: static;
                margin-top: 50px;
            }
        }

        @media screen and (max-width: 768px) {
            .izokoc_service_detail {
                padding: 40px 0 60px;
            }

            .izokoc_content_card {
                padding: 25px 20px;
            }

            .izokoc_cta_card {
                flex-direction: column;
                text-align: center;
            }

            .izokoc_cta_button {
                width: 100%;
            }

            .izokoc_lightbox_prev {
                left: 10px;
            }

            .izokoc_lightbox_next {
                right: 10px;
            }

            .izokoc_lightbox_close {
                top: 10px;
                right: 20px;
            }

            .izokoc_lightbox_counter {
                bottom: 20px;
            }

            .izokoc_gallery_grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <section class="izokoc_service_detail">
        <div class="container">
            <div class="row g-4">
                {{-- LEFT COLUMN: Main Content --}}
                <div class="col-lg-8">
                    {{-- Service Header --}}
                    <div class="izokoc_service_header">
                        <a href="#" class="izokoc_service_category">
                            <i class="fas fa-tools"></i>
                            {{ __('Hizmetlerimiz') }}
                        </a>

                        @php
                            $title = $service->getTranslation('title', app()->getLocale());
                        @endphp

                        @if($title)
                            <h1 class="izokoc_service_title">{{ $title }}</h1>
                        @endif

                        @php
                            $summary = $service->getTranslation('summary', app()->getLocale());
                        @endphp

                        @if($summary)
                            <p class="izokoc_service_summary">{{ $summary }}</p>
                        @endif
                    </div>

                    {{-- Cover Image - Sadece varsa göster --}}
                    @if($service->cover_image)
                        <div class="izokoc_service_cover">
                            <img src="{{ asset($service->cover_image) }}"
                                 alt="{{ $title ?? 'Service' }}">
                        </div>
                    @endif

                    {{-- Main Content - Sadece varsa göster --}}
                    @php
                        $content = $service->getTranslation('content', app()->getLocale());
                        $expectationsContent = $service->getTranslation('expectations_content', app()->getLocale());
                    @endphp

                    @if($content || $expectationsContent)
                        <article id="details" class="izokoc_content_card">
                            <div class="izokoc_prose">
                                @if($content)
                                    {!! $content !!}
                                @endif

                                {{-- Expectations Content - Sadece varsa göster --}}
                                @if($expectationsContent)
                                    <div class="izokoc_expectations_panel">
                                        <h2>{{ __('Yüksek Beklentiler') }}</h2>
                                        <div class="izokoc_prose">
                                            {!! $expectationsContent !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endif

                    {{-- Benefits Section - Sadece varsa göster --}}
                    @if(!empty($service->benefits) && is_array($service->benefits) && count(array_filter($service->benefits)) > 0)
                        <section id="benefits" class="izokoc_content_card">
                            <h2>{{ __('Hizmetin Faydaları') }}</h2>
                            <div class="izokoc_benefits_grid">
                                @foreach($service->benefits as $benefit)
                                    @php
                                        $benefitText = data_get($benefit, 'text.' . app()->getLocale());
                                    @endphp
                                    @if($benefitText)
                                        <div class="izokoc_benefit_item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ $benefitText }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- Support Items Section - Sadece varsa göster --}}
                    @if(!empty($service->support_items) && is_array($service->support_items) && count(array_filter($service->support_items)) > 0)
                        <section id="support" class="izokoc_content_card">
                            <h2>{{ __('Nasıl Yardımcı Olabiliriz?') }}</h2>
                            <div class="izokoc_support_grid">
                                @foreach($service->support_items as $item)
                                    @php
                                        $supportText = data_get($item, 'text.' . app()->getLocale());
                                    @endphp
                                    @if($supportText)
                                        <div class="izokoc_support_item">
                                            <i class="fas fa-shield-alt"></i>
                                            <p>{{ $supportText }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- FAQ Section - Sadece varsa göster --}}
                    @if(!empty($service->faqs) && is_array($service->faqs))
                        @php
                            // En az bir geçerli FAQ var mı kontrol et
                            $hasValidFaq = false;
                            foreach($service->faqs as $faq) {
                                $currentLocale = app()->getLocale();
                                $question = data_get($faq, "question.{$currentLocale}")
                                         ?? data_get($faq, 'question.tr')
                                         ?? data_get($faq, 'question');
                                if($question) {
                                    $hasValidFaq = true;
                                    break;
                                }
                            }
                        @endphp

                        @if($hasValidFaq)
                            <section id="faq" class="izokoc_content_card">
                                <h2>{{ __('Sıkça Sorulan Sorular') }}</h2>

                                <div class="accordion izokoc_faq_accordion" id="serviceAccordion">
                                    @foreach($service->faqs as $index => $faq)
                                        @php
                                            $currentLocale = app()->getLocale();
                                            $question = data_get($faq, "question.{$currentLocale}")
                                                     ?? data_get($faq, 'question.tr')
                                                     ?? data_get($faq, 'question');
                                            $answer = data_get($faq, "answer.{$currentLocale}")
                                                   ?? data_get($faq, 'answer.tr')
                                                   ?? data_get($faq, 'answer');
                                        @endphp

                                        @if($question)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $index }}">
                                                    <button class="accordion-button collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $index }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse{{ $index }}">
                                                        {{ $question }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $index }}"
                                                     class="accordion-collapse collapse"
                                                     aria-labelledby="heading{{ $index }}"
                                                     data-bs-parent="#serviceAccordion">
                                                    <div class="accordion-body">
                                                        @if($answer)
                                                            {!! $answer !!}
                                                        @else
                                                            <p class="text-muted">{{ __('Bu soru için henüz cevap eklenmemiş.') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    @endif

                    {{-- CTA Card --}}
                    <div class="izokoc_cta_card">
                        <div class="izokoc_cta_content">
                            <h3>{{ __('Bu hizmet hakkında hızlı keşif görüşmesi planlayın') }}</h3>
                            <p>{{ __('Ortalama yanıt süresi: Aynı iş günü') }}</p>
                        </div>
                        <a href="/iletisim" class="izokoc_cta_button">
                            {{ __('Teklif Alın') }}
                        </a>
                    </div>

                    {{-- Gallery Section - Sadece varsa göster --}}
                    @if(!empty($service->gallery_images) && is_array($service->gallery_images) && count($service->gallery_images) > 0)
                        <section id="projects" class="izokoc_content_card">
                            <h2>{{ __('Bu Hizmetle İlgili Projeler') }}</h2>
                            <div class="izokoc_gallery_grid">
                                @foreach($service->gallery_images as $index => $image)
                                    @if($image)
                                        <div class="izokoc_gallery_item" onclick="openLightbox({{ $index }})">
                                            <div class="izokoc_gallery_image">
                                                <img src="{{ asset($image) }}" alt="Proje {{ $index + 1 }}">
                                                <div class="izokoc_gallery_overlay">
                                                    <button class="izokoc_gallery_btn">
                                                        <i class="fas fa-expand"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </section>

                        {{-- Lightbox --}}
                        <div id="lightbox" class="izokoc_lightbox" onclick="closeLightbox()">
                            <div class="izokoc_lightbox_content" onclick="event.stopPropagation()">
                                <span class="izokoc_lightbox_close" onclick="closeLightbox()">&times;</span>
                                <button class="izokoc_lightbox_prev" onclick="changeImage(-1)">&#10094;</button>
                                <img id="lightbox-image" src="" alt="">
                                <button class="izokoc_lightbox_next" onclick="changeImage(1)">&#10095;</button>
                                <div class="izokoc_lightbox_counter">
                                    <span id="image-counter"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN: Sidebar --}}
                <div class="col-lg-4">
                    <aside class="izokoc_sidebar">
                        {{-- Featured Service --}}
                        @php
                            $nextService = \App\Models\Service::query()
                                ->where('is_active', true)
                                ->where('id', '!=', $service->id)
                                ->where('order', '>', $service->order)
                                ->orderBy('order')
                                ->first();

                            if (!$nextService) {
                                $nextService = \App\Models\Service::query()
                                    ->where('is_active', true)
                                    ->where('id', '!=', $service->id)
                                    ->orderBy('order')
                                    ->first();
                            }
                        @endphp

                        @if($nextService)
                            <div class="izokoc_featured_service">
                                <div class="d-flex gap-3 mb-3">
                                    <div class="izokoc_feature_thumb">
                                        @if($nextService->cover_image)
                                            <img src="{{ asset($nextService->cover_image) }}"
                                                 alt="{{ $nextService->getTranslation('title', app()->getLocale()) }}">
                                        @else
                                            <div class="izokoc_service_placeholder">
                                                <i class="fas fa-tools"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div style="margin-left: 10px">
                                        <h3>{{ $nextService->getTranslation('title', app()->getLocale()) }}</h3>
                                        @if($nextService->getTranslation('summary', app()->getLocale()))
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($nextService->getTranslation('summary', app()->getLocale())), 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('frontend.services.show', $nextService->slug) }}" class="btn">
                                    {{ __('Diğer Hizmetlerimiz') }}
                                </a>
                            </div>
                        @endif

                        {{-- Table of Contents --}}
                        {{-- Table of Contents --}}
                        <div class="izokoc_toc_card">
                            <h3>{{ __('İçindekiler') }}</h3>
                            <ul class="izokoc_toc_list">
                                @php
                                    $hasContent = $service->getTranslation('content', app()->getLocale())
                                               || $service->getTranslation('expectations_content', app()->getLocale());
                                    $hasBenefits = !empty($service->benefits) && is_array($service->benefits) && count(array_filter($service->benefits)) > 0;
                                    $hasSupport = !empty($service->support_items) && is_array($service->support_items) && count(array_filter($service->support_items)) > 0;
                                    $hasFaq = !empty($service->faqs) && is_array($service->faqs);
                                    $hasGallery = !empty($service->gallery_images) && is_array($service->gallery_images) && count($service->gallery_images) > 0;
                                @endphp

                                @if($hasContent)
                                    <li>
                                        <a href="#details">
                                            <span class="izokoc_toc_dot"></span>
                                            <span>{{ __('Detaylar') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($hasBenefits)
                                    <li>
                                        <a href="#benefits">
                                            <span class="izokoc_toc_dot"></span>
                                            <span>{{ __('Faydalar') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($hasSupport)
                                    <li>
                                        <a href="#support">
                                            <span class="izokoc_toc_dot"></span>
                                            <span>{{ __('Destek Alanları') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($hasFaq)
                                    <li>
                                        <a href="#faq">
                                            <span class="izokoc_toc_dot"></span>
                                            <span>{{ __('SSS') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($hasGallery)
                                    <li>
                                        <a href="#projects">
                                            <span class="izokoc_toc_dot"></span>
                                            <span>{{ __('Projeler') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        {{-- Quick CTA --}}
                        <div class="izokoc_quick_cta">
                            <h4>{{ __('Hemen İletişime Geçin') }}</h4>
                            <p>{{ __('Sorularınıza Hızlı Yanıt') }}</p>
                            <a href="/iletisim" class="btn">
                                {{ __('İletişim Kurun') }}
                            </a>
                        </div>

                        {{-- Other Services List --}}
                        @php
                            $sidebarServices = \App\Models\Service::query()
                                ->where('is_active', true)
                                ->where('id', '!=', $service->id)
                                ->orderBy('order')
                                ->limit(4)
                                ->get();
                        @endphp

                        @if($sidebarServices->isNotEmpty())
                            <div class="izokoc_services_list">
                                <h3>{{ __('Tüm Hizmetlerimiz') }}</h3>
                                @foreach($sidebarServices as $svc)
                                    <a href="{{ route('frontend.services.show', $svc->slug) }}" class="izokoc_service_item">
                                        <div class="izokoc_service_thumb">
                                            @if($svc->cover_image)
                                                <img src="{{ asset($svc->cover_image) }}"
                                                     alt="{{ $svc->getTranslation('title', app()->getLocale()) }}">
                                            @else
                                                <div class="izokoc_service_placeholder">
                                                    <i class="fas fa-tools"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="izokoc_service_meta">
                                            <h4>{{ $svc->getTranslation('title', app()->getLocale()) }}</h4>
                                            @if($svc->getTranslation('summary', app()->getLocale()))
                                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($svc->getTranslation('summary', app()->getLocale())), 60) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Bootstrap JS ekleme --}}
@push('scripts')
    {{-- Bootstrap JS (eğer master'da yoksa) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Bootstrap accordion manuel başlatma
        document.addEventListener('DOMContentLoaded', function() {
            // Bootstrap accordion'u manuel olarak başlat
            const accordionButtons = document.querySelectorAll('.accordion-button');
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = document.querySelector(this.getAttribute('data-bs-target'));
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    // Diğer açık olanları kapat
                    document.querySelectorAll('.accordion-collapse').forEach(collapse => {
                        if (collapse !== target) {
                            collapse.classList.remove('show');
                            const btn = document.querySelector(`[data-bs-target="#${collapse.id}"]`);
                            if (btn) {
                                btn.classList.add('collapsed');
                                btn.setAttribute('aria-expanded', 'false');
                            }
                        }
                    });

                    // Hedefi aç/kapat
                    if (isExpanded) {
                        target.classList.remove('show');
                        this.classList.add('collapsed');
                        this.setAttribute('aria-expanded', 'false');
                    } else {
                        target.classList.add('show');
                        this.classList.remove('collapsed');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            console.log('Accordion initialized:', accordionButtons.length + ' buttons found');
        });

        // Alternatif basit FAQ toggle fonksiyonu
        function toggleFaq(index) {
            const answer = document.getElementById('faq-answer-' + index);
            const icon = answer.previousElementSibling.querySelector('.toggle-icon');

            if (answer.style.display === 'none' || answer.style.display === '') {
                answer.style.display = 'block';
                icon.textContent = '-';
            } else {
                answer.style.display = 'none';
                icon.textContent = '+';
            }
        }

        // Lightbox functionality
        let currentImageIndex = 0;
        const images = @json($service->gallery_images ?? []);

        function openLightbox(index) {
            currentImageIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const counter = document.getElementById('image-counter');

            lightboxImage.src = "{{ asset('') }}" + images[currentImageIndex];
            counter.textContent = `${currentImageIndex + 1} / ${images.length}`;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function changeImage(direction) {
            currentImageIndex += direction;

            if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            } else if (currentImageIndex < 0) {
                currentImageIndex = images.length - 1;
            }

            const lightboxImage = document.getElementById('lightbox-image');
            const counter = document.getElementById('image-counter');

            lightboxImage.src = "{{ asset('') }}" + images[currentImageIndex];
            counter.textContent = `${currentImageIndex + 1} / ${images.length}`;
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox && lightbox.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    changeImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeImage(1);
                }
            }
        });

        // Smooth scroll for TOC links
        document.querySelectorAll('.izokoc_toc_list a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush