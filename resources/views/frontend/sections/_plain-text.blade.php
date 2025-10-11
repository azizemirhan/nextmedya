@php
    $title = data_get($content, 'title.' . app()->getLocale());
    $textContent = data_get($content, 'content.' . app()->getLocale());
@endphp

<section class="gap plain-text-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($title)
                    <div class="heading-style-2">
                        <h2>{{ $title }}</h2>
                    </div>
                @endif

                @if($textContent)
                    <div class="text-content">
                        {!! nl2br(e($textContent)) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
