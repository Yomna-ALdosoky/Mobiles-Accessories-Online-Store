<x-front-layout :title="__('Cart')">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Cart') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-nav">
                            <ul class="breadcrumb-nav">
                                <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                                <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                                <li>{{ __('Cart') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12"></div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>{{ __('Product Name') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Quantity') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Subtotal') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Discount') }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>{{ __('Remove') }}</p>
                        </div>
                    </div>
                </div>

                @foreach ($cart->get() as $item)
                <div class="cart-single-list" id="{{ $item->id }}">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="{{ route('products.show', $item->product->slug) }}">
                                <img src="{{ $item->product->image_url }}" alt="{{ trim($item->product->name) }}">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name">
                                <a href="{{ route('products.show', $item->product->slug) }}">
                                    {{ $item->product->name }}
                                </a>
                            </h5>
                            <p class="product-des">
                                <span><em>{{ __('Type:') }}</em> {{ __('Mirrorless') }}</span>
                                <span><em>{{ __('Color:') }}</em> {{ __('Black') }}</span>
                            </p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input class="form-control item-quantity" data-id="{{ $item->id }}"
                                    value="{{ $item->quantity }}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p class="item-subtotal-{{ $item->id }}">{{ Currency::format($item->quantity *
                                $item->product->price) }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ Currency::format(0) }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a class="remove-item" data-id="{{ $item->id }}" href="javascript:void(0)">
                                <i class="lni lni-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="{{ __('Enter Your Coupon') }}">
                                            <div class="button">
                                                <button class="btn">{{ __('Apply Coupon') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>{{ __('Cart Subtotal') }}<span id="cart-total">{{
                                                Currency::format($cart->total()) }}</span></li>
                                        <li>{{ __('Shipping') }}<span>{{ __('Free') }}</span></li>
                                        <li>{{ __('You Save') }}<span>{{ Currency::format(29) }}</span></li>
                                        <li class="last">{{ __('You Pay') }}<span>{{ Currency::format(2531) }}</span>
                                        </li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout') }}" class="btn">{{ __('Checkout') }}</a>
                                        <a href="{{ route('products.index') }}" class="btn btn-alt">
                                            {{ __('Continue shopping') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/cart.js') }}"></script>
    @endpush
</x-front-layout>


{{-- <x-front-layout :title="__('Cart')">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Cart') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-nav">
                            <ul class="breadcrumb-nav">
                                <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                                <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                                <li>{{ __('Cart') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12"></div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>{{ __('Product Name') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Quantity') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Subtotal') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Discount') }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>{{ __('Remove') }}</p>
                        </div>
                    </div>
                </div>

                @foreach ($cart->get() as $item)
                <div class="cart-single-list" id="{{ $item->id }}">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="{{ route('products.show', $item->product->slug) }}">
                                <img src="{{ $item->product->image_url }}" alt="{{ trim($item->product->name) }}">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name">
                                <a href="{{ route('products.show', $item->product->slug) }}">
                                    {{ $item->product->name }}
                                </a>
                            </h5>
                            <p class="product-des">
                                <span><em>{{ __('Type:') }}</em> {{ __('Mirrorless') }}</span>
                                <span><em>{{ __('Color:') }}</em> {{ __('Black') }}</span>
                            </p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input class="form-control item-quantity" data-id="{{ $item->id }}"
                                    value="{{ $item->quantity }}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p class="item-subtotal-{{ $item->id }}">{{ Currency::format($item->quantity *
                                $item->product->price) }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ Currency::format(0) }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a class="remove-item" data-id="{{ $item->id }}" href="javascript:void(0)">
                                <i class="lni lni-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="{{ __('Enter Your Coupon') }}">
                                            <div class="button">
                                                <button class="btn">{{ __('Apply Coupon') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>{{ __('Cart Subtotal') }}<span id="cart-total">{{
                                                Currency::format($cart->total()) }}</span></li>
                                        <li>{{ __('Shipping') }}<span>{{ __('Free') }}</span></li>
                                        <li>{{ __('You Save') }}<span>{{ Currency::format(29) }}</span></li>
                                        <li class="last">{{ __('You Pay') }}<span>{{ Currency::format(2531) }}</span>
                                        </li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout') }}" class="btn">{{ __('Checkout') }}</a>
                                        <a href="{{ route('products.index') }}" class="btn btn-alt">
                                            {{ __('Continue shopping') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/cart.js') }}"></script>
    @endpush
</x-front-layout> --}}