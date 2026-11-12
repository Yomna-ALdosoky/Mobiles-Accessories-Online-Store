<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    

    public function allNews(Request $request)
    {
        $blogs = Blog::with(['category', 'user'])
            ->where('is_published', true)
            ->search($request->search)
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $data = array_merge([
            'blogs' => $blogs
        ], $this->getSidebarData());
        // return view('front.blog', 'data');
        return view('front.blog', $data);
    }

    public function show($slug)
    {
        $blog = Blog::with(['user', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $data = array_merge([
            'blog' => $blog
        ], $this->getSidebarData());

        return view('front.blog-details', $data);
    }

    private function getSidebarData(): array
    {
        $featuredblogs = Blog::featured()->latest()->take(4)->get();
        if ($featuredblogs->isEmpty()) {
            $featuredblogs = Blog::where('is_published', true)->latest()->take(3)->get();
        }

        $categories = Category::withCount(['blogs' => function ($q) {
            $q->where('is_published', true);
        }])->having('blogs_count', '>', 0)->get();

        return compact('featuredblogs', 'categories');
    }
}
