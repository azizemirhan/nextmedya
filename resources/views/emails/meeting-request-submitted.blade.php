<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Toplantı Talebi</title>
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
            background: linear-gradient(135deg, #00acc1 0%, #00838f 100%);
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
            background: #00acc1;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .meeting-highlight {
            background: linear-gradient(135deg, #00acc1 0%, #00838f 100%);
            color: white;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .meeting-highlight h2 {
            margin: 0 0 15px 0;
            font-size: 28px;
        }
        .meeting-date {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .meeting-time {
            font-size: 16px;
            opacity: 0.9;
        }
        .info-section {
            background: #f8f9fa;
            border-left: 4px solid #00acc1;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-section h3 {
            margin-top: 0;
            color: #00acc1;
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
            min-width: 180px;
        }
        .info-value {
            color: #212529;
            flex: 1;
        }
        .contact-methods {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .contact-badge {
            display: inline-block;
            padding: 8px 15px;
            background: #e3f2fd;
            color: #00838f;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .cta-button {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #00acc1 0%, #00838f 100%);
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
        .alternative-date {
            background: #fff9e6;
            border: 2px dashed #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
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
            <h1>📅 Yeni Toplantı Talebi</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">{{ config('app.name', 'Next Medya') }}</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <span class="badge">TOPLANTI TALEBİ</span>
            
            <p style="font-size: 16px; margin-top: 0;">
                <strong>{{ $data['name'] }}</strong> sizinle toplantı yapmak istiyor!
            </p>

            <!-- Toplantı Vurgusu -->
            <div class="meeting-highlight">
                <h2>{{ \App\Models\MeetingRequest::$topics[$data['topic']] ?? $data['topic'] }}</h2>
                <div class="meeting-date">
                    📅 {{ \Carbon\Carbon::parse($data['preferred_date'])->locale('tr')->isoFormat('D MMMM YYYY') }}
                </div>
                <div class="meeting-time">
                    🕒 {{ \App\Models\MeetingRequest::$timeSlots[$data['preferred_time']] ?? $data['preferred_time'] }}
                </div>
                @if(isset($data['preferred_time_slot']) && $data['preferred_time_slot'])
                    <div style="margin-top: 10px; opacity: 0.9;">
                        Tercih Edilen Saat: {{ $data['preferred_time_slot'] }}
                    </div>
                @endif
            </div>

            <!-- Alternatif Tarih -->
            @if(isset($data['alternative_date']) && $data['alternative_date'])
                <div class="alternative-date">
                    <strong>🔄 Alternatif Tarih:</strong><br>
                    {{ \Carbon\Carbon::parse($data['alternative_date'])->locale('tr')->isoFormat('D MMMM YYYY') }}
                    @if(isset($data['alternative_time']) && $data['alternative_time'])
                        - {{ \App\Models\MeetingRequest::$timeSlots[$data['alternative_time']] ?? $data['alternative_time'] }}
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
                        <a href="mailto:{{ $data['email'] }}" style="color: #00acc1;">{{ $data['email'] }}</a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telefon:</div>
                    <div class="info-value">
                        <a href="tel:{{ $data['phone'] }}" style="color: #00acc1;">{{ $data['phone'] }}</a>
                    </div>
                </div>
                @if(isset($data['company']) && $data['company'])
                    <div class="info-row">
                        <div class="info-label">Firma:</div>
                        <div class="info-value">{{ $data['company'] }}</div>
                    </div>
                @endif
            </div>

            <!-- Toplantı Detayları -->
            <div class="info-section">
                <h3>📋 Toplantı Detayları</h3>
                <div class="info-row">
                    <div class="info-label">Toplantı Türü:</div>
                    <div class="info-value">
                        <strong>{{ \App\Models\MeetingRequest::$meetingTypes[$data['meeting_type']] ?? $data['meeting_type'] }}</strong>
                    </div>
                </div>
                @if(isset($data['meeting_platform']) && $data['meeting_platform'])
                    <div class="info-row">
                        <div class="info-label">Platform:</div>
                        <div class="info-value">{{ \App\Models\MeetingRequest::$platforms[$data['meeting_platform']] ?? $data['meeting_platform'] }}</div>
                    </div>
                @endif
                <div class="info-row">
                    <div class="info-label">İletişim Yöntemleri:</div>
                    <div class="info-value">
                        <div class="contact-methods">
                            @foreach($data['contact_methods'] as $method)
                                <span class="contact-badge">
                                    {{ \App\Models\MeetingRequest::$contactMethods[$method] ?? $method }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($data['message']) && $data['message'])
                <!-- Ek Notlar -->
                <div class="info-section">
                    <h3>💬 Ek Notlar</h3>
                    <p style="margin: 10px 0 0 0; white-space: pre-wrap; color: #495057;">{{ $data['message'] }}</p>
                </div>
            @endif

            <!-- CTA -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="mailto:{{ $data['email'] }}?subject=Re: Toplantı Talebiniz - {{ \Carbon\Carbon::parse($data['preferred_date'])->format('d.m.Y') }}" class="cta-button">
                    📧 Müşteriye Hemen Yanıt Ver
                </a>
            </div>

            <!-- Google Calendar Link -->
            @php
                $startDate = \Carbon\Carbon::parse($data['preferred_date']);
                $timeMap = ['morning' => '09:00', 'afternoon' => '13:00', 'evening' => '17:00'];
                $startTime = $timeMap[$data['preferred_time']] ?? '09:00';
                $startDateTime = $startDate->format('Y-m-d') . ' ' . $startTime;
                $endDateTime = \Carbon\Carbon::parse($startDateTime)->addHour()->format('Y-m-d H:i');
                
                $calendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
                $calendarUrl .= '&text=' . urlencode('Toplantı: ' . $data['name']);
                $calendarUrl .= '&dates=' . \Carbon\Carbon::parse($startDateTime)->format('Ymd\THis\Z');
                $calendarUrl .= '/' . \Carbon\Carbon::parse($endDateTime)->format('Ymd\THis\Z');
                $calendarUrl .= '&details=' . urlencode('Konu: ' . (\App\Models\MeetingRequest::$topics[$data['topic']] ?? $data['topic']));
            @endphp
            <div style="text-align: center;">
                <a href="{{ $calendarUrl }}" target="_blank" style="color: #00acc1; text-decoration: none; font-size: 14px;">
                    📆 Google Takvime Ekle
                </a>
            </div>

            <!-- Meta Bilgiler -->
            <div class="meta-info">
                <strong>🔍 Teknik Detaylar:</strong><br>
                <strong>Talep ID:</strong> #{{ $data['id'] ?? 'N/A' }}<br>
                <strong>IP Adresi:</strong> {{ $data['ip'] ?? 'Bilinmiyor' }}<br>
                <strong>Tarih:</strong> {{ now()->format('d.m.Y H:i') }}<br>
                <strong>Form Tipi:</strong> Toplantı Talebi (Meeting Request)
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin: 0 0 10px 0;">
                Bu e-posta <strong>{{ config('app.name') }}</strong> toplantı planlama formundan otomatik olarak gönderilmiştir.
            </p>
            <p style="margin: 0; opacity: 0.7;">
                © {{ date('Y') }} {{ config('app.name') }}. Tüm hakları saklıdır.
            </p>
        </div>
    </div>
</body>
</html>