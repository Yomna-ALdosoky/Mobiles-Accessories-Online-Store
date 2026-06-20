<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->whereHas('category')->Active()
            ->latest()
            ->limit(8)->get();

        $sub_banner_products = Product::Active()->where('featured', 1)
            ->latest()
            ->limit(2)
            ->get();

        $special_grid_products = $products->take(3);

        $banner_product = Product::Active()->where('featured', 1)->latest()->first()
            ?? Product::Active()->latest()->first();

        $special_offer_product = Product::with('category')->Active()
            ->where('featured', 1)
            ->whereNotNull('compare_price')
            ->latest()
            ->first();

        $categories = Category::with('products')->Active()->latest()->limit(6)->get();

        $bestSellers = Product::Active()->where('featured', 1)->latest()->limit(3)->get();

        // سحب أحدث 3 منتجات لعمود (New Arrivals)
        $newArrivals = Product::Active()->latest()->limit(3)->get();
        $latestNews = Post::where('status', 'active')->latest()->limit(3)->get();

        // ترتيب المنتجات حسب الأعلى تقييماً لعمود (Top Rated)
        $topRated = Product::Active()->orderBy('rating', 'desc')->limit(3)->get();
        $brands = Brand::where('status', 'active')->latest()->get();
        return view('front.home', compact(
            'products',
            'sub_banner_products',
            'categories',
            'special_grid_products',
            'banner_product',
            'special_offer_product',
            'bestSellers',
            'newArrivals',
            'topRated',
            'brands',
            'latestNews'

        ));
    }

    public function aboutUs()
    {
        return view('front.aboutUs');
    }
    public function contactUs()
    {
        return view('front.contactUs');
    }
    public function postShow($slug)
    {
        // $post = Post::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $post = Post::with('category', 'admin')->where('slug', $slug)->where('status', 'active')->firstOrFail();

        return view('front.post-details', compact('post'));
    }
}
