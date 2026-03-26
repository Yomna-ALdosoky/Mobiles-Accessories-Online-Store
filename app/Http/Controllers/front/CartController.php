<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repository\Cart\CartModelRepository;
use App\Repository\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('front.cart', [
            'cart' => $this->cart,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);
        $product= Product::findOrFail($request->post('product_id'));
        $this->cart->add($product, $request->post('quantity'));

        if($request->expectsJson()){
            return response()->json([
                'message' => 'Item add to cart',
            ], 201);
        }
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);
        $this->cart->update($id, $request->post('quantity'));
         $item = \App\Models\Cart::with('product')->findOrFail($id);

    return response()->json([
        'subtotal' => $item->quantity * $item->product->price,
        'total' => $this->cart->total(),
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
        return [
            'message' => 'Item Delete!',
        ];
    }
}
