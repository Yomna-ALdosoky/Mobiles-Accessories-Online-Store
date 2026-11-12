<x-front-layout :title="__('Wishlist')">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Wishlist') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-nav">
                            <ul class="breadcrumb-nav">
                                <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                                <li>{{ __('Wishlist') }}</li>
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
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12"></div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <p>{{ __('Product Name') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Price') }}</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <p>{{ __('Action') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12 text-center">
                            <p>{{ __('Remove') }}</p>
                        </div>
                    </div>
                </div>

                @forelse ($wishlistItems as $item)
                <div class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="{{ route('products.show', $item->product->slug) }}">
                                <img src="{{ $item->product->image_url }}" alt="{{ trim($item->product->name) }}">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <h5 class="product-name">
                                <a href="{{ route('products.show', $item->product->slug) }}">
                                    {{ $item->product->name }}
                                </a>
                            </h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ Currency::format($item->product->price) }}</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="lni lni-cart"></i> {{ __('Add to Cart') }}
                                </button>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12 text-center">
                            <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <a class="remove-item" href="javascript:void(0)" onclick="this.closest('form').submit();">
                                    <i class="lni lni-close"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <h4>{{ __('Your wishlist is empty!') }}</h4>
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
                @endforelse
            </div>

            @if ($wishlistItems->hasPages())
            <div class="mt-4">
                {{ $wishlistItems->links() }}
            </div>
            @endif
        </div>
    </div>
</x-front-layout>