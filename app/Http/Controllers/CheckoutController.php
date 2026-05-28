<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CheckoutController extends Controller
{
    

    public function gcashPage()
    {
        return view('gcash');
    }

    public function index()
{
    $cart     = session('cart', []);
    $selected = session('cart_selected', []);

    // Only keep selected items
    $selectedItems = array_filter(
        $cart,
        fn($item, $id) => in_array((string) $id, array_map('strval', $selected)),
        ARRAY_FILTER_USE_BOTH
    );

    if (empty($selectedItems)) {
        return redirect()->route('cart.index')
            ->with('error', 'Please select at least one item to checkout.');
    }

    $subtotal = collect($selectedItems)->sum(fn($item) => $item['price'] * $item['quantity']);
    $total    = $subtotal + 50;

    return view('checkout', compact('selectedItems', 'subtotal', 'total'));
}

public function store(Request $request)
{
    $cart     = session('cart', []);
    $selected = session('cart_selected', []);

    // Only process selected items
    $selectedItems = array_filter(
        $cart,
        fn($item, $id) => in_array((string) $id, array_map('strval', $selected)),
        ARRAY_FILTER_USE_BOTH
    );

    if (empty($selectedItems)) {
        return redirect()->route('cart.index')
            ->with('error', 'Please select at least one item to checkout.');
    }

    $subtotal = 0;

    // 1. VALIDATE STOCK
    foreach ($selectedItems as $item) {
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
    $firstItem     = array_values($selectedItems)[0];

    // 3. CREATE ORDER
    Order::create([
        'user_id'        => auth()->id(),
        'subtotal'       => $subtotal,
        'commission'     => $commission,
        'total'          => $total,
        'payment_method' => $paymentMethod,
        'status'         => 'pending',
        'image'          => $firstItem['image'],
    ]);

    // 4. DECREMENT STOCK for selected items only
    foreach ($selectedItems as $item) {
        $product = Product::find($item['id']);
        $product->decrement('stock', $item['quantity']);
    }

    // 5. REMOVE only selected items from cart, keep the rest
    foreach ($selected as $id) {
        unset($cart[$id]);
    }

    session()->put('cart', $cart);
    session()->forget('cart_selected');

    return redirect()->route('shop')->with('success', 'Order placed successfully!');
}
}