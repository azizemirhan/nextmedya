<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Hizmet Talebi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 650px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 30px;
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: #667eea;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .info-section {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-section h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 16px;
        }
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 150px;
        }
        .info-value {
            color: #212529;
            flex: 1;
        }
        .package-highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .package-highlight h2 {
            margin: 0 0 10px 0;
            font-size: 28px;
        }
        .package-highlight p {
            margin: 0;
            opacity: 0.9;
        }
        .features-list {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px 20px;
            margin: 15px 0;
        }
        .features-list ul {
            margin: 0;
            padding-left: 20px;
        }
        .features-list li {
            padding: 5px 0;
            color: #495057;
        }
        .cta-button {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .meta-info {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 13px;
            color: #856404;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        @media (max-width: 600px) {
            .info-row {
                flex-direction: column;
            }
            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🎯 Yeni Hizmet Talebi</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">{{ config('app.name', 'Next Medya') }}</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <span class="badge">HİZMET TALEBİ</span>
            
            <p style="font-size: 16px; margin-top: 0;">
                <strong>{{ $data['name'] }}</strong> sitenizden yeni bir hizmet talebi gönderdi!
            </p>

            @if(isset($data['package_type']) && isset($data['package_price']))
                <!-- Paket Vurgusu -->
                <div class="package-highlight">
                    <h2>{{ \App\Models\ServiceRequest::$packageTypes[$data['package_type']] ?? $data['package_type'] }}</h2>
                    <p style="font-size: 18px;">
                        {{ \App\Models\ServiceRequest::$serviceTypes[$data['service_type']] ?? $data['service_type'] }}
                    </p>
                    @if($data['package_price'])
                        <p style="font-size: 24px; font-weight: bold; margin-top: 10px;">
                            ₺{{ number_format($data['package_price'], 2, ',', '.') }}
                        </p>
                    @endif
                </div>
            @endif

            <!-- Müşteri Bilgileri -->
            <div class="info-section">
                <h3>👤 Müşteri Bilgileri</h3>
                <div class="info-row">
                    <div class="info-label">Ad Soyad:</div>
                    <div class="info-value"><strong>{{ $data['name'] }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">E-posta:</div>
                    <div class="info-value">
                        <a href="mailto:{{ $data['email'] }}" style="color: #667eea;">{{ $data['email'] }}</a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telefon:</div>
                    <div class="info-value">
                        <a href="tel:{{ $data['phone'] }}" style="color: #667eea;">{{ $data['phone'] }}</a>
                    </div>
                </div>
                @if(isset($data['company']) && $data['company'])
                    <div class="info-row">
                        <div class="info-label">Firma:</div>
                        <div class="info-value">{{ $data['company'] }}</div>
                    </div>
                @endif
            </div>

            <!-- Hizmet Detayları -->
            <div class="info-section">
                <h3>🎨 Hizmet Detayları</h3>
                <div class="info-row">
                    <div class="info-label">Hizmet Türü:</div>
                    <div class="info-value">
                        <strong>{{ \App\Models\ServiceRequest::$serviceTypes[$data['service_type']] ?? $data['service_type'] }}</strong>
                    </div>
                </div>
                @if(isset($data['package_type']))
                    <div class="info-row">
                        <div class="info-label">Paket:</div>
                        <div class="info-value">{{ \App\Models\ServiceRequest::$packageTypes[$data['package_type']] ?? $data['package_type'] }}</div>
                    </div>
                @endif
                @if(isset($data['budget_range']) && $data['budget_range'])
                    <div class="info-row">
                        <div class="info-label">Bütçe:</div>
                        <div class="info-value">{{ $data['budget_range'] }}</div>
                    </div>
                @endif
                @if(isset($data['timeline']) && $data['timeline'])
                    <div class="info-row">
                        <div class="info-label">Zaman Çizelgesi:</div>
                        <div class="info-value">{{ $data['timeline'] }}</div>
                    </div>
                @endif
            </div>

            @if(isset($data['selected_features']) && count($data['selected_features']) > 0)
                <!-- Seçilen Özellikler -->
                <div class="features-list">
                    <h4 style="margin-top: 0; color: #495057;">✓ Seçilen Özellikler:</h4>
                    <ul>
                        @foreach($data['selected_features'] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(isset($data['project_details']) && $data['project_details'])
                <!-- Proje Detayları -->
                <div class="info-section">
                    <h3>📝 Proje Detayları</h3>
                    <p style="margin: 10px 0 0 0; white-space: pre-wrap; color: #495057;">{{ $data['project_details'] }}</p>
                </div>
            @endif

            <!-- CTA -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="mailto:{{ $data['email'] }}?subject=Re: Hizmet Talebiniz Hakkında" class="cta-button">
                    📧 Müşteriye Hemen Yanıt Ver
                </a>
            </div>

            <!-- Meta Bilgiler -->
            <div class="meta-info">
                <strong>🔍 Teknik Detaylar:</strong><br>
                <strong>Talep ID:</strong> #{{ $data['id'] ?? 'N/A' }}<br>
                <strong>IP Adresi:</strong> {{ $data['ip'] ?? 'Bilinmiyor' }}<br>
                <strong>Tarih:</strong> {{ now()->format('d.m.Y H:i') }}<br>
                <strong>Form Tipi:</strong> Hizmet Talebi (Service Request)
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin: 0 0 10px 0;">
                Bu e-posta <strong>{{ config('app.name') }}</strong> hizmet talep formundan otomatik olarak gönderilmiştir.
            </p>
            <p style="margin: 0; opacity: 0.7;">
                © {{ date('Y') }} {{ config('app.name') }}. Tüm hakları saklıdır.
            </p>
        </div>
    </div>
</body>
</html>