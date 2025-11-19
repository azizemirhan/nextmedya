@php
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Ready to work together?');
    $mainContent = data_get($content, 'content.' . app()->getLocale(), 'You’re looking for a reliable construction partner...');
    $buttonText = data_get($content, 'button_text.' . app()->getLocale(), 'Build a Project');
    $buttonUrl = data_get($content, 'button_url', '#');
    $image = data_get($content, 'image') ? asset($content['image']) : 'https://placehold.co/860x600';
@endphp

<section class="cta-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="cta-data">
                    <h2>{{ $mainTitle }}</h2>
                    <p>{{ $mainContent }}</p>
                    <a href="{{ $buttonUrl }}" class="theme-btn">{{ $buttonText }} <i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="cta-data">
                    <figure>
                        <img src="{{ $image }}" alt="{{ $mainTitle }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
