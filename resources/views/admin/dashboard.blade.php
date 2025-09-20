@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Dashboard">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/></svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title"><h5 class="mb-0">Dashboard</h5></div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="row layout-top-spacing">

            {{-- Müşteri (Account) Sayısı Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <div class="widget widget-t-sales-widget widget-m-customers">
                    <div class="media">
                        <div class="icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></div>
                        <div class="media-body">
                            <p class="widget-text">Toplam Müşteri</p>
                            <p class="widget-numeric-value">{{ $stats['total_accounts'] }}</p>
                        </div>
                    </div>
                    <div class="d-flex w-bottom">
                        <p class="widget-total-stats">Bu hafta +{{ $stats['new_accounts_this_week'] }} yeni</p>
                    </div>
                </div>
            </div>

            {{-- Kişi (Contact) Sayısı Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <div class="widget widget-t-sales-widget widget-m-orders">
                    <div class="media">
                        <div class="icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                        <div class="media-body">
                            <p class="widget-text">Toplam Kişi</p>
                            <p class="widget-numeric-value">{{ $stats['total_contacts'] }}</p>
                        </div>
                    </div>
                    <div class="d-flex w-bottom">
                        <p class="widget-total-stats">Bu hafta +{{ $stats['new_contacts_this_week'] }} yeni</p>
                    </div>
                </div>
            </div>

            {{-- Aktif Görevler Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <div class="widget widget-t-sales-widget widget-m-sales">
                    <div class="media">
                        <div class="icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></div>
                        <div class="media-body">
                            <p class="widget-text">Aktif Görevler</p>
                            <p class="widget-numeric-value">{{ $stats['active_tasks'] }}</p>
                        </div>
                    </div>
                    <div class="d-flex w-bottom">
                        <p class="widget-total-stats">Toplam {{ $stats['total_tasks'] }} görev</p>
                    </div>
                </div>
            </div>

            {{-- Toplam Kullanıcı Widget --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <div class="widget widget-t-sales-widget widget-m-income">
                    <div class="media">
                        <div class="icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div>
                        <div class="media-body">
                            <p class="widget-text">Sistem Kullanıcıları</p>
                            <p class="widget-numeric-value">{{ $stats['total_users'] }}</p>
                        </div>
                    </div>
                    <div class="d-flex w-bottom">
                        <p class="widget-total-stats">Bu hafta +{{ $stats['new_users_this_week'] }} yeni</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 layout-spacing">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Son Eklenen Müşteriler</h5></div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($recent_accounts as $account)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $account->name }}</span>
                                    <small>{{ $account->created_at->diffForHumans() }}</small>
                                </li>
                            @empty
                                <li class="list-group-item">Henüz müşteri eklenmemiş.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 layout-spacing">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Son Eklenen Görevler</h5></div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($recent_tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $task->title }}</strong><br>
                                        <small class="text-muted">{{ $task->board->name ?? '' }} / {{ $task->taskList->name ?? '' }}</small>
                                    </div>
                                    <span class="badge bg-info">{{ $task->status }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">Henüz görev eklenmemiş.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
