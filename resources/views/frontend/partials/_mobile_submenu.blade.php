@if (is_object($item) && method_exists($item, 'children') && $item->children->isNotEmpty())
    <li class="mobile-nav-item">
        <div class="mobile-nav-link" onclick="toggleMobileDropdown(this)">
            {{ $item->getTranslation('label', app()->getLocale()) }}
            <div class="mobile-dropdown-toggle">▼</div>
        </div>
        <div class="mobile-dropdown">
            @foreach($item->children as $child)
                @include('frontend.partials._mobile_submenu', ['item' => $child])
            @endforeach
        </div>
    </li>
@elseif (is_object($item))
    <li class="mobile-nav-item">
        <a href="{{ $item->url ?? '#' }}" class="mobile-nav-link">
            {{ $item->getTranslation('label', app()->getLocale()) }}
        </a>
    </li>
@endif
