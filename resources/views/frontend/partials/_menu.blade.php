@if(isset($items) && $items->isNotEmpty())
    {{-- Desktop Menu --}}
    @if(!isset($type) || $type !== 'mobile')
        <ul class="nav-menu desktop-only">
            @foreach($items as $item)
                @include('frontend.partials._submenu', ['item' => $item, 'type' => 'desktop'])
            @endforeach
        </ul>
    @else
        {{-- Mobile Menu --}}
        <div class="sidebar-menu">
            @foreach($items as $item)
                @include('frontend.partials._submenu', ['item' => $item, 'type' => 'mobile'])
            @endforeach
        </div>
    @endif
@endif