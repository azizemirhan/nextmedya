<style>
    /* Modern Navbar Styles */
    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
        padding: 0.75rem 0;
        transition: all 0.3s ease;
    }

    .topbar:hover {
        box-shadow: var(--shadow-md);
    }

    /* Logo */
    .topbar .navbar-brand img {
        transition: transform 0.3s ease;
    }

    .topbar .navbar-brand:hover img {
        transform: scale(1.05);
    }

    /* Nav Items */
    .navbar-nav {
        gap: 0.25rem;
    }

    .navbar-nav .nav-link,
    .navbar-nav .dropdown-item {
        color: var(--text-primary);
        font-weight: 500;
        padding: 0.625rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        color: var(--primary-color);
        transform: translateX(4px);
    }

    .navbar-nav .nav-link svg,
    .navbar-nav .dropdown-item svg {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover svg,
    .navbar-nav .dropdown-item:hover svg {
        transform: scale(1.1);
    }

    /* Dropdown Menu */
    .dropdown-menu {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
        padding: 0.5rem;
        margin-top: 0.5rem;
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        animation: dropdownFade 0.3s ease;
    }

    @keyframes dropdownFade {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        border-radius: 8px;
        margin-bottom: 0.25rem;
    }

    .dropdown-divider {
        border-color: var(--border-color);
        margin: 0.5rem 0;
    }

    /* User Dropdown Button */
    .user-dropdown-btn {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-dropdown-btn:hover {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.15));
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .user-dropdown-btn img {
        border: 2px solid white;
        box-shadow: var(--shadow-sm);
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }

    .mobile-menu-btn:hover {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
        border-color: var(--primary-color);
    }

    /* Badge for notifications */
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--danger-color);
        color: white;
        border-radius: 50%;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
        font-weight: 600;
    }

    /* Active State */
    .navbar-nav .nav-link.active,
    .navbar-nav .dropdown-item.active {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
    }

    .navbar-nav .nav-link.active svg,
    .navbar-nav .dropdown-item.active svg {
        color: white;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .topbar {
            padding: 0.5rem 0;
        }

        .navbar-nav {
            gap: 0.5rem;
            padding: 1rem 0;
        }
    }
</style>

<!-- Modern Topbar -->
<nav class="topbar navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="d-flex align-items-center gap-3">
            <!-- Mobile Menu Button -->
            <button
                class="mobile-menu-btn d-lg-none"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar"
                aria-label="Menüyü aç"
            >
                <i class="bi bi-list"></i>
            </button>

            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('backend/logo-dark.png') }}" width="100px" alt="Next Medya">
            </a>

            <!-- Desktop Navigation -->
            <ul class="navbar-nav ms-3 d-none d-lg-flex align-items-center">

                <!-- Sayfa Yönetimi Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855q-.215.403-.395.872c.705.157 1.472.257 2.282.287zM4.249 3.539q.214-.577.481-1.078a7 7 0 0 1 .597-.933A7 7 0 0 0 3.051 3.05q.544.277 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9 9 0 0 1-1.565-.667A6.96 6.96 0 0 0 1.018 7.5zm1.4-2.741a12.3 12.3 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332M8.5 5.09V7.5h2.99a12.3 12.3 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.6 13.6 0 0 1 7.5 10.91V8.5zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741zm-3.282 3.696q.18.469.395.872c.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a7 7 0 0 1-.598-.933 9 9 0 0 1-.481-1.079 8.4 8.4 0 0 0-1.198.49 7 7 0 0 0 2.276 1.522zm-1.383-2.964A13.4 13.4 0 0 1 3.508 8.5h-2.49a6.96 6.96 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667m6.728 2.964a7 7 0 0 0 2.275-1.521 8.4 8.4 0 0 0-1.197-.49 9 9 0 0 1-.481 1.078 7 7 0 0 1-.597.933M8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855q.216-.403.395-.872A12.6 12.6 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.96 6.96 0 0 0 14.982 8.5h-2.49a13.4 13.4 0 0 1-.437 3.008M14.982 7.5a6.96 6.96 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008zM11.27 2.461q.266.502.482 1.078a8.4 8.4 0 0 0 1.196-.49 7 7 0 0 0-2.275-1.52c.218.283.418.597.597.932m-.488 1.343a8 8 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
                        </svg>
                        <span>Sayfa Yönetimi</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.pages.index') }}">
                                <i class="bi bi-file-text"></i> Sayfalar
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.media.index') }}">
                                <i class="bi bi-images"></i> Galeri
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.projects.index') }}">
                                <i class="bi bi-folder"></i> Projeler
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.sliders.index') }}">
                                <i class="bi bi-sliders"></i> Slider
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">
                                <i class="bi bi-tools"></i> Hizmetler
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.testimonials.index') }}">
                                <i class="bi bi-chat-quote"></i> Müşteri Yorumlar
                            </a></li>
                    </ul>
                </li>

                <!-- Blog Yönetimi Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1z"/>
                        </svg>
                        <span>Blog Yönetimi</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.posts.index') }}">
                                <i class="bi bi-journal-text"></i> Yazılar
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                <i class="bi bi-bookmarks"></i> Kategoriler
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.projects.index') }}">
                                <i class="bi bi-tags"></i> Etiketler
                            </a></li>
                    </ul>
                </li>

                <!-- Talepler -->

                <!-- Mail Kutusu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.mailbox.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                            <path
                                d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                        </svg>
                        <span>Mail Kutusu</span>
                    </a>
                </li>
                <!-- Aboneler -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.subscribers.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z"/>
                            <path
                                d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z"/>
                        </svg>
                        <span>Aboneler</span>
                    </a>
                </li>

                <!-- Ayarlar Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z"/>
                        </svg>
                        <span>Ayarlar</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                <i class="bi bi-gear"></i> Genel Ayarlar
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.menus.index') }}">
                                <i class="bi bi-list-ul"></i> Menü Yönetimi
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                <i class="bi bi-person"></i> Profil
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                <i class="bi bi-shield-check"></i> Roller
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.permissions.index') }}">
                                <i class="bi bi-key"></i> İzinler
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people"></i> Kullanıcılar
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                    d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z"/>
                        </svg>
                        <span>Güvenlik</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.security.recaptcha.dashboard') }}">
                                <i class="bi bi-gear"></i> Cloudflare
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.menus.index') }}">
                                <i class="bi bi-list-ul"></i> Google Cloud
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Right Side: User Menu -->
        <div class="d-flex align-items-center gap-2">
            <div class="dropdown">
                <button
                    class="user-dropdown-btn btn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    @if(isset($loggedInUser))
                        <img
                            src="{{ asset($loggedInUser->image) }}"
                            class="rounded-circle"
                            width="32"
                            height="32"
                            alt="User"
                        />
                    @endif
                    <span class="d-none d-sm-inline fw-semibold">Aziz</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                            <i class="bi bi-person me-2"></i>Profilim
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider"/>
                    </li>
                    <li>
                        <a href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Çıkış Yap
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header" style="background: var(--primary-color); color: white;">
        <h5 class="offcanvas-title">
            <i class="bi bi-grid-3x3-gap me-2"></i>Menü
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group list-group-flush">
            <!-- Sayfa Yönetimi -->
            <div class="mb-3">
                <h6 class="text-muted text-uppercase small px-3 mb-2">Sayfa Yönetimi</h6>
                <a href="{{ route('admin.pages.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-file-text me-2"></i>Sayfalar
                </a>
                <a href="{{ route('admin.media.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-images me-2"></i>Galeri
                </a>
                <a href="{{ route('admin.projects.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-folder me-2"></i>Projeler
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-sliders me-2"></i>Slider
                </a>
                <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-tools me-2"></i>Hizmetler
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-chat-quote me-2"></i>Müşteri Yorumlar
                </a>
            </div>

            <!-- Blog Yönetimi -->
            <div class="mb-3">
                <h6 class="text-muted text-uppercase small px-3 mb-2">Blog Yönetimi</h6>
                <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-journal-text me-2"></i>Yazılar
                </a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-bookmarks me-2"></i>Kategoriler
                </a>
            </div>

            <!-- Diğer -->
            <div class="mb-3">
                <h6 class="text-muted text-uppercase small px-3 mb-2">İletişim</h6>
                <a href="{{ route('admin.mailbox.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-envelope me-2"></i>Mail Kutusu
                </a>
                <a href="{{ route('admin.admin.chat') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-chat-dots me-2"></i>Chat
                </a>
                <a href="{{ route('admin.subscribers.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-newspaper me-2"></i>Aboneler
                </a>
            </div>

            <!-- Ayarlar -->
            <div class="mb-3">
                <h6 class="text-muted text-uppercase small px-3 mb-2">Ayarlar</h6>
                <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear me-2"></i>Genel Ayarlar
                </a>
                <a href="{{ route('admin.menus.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-list-ul me-2"></i>Menü Yönetimi
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-person me-2"></i>Profil
                </a>
                <a href="{{ route('admin.roles.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-check me-2"></i>Roller
                </a>
                <a href="{{ route('admin.permissions.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-key me-2"></i>İzinler
                </a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-people me-2"></i>Kullanıcılar
                </a>
            </div>
        </div>
    </div>
</div>
