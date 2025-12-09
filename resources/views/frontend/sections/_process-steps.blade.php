@php
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Plan + Control');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'How it Works');
    $image = data_get($content, 'image') ? asset($content['image']) : 'https://placehold.co/1300x460';

    // === DÜZELTİLEN KISIM BAŞLANGICI ===
    $steps = data_get($content, 'steps', []);
    if (is_string($steps)) {
        $steps = json_decode($steps, true) ?? [];
    }
    // === DÜZELTİLEN KISIM BİTİŞİ ===
@endphp

<section class="gap about-how-it-works light-bg-color">
    <div class="heading">
        <figure>
            <img src="{{ asset('assets/images/heading-icon.png') }}" alt="Heading Icon">
        </figure>
        <span>{{ $smallTitle }}</span>
        <h2>{{ $mainTitle }}</h2>
    </div>
    <div class="container">
        <figure style="position: relative; z-index: 9;">
            <img class="w-100" src="{{ $image }}" alt="{{ $mainTitle }}">
        </figure>
    </div>
    <div class="container">
        <div class="row g-0">
            @foreach($steps as $step)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="plans">
                        <div class="y-box d-flex-all">
                            {{ $loop->iteration }}.
                        </div>
                        <h3>{{ data_get($step, 'step_title.' . app()->getLocale()) }}</h3>
                        <p>{{ data_get($step, 'step_content.' . app()->getLocale()) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
