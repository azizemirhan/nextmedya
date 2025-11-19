@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Toplam Proje</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_projects'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-success btn-sm mt-3 w-100">Projeleri Yönet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Sayfa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_pages'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-warning btn-sm mt-3 w-100">Sayfaları Yönet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Blog Yazıları</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_posts'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-blog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-danger btn-sm mt-3 w-100">Yazıları Yönet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Hizmet Sayısı</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_services'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-concierge-bell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm mt-3 w-100">Hizmetleri Yönet</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Slider Sayısı</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_sliders'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-images fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary btn-sm mt-3 w-100">Slider'ları Yönet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Müşteri Yorumları</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_testimonials'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-info btn-sm mt-3 w-100">Yorumları Yönet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">S.S.S Sayısı</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_faqs'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-dark btn-sm mt-3 w-100">Soruları Yönet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Yönetici</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] }}</div>
                                <small class="text-success">+{{ $stats['new_users_this_week'] }} bu hafta</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm mt-3 w-100">Kullanıcıları Yönet</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted">Bugün Gelen</div>
                        <div class="h3 mb-0">{{ $cards['contact_today'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted">Son 7 Gün</div>
                        <div class="h3 mb-0">{{ $cards['contact_week'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- === Newsletter Widgets === --}}
        <div class="row g-3 mt-3">
            <div class="col-md-3">
                <a href="{{ route('admin.subscribers.index') }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted">Toplam Abone (Confirmed)</div>
                            <div class="h3 mb-0">{{ $cards['subs_total'] ?? 0 }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.subscribers.index', ['status' => 'pending']) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted">Bekleyen Doğrulama</div>
                            <div class="h3 mb-0">{{ $cards['subs_pending'] ?? 0 }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.subscribers.index', ['status' => 'unsubscribed']) }}"
                   class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted">Çıkmış Kullanıcı</div>
                            <div class="h3 mb-0">{{ $cards['subs_unsub'] ?? 0 }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted">Son 7 Gün Kayıt</div>
                        <div class="h3 mb-0">{{ $cards['subs_last7'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
