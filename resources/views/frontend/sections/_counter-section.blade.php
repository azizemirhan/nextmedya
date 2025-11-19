@php
    $statistics = collect(data_get($content, 'team_members', []));
@endphp
@if($statistics->isNotEmpty())
    <section class="gap no-top counter-style-one">
        <div class="container">
            <div class="row">
                @foreach($statistics as $stat)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="counter-data">
                            <div class="count">
                                <span class="counter">{{ $stat->sayac }}</span>
                                {{-- Yıl, Kişi gibi metinler için ayrı bir alan eklenebilir --}}
                            </div>
                            <h4>{{ $stat->getTranslation('title', app()->getLocale()) }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
