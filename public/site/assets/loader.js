document.querySelectorAll(".reveal").forEach(function (elem) {
    let parent = document.createElement("span");
    let child = document.createElement("span");
    parent.classList.add("parent");
    child.classList.add("child");
    child.innerHTML = elem.innerHTML;
    parent.appendChild(child);
    elem.innerHTML = "";
    elem.appendChild(parent);
});

// Ana timeline
const tl = gsap.timeline();

// 1. Logo fade in ve scale
tl.to(".logo-container", {
    opacity: 1,
    scale: 1,
    duration: 1,
    ease: "power3.out"
});

// 2. Glow efekti
tl.to(".glow", {
    opacity: 1,
    scale: 1.2,
    duration: 1,
    ease: "power2.out"
}, "-=0.5");

// 3. Text reveal - yukarı kayarak
tl.to(".child", {
    y: "-100%",
    duration: 0.8,
    stagger: 0.1,
    ease: "expo.inOut"
}, "-=0.3");

// 4. Loading dots animasyonu
tl.to(".dot", {
    opacity: 1,
    y: -10,
    duration: 0.5,
    stagger: 0.1,
    repeat: 2,
    yoyo: true,
    ease: "power1.inOut"
}, "-=0.5");

// 5. Logo yukarı kayar ve kaybolur
tl.to(".logo-container", {
    y: -800,
    opacity: 0,
    duration: 1.5,
    ease: "expo.inOut"
}, "-=0.5");

// 6. Mavi katman animasyonu
tl.to("#blue-dark", {
    height: 0,
    duration: 1.2,
    delay: 0.8,
    ease: "expo.inOut"
});

// 7. Açık mavi katman yükselir
tl.to("#blue-light", {
    height: "100%",
    duration: 1.2,
    delay: -1.2,
    ease: "expo.inOut"
});

// 8. Beyaz katman yükselir
tl.to("#white", {
    height: "100%",
    duration: 1.2,
    delay: -1,
    ease: "expo.inOut",
    onComplete: function () {
        document.getElementById('loader-wrapper').style.display = 'none';
        document.getElementById('main-content').style.display = 'block';

        // Bir sonraki ziyarette gösterme
        localStorage.setItem('loaderShown', 'true');
    }
});

// Logo pulse animasyonu (sürekli)
gsap.to(".logo-container", {
    scale: 1.05,
    duration: 1.5,
    repeat: 2,
    yoyo: true,
    ease: "power1.inOut",
    delay: 1
});

// Glow pulse animasyonu
gsap.to(".glow", {
    scale: 1.3,
    opacity: 0.5,
    duration: 2,
    repeat: 2,
    yoyo: true,
    ease: "power1.inOut",
    delay: 1.5
});
