<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    // Show the checkout form
    public function showCheckoutForm()
    {
        return view('checkout');
    }

    // Handle the order placement
    public function placeOrder(Request $request)
    {
        try {
            // Validate the input
            $validation = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'address' => 'required|string',
                'payment_method' => 'required|string',
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            // Fetch the cart items for the user
            $cartItems = Cart::where('user_id', $request->user_id)->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Cart is empty');
            }

            // Calculate the total price
            $total = $cartItems->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->quantity;
            });

            // Create the order
            $order = Order::create([
                'user_id' => $request->user_id,
                'total' => $total,
                'status' => 'pending',
                'invoice' => time(),
                'address' => $request->address,
                'payment_method' => $request->payment_method,
            ]);

            // Attach products to the order and clear the cart
            foreach ($cartItems as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // Clear the cart
            Cart::where('user_id', $request->user_id)->delete();

            return redirect()->route('checkout.complete')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Show order completion page
    public function orderComplete()
    {
        return view('order-complete');
    }

    // Show user's orders
    public function showUserOrders()
    {
        try {
            // Fetch orders for the authenticated user
            $orders = Order::where('user_id', Auth::id())->with('orderItems.product','user')->get();
            return view('user-orders', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Show details of a specific order
    public function showOrderDetails($id)
    {
        try {
            // Fetch the order and its items
            $order = Order::where('id', $id)->with('orderItems.product')->firstOrFail();
            return view('order-details', compact('order'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Order not found');
        }
    }
}