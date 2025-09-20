<div class="sidebar-wrapper sidebar-theme" style="margin-top: 30px">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="./index.html">
                        <img src="{{ asset('backend/src/assets/img/logo.svg') }}" class="navbar-logo"
                             alt="logo"/>
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="./index.html" class="nav-link"> EQUATION </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu active">
                <a href="#dashboard" data-bs-toggle="dropdown" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="dropdown-menu submenu list-unstyled" id="dashboard"
                    data-bs-parent="#accordionExample">
                    <li class="active">
                        <a href="{{ route('admin.dashboard') }}"> Genel Bakış </a>
                    </li>
                    <li>
                        <a href=""> Satış Raporları </a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>YÖNETİM</span></div>
            </li>

            <li class="menu">
                <a href="#crm" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Müşteri Yönetimi</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="dropdown-menu submenu list-unstyled" id="crm"
                    data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.accounts.index') }}"> Şirketler </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.index') }}"> Kişiler </a>
                    </li>
                    <li>
                        <a href=""> Fırsatlar (Teklifler) </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tasks.index') }}"> Görevler </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#projects" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                            </rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <span>Proje Yönetimi</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="dropdown-menu submenu list-unstyled" id="projects"
                    data-bs-parent="#accordionExample">
                    <li>
                        <a href=""> Tüm Projeler </a>
                    </li>
                    <li>
                        <a href=""> Yeni Proje Ekle </a>
                    </li>
                    <li class="sub-submenu dropend">
                        <a href="#invoice" data-bs-toggle="dropdown" aria-expanded="false"
                           class="dropdown-toggle collapsed">Faturalar
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                        <ul class="dropdown-menu list-unstyled sub-submenu" id="invoice">
                            <li>
                                <a href=""> Fatura Listesi </a>
                            </li>
                            <li>
                                <a href=""> Yeni Fatura Oluştur </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>İÇERİK</span></div>
            </li>

            <li class="menu">
                <a href="#blog" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                        <span>Blog Yönetimi</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="dropdown-menu submenu list-unstyled" id="blog"
                    data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.posts.index') }}"> Tüm Yazılar </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.create') }}"> Yeni Yazı Ekle </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"> Kategoriler </a>
                    </li>
                    <li>
                        <a href=""> Etiketler </a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>SİSTEM</span></div>
            </li>

            <li class="menu">
                <a href="#users" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-people" viewBox="0 0 16 16">
                            <path
                                d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        </svg>
                        <span>Kullanıcı Yönetimi</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="dropdown-menu submenu list-unstyled" id="blog"
                    data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.users.index') }}">Kullanıcı Yönetimi</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.roles.index') }}">Rol Yönetimi</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.permissions.index') }}"> İzin Yönetimi</a>
                    </li>

                </ul>
            </li>

            <li class="menu">
                <a href="" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        <span>Genel Ayarlar</span>
                    </div>
                </a>
            </li>

        </ul>
    </nav>
</div>
