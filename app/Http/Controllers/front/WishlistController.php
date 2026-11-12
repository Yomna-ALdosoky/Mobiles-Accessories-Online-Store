<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('front.wishlist', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }

    public function destroy($id)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}
