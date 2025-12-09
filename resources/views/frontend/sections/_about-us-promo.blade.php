@php
    // DÜZELTME: Admin panelinden gelen çok dilli içerikleri data_get() ile güvenli bir şekilde alıyoruz.
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Welcome to Our Company');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Constro Provides a full range of services');
    $mainContent = data_get($content, 'content.' . app()->getLocale(), 'Default content text...');

    // Bu alanlar tekil (translatable olmayan) olduğu için doğrudan erişim doğrudur.
    $imageOne = isset($content['image_one']) ? asset($content['image_one']) : 'https://placehold.co/370x500';
    $imageTwo = isset($content['image_two']) ? asset($content['image_two']) : 'https://placehold.co/265x325';
    $signatureImage = isset($content['signature_image']) ? asset($content['signature_image']) : asset('site/assets/images/signature.png');
    $signatureName = $content['signature_name'] ?? 'Walimes Jonnie';
    $signatureTitle = $content['signature_title'] ?? 'Director of Constro Company';
@endphp

<section class="gap no-top about-style-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-data-left">
                    <figure><img src="{{ $imageOne }}" alt="About One"></figure>
                    <figure class="about-image"><img src="{{ $imageTwo }}" alt="About Two"></figure>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-data-right">
                    <span>{{ $smallTitle }}</span>
                    <h2>{{ $mainTitle }}</h2>
                    <div class="about-info">
                        <p>{!! $mainContent !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
