<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // USER ORDERS
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // STORE ORDER
    public function store(Request $request)
{
    $cart = session()->get('cart', []);

    if (count($cart) == 0) {

        return back()->with(
            'error',
            'Your cart is empty.'
        );
    }

    $subtotal = 0;

    foreach ($cart as $item) {

        $product = \App\Models\Product::find($item['id']);

        // CHECK PRODUCT EXISTS
        if (!$product) {

            return back()->with(
                'error',
                'Product not found.'
            );
        }

        // CHECK STOCK
        if ($product->stock < $item['quantity']) {

            return back()->with(
                'error',
                $product->name . ' does not have enough stock.'
            );
        }

        // DECREASE STOCK
        $product->decrement(
            'stock',
            $item['quantity']
        );

        // COMPUTE SUBTOTAL
        $subtotal +=
            $item['price'] * $item['quantity'];
    }

    // 10% COMMISSION
    $commission = $subtotal * 0.10;

    $total = $subtotal;

    foreach ($cart as $item) {

    Order::create([

        'user_id'        => auth()->id(),

        'subtotal'       => $item['price'] * $item['quantity'],

        'total'          => $item['price'] * $item['quantity'],

        'payment_method' => $request->payment_method,

        'status'         => 'pending',

        'image'          => $item['image'],
    ]);
}

    // CLEAR CART
    session()->forget('cart');

    return redirect()
        ->route('shop')
        ->with(
            'success',
            'Order placed successfully!'
        );
}
public function show(Order $order)
{
    // SECURITY
    if ($order->user_id != auth()->id()) {
        abort(403);
    }

    return view('orders.show', compact('order'));
}
public function cancel(Order $order)
{
    if (strtolower($order->status) !== 'pending') {

        return back()->with('error', 'Only pending orders can be cancelled.');
    }

    $order->update([
        'status' => 'cancelled'
    ]);

    return back()->with('success', 'Order cancelled successfully.');
}
}