<x-front-layout :title="$about->title ?? __('About Us')">
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
                        <img src="{{ !empty($about->image) ? asset('storage/' . ltrim($about->image, '/')) : 'https://via.placeholder.com/540x420' }}"
                            alt="{{ $about->title }}">
                        @if(!empty($about->video_url))
                        <a href="{{ $about->video_url }}" class="glightbox video">
                            <i class="lni lni-play"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- content-1 start -->
                    <div class="content-right">
                        <h2>{{ $about->title }}</h2>
                        {!! $about->paragraph_1 !!}
                        {!! $about->paragraph_2 !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Team Area -->
    @if(!empty($about->team_members))
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ $about->team_title ?? __('Our Core Team') }}
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ $about->team_description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($about->team_members as $member)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-team">
                        <div class="image">
                            <img src="{{ !empty($member['image']) ? Storage::url($member['image']) : 'https://via.placeholder.com/300x300' }}"
                                alt="{{ $member['name'] ?? '' }}">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>{{ $member['name'] ?? '' }}</h3>
                                <h5>{{ $member['job_title'] ?? '' }}</h5>
                                <ul class="social">
                                    @if(!empty($member['facebook_url']))
                                    <li><a href="{{ $member['facebook_url'] }}" target="_blank"><i
                                                class="lni lni-facebook-filled"></i></a></li>
                                    @endif
                                    @if(!empty($member['twitter_url']))
                                    <li><a href="{{ $member['twitter_url'] }}" target="_blank"><i
                                                class="lni lni-twitter-original"></i></a></li>
                                    @endif
                                    @if(!empty($member['skype_url']))
                                    <li><a href="{{ $member['skype_url'] }}" target="_blank"><i
                                                class="lni lni-linkedin-original"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End Team Area -->
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const myLightbox = GLightbox({
                selector: '.glightbox'
            });
        });
    </script>
</x-front-layout>