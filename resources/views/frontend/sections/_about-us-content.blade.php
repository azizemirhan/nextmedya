@php
    $title = data_get($content, 'title.' . app()->getLocale(), 'Misyon & Vizyon');
    $contentText = data_get($content, 'content.' . app()->getLocale(), '');
    $image = data_get($content, 'image') ? asset($content['image']) : null;

    $features = data_get($content, 'features', []);
    if (is_string($features)) {
        $features = json_decode($features, true) ?? [];
    }
@endphp

<section id="mission-vision" class="content-section about-content">
    <div class="container">
        <div class="row align-items-center">
            @if($image)
                <div class="col-lg-6">
                    <div class="content-image-wrapper">
                        <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid rounded">
                    </div>
                </div>
            @endif

            <div class="col-lg-{{ $image ? '6' : '12' }}">
                <div class="content-text">
                    <h2 class="section-title">{{ $title }}</h2>
                    <div class="section-content">
                        {!! $contentText !!}
                    </div>

                    @if(!empty($features))
                        <div class="features-list mt-4">
                            @foreach($features as $feature)
                                <div class="feature-item">
                                    <h4>{{ data_get($feature, 'feature_title.' . app()->getLocale()) }}</h4>
                                    <p>{!! data_get($feature, 'feature_description.' . app()->getLocale())  !!} </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .content-section {
            padding: 80px 0;
            scroll-margin-top: 100px;
        }

        .content-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .content-image-wrapper img {
            transition: transform 0.6s ease;
        }

        .content-image-wrapper:hover img {
            transform: scale(1.05);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
        }

        .section-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
        }

        .feature-item {
            padding: 20px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 10px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            transform: translateX(10px);

        }


        .feature-item h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #fff;
        }

        .feature-item p {
            margin: 0;
            color: #fff;
            line-height: 1.6;
        }

        .feature-item p:hover {
            color: #fff;
        }

        .feature-item:hover h4,
        .feature-item:hover p {
            color: #fff;
        }
    </style>
@endpush
