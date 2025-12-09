@php
    // Laravel'in data_get() yardımcısı, iç içe dizilerde güvenli bir şekilde veri almanızı sağlar.
    // 'small_title.tr' anahtarı yoksa, varsayılan değeri kullanır ve hata vermez.
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Company Projects');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Projects Completed');

    // DataHandler'dan gelen Project koleksiyonu
    $projects = $dynamicData ?? collect();
@endphp

<section class="gap project-style-one light-bg-color">
    <div class="heading">
        <figure>
            <img src="{{ asset('site/assets/images/heading-icon.png') }}" alt="Heading Icon">
        </figure>
        <span>{{ $smallTitle }}</span>
        <h2>{{ $mainTitle }}</h2>
    </div>
    <div class="container">
        @if($projects->isNotEmpty())
            <div class="row project-slider owl-carousel">

                @foreach($projects as $project)
                    <div class="col-lg-12">
                        <div class="project-post">
                            <figure>
                                <img src="{{ asset($project->image_path) }}" alt="{{ $project->getTranslation('title', app()->getLocale()) }}">
                            </figure>
                            <div class="project-data">
                                <h3><a href="#">{{ $project->getTranslation('title', app()->getLocale()) }}</a></h3>
                                <p>{{ Str::limit($project->getTranslation('description', app()->getLocale()), 100) }}</p>
                                <a class="project-icon" href="#">
                                    <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <p class="text-center">Gösterilecek proje bulunamadı.</p>
        @endif
    </div>
</section>
