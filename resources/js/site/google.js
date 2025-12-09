document.addEventListener('DOMContentLoaded', function () {
    // Counter Animation
    const counterObserverOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };

    const animateCounter = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const text = element.textContent;
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }

            if (text.includes('+')) {
                element.textContent = Math.floor(current) + '+';
            } else if (text.includes('%')) {
                element.textContent = Math.floor(current) + '%';
            } else if (text.includes('Yıl')) {
                element.textContent = Math.floor(current) + ' Yıl';
            } else if (text.includes('/')) {
                element.textContent = text;
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = 'true';
                animateCounter(entry.target);
            }
        });
    }, counterObserverOptions);

    document.querySelectorAll('.gpartner-stat-card__number').forEach(counter => {
        counterObserver.observe(counter);
    });
});
