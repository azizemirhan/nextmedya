import * as THREE from "https://esm.sh/three";
import {GLTFLoader} from "https://esm.sh/three/examples/jsm/loaders/GLTFLoader";
import gsap from 'https://cdn.skypack.dev/gsap@3.12.0';
import ScrollTrigger from 'https://cdn.skypack.dev/gsap@3.12.0/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

let particleSystem;

const canvas = document.querySelector("#laptop");
if (canvas) {
    // === YENİ: MOBİL UYUMLULUK DEĞİŞKENİ ===
    // Ekranın mobil olup olmadığını en başta kontrol ediyoruz
    const isMobile = window.innerWidth <= 768;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(35, canvas.clientWidth / canvas.clientHeight, 0.1, 3000);

    // === GÜNCELLENDİ: KAMERA POZİSYONU ===
    // Mobil ise kamerayı daha geriye alıyoruz (90 -> 140)
    camera.position.set(0, 5, isMobile ? 140 : 90);

    const renderer = new THREE.WebGLRenderer({antialias: true, alpha: true, canvas: canvas});
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    const ambientLight = new THREE.AmbientLight(0xffffff, 1.5);
    scene.add(ambientLight);
    const directionalLight = new THREE.DirectionalLight(0xffffff, 2);
    directionalLight.position.set(5, 10, 7.5);
    scene.add(directionalLight);
    const macGroup = new THREE.Group();
    macGroup.position.y = -10;
    scene.add(macGroup);

    // === GÜNCELLENDİ: MODEL BOYUTU ===
    // Mobil ise modeli biraz daha küçültüyoruz (0.8x -> 0.7x)
    // Masaüstünde ise büyük kalmaya devam ediyor (1.2x)
    const modelScale = isMobile ? 0.7 : 1.2;
    macGroup.scale.set(modelScale, modelScale, modelScale);

    const lidGroup = new THREE.Group();
    macGroup.add(lidGroup);
    const bottomGroup = new THREE.Group();
    macGroup.add(bottomGroup);
    const baseMetalMaterial = new THREE.MeshStandardMaterial({color: 0xcecfd3, metalness: 0.6, roughness: 0.4});
    const darkPlasticMaterial = new THREE.MeshStandardMaterial({color: 0x222222, roughness: 0.9});

    const modelLoader = new GLTFLoader();
    modelLoader.load("https://i-repair.ro/assets/mac-noUv.glb", (glb) => {
        glb.scene.traverse((child) => {
            if (child.isMesh) {
                if (child.name.includes("base") || child.name.includes("lid")) child.material = baseMetalMaterial;
                else child.material = darkPlasticMaterial;
            }
        });
        lidGroup.add(glb.scene.getObjectByName("_top"));
        bottomGroup.add(glb.scene.getObjectByName("_bottom"));

        particleSystem = createParticles(scene);
        setupIntroAnimation();
    });

    function setupIntroAnimation() {
        gsap.set(lidGroup.rotation, {x: 1.57});
        const mainTl = gsap.timeline();
        const isMobile = window.innerWidth <= 768; // Mobil kontrol değişkenimiz

        mainTl
            .to(macGroup.position, {y: 0})
            .to(macGroup.rotation, {y: -Math.PI / 4}, "<0.5")
            .to(lidGroup.rotation, {x: 0}, ">-0.5")

            // 1. DÜZELTME: Kameranın "içinden geçmesi" için son pozisyonu güncelledik (45 -> 5)
            .to(camera.position, {x: 0, y: 10.5, z: 5}, ">")

            // 2. DÜZELTME: Metinlerin belirmesine mobil için küçük bir gecikme ekledik
            .to("#scrolling-text-section", {
                opacity: 1,
                pointerEvents: "auto",
            }, isMobile ? ">+0.4" : ">") // Mobil ise 0.4 birim gecikme ekle, değilse bekleme

            .set(macGroup, {visible: false});

        ScrollTrigger.create({
            trigger: "#interactive-animation-container",
            start: "top top",
            end: "bottom bottom",
            animation: mainTl,
            scrub: 1.5,
        });
    }

    function createParticles(scene) {
        const particleCount = isMobile ? 2000 : 10000;
        const positions = [];
        for (let i = 0; i < particleCount; i++) {
            const x = Math.random() * 2000 - 1000;
            const y = Math.random() * 2000 - 1000;
            const z = Math.random() * 2000 - 1000;
            positions.push(x, y, z);
        }
        const geometry = new THREE.BufferGeometry();
        geometry.setAttribute('position', new THREE.Float32BufferAttribute(positions, 3));
        const material = new THREE.PointsMaterial({
            color: 0xFFFFFF,
            size: 1.5,
            transparent: true,
            opacity: 0.5,
            blending: THREE.AdditiveBlending,
            depthWrite: false
        });
        const particles = new THREE.Points(geometry, material);
        scene.add(particles);
        return particles;
    }

    function render() {
        if (particleSystem) {
            particleSystem.rotation.y += 0.0001;
        }
        renderer.render(scene, camera);
        requestAnimationFrame(render);
    }

    render();

    function updateSceneSize() {
        camera.aspect = canvas.clientWidth / canvas.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(canvas.clientWidth, canvas.clientHeight);
    }

    window.addEventListener("resize", updateSceneSize);
    updateSceneSize();
}
