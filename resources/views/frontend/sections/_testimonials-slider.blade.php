@php
    // DÜZELTME: Admin panelinden girilen çok dilli başlıkları data_get() ile güvenli bir şekilde alıyoruz.
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Testimonials');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Client’s Reviews');

    // Bu alan tekil olduğu için doğrudan erişim doğrudur.
    $image = isset($content['image']) ? asset($content['image']) : 'https://placehold.co/620x630';

    // DataHandler'dan gelen Testimonial koleksiyonu
    $testimonials = $dynamicData ?? collect();
@endphp

@if($testimonials->isNotEmpty())
    <section class="gap client-review-style-one">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="head-review">
                        <span>{{ $smallTitle }}</span>
                        <h3>{{ $mainTitle }}</h3>
                    </div>
                    <div class="client-review-slider owl-carousel">
                        @foreach($testimonials as $testimonial)
                            <div class="slider-data">
                                <p>{{ $testimonial->getTranslation('content', app()->getLocale()) }}</p>
                                <div class="bio d-flex-all justify-content-start w-100">
                                    <div class="icon d-flex-all">
                                        {{-- SVG İkon Kodu --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"><g><path d="M.032,24.036V14.478l-.032,0V8.991C.4.4,9.086,0,9.086,0V5.961c-3.535,0-3.555,3.03-3.555,3.03v4.045h5.5v11ZM0,8.991Z" transform="translate(14 0.964)"/><path d="M.032,24.036V14.478l-.032,0V8.991C.4.4,9.086,0,9.086,0V5.961c-3.535,0-3.555,3.03-3.555,3.03v4.045h5.5v11ZM0,8.991Z" transform="translate(0.969 0.964)"/></g></svg>
                                    </div>
                                    <div class="details w-100">
                                        <h3>{{ $testimonial->getTranslation('name', app()->getLocale()) }}</h3>
                                        {{-- Testimonial Seeder'da 'company' olarak kaydetmiştik, 'client_title' değil --}}
                                        <p>{{ $testimonial->getTranslation('company', app()->getLocale()) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <figure>
                        <img src="{{ $image }}" alt="Client Images">
                    </figure>
                </div>
            </div>
        </div>
    </section>
@endif
