<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\CategoryRequest;


use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $request = request();
        // $query = Category::query();

        // if($name= $request->query('name')){
        //     $query->where('name', 'LIKE', "%{$name}%");
        // }
        // if($status= $request->query('status')){
        //     $query->where('status', '=',$status);
        // }

        $categories = Category::with('parent')
        ->withCount('products')->filter($request->query()
        )->orderBy('categories.name')->paginate(7);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents= Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $clean_data=$request->validate(Category::rules(), [
            'required' => 'this field (:attribute) isrequired',
            'name.unique'=> 'this name is already exists!'
        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        $category= Category::create($data);
        return Redirect::route('dashboard.categories.index')->with('success', 'category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category= Category::findOrFail($id);
        } catch(\Exception $e){
            return redirect()->route('dashboard.categories.index')->with('info', 'record not found!');
        }

        // $parents  = Category::where('id', '<>', $id)
        // ->where(function($query) use ($id) {
        //     $query->whereNull('parent_id')
        //           ->orWhere('parent_id', '<>', $id);
        //         })
        // ->get();

        $parents= Category::where('id', '<>', $id)
            ->where(function($query) use ($id){
                $query->whereNull('parent_id')
                ->orWhere('parent_id', '<>', $id);
            })
        ->get();
        return view('dashboard.categories.edit', compact('category', "parents"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category= Category::findOrFail($id);
        $old_image= $category->image;

        $data= $request->except('image');
        $new_image = $this->uploadImage($request);
        if($new_image){
            $data['image']= $new_image;
        }
        $category->update($data);

        if($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $category = Category::findOrFail($id);
        $category->delete();

        // if($category->image){
        //     Storage::disk('public')->delete($category->image);
        // }
        //Category::destroy($id);
        return Redirect::route('dashboard.categories.index')->with('success', 'Category Deleted');
    }

    public function uploadImage(Request $request){
        if(!$request->hasFile('image')){
            return;
        }
            $file= $request->file('image');
            $path= $file->store('uploads', [
                'disk' =>'public'
            ]);
            return $path;
    }

    public function trash(){
        $categories = Category::onlyTrashed()->paginate(5);
        return view('dashboard.categories.trash', compact('categories'));
    } 

    public function restore(Request $request, $id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')->with('succes', 'Category restored');
    }

    public function forceDelete(Request $request, $id){
       
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if($category->image){
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')->with('succes', 'Category deleted forever!');
    }
}
