<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $products= Product::with('category')->whereHas('category')->Active()
        ->latest()
        ->limit(8)->get();
        $categories= Category::with('products')->Active()->latest()->limit(6)->get();
        return view('front.home', compact('products', 'categories'));
    }
}
