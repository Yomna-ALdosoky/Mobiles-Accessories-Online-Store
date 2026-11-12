<x-front-layout :title="$blog->title">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ Str::limit($blog->title, 35) }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-nav">
                            <ul class="breadcrumb-nav">
                                <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                                <li><a href="{{ route('blogs.index') }}">{{ __('Blogs') }}</a></li>
                                <li>{{ Str::limit($blog->title, 25) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start Blog Single Area -->
    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-details">
                            <div class="main-content-head">
                                <div class="post-thumbnils">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="meta-information">
                                    <h2 class="post-title">
                                        <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h2>
                                    <!-- End Meta Info -->
                                    <ul class="meta-info">
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-user"></i> {{
                                                $blog->user->name ?? 'Admin' }}</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-calendar"></i> {{
                                                $blog->published_at ? $blog->published_at->format('d M Y') :
                                                $blog->created_at->format('d M Y') }}</a>
                                        </li>
                                        @if($blog->category)
                                        <li>
                                            <a href="{{ $blog->category ? route('categories.show', $blog->category->slug) : 'javascript:void(0)' }}"><i class="lni lni-tag"></i> {{
                                                $blog->category->name }}</a>
                                        </li>
                                        @endif

                                    </ul>
                                </div>
                                <div class="detail-inner">
                                    {!! $blog->content !!}
                                    <div class="post-bottom-area">
                                        @if(isset($blog->tags) && count($blog->tags) > 0)
                                        <div class="post-tag">
                                            <ul>
                                                @foreach($blog->tags as $tag)
                                                <li><a href="javascript:void(0)">#{{ $tag->name }},</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <!-- End Post Tag -->

                                        <!-- Post Social Share -->
                                        <div class="post-social-media">
                                            <h5 class="share-title">{{ __('Share post :') }}</h5>
                                            <ul>
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                                        <i class="lni lni-facebook-filled"></i>
                                                        <span>facebook</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}" target="_blank">
                                                        <i class="lni lni-twitter-original"></i>
                                                        <span>twitter</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($blog->title) }}"
                                                        target="_blank">
                                                        <i class="lni lni-linkedin-original"></i>
                                                        <span>linkedin</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Post Social Share -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-blogSidebar :featuredblogs="$featuredblogs" :categories="$categories" />
            </div>
        </div>
    </section>
    <!-- End Blog Single Area -->
</x-front-layout>