@props([
    'title' => 'Sayfa Başlığı',
    'subtitle' => ''
])
<section class="hero-banner">
    <div id="webgl-canvas" style="height: 200px"></div>
    <div class="bubbleContainer">
        <div class="innovation-logo">
            <h1>İnovasyon Laboratuvarı</h1>
            <p>Geleceği Birlikte İnşa Ediyoruz</p>
        </div>
    </div>
</section>
<hr style="color: #fff">
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        const particleWave = () => {
            const heroBanner = document.querySelector(".hero-banner");
            let w = heroBanner.clientWidth;
            let h = heroBanner.clientHeight;
            const dpr = window.devicePixelRatio || 1;

            const fov = 60;
            const fovRad = fov * (Math.PI / 180);
            const dist = h / 2 / Math.tan(fovRad);

            const clock = new THREE.Clock();
            const pointSize = 4 * dpr;

            const renderer = new THREE.WebGLRenderer({alpha: true});
            renderer.setSize(w, h);
            renderer.setClearColor(new THREE.Color("#0f172a"), 0);
            renderer.setPixelRatio(dpr);

            const container = document.getElementById("webgl-canvas");
            container.appendChild(renderer.domElement);

            const camera = new THREE.PerspectiveCamera(fov, w / h, 1, dist * 8);
            camera.position.x = 0;
            camera.position.y = 20;
            camera.position.z = 150;

            const scene = new THREE.Scene();

            const geo = new THREE.BufferGeometry();
            const positions = [];

            const width = 200 * (w / h);
            const depth = 100;
            const distance = 5;

            for (let x = 0; x < width; x += distance) {
                for (let z = 0; z < depth; z += distance) {
                    positions.push(-width / 2 + x, -30, -depth / 2 + z);
                }
            }
            const positionAttribute = new THREE.Float32BufferAttribute(positions, 3);
            geo.setAttribute("position", positionAttribute);

            const mat = new THREE.ShaderMaterial({
                uniforms: {
                    u_time: {
                        value: 0.0
                    },
                    color1: {
                        value: new THREE.Color("#3b82f6")
                    },
                    color2: {
                        value: new THREE.Color("#2563eb")
                    },
                    color3: {
                        value: new THREE.Color("#1e40af")
                    },
                    color4: {
                        value: new THREE.Color("#2563eb")
                    },
                    color5: {
                        value: new THREE.Color("#3b82f6")
                    },
                    resolution: {type: "v2", value: new THREE.Vector2(w * dpr, h * dpr)},
                    pointSize: {value: pointSize}
                },
                vertexShader: `
                    precision highp float;
                    #define M_PI 3.1415926535897932384626433832795

                    uniform float u_time;
                    uniform float pointSize;

                    void main() {
                        vec3 p = position;
                        p.y += (
                            cos(p.x / M_PI * 8.0 + u_time * 1.5) * 15.0 +
                            sin(p.z / M_PI * 8.0 + u_time * 1.5) * 15.0 +
                            60.0
                        );

                        gl_PointSize = pointSize;
                        gl_Position = projectionMatrix * modelViewMatrix * vec4(p, 1.0);
                    }
                `,
                fragmentShader: `
                    precision highp float;

                    uniform vec3 color1;
                    uniform vec3 color2;
                    uniform vec3 color3;
                    uniform vec3 color4;
                    uniform vec3 color5;
                    uniform vec2 resolution;

                    void main() {
                        if (length(gl_PointCoord - vec2(0.5, 0.5)) > 0.475) discard;

                        float x = gl_FragCoord.x;
                        float step1 = 0.25;
                        float step2 = 0.45;
                        float step3 = 0.55;
                        float step4 = 0.75;
                        float step5 = 1.00;

                        float mixValue = x / resolution.x;

                        vec3 mixedColor;
                        if(mixValue < step1) {
                            mixedColor = mix(color1, color2, mixValue / step1);
                        } else if (mixValue >= step1 && mixValue < step2) {
                            mixedColor = mix(color2, color3, ((mixValue - step1) / (step2 - step1)));
                        } else if (mixValue >= step2 && mixValue < step3) {
                            mixedColor = color3;
                        } else if (mixValue >= step3 && mixValue < step4) {
                            mixedColor = mix(color3, color4, ((mixValue - step3) / (step4 - step3)));
                        } else {
                            mixedColor = mix(color4, color5, ((mixValue - step4) / (step5 - step4)));
                        }

                        gl_FragColor = vec4(mixedColor, 0.6);
                    }
                `,
                transparent: true
            });

            const mesh = new THREE.Points(geo, mat);
            scene.add(mesh);

            function render() {
                const time = clock.getElapsedTime();
                mesh.material.uniforms.u_time.value = time;
                renderer.render(scene, camera);
                requestAnimationFrame(render);
            }

            render();

            function onWindowResize() {
                w = heroBanner.clientWidth;
                h = heroBanner.clientHeight;
                camera.aspect = w / h;
                camera.updateProjectionMatrix();
                renderer.setSize(w, h);
                mesh.material.uniforms.resolution.value = new THREE.Vector2(w * dpr, h * dpr);
            }

            window.addEventListener("resize", onWindowResize);
        };

        window.addEventListener("load", particleWave);
    </script>
@endpush
