@php
    $locale = app()->getLocale();

    // Temel meta tags
    $title = $page->getTranslation('seo_title', $locale) ?: $page->getTranslation('title', $locale);
    $description = $page->getTranslation('meta_description', $locale);
    $keywords = $page->getTranslation('keywords', $locale);
    $canonical = $page->canonical_url ?: route('frontend.page.show', $page->slug);
    $image = $page->og_image ? asset($page->og_image) : asset('images/default-og.jpg');

    // Open Graph
    $ogTitle = $page->getTranslation('og_title', $locale) ?: $title;
    $ogDescription = $page->getTranslation('og_description', $locale) ?: $description;
    $ogImage = $page->og_image ? asset($page->og_image) : $image;

    // Twitter Card
    $twitterTitle = $page->getTranslation('twitter_title', $locale) ?: $title;
    $twitterDescription = $page->getTranslation('twitter_description', $locale) ?: $description;
    $twitterImage = $page->twitter_image ? asset($page->twitter_image) : $ogImage;

    // Meta Robots
    $robots = [];
    if ($page->meta_noindex) $robots[] = 'noindex';
    if ($page->meta_nofollow) $robots[] = 'nofollow';
    if ($page->meta_noarchive) $robots[] = 'noarchive';
    if ($page->meta_nosnippet) $robots[] = 'nosnippet';
    if ($page->meta_max_snippet) $robots[] = 'max-snippet:' . $page->meta_max_snippet;
    if ($page->meta_max_image_preview) $robots[] = 'max-image-preview:' . $page->meta_max_image_preview;
    $robotsContent = !empty($robots) ? implode(', ', $robots) : 'index, follow';
@endphp

{{-- Temel Meta Tags --}}
<title>{{ $title }} | {{ config('app.name') }}</title>
<meta name="description" content="{{ $description }}">
@if($keywords)
    <meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robotsContent }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="publish_date" property="og:publish_date" content="{{ $page->created_at->toIso8601String() }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="{{ $locale === 'tr' ? 'tr_TR' : 'en_US' }}">
<meta property="og:updated_time" content="{{ $page->updated_at->toIso8601String() }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="{{ $page->twitter_card_type ?? 'summary_large_image' }}">
<meta name="twitter:url" content="{{ $canonical }}">
<meta name="twitter:title" content="{{ $twitterTitle }}">
<meta name="twitter:description" content="{{ $twitterDescription }}">
<meta name="twitter:image" content="{{ $twitterImage }}">
@if(config('services.twitter.site'))
    <meta name="twitter:site" content="{{ config('services.twitter.site') }}">
@endif
@if(config('services.twitter.creator'))
    <meta name="twitter:creator" content="{{ config('services.twitter.creator') }}">
@endif

{{-- Schema.org JSON-LD --}}
@php
    $schemaService = app(\App\Services\SchemaGeneratorService::class);
    $schema = $schemaService->generate($page, $locale);
@endphp

@if($schema)
    {!! $schemaService->toScriptTag($schema) !!}
@endif

{{-- Additional Meta for Google --}}
<meta name="google" content="nositelinkssearchbox">
<meta name="google" content="notranslate">
