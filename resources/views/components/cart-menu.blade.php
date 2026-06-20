<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{ $items->count() }}</span>
    </a>
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ trans_choice('{0} No items|{1} 1 Item|[2,*] :count Items', $items->count(), ['count' =>
                $items->count()]) }}</span>
            <a href="{{ route('cart.index') }}">{{ __('View Cart') }}</a>
        </div>
        <ul class="shopping-list">
            @foreach ($items as $item)
            <li>
                <a href="javascript:void(0)" class="remove" title="{{ __('Remove this item') }}"><i
                        class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="{{ route('products.show', $item->product->slug) }}">
                        <img src="{{ $item->product->image_url }}" alt="{{ trim($item->product->name) }}">
                    </a>
                </div>
                <div class="content">
                    <h4><a href="{{ route('products.show', $item->product->slug) }}">{{ $item->product->name }}</a></h4>
                    <p class="quantity">{{ $item->quantity }}x - <span class="amount">{{
                            Currency::format($item->product->price) }}</span></p>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>{{ __('Total') }}</span>
                <span class="total-amount">{{ Currency::format($total) }}</span>
            </div>
            <div class="button">
                <a href="{{ route('checkout') }}" class="btn animate">{{ __('Checkout') }}</a>
            </div>
        </div>
    </div>
</div>