/**
 * Enhanced Mega Menu JavaScript
 * Dynamic header height calculation and smooth interactions
 */

(function() {
    'use strict';

    // Calculate and set header height as CSS variable
    function setHeaderHeight() {
        const header = document.querySelector('.main-header');
        const topBanner = document.querySelector('.desktop-top-banner');
        const topBar = document.querySelector('.top-bar');

        let totalHeight = 0;

        // Tüm header elementlerinin yüksekliklerini topla
        if (topBanner && window.getComputedStyle(topBanner).display !== 'none') {
            totalHeight += topBanner.offsetHeight;
        }

        if (topBar && window.getComputedStyle(topBar).display !== 'none') {
            totalHeight += topBar.offsetHeight;
        }

        if (header) {
            totalHeight += header.offsetHeight;
        }

        // Set CSS variable for mega menu positioning
        document.documentElement.style.setProperty('--header-height', `${totalHeight}px`);
    }

    // Initialize on DOM ready
    function init() {
        // Set initial header height
        setHeaderHeight();
        
        // Recalculate on resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(setHeaderHeight, 100);
        });

        // Recalculate on scroll (header might become sticky)
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (Math.abs(scrollTop - lastScrollTop) > 50) {
                setHeaderHeight();
                lastScrollTop = scrollTop;
            }
        }, { passive: true });

        // Add smooth hover delay for mega menu
        const megaDropdowns = document.querySelectorAll('.mega-dropdown');
        megaDropdowns.forEach(function(dropdown) {
            let timeoutId;
            
            dropdown.addEventListener('mouseenter', function() {
                clearTimeout(timeoutId);
                // Add active class for better control
                this.classList.add('is-hovering');
            });
            
            dropdown.addEventListener('mouseleave', function() {
                const self = this;
                timeoutId = setTimeout(function() {
                    self.classList.remove('is-hovering');
                }, 150);
            });
        });

        // Keyboard accessibility
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openMenus = document.querySelectorAll('.mega-dropdown.is-hovering');
                openMenus.forEach(function(menu) {
                    menu.classList.remove('is-hovering');
                });
            }
        });
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Also run after window load to ensure all elements are rendered
    window.addEventListener('load', setHeaderHeight);

})();
