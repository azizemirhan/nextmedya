@if(isset($items) && $items->isNotEmpty())
    <ul class="nav-menu navbar-nav">
        @foreach($items as $item)
            @include('frontend.partials._submenu', ['item' => $item])
        @endforeach
    </ul>
@endif
