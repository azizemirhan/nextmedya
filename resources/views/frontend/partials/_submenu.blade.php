@php
    $isMobile = isset($type) && $type === 'mobile';
    $currentUrl = url()->current();
    $itemUrl = $item->url ?? '#';
    $isActive = $itemUrl === $currentUrl || ($itemUrl !== '#' && request()->is(trim($itemUrl, '/') . '/*'));
    $hasChildren = $item->children && $item->children->isNotEmpty();
@endphp

{{-- DESKTOP MENU --}}
@if(!$isMobile)
    {{-- Mega Menu --}}
    @if($item->is_mega_menu && $hasChildren)
        <li class="nav-item mega-dropdown {{ $isActive ? 'active' : '' }}">
            <a href="{{ $itemUrl }}" class="nav-link">
                {{ $item->getTranslation('label', app()->getLocale()) }}
                <span class="dropdown-arrow">▼</span>
            </a>
            <div class="mega-menu">
                <div class="mega-menu-container">
                    @foreach($item->children as $child)
                        <div class="mega-menu-column">
                            @if($child->icon)
                                <div class="mega-column-icon">
                                    <i class="{{ $child->icon }}"></i>
                                </div>
                            @endif
                            <h3 class="mega-column-title">
                                {{ $child->getTranslation('label', app()->getLocale()) }}
                            </h3>
                            @if($child->children && $child->children->isNotEmpty())
                                <ul class="mega-menu-list">
                                    @foreach($child->children as $grandChild)
                                        <li>
                                            <a href="{{ $grandChild->url ?? '#' }}">
                                                <strong>{{ $grandChild->getTranslation('label', app()->getLocale()) }}</strong>
                                                @if($grandChild->description)
                                                    <span>{{ $grandChild->getTranslation('description', app()->getLocale()) }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Mega Menu Footer (Opsiyonel) --}}
                @if($item->description)
                    <div class="mega-menu-footer">
                        <div class="mega-footer-item">
                            @if($item->icon)
                                <span class="footer-icon"><i class="{{ $item->icon }}"></i></span>
                            @endif
                            <div class="footer-text">
                                <strong>{{ $item->getTranslation('label', app()->getLocale()) }}</strong>
                                <span>{{ $item->getTranslation('description', app()->getLocale()) }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </li>

        {{-- Normal Dropdown --}}
    @elseif($hasChildren)
        <li class="nav-item dropdown {{ $isActive ? 'active' : '' }}">
            <a href="{{ $itemUrl }}" class="nav-link">
                {{ $item->getTranslation('label', app()->getLocale()) }}
                <span class="dropdown-arrow">▼</span>
            </a>
            <div class="dropdown-menu">
                @foreach($item->children as $child)
                    <a href="{{ $child->url ?? '#' }}">
                        {{ $child->getTranslation('label', app()->getLocale()) }}
                    </a>
                @endforeach
            </div>
        </li>

        {{-- Normal Link --}}
    @else
        <li class="nav-item {{ $isActive ? 'active' : '' }}">
            <a href="{{ $itemUrl }}" class="nav-link">
                {{ $item->getTranslation('label', app()->getLocale()) }}
            </a>
        </li>
    @endif

    {{-- MOBILE MENU --}}
@else
    @if($hasChildren)
        <div class="sidebar-item expandable">
            <button class="sidebar-link" data-expand="menu-{{ $item->id }}">
                <span>{{ $item->getTranslation('label', app()->getLocale()) }}</span>
                <span class="expand-arrow">▼</span>
            </button>
            <div class="sidebar-submenu" id="menu-{{ $item->id }}">
                @foreach($item->children as $child)
                    {{-- Eğer child'ın da children'ı varsa --}}
                    @if($child->children && $child->children->isNotEmpty())
                        <div class="sidebar-subitem-group">
                            <h4 class="submenu-title">
                                @if($child->icon)
                                    <i class="{{ $child->icon }}"></i>
                                @endif
                                {{ $child->getTranslation('label', app()->getLocale()) }}
                            </h4>
                            @foreach($child->children as $grandChild)
                                <a href="{{ $grandChild->url ?? '#' }}">
                                    {{ $grandChild->getTranslation('label', app()->getLocale()) }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <a href="{{ $child->url ?? '#' }}">
                            {{ $child->getTranslation('label', app()->getLocale()) }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <div class="sidebar-item">
            <a href="{{ $itemUrl }}" class="sidebar-link">
                <span>{{ $item->getTranslation('label', app()->getLocale()) }}</span>
                <span class="arrow">→</span>
            </a>
        </div>
    @endif
@endif