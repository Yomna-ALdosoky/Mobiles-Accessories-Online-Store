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
                            <div class="single-slider" style="background-image: url({{ asset('assets/images/iphone12.jpg') }});">
                                <div class="content">
                                    <h2 style="color: #111 !important;">
                                        <span style="color: #2563eb; font-weight: bold;">{{ __('No restocking fee ($35 savings)') }}</span>
                                        {{ __('Apple Ecosystem & Pro Devices') }}
                                    </h2>
                                    <p style="color: #374151; font-weight: 500;">{{ __('Experience the latest lineup including iPhone Pro, MacBook Air, Apple Watch, and AirPods.') }}</p>
                                    <h3 style="color: #111 !important;"><span span style="color: #374151;">{{ __('Starting From') }}</span> $1,199.00</h3>
                                    <div class="button">
                                        <a href="{{ route('shop.index') }}" class="btn">{{ __('Shop Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                            <!-- Start Single Slider -->
                            <div class="single-slider" style="background-image: url({{ asset('assets/images/ssaa.jpg') }});">
                                <div class="content">
                                    <h2 style="color: #111 !important;">
                                        <span style="color: #2563eb; font-weight: bold;">{{ __('Galaxy Ecosystem') }}</span>
                                        {{ __('Get the Best Deal on Samsung Flagships') }}
                                    </h2>
                                    <p style="color: #374151; font-weight: 500;">
                                        {{ __('Discover the latest Galaxy devices for ultimate performance.') }}
                                    </p>
                                    <h3 style="color: #111 !important;"><span span style="color: #374151;">{{ __('Starting From:') }}</span>$899.00</h3>
                                    <div class="button">
                                        <a href="{{ route('shop.index') }}" class="btn">{{ __('Shop Now') }}</a>
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
                            <div class="hero-small-banner" style="background-image: url({{ asset('assets/images/image10.jpg') }});">
                                <div class="content">
                                    <h2>
                                        <span>{{ __('New Arrival')}}</span>
                                        {{ __('iPhone 18 Pro') }}
                                    </h2>
                                    <h3>$1399.99</h3>
                                </div>
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>{{ __('Weekly Sale!')}}</h2>
                                    <p>{{ __('Saving up to 50% off all online store items this week.')}}</p>
                                    <div class="button">
                                        <a class="btn" href="{{ route('shop.index') }}">{{ __('Shop Now') }}</a>
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
                        <p> {{ __('Explore what everyone is talking about—our most popular tech gear and bestselling electronics.') }}</p>
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
                        <p>{{ __('Explore what everyone is talking about—our most popular tech gear and bestselling electronics.') }}</p>
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

    <section class="banner section">
        <div class="container">
            <div class="row">
                @foreach($subBannerProducts as $index => $banner_prod)
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner {{ $loop->last ? 'custom-responsive-margin' : '' }}" style="background-image: url('{{ asset('storage/' . $banner_prod->coverImage?->image) }}');">
                        <div class="content">
                            <h2>{{ $banner_prod->name }}</h2>
                            <p style="max-width: 270px; line-height: 1.6;">
                                {!! nl2br(e(Str::words($banner_prod->description, 12, '...'))) !!}
                            </p>
                            <div class="button">
                                <a href="{{ route('products.show', $banner_prod->slug) }}" class="btn">
                                    {{ __('Shop Now') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- End Banner Area -->
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Special Offer') }}</h2>
                        <p>{{ __('Discover our exclusive hand-picked deals and save big on top electronics today.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @foreach($specialGridProducts as $prod)
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ asset('storage/' . $prod->coverImage?->image) }}" alt="{{ $prod->name }}">
                                    <div class="button">
                                        <a href="{{ route('cart.index') }}" class="btn"><i class="lni lni-cart"></i> {{ __('Add to Cart') }}</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">{{ $prod->category->name ?? __('General') }}</span>
                                    <h4 class="title">
                                        <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                                    </h4>
                                    <ul class="review">
                                        @for($i = 1; $i <= 5; $i++) <li><i class="lni lni-star{{ $i <= $prod->rating ? '-filled' : '' }}"></i></li>
                                            @endfor
                                            <li><span>{{ number_format($prod->rating, 1) }} {{ __('Review(s)') }}</span>
                                            </li>
                                    </ul>
                                    <div class="price">
                                        <span>{{ Currency::format($prod->price) }}</span>
                                        @if($prod->compare_price)
                                        <span class="discount-price" style="text-decoration: line-through; color: #888; font-size: 14px; margin-left: 8px;">
                                            {{ Currency::format($prod->compare_price) }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- @if($bannerProduct)
                    <div class="single-banner right" style="background-image:url('{{ asset('assets/images/banner-3-bg.jpg') }}'); margin-top: 30px;">
                        <div class="content">
                            <h2>{{ $bannerProduct->name }}</h2>
                            <p>{{ Str::limit($bannerProduct->description, 80) }}</p>
                            <div class="price">
                                <span>{{ Currency::format($bannerProduct->price) }}</span>
                            </div>
                            <div class="button">
                                <a href="{{ route('products.show', $bannerProduct->slug) }}" class="btn">{{ __('Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                    @endif --}}

                    @if($bannerCategory)
                    <div class="single-banner right" style="background-image:url('{{ asset('assets/images/Modern.png') }}'); margin-top: 30px;">
                        <div class="content">
                            <h2>{{ $bannerCategory->name }}</h2>
                            <p>
                                {!! nl2br(wordwrap($bannerCategory->description, 56, "\n", true)) !!}
                            </p>
                            <div class="button">
                                <a href="{{ route('categories.show', $bannerCategory->slug) }}" class="btn">{{ __('Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    @if($specialOfferProduct)
                    <div class="offer-content">
                        <div class="image">
                            <img src="{{ asset('storage/' . $specialOfferProduct->coverImage?->image) }}" alt="{{ $specialOfferProduct->name }}">
                            @if($specialOfferProduct->sale_percent > 0)
                            <span class="sale-tag">-{{ $specialOfferProduct->sale_percent }}%</span>
                            @endif
                        </div>
                        <div class="text">
                            <h2><a href="{{ route('products.show', $specialOfferProduct->slug) }}">{{ $specialOfferProduct->name }}</a></h2>
                            <ul class="review">
                                @for($i = 1; $i <= 5; $i++) <li><i class="lni lni-star{{ $i <= $specialOfferProduct->rating ? '-filled' : '' }}"></i>
                                    </li>
                                    @endfor
                                    <li>
                                        <span>{{ number_format($specialOfferProduct->rating, 1) }}
                                            {{ __('Review(s)')}}
                                        </span>
                                    </li>
                            </ul>
                            <div class="price">
                                <span>{{ Currency::format($specialOfferProduct->price) }}</span>
                                @if($specialOfferProduct->compare_price)
                                <span class="discount-price">
                                    {{ Currency::format($specialOfferProduct->compare_price)}}
                                </span>
                                @endif
                            </div>
                            <p>{{ Str::limit($specialOfferProduct->description, 120) }}</p>
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
                                <img src="{{ asset('storage/' . $product->coverImage?->image) }}" alt="{{ $product->name }}">
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
                                <img src="{{ asset('storage/' .$product->coverImage?->image) }}" alt="{{ $product->name }}">
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
                                <img src="{{ asset('storage/' . $product->coverImage?->image) }}" alt="{{ $product->name }}">
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
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}">
                    </div>
                    @endforeach

                </div>
            </div>
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

                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{ route('blogs.show', $blog->slug) }}">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ trim($blog->title) }}">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="{{ route('categories.show', $blog->category->slug) }}">{{
                                $blog->category->name }}</a>

                            <h4>
                                <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h4>

                            <p>{{ \Illuminate\Support\Str::limit($blog->excerpt, 100) }}</p>

                            <div class="button">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn">{{ __('Read More') }}</a>
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