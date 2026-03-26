<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug){
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        $products = $category->products()->paginate(9);

        return view('front.categories.show', compact('category', 'products'));
    }
}
