<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
{{-- <html class="no-js" lang="ar" dir="rtl"> --}}

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $title }}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- ========================= CSS here ========================= -->
    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}" />
    @else
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />

    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/main.rtl.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/rtl-fix.css') }}" />
    @else
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    @endif

    <style>
        .topbar .container {
            display: block !important;
        }

        /* .single-category .images img {
            max-height: 250px;
            width: auto;
            object-fit: contain;
            margin-right: -20px;
        } */

        /* .single-category .images img {
            max-height: 250px;
            width: auto;
            object-fit: contain;
            margin-inline-end: -20px;
        } */
        .single-category .images img {
            max-width: 45%;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 32px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4), 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: pulse-whatsapp 2s infinite;
        }

        .whatsapp-tooltip {
            position: absolute;
            right: 75px;
            background-color: #ffffff;
            color: #333333;
            padding: 10px 16px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            opacity: 1;
            visibility: visible;
            text-align: right;
            line-height: 1.4;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translateY(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: transparent transparent transparent #ffffff;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            color: #FFF;
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 6px 15px rgba(0, 0, 0, 0.3);
            animation: none;
        }

        @keyframes pulse-whatsapp {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }
    </style>

    @stack('styles')

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <!-- Start Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                            <ul class="menu-top-link">
                                <li>
                                    <div class="select-position">
                                        <form action="{{ route('currency.store') }}" method="post">
                                            @csrf
                                            @php
                                            $locale = App::getLocale();
                                            $extraCurrencies = match ($locale) {
                                            'en', 'ar' => ['EGP', 'EUR', 'TRY', 'SAR'],
                                            'fr' => ['EUR'],
                                            'tr' => ['TRY'],
                                            'ko' => ['EUR'],
                                            default => []
                                            };
                                            @endphp

                                            <select name="currency_code" onchange="this.form.submit()">
                                                <option value="USD" @selected('USD'==session('currency_code'))>
                                                    {{ __('USD') }} (USD)
                                                </option>

                                                @foreach($extraCurrencies as $code)
                                                <option value="{{ $code }}" @selected($code==session('currency_code'))>
                                                    {{ __($code) }} ({{ $code }})
                                                </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <div class="select-position">
                                        <form action="" method="get">
                                            <select name="locale" onchange="location = this.value;">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                                                $properties)
                                                <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" @selected($localeCode==App::currentLocale())>
                                                    {{ \Illuminate\Support\Str::ucfirst($properties['native']) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-middle">
                            <ul class="useful-links">
                                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li><a href="{{ route('aboutUs') }}">{{ __('About Us') }}</a></li>
                                @auth
                                <li>
                                    <a href="{{ route('orders.index') }}">
                                        {{ __('My Orders') }}
                                    </a>
                                </li>
                                @endauth
                                <li><a href="{{ route('contactUs') }}">{{ __('Contact Us')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-end">
                            @auth
                            <div class="user">
                                <i class="lni lni-user"></i>
                                {{ Auth::user()->name }}
                            </div>
                            <ul class="user-login">
                                <li>
                                    <a href="{{ route('user-password.edit') }}">
                                        {{ (Auth::user()->isSocialUser() && !Auth::user()->hasPassword()) ?
                                        __('Set Password') : __('Change Password') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit()">
                                        {{ __('Sign Out') }}
                                    </a>
                                </li>
                                <form action="{{ route('logout') }}" id="logout" method="post" style="display: none">
                                    @csrf
                                </form>
                            </ul>
                            @else
                            <div class="user">
                                <i class="lni lni-user"></i>
                                {{ __('Hello') }}
                            </div>
                            <ul class="user-login">
                                <li>
                                    <a href="{{ route('login') }}">{{ __('Sign In') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Start Header Middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-7">
                        <!-- Start Header Logo -->
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ asset('assets/images/logo/logo.jpg') }}" alt="Logo">
                        </a>
                        <!-- End Header Logo -->
                    </div>
                    <div class="col-lg-5 col-md-7 d-xs-none">
                        <div class="main-menu-search">
                            <!-- navbar search start -->
                            <form action="{{ route('shop.index') }}" method="GET">
                                <div class="navbar-search search-style-5">
                                    <div class="search-select">
                                        <div class="select-position">
                                            <select name="category_id" id="select1">
                                                <option value="">{{ __('All') }}</option>
                                                @foreach($mega_categories as $category)
                                                <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="search-input">
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search') }}">
                                    </div>
                                    <div class="search-btn">
                                        <button type="submit"><i class="lni lni-search-alt"></i></button>
                                    </div>
                                </div>
                            </form>
                            <!-- navbar search end -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-2 col-5">
                        <div class="middle-right-area">
                            <div class="nav-hotline">
                                <i class="lni lni-phone"></i>
                                <h3>{{ __('Hotline') }}:
                                    <span>{{ $settings->primary_phone }}</span>
                                </h3>
                            </div>
                            <div class="navbar-cart">
                                <div class="wishlist">
                                    <a href="{{ route('wishlist.index') }}">
                                        <i class="lni lni-heart"></i>
                                        <span class="total-items">{{ auth()->check() ? auth()->user()->wishlist()->count() : 0 }}</span>
                                    </a>
                                </div>
                                <x-cart-menu />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Middle -->
        <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                        <div class="mega-category-menu">
                            <span class="cat-button"><i class="lni lni-menu"></i>{{ __('All Categories') }}</span>
                            <ul class="sub-category">
                                @foreach($mega_categories as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category->slug ?? $category->id) }}">
                                        {{ $category->name }}
                                        @if($category->children->isNotEmpty())
                                        <i class="lni lni-chevron-right"></i>
                                        @endif
                                    </a>

                                    @if($category->children->isNotEmpty())
                                    <ul class="inner-sub-category">
                                        @foreach($category->children as $child)
                                        <li>
                                            <a href="{{ route('categories.show', $child->slug ?? $child->id) }}">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Mega Category Menu -->
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="{{ route('home') }}" aria-label="Toggle navigation">{{ __('Home')
                                            }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="dd-menu active collapsed" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">{{ __('Pages') }}</a>
                                        <ul class="sub-menu collapse" id="submenu-1-2">
                                            <li class="nav-item"><a href="{{ route('aboutUs') }}">{{ __('About Us')
                                                    }}</a></li>
                                            <li class="nav-item"><a href="faq.html">{{ __('Faq') }}</a></li>
                                            <li class="nav-item active"><a href="{{ route('login') }}">{{ __('Sign
                                                    In')}}</a></li>
                                            @auth
                                            <li class="nav-item"><a href="{{ route('front.2fa') }}">{{__('Security')}}</a>
                                            </li>
                                            @endauth
                                            <li class="nav-item"><a href="{{ route('register') }}">{{
                                                    __('Register')}}</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">{{ __('Shop') }}</a>
                                        <ul class="sub-menu collapse" id="submenu-1-3">
                                            <li class="nav-item"><a href="{{ route('shop.index') }}">{{ __('Shop')
                                                    }}</a>
                                            </li>
                                            <li class="nav-item"><a href="{{ route('cart.index') }}">{{ __('Cart')
                                                    }}</a></li>
                                            <li class="nav-item"><a href="{{ route('checkout') }}"> {{ __('Checkout')
                                                    }}</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('blogs.index') }}" aria-label="Toggle navigation">
                                            {{ __('Blogs') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('contactUs') }}" aria-label="Toggle navigation">
                                            {{ __('Contact Us') }}</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Nav Social -->
                    <div class="nav-social">
                        <h5 class="title">{{ __('Follow Us') }}:</h5>
                        <ul>
                            <li>
                                <a href="{{ $settings->facebook_url }}"><i class="lni lni-facebook-filled"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings->linkedin_url }}"><i class="lni lni-linkedin-original"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings->instagram_url }}"><i class="lni lni-instagram"></i></a>
                            </li>
                            <li>
                                <a
                                    href="{{ Str::startsWith($settings->whatsapp_number, 'http') ? $settings->whatsapp_number : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"><i
                                        class="lni lni-whatsapp"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Nav Social -->
                </div>
            </div>
        </div>
        <!-- End Header Bottom -->
    </header>
    <!-- End Header Area -->


    <!-- Start Account Login Area -->
    {{ $breadcrumb ?? '' }}
    {{ $slot }}
    <!-- End Account Login Area -->

    <!-- Start Footer Area -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/logo/white-logo.svg') }}" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="footer-newsletter">
                                <h4 class="title">
                                    {{ __('Subscribe to our Newsletter') }}
                                    <span>{{ __('Get all the latest information, Sales and Offers.') }}</span>
                                </h4>
                                <div class="newsletter-form-head">
                                    <form action="#" method="get" target="_blank" class="newsletter-form">
                                        <input name="EMAIL" placeholder="{{ __('Email address here...') }}" type="email">
                                        <div class="button">
                                            <button class="btn">{{ __('Subscribe') }}<span class="dir-part"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="single-footer f-contact">
                                <h3>{{ __('Get In Touch With Us') }}</h3>

                                <div class="d-flex align-items-center gap-2 mb-2" style="color: #d6d6d6;">
                                    <i class="fas fa-phone-alt" style="width: 16px;"></i>
                                    <span>{{ $settings?->primary_phone }}</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2" style="color: #d6d6d6;">
                                    <i class="fas fa-map-marker-alt mt-1" style="width: 16px;"></i>
                                    <span>{{ $settings?->address }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-envelope" style="color: #d6d6d6; width: 16px;"></i>
                                    <a href="mailto:{{ $settings?->support_email }}" style="color: #d6d6d6 !important;">
                                        {{ $settings?->support_email }}
                                    </a>
                                </div>
                                <div class="single-footer f-link mt-4">
                                    <h6 class="mb-3 fw-bold" style="color: #d6d6d6; font-size: 13px; letter-spacing: 0.5px;">
                                        {{ __('FOLLOW US:') }}
                                    </h6>
                                    <ul class="d-flex gap-3 list-unstyled mb-0">
                                        <li>
                                            <a href="{{ $settings->facebook_url }}" target="_blank" class="fs-5" title="Facebook">
                                                <i class="lni lni-facebook-filled"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="fs-5" title="LinkedIn">
                                                <i class="lni lni-linkedin-original"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $settings->instagram_url }}" target="_blank" class="fs-5" title="Instagram">
                                                <i class="lni lni-instagram-original"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ Str::startsWith($settings->whatsapp_number, 'http') ? $settings->whatsapp_number : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"
                                                target="_blank" class="fs-5" title="WhatsApp">
                                                <i class="lni lni-whatsapp"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>{{ __('Information') }}</h3>
                                <ul>
                                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>

                                    <li><a href="{{ route('aboutUs') }}">{{ __('About Us') }}</a></li>
                                    <li><a href="{{ route('contactUs') }}">{{ __('Contact Us') }}</a></li>
                                    <li><a href="{{ route('shop.index') }}">{{ __('Shop') }}</a></li>
                                    <li><a href="{{ route('blogs.index') }}">{{ __('Blog') }}</a></li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>{{ __('Shop Departments') }}</h3>
                                <ul>
                                    @if(isset($mega_categories) && $mega_categories->isNotEmpty())
                                    @foreach($mega_categories->take(5) as $category)
                                    <li><a href="{{ route('categories.show', $category->slug ?? $category->id) }}">{{
                                            $category->name }}</a></li>
                                    @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-12">
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright">
                                <p>{{ __('Designed and Developed by') }} <a href="https://www.linkedin.com/in/yomna-eldosoky/" rel="nofollow" target="_blank">Yomna ELdosoky</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright text-lg-end">
                                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All Rights Reserved.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ End Footer Area -->

    {{-- <a href="https://wa.me/201090202654?text={{ urlencode(__('Hello, I would like to inquire about a product in your store and technical support')) }}" class="whatsapp-float" target="_blank"
        title="{{ __('Technical support via WhatsApp') }}">

        <span class="whatsapp-tooltip">
            {{ __('Hi 👋💙') }}<br>
            {{ __('Need help with your order?') }}
        </span>

        <i class="lni lni-whatsapp"></i>
    </a> --}}


    <a href="https://web.whatsapp.com/" class="whatsapp-float" target="_blank" rel="noopener noreferrer" title="{{ __('Technical support via WhatsApp') }}">

        <span class="whatsapp-tooltip">
            {{ __('Hi 👋💙') }}<br>
            {{ __('Need help with your order?') }}
        </span>

        <i class="lni lni-whatsapp"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('script')
</body>

</html>