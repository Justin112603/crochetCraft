<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    

    public function gcashPage()
    {
        return view('gcash');
    }

    public function index()
{
    $selected = session('cart_selected', []);

    $cartItems = CartItem::with('product')
        ->where('user_id', auth()->id())
        ->whereIn('product_id', $selected)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')
            ->with('error', 'Please select at least one item to checkout.');
    }

    $selectedItems = $cartItems->map(fn($item) => [
        'id'       => $item->product_id,
        'name'     => $item->product->name,
        'price'    => $item->product->price,
        'image'    => $item->product->image,
        'quantity' => $item->quantity,
    ])->toArray();

    $subtotal = collect($selectedItems)->sum(fn($i) => $i['price'] * $i['quantity']);
    $total    = $subtotal + 50;

    return view('checkout', compact('selectedItems', 'subtotal', 'total'));
}

public function store(Request $request)
{
    $selected = session('cart_selected', []);

    $cartItems = CartItem::with('product')
        ->where('user_id', auth()->id())
        ->whereIn('product_id', $selected)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')
            ->with('error', 'Please select at least one item to checkout.');
    }

    $subtotal = 0;

    // 1. VALIDATE STOCK
    foreach ($cartItems as $item) {
        if (!$item->product) {
            return back()->with('error', 'Product not found.');
        }
        if ($item->product->stock < $item->quantity) {
            return back()->with('error', $item->product->name . ' does not have enough stock.');
        }
        $subtotal += $item->product->price * $item->quantity;
    }

    // 2. CALCULATE
    $commission    = $subtotal * 0.10;
    $total         = $subtotal + 50;
    $paymentMethod = $request->input('payment_method', 'cod');
    $firstItem     = $cartItems->first();

    // 3. CREATE ORDER
    Order::create([
        'user_id'        => auth()->id(),
        'subtotal'       => $subtotal,
        'commission'     => $commission,
        'total'          => $total,
        'payment_method' => $paymentMethod,
        'status'         => 'pending',
        'image'          => $firstItem->product->image,
    ]);

    // 4. DECREMENT STOCK
    foreach ($cartItems as $item) {
        $item->product->decrement('stock', $item->quantity);
    }

    // 5. DELETE only selected items from DB — unselected ones STAY
    CartItem::where('user_id', auth()->id())
            ->whereIn('product_id', $selected)
            ->delete();

    session()->forget('cart_selected');

    return redirect()->route('shop')->with('success', 'Order placed successfully!');
}
}