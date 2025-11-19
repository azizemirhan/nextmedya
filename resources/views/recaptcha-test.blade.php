<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCAPTCHA v3 Test</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .info-box h3 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-box p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .info-box code {
            background: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #e83e8c;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .recaptcha-badge {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }

        .recaptcha-badge p {
            color: #999;
            font-size: 12px;
            text-align: center;
        }

        .recaptcha-badge a {
            color: #667eea;
            text-decoration: none;
        }

        .recaptcha-badge a:hover {
            text-decoration: underline;
        }

        .config-status {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
        }

        .config-status h3 {
            color: #0066cc;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .config-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 13px;
        }

        .config-item strong {
            color: #333;
        }

        .config-item span {
            color: #666;
            font-family: 'Courier New', monospace;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-ok {
            background: #d4edda;
            color: #155724;
        }

        .status-error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🛡️ reCAPTCHA v3 Test</h1>
    <p class="subtitle">Laravel CMS reCAPTCHA Entegrasyon Testi</p>

    <div class="config-status">
        <h3>📋 Konfigürasyon Durumu</h3>
        <div class="config-item">
            <strong>Site Key:</strong>
            <span>{{ config('recaptcha.site_key') ? '✅ Ayarlandı' : '❌ Eksik' }}</span>
        </div>
        <div class="config-item">
            <strong>Secret Key:</strong>
            <span>{{ config('recaptcha.secret_key') ? '✅ Ayarlandı' : '❌ Eksik' }}</span>
        </div>
        <div class="config-item">
            <strong>Versiyon:</strong>
            <span>{{ config('recaptcha.version', 'v3') }}</span>
        </div>
        <div class="config-item">
            <strong>Score Threshold:</strong>
            <span>{{ config('recaptcha.score_threshold', 0.5) }}</span>
        </div>
    </div>

    <div class="info-box">
        <h3>ℹ️ Test Bilgileri</h3>
        <p>
            Bu form reCAPTCHA v3 ile korunmaktadır. Form gönderildiğinde,
            Google sizin bir bot olup olmadığınızı kontrol edecek ve 0-1 arası bir skor verecek.
            <br><br>
            <strong>Skor Açıklaması:</strong><br>
            • <code>1.0</code> - Kesinlikle insan<br>
            • <code>0.5</code> - Eşik değeri (varsayılan)<br>
            • <code>0.0</code> - Kesinlikle bot
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success show">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger show">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger show">
            <strong>Hatalar:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="testForm" method="POST" action="{{ route('frontend.contact.submit') }}">
        @csrf

        <div class="form-group">
            <label for="name">Ad Soyad</label>
            <input type="text" id="name" name="name" placeholder="Test Kullanıcı" value="{{ old('name', 'Test Kullanıcı') }}" required>
        </div>

        <div class="form-group">
            <label for="email">E-posta</label>
            <input type="email" id="email" name="email" placeholder="test@example.com" value="{{ old('email', 'test@example.com') }}" required>
        </div>

        <div class="form-group">
            <label for="subject">Konu</label>
            <input type="text" id="subject" name="subject" placeholder="reCAPTCHA Test" value="{{ old('subject', 'reCAPTCHA Test') }}" required>
        </div>

        <div class="form-group">
            <label for="message">Mesaj</label>
            <textarea id="message" name="message" placeholder="Bu bir test mesajıdır..." required>{{ old('message', 'Bu bir reCAPTCHA v3 test mesajıdır. Sistem düzgün çalışıyor.') }}</textarea>
        </div>

        <button type="submit" id="submitBtn">
            🚀 Formu Gönder (reCAPTCHA ile)
        </button>
    </form>

    <div class="recaptcha-badge">
        <p>
            Bu site Google reCAPTCHA ile korunmaktadır.<br>
            <a href="https://policies.google.com/privacy" target="_blank">Gizlilik Politikası</a> ve
            <a href="https://policies.google.com/terms" target="_blank">Hizmet Şartları</a> geçerlidir.
        </p>
    </div>
</div>

{{-- reCAPTCHA v3 Script --}}
{!! recaptcha_script() !!}

{{-- Form Submit Handler --}}
{!! recaptcha_v3('testForm', 'test_form_submit') !!}

<script>
    // Ek submit handling
    document.getElementById('testForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        setTimeout(() => {
            btn.disabled = true;
            btn.innerHTML = '⏳ Gönderiliyor...';
        }, 100);
    });
</script>
</body>
</html>