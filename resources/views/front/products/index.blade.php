<x-front-layout>
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Shop')}}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i>{{ __('Home')}}</a></li>
                        <li><a href="{{ route('shop.index') }}">{{ __('Shop') }}</a></li>
                        <li>{{ __('Shop') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>{{ __('Search Product') }}</h3>
                            <form action="{{ route('shop.index') }}" method="GET">
                                @if(request('category_id'))
                                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                                @endif
                                @if(request('brand_id'))
                                <input type="hidden" name="brand_id" value="{{ request('brand_id') }}">
                                @endif
                                @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                @endif

                                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search Here...') }}">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->

                        <!-- Start Single Widget -->
                        <div class="single-widget">
                            <h3>{{ __('All Categories') }}</h3>
                            <ul class="list">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('shop.index', array_merge(request()->query(), ['category_id' => $category->id])) }}"
                                        class="{{ request('category_id') == $category->id ? 'text-primary fw-bold' : '' }}">
                                        {{ $category->name }}
                                    </a><span>({{ $category->products_count }})</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Single Widget -->

                        <!-- Start Single Widget -->
                        <div class="single-widget condition">
                            <h3>{{ __('Filter by Brand') }}</h3>
                            @foreach($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="brand-{{ $brand->id }}" {{ request('brand_id')==$brand->id ? 'checked' : '' }}
                                onchange="window.location.href = '{{ route('shop.index', array_merge(request()->query(),
                                ['brand_id' => $brand->id])) }}'">
                                <label class="form-check-label" for="brand-{{ $brand->id }}">
                                    {{ $brand->name }} ({{ $brand->products_count }})
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <!-- End Product Sidebar -->
                </div>

                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">{{ __('Sort by:') }}</label>
                                        <select class="form-control" id="sorting" onchange="location = this.value;">
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort', 'latest' )=='latest' ? 'selected' : '' }}>
                                                {{ __('Latest') }}
                                            </option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort')=='price_asc' ? 'selected' : '' }}>
                                                {{ __('Price: Low to High') }}
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort')=='price_desc' ? 'selected' : '' }}>
                                                {{ __('Price: High to Low') }}
                                            </option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" {{ request('sort')=='name_asc' ? 'selected' : '' }}>{{ __('Name: A - Z') }}
                                            </option>
                                        </select>
                                        <h3 class="total-show-product">
                                            {{ __('Showing:') }} <span>{{ $products->firstItem() ?? 0 }}
                                                {{ $products->lastItem() ?? 0 }} {{ __('of') }} {{ $products->total() }} {{ __('items') }}</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link {{ request('view', 'grid') == 'grid' ? 'active' : '' }}" id="nav-grid-tab" type="button"
                                                onclick="window.location.href='{{ request()->fullUrlWithQuery(['view' => 'grid']) }}'">
                                                <i class="lni lni-grid-alt"></i>
                                            </button>
                                            <button class="nav-link {{ request('view') == 'list' ? 'active' : '' }}" id="nav-list-tab" type="button"
                                                onclick="window.location.href='{{ request()->fullUrlWithQuery(['view' => 'list']) }}'">
                                                <i class="lni lni-list"></i>
                                            </button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <!-- Grid View -->
                            <div class="tab-pane fade {{ request('view', 'grid') == 'grid' ? 'show active' : '' }}" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @forelse($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <x-product-card :product="$product" />
                                    </div>
                                    @empty
                                    <div class="col-12 text-center py-5">
                                        <h4>No products found matching your search criteria.</h4>
                                    </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- List View -->
                            <div class="tab-pane fade {{ request('view') == 'list' ? 'show active' : '' }}" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                <div class="row">
                                    @forelse($products as $product)

                                    <x-product-list-card :product="$product" />

                                    @empty
                                    <div class="col-12 text-center py-5">
                                        <h4>No products found matching your search criteria.</h4>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->

                        <div class="row mt-4">
                            <div class="col-12">
                                {{ $products->withQueryString()->links('pagination.custom') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>