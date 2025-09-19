@extends('admin.layouts.master')

@section('title', $account->name . ' | Account')

@section('content')

    @php
        // JSON alanları güvenli çözümle
        $emails = is_array($account->emails) ? $account->emails : [];
        $phones = is_array($account->phones) ? $account->phones : [];
        $addresses = is_array($account->addresses) ? $account->addresses : [];
        $socials = is_array($account->socials) ? $account->socials : [];
        $custom = is_array($account->custom_fields) ? $account->custom_fields : [];

        // Yardımcılar
        $fmtEmail = function ($em) {
            if (is_string($em)) {
                return $em;
            }
            return trim(($em['value'] ?? '') . ' ' . (!empty($em['label']) ? '(' . $em['label'] . ')' : ''));
        };
        $fmtPhone = function ($ph) {
            if (is_string($ph)) {
                return $ph;
            }
            $num = $ph['number'] ?? '';
            $lbl = $ph['label'] ?? '';
            $cc = $ph['country'] ?? '';
            return trim(($cc ? $cc . ' ' : '') . $num . ' ' . ($lbl ? "($lbl)" : ''));
        };
        $fmtAddr = function ($a) {
            if (!is_array($a)) {
                return $a;
            }
            $lines = isset($a['lines']) && is_array($a['lines']) ? implode(', ', $a['lines']) : '';
            $parts = array_filter([
                $lines,
                $a['district'] ?? null,
                $a['city'] ?? null,
                $a['zip'] ?? null,
                $a['country'] ?? null,
            ]);
            return implode(' • ', $parts);
        };
    @endphp

    <div class="row invoice layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="doc-container">

                <div class="row">
                    <div class="col-xl-9">
                        <div class="invoice-container">
                            <div class="invoice-inbox">
                                <div id="ct" class="">
                                    <div class="invoice-00001">
                                        <div class="content-section">

                                            {{-- HEADER --}}
                                            <div class="inv--head-section inv--detail-section">
                                                <div class="row">
                                                    <div class="col-sm-6 col-12 mr-auto">
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if ($account->logo_path)
                                                                <img class="company-logo"
                                                                    src="{{ asset($account->logo_path) }}" alt="logo" width="200px">
                                                            @else
                                                                <img class="company-logo"
                                                                    src="https://via.placeholder.com/120x40?text=LOGO"
                                                                    alt="logo">
                                                            @endif
                                                            <h3 class="in-heading align-self-center mb-0">
                                                                {{ $account->name }}</h3>
                                                        </div>

                                                        @if ($account->website)
                                                            <p class="inv-street-addr mt-3"><a
                                                                    href="{{ $account->website }}"
                                                                    target="_blank">{{ $account->website }}</a></p>
                                                        @endif

                                                        {{-- Birincil e-posta/telefon (virtual kolonlar varsa onları yaz, yoksa ilk elemanı yaz) --}}
                                                        <p class="inv-email-address">
                                                            {{ $account->primary_email ?? ($emails[0]['value'] ?? ($emails[0] ?? '-')) }}
                                                        </p>
                                                        <p class="inv-email-address">
                                                            {{ $account->primary_phone ?? ($phones[0]['number'] ?? ($phones[0] ?? '-')) }}
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-6 text-sm-end">
                                                        {{-- Durum & Lifecycle & Sahip --}}
                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4">
                                                            <span class="inv-title">Durum : </span>
                                                            <span class="inv-number">{{ ucfirst($account->status) }}</span>
                                                        </p>
                                                        <p class="inv-created-date mt-sm-3 mt-3">
                                                            <span class="inv-title">Lifecycle : </span>
                                                            <span
                                                                class="inv-date">{{ ucfirst($account->lifecycle_stage) }}</span>
                                                        </p>
                                                        <p class="inv-due-date">
                                                            <span class="inv-title">Sahip : </span>
                                                            <span class="inv-date">{{ $account->owner->name ?? '-' }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- MÜŞTERİ DETAYI BLOĞU (Bizde: Şirket & İletişim) --}}
                                            <div class="inv--detail-section inv--customer-detail-section">
                                                <div class="row">
                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                        <p class="inv-to">Şirket Bilgileri</p>
                                                    </div>
                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                        <h6 class="inv-title">Özet</h6>
                                                    </div>

                                                    {{-- Sol: Şirket kimlik/iletişim --}}
                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                        <p class="inv-customer-name">
                                                            {{ $account->legal_name ?: $account->name }}</p>
                                                        @if (count($addresses))
                                                            <p class="inv-street-addr">{{ $fmtAddr($addresses[0]) }}</p>
                                                        @endif

                                                        {{-- Tüm e-postalar --}}
                                                        @if (count($emails))
                                                            @foreach ($emails as $em)
                                                                <p class="inv-email-address">{{ $fmtEmail($em) }}</p>
                                                            @endforeach
                                                        @endif
                                                        {{-- Tüm telefonlar --}}
                                                        @if (count($phones))
                                                            @foreach ($phones as $ph)
                                                                <p class="inv-email-address">{{ $fmtPhone($ph) }}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    {{-- Sağ: Özet kutuları --}}
                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                        <p class="inv-customer-name">Sektör:
                                                            {{ $account->industry ?? '-' }}</p>
                                                        <p class="inv-street-addr">Çalışan:
                                                            {{ $account->employee_count ?? '-' }}</p>
                                                        <p class="inv-email-address">Ciro:
                                                            {{ $account->annual_revenue ? number_format($account->annual_revenue, 0, ',', '.') : '-' }}
                                                        </p>
                                                        <p class="inv-email-address">Skor: {{ $account->score }}</p>
                                                        <p class="inv-email-address">Kaynak: {{ $account->source ?? '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- ÜRÜN TABLOSU ALANI → Bizde JSON/Custom & Socials gösterimi --}}
                                            <div class="inv--product-table-section">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Alan</th>
                                                                <th class="text-end">Değer</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- Adresler --}}
                                                            @if (count($addresses))
                                                                @foreach ($addresses as $i => $addr)
                                                                    <tr>
                                                                        <td>{{ $i + 1 }}</td>
                                                                        <td>Adres {{ $addr['type'] ?? '' }}</td>
                                                                        <td class="text-end">{{ $fmtAddr($addr) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                            {{-- Socials --}}
                                                            @if (count($socials))
                                                                @foreach ($socials as $key => $val)
                                                                    <tr>
                                                                        <td>—</td>
                                                                        <td>Sosyal: {{ ucfirst($key) }}</td>
                                                                        <td class="text-end">
                                                                            @if (is_string($val) && str_starts_with($val, 'http'))
                                                                                <a href="{{ $val }}"
                                                                                    target="_blank">{{ $val }}</a>
                                                                            @else
                                                                                {{ is_scalar($val) ? $val : json_encode($val) }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                            {{-- Custom Fields --}}
                                                            @if (count($custom))
                                                                @foreach ($custom as $key => $val)
                                                                    <tr>
                                                                        <td>—</td>
                                                                        <td>Özel Alan: {{ $key }}</td>
                                                                        <td class="text-end">
                                                                            {{ is_scalar($val) ? $val : json_encode($val, JSON_UNESCAPED_UNICODE) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- TARİHLER / NOT --}}
                                            <div class="inv--total-amounts">
                                                <div class="row mt-4">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                        {{-- boş alan (tasarımı korumak için) --}}
                                                    </div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="text-sm-end">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Son Temas :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">
                                                                        {{ $account->last_contacted_at?->format('d.m.Y H:i') ?? '-' }}
                                                                    </p>
                                                                </div>

                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Sonraki Aktivite :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">
                                                                        {{ $account->next_activity_at?->format('d.m.Y H:i') ?? '-' }}
                                                                    </p>
                                                                </div>

                                                                <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                                    <h4 class="">Notlar : </h4>
                                                                </div>
                                                                <div class="col-sm-4 col-5 grand-total-amount mt-3">
                                                                    <h4 class="">&nbsp;</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($account->internal_notes)
                                                <div class="inv--note">
                                                    <div class="row mt-4">
                                                        <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                            <p>{{ $account->internal_notes }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div> {{-- /invoice-inbox --}}
                        </div>
                    </div>

                    {{-- Sağ Aksiyonlar --}}
                    <div class="col-xl-3">
                        <div class="invoice-actions-btn">
                            <div class="invoice-action-btn">
                                <div class="row g-2">
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="{{ route('admin.accounts.edit', $account) }}"
                                            class="btn btn-dark btn-edit _effect--ripple waves-effect waves-light w-100">Düzenle</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <button type="button" onclick="window.print();"
                                            class="btn btn-secondary btn-print action-print _effect--ripple waves-effect waves-light w-100">Yazdır</button>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        {{-- PDF export route'un varsa buraya bağla --}}
                                        <a href="{{ route('admin.accounts.index') }}"
                                            class="btn btn-success btn-download _effect--ripple waves-effect waves-light w-100">Listeye
                                            Dön</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <form action="{{ route('admin.accounts.destroy', $account) }}" method="POST"
                                            onsubmit="return confirm('Silmek istiyor musunuz?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger w-100">Sil (Soft Delete)</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- /Sağ sütun --}}
                </div>

            </div>
        </div>
    </div>
@endsection
