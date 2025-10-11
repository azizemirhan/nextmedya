gsap.registerPlugin(ScrollTrigger);

// Ses efekti
const clickSound = new Audio('https://cdn.freesound.org/previews/378/378085_6260145-lq.mp3');

// Klavye konfigürasyonu
const keyConfig = {
    one: {
        element: document.getElementById('key-one'),
        key: 'o'
    },
    two: {
        element: document.getElementById('key-two'),
        key: 'g'
    },
    three: {
        element: document.getElementById('key-three'),
        key: 'Enter'
    }
};

// Tuş basma efektleri
Object.values(keyConfig).forEach(config => {
    config.element.addEventListener('pointerdown', () => {
        clickSound.currentTime = 0;
        clickSound.play().catch(() => {
        });

        gsap.to(config.element.querySelector('.key-content-wrapper'), {
            y: '20%',
            duration: 0.1,
            ease: 'power2.out'
        });
    });

    config.element.addEventListener('pointerup', () => {
        gsap.to(config.element.querySelector('.key-content-wrapper'), {
            y: '0%',
            duration: 0.2,
            ease: 'power2.out'
        });
    });
});

// Klavye kontrolleri
window.addEventListener('keydown', (event) => {
    Object.values(keyConfig).forEach(config => {
        if (event.key === config.key) {
            config.element.dataset.pressed = 'true';
            clickSound.currentTime = 0;
            clickSound.play().catch(() => {
            });
        }
    });
});

window.addEventListener('keyup', (event) => {
    Object.values(keyConfig).forEach(config => {
        if (event.key === config.key) {
            config.element.dataset.pressed = 'false';
        }
    });
});

// GSAP ScrollTrigger Animasyonları
gsap.to('.footer-signup-container', {
    scrollTrigger: {
        trigger: '.interactive-footer-wrapper',
        start: 'top 80%',
    },
    opacity: 1,
    y: 0,
    duration: 0.8,
    ease: 'power3.out'
});

gsap.to('.keypad-3d-container', {
    scrollTrigger: {
        trigger: '.interactive-footer-wrapper',
        start: 'top 80%',
    },
    opacity: 1,
    scale: 1,
    duration: 0.8,
    delay: 0.2,
    ease: 'back.out(1.2)'
});

// Footer kolonları animasyonu
document.querySelectorAll('.footer-column-section').forEach((column, index) => {
    gsap.to(column, {
        scrollTrigger: {
            trigger: '.footer-nav-grid',
            start: 'top 80%',
        },
        opacity: 1,
        y: 0,
        duration: 0.6,
        delay: index * 0.1,
        ease: 'power3.out'
    });
});

// Form submit animasyonu
document.getElementById('footer-newsletter-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const button = e.target.querySelector('.submit-button-newsletter');
    const originalText = button.textContent;

    gsap.to(button, {
        scale: 0.95,
        duration: 0.1,
        onComplete: () => {
            button.textContent = '✓ Başarılı!';
            button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

            gsap.to(button, {
                scale: 1,
                duration: 0.3,
                ease: 'back.out(1.7)'
            });

            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = 'linear-gradient(135deg, #3b82f6, #1e40af)';
                e.target.reset();
            }, 2000);
        }
    });
});

// Link hover animasyonları
document.querySelectorAll('.footer-link-anchor').forEach(link => {
    link.addEventListener('mouseenter', () => {
        gsap.to(link, {
            x: 10,
            duration: 0.3,
            ease: 'power2.out'
        });
    });

    link.addEventListener('mouseleave', () => {
        gsap.to(link, {
            x: 0,
            duration: 0.3,
            ease: 'power2.out'
        });
    });
});

// Social icon animasyonları
document.querySelectorAll('.social-link-icon').forEach(icon => {
    icon.addEventListener('mouseenter', () => {
        gsap.to(icon, {
            scale: 1.2,
            rotation: 360,
            duration: 0.5,
            ease: 'back.out(1.7)'
        });
    });

    icon.addEventListener('mouseleave', () => {
        gsap.to(icon, {
            scale: 1,
            rotation: 0,
            duration: 0.3,
            ease: 'power2.out'
        });
    });
});

// Klavye hover efekti
const keypad = document.querySelector('.keypad-3d-container');
keypad.addEventListener('mouseenter', () => {
    gsap.to('.keypad-base-layer', {
        y: -5,
        duration: 0.3,
        ease: 'power2.out'
    });
});

keypad.addEventListener('mouseleave', () => {
    gsap.to('.keypad-base-layer', {
        y: 0,
        duration: 0.3,
        ease: 'power2.out'
    });
});
