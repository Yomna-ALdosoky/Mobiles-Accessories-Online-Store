<div class="single-product">
    <div class="product-image">
        <img src="{{ asset('storage/' . $product->coverImage?->image) }}" alt="{{ $product->name }}">
        @if($product->sale_percent)
        <span class="sale-tag">- {{ $product->sale_percent }}%</span>
        @endif

        {{-- <div class="button">
            <a href="{{ route('products.show', $product->slug) }}" class="btn"><i class="lni lni-cart"></i> Add to
                Cart</a>
        </div> --}}
        <div class="button">
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <input type="hidden" name="quantity" value="1">

                <button type="submit" class="btn" style="border: none; width: 100%; display: flex; align-items: center; justify-content: center; gap: 5px; cursor: pointer;">
                    <i class="lni lni-cart"></i> {{ __('Add to Cart')}}
                </button>
            </form>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category?->name ?? __('No Category') }}</span>
        <h4 class="title">
            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($product->rating))
                <li><i class="lni lni-star-filled"></i></li>
                @elseif ($i - $product->rating < 1 && $i - $product->rating > 0)
                    <li><i class="lni lni-star-half"></i></li>
                    @else
                    <li><i class="lni lni-star"></i></li>
                    @endif
                    @endfor
                    <li><span>{{ number_format($product->rating, 1) }} Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ Currency::format($product->price) }}</span>
            @if($product->compare_price)
            <span class="discount-price">{{ Currency::format($product->compare_price) }}</span>
            @endif
        </div>
    </div>
</div>