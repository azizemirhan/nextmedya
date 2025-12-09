document.addEventListener('DOMContentLoaded', function () {
    // Copyright year
    initNextCopyrightYear();

    // Smooth scroll
    initNextSmoothScroll();

    // Logo animation
    initNextLogoAnimation();

    // 3D Scene başlat
    initNext3DScene();
});

/**
 * 3D Scene Initialize
 */
function initNext3DScene() {
    const canvas = document.getElementById('nextCanvas3d');
    if (!canvas) return;

    const canvasContainer = canvas.parentElement;
    const canvasWidth = canvasContainer.offsetWidth;
    const canvasHeight = canvasContainer.offsetHeight;

    // Renderer
    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true,
        alpha: true
    });

    renderer.setClearColor(0x0e1327, 0.8);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(canvasWidth, canvasHeight);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.5;

    // Scene
    const scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x0e1327, 0.15);

    // Camera
    const camera = new THREE.PerspectiveCamera(
        50,
        canvasWidth / canvasHeight,
        0.1,
        100
    );
    camera.position.set(0, 0, 5);

    // Controls
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.enablePan = false;
    controls.enableZoom = false;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 0.5;

    const angleLimit = Math.PI / 6;
    controls.minPolarAngle = Math.PI / 2 - angleLimit;
    controls.maxPolarAngle = Math.PI / 2 + angleLimit;

    // Lights
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    const directionalLight1 = new THREE.DirectionalLight(0x3b82f6, 1);
    directionalLight1.position.set(5, 5, 5);
    scene.add(directionalLight1);

    const directionalLight2 = new THREE.DirectionalLight(0x2563eb, 0.5);
    directionalLight2.position.set(-5, -5, -5);
    scene.add(directionalLight2);

    const pointLight = new THREE.PointLight(0x3b82f6, 2, 10);
    pointLight.position.set(0, 2, 3);
    scene.add(pointLight);

    // Create abstract geometry
    const geometry = new THREE.IcosahedronGeometry(1.5, 4);

    // Custom shader material
    const material = new THREE.ShaderMaterial({
        uniforms: {
            time: {value: 0},
            color1: {value: new THREE.Color(0x3b82f6)},
            color2: {value: new THREE.Color(0x2563eb)},
            color3: {value: new THREE.Color(0x1e40af)}
        },
        vertexShader: `
            uniform float time;
            varying vec3 vNormal;
            varying vec3 vPosition;
            
            void main() {
                vNormal = normalize(normalMatrix * normal);
                vPosition = position;
                
                vec3 pos = position;
                float displacement = sin(pos.x * 2.0 + time) * 0.1;
                displacement += sin(pos.y * 3.0 + time * 0.5) * 0.1;
                displacement += sin(pos.z * 4.0 + time * 0.3) * 0.1;
                
                pos += normal * displacement;
                
                gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.0);
            }
        `,
        fragmentShader: `
            uniform float time;
            uniform vec3 color1;
            uniform vec3 color2;
            uniform vec3 color3;
            varying vec3 vNormal;
            varying vec3 vPosition;
            
            void main() {
                float pattern = sin(vPosition.x * 5.0 + time) * 
                               sin(vPosition.y * 5.0 + time) * 
                               sin(vPosition.z * 5.0 + time);
                
                vec3 color = mix(color1, color2, (pattern + 1.0) * 0.5);
                color = mix(color, color3, vNormal.z * 0.5 + 0.5);
                
                float fresnel = pow(1.0 - dot(vNormal, vec3(0.0, 0.0, 1.0)), 3.0);
                color += fresnel * 0.5;
                
                gl_FragColor = vec4(color, 1.0);
            }
        `,
        wireframe: false
    });

    const mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);

    // Particles
    const particlesGeometry = new THREE.BufferGeometry();
    const particlesCount = 1000;
    const positions = new Float32Array(particlesCount * 3);

    for (let i = 0; i < particlesCount * 3; i++) {
        positions[i] = (Math.random() - 0.5) * 10;
    }

    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

    const particlesMaterial = new THREE.PointsMaterial({
        size: 0.02,
        color: 0x3b82f6,
        transparent: true,
        opacity: 0.6,
        blending: THREE.AdditiveBlending
    });

    const particles = new THREE.Points(particlesGeometry, particlesMaterial);
    scene.add(particles);

    // Post processing
    const composer = new EffectComposer(renderer);
    const renderPass = new RenderPass(scene, camera);
    composer.addPass(renderPass);

    const bloomPass = new UnrealBloomPass(
        new THREE.Vector2(canvasWidth, canvasHeight),
        1.5,
        0.4,
        0.85
    );
    bloomPass.threshold = 0.1;
    bloomPass.strength = 1.2;
    bloomPass.radius = 0.8;
    composer.addPass(bloomPass);

    // Displacement shader
    const displacementShader = {
        uniforms: {
            tDiffuse: {value: null},
            time: {value: 0},
            distortion: {value: 0.02}
        },
        vertexShader: `
            varying vec2 vUv;
            void main() {
                vUv = uv;
                gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
            }
        `,
        fragmentShader: `
            uniform sampler2D tDiffuse;
            uniform float time;
            uniform float distortion;
            varying vec2 vUv;
            
            void main() {
                vec2 uv = vUv;
                uv.x += sin(uv.y * 10.0 + time) * distortion;
                uv.y += cos(uv.x * 10.0 + time) * distortion;
                
                gl_FragColor = texture2D(tDiffuse, uv);
            }
        `
    };

    const displacementPass = new ShaderPass(displacementShader);
    composer.addPass(displacementPass);

    // Resize
    function onNext3DResize() {
        const newWidth = canvasContainer.offsetWidth;
        const newHeight = canvasContainer.offsetHeight;

        camera.aspect = newWidth / newHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(newWidth, newHeight);
        composer.setSize(newWidth, newHeight);
    }

    window.addEventListener("resize", onNext3DResize);

    // Animation
    const clock = new THREE.Clock();

    function animate() {
        requestAnimationFrame(animate);

        const elapsedTime = clock.getElapsedTime();

        // Update material
        material.uniforms.time.value = elapsedTime;

        // Update displacement
        displacementPass.uniforms.time.value = elapsedTime;

        // Rotate mesh
        mesh.rotation.x = elapsedTime * 0.1;
        mesh.rotation.y = elapsedTime * 0.15;

        // Animate particles
        particles.rotation.y = elapsedTime * 0.05;

        // Update controls
        controls.update();

        // Render
        composer.render();
    }

    animate();
}

/**
 * Copyright yılını otomatik günceller
 */
function initNextCopyrightYear() {
    const nextYearElement = document.getElementById('nextCopyrightYear');
    if (nextYearElement) {
        const currentYear = new Date().getFullYear();
        const startYear = 2023;

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
        link.addEventListener('click', function (e) {
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
    nextLogo.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}