@php
    // DÜZELTME: Admin panelinden girilen statik başlıkları data_get() ile güvenli bir şekilde alıyoruz.
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Core Features');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'What Makes Us Different');

    // Bu alanlar tekil olduğu için doğrudan erişim doğrudur.
    $videoUrl = $content['video_url'] ?? '#';
    $videoImage = isset($content['video_image']) ? asset($content['video_image']) : 'https://placehold.co/965x825';

    // DataHandler'dan gelen Feature koleksiyonu
    $features = $dynamicData ?? collect();
@endphp

<section class="core-features">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="space">
                    <div class="heading-style-2">
                        <div class="data">
                            <span>{{ $smallTitle }}</span>
                            <h2>{{ $mainTitle }}</h2>
                        </div>
                    </div>
                    @if($features->isNotEmpty())
                        <div class="accordion" id="accordion-{{ $section->id }}">
                            @foreach($features as $feature)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $feature->id }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $feature->id }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                            <span
                                                class="num">0{{ $loop->iteration }}.</span> {{ $feature->getTranslation('title', app()->getLocale()) }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $feature->id }}"
                                         class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                         aria-labelledby="heading-{{ $feature->id }}"
                                         data-bs-parent="#accordion-{{ $section->id }}">
                                        <div class="accordion-body">
                                            <p>{{ $feature->getTranslation('description', app()->getLocale()) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shape">
                    <div class="video">
                        <figure>
                            <img src="{{ $videoImage }}" alt="Core Feature Img">
                        </figure>
                        <a class="video-play-btn" data-fancybox="" href="{{ $videoUrl }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="56" viewBox="0 0 35 56">
                                <g>
                                    <path d="M1362,5000.8,1327,4972V5027Z" transform="translate(-1326.998 -4971.996)"
                                          fill="rgba(0,0,0,0)"/>
                                    <path d="M1333,5015.017l19.29-14.437L1333,4984.7v30.313M1327,5027V4972l35,28.807Z"
                                          transform="translate(-1326.998 -4971.996)"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
