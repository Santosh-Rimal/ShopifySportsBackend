<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; // Assuming you have a Cart model
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Add a product to the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $user_id = $request->user_id;
        $quantity = $request->quantity;

        $cart = Cart::create([
        'user_id' => $user_id,
        'product_id'=>$product->id,
        'quantity'=>$quantity
    ]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('frontend.cart.index', compact('cartItems'));
    }

     public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        if ($cartItem->user_id == auth()->id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}