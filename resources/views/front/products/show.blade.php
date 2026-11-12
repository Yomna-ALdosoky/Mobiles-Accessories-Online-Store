<x-front-layout>

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ $product->name }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i>{{ __('Home') }}</a></li>
                        <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
            <x-alert type="success" />
            <x-alert type="error" />
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ $product->coverImage?->image ? asset('storage/' . $product->coverImage->image) : asset('assets/images/product-details/01.jpg') }}" id="current"
                                        alt="#">
                                </div>
                                <div class="images">
                                    <img src="{{ $product->image_url }}" class="img" alt="{{ $product->name }}" onclick="document.getElementById('current').src=this.src">
                                    @php
                                    $galleryImages = $product->images->where('is_primary', 0);
                                    $remainingCount = 4 - $galleryImages->count();
                                    @endphp
                                    @foreach ($galleryImages as $galleryImage)
                                    <img src="{{ Str::startsWith($galleryImage->image, ['http://', 'https://']) ? $galleryImage->image : asset('storage/' . $galleryImage->image) }}" class="img"
                                        alt="{{ $product->name }}" onclick="document.getElementById('current').src=this.src">
                                    @endforeach
                                    @for ($i = 0; $i < $remainingCount; $i++) <img src="https://opelgtsource.com/assets/default_product.png" class="img" alt="No product image"
                                        onclick="document.getElementById('current').src=this.src">
                                        @endfor
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $product->name }}</h2>
                            <p class="category"><i class="lni lni-tag"></i> {{ __('Category:') }}<a href="javascript:void(0)">{{ $product->category?->name }}</a></p>
                            <h3 class="price">${{ number_format($product->price, 2) }}
                                @if($product->compare_price)
                                <span>${{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </h3>
                            <p class="info-text">{!! nl2br(e(Str::limit($product->description, 85, '...'))) !!}</p>

                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="row">
                                    @php
                                    $colors = collect($product->options ?? [])->firstWhere(fn($i) => strtolower($i['option_name'] ?? '') === 'color')['option_values'] ?? [];
                                    @endphp
                                    @if(!empty($colors))
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group color-option">
                                            <label class="title-label" for="size">{{ __('Choose color') }}</label>
                                            @foreach ($colors as $index => $color)
                                            @php
                                            $cleanColor = trim(strtolower($color));
                                            $isWhite = in_array($cleanColor, ['white', '#fff', '#ffffff']);
                                            @endphp
                                            <div class="single-checkbox" title="{{ ucfirst($color) }}">
                                                <input type="checkbox" id="checkbox-{{ $index }}" name="color" value="{{ $color }}" class="color-choice" @checked($loop->first)>
                                                <label for="checkbox-{{ $index }}">
                                                    <span style="background-color: {{ $cleanColor }} !important; border: 1px solid {{ $isWhite ? '#ccc' : $cleanColor }} !important;"></span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @php
                                    $capacities = collect($product->options ?? [])->firstWhere(fn($i) => strtolower($i['option_name'] ?? '') === 'capacity')['option_values'] ?? [];
                                    @endphp
                                    @if(!empty($capacities))
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="capacity">{{ __('Battery capacity') }}</label>
                                            <select class="form-control" id="capacity" name="capacity">
                                                @foreach ($capacities as $capacity)
                                                <option value="{{ $capacity }}" @selected($loop->first)>{{ $capacity }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @php
                                    $maxStock = min($product->quantity ?? 5, 5);
                                    @endphp
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group quantity">
                                            <label for="color">{{ __('Quantity') }}</label>
                                            <select class="form-control" id="quantity" name="quantity">
                                                @if($maxStock > 0)
                                                @for ($i = 1; $i <= $maxStock; $i++) <option value="{{ $i }}" @selected($i===1)>{{ $i }}</option>
                                                    @endfor
                                                    @else
                                                    <option value="0" disabled selected>{{ __('Out of stock') }}</option>
                                                    @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bottom-content">
                                    <div class="row align-items-end">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="button cart-button">
                                                <button type="submit" class="btn" style="width: 100%;" @disabled(($product->quantity ?? 0) <= 0)>
                                                        {{ ($product->quantity ?? 0) > 0 ? __('Add to Cart') : __('Out of Stock') }}
                                                </button>
                                            </div>
                                        </div>
                            </form>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="wish-button">
                                    <button class="btn"><i class="lni lni-reload"></i>{{ __('Compare') }}</button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="wish-button">
                                    <form action="{{ route('wishlist.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @php
                                        $inWishlist = auth()->check() && auth()->user()->hasInWishlist($product->id);
                                        @endphp
                                        <button type="submit" class="btn"
                                            style="{{ $inWishlist ? 'background-color: #fce4e4 !important; color: #ff483b !important; border-color: #ff483b !important;' : '' }}">
                                            <i class="{{ $inWishlist ? 'lni lni-heart-filled' : 'lni lni-heart' }}" style="{{ $inWishlist ? 'color: #ff483b !important;' : '' }}"></i>
                                            {{ $inWishlist ? __('In Wishlist') : __('To Wishlist') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="product-details-info">
            <div class="single-block">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="info-body custom-responsive-margin">
                            <h4>{{ __('Details:') }}</h4>
                            <p>{!! nl2br(e($product->description)) !!}</p>
                            @php
                            $features = collect($product->options)->firstWhere('option_name', 'features')['option_values'] ?? [];
                            @endphp
                            @if(!empty($features))
                            <h4> {{ __('Features:') }}</h4>
                            <ul class="features">
                                @foreach ($features as $feature)
                                <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="info-body">
                            @php
                            $specifications = $product->options['specifications']['option_values'] ?? [];
                            @endphp
                            @if(!empty($specifications))
                            <h4> {{ __('Specifications:') }}</h4>
                            <ul class="normal-list">
                                @foreach ($specifications as $key => $value)
                                <li><span>{{ $key }}:</span> {{ $value }}</li>
                                @endforeach
                            </ul>
                            @endif

                            @php
                            $shippingOptions = $product->options['shipping']['option_values'] ?? [];
                            @endphp
                            @if(!empty($shippingOptions))
                            <h4>{{ __('Shipping Options:') }}</h4>
                            <ul class="normal-list">
                                @foreach ($shippingOptions as $method => $details)
                                <li><span>{{ $method }}:</span> {{ $details }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="single-block give-review">
                        <h4>4.5 ({{ __('Overall') }})</h4>
                        <ul>
                            <li>
                                <span>5 {{ __('stars') }} - 38</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                            </li>
                            <li>
                                <span>4 {{ __('stars') }} - 10</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                            </li>
                            <li>
                                <span>3 {{ __('stars') }} - 3</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                            </li>
                            <li>
                                <span>2 {{ __('stars') }} - 1</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                            </li>
                            <li>
                                <span>1 {{ __('star') }} - 0</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                            </li>
                        </ul>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn review-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{ __('Leave a Review') }}
                        </button>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="single-block">
                        <div class="reviews">
                            <h4 class="title">{{ __('Latest Reviews') }}</h4>
                            <!-- Start Single Review -->
                            <div class="single-review">
                                <img src="https://demo.graygrids.com/themes/shopgrids/assets/images/blog/comment1.jpg" alt="#">
                                <div class="review-info">
                                    <h4>{{ __('Awesome quality for the price') }}
                                        <span>{{ __('Jacob Hammond') }}
                                        </span>
                                    </h4>
                                    <ul class="stars">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                    </ul>
                                    <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor...') }}</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                            <!-- Start Single Review -->
                            <div class="single-review">
                                <img src="https://demo.graygrids.com/themes/shopgrids/assets/images/blog/comment2.jpg" alt="#">
                                <div class="review-info">
                                    <h4>{{ __('My husband love his new...') }}
                                        <span>{{ __('Alex Jaza') }}
                                        </span>
                                    </h4>
                                    <ul class="stars">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star"></i></li>
                                    </ul>
                                    <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor...') }}</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                            <!-- Start Single Review -->
                            <div class="single-review">
                                <img src="https://demo.graygrids.com/themes/shopgrids/assets/images/blog/comment3.jpg" alt="#">
                                <div class="review-info">
                                    <h4>{{ __('I love the built quality...') }}
                                        <span>{{ __('Jacob Hammond') }}
                                        </span>
                                    </h4>
                                    <ul class="stars">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                    </ul>
                                    <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor...') }}</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Item Details -->

    <!-- Review Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Leave a Review') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-name">{{ __('Your Name') }}</label>
                                <input class="form-control" type="text" id="review-name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-email">{{ __('Your Name') }}</label>
                                <input class="form-control" type="email" id="review-email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-subject">{{ __('Subject') }}</label>
                                <input class="form-control" type="text" id="review-subject" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-rating">{{ __('Rating') }}</label>
                                <select class="form-control" id="review-rating">
                                    <option>{{ __('5 Stars') }}</option>
                                    <option>{{ __('4 Stars') }}</option>
                                    <option>{{ __('3 Stars') }}</option>
                                    <option>{{ __('2 Stars') }}</option>
                                    <option>{{ __('1 Star') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">{{ __('Review') }}</label>
                        <textarea class="form-control" id="review-message" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer button">
                    <button type="button" class="btn">{{ __('Submit Review') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Review Modal -->

    @push('scripts')
    <script type="text/javascript">
        const current = document.getElementById("current");
        const opacity = 0.6;
        const imgs = document.querySelectorAll(".img");

        imgs.forEach(img => {
            img.addEventListener("click", (e) => {
                imgs.forEach(img => {
                    img.style.opacity = 1;
                });
                current.src = e.target.src;
                e.target.style.opacity = opacity;
            });
        });
    </script>
    @endpush

</x-front-layout>