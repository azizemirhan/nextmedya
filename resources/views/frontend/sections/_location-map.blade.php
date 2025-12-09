@php
    $mapUrl = data_get($content, 'map_embed_url', 'https://maps.google.com/maps?width=100%25&height=600&hl=en&q=Ankara&t=&z=14&ie=UTF8&iwloc=B&output=embed');
@endphp

<div class="contact-map">
    <iframe src="{{ $mapUrl }}" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
