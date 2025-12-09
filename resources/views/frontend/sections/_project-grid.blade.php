@php
    // Data handler'dan gelen Paginator nesnesi
    $projects = $dynamicData ?? collect();
@endphp

<section class="gap project-style-one addition">
    <div class="container">
        <div class="row">
            {{-- Proje döngüsü --}}
            @forelse($projects as $project)
                <div class="col-lg-6">
                    <div class="project-post">
                        <figure>
                            <img class="w-100" src="{{ asset($project->image_path) }}" alt="{{ $project->getTranslation('title', app()->getLocale()) }}">
                        </figure>
                        <div class="project-data">
                            {{-- Proje detay sayfası için rotanız olduğunu varsayıyoruz --}}
                            <h3><a href="{{ route('frontend.project.show', $project->slug) }}">{{ $project->getTranslation('title', app()->getLocale()) }}</a></h3>

                            {{-- Açıklamadan bir özet oluşturuyoruz --}}
                            <p>{{ \Illuminate\Support\Str::limit($project->getTranslation('description', app()->getLocale()), 100) }}</p>

                            <a class="project-icon" href="{{ route('frontend.project.show', $project->slug) }}">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Gösterilecek proje bulunamadı.</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{-- Laravel'in otomatik sayfalama linklerini oluşturduğu kısım --}}
            <div class="builty-pagination">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
