@extends('frontend.layouts.master')

{{-- DİNAMİK SEO BÖLÜMÜNÜN TANIMLANDIĞI YER --}}
@section('page_meta')
    <title>{{ $page->getTranslation('seo_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale()) }}</title>
    <meta name="description" content="{{ $page->getTranslation('meta_description', app()->getLocale()) }}">
    <meta name="keywords" content="{{ $page->getTranslation('keywords', app()->getLocale()) }}">

    {{-- Robots Etiketi (index/nofollow vb.) --}}
    <meta name="robots" content="{{ $page->index_status }},{{ $page->follow_status }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ $page->canonical_url ?: url()->current() }}" />

    {{-- Open Graph Etiketleri (Facebook, LinkedIn vb. için sosyal medya paylaşımı) --}}
    <meta property="og:title" content="{{ $page->getTranslation('og_title', app()->getLocale()) ?: $page->getTranslation('seo_title', app()->getLocale()) }}" />
    <meta property="og:description" content="{{ $page->getTranslation('og_description', app()->getLocale()) ?: $page->getTranslation('meta_description', app()->getLocale()) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($page->og_image)
        <meta property="og:image" content="{{ asset($page->og_image) }}" />
    @elseif(isset($settings['site_logo']))
        <meta property="og:image" content="{{ asset($settings['site_logo']->value) }}" />
    @endif
@endsection


@section('content')

    @foreach($page->sections as $section)
        {{-- Sadece aktif olan section'ları göster --}}
        @if($section->is_active)
            @php
                $sectionConfig = $availableSections[$section->section_key] ?? null;
                if (!$sectionConfig) continue;

                $dynamicData = null;
                if (isset($sectionConfig['data_handler'])) {
                    $handler = resolve($sectionConfig['data_handler']);
                    $dynamicData = $handler->handle($section);
                }
            @endphp

            @include($sectionConfig['view'], [
                'section' => $section,
                'content' => $section->content,
                'dynamicData' => $dynamicData
            ])
        @endif
    @endforeach

@endsection
