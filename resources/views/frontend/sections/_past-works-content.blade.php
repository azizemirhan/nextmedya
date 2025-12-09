@php
    $title = data_get($content, 'title.' . app()->getLocale(), 'Geçmiş İşlerimiz');
    $description = data_get($content, 'description.' . app()->getLocale(), '');

    // DataHandler'dan gelen projeler
    $projects = $data ?? [];
@endphp

<section id="past-works" class="content-section past-works-content">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">{{ $title }}</h2>
                @if($description)
                    <p class="section-description">{{ $description }}</p>
                @endif
            </div>
        </div>

        <div class="row">
            @forelse($projects as $project)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        @if($project->featured_image)
                            <div class="project-image">
                                <img src="{{ asset($project->featured_image) }}" alt="{{ $project->title }}">
                                <div class="project-overlay">
                                    <a href="{{ route('frontend.project.show', $project->slug) }}" class="project-link">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="project-info">
                            @if($project->category)
                                <span class="project-category">{{ $project->category->name }}</span>
                            @endif
                            <h3 class="project-title">{{ $project->title }}</h3>
                            @if($project->excerpt)
                                <p class="project-excerpt">{{ Str::limit($project->excerpt, 100) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Henüz proje eklenmemiş.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@push('styles')
    <style>
        .past-works-content {
            background: #f8f8f8;
        }

        .section-description {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
        }

        .project-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .project-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .project-card:hover .project-image img {
            transform: scale(1.1);
        }

        .project-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 193, 7, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .project-card:hover .project-overlay {
            opacity: 1;
        }

        .project-link {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a1a;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .project-link:hover {
            transform: scale(1.1) rotate(45deg);
            color: #ffc107;
        }

        .project-info {
            padding: 25px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .project-category {
            display: inline-block;
            background: #ffc107;
            color: #1a1a1a;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .project-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .project-excerpt {
            color: #666;
            line-height: 1.6;
            margin: 0;
            flex: 1;
        }
    </style>
@endpush
