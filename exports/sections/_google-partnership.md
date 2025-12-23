@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'ile Güçlü İş Ortaklığı');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), 'Resmi Google Partner');
    $description = data_get($content, 'description.' . app()->getLocale(), 'Google\'ın resmi iş ortağı olarak, en güncel teknolojileri ve araçları kullanarak işletmenizin dijital başarısını garanti altına alıyoruz.');

    $stats = data_get($content, 'stats', []);
    if (empty($stats)) {
        $stats = [
            ['number' => '500', 'suffix' => '+', 'label' => ['tr' => 'Başarılı Proje', 'en' => 'Successful Projects']],
            ['number' => '98', 'suffix' => '%', 'label' => ['tr' => 'Müşteri Memnuniyeti', 'en' => 'Customer Satisfaction']],
            ['number' => '5', 'suffix' => ' Yıl', 'label' => ['tr' => 'Partner Deneyimi', 'en' => 'Partner Experience']],
            ['number' => '24', 'suffix' => '/7', 'label' => ['tr' => 'Destek Hizmeti', 'en' => 'Support Service']],
        ];
    }

    $certifications = data_get($content, 'certifications', []);
    if (empty($certifications)) {
        $certifications = [
            ['title' => ['tr' => 'Google Ads', 'en' => 'Google Ads'], 'desc' => ['tr' => 'Sertifikalı Uzman', 'en' => 'Certified Expert'], 'icon' => 'shield'],
            ['title' => ['tr' => 'Analytics', 'en' => 'Analytics'], 'desc' => ['tr' => 'İleri Seviye', 'en' => 'Advanced Level'], 'icon' => 'chart'],
            ['title' => ['tr' => 'Cloud Platform', 'en' => 'Cloud Platform'], 'desc' => ['tr' => 'Onaylı Partner', 'en' => 'Approved Partner'], 'icon' => 'cloud'],
            ['title' => ['tr' => 'Workspace', 'en' => 'Workspace'], 'desc' => ['tr' => 'Kurumsal Çözüm', 'en' => 'Enterprise Solution'], 'icon' => 'briefcase'],
        ];
    }

    $features = data_get($content, 'features', []);
    if (empty($features)) {
        $features = [
            ['title' => ['tr' => 'Hızlı Performans', 'en' => 'Fast Performance'], 'text' => ['tr' => 'Google altyapısıyla maksimum hız', 'en' => 'Maximum speed with Google infrastructure'], 'icon' => 'zap'],
            ['title' => ['tr' => 'Güvenli Altyapı', 'en' => 'Secure Infrastructure'], 'text' => ['tr' => 'En yüksek güvenlik standartları', 'en' => 'Highest security standards'], 'icon' => 'lock'],
            ['title' => ['tr' => '7/24 Destek', 'en' => '24/7 Support'], 'text' => ['tr' => 'Kesintisiz teknik destek hizmeti', 'en' => 'Uninterrupted technical support'], 'icon' => 'headset'],
            ['title' => ['tr' => 'AI Teknolojileri', 'en' => 'AI Technologies'], 'text' => ['tr' => 'Yapay zeka destekli çözümler', 'en' => 'AI-powered solutions'], 'icon' => 'cpu'],
        ];
    }
@endphp

<section class="gpartner-section">
    <!-- Decorative Background Elements -->
    <div class="gpartner-bg-elements">
        <div class="gpartner-bg-circle gpartner-bg-circle--blue"></div>
        <div class="gpartner-bg-circle gpartner-bg-circle--red"></div>
        <div class="gpartner-bg-circle gpartner-bg-circle--yellow"></div>
        <div class="gpartner-bg-circle gpartner-bg-circle--green"></div>
    </div>

    <div class="container">
        <div class="gpartner-wrapper">
            <div class="row align-items-center">
                <!-- Left Side - Information -->
                <div class="col-lg-6">
                    <div class="gpartner-content" data-aos="fade-right">
                        <!-- Badge -->
                        <div class="gpartner-badge">
                            <span class="gpartner-badge__dot"></span>
                            <span class="gpartner-badge__text">{{ $sectionSubtitle }}</span>
                        </div>

                        <!-- Title -->
                        <h2 class="gpartner-title">
                            <span class="gpartner-title__google">Google</span> {{ $sectionTitle }}
                        </h2>

                        <!-- Description -->
                        <p class="gpartner-description">{!! $description !!}</p>

                        <!-- Statistics -->
                        <div class="gpartner-stats">
                            @foreach($stats as $index => $stat)
                                <div class="gpartner-stat-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="gpartner-stat-card__number" data-target="{{ data_get($stat, 'number', '0') }}">
                                        0{{ data_get($stat, 'suffix', '') }}
                                    </div>
                                    <div class="gpartner-stat-card__label">{{ data_get($stat, 'label.' . app()->getLocale(), 'Label') }}</div>
                                </div>
                            @endforeach
                        </div>

                        <!-- CTA Buttons -->
                        <div class="gpartner-cta">
                            <a href="{{ data_get($content, 'primary_button_link', '#') }}" class="gpartner-btn gpartner-btn--primary">
                                <span>{{ data_get($content, 'primary_button_text.' . app()->getLocale(), 'Partner Avantajlarını Keşfet') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ data_get($content, 'secondary_button_link', '#') }}" class="gpartner-btn gpartner-btn--secondary">
                                <i class="fas fa-award"></i>
                                <span>{{ data_get($content, 'secondary_button_text.' . app()->getLocale(), 'Sertifikalarımız') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Visual -->
                <div class="col-lg-6">
                    <div class="gpartner-visual" data-aos="fade-left">
                        <!-- Google Logo -->
                        <div class="gpartner-logo-wrapper">
                            <svg class="gpartner-logo" viewBox="0 0 272 92" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#EA4335" d="M115.75 47.18c0 12.77-9.99 22.18-22.25 22.18s-22.25-9.41-22.25-22.18C71.25 34.32 81.24 25 93.5 25s22.25 9.32 22.25 22.18zm-9.74 0c0-7.98-5.79-13.44-12.51-13.44S80.99 39.2 80.99 47.18c0 7.9 5.79 13.44 12.51 13.44s12.51-5.55 12.51-13.44z"/>
                                <path fill="#FBBC05" d="M163.75 47.18c0 12.77-9.99 22.18-22.25 22.18s-22.25-9.41-22.25-22.18c0-12.85 9.99-22.18 22.25-22.18s22.25 9.32 22.25 22.18zm-9.74 0c0-7.98-5.79-13.44-12.51-13.44s-12.51 5.46-12.51 13.44c0 7.9 5.79 13.44 12.51 13.44s12.51-5.55 12.51-13.44z"/>
                                <path fill="#4285F4" d="M209.75 26.34v39.82c0 16.38-9.66 23.07-21.08 23.07-10.75 0-17.22-7.19-19.66-13.07l8.48-3.53c1.51 3.61 5.21 7.87 11.17 7.87 7.31 0 11.84-4.51 11.84-13v-3.19h-.34c-2.18 2.69-6.38 5.04-11.68 5.04-11.09 0-21.25-9.66-21.25-22.09 0-12.52 10.16-22.26 21.25-22.26 5.29 0 9.49 2.35 11.68 4.96h.34v-3.61h9.25zm-8.56 20.92c0-7.81-5.21-13.52-11.84-13.52-6.72 0-12.35 5.71-12.35 13.52 0 7.73 5.63 13.36 12.35 13.36 6.63 0 11.84-5.63 11.84-13.36z"/>
                                <path fill="#34A853" d="M225 3v65h-9.5V3h9.5z"/>
                                <path fill="#EA4335" d="M262.02 54.48l7.56 5.04c-2.44 3.61-8.32 9.83-18.48 9.83-12.6 0-22.01-9.74-22.01-22.18 0-13.19 9.49-22.18 20.92-22.18 11.51 0 17.14 9.16 18.98 14.11l1.01 2.52-29.65 12.28c2.27 4.45 5.8 6.72 10.75 6.72 4.96 0 8.4-2.44 10.92-6.14zm-23.27-7.98l19.82-8.23c-1.09-2.77-4.37-4.7-8.23-4.7-4.95 0-11.84 4.37-11.59 12.93z"/>
                                <path fill="#4285F4" d="M35.29 41.41V32H67c.31 1.64.47 3.58.47 5.68 0 7.06-1.93 15.79-8.15 22.01-6.05 6.3-13.78 9.66-24.02 9.66C16.32 69.35.36 53.89.36 34.91.36 15.93 16.32.47 35.3.47c10.5 0 17.98 4.12 23.6 9.49l-6.64 6.64c-4.03-3.78-9.49-6.72-16.97-6.72-13.86 0-24.7 11.17-24.7 25.03 0 13.86 10.84 25.03 24.7 25.03 8.99 0 14.11-3.61 17.39-6.89 2.66-2.66 4.41-6.46 5.1-11.65l-22.49.01z"/>
                            </svg>
                        </div>

                        <!-- Certification Cards -->
                        <div class="gpartner-certs">
                            @foreach($certifications as $index => $cert)
                                <div class="gpartner-cert-card" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                    <div class="gpartner-cert-card__icon">
                                        @php
                                            $iconType = data_get($cert, 'icon', 'shield');
                                            $iconMap = [
                                                'shield' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                                                'chart' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                                                'cloud' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
                                                'briefcase' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
                                            ];
                                            $iconPath = $iconMap[$iconType] ?? $iconMap['shield'];
                                        @endphp
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"/>
                                        </svg>
                                    </div>
                                    <div class="gpartner-cert-card__title">{{ data_get($cert, 'title.' . app()->getLocale()) }}</div>
                                    <div class="gpartner-cert-card__desc">{{ data_get($cert, 'desc.' . app()->getLocale()) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Strip -->
            <div class="gpartner-features" data-aos="fade-up">
                <div class="row">
                    @foreach($features as $index => $feature)
                        <div class="col-lg-3 col-md-6">
                            <div class="gpartner-feature" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="gpartner-feature__icon">
                                    @php
                                        $featureIcon = data_get($feature, 'icon', 'zap');
                                        $featureIconMap = [
                                            'zap' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                            'lock' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
                                            'headset' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                                            'cpu' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'
                                        ];
                                        $featurePath = $featureIconMap[$featureIcon] ?? $featureIconMap['zap'];
                                    @endphp
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $featurePath }}"/>
                                    </svg>
                                </div>
                                <div class="gpartner-feature__content">
                                    <h4 class="gpartner-feature__title">{{ data_get($feature, 'title.' . app()->getLocale()) }}</h4>
                                    <p class="gpartner-feature__text">{{ data_get($feature, 'text.' . app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
