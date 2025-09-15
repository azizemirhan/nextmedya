<header class="tp-header-height">

    <!-- header top area start -->
    <div id="header-sticky" class="tp-header-area tp-header-mob-space tp-transparent pl-60 pr-60 z-index-9">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-6">
                    <div class="tp-header-logo">
                        <div class="wrapper">
                            <a class="logo-1" href="/"><img src="{{ asset('site/assets/img/logo.png') }}"
                                    loading="lazy" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-9 d-none d-xl-block">
                    <div class="tp-header-menu header-main-menu text-center">
                        <nav class="tp-main-menu-content">
                            <ul>
                                <li class="has-dropdown">
                                    <a href="#">Hizmetlerimiz</a>
                                    <ul class="tp-submenu submenu">
                                        <li><a href="{{ route('kurumsalwebtasarim') }}">Kurumsal
                                                Web Tasarım</a>
                                        </li>
                                        <li><a href="{{ route('ampwebtasarim') }}">AMP
                                                Web Tasarım</a>
                                        </li>
                                        <li><a href="{{ route('kisiselwebsitesitasarimi') }}">Kişisel
                                                Web
                                                Tasarım</a>
                                        </li>
                                        <li><a href="{{ route('uruntanitimsitesi') }}">Ürün
                                                Tanıtım
                                                Sitesi</a>
                                        </li>
                                        <li><a href="{{ route('onepagewebtasarim') }}">One
                                                Page Web
                                                Tasarımı</a>
                                        </li>
                                        <li><a href="{{ route('pwawebtasarim') }}">PWA
                                                Web
                                                Tasarım</a>
                                        </li>
                                        <li><a href="{{ route('seodanismanligi') }}">Seo Danışmanlığı
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('referanslarimiz') }}">Referanslarımız</a>
                                </li>
                                <li class="has-dropdown">
                                    <a href="#">Kurumsal</a>
                                    <ul class="tp-submenu submenu">
                                        <li><a href="{{ route('hakkimizda') }}">Hakkımızda</a></li>
                                        <li><a href="{{ route('iletisim') }}">İletişim</a></li>
                                    </ul>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('duzenleniyor') }}">Next Bilişim</a>
                                </li> --}}
                                <li>
                                    <a href="https://www.blog.nextmedya.com/" >Blog</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg col-6">

                    <div class="tp-header-bar">
                        @auth
                            <a href="{{ route('dashboard') }}" style="color: #fff; font-size: 20px">
                                <i class="fa-solid fa-user" style="color: #fff"></i>
                                Panelim
                            </a>
                        @else
                            <a href="javascript:void(0);" onclick="openModal()" id="login" style="color: #fff">
                                <i class="fa-solid fa-phone" style="color: #fff"></i>
                                Destek
                            </a>
                        @endauth
                        <button class="tp-offcanvas-open-btn" style="margin-left: 10px">
                            <span style="background-color: #fff"></span>
                            <span style="background-color: #fff"></span>
                            <span style="background-color: #fff"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top area end -->

</header>
