@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Anasayfa Yönetimi">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
                        </svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                                <h5 class="mb-0">Anasayfa Yönetimi</h5>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="row layout-top-spacing">

            {{-- Slider Yönetimi Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a href="{{ route('admin.sliders.index') }}">
                    <div class="widget widget-t-sales-widget widget-m-customers">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders">
                                    <line x1="4" y1="21" x2="4" y2="14"></line>
                                    <line x1="4" y1="10" x2="4" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12" y2="3"></line>
                                    <line x1="20" y1="21" x2="20" y2="16"></line>
                                    <line x1="20" y1="12" x2="20" y2="3"></line>
                                    <line x1="1" y1="14" x2="7" y2="14"></line>
                                    <line x1="9" y1="8" x2="15" y2="8"></line>
                                    <line x1="17" y1="16" x2="23" y2="16"></line>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Toplam Slider</p>
                                <p class="widget-numeric-value">{{ $stats['total_sliders'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">{{ $stats['active_sliders'] }} tanesi aktif</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Projeler Yönetimi Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a href="{{ route('admin.projects.index') }}">
                    <div class="widget widget-t-sales-widget widget-m-orders">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Toplam Proje</p>
                                <p class="widget-numeric-value">{{ $stats['total_projects'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">{{ $stats['ongoing_projects'] }} tanesi devam ediyor</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Müşteri Yorumları Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a href="{{ route('admin.testimonials.index') }}">
                    <div class="widget widget-t-sales-widget widget-m-income">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-message-circle">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Müşteri Yorumları</p>
                                <p class="widget-numeric-value">{{ $stats['total_testimonials'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">{{ $stats['pending_testimonials'] }} tanesi onay bekliyor</p>
                        </div>
                    </div>
                </a>
            </div>
            {{-- YENİ EKLENDİ: "Bizi Farklı Kılan" Bölümü Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a href="{{ route('admin.features.index') }}">
                    <div class="widget widget-t-sales-widget widget-m-customers">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-award">
                                    <circle cx="12" cy="8" r="7"></circle>
                                    <polyline points="8.21 13.89 7 23 12 17 17 23 15.79 13.88"></polyline>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Fark Yaratan Özellikler</p>
                                <p class="widget-numeric-value">{{ $stats['total_features'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">"Bizi Farklı Kılan" Alanı</p>
                        </div>
                    </div>
                </a>
            </div>
            {{-- YENİ EKLENDİ: "Sayılarla Biz" İstatistikleri Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a href="{{ route('admin.statistics.index') }}">
                    <div class="widget widget-t-sales-widget widget-m-orders">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">"Sayılarla Biz" Alanı</p>
                                <p class="widget-numeric-value">{{ $stats['total_statistics'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">İstatistikleri Yönet</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection
