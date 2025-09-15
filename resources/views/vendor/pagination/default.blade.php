@if ($paginator->hasPages())
    <div class="pagination flex justify-center items-center space-x-2">
        <ul class="flex list-none space-x-2">
            {{-- Önceki Buton --}}
            @if ($paginator->onFirstPage())
                <li class="disabled bg-gray-300 text-gray-500 cursor-not-allowed py-2 px-4 rounded-full">
                    <span>&laquo; Önceki</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-full transition duration-300 ease-in-out" rel="prev">
                        &laquo; Önceki
                    </a>
                </li>
            @endif

            {{-- Sayfa Numaraları --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled bg-gray-300 text-gray-500 cursor-not-allowed py-2 px-4 rounded-full">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="text-white bg-blue-500 py-2 px-4 rounded-full">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="text-blue-500 hover:bg-blue-100 py-2 px-4 rounded-full transition duration-300 ease-in-out">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Sonraki Buton --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-full transition duration-300 ease-in-out" rel="next">
                        Sonraki &raquo;
                    </a>
                </li>
            @else
                <li class="disabled bg-gray-300 text-gray-500 cursor-not-allowed py-2 px-4 rounded-full">
                    <span>Sonraki &raquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif
