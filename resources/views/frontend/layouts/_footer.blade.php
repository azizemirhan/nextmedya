@php
    /* |--------------------------------------------------------------------------
    | Footer Veri Çekme Bloğu - NextMedya Modern Tasarım
    |--------------------------------------------------------------------------
    | Video Arka Planlı, E-Bülten ve Sosyal Medya destekli footer
    */

    // Çevrilebilir Ayarlar
    $footerInfoText = data_get($settings, 'footer_info_text.value.' . app()->getLocale(), 'Dijitalin nabzını tutan, geleceğin iletişimini şekillendiren medya platformunuz.');
    $footerContactText = data_get($settings, 'footer_contact_text.value.' . app()->getLocale(), 'Uzman Ekibimizle İletişime Geçin');
    $newsletterTitle = data_get($settings, 'newsletter_title.value.' . app()->getLocale(), 'E-Bülten');
    $newsletterText = data_get($settings, 'newsletter_text.value.' . app()->getLocale(), 'Sektördeki en son haberleri ve özel teklifleri almak için bültenimize abone olun.');
    $copyrightText = data_get($settings, 'copyright_text.value.' . app()->getLocale(), 'Tüm hakları saklıdır.');
    $copyrightTagline = data_get($settings, 'copyright_tagline.value.' . app()->getLocale(), 'Geleceğin medyası, bugünden başlar.');

    // Çevrilemez Ayarlar
    $footerLogo = data_get($settings, 'footer_logo.value') ? asset($settings['footer_logo']->value) : asset('images/beyaz.png');
    $footerContactAddress = data_get($settings, 'footer_contact_address.value', 'İstanbul, Türkiye');
    $footerContactEmail = data_get($settings, 'footer_contact_email.value', 'info@nextmedya.com');
    $footerContactPhone = data_get($settings, 'footer_contact_phone.value', '+90 (212) 123 45 67');
    $footerContactHours = data_get($settings, 'footer_contact_hours.value', 'Pzt - Cum: 09:00 - 18:00');

    // Sosyal Medya
    $socialFacebook = data_get($settings, 'social_facebook.value', '#');
    $socialTwitter = data_get($settings, 'social_twitter.value', '#');
    $socialLinkedin = data_get($settings, 'social_linkedin.value', '#');
    $socialInstagram = data_get($settings, 'social_instagram.value', '#');
    $socialYoutube = data_get($settings, 'social_youtube.value', '#');

    // Footer Menüleri
    $footerExploreMenu = \App\Models\Menu::renderFooterMenu('footer-explore');
    $footerCorporateMenu = \App\Models\Menu::renderFooterMenu('footer-corporate');
@endphp

{{-- Modern NextMedya Footer --}}
<footer class="next-footer">
    {{-- ARKA PLAN VİDEOSU --}}
    <video class="next-footer-video" autoplay loop muted playsinline>
        {{-- Videonuzun yolunu buraya ekleyin. Düşük çözünürlüklü ve kısa bir video önerilir. --}}
        <source src="{{ asset('videos/server.mp4') }}" type="video/mp4">
    </video>
    {{-- Video için kaplama (overlay). Bu, CSS'ten yönetilecek. --}}

    <div class="next-footer-container">
        {{-- Şirket ve İletişim Bilgileri --}}
        <div class="next-footer-column">
            <div class="next-footer-logo">
                <a href="{{ route('frontend.home') }}">
                    <img src="{{ $footerLogo }}" alt="{{ config('app.name') }}" loading="lazy">
                </a>
            </div>
            <p class="next-footer-description">
                {{ $footerInfoText }}
            </p>
            <div class="next-footer-contact">
                <div class="next-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $footerContactAddress }}</span>
                </div>
                <div class="next-contact-item">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:{{ $footerContactEmail }}">{{ $footerContactEmail }}</a>
                </div>
                <div class="next-contact-item">
                    <i class="fas fa-phone"></i>
                    <a href="tel:{{ str_replace(['(', ')', ' '], '', $footerContactPhone) }}">{{ $footerContactPhone }}</a>
                </div>
                <div class="next-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $footerContactHours }}</span>
                </div>
            </div>
        </div>

        {{-- Keşfet ve Gezinme --}}
        <div class="next-footer-column">
            <h4 class="next-footer-title">{{ __('Keşfet') }}</h4>
            @if(!empty($footerExploreMenu))
                {!! $footerExploreMenu !!}
            @else
                <ul class="next-footer-links">
                    <li><a href="{{ route('frontend.home') }}" class="next-footer-link">{{ __('Ana Sayfa') }}</a></li>
                    <li><a href="/hakkimizda" class="next-footer-link">{{ __('Hakkımızda') }}</a></li>
                    <li><a href="/hizmetlerimiz" class="next-footer-link">{{ __('Hizmetlerimiz') }}</a></li>
                    <li><a href="/iletisim" class="next-footer-link">{{ __('İletişim') }}</a></li>
                </ul>
            @endif
        </div>

        {{-- Yasal ve Kurumsal --}}
        <div class="next-footer-column">
            <h4 class="next-footer-title">{{ __('Kurumsal') }}</h4>
            @if(!empty($footerCorporateMenu))
                {!! $footerCorporateMenu !!}
            @else
                <ul class="next-footer-links">
                    <li><a href="/gizlilik-politikasi" class="next-footer-link">{{ __('Gizlilik Politikası') }}</a></li>
                    <li><a href="/kullanim-sartlari" class="next-footer-link">{{ __('Kullanım Şartları') }}</a></li>
                    <li><a href="/cerez-politikasi" class="next-footer-link">{{ __('Çerez Politikası') }}</a></li>
                    <li><a href="/kvkk-aydinlatma-metni" class="next-footer-link">{{ __('KVKK Aydınlatma Metni') }}</a></li>
                </ul>
            @endif
        </div>

        {{-- E-Bülten ve Sosyal Medya (Yeni Eklenen Bölüm) --}}
        <div class="next-footer-column">
            <h4 class="next-footer-title">{{ $newsletterTitle }}</h4>
            <p class="next-footer-newsletter-text">
                {{ $newsletterText }}
            </p>
            <form class="next-newsletter-form" id="nextNewsletterForm">
                @csrf
                <div class="next-input-group">
                    <input type="email" class="next-newsletter-input" placeholder="E-posta adresiniz" required>
                </div>
                <button type="submit" class="next-newsletter-btn">
                    <span>Abone Ol</span>
                    <i class="fas fa-paper-plane next-btn-icon"></i>
                </button>
                <div class="next-newsletter-message" id="nextNewsletterMessage"></div>
            </form>

            {{-- Sosyal Medya --}}
            <div class="next-social-media">
                <h5 class="next-social-title">Bizi Takip Edin</h5>
                <div class="next-social-icons">
                    <a href="{{ $socialFacebook }}" class="next-social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $socialTwitter }}" class="next-social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $socialLinkedin }}" class="next-social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="{{ $socialInstagram }}" class="next-social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="next-footer-bottom">
        <div class="next-footer-bottom-container">
            <p class="next-copyright">
                © <span id="nextCopyrightYear">{{ date('Y') }}</span> {{ config('app.name') }}. {{ $copyrightText }}
            </p>
            <p class="next-footer-tagline">
                {{ $copyrightTagline }}
            </p>
        </div>
    </div>
</footer>

@push('scripts')
    {{-- Three.js Kütüphaneleri ve importmap KALDIRILDI --}}

    {{-- Footer JavaScript --}}
    <script type="module">
        // Three.js importları KALDIRILDI

        document.addEventListener('DOMContentLoaded', function() {
            // Copyright year
            initNextCopyrightYear();

            // Smooth scroll
            initNextSmoothScroll();

            // Logo animation
            initNextLogoAnimation();

            // Back to top button (Bu fonksiyon JS dosyanızda yoktu ama blade'de çağrılmıştı,
            // eğer varsa initNextBackToTop() çağrısını da ekleyebilirsiniz)
            // initNextBackToTop();

            // 3D Scene başlatma KALDIRILDI
            // initNext3DScene();

            // Yeni E-Bülten Formu
            initNextNewsletterForm();
        });

        // initNext3DScene() fonksiyonunun tamamı (yaklaşık 200 satır) KALDIRILDI

        /**
         * Copyright yılını otomatik günceller
         */
        function initNextCopyrightYear() {
            const nextYearElement = document.getElementById('nextCopyrightYear');
            if (nextYearElement) {
                // PHP'den gelen başlangıç yılını kullanmak daha dinamik olacaktır
                const startYear = {{ data_get($settings, 'copyright_start_year.value', date('Y')) }};
                const currentYear = new Date().getFullYear();

                if (currentYear > startYear) {
                    nextYearElement.textContent = `${startYear} - ${currentYear}`;
                } else {
                    nextYearElement.textContent = startYear;
                }
            }
        }

        /**
         * Smooth scroll işlemleri
         */
        function initNextSmoothScroll() {
            const nextFooterLinks = document.querySelectorAll('.next-footer-link');

            nextFooterLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');

                    if (href && href.startsWith('#')) {
                        const targetId = href.substring(1);
                        const targetElement = document.getElementById(targetId);

                        if (targetElement) {
                            e.preventDefault();
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });

                            history.pushState(null, null, href);
                        }
                    }
                });
            });
        }

        /**
         * Logo animasyonu ve etkileşim
         */
        function initNextLogoAnimation() {
            const nextLogo = document.querySelector('.next-footer-logo img');

            if (!nextLogo) return;

            nextLogo.style.opacity = '0';
            nextLogo.style.transform = 'translateY(20px)';

            setTimeout(() => {
                nextLogo.style.transition = 'all 0.6s ease';
                nextLogo.style.opacity = '1';
                nextLogo.style.transform = 'translateY(0)';
            }, 100);

            nextLogo.style.cursor = 'pointer';
            nextLogo.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        /**
         * YENİ EKLENDİ - E-Bülten Formu Gönderimi (Demo)
         */
        function initNextNewsletterForm() {
            const form = document.getElementById('nextNewsletterForm');
            const messageEl = document.getElementById('nextNewsletterMessage');
            if (!form || !messageEl) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = form.querySelector('input[type="email"]').value;
                const csrfToken = form.querySelector('input[name="_token"]').value;

                // Geçici olarak başarılı mesajı göster (AJAX yerine)
                messageEl.textContent = 'Başarıyla abone oldunuz! (Demo)';
                messageEl.className = 'next-newsletter-message next-success';
                form.querySelector('input[type="email"]').value = '';

                setTimeout(() => {
                    messageEl.className = 'next-newsletter-message';
                }, 5000);

                /* // Gerçek sunucuya göndermek için bu bloğu kullanabilirsiniz:
                fetch('/newsletter-subscribe', { // Laravel rotanızı buraya yazın
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageEl.textContent = data.message || 'Başarıyla abone oldunuz!';
                        messageEl.className = 'next-newsletter-message next-success';
                        form.querySelector('input[type="email"]').value = '';
                    } else {
                        messageEl.textContent = data.message || 'Bir hata oluştu.';
                        messageEl.className = 'next-newsletter-message next-error';
                    }
                })
                .catch(error => {
                    messageEl.textContent = 'Sunucuya bağlanırken bir hata oluştu.';
                    messageEl.className = 'next-newsletter-message next-error';
                })
                .finally(() => {
                    setTimeout(() => {
                        messageEl.className = 'next-newsletter-message';
                    }, 5000);
                });
                */
            });
        }

        /**
         * Back to top button
         * (Blade dosyanızda çağrılmış ama JS'te tanımlanmamış,
         * eğer bir "başa dön" butonunuz varsa bu kodu kullanabilirsiniz)
         */
        /*
        function initNextBackToTop() {
            const backToTopBtn = document.getElementById('next-back-to-top');

            if (!backToTopBtn) return;

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.add('next-show');
                } else {
                    backToTopBtn.classList.remove('next-show');
                }
            });

            backToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
        */
    </script>

@endpush