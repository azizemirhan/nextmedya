<!DOCTYPE html>
<html lang="tr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Panel - Giriş</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            background: #0a0a0a;
        }

        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .login-container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo h1 {
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
        }

        .logo p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .input-wrapper input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .remember-me label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            cursor: pointer;
            margin: 0;
        }

        .forgot-password {
            color: #6366f1;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #818cf8;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: rgba(255, 255, 255, 0.4);
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }

        .social-login {
            display: flex;
            gap: 15px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .signup-link a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #818cf8;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 40px 30px;
            }

            .logo h1 {
                font-size: 28px;
            }
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .input-wrapper input {
            padding-left: 45px !important;
            padding-right: 45px !important;
        }

        .input-wrapper input:focus + .input-icon {
            color: #6366f1;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #6366f1;
        }

        /* Error Text */
        .error-text {
            display: block;
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            margin-left: 5px;
            min-height: 18px;
        }

        .input-wrapper input.error {
            border-color: #ef4444 !important;
            animation: shake 0.3s;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-10px);
            }
            75% {
                transform: translateX(10px);
            }
        }

        /* Button Loader */
        .spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Alert Styles */
        .alert {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div id="canvas-container"></div>

<div class="login-container">
    <div class="login-box">
        <div class="logo">
            <h1>Admin Panel</h1>
            <p>Kontrol panelinize hoş geldiniz</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
            @csrf

            <!-- Hata Mesajları İçin Alan -->
            <div id="errorMessages" class="alert alert-danger"
                 style="display: none; border-radius: 10px; margin-bottom: 20px;">
                <ul id="errorList" style="margin: 0; padding-left: 20px;"></ul>
            </div>

            <div class="form-group">
                <label for="email">E-posta Adresi</label>
                <div class="input-wrapper">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="ornek@email.com"
                        required
                    />
                    <span class="input-icon">
                        <i class="bi bi-envelope"></i>
                    </span>
                </div>
                <span class="error-text" id="email-error"></span>
            </div>

            <div class="form-group">
                <label for="password">Şifre</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    />
                    <span class="input-icon">
                        <i class="bi bi-lock"></i>
                    </span>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </span>
                </div>
                <span class="error-text" id="password-error"></span>
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Beni Hatırla</label>
                </div>
                <a href="#" class="forgot-password">Şifremi Unuttum?</a>
            </div>

            <button type="submit" class="login-btn" id="loginBtn">
                <span class="btn-text">Giriş Yap</span>
                <span class="btn-loader" style="display: none;">
                    <i class="bi bi-arrow-clockwise spinner"></i> Giriş yapılıyor...
                </span>
            </button>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    // Three.js Scene Setup
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
    );
    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true,
    });

    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    document
        .getElementById("canvas-container")
        .appendChild(renderer.domElement);

    // Create Particles
    const particlesGeometry = new THREE.BufferGeometry();
    const particlesCount = 3000;
    const posArray = new Float32Array(particlesCount * 3);

    for (let i = 0; i < particlesCount * 3; i++) {
        posArray[i] = (Math.random() - 0.5) * 100;
    }

    particlesGeometry.setAttribute(
        "position",
        new THREE.BufferAttribute(posArray, 3)
    );

    const particlesMaterial = new THREE.PointsMaterial({
        size: 0.15,
        color: 0x6366f1,
        transparent: true,
        opacity: 0.8,
        blending: THREE.AdditiveBlending,
    });

    const particlesMesh = new THREE.Points(
        particlesGeometry,
        particlesMaterial
    );
    scene.add(particlesMesh);

    // Create Glowing Spheres
    const sphereGeometry = new THREE.SphereGeometry(1, 32, 32);
    const spheres = [];

    for (let i = 0; i < 5; i++) {
        const material = new THREE.MeshBasicMaterial({
            color: Math.random() > 0.5 ? 0x6366f1 : 0x8b5cf6,
            transparent: true,
            opacity: 0.3,
        });
        const sphere = new THREE.Mesh(sphereGeometry, material);
        sphere.position.set(
            (Math.random() - 0.5) * 30,
            (Math.random() - 0.5) * 30,
            (Math.random() - 0.5) * 30
        );
        sphere.userData.velocity = {
            x: (Math.random() - 0.5) * 0.02,
            y: (Math.random() - 0.5) * 0.02,
            z: (Math.random() - 0.5) * 0.02,
        };
        spheres.push(sphere);
        scene.add(sphere);
    }

    camera.position.z = 30;

    // Mouse Movement
    let mouseX = 0;
    let mouseY = 0;

    document.addEventListener("mousemove", (e) => {
        mouseX = (e.clientX / window.innerWidth) * 2 - 1;
        mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
    });

    // Animation Loop
    function animate() {
        requestAnimationFrame(animate);

        // Rotate particles
        particlesMesh.rotation.y += 0.001;
        particlesMesh.rotation.x += 0.0005;

        // Move spheres
        spheres.forEach((sphere) => {
            sphere.position.x += sphere.userData.velocity.x;
            sphere.position.y += sphere.userData.velocity.y;
            sphere.position.z += sphere.userData.velocity.z;

            if (Math.abs(sphere.position.x) > 15)
                sphere.userData.velocity.x *= -1;
            if (Math.abs(sphere.position.y) > 15)
                sphere.userData.velocity.y *= -1;
            if (Math.abs(sphere.position.z) > 15)
                sphere.userData.velocity.z *= -1;

            sphere.rotation.x += 0.01;
            sphere.rotation.y += 0.01;
        });

        // Camera follow mouse
        camera.position.x += (mouseX * 5 - camera.position.x) * 0.05;
        camera.position.y += (mouseY * 5 - camera.position.y) * 0.05;
        camera.lookAt(scene.position);

        renderer.render(scene, camera);
    }

    animate();

    // Handle Window Resize
    window.addEventListener("resize", () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

</script>
<script>
    $(document).ready(function () {
        // CSRF Token Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Form Submit Event
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            // Hataları temizle
            clearErrors();

            // Butonu devre dışı bırak
            const $btn = $('#loginBtn');
            $btn.prop('disabled', true);
            $('.btn-text').hide();
            $('.btn-loader').show();

            // Form verilerini al
            const formData = {
                email: $('#email').val(),
                password: $('#password').val(),
                remember: $('#remember').is(':checked') ? 1 : 0
            };

            // AJAX Request
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    // Başarılı giriş
                    Swal.fire({
                        icon: 'success',
                        title: 'Giriş Başarılı!',
                        text: response.message || 'Yönlendiriliyorsunuz...',
                        timer: 1500,
                        showConfirmButton: false,
                        background: 'rgba(255, 255, 255, 0.95)',
                        backdrop: 'rgba(0, 0, 0, 0.4)',
                        iconColor: '#10b981'
                    }).then(() => {
                        // Dashboard'a yönlendir
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            window.location.href = "{{ route('admin.dashboard') }}";
                        }
                    });
                },
                error: function (xhr) {
                    // Butonu tekrar aktif et
                    $btn.prop('disabled', false);
                    $('.btn-text').show();
                    $('.btn-loader').hide();

                    if (xhr.status === 422) {
                        // Validasyon hataları
                        const errors = xhr.responseJSON.errors;
                        displayErrors(errors);

                        Swal.fire({
                            icon: 'warning',
                            title: 'Eksik Bilgiler!',
                            text: 'Lütfen tüm alanları doğru şekilde doldurun.',
                            confirmButtonColor: '#6366f1',
                            background: 'rgba(255, 255, 255, 0.95)',
                            backdrop: 'rgba(0, 0, 0, 0.4)'
                        });
                    } else if (xhr.status === 401) {
                        // Giriş başarısız - Hatalı email veya şifre
                        const message = xhr.responseJSON.message || 'E-posta veya şifre hatalı.';

                        Swal.fire({
                            icon: 'error',
                            title: 'Giriş Başarısız!',
                            text: message,
                            confirmButtonColor: '#6366f1',
                            background: 'rgba(255, 255, 255, 0.95)',
                            backdrop: 'rgba(0, 0, 0, 0.4)'
                        });

                        // Email ve şifre alanlarını vurgula
                        $('#email, #password').addClass('error');
                        $('#email-error').text('E-posta veya şifre hatalı.');
                    } else if (xhr.status === 403) {
                        // Admin yetkisi yok
                        const message = xhr.responseJSON.message || 'Bu hesap admin yetkisine sahip değil.';

                        Swal.fire({
                            icon: 'warning',
                            title: 'Yetkisiz Erişim!',
                            text: message,
                            confirmButtonColor: '#6366f1',
                            background: 'rgba(255, 255, 255, 0.95)',
                            backdrop: 'rgba(0, 0, 0, 0.4)'
                        });
                    } else {
                        // Diğer hatalar
                        Swal.fire({
                            icon: 'error',
                            title: 'Bir Hata Oluştu!',
                            text: 'Lütfen daha sonra tekrar deneyin.',
                            confirmButtonColor: '#6366f1',
                            background: 'rgba(255, 255, 255, 0.95)',
                            backdrop: 'rgba(0, 0, 0, 0.4)'
                        });
                    }
                }
            });
        });

        // Input Focus Events
        $('input').on('focus', function () {
            $(this).removeClass('error');
            $(this).closest('.form-group').find('.error-text').text('');
        });

        // Email Validation on Blur
        $('#email').on('blur', function () {
            const email = $(this).val();
            if (email && !isValidEmail(email)) {
                $(this).addClass('error');
                $('#email-error').text('Geçerli bir e-posta adresi girin.');
            }
        });

        // Password Strength Indicator
        $('#password').on('input', function () {
            const password = $(this).val();
            if (password.length > 0 && password.length < 6) {
                $('#password-error').text('Şifre en az 6 karakter olmalıdır.');
            } else {
                $('#password-error').text('');
                $(this).removeClass('error');
            }
        });

        // Enter tuşu ile form submit
        $('input').on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#loginForm').submit();
            }
        });
    });

    // Hataları göster
    function displayErrors(errors) {
        $('#errorMessages').show();
        const $errorList = $('#errorList');
        $errorList.empty();

        $.each(errors, function (field, messages) {
            // Her bir hata mesajını listele
            $.each(messages, function (index, message) {
                $errorList.append('<li>' + message + '</li>');
            });

            // İlgili input'u vurgula
            const $input = $('[name="' + field + '"]');
            $input.addClass('error');
            $('#' + field + '-error').text(messages[0]);
        });

        // Hata mesajına scroll
        $('html, body').animate({
            scrollTop: $('#errorMessages').offset().top - 100
        }, 300);
    }

    // Hataları temizle
    function clearErrors() {
        $('#errorMessages').hide();
        $('#errorList').empty();
        $('.error-text').text('');
        $('input').removeClass('error');
    }

    // Email validasyonu
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Şifre göster/gizle
    function togglePassword() {
        const passwordInput = $('#password');
        const toggleIcon = $('#toggleIcon');

        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            toggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            toggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    }
</script>
</body>
</html>
