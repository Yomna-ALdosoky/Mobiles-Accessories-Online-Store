<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AuthorizesRequests;

    public function index(Request $request)
    {
        $products = Product::with(['category', 'store'])->filter($request->query())->whereHas('category')->whereHas('store')->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        $tags='';
        return view('dashboard.products.create', compact('product', 'tags', 'categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|',
            'category_id' => 'required|exists:categories,id',
            'store_id'    => ' required|exists:stores,id',
            'price'       =>'required|numeric|min:0',
            'image'       => 'required|image|max:2048',
            'status'      => 'nullable|in:active,draft,archvied',
        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name')),
            'store_id' => Auth::user()->store_id,
        ]);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $tags= implode(',', $product->tags()->pluck('name')->toArray());
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        // dd($tags);
        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update( $request->except('tags') );

        $tags = json_decode($request->post('tags') );
        $tag_ids= [];

        $saved_tags= Tag::all();
        foreach($tags as $item){
            $slug= Str::slug($item->value);
            $tag= $saved_tags->where('slug', $slug)->first();
            if(!$tag){
                $tag= Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        return redirect()->route('dashboard.products.index')->with('success', 'Product update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function trash(){
        // $products = Product::onlyTrashed()->paginate(7);
        // return view('dashboard.products.trash', compact('products'));
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }
        return $request->file('image')->store('products', 'public');
    }

}
