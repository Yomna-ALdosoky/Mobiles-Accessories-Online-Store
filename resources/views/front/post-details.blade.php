<x-front-layout title="Checkout">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ $post->title }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            {{-- <li><a href="{{ route('products.index') }}">Shop</a></li> --}}
                            <li>c{{ $post->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-details">
                            <div class="main-content-head">
                                <div class="post-thumbnils">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                </div>
                                <div class="meta-information">
                                    <h2 class="post-title">
                                        <a href="javascript:void(0)">{{ $post->title }}</a>
                                    </h2>

                                    <ul class="meta-info">
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-user"></i>
                                                {{ $post->admin ? $post->admin->name : 'Unknown Admin' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-calendar"></i>
                                                {{ $post->created_at ? $post->created_at->format('d M Y') :
                                                now()->format('d M Y') }} </a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ $post->category ? route('categories.show', $post->category->slug) : 'javascript:void(0)' }}"><i
                                                    class="lni lni-tag"></i>
                                                {{ $post->category ? $post->category->name : 'Uncategorized' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-timer"></i>
                                                {{ $post->reading_time }} min read
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="detail-inner">
                                    <p>{!! nl2br(e($post->description)) !!}</p>

                                    <ul class="list">
                                        <li><i class="lni lni-checkmark-circle"></i> For those of you who are serious
                                            about having more.</li>
                                        <li><i class="lni lni-checkmark-circle"></i> There are a million distractions in
                                            every facet of our lives.</li>
                                        <li><i class="lni lni-checkmark-circle"></i> The sad thing is the majority of
                                            people have no clue about what they truly want.</li>
                                    </ul>

                                    {{-- <blockquote>
                                        <div class="icon">
                                            <i class="lni lni-quotation"></i>
                                        </div>
                                        <h4>"Don't demand that things happen as you wish, but wish that they happen as
                                            they do happen, and you will go on well."</h4>
                                        <span>- Epictetus, The Enchiridion</span>
                                    </blockquote> --}}

                                    <div class="post-bottom-area">
                                        <div class="post-tag">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('categories.show', $post->category->slug) }}">
                                                        #{{ strtolower($post->category->name) }}
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="post-social-media">
                                            <h5 class="share-title">Share post :</h5>
                                            @php
                                            // 🌟 بنجيب رابط المقالة الحالي كامل ديناميكياً من لارافيل
                                            $currentUrl = urlencode(request()->fullUrl());
                                            // 🌟 بنجيب عنوان المقالة عشان يظهر مع الشير في المنصات اللي بتدعمه
                                            $postTitle = urlencode($post->title);
                                            @endphp
                                            <ul>
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="lni lni-facebook-filled"></i>
                                                        <span>facebook</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $postTitle }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="lni lni-twitter-original"></i>
                                                        <span>twitter</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="lni lni-linkedin-original"></i>
                                                        <span>linkedin</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--
                            <div class="post-comments">
                                <h3 class="comment-title"><span>Post comments</span></h3>
                                <ul class="comments-list">
                                </ul>
                            </div>

                            <div class="comment-form">
                                <h3 class="comment-reply-title">Leave a comment</h3>
                                <form action="#" method="POST">
                                </form>
                            </div>
                            --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>