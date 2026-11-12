<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()->withCount('products')->get();
        $brands     = Brand::where('status', 'active')->withCount('products')->get();

        $products = Product::active()
            ->when($request->search, fn($q, $v) => $q->where('name', 'LIKE', "%{$v}%"))
            ->when($request->category_id, fn($q, $v) => $q->where('category_id', $v))
            ->when($request->brand_id, fn($q, $v) => $q->where('brand_id', $v))
            ->when($request->sort, function ($q, $value) {
                match ($value) {
                    'price_asc'  => $q->orderBy('price', 'asc'),
                    'price_desc' => $q->orderBy('price', 'desc'),
                    'name_asc'   => $q->orderBy('name', 'asc'),
                    default      => $q->latest(),
                };
            }, fn($q) => $q->latest())
            ->latest()
            ->paginate(9);

        return view('front.products.index', compact('categories', 'brands', 'products'));
    }
}
