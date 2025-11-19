@php
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Frequently asked question');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Finding Solutions For Your Dream House');
    $faqs = $dynamicData ?? collect();
@endphp

<section class="contact-faqs">
    <div class="heading">
        <span>{{ $smallTitle }}</span>
        <h2>{{ $mainTitle }}</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="acc2">
                    <div class="accordion" id="accordion-{{ $section->id }}">
                        @foreach($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $faq->getTranslation('question', app()->getLocale()) }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse @if($loop->first) show @endif" data-bs-parent="#accordion-{{ $section->id }}">
                                    <div class="accordion-body">{{ $faq->getTranslation('answer', app()->getLocale()) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
