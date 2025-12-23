@php
    // Admin panelinden gelen veriler
    $mainImage = data_get($content, 'main_image')
        ? asset(data_get($content, 'main_image'))
        : asset('frontend/assets/images/placeholder.jpg');

    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'why choose us');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'We Offer A Great Variety Of Products & Services.');
    $contentText = data_get($content, 'content.' . app()->getLocale(), '');
    $buttonText = data_get($content, 'button_text.' . app()->getLocale(), 'get a quote');
    $buttonUrl = data_get($content, 'button_url', '#');
@endphp

<section class="whyChooseUs">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-6 noPadding">
                <div class="video_02 withBGImg" style="background-image: url('{{ $mainImage }}');">
                    <img src="{{ $mainImage }}" alt="{{ $mainTitle }}" style="display: none;">
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 noPaddingRight">
                <div class="whyChooseUsContent">
                    <h6 class="sub_title">{{ $subTitle }}</h6>
                    <h2 class="sec_title dark_sec_title">
                        <span>{!! $mainTitle !!}</span>
                    </h2>
                    @if($contentText)
                        <p>{!! $contentText !!}</p>
                    @endif
                    <a href="{{ $buttonUrl }}" class="ind_btn">
                        <span>{{ $buttonText }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>