@extends('layouts.master')
@section('custom_header')
    @include('layouts.header-dark')
@endsection
@section('content')
    <div class="service-details__area service-details__space pt-200 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="service-details__title-box mb-40">
                        <h4 class="sv-hero-title tp-char-animation">Referanslarımız</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-4 col-xl-5">
                        <div class="service-details__banner-text mb-80">
                            <p class="mb-30 tp_title_anim">
                                Müşterilerimize özel geliştirilen modern web tasarım, yazılım ve e-ticaret projelerimizi
                                keşfedin. Yüksek performanslı, mobil uyumlu ve SEO dostu çözümler üretiyoruz.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-6 col-md-6">
                    <div class="grid">
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/antalyaagro.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/ankarabuyuksehir.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/magurex.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/dropgpt.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/erdektaliabeachhotel.png') }}" height="100"
                                width="250" alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/koc.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/gratis.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/siemens.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/zeya.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/zirveyapiprefabrik.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/rvpress.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/reyhan.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/investmentrys.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/eliteleaderconsultancy.png') }}" height="100"
                                width="250" alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/dag.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/antalyaekolojik.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/ankarauniversitesi.png') }}" height="100"
                                width="250" alt="" />
                        </div>
                        <div class="aspect-box">
                            <img src="{{ asset('uploads/companies/ahtkumas.png') }}" height="100" width="250"
                                alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('antalya.png') }}"
                                alt="" />
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('ankara.png') }}"
                                alt="" />
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('magurex.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('gratis.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('drop.png') }}"
                                alt="" />
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('erdek.png') }}"
                                alt="" />
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('koc.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('siemens.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('ankarauni.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
              <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('aht.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('elite.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('zirveyapi.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('zeya.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('rv.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('reyhan.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('investment.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('antalya2.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('ninawest.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('sozen.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('sozen2.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('referans1.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 grid-item cat2 cat4">
                <div class="tp-project-5-2-thumb anim-zoomin-wrap mb-30 p-relative not-hide-cursor"
                    data-cursor="View<br>Demo">
                    <a class="cursor-hide" href="portfolio-details-1.html">
                        <span>
                            <img class="anim-zoomin"
                                src="{{ asset('referans3.png') }}"
                                alt="" />
                        </span>

                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
