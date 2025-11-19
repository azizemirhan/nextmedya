{{-- resources/views/mail/newsletter-confirm.blade.php --}}
@component('mail::message')
    # Aboneliğinizi doğrulayın

    Abone olma talebinizi aldık. Lütfen aşağıdaki butona tıklayarak doğrulayın.

    @component('mail::button', ['url' => $confirmUrl])
        Aboneliği Doğrula
    @endcomponent

    Artık e-posta almak istemiyorsanız:
    @component('mail::button', ['url' => $unsubscribeUrl])
        Abonelikten Çık
    @endcomponent

    Teşekkürler,<br>
    {{ config('app.name') }}
@endcomponent
