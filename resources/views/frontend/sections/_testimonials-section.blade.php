@php
    // Admin panelinden gelen veriler
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'Testimonials');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Happy Clients Says About Us');
    $leadText = data_get($content, 'lead_text.' . app()->getLocale(), 'Make your dream with us');
    $description = data_get($content, 'description.' . app()->getLocale(), '');
    
    // Repeater'dan gelen yorumlar
    $testimonials = data_get($content, 'testimonials', []);
@endphp

<section class="commonSection testimonialSection">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 noPaddingRight">
                <h6 class="sub_title">{{ $subTitle }}</h6>
                <h2 class="sec_title">
                    <span>{!! $mainTitle !!}</span>
                </h2>
                @if($leadText)
                    <p class="ind_lead">{{ $leadText }}</p>
                @endif
                @if($description)
                    <p>{!! $description !!}</p>
                @endif
            </div>
            <div class="col-xl-8 col-lg-8 pdl40">
                <div class="testimonialSliderHolder tw-stretch-element-inside-column">
                    <div class="testimonialSlider">
                        @forelse($testimonials as $testimonial)
                            @php
                                $rating = data_get($testimonial, 'rating', 5);
                                $title = data_get($testimonial, 'title.' . app()->getLocale(), '');
                                $content = data_get($testimonial, 'content.' . app()->getLocale(), '');
                                $authorImage = data_get($testimonial, 'author_image') 
                                    ? asset(data_get($testimonial, 'author_image'))
                                    : asset('frontend/assets/images/testimonial/default.png');
                                $authorName = data_get($testimonial, 'author_name.' . app()->getLocale(), '');
                                $authorPosition = data_get($testimonial, 'author_position.' . app()->getLocale(), '');
                            @endphp

                            <div class="ts_item">
                                <div class="testimonial_item">
                                    <span class="ratings">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    @if($title)
                                        <h3>" {{ $title }} "</h3>
                                    @endif
                                    @if($content)
                                        <p>{!! $content !!}</p>
                                    @endif
                                    <div class="ti_author clearfix">
                                        <img src="{{ $authorImage }}" alt="{{ $authorName }}">
                                        @if($authorName)
                                            <h4>{{ $authorName }}</h4>
                                        @endif
                                        @if($authorPosition)
                                            <span>{{ $authorPosition }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="ts_item">
                                <div class="testimonial_item">
                                    <p class="text-muted">{{ __('No testimonials available.') }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>