// Scroll Progress
window.addEventListener("scroll", () => {
    const scrollProgress = document.getElementById("scrollProgress");
    const scrollTotal =
        document.documentElement.scrollHeight - window.innerHeight;
    const scrollCurrent = window.pageYOffset;
    const scrollPercentage = (scrollCurrent / scrollTotal) * 100;
    scrollProgress.style.width = scrollPercentage + "%";
});

// Header Scroll Effect
const mainHeader = document.getElementById("mainHeader");
let lastScroll = 0;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 50) {
        mainHeader.classList.add("scrolled");
    } else {
        mainHeader.classList.remove("scrolled");
    }

    // Hide header on scroll down, show on scroll up
    if (currentScroll > lastScroll && currentScroll > 200) {
        mainHeader.style.transform = "translateY(-100%)";
    } else {
        mainHeader.style.transform = "translateY(0)";
    }

    lastScroll = currentScroll;
});

// Mobile Menu Toggle
const mobileToggle = document.getElementById("mobileToggle");
const mobileMenu = document.getElementById("mobileMenu");
const mobileOverlay = document.getElementById("mobileOverlay");

mobileToggle.addEventListener("click", () => {
    mobileToggle.classList.toggle("active");
    mobileMenu.classList.toggle("active");
    mobileOverlay.classList.toggle("active");
    document.body.style.overflow = mobileMenu.classList.contains("active")
        ? "hidden"
        : "";
});

mobileOverlay.addEventListener("click", () => {
    mobileToggle.classList.remove("active");
    mobileMenu.classList.remove("active");
    mobileOverlay.classList.remove("active");
    document.body.style.overflow = "";
});

// Mobile Dropdown Toggle
function toggleMobileDropdown(element) {
    const dropdown = element.nextElementSibling;
    const toggle = element.querySelector(".mobile-dropdown-toggle");

    dropdown.classList.toggle("active");
    toggle.classList.toggle("active");
}

// Search Toggle
const searchToggle = document.getElementById("searchToggle");
const searchWrapper = document.getElementById("searchWrapper");

searchToggle.addEventListener("click", () => {
    searchWrapper.classList.toggle("active");
    if (searchWrapper.classList.contains("active")) {
        document.querySelector(".search-input").focus();
    }
});

// Close search when clicking outside
document.addEventListener("click", (e) => {
    if (
        !searchToggle.contains(e.target) &&
        !searchWrapper.contains(e.target)
    ) {
        searchWrapper.classList.remove("active");
    }
});

// Language Selector
const languageOptions = document.querySelectorAll(".language-option");
const languageBtn = document.querySelector(".language-btn");

languageOptions.forEach((option) => {
    option.addEventListener("click", () => {
        languageOptions.forEach((opt) => opt.classList.remove("active"));
        option.classList.add("active");

        // Update button text
        const flag = option.textContent.split(" ")[0];
        const code = option.textContent.split(" ")[1];
        languageBtn.innerHTML = `🌐 ${code}`;
    });
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

// Active menu item on scroll
const sections = document.querySelectorAll("section[id]");
const navLinks = document.querySelectorAll(".nav-link");

window.addEventListener("scroll", () => {
    let current = "";
    sections.forEach((section) => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= sectionTop - 200) {
            current = section.getAttribute("id");
        }
    });

    navLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${current}`) {
            link.classList.add("active");
        }
    });
});

// Prevent scroll when mobile menu is open
const body = document.body;
const observer = new MutationObserver(() => {
    if (mobileMenu.classList.contains("active")) {
        body.style.overflow = "hidden";
    } else {
        body.style.overflow = "";
    }
});

observer.observe(mobileMenu, {
    attributes: true,
    attributeFilter: ["class"],
});

// Add loading effect to CTA button
document
    .querySelector(".cta-button")
    .addEventListener("click", function (e) {
        e.preventDefault();
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="loading-spinner"></span>';
        btn.style.pointerEvents = "none";

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.pointerEvents = "";
            // Your actual navigation or action here
        }, 2000);
    });

// Keyboard navigation
document.addEventListener("keydown", (e) => {
    // ESC key closes mobile menu
    if (e.key === "Escape" && mobileMenu.classList.contains("active")) {
        mobileToggle.click();
    }

    // Ctrl/Cmd + K for search
    if ((e.ctrlKey || e.metaKey) && e.key === "k") {
        e.preventDefault();
        searchToggle.click();
    }
});

// Intersection Observer for fade-in animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px",
};

const fadeInObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

document.querySelectorAll(".nav-item").forEach((item) => {
    item.style.opacity = "0";
    item.style.transform = "translateY(-20px)";
    item.style.transition = "all 0.6s ease";
    fadeInObserver.observe(item);
});
