@php
    $title = data_get($content, 'title.' . app()->getLocale(), 'Hizmetlerimiz');
    $description = data_get($content, 'description.' . app()->getLocale(), '');

    // DataHandler'dan gelen hizmetler
    $services = $data ?? [];
@endphp

<section id="services" class="content-section services-content">
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
            @forelse($services as $service)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item">
                        @if($service->icon)
                            <div class="service-icon">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        @endif

                        <div class="service-content">
                            <h3 class="service-title">{{ $service->title }}</h3>
                            @if($service->short_description)
                                <p class="service-description">{{ Str::limit($service->short_description, 120) }}</p>
                            @endif
                            <a href="{{ route('frontend.services.show', $service->slug) }}" class="service-btn">
                                Detaylı Bilgi <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Henüz hizmet eklenmemiş.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@push('styles')
    <style>
        .services-content {
            background: #f8f8f8;
        }

        .service-item {
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            height: 100%;
            transition: all 0.4s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .service-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 193, 7, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .service-item:hover::before {
            left: 100%;
        }

        .service-item:hover {
            transform: translateY(-10px);
            border-color: #ffc107;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ffc107, #ffab00);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            transition: all 0.4s ease;
        }

        .service-item:hover .service-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .service-icon i {
            font-size: 2.5rem;
            color: #fff;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .service-description {
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .service-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1a1a1a;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .service-btn:hover {
            color: #ffc107;
            border-bottom-color: #ffc107;
            gap: 15px;
        }
    </style>
@endpush
