@php
    $title = data_get($content, 'title.' . app()->getLocale(), 'Değerlerimiz');
    $description = data_get($content, 'description.' . app()->getLocale(), '');

    $valuesList = data_get($content, 'values_list', []);
    if (is_string($valuesList)) {
        $valuesList = json_decode($valuesList, true) ?? [];
    }
@endphp

<section id="values" class="content-section values-content">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">{{ $title }}</h2>
                @if($description)
                    <p class="section-description">{!! $description  !!}</p>
                @endif
            </div>
        </div>

        <div class="row">
            @forelse($valuesList as $value)
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="value-card">
                        @if(data_get($value, 'value_icon'))
                            <div class="value-icon">
                                <i class="{{ data_get($value, 'value_icon') }}"></i>
                            </div>
                        @endif

                        <h4 class="value-title">{{ data_get($value, 'value_title.' . app()->getLocale()) }}</h4>
                        <p class="value-description">{!! data_get($value, 'value_description.' . app()->getLocale()) !!}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Henüz değer eklenmemiş.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@push('styles')
    <style>
        .values-content {
            background: linear-gradient(135deg, #f8f8f8 0%, #fff 100%);
        }

        .value-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            height: 100%;
            transition: all 0.4s ease;
            border: 2px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            transition: height 0.4s ease;
            z-index: 0;
        }

        .value-card:hover::before {
            height: 5px;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: #16213e;
        }

        .value-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .value-card:hover .value-icon {
            transform: rotateY(180deg);
        }

        .value-icon i {
            font-size: 2.5rem;
            color: #fff;
        }

        .value-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .value-description {
            color: #666;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }
    </style>
@endpush
