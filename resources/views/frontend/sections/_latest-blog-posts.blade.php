@php
    // DÜZELTME 1: Admin panelinden girilen statik başlıkları data_get() ile güvenli bir şekilde alıyoruz.
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Let us Help Guide');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Recent Articles');

    // DÜZELTME 2: Blog yazılarını doğrudan view'dan çekmek yerine, DataHandler'dan gelen veriyi kullanıyoruz.
    $latestPosts = $dynamicData ?? collect();
@endphp

<section class="gap no-top blog-style-one">
    <div class="heading mt-4">
        <span>{{ $smallTitle }}</span>
        <h2>{{ $mainTitle }}</h2>
    </div>
    <div class="container">
        <div class="row">
            @forelse($latestPosts as $post)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-post">
                        <div class="blog-image">
                            <figure>
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                            </figure>
                            <a href="#">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                        <div class="blog-data">
                            <span
                                class="blog-date">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F j, Y') : '' }}</span>
                            <h2>
                                <a href="#">{{ $post->title }}</a>
                            </h2>
                            {{-- Author/Yazar ilişkisi varsa bu bölüm kullanılabilir --}}
                            {{-- @if($post->author)
                            <div class="blog-author d-flex-all justify-content-start">
                                <div class="author-img">
                                    <figure><img src="{{ asset($post->author->avatar) }}" alt="Author"></figure>
                                </div>
                                <div class="details">
                                    <h3> <span>by</span> {{ $post->author->name }}</h3>
                                </div>
                            </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Henüz blog yazısı eklenmemiş.</p>
            @endforelse
        </div>
        @if($latestPosts->isNotEmpty())
            <div class="common-btn">
                <a href="#" class="dark-footer-v2__cta-button">{{ __('See All Our Articles') }} <i class="fa-solid fa-angles-right"></i></a>
            </div>
        @endif
    </div>
</section>
