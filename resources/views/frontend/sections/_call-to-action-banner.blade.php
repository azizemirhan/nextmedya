@php
    // DÜZELTME: Admin panelinden girilen çok dilli içerikleri data_get() ile güvenli bir şekilde alıyoruz.
    $title = data_get($content, 'title.' . app()->getLocale(), 'Your Renovation');
    $subtitle = data_get($content, 'subtitle.' . app()->getLocale(), 'Starts Here');
    $mainContent = data_get($content, 'content.' . app()->getLocale(), 'Each of our completed projects comes with a 2-5 year warranty...');

    // Bu alan tekil olduğu için doğrudan erişim doğrudur.
    $backgroundImage = isset($content['background_image']) ? asset($content['background_image']) : 'https://placehold.co/1920x800';
@endphp

<section class="gap renovation">
    <div class="parallax" style="background-image: url({{ $backgroundImage }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="reno-data">
                    <h2>{{ $title }}</h2>
                    <h6 style="color: #fff">{{ $subtitle }}</h6>
                    <p>{!! $mainContent !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
