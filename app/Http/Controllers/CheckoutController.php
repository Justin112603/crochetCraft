<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function gcashPage()
    {
        return view('gcash');
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        // 1. VALIDATE STOCK FIRST
        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if (!$product) {
                return back()->with('error', 'Product not found.');
            }

            if ($product->stock < $item['quantity']) {
                return back()->with('error', $product->name . ' does not have enough stock.');
            }

            $subtotal += $item['price'] * $item['quantity'];
        }

        // 2. CALCULATE
        $commission    = $subtotal * 0.10;
        $shipping      = 50;
        $total         = $subtotal + $shipping;
        $paymentMethod = $request->input('payment_method', 'cod');

        // 3. GRAB FIRST ITEM IMAGE for the order record
        $firstItem = array_values($cart)[0];

        // 4. CREATE ONE ORDER
        Order::create([
            'user_id'        => auth()->id(),
            'subtotal'       => $subtotal,
            'commission'     => $commission,
            'total'          => $total,
            'payment_method' => $paymentMethod,
            'status'         => 'pending',
            'image'          => $firstItem['image'],
        ]);

        // 5. DECREMENT STOCK
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $product->decrement('stock', $item['quantity']);
        }

        // 6. CLEAR CART
        session()->forget('cart');

        return redirect()->route('shop')->with('success', 'Order placed successfully!');
    }
}