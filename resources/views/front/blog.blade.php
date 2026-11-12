<x-front-layout :title="__('Blogs')">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Blogs') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-nav">
                            <ul class="breadcrumb-nav">
                                <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                                <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                                <li>{{ __('Blogs') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start Blog Singel Area -->
    <section class="section blog-section blog-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @forelse ($blogs as $blog)
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Start Single Blog -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <a class="category" href="javascript:void(0)">{{ $blog->category->name}}</a>
                                    <h4>
                                        <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h4>
                                    <p>{{$blog->excerpt }}</p>
                                    <div class="button">
                                        <a href="{{ route('blogs.show', $blog->slug) }}" class="btn">
                                            {{ __('Read More') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Blog -->
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center py-5 my-4">
                                <div class="mb-3">
                                    <i class="lni lni-search-alt text-muted" style="font-size: 3.5rem;"></i>
                                </div>
                                <h4 class="fw-bold mb-2">{{ __('No Results Found') }}</h4>
                                <p class="text-muted mb-4">
                                    {{ __('We could not find any articles matching') }} "<strong>{{ request('search') }}</strong>".
                                </p>
                                <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm px-4 py-2">
                                    {{ __('Show All Blogs') }}
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <!-- Pagination -->
                    <div class="pagination left blog-grid-page">
                        <ul class="pagination-list">
                            {{ $blogs->withQueryString()->links('pagination.custom') }}
                        </ul>
                    </div>
                    <!--/ End Pagination -->
                </div>
                <x-blogSidebar :featuredblogs="$featuredblogs" :categories="$categories" />

            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->

</x-front-layout>
