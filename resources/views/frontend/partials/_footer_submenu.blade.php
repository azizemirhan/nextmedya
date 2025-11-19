@php
    $currentUrl = url()->current();
    $itemUrl = $item->url ?? '#';
    $isActive = $itemUrl === $currentUrl || ($itemUrl !== '#' && request()->is(trim($itemUrl, '/') . '/*'));
    
    // Alt menü var mı kontrol et
    $hasChildren = $item->children && $item->children->isNotEmpty();
@endphp

@if ($hasChildren)
    {{-- Footer'da alt menüsü olan öğe --}}
    <li class="izkc-footer-menu-item izkc-has-submenu {{ $isActive ? 'izkc-active' : '' }}">
        <a href="{{ $itemUrl }}" class="izkc-footer-menu-link">
            {{ $item->getTranslation('label', app()->getLocale()) }}
        </a>
        <ul class="izkc-footer-submenu">
            @foreach($item->children as $child)
                @include('frontend.partials._footer_submenu', ['item' => $child])
            @endforeach
        </ul>
    </li>
@else
    {{-- Footer'da normal menü öğesi --}}
    <li class="izkc-footer-menu-item {{ $isActive ? 'izkc-active' : '' }}">
        <a href="{{ $itemUrl }}" class="izkc-footer-menu-link">
            {{ $item->getTranslation('label', app()->getLocale()) }}
        </a>
    </li>
@endif