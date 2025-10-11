@if (is_object($item) && method_exists($item, 'children') && $item->children->isNotEmpty())
    <li class="nav-item has-dropdown menu-item-has-children">
        <a href="{{ $item->url ?? '#' }}" class="nav-link dropdown-toggle">
            {{ $item->getTranslation('label', app()->getLocale()) }}
            <span class="dropdown-icon">▼</span>
        </a>
        <ul class="dropdown-menu sub-menu">
            @foreach($item->children as $child)
                @include('frontend.partials._submenu', ['item' => $child])
            @endforeach
        </ul>
    </li>
@elseif (is_object($item))
    <li class="nav-item">
        <a href="{{ $item->url ?? '#' }}" class="nav-link">
            {{ $item->getTranslation('label', app()->getLocale()) }}
        </a>
    </li>
@endif
