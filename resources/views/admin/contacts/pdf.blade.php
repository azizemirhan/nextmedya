<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $contact->first_name }} {{ $contact->last_name }} - Kişi Detayları</title>
    <style>
        /* ---------- Temel Ayarlar ---------- */
        @page {
            margin: 28mm 18mm 22mm 18mm;
        }

        html, body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
            background: #fff;
        }

        .page-container {
            page-break-inside: avoid;
        }

        /* ---------- Başlık Şeridi ---------- */
        .header {
            font-size: 22px;
            font-weight: 700;
            padding-bottom: 8px;
            margin-bottom: 14px;
            border-bottom: 2px solid #0f62fe; /* Kurumsal vurgulu çizgi */
        }

        .subtext {
            color: #555;
            font-size: 12px;
        }

        /* ---------- Grid / Kart ---------- */
        .grid {
            width: 100%;
        }

        .col {
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
        }

        .col-6 {
            width: 49.5%;
        }

        .col-12 {
            width: 100%;
        }

        .card {
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
            background: #fafafa;
        }

        .section-title {
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .2px;
            margin: 0 0 8px 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #e6e6e6;
        }

        /* ---------- Alan Satırları ---------- */
        .row {
            margin: 0 0 6px 0;
        }

        .label {
            color: #666;
            width: 30%;
            display: inline-block;
        }

        .value {
            font-weight: 600;
            color: #111;
            display: inline-block;
            width: 69%;
        }

        .muted {
            color: #999;
        }

        /* ---------- Chip/Badeg ---------- */
        .chip {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            border: 1px solid #e0e0e0;
            background: #fff;
            margin: 2px 6px 2px 0;
            font-size: 11px;
        }

        .chip .k {
            color: #666;
            font-weight: 600;
        }

        .chip .v {
            color: #111;
            font-weight: 700;
        }

        /* ---------- Liste ---------- */
        .list-item {
            margin: 0 0 6px 0;
        }

        /* ---------- Footer: logo + şirket adı (sabit) ---------- */
        .brand-footer {
            position: fixed;
            right: 18mm;
            bottom: 12mm;
            text-align: right;
        }

        .brand-footer .name {
            font-size: 11px;
            color: #444;
            margin-top: 4px;
            font-weight: 700;
        }

        .brand-footer img {
            max-width: 110px;
            height: auto;
        }

        /* ---------- Sayfa numarası ---------- */
        .page-num {
            position: fixed;
            left: 18mm;
            bottom: 12mm;
            color: #777;
            font-size: 11px;
        }

        /* ---------- Tablo benzeri (mpdf/dompdf güvenli) ---------- */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #e6e6e6;
            padding: 6px 8px;
            font-size: 12px;
        }

        .table th {
            background: #f3f6ff;
            text-align: left;
            font-weight: 700;
            color: #0f2d6b;
        }
    </style>
</head>
<body>
<div class="page-container">
    <!-- Başlık -->
    <div class="header">
        {{ $contact->first_name }} {{ $contact->last_name }} — Kişi Detayları
        @if($contact->account?->name)
            <div class="subtext">{{ $contact->account->name }}</div>
        @endif
    </div>

    <!-- Temel Bilgiler -->
    <div class="card">
        <div class="section-title">Temel Bilgiler</div>
        <div class="row">
            <span class="label">Unvan</span>
            <span class="value">{{ $contact->job_title ?: '—' }}</span>
        </div>
        <div class="row">
            <span class="label">Departman</span>
            <span class="value">{{ $contact->department ?: '—' }}</span>
        </div>
        <div class="row">
            <span class="label">Birincil E-posta</span>
            <span class="value">{{ $contact->primary_email ?: '—' }}</span>
        </div>
        <div class="row">
            <span class="label">Birincil Telefon</span>
            <span class="value">{{ $contact->primary_phone ?: '—' }}</span>
        </div>
        <div class="row">
            <span class="label">Kaynak</span>
            <span class="value">{{ $contact->source ?: '—' }}</span>
        </div>
        <div class="row">
            <span class="label">Skor</span>
            <span class="value">{{ $contact->score !== null ? $contact->score : '—' }}</span>
        </div>
        <div class="row">
            <span class="label">İzinler</span>
            <span class="value">
                    <span class="chip"><span class="k">Karar Verici:</span> <span
                            class="v">{{ $contact->is_decision_maker ? 'Evet' : 'Hayır' }}</span></span>
                    <span class="chip"><span class="k">E-posta İzni:</span> <span
                            class="v">{{ $contact->consent_email ? 'Var' : 'Yok' }}</span></span>
                    <span class="chip"><span class="k">SMS İzni:</span> <span
                            class="v">{{ $contact->consent_sms ? 'Var' : 'Yok' }}</span></span>
                </span>
        </div>
    </div>

    <!-- E-postalar -->
    @php
        $emails = is_array($contact->emails) ? $contact->emails : (json_decode($contact->emails ?? '[]', true) ?: []);
        $phones = is_array($contact->phones) ? $contact->phones : (json_decode($contact->phones ?? '[]', true) ?: []);
    @endphp

    @if(count($emails))
        <div class="card">
            <div class="section-title">E-posta Adresleri</div>
            <table class="table">
                <thead>
                <tr>
                    <th>Adres</th>
                    <th>Etiket</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emails as $email)
                    <tr>
                        <td>{{ $email['value'] ?? '' }}</td>
                        <td>{{ $email['label'] ?? 'Diğer' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Telefonlar -->
    @if(count($phones))
        <div class="card">
            <div class="section-title">Telefon Numaraları</div>
            <table class="table">
                <thead>
                <tr>
                    <th>Numara</th>
                    <th>Etiket</th>
                </tr>
                </thead>
                <tbody>
                @foreach($phones as $phone)
                    <tr>
                        <td>{{ $phone['number'] ?? '' }}</td>
                        <td>{{ $phone['label'] ?? 'Diğer' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Sağ-alt köşe: logo + şirket adı -->
<div class="brand-footer">
    <img src="{{ asset('2-3.png') }}" alt="Next Medya Logo">
    <div class="name">Next Medya ve Yazılım Ajansı</div>
</div>

<!-- Sol-alt köşe: sayfa numarası (mpdf/dompdf ikisi de destekler) -->
<div class="page-num">
    Sayfa {PAGE_NUM} / {PAGE_COUNT}
</div>
</body>
</html>
