<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\AboutUs;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $homeData = Cache::remember('home_page_data', 3600, function () {

            $products = Product::active()
                ->with('category', 'coverImage')
                ->where('status', 'active')
                ->when(request('category_id'), function ($query) {
                    $query->where('category_id', request('category_id'));
                })
                ->when(request('search'), function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                })
                ->latest()
                ->take(8)
                ->get();

            $subBannerProducts = Product::active()
                ->with('coverImage')
                ->where('featured', 1)
                ->whereNotIn('id', $products->pluck('id'))
                ->latest()
                ->limit(2)
                ->get();

            $specialGridProducts = Product::active()
                ->with('coverImage')
                ->where('rating', '>', 0)
                ->orderByDesc('rating')
                ->take(3)
                ->get();

            $bannerCategory = Category::active()
                ->where('name', 'like', '%Smartphones & Tablets%')
                ->latest()
                ->first();

            $specialOfferProduct = Product::with('category')
                ->active()
                ->whereNotNull('compare_price')
                ->whereColumn('compare_price', '>', 'price')
                ->selectRaw('*, ((compare_price - price) / compare_price) as discount_percentage')
                ->orderByDesc('discount_percentage')
                ->latest()
                ->first();

            $categories = Category::active()
                ->when($bannerCategory, function ($query) use ($bannerCategory) {
                    $query->where('id', '!=', $bannerCategory->id);
                })
                ->with(['products' => fn($query) => $query->active()->with('coverImage')->latest()->take(3)])
                ->latest()
                ->limit(6)
                ->get();

            $bestSellers = Product::active()
                ->with('coverImage')
                ->where('featured', 1)
                ->latest()
                ->limit(3)
                ->get();

            $newArrivals = Product::active()
                ->with('coverImage')
                ->latest()
                ->limit(3)
                ->get();

            $topRated = Product::active()
                ->with('coverImage')
                ->orderByDesc('rating')
                ->limit(3)
                ->get();

            $blogs = Blog::where('is_published', true)
                ->latest()
                ->take(3)
                ->get();

            $brands = Brand::where('status', 'active')
                ->latest()
                ->get();

            return compact(
                'products',
                'subBannerProducts',
                'specialGridProducts',
                'bannerCategory',
                'specialOfferProduct',
                'categories',
                'bestSellers',
                'newArrivals',
                'topRated',
                'blogs',
                'brands'
            );
        });
        return view('front.home', $homeData);
    }

    public function aboutUs()
    {
        $about = AboutUs::first();
        return view('front.aboutUs', compact('about'));
    }
    public function contactUs()
    {

        return view('front.contactUs');
    }
    public function storeContactUs(StoreContactRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()->back()->with('success', __('Your message has been sent successfully!'));
    }
}
