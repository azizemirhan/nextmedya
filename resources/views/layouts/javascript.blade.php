<script>
    VANTA.DOTS({
        el: "#your-element-selector",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 400.00,
        minWidth: 400.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0x707070,
        color2: 0xffffff,
        backgroundColor: 0x0,
        size: 3.50,
        spacing: 18.00,
        showLines: false
    })
</script>
<script>
    var typed = new Typed('#typed-output', {
        strings: ['Web Tasarım', 'Seo Danışmanlığı', 'E-Ticaret Sitesi',
            'AMP Web Tasarım'
        ], // yazılacak içerikler
        typeSpeed: 50, // yazma hızı (ms)
        backSpeed: 25, // silme hızı
        loop: true, // döngü aktif
        smartBackspace: true, // önceki kelimeyle benzerse kısmı sil
        showCursor: true,
        cursorChar: '|'
    });
</script>
<script>
    const list = document.querySelectorAll(".nav__item");
    list.forEach((item) => {
        item.addEventListener("click", () => {
            list.forEach((item) => item.classList.remove("active"));
            item.classList.add("active");
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    AOS.init();
</script>
<script>
    var swiper = new Swiper(".swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2,
            slideShadows: true
        },
        spaceBetween: 60,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        }
    });
</script>
<script>
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const featureItems = document.querySelectorAll('.feature-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filter = button.getAttribute('data-filter');

            // Show/hide features based on filter
            featureItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Feature detail modal
    const featureDetailModal = document.getElementById('featureDetailModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalComparison = document.getElementById('modalComparison');

    function showFeatureDetail(feature) {
        // Set content based on feature
        if (feature === 'api') {
            modalTitle.textContent = 'API Access Comparison';
            modalDescription.textContent =
                'Access our platform programmatically with our comprehensive API. Different plans offer varying levels of access and request limits.';

            modalComparison.innerHTML = `
          <div class="modal-feature-item">
            <div class="modal-plan-name">Starter</div>
            <div class="modal-feature-detail">Not available</div>
          </div>
          <div class="modal-feature-item">
            <div class="modal-plan-name">Pro</div>
            <div class="modal-feature-detail">1,000 API calls/day with standard endpoints</div>
          </div>
          <div class="modal-feature-item">
            <div class="modal-plan-name">Business</div>
            <div class="modal-feature-detail">Unlimited API calls with priority access and advanced endpoints</div>
          </div>
        `;
        } else if (feature === 'integration') {
            modalTitle.textContent = 'Enterprise Integration';
            modalDescription.textContent =
                'Connect our platform with your existing enterprise software stack. Our integration options vary by plan.';

            modalComparison.innerHTML = `
          <div class="modal-feature-item">
            <div class="modal-plan-name">Starter</div>
            <div class="modal-feature-detail">Basic integrations with popular tools only</div>
          </div>
          <div class="modal-feature-item">
            <div class="modal-plan-name">Pro</div>
            <div class="modal-feature-detail">Advanced integrations with popular enterprise tools</div>
          </div>
          <div class="modal-feature-item">
            <div class="modal-plan-name">Business</div>
            <div class="modal-feature-detail">Custom integrations with any enterprise system, including legacy software</div>
          </div>
        `;
        }

        // Show modal with animation
        featureDetailModal.classList.add('active');
    }

    // Add button ripple effect
    const buttons = document.querySelectorAll('.cta-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;

            const ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            this.appendChild(ripples);

            setTimeout(() => {
                ripples.remove();
            }, 600);
        });
    });
</script>
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/644f6e894247f20fefeeaf89/1gvb4fii7';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<script>
    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
    // Arka plana tıklayınca kapatma
    window.onclick = function(event) {
        let modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function() {
            return false;
        })

    });
</script>
<script>
    // Tüm açma butonlarını seç
    const openButtons = document.querySelectorAll('.openModalBtn');
    const closeButtons = document.querySelectorAll('.nm-modal__close');

    // Açma butonlarına tıklama eventi
    openButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
            }
        });
    });

    // Kapatma butonlarına tıklama eventi
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.nm-modal');
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
        });
    });

    // Kaplamaya tıklayınca kapat
    document.querySelectorAll('.nm-modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
            }
        });
    });

    // ESC ile kapatma
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.nm-modal.is-open').forEach(openModal => {
                openModal.classList.remove('is-open');
                openModal.setAttribute('aria-hidden', 'true');
            });
        }
    });
</script>
