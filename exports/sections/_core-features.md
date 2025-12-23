@php
    // Ana başlık ve alt başlık bilgilerini al
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'Core Features');
    $titleIcon = data_get($content, 'title_icon', 'fal fa-user-hard-hat');
    $titleText = data_get($content, 'title_text.' . app()->getLocale(), 'Doom Features');

    // Tekrarlayan özellikler verisini al
    $features = data_get($content, 'features', []);

    // Eğer features string ise (JSON), decode et
    if (is_string($features)) {
        $features = json_decode($features, true) ?? [];
    }
@endphp

<section class="commonSection graySection">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h6 class="sub_title gray_sub_title">{{ $subTitle }}</h6>
                <h2 class="sec_title with_bar">
                    <span>
                        @if($titleIcon)<i class="{{ $titleIcon }}"></i>@endif
                        <span>{{ $titleText }}</span>
                    </span>
                </h2>
            </div>
        </div>

        @if(!empty($features))
            <div class="row">
                @foreach($features as $index => $feature)
                    @php
                        $featureIcon = data_get($feature, 'icon', 'icofont-calculations');
                        $featureTitle = data_get($feature, 'feature_title.' . app()->getLocale(), '');
                        $featureDescription = data_get($feature, 'description.' . app()->getLocale(), '');
                    @endphp

                    <div class="col-lg-3 col-md-6">
                        <div class="icon_box_01 text-center">
                            <i class="bigger {{ $featureIcon }}"></i>
                            <i class="smaller {{ $featureIcon }}"></i>
                            <span></span>
                            <h3>{!! nl2br(e($featureTitle)) !!}</h3>
                            <p>{!! $featureDescription !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>