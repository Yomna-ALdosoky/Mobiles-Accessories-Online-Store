<div class="col-lg-12 col-md-12 col-12">
    <div class="single-product">
        <div class="row align-items-center">

            <div class="col-lg-4 col-md-4 col-12">
                <div class="product-image">

                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">

                    @if($product->compare_price && $product->compare_price > $product->price)

                    <span class="sale-tag">
                        -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                    </span>

                    @elseif($product->created_at && $product->created_at->diffInDays() <= 7) <span class="new-tag">
                        New</span>

                        @endif

                        <div class="button">
                            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="btn">
                                <i class="lni lni-cart"></i> Add to Cart
                            </a>
                        </div>

                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-12">
                <div class="product-info">

                    <span class="category">
                        {{ $product->category->name ?? '' }}
                    </span>

                    <h4 class="title">
                        <a href="{{ route('products.show', $product->slug ?? $product->id) }}">
                            {{ $product->name }}
                        </a>
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
                        <span>
                            ${{ number_format($product->price, 2) }}
                        </span>

                        @if($product->compare_price && $product->compare_price > $product->price)

                        <span class="discount-price">
                            ${{ number_format($product->compare_price, 2) }}
                        </span>

                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>