@php
    $locale = app()->getLocale();
    
    // Temel meta tags
    $title = $post->getTranslation('seo_title', $locale) ?: $post->getTranslation('title', $locale);
    $description = $post->getTranslation('meta_description', $locale) ?: $post->getTranslation('excerpt', $locale);
    $keywords = $post->getTranslation('keywords', $locale);
    $canonical = $post->canonical_url ?: route('blog.show', $post->slug);
    $image = $post->featured_image ? asset($post->featured_image) : asset('images/default-og.jpg');
    
    // Open Graph
    $ogTitle = $post->getTranslation('og_title', $locale) ?: $title;
    $ogDescription = $post->getTranslation('og_description', $locale) ?: $description;
    $ogImage = $post->og_image ? asset($post->og_image) : $image;
    
    // Twitter Card
    $twitterTitle = $post->getTranslation('twitter_title', $locale) ?: $title;
    $twitterDescription = $post->getTranslation('twitter_description', $locale) ?: $description;
    $twitterImage = $post->twitter_image ? asset($post->twitter_image) : $ogImage;
    
    // Meta Robots
    $robots = [];
    if ($post->meta_noindex) $robots[] = 'noindex';
    if ($post->meta_nofollow) $robots[] = 'nofollow';
    if ($post->meta_noarchive) $robots[] = 'noarchive';
    if ($post->meta_nosnippet) $robots[] = 'nosnippet';
    if ($post->meta_max_snippet) $robots[] = 'max-snippet:' . $post->meta_max_snippet;
    if ($post->meta_max_image_preview) $robots[] = 'max-image-preview:' . $post->meta_max_image_preview;
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
<meta name="author" content="{{ $post->author->name ?? config('app.name') }}">
<meta name="publish_date" property="og:publish_date" content="{{ $post->published_at?->toIso8601String() }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="article">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="{{ $locale === 'tr' ? 'tr_TR' : 'en_US' }}">
<meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
<meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
@if($post->author)
    <meta property="article:author" content="{{ $post->author->name }}">
@endif
@if($post->category)
    <meta property="article:section" content="{{ $post->category->getTranslation('name', $locale) }}">
@endif
@foreach($post->tags as $tag)
    <meta property="article:tag" content="{{ $tag->getTranslation('name', $locale) }}">
@endforeach

{{-- Twitter Card --}}
<meta name="twitter:card" content="{{ $post->twitter_card_type ?? 'summary_large_image' }}">
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
    $schema = $schemaService->generate($post, $locale);
@endphp

@if($schema)
    {!! $schemaService->toScriptTag($schema) !!}
@endif

{{-- Additional Meta for Google --}}
<meta name="google" content="nositelinkssearchbox">
<meta name="google" content="notranslate">