@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Rakamlarla Biz');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Başarı Hikayemiz');
    $backgroundStyle = data_get($content, 'background_style', 'gradient'); // gradient, dark, light
    
    $counters = data_get($content, 'counters', []);
    if (empty($counters)) {
        $counters = [
            [
                'icon' => 'fas fa-users',
                'number' => '500',
                'suffix' => '+',
                'label' => ['tr' => 'Mutlu Müşteri', 'en' => 'Happy Clients'],
                'color' => 'blue'
            ],
            [
                'icon' => 'fas fa-project-diagram',
                'number' => '1200',
                'suffix' => '+',
                'label' => ['tr' => 'Tamamlanan Proje', 'en' => 'Completed Projects'],
                'color' => 'green'
            ],
            [
                'icon' => 'fas fa-award',
                'number' => '50',
                'suffix' => '+',
                'label' => ['tr' => 'Kazanılan Ödül', 'en' => 'Awards Won'],
                'color' => 'yellow'
            ],
            [
                'icon' => 'fas fa-user-tie',
                'number' => '100',
                'suffix' => '+',
                'label' => ['tr' => 'Uzman Ekip', 'en' => 'Expert Team'],
                'color' => 'red'
            ],
        ];
    }
@endphp

<section class="statc-section statc-section--{{ $backgroundStyle }}">
    <div class="statc-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="statc-header">
                    <span class="statc-header__subtitle">{{ $sectionSubtitle }}</span>
                    <h2 class="statc-header__title">{{ $sectionTitle }}</h2>
                </div>
            </div>
        </div>

        <div class="row statc-row">
            @foreach($counters as $index => $counter)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="statc-card statc-card--{{ data_get($counter, 'color', 'blue') }}" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                        <div class="statc-card__icon-wrapper">
                            <i class="{{ data_get($counter, 'icon', 'fas fa-star') }} statc-card__icon"></i>
                        </div>
                        <div class="statc-card__content">
                            <div class="statc-card__number-wrapper">
                                <span class="statc-card__number" data-count="{{ data_get($counter, 'number', '0') }}">0</span>
                                <span class="statc-card__suffix">{{ data_get($counter, 'suffix', '') }}</span>
                            </div>
                            <p class="statc-card__label">{{ data_get($counter, 'label.' . app()->getLocale(), 'Label') }}</p>
                        </div>
                        <div class="statc-card__bg-icon">
                            <i class="{{ data_get($counter, 'icon', 'fas fa-star') }}"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
    <style>
        .statc-section {
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .statc-section--gradient {
            background: var(--gradient-primary);
        }

        .statc-section--dark {
            background: var(--primary-dark);
        }

        .statc-section--light {
            background: #f8f9fa;
        }

        .statc-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                    radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .statc-section .container {
            position: relative;
            z-index: 1;
        }

        .statc-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .statc-header__subtitle {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .statc-section--light .statc-header__subtitle {
            background: var(--gradient-primary);
            color: #ffffff;
            border: none;
        }

        .statc-header__title {
            font-size: 46px;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            line-height: 1.2;
        }

        .statc-section--light .statc-header__title {
            color: var(--primary-dark);
        }

        .statc-row {
            position: relative;
        }

        .statc-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .statc-section--light .statc-card {
            background: #ffffff;
            border-color: var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .statc-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .statc-card:hover::before {
            transform: translateX(100%);
        }

        .statc-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .statc-section--light .statc-card:hover {
            background: #ffffff;
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-sky);
        }

        .statc-card__icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.4s ease;
        }

        .statc-card--blue .statc-card__icon-wrapper {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.3));
        }

        .statc-card--green .statc-card__icon-wrapper {
            background: linear-gradient(135deg, rgba(6, 255, 165, 0.2), rgba(4, 211, 136, 0.3));
        }

        .statc-card--yellow .statc-card__icon-wrapper {
            background: linear-gradient(135deg, rgba(255, 190, 11, 0.2), rgba(255, 171, 0, 0.3));
        }

        .statc-card--red .statc-card__icon-wrapper {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(220, 38, 38, 0.3));
        }

        .statc-card:hover .statc-card__icon-wrapper {
            transform: rotateY(360deg) scale(1.1);
        }

        .statc-card__icon {
            font-size: 38px;
            color: #ffffff;
        }

        .statc-card--blue .statc-card__icon {
            color: #3b82f6;
        }

        .statc-card--green .statc-card__icon {
            color: #06ffa5;
        }

        .statc-card--yellow .statc-card__icon {
            color: #ffbe0b;
        }

        .statc-card--red .statc-card__icon {
            color: #ef4444;
        }

        .statc-section--light .statc-card__icon {
            opacity: 1;
        }

        .statc-card__content {
            position: relative;
            z-index: 2;
        }

        .statc-card__number-wrapper {
            display: flex;
            align-items: baseline;
            justify-content: center;
            margin-bottom: 10px;
        }

        .statc-card__number {
            font-size: 52px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
        }

        .statc-section--light .statc-card__number {
            color: var(--primary-dark);
        }

        .statc-card__suffix {
            font-size: 38px;
            font-weight: 800;
            color: #ffffff;
            margin-left: 5px;
        }

        .statc-section--light .statc-card__suffix {
            color: var(--primary-blue);
        }

        .statc-card__label {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .statc-section--light .statc-card__label {
            color: var(--text-secondary);
        }

        .statc-card__bg-icon {
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(255, 255, 255, 0.03);
            z-index: 0;
            transition: all 0.4s ease;
        }

        .statc-section--light .statc-card__bg-icon {
            color: rgba(14, 19, 39, 0.03);
        }

        .statc-card:hover .statc-card__bg-icon {
            transform: rotate(15deg) scale(1.1);
        }

        @media (max-width: 992px) {
            .statc-section {
                padding: 80px 0;
            }

            .statc-header__title {
                font-size: 36px;
            }

            .statc-card__number {
                font-size: 42px;
            }

            .statc-card__suffix {
                font-size: 32px;
            }
        }

        @media (max-width: 768px) {
            .statc-section {
                padding: 60px 0;
            }

            .statc-header__title {
                font-size: 28px;
            }

            .statc-card {
                padding: 30px 20px;
            }

            .statc-card__icon-wrapper {
                width: 70px;
                height: 70px;
            }

            .statc-card__icon {
                font-size: 32px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.statc-card__number');

            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            };

            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        animateCounter(counter);
                        observer.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
@endpush