@php
    $sectionTitle = data_get($content, 'section_title.' . app()->getLocale(), 'Mevcut Siteniz Sizi Yansıtıyor mu?');
    $sectionSubtitle = data_get($content, 'section_subtitle.' . app()->getLocale(), '');
    $painPoints = data_get($content, 'pain_points', []);
    
    if (empty($painPoints)) {
        $painPoints = [
            ['icon' => 'fas fa-mobile-alt', 'title' => ['tr' => 'Mobilde Kötü Görünüyor'], 'description' => ['tr' => 'Siteniz mobil cihazlarda düzgün çalışmıyor ve müşterileriniz hemen çıkıyor']],
            ['icon' => 'fas fa-turtle', 'title' => ['tr' => 'Yavaş Açılıyor'], 'description' => ['tr' => 'Yavaş yüklenen sayfalar yüzünden potansiyel müşteriler kaybediyorsunuz']],
            ['icon' => 'fas fa-search-minus', 'title' => ['tr' => 'Google\'da Bulunamıyor'], 'description' => ['tr' => 'SEO eksikliği yüzünden rakipleriniz dijitalde sizden daha önde']],
            ['icon' => 'fas fa-cog', 'title' => ['tr' => 'Yönetmek Çok Zor'], 'description' => ['tr' => 'Karmaşık yönetim paneli yüzünden basit bir değişiklik bile saatler alıyor']],
        ];
    }
@endphp

<section class="nextmedya-pain-points">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="nextmedya-section-header">
                    <h2 class="nextmedya-section-title">{{ $sectionTitle }}</h2>
                    @if($sectionSubtitle)
                        <p class="nextmedya-section-subtitle">{{ $sectionSubtitle }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row nextmedya-pain-grid">
            @foreach($painPoints as $index => $point)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="nextmedya-pain-card">
                        <div class="nextmedya-pain-icon">
                            <i class="{{ data_get($point, 'icon', 'fas fa-times-circle') }}"></i>
                        </div>
                        <h3 class="nextmedya-pain-title">{{ data_get($point, 'title.' . app()->getLocale()) }}</h3>
                        <p class="nextmedya-pain-description">{!! data_get($point, 'description.' . app()->getLocale()) !!}</p>
                        <div class="nextmedya-pain-badge">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="nextmedya-pain-cta">
                    <p class="nextmedya-pain-cta-text">Bu sorunlarla uğraşmayı bırakın!</p>
                    <a href="#solution" class="nextmedya-btn nextmedya-btn-primary smooth-scroll">
                        Çözümü Keşfedin
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .nextmedya-pain-points {
            padding: 100px 0;
            background: #ffffff;
            position: relative;
        }

        .nextmedya-section-header {
            margin-bottom: 60px;
        }

        .nextmedya-section-title {
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .nextmedya-section-subtitle {
            font-size: 1.25rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }

        .nextmedya-pain-grid {
            margin-bottom: 60px;
        }

        .nextmedya-pain-card {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            height: 100%;
            margin-bottom: 30px;
        }

        .nextmedya-pain-card:hover {
            border-color: #ef4444;
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(239, 68, 68, 0.15);
        }

        .nextmedya-pain-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            transition: all 0.4s ease;
        }

        .nextmedya-pain-icon i {
            font-size: 2.5rem;
            color: #ef4444;
        }

        .nextmedya-pain-card:hover .nextmedya-pain-icon {
            transform: scale(1.1) rotate(10deg);
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .nextmedya-pain-card:hover .nextmedya-pain-icon i {
            color: #ffffff;
        }

        .nextmedya-pain-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .nextmedya-pain-description {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        .nextmedya-pain-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .nextmedya-pain-badge i {
            color: #ef4444;
            font-size: 1.25rem;
        }

        .nextmedya-pain-card:hover .nextmedya-pain-badge {
            opacity: 1;
            animation: pulse 2s infinite;
        }

        .nextmedya-pain-cta {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 2px dashed #ef4444;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }

        .nextmedya-pain-cta-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 24px;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @media (max-width: 768px) {
            .nextmedya-pain-points {
                padding: 60px 0;
            }

            .nextmedya-pain-card {
                padding: 30px 20px;
            }

            .nextmedya-pain-cta {
                padding: 30px 20px;
            }

            .nextmedya-pain-cta-text {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.querySelectorAll('.smooth-scroll').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
@endpush