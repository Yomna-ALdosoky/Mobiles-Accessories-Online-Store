<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $slug)
    {
        $category   = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::where('status', 'active')->withCount('products')->get();
        $brands     = Brand::where('status', 'active')->withCount('products')->get();

        $products = $category->products()
            ->when($request->search, fn($q, $v) => $q->where('name', 'LIKE', "%{$v}%"))
            ->when($request->brand_id, fn($q, $v) => $q->where('brand_id', $v))
            ->when($request->sort, function ($q, $value) {
                match ($value) {
                    'price_asc'  => $q->orderBy('price', 'asc'),
                    'price_desc' => $q->orderBy('price', 'desc'),
                    'name_asc'   => $q->orderBy('name', 'asc'),
                    default      => $q->latest(),
                };
            }, fn($q) => $q->latest())
            ->paginate(9);

        $products = $category->products()->paginate(9);

        return view('front.categories.show', compact('category', 'categories', 'products', 'brands'));
    }
}
