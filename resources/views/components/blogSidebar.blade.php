<aside class="col-lg-4 col-md-12 col-12">
    <div class="sidebar blog-grid-page">
        <!-- Start Single Widget -->
        <div class="widget search-widget">
            <h5 class="widget-title">{{ __('Search This Site') }}</h5>
            <form action="{{ route('blogs.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search Here...') }}">
                <button type="submit"><i class="lni lni-search-alt"></i></button>
            </form>
        </div>
        <!-- End Single Widget -->
        <!-- Start Single Widget -->
        <div class="widget popular-feeds">
            <h5 class="widget-title">{{ __('Featured Posts') }}</h5>
            <div class="popular-feed-loop">
                @foreach ($featuredblogs as $featured)
                <div class="single-popular-feed">
                    <div class="feed-desc">
                        <a class="feed-img" href="{{ route('blogs.show', $featured->slug) }}">
                            <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}">
                        </a>
                        <h6 class="post-title">
                            <a href="{{ route('blogs.show', $featured->slug) }}">{{ $featured->title}}</a>
                        </h6>
                        <span class="time"><i class="lni lni-calendar"></i>
                            {{ $featured->published_at ? $featured->published_at->format('dS M Y') : $featured->created_at->format('dS M Y') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- End Single Widget -->
        <!-- Start Single Widget -->
        <div class="widget categories-widget">
            <h5 class="widget-title">{{ __('Top Categories') }}</h5>
            <ul class="custom">
                @foreach ($categories as $category)
                <li>
                    <a href="{{ route('blogs.index', ['category_id' => $category->id]) }}">
                        {{$category->name }}
                    </a>
                    <span>({{ $category->blogs_count }})</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>