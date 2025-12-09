<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni İletişim Formu Mesajı</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #667eea;
            min-width: 120px;
        }
        .info-value {
            color: #495057;
            flex: 1;
        }
        .message-box {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .message-label {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            background: #e7f3ff;
            color: #0066cc;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 5px;
        }
        .meta-info {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 12px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 12px;
            color: #856404;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            .email-body {
                padding: 20px;
            }
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
            <h1>🔔 Yeni İletişim Formu Mesajı</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">nextmedya.com</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p style="margin-top: 0; font-size: 16px; color: #212529;">
                Merhaba, <strong>sitenizden yeni bir iletişim formu mesajı aldınız!</strong>
            </p>

            <!-- İletişim Bilgileri -->
            <div class="info-box">
                <div class="info-row">
                    <div class="info-label">👤 Ad Soyad:</div>
                    <div class="info-value"><strong>{{ $data['name'] }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">📧 E-posta:</div>
                    <div class="info-value">
                        <a href="mailto:{{ $data['email'] }}" style="color: #667eea; text-decoration: none;">
                            {{ $data['email'] }}
                        </a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">📋 Konu:</div>
                    <div class="info-value">{{ $data['subject'] ?? 'Belirtilmemiş' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">📅 Tarih:</div>
                    <div class="info-value">{{ now()->format('d.m.Y H:i') }}</div>
                </div>
            </div>

            <!-- Mesaj İçeriği -->
            <div class="message-box">
                <div class="message-label">💬 Mesaj İçeriği:</div>
                <div style="color: #212529; line-height: 1.8;">{{ $data['message'] }}</div>
            </div>

            <!-- Meta Bilgiler -->
            <div class="meta-info">
                <strong>🔍 Teknik Detaylar:</strong><br>
                <strong>IP Adresi:</strong> {{ $data['ip'] ?? 'Bilinmiyor' }}<br>
                <strong>Tarayıcı:</strong> {{ Str::limit($data['ua'] ?? 'Bilinmiyor', 100) }}<br>
                <strong>Kaynak:</strong> Website İletişim Formu
            </div>

            <!-- CTA Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="mailto:{{ $data['email'] }}?subject=Re: {{ urlencode($data['subject'] ?? 'İletişim Formu') }}" 
                   style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600;">
                    📩 Yanıtla
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin: 0 0 10px 0;">
                Bu e-posta <strong>{{ config('app.name', 'Next Medya') }}</strong> web sitesi iletişim formundan otomatik olarak gönderilmiştir.
            </p>
            <p style="margin: 0; opacity: 0.7;">
                © {{ date('Y') }} {{ config('app.name') }}. Tüm hakları saklıdır.
            </p>
        </div>
    </div>
</body>
</html>