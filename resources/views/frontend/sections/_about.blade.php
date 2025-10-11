<div class="main-wrapper-about">
    <header class="page-header-section">
        <h1 class="primary-heading-about">Hakkımızda</h1>
        <p class="tagline-text">Yenilikçi çözümlerle geleceği şekillendiriyoruz</p>
    </header>

    <div class="features-grid-wrapper">
        <div class="feature-item-card" id="vision-card">
            <div class="feature-icon-box">🎯</div>
            <h3 class="feature-title-text">Vizyonumuz</h3>
            <p class="feature-description-text">Teknoloji ve inovasyonu bir araya getirerek, müşterilerimize en iyi
                dijital deneyimi sunmak ve sektörde öncü olmak.</p>
        </div>

        <div class="feature-item-card" id="mission-card">
            <div class="feature-icon-box">💡</div>
            <h3 class="feature-title-text">Misyonumuz</h3>
            <p class="feature-description-text">Kaliteli hizmet anlayışı ve müşteri odaklı yaklaşımımızla, her projede
                mükemmelliği hedefleyerek değer yaratmak.</p>
        </div>

        <div class="feature-item-card" id="values-card">
            <div class="feature-icon-box">⚡</div>
            <h3 class="feature-title-text">Değerlerimiz</h3>
            <p class="feature-description-text">Dürüstlük, şeffaflık, yenilikçilik ve sürekli gelişim ilkelerimizle
                işimizi en iyi şekilde yapıyoruz.</p>
        </div>
    </div>

    <div class="company-stats-section">
        <div class="stat-counter-card" id="projects-stat">
            <div class="stat-number-display" data-target="150">0</div>
            <div class="stat-description-label">Tamamlanan Proje</div>
        </div>
        <div class="stat-counter-card" id="clients-stat">
            <div class="stat-number-display" data-target="50">0</div>
            <div class="stat-description-label">Mutlu Müşteri</div>
        </div>
        <div class="stat-counter-card" id="experience-stat">
            <div class="stat-number-display" data-target="10">0</div>
            <div class="stat-description-label">Yıllık Deneyim</div>
        </div>
        <div class="stat-counter-card" id="team-stat">
            <div class="stat-number-display" data-target="25">0</div>
            <div class="stat-description-label">Ekip Üyesi</div>
        </div>
    </div>

    <div class="company-values-section">
        <h2 class="values-section-title">Temel Değerlerimiz</h2>
        <div class="values-list-container">
            <div class="value-item-box" id="integrity-value">
                <div class="value-icon-wrapper">🤝</div>
                <h4 class="value-name-heading">Dürüstlük</h4>
                <p class="value-detail-text">Her işimizde şeffaf ve güvenilir olmayı öncelik haline getiriyoruz.</p>
            </div>

            <div class="value-item-box" id="innovation-value">
                <div class="value-icon-wrapper">🚀</div>
                <h4 class="value-name-heading">İnovasyon</h4>
                <p class="value-detail-text">Sürekli yenilik ve teknolojik gelişimle sektörde fark yaratıyoruz.</p>
            </div>

            <div class="value-item-box" id="quality-value">
                <div class="value-icon-wrapper">⭐</div>
                <h4 class="value-name-heading">Kalite</h4>
                <p class="value-detail-text">Her projede en yüksek kalite standartlarını uyguluyoruz.</p>
            </div>

            <div class="value-item-box" id="teamwork-value">
                <div class="value-icon-wrapper">👥</div>
                <h4 class="value-name-heading">Takım Çalışması</h4>
                <p class="value-detail-text">Birlikte çalışarak daha güçlü sonuçlar elde ediyoruz.</p>
            </div>

            <div class="value-item-box" id="responsibility-value">
                <div class="value-icon-wrapper">🌱</div>
                <h4 class="value-name-heading">Sorumluluk</h4>
                <p class="value-detail-text">Çevreye ve topluma karşı sorumluluklarımızın bilincindeyiz.</p>
            </div>

            <div class="value-item-box" id="customer-value">
                <div class="value-icon-wrapper">💎</div>
                <h4 class="value-name-heading">Müşteri Odaklılık</h4>
                <p class="value-detail-text">Müşteri memnuniyeti her zaman önceliğimizdir.</p>
            </div>
        </div>
    </div>

    <div class="team-members-section">
        <h2 class="team-section-heading">Ekibimiz</h2>
        <div class="team-members-grid">
            <div class="single-team-member" id="member-ahmet">
                <div class="member-avatar-circle">AY</div>
                <h4 class="member-name-title">Ahmet Yılmaz</h4>
                <p class="member-position-text">Kurucu & CEO</p>
            </div>
            <div class="single-team-member" id="member-elif">
                <div class="member-avatar-circle">EK</div>
                <h4 class="member-name-title">Elif Kara</h4>
                <p class="member-position-text">Tasarım Müdürü</p>
            </div>
            <div class="single-team-member" id="member-mehmet">
                <div class="member-avatar-circle">MD</div>
                <h4 class="member-name-title">Mehmet Demir</h4>
                <p class="member-position-text">Geliştirme Lideri</p>
            </div>
            <div class="single-team-member" id="member-zeynep">
                <div class="member-avatar-circle">ZÖ</div>
                <h4 class="member-name-title">Zeynep Özkan</h4>
                <p class="member-position-text">Proje Yöneticisi</p>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
            min-height: 100vh;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        .main-wrapper-about {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header-section {
            text-align: center;
            padding: 60px 20px;
            position: relative;
        }

        .primary-heading-about {
            font-size: 3.5rem;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            animation: slideFromTop 1s ease;
        }

        .tagline-text {
            font-size: 1.2rem;
            color: #94a3b8;
            animation: slideFromBottom 1s ease;
        }

        .features-grid-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }

        .feature-item-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
            animation: fadeInCard 1s ease;
        }

        .feature-item-card:hover {
            transform: translateY(-10px);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        }

        .feature-icon-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .feature-title-text {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #3b82f6;
        }

        .feature-description-text {
            line-height: 1.8;
            color: #cbd5e1;
        }

        .team-members-section {
            margin: 80px 0;
            text-align: center;
        }

        .team-section-heading {
            font-size: 2.5rem;
            margin-bottom: 50px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .team-members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .single-team-member {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .single-team-member:hover {
            transform: scale(1.05);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .member-avatar-circle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .member-name-title {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #e2e8f0;
        }

        .member-position-text {
            color: #94a3b8;
        }

        .company-stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin: 80px 0;
        }

        .stat-counter-card {
            text-align: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .stat-number-display {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-description-label {
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .company-values-section {
            margin: 80px 0;
        }

        .values-section-title {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 50px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .values-list-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .value-item-box {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .value-item-box:hover {
            transform: translateX(10px);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .value-icon-wrapper {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .value-name-heading {
            font-size: 1.3rem;
            color: #3b82f6;
            margin-bottom: 10px;
        }

        .value-detail-text {
            color: #cbd5e1;
            line-height: 1.6;
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideFromTop {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideFromBottom {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .primary-heading-about {
                font-size: 2.5rem;
            }

            .team-section-heading,
            .values-section-title {
                font-size: 2rem;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        // Sayaç animasyonu
        const statNumbers = document.querySelectorAll('.stat-number-display');

        const animateCounter = (element) => {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        };

        // Intersection Observer ile sayaçları başlat
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.5});

        statNumbers.forEach(stat => observer.observe(stat));

        // Kartlara hover efekti için 3D etkisi
        const cards = document.querySelectorAll('.feature-item-card, .single-team-member, .value-item-box');

        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });
    </script>
@endpush
