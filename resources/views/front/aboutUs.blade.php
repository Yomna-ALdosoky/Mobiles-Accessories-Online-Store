<x-front-layout :title="__('About Us')">
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('About Us') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                        <li>{{ __('About Us') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="content-left">
                        <img src="https://via.placeholder.com/540x420" alt="{{ __('About Our Store') }}">
                        <a href="https://www.youtube.com/watch?v=r44RKWyfcFw" class="glightbox video">
                            <i class="lni lni-play"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- content-1 start -->
                    <div class="content-right">
                        <h2>{{ __('ShopGrids - Your Trusted & Reliable Partner.') }}</h2>
                        <p>{{ __('about_paragraph_1', ['store_name' => config('app.name', 'ShopGrids')]) }}</p>
                        <p>{{ __('about_paragraph_2') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Team Area -->
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ __('Our Core Team') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ __('team_section_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Member 1 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="Grace Wright">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Grace Wright</h3>
                                <h5>{{ __('Founder, CEO') }}</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="Taylor Jackson">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Taylor Jackson</h3>
                                <h5>{{ __('Financial Director') }}</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="Quinton Cross">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Quinton Cross</h3>
                                <h5>{{ __('Marketing Director') }}</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 4 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="Liana Mullen">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Liana Mullen</h3>
                                <h5>{{ __('Lead Designer') }}</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Area -->
</x-front-layout>