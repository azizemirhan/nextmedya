@if(isset($items) && $items->isNotEmpty())
    {{-- Temanızın ana menü <ul> etiketi --}}
    <ul>
        @foreach($items as $item)
            @include('frontend.partials._submenu', ['item' => $item])
        @endforeach
    </ul>
@endif
