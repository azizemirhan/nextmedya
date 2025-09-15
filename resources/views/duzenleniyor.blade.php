@extends('layouts.master')
@section('content')
    <div class="ab-inner-hero-area ab-inner-hero-bg p-relative" data-background="{{ asset('05.webp') }}"
        style="background-image: url({{ asset('site/assets/img/inner-about/hero/hero-1.jpg') }});">
        <div class="container container-1480">
            <div class="row justify-content-end">
                <div class="col-xl-5 col-lg-8">
                    <div class="ab-inner-hero-content" data-lag="0.2" data-stagger="0.08" data-speed="1"
                        style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); will-change: transform;">
                        <p>
                            sayfamızı yeniden tasarlıyoruz
                        </p>
                        <a class="tp-btn-white-sm border-style" href="{{ url()->previous() }}">Geri Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
