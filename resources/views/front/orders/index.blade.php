<x-front-layout :title="__('My Orders')">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('My Orders') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ __('My Orders') }}</li>
                        </ul>
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
                        <div class="col-lg-3 col-md-3 col-12">
                            <p>{{ __('Order Number') }}</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <p>{{ __('Date') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Status') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Total') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12 text-center">
                            <p>{{ __('Action') }}</p>
                        </div>
                    </div>
                </div>
                @forelse ($orders as $order)
                <div class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-3 col-12">
                            <h5 class="product-name">
                                <a href="{{ route('orders.show', $order->id) }}">
                                    #{{ $order->number ?? $order->id }}
                                </a>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <p>{{ $order->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <span class="badge bg-info p-2">{{ __($order->status) }}</span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ Currency::format($order->total) }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12 text-center">
                            @if (in_array($order->status, ['delivering', 'in_transit']))
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-soft-success rounded-pill px-3 py-1 fw-medium align-items-center gap-1 d-inline-flex"
                                style="background-color: #e8f7f0; color: #0d9488;">
                                <i class="lni lni-map-marker"></i>
                                <span>{{ __('Track') }}</span>
                            </a>
                            @else
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-soft-primary rounded-pill px-3 py-1 fw-medium align-items-center gap-1 d-inline-flex"
                                style="background-color: #f0f5ff; color: #0038e0;">
                                <i class="lni lni-eye"></i>
                                <span>{{ __('Details') }}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="cart-single-list text-center p-5">
                    <p class="mb-0">{{ __('No orders found yet.') }}</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-front-layout>