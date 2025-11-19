{{-- resources/views/mail/contact-submitted.blade.php --}}
@component('mail::message')
    # Yeni İletişim Mesajı

    **Ad Soyad:** {{ $payload['name'] }}

    **E-posta:** {{ $payload['email'] }}

    **Konu:** {{ $payload['subject'] }}

    **Mesaj:**
    > {!! nl2br(e($payload['message'])) !!}

    @component('mail::subcopy')
        IP: {{ $payload['ip'] ?? '-' }}
        UA: {{ $payload['ua'] ?? '-' }}
    @endcomponent
@endcomponent
