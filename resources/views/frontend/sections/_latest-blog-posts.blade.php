@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Son Yazılar');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Blog');
    $showAuthor = data_get($content, 'show_author', true);
    $showDate = data_get($content, 'show_date', true);
    $showExcerpt = data_get($content, 'show_excerpt', true);

    // Handler'dan gelen data
    $blogPosts = $data ?? collect();
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
            <small class="text-primary text-uppercase fw-bold">{{ $sectionSubtitle }}</small>
            <h2 class="display-5 fw-bold mt-2">{{ $sectionTitle }}</h2>
        </div>

        <!-- Debug Info (Sadece Geliştirme Ortamında) -->
        @if(config('app.debug'))
            <div class="alert alert-info">
                <strong>Debug Info:</strong><br>
                Data Type: {{ is_object($data ?? null) ? get_class($data) : gettype($data ?? null) }}<br>
                Posts Count: {{ $blogPosts->count() }}<br>
                Handler Status: {{ isset($data) ? '✓ Working' : '✗ Not Working' }}<br>
                @if($blogPosts->isEmpty())
                    <span class="text-danger">⚠ No posts found!</span>
                @endif
            </div>
        @endif

        <!-- Posts Grid -->
        @if($blogPosts->isNotEmpty())
            <div class="row g-4">
                @foreach($blogPosts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 hover-card">
                            <!-- Image -->
                            @if($post->featured_image)
                                <div class="card-img-wrapper">
                                    <img src="{{ asset($post->featured_image) }}"
                                         class="card-img-top"
                                         alt="{{ $post->title }}">
                                </div>
                            @else
                                <div class="card-img-placeholder bg-secondary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-image fa-3x text-white opacity-50"></i>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <!-- Category -->
                                @if($post->category)
                                    <span class="badge bg-primary mb-2 align-self-start">
                                        {{ $post->category->name }}
                                    </span>
                                @endif

                                <!-- Title -->
                                <h5 class="card-title mb-3">
                                    <a href="{{ route('blog.show', $post->slug) }}"
                                       class="text-dark text-decoration-none stretched-link">
                                        {{ $post->title }}
                                    </a>
                                </h5>

                                <!-- Meta -->
                                <div class="text-muted small mb-3">
                                    @if($showAuthor && $post->author)
                                        <i class="fas fa-user me-1"></i>
                                        <span>{{ $post->author->name }}</span>
                                    @endif

                                    @if($showDate && $post->published_at)
                                        @if($showAuthor && $post->author)
                                            <span class="mx-2">•</span>
                                        @endif
                                        <i class="fas fa-calendar me-1"></i>
                                        <span>{{ $post->published_at->format('d.m.Y') }}</span>
                                    @endif
                                </div>

                                <!-- Excerpt -->
                                @if($showExcerpt && $post->excerpt)
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit(strip_tags($post->excerpt), 120) }}
                                    </p>
                                @endif

                                <!-- Read More Link -->
                                <div class="mt-auto pt-3">
                                    <span class="text-primary fw-bold">
                                        Devamını Oku
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-5">
                <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg px-5">
                    Tüm Yazıları Görüntüle
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-inbox fa-4x text-muted"></i>
                </div>
                <h4 class="mb-3">Henüz blog yazısı bulunmuyor</h4>
                <p class="text-muted mb-4">Yakında yeni içerikler paylaşacağız!</p>

                @if(config('app.debug'))
                    <div class="alert alert-warning d-inline-block">
                        <strong>Developer Info:</strong><br>
                        • Handler çalıştı mı: {{ isset($data) ? 'Evet' : 'Hayır' }}<br>
                        • Total posts in DB: {{ \App\Models\Post::count() }}<br>
                        • Published posts: {{ \App\Models\Post::where('status', 'published')->count() }}<br>
                        • Published & Past Date: {{ \App\Models\Post::where('status', 'published')->where('published_at', '<=', now())->count() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }

        .card-img-wrapper {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .hover-card:hover .card-img-wrapper img {
            transform: scale(1.1);
        }

        .card-img-placeholder {
            height: 220px;
        }

        .card-title a {
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: #0d6efd !important;
        }

        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            content: "";
        }
    </style>
@endpush