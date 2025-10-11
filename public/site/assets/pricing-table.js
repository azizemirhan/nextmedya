document.querySelectorAll('.cta-button, .call-button').forEach(button => {
    button.addEventListener('click', function () {
        // Button click animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);

        // Here you can add your phone call functionality
        console.log('Call button clicked for:', this.closest('.pricing-card').querySelector('.plan-name').textContent);
    });
});

window.addEventListener('load', function () {
    const cards = document.querySelectorAll('.pricing-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
