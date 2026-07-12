<x-front-layout>
    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container">
            <x-alert type="info" />
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image: url({{ asset('assets/images/slider-bg1.jpg') }});">
                                <div class="content">
                                    <h2><span>No restocking fee ($35 savings)</span>
                                        M75 Sport Watch
                                    </h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut
                                        labore dolore magna aliqua.</p>
                                    <h3><span>Now Only</span> $320.99</h3>
                                    <div class="button">
                                        <a href="product-grids.html" class="btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image: url({{ asset('assets/images/slider-bg2.jpg') }});">
                                <div class="content">
                                    <h2><span>Big Sale Offer</span>
                                        Get the Best Deal on CCTV Camera
                                    </h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut
                                        labore dolore magna aliqua.</p>
                                    <h3><span>Combo Only:</span> $590.00</h3>
                                    <div class="button">
                                        <a href="product-grids.html" class="btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner"
                                style="background-image: url({{ asset('assets/images/slider-bnr.jpg') }});">
                                <div class="content">
                                    <h2>
                                        <span>New line required</span>
                                        iPhone 12 Pro Max
                                    </h2>
                                    <h3>$259.99</h3>
                                </div>
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>Weekly Sale!</h2>
                                    <p>Saving up to 50% off all online store items this week.</p>
                                    <div class="button">
                                        <a class="btn" href="product-grids.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Featured Categories Area -->
    <section class="featured-categories section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Featured Categories') }}</h2>
                        <p> {{ __('There are many variations of passages of Lorem Ipsum available, ' .
                            'but the majority have suffered alteration in some form.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">{{ $category->name }}</h3>
                        <ul>
                            @foreach ($category->products as $product)
                            <li><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('categories.show', $category->slug) }}">{{ __('View All') }}</a></li>

                        </ul>
                        <div class="images">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="#">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Trending Products') }}</h2>
                        <p>
                            {{ __('There are many variations of passages of Lorem Ipsum available, ' .
                            'but the majority have suffered alteration in some form.') }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <x-product-card :product="$product" />
                        <!-- End Single Product -->
                    </div>
                    @endforeach
                </div>
            </div>
    </section>
    <!-- End Trending Product Area -->

    <!-- Start Banner Area -->
    {{-- <section class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner"
                        style="background-image:url('{{ asset('assets/images/banner-1-bg.jpg') }}')">
                        <div class="content">
                            <h2>Smart Watch 2.0</h2>
                            <p>Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p>
                            <div class="button">
                                <a href="product-grids.html" class="btn">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner custom-responsive-margin"
                        style="background-image:url('{{ asset('assets/images/banner-2-bg.jpg') }}')">
                        <div class="content">
                            <h2>Smart Headphone</h2>
                            <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                                incididunt ut labore.</p>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="banner section" style="padding: 30px 0; background-color: #fff;">
        <div class="container">
            <div class="row">
                @foreach($sub_banner_products as $index => $banner_prod)
                <div class="col-lg-6 col-md-6 col-12">

                    <div class="single-banner {{ $index == 1 ? 'custom-responsive-margin' : '' }}"
                        style="display: flex; background-color: #081828; align-items: center; justify-content: space-between; border-radius: 16px; min-height: 240px; margin-top: 30px; position: relative; overflow: hidden; border: none; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 30px rgba(1, 103, 243, 0.2)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">

                        <div
                            style="position: absolute; right: 0; top: 0; width: 55%; height: 100%; background-color: #f4f7fc; clip-path: polygon(25% 0, 100% 0, 100% 100%, 0% 100%); z-index: 1; transition: all 0.4s ease;">
                        </div>

                        <div class="content"
                            style="flex: 0 0 50%; max-width: 50%; padding-left: 35px; z-index: 2; position: relative;">
                            <span
                                style="background: #0167F3; color: #fff; font-size: 10px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 12px; box-shadow: 0 4px 10px rgba(1, 103, 243, 0.3);">
                                {{ __('Discover') }}
                            </span>

                            <h2
                                style="font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 10px; font-family: 'Jost', sans-serif;">
                                {{ $banner_prod->name }}
                            </h2>

                            <p style="font-size: 13px; color: #b5c4d2; line-height: 1.5; margin-bottom: 20px;">
                                {{ Str::limit($banner_prod->description, 60) }}
                            </p>

                            <div class="button">
                                <a href="{{ route('products.show', $banner_prod->slug) }}" class="btn-shop-now"
                                    style="background: #0167F3; color: #fff; font-size: 13px; font-weight: 600; padding: 11px 24px; border-radius: 6px; display: inline-block; transition: all 0.3s ease; text-decoration: none;"
                                    onmouseover="this.style.background='#fff'; this.style.color='#0167F3';"
                                    onmouseout="this.style.background='#0167F3'; this.style.color='#fff';">
                                    {{ __('Shop Now') }}
                                </a>
                            </div>
                        </div>

                        <div class="image-box"
                            style="flex: 0 0 45%; max-width: 45%; text-align: center; z-index: 2; position: relative; padding-right: 20px; transition: all 0.4s ease;"
                            onmouseover="this.querySelector('img').style.transform='scale(1.1) rotate(3deg)';"
                            onmouseout="this.querySelector('img').style.transform='scale(1) rotate(0)';">
                            <img src="{{ $banner_prod->image_url }}" alt="{{ $banner_prod->name }}"
                                style="max-width: 100%; max-height: 160px; object-fit: contain; filter: drop-shadow(5px 10px 15px rgba(0,0,0,0.15)); transition: all 0.4s ease-in-out;">
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Special Offer -->
    {{-- <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Special Offer</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ asset('assets/images/fetured-item-3.png') }}" alt="#">
                                    <div class="button">
                                        <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">Camera</span>
                                    <h4 class="title">
                                        <a href="product-grids.html">WiFi Security Camera</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><span>5.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>$399.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ asset('assets/images/product-8.jpg') }}" alt="#">
                                    <div class="button">
                                        <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">Laptop</span>
                                    <h4 class="title">
                                        <a href="product-grids.html">Apple MacBook Air</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><span>5.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>$899.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ asset('assets/images/product-6.jpg') }}" alt="#">
                                    <div class="button">
                                        <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">Speaker</span>
                                    <h4 class="title">
                                        <a href="product-grids.html">Bluetooth Speaker</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star"></i></li>
                                        <li><span>4.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>$70.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                    </div>
                    <!-- Start Banner -->
                    <div class="single-banner right"
                        style="background-image:url('{{ asset('assets/images/banner-3-bg.jpg') }}');margin-top: 30px;">
                        <div class="content">
                            <h2>Samsung Notebook 9 </h2>
                            <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                                incididunt ut labore.</p>
                            <div class="price">
                                <span>$590.00</span>
                            </div>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner -->
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="offer-content">
                        <div class="image">
                            <img src="{{ asset('assets/images/product-5.jpg') }}" alt="#">
                            <span class="sale-tag">-50%</span>
                        </div>
                        <div class="text">
                            <h2><a href="product-grids.html">Bluetooth Headphone</a></h2>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                                <span>$200.00</span>
                                <span class="discount-price">$400.00</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry incididunt ut
                                eiusmod tempor labores.</p>
                        </div>
                        <div class="box-head">
                            <div class="box">
                                <h1 id="days">000</h1>
                                <h2 id="daystxt">Days</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">00</h1>
                                <h2 id="hourstxt">Hours</h2>
                            </div>
                            <div class="box">
                                <h1 id="minutes">00</h1>
                                <h2 id="minutestxt">Minutes</h2>
                            </div>
                            <div class="box">
                                <h1 id="seconds">00</h1>
                                <h2 id="secondstxt">Secondes</h2>
                            </div>
                        </div>
                        <div style="background: rgb(204, 24, 24);" class="alert">
                            <h1 style="padding: 50px 80px;color: white;">We are sorry, Event ended ! </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Special Offer') }}</h2>
                        <p>{{ __('special_offer_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @foreach($special_grid_products as $prod)
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}">
                                    <div class="button">
                                        <a href="#" class="btn"><i class="lni lni-cart"></i> {{ __('Add to Cart') }}</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">{{ $prod->category->name ?? __('General') }}</span>
                                    <h4 class="title">
                                        <a href="#">{{ $prod->name }}</a>
                                    </h4>
                                    <ul class="review">
                                        @for($i = 1; $i <= 5; $i++) <li><i
                                                class="lni lni-star{{ $i <= $prod->rating ? '-filled' : '' }}"></i></li>
                                            @endfor
                                            <li><span>{{ number_format($prod->rating, 1) }} {{ __('Review(s)') }}</span>
                                            </li>
                                    </ul>
                                    <div class="price">
                                        <span>{{ Currency::format($prod->price) }}</span>
                                        @if($prod->compare_price)
                                        <span class="discount-price"
                                            style="text-decoration: line-through; color: #888; font-size: 14px; margin-left: 8px;">
                                            {{ Currency::format($prod->compare_price) }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($banner_product)
                    <div class="single-banner right"
                        style="background-image:url('{{ asset('assets/images/banner-3-bg.jpg') }}'); margin-top: 30px;">
                        <div class="content">
                            <h2>{{ $banner_product->name }}</h2>
                            <p>{{ Str::limit($banner_product->description, 80) }}</p>
                            <div class="price">
                                <span>{{ Currency::format($banner_product->price) }}</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn">{{ __('Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    @if($special_offer_product)
                    <div class="offer-content">
                        <div class="image">
                            <img src="{{ $special_offer_product->image_url }}" alt="{{ $special_offer_product->name }}">
                            @if($special_offer_product->sale_percent > 0)
                            <span class="sale-tag">-{{ $special_offer_product->sale_percent }}%</span>
                            @endif
                        </div>
                        <div class="text">
                            <h2><a href="#">{{ $special_offer_product->name }}</a></h2>
                            <ul class="review">
                                @for($i = 1; $i <= 5; $i++) <li><i
                                        class="lni lni-star{{ $i <= $special_offer_product->rating ? '-filled' : '' }}"></i>
                                    </li>
                                    @endfor
                                    <li><span>{{ number_format($special_offer_product->rating, 1) }} {{ __('Review(s)')
                                            }}</span></li>
                            </ul>
                            <div class="price">
                                <span>{{ Currency::format($special_offer_product->price) }}</span>
                                @if($special_offer_product->compare_price)
                                <span class="discount-price">{{ Currency::format($special_offer_product->compare_price)
                                    }}</span>
                                @endif
                            </div>
                            <p>{{ Str::limit($special_offer_product->description, 120) }}</p>
                        </div>

                        <div class="box-head" id="timer-box">
                            <div class="box">
                                <h1 id="days">00</h1>
                                <h2 id="daystxt">{{ __('Days') }}</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">00</h1>
                                <h2 id="hourstxt">{{ __('Hours') }}</h2>
                            </div>
                            <div class="box">
                                <h1 id="minutes">00</h1>
                                <h2 id="minutestxt">{{ __('Minutes') }}</h2>
                            </div>
                            <div class="box">
                                <h1 id="seconds">00</h1>
                                <h2 id="secondstxt">{{ __('Seconds') }}</h2>
                            </div>
                        </div>

                        <div id="ended-alert" style="background: rgb(204, 24, 24); display: none;" class="alert">
                            <h1 style="padding: 50px 20px; color: white; text-align: center; font-size: 24px;">
                                {{ __('We are sorry, Event ended !') }}
                            </h1>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!-- End Special Offer -->

    <!-- Start Home Product List -->
    <section class="home-product-list section">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">{{ __('Best Sellers') }}</h4>

                    @foreach($bestSellers as $product)
                    <div class="single-list">
                        <div class="list-image">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <span>${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">{{ __('New Arrivals') }}</h4>

                    @foreach($newArrivals as $product)
                    <div class="single-list">
                        <div class="list-image">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <span>${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">{{ __('Top Rated') }}</h4>

                    @foreach($topRated as $product)
                    <div class="single-list">
                        <div class="list-image">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <span>${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>
    {{-- <section class="home-product-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">Best Sellers</h4>
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/01.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">GoPro Hero4 Silver</a>
                            </h3>
                            <span>$287.99</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/02.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Puro Sound Labs BT2200</a>
                            </h3>
                            <span>$95.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/03.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">HP OfficeJet Pro 8710</a>
                            </h3>
                            <span>$120.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                </div>
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">New Arrivals</h4>
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/04.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">iPhone X 256 GB Space Gray</a>
                            </h3>
                            <span>$1150.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/05.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Canon EOS M50 Mirrorless Camera</a>
                            </h3>
                            <span>$950.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/06.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Microsoft Xbox One S</a>
                            </h3>
                            <span>$298.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">Top Rated</h4>
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/07.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Samsung Gear 360 VR Camera</a>
                            </h3>
                            <span>$68.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/08.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Samsung Galaxy S9+ 64 GB</a>
                            </h3>
                            <span>$840.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="{{ asset('assets/images/09.jpg') }}" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Zeus Bluetooth Headphones</a>
                            </h3>
                            <span>$28.00</span>
                        </div>
                    </div>
                    <!-- End Single List -->
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Home Product List -->

    <!-- Start Brands Area -->
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">{{ __('Popular Brands') }}</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">

                    @foreach($brands as $brand)
                    <div class="brand-logo">
                        <a href="{{ route('products.index', ['brand_id' => $brand->id]) }}">
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}">
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
            {{-- <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/01.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/02.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/04.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/05.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/06.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/01.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/02.png') }}" alt="#">
                    </div>
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/04.png') }}" alt="#">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- End Brands Area -->

    <!-- Start Blog Section Area -->
    <section class="blog-section section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Our Latest News') }}</h2>
                        <p>{{ __('Stay updated with our latest articles, product reviews, and tech insights.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($latestNews as $post)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{ route('news.show', $post->slug) }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ trim($post->title) }}">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">{{ $post->category_name }}</a>

                            <h4>
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                            </h4>

                            <p>{{ \Illuminate\Support\Str::limit($post->description, 100) }}</p>

                            <div class="button">
                                <a href="{{ route('news.show', $post->slug) }}" class="btn">{{ __('Read More') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Blog Section Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('Free Shipping') }}</h5>
                        <span>{{ __('On orders over $99') }}</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('24/7 Support') }}</h5>
                        <span>{{ __('Live Chat Or Call') }}</span>
                    </div>
                </li>
                <!-- Online Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('Online Payment') }}</h5>
                        <span>{{ __('Secure Payment Services') }}</span>
                    </div>
                </li>
                <!-- Easy Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('Easy Return') }}</h5>
                        <span>{{ __('Hassle Free Shopping') }}</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->
    @push('script')
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider'
            , slideBy: 'page'
            , autoplay: true
            , autoplayButtonOutput: false
            , mouseDrag: true
            , gutter: 0
            , items: 1
            , nav: false
            , controls: true
            , controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>']
        , });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel'
            , autoplay: true
            , autoplayButtonOutput: false
            , mouseDrag: true
            , gutter: 15
            , nav: false
            , controls: false
            , responsive: {
                0: {
                    items: 1
                , }
                , 540: {
                    items: 3
                , }
                , 768: {
                    items: 5
                , }
                , 992: {
                    items: 6
                , }
            }
        });

    </script>
    <script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

        const timer = () => {
            const now = new Date().getTime();
            let diff = finaleDate - now;
            if (diff < 0) {
                document.querySelector('.alert').style.display = 'block';
                document.querySelector('.container').style.display = 'none';
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
            let seconds = Math.floor(diff % (1000 * 60) / 1000);

            days <= 99 ? days = `0${days}` : days;
            days <= 9 ? days = `00${days}` : days;
            hours <= 9 ? hours = `0${hours}` : hours;
            minutes <= 9 ? minutes = `0${minutes}` : minutes;
            seconds <= 9 ? seconds = `0${seconds}` : seconds;

            document.querySelector('#days').textContent = days;
            document.querySelector('#hours').textContent = hours;
            document.querySelector('#minutes').textContent = minutes;
            document.querySelector('#seconds').textContent = seconds;

        }
        timer();
        setInterval(timer, 1000);

    </script>

    <script>
        const countDownDate = new Date("Dec 31, 2026 23:59:59").getTime();

        const timerInterval = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (document.getElementById("days")) {
                document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
                document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
                document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
                document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;
            }

            if (distance < 0) {
                clearInterval(timerInterval);
                document.getElementById("timer-box").style.display = "none";
                document.getElementById("ended-alert").style.display = "block";
            }
        }, 1000);

    </script>

    @endpush

</x-front-layout>