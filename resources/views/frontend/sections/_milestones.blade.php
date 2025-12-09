@php
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), '');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), '');
    $layoutStyle = data_get($content, 'layout_style', 'vertical');
    $milestones = data_get($content, 'milestones', []);
@endphp

<section class="izokoc-milestones-section izokoc-milestones--{{ $layoutStyle }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @if($subTitle)
                    <h6 class="izokoc-section__subtitle">{{ $subTitle }}</h6>
                @endif
                @if($mainTitle)
                    <h2 class="izokoc-section__title">{{ $mainTitle }}</h2>
                @endif
            </div>
        </div>

        @if(!empty($milestones))
            <div class="row">
                <div class="col-lg-12">
                    <div class="izokoc-timeline">
                        @foreach($milestones as $index => $milestone)
                            @php
                                $year = data_get($milestone, 'year', '');
                                $milestoneIcon = data_get($milestone, 'milestone_icon', 'icofont-trophy');
                                $milestoneImage = data_get($milestone, 'milestone_image');
                                $milestoneTitle = data_get($milestone, 'milestone_title.' . app()->getLocale(), '');
                                $milestoneDescription = data_get($milestone, 'milestone_description.' . app()->getLocale(), '');
                                $highlight = data_get($milestone, 'highlight', false);
                            @endphp

                            <div class="izokoc-timeline-item {{ $highlight ? 'highlight' : '' }} {{ $index % 2 == 0 ? 'left' : 'right' }}"
                                 data-aos="fade-{{ $index % 2 == 0 ? 'right' : 'left' }}"
                                 data-aos-delay="{{ $index * 100 }}">

                                <div class="izokoc-timeline-item__marker">
                                    <div class="izokoc-timeline-item__year">{{ $year }}</div>
                                    <div class="izokoc-timeline-item__dot">
                                        <i class="{{ $milestoneIcon }}"></i>
                                    </div>
                                </div>

                                <div class="izokoc-timeline-item__content">
                                    @if($milestoneImage)
                                        <div class="izokoc-timeline-item__image">
                                            <img src="{{ asset($milestoneImage) }}" alt="{{ $milestoneTitle }}">
                                        </div>
                                    @endif
                                    <div class="izokoc-timeline-item__text">
                                        <h4 class="izokoc-timeline-item__title">{{ $milestoneTitle }}</h4>
                                        <p class="izokoc-timeline-item__description">{{ $milestoneDescription }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .izokoc-milestones-section {
            padding: 100px 0;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .izokoc-milestones-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #ffc107, transparent);
            opacity: 0.3;
        }

        .izokoc-timeline {
            position: relative;
            padding: 60px 0;
        }

        /* Vertical Layout (Default) */
        .izokoc-milestones--vertical .izokoc-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #ffc107, #ffab00);
            z-index: 1;
        }

        .izokoc-timeline-item {
            position: relative;
            margin-bottom: 80px;
            display: flex;
            align-items: center;
        }

        .izokoc-timeline-item.left {
            justify-content: flex-end;
            padding-right: calc(50% + 60px);
        }

        .izokoc-timeline-item.right {
            justify-content: flex-start;
            padding-left: calc(50% + 60px);
        }

        .izokoc-timeline-item__marker {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .izokoc-timeline-item__year {
            background: linear-gradient(135deg, #ffc107, #ffab00);
            color: #1a1a1a;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }

        .izokoc-timeline-item__dot {
            width: 60px;
            height: 60px;
            background: #fff;
            border: 4px solid #ffc107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #ffc107;
            box-shadow: 0 5px 20px rgba(255, 193, 7, 0.3);
            transition: all 0.3s ease;
        }

        .izokoc-timeline-item.highlight .izokoc-timeline-item__dot {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ffc107, #ffab00);
            color: #1a1a1a;
            border-color: #ffab00;
            font-size: 32px;
        }

        .izokoc-timeline-item:hover .izokoc-timeline-item__dot {
            transform: rotate(360deg) scale(1.1);
        }

        .izokoc-timeline-item__content {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .izokoc-timeline-item:hover .izokoc-timeline-item__content {
            background: #fff;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transform: scale(1.03);
        }

        .izokoc-timeline-item.highlight .izokoc-timeline-item__content {
            background: linear-gradient(135deg, #fff9e6, #fff);
            border: 2px solid #ffc107;
        }

        .izokoc-timeline-item__image {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .izokoc-timeline-item__image img {
            width: 100%;
            display: block;
        }

        .izokoc-timeline-item__title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .izokoc-timeline-item__description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        /* Horizontal Layout */
        .izokoc-milestones--horizontal .izokoc-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .izokoc-milestones--horizontal .izokoc-timeline::before {
            display: none;
        }

        .izokoc-milestones--horizontal .izokoc-timeline-item {
            padding: 0;
            margin-bottom: 40px;
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 30px;
            align-items: start;
        }

        .izokoc-milestones--horizontal .izokoc-timeline-item.left,
        .izokoc-milestones--horizontal .izokoc-timeline-item.right {
            padding: 0;
            justify-content: flex-start;
        }

        .izokoc-milestones--horizontal .izokoc-timeline-item__marker {
            position: static;
            transform: none;
            flex-direction: column;
        }

        .izokoc-milestones--horizontal .izokoc-timeline-item__content {
            max-width: 100%;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .izokoc-milestones-section::before {
                left: 30px;
                transform: none;
            }

            .izokoc-timeline::before {
                left: 30px !important;
                transform: none !important;
            }

            .izokoc-timeline-item {
                padding: 0 !important;
                padding-left: 100px !important;
                justify-content: flex-start !important;
            }

            .izokoc-timeline-item__marker {
                left: 30px !important;
                transform: none !important;
            }

            .izokoc-timeline-item__content {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .izokoc-milestones-section {
                padding: 60px 0;
            }

            .izokoc-timeline-item {
                padding-left: 80px !important;
            }

            .izokoc-timeline-item__marker {
                left: 20px !important;
            }

            .izokoc-timeline-item__year {
                font-size: 14px;
                padding: 8px 15px;
            }

            .izokoc-timeline-item__dot {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .izokoc-timeline-item.highlight .izokoc-timeline-item__dot {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .izokoc-timeline-item__content {
                padding: 20px;
            }

            .izokoc-timeline-item__title {
                font-size: 18px;
            }

            .izokoc-milestones--horizontal .izokoc-timeline-item {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
@endpush