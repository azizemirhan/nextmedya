@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Sıkça Sorulan Sorular');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Merak Ettikleriniz');
    $accordionItems = data_get($content, 'accordion_items', []);

    // Varsayılan sorular
    if (empty($accordionItems)) {
        $accordionItems = [
            [
                'question' => ['tr' => 'Hizmetleriniz hakkında daha fazla bilgi alabilir miyim?', 'en' => 'Can I get more information about your services?'],
                'answer' => ['tr' => 'Elbette! Hizmetlerimiz hakkında detaylı bilgi almak için bizimle iletişime geçebilir veya web sitemizi ziyaret edebilirsiniz.', 'en' => 'Of course! You can contact us or visit our website for detailed information about our services.'],
            ],
            [
                'question' => ['tr' => 'Destek hizmetiniz nasıl çalışıyor?', 'en' => 'How does your support service work?'],
                'answer' => ['tr' => '7/24 destek ekibimiz telefon, e-posta ve canlı sohbet üzerinden size yardımcı olmaya hazırdır.', 'en' => 'Our 24/7 support team is ready to help you via phone, email and live chat.'],
            ],
            [
                'question' => ['tr' => 'Fiyatlandırma nasıl yapılıyor?', 'en' => 'How is pricing done?'],
                'answer' => ['tr' => 'Projelerinizin kapsamına göre özel fiyatlandırma yapıyoruz. Detaylı teklif için bizimle iletişime geçin.', 'en' => 'We offer custom pricing based on the scope of your projects. Contact us for a detailed quote.'],
            ],
            [
                'question' => ['tr' => 'Proje teslim süreniz ne kadar?', 'en' => 'What is your project delivery time?'],
                'answer' => ['tr' => 'Proje süreleri, projenin karmaşıklığına göre değişiklik göstermektedir. Ortalama 2-6 hafta arası teslim sürelerimiz bulunmaktadır.', 'en' => 'Project durations vary depending on the complexity of the project. We have average delivery times of 2-6 weeks.'],
            ],
        ];
    }

    $uniqueId = 'accrd-' . uniqid();
@endphp

<section class="accrd-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="accrd-info">
                    <span class="accrd-info__subtitle">{{ $sectionSubtitle }}</span>
                    <h2 class="accrd-info__title">{{ $sectionTitle }}</h2>
                    <p class="accrd-info__description">
                        {{ data_get($content, 'description.' . app()->getLocale(), 'Sizin için hazırladığımız sık sorulan soruları burada bulabilirsiniz. Daha fazla bilgi için bizimle iletişime geçebilirsiniz.') }}
                    </p>
                    <div class="accrd-info__cta">
                        <a href="{{ data_get($content, 'cta_link', '#contact') }}" class="accrd-btn">
                            <span>{{ data_get($content, 'cta_text.' . app()->getLocale(), 'Bize Ulaşın') }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accrd-wrapper">
                    <div class="accordion" id="{{ $uniqueId }}">
                        @foreach($accordionItems as $index => $item)
                            @php
                                $itemId = $uniqueId . '-item-' . $index;
                            @endphp
                            <div class="accrd-item">
                                <h3 class="accrd-item__header">
                                    <button
                                            class="accrd-item__button {{ $index === 0 ? '' : 'collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $itemId }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    >
                                        <span class="accrd-item__number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                        <span class="accrd-item__question">{{ data_get($item, 'question.' . app()->getLocale(), 'Question') }}</span>
                                        <span class="accrd-item__icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </button>
                                </h3>
                                <div
                                        id="{{ $itemId }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#{{ $uniqueId }}"
                                >
                                    <div class="accrd-item__body">
                                        {{ data_get($item, 'answer.' . app()->getLocale(), 'Answer') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .accrd-section {
            padding: 100px 0;
            background: #ffffff;
            position: relative;
        }

        .accrd-section::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(14, 19, 39, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .accrd-info {
            padding-right: 40px;
            position: sticky;
            top: 100px;
        }

        .accrd-info__subtitle {
            display: inline-block;
            background: var(--gradient-primary);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
        }

        .accrd-info__title {
            font-size: 44px;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .accrd-info__description {
            font-size: 17px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .accrd-info__cta {
            margin-top: 30px;
        }

        .accrd-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--gradient-primary);
            color: #ffffff;
            padding: 16px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .accrd-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-glow);
            color: #ffffff;
        }

        .accrd-btn i {
            transition: transform 0.3s ease;
        }

        .accrd-btn:hover i {
            transform: translateX(5px);
        }

        .accrd-wrapper {
            background: #f8f9fa;
            padding: 40px;
            border-radius: 24px;
            box-shadow: var(--shadow-sm);
        }

        .accrd-item {
            background: #ffffff;
            border-radius: 16px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .accrd-item:hover {
            border-color: var(--primary-sky);
            box-shadow: var(--shadow-md);
        }

        .accrd-item__header {
            margin: 0;
        }

        .accrd-item__button {
            width: 100%;
            background: transparent;
            border: none;
            padding: 25px 30px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .accrd-item__button:hover {
            background: rgba(59, 130, 246, 0.02);
        }

        .accrd-item__number {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            color: #ffffff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
        }

        .accrd-item__question {
            flex: 1;
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .accrd-item__icon {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .accrd-item__icon i {
            color: var(--primary-blue);
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        .accrd-item__button:not(.collapsed) .accrd-item__icon {
            background: var(--primary-blue);
        }

        .accrd-item__button:not(.collapsed) .accrd-item__icon i {
            transform: rotate(45deg);
            color: #ffffff;
        }

        .accrd-item__body {
            padding: 0 30px 25px 90px;
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.8;
        }

        @media (max-width: 992px) {
            .accrd-section {
                padding: 80px 0;
            }

            .accrd-info {
                padding-right: 0;
                margin-bottom: 50px;
                position: static;
            }

            .accrd-info__title {
                font-size: 36px;
            }

            .accrd-wrapper {
                padding: 30px 20px;
            }

            .accrd-item__body {
                padding: 0 20px 20px 70px;
            }
        }

        @media (max-width: 768px) {
            .accrd-info__title {
                font-size: 28px;
            }

            .accrd-item__button {
                padding: 20px;
            }

            .accrd-item__body {
                padding: 0 20px 20px 20px;
            }

            .accrd-item__question {
                font-size: 16px;
            }
        }
    </style>
@endpush