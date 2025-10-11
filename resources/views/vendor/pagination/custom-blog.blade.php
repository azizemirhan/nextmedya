@if ($paginator->hasPages())
    <nav>
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- Eğer ilk sayfadaysak, geri butonu pasif olsun --}}
                <li class="disabled" aria-disabled="true">
                    <span><i class="fa-regular fa-arrow-left icon"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa-regular fa-arrow-left icon"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- Aktif (şu anki) sayfa --}}
                            <li>
                                <a href="#">
                                    <span class="current">{{ $page }}</span>
                                </a>
                            </li>
                        @else
                            {{-- Diğer sayfa linkleri --}}
                            <li>
                                <a href="{{ $url }}">
                                    <span>{{ $page }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa-regular fa-arrow-right icon"></i>
                    </a>
                </li>
            @else
                {{-- Eğer son sayfadaysak, ileri butonu pasif olsun --}}
                <li class="disabled" aria-disabled="true">
                    <span><i class="fa-regular fa-arrow-right icon"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
