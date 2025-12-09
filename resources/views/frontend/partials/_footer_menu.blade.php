@if(isset($items) && $items->isNotEmpty())
    <ul class="izkc-footer-menu">
        @foreach($items as $item)
            @include('frontend.partials._footer_submenu', ['item' => $item])
        @endforeach
    </ul>
@endif