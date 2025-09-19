@extends('admin.layouts.master')
@section('content')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
        <div class="widget widget-t-sales-widget widget-m-sales">
            <div class="media">
                <div class="icon ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-activity">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                <div class="media-body">
                    <p class="widget-text">Organic</p>
                    <p class="widget-numeric-value">1,700</p>
                </div>
            </div>
            <div class="d-flex w-bottom">
                <p class="widget-total-stats">+16% this week</p>
                <div class="task-action">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="statistics" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </a>

                        <div class="dropdown-menu left" aria-labelledby="statistics" style="will-change: transform">
                            <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
        <div class="widget widget-t-sales-widget widget-m-orders">
            <div class="media">
                <div class="icon ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-globe">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path
                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                        </path>
                    </svg>
                </div>
                <div class="media-body">
                    <p class="widget-text">Direct</p>
                    <p class="widget-numeric-value">1,560</p>
                </div>
            </div>
            <div class="d-flex w-bottom">
                <p class="widget-total-stats">-10% this week</p>
                <div class="task-action">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="statistics" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </a>

                        <div class="dropdown-menu left" aria-labelledby="statistics" style="will-change: transform">
                            <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
        <div class="widget widget-t-sales-widget widget-m-customers">
            <div class="media">
                <div class="icon ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-link">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                </div>
                <div class="media-body">
                    <p class="widget-text">Referral</p>
                    <p class="widget-numeric-value">1,900</p>
                </div>
            </div>
            <div class="d-flex w-bottom">
                <p class="widget-total-stats">+30% this week</p>
                <div class="task-action">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="statistics"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </a>

                        <div class="dropdown-menu left" aria-labelledby="statistics" style="will-change: transform">
                            <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
        <div class="widget widget-t-sales-widget widget-m-income">
            <div class="media">
                <div class="icon ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-smartphone">
                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                    </svg>
                </div>
                <div class="media-body">
                    <p class="widget-text">Social</p>
                    <p class="widget-numeric-value">1,390</p>
                </div>
            </div>
            <div class="d-flex w-bottom">
                <p class="widget-total-stats">+4% this week</p>
                <div class="task-action">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="statistics"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </a>

                        <div class="dropdown-menu left" aria-labelledby="statistics" style="will-change: transform">
                            <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                            <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
