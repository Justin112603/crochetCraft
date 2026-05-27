<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function add(Product $product)
{
    $cart = session()->get('cart', []);

    // CHECK STOCK
    if ($product->stock <= 0) {

        return back()->with(
            'error',
            'Product is out of stock.'
        );
    }

    if(isset($cart[$product->id])) {

        // PREVENT EXCEEDING STOCK
        if ($cart[$product->id]['quantity'] >= $product->stock) {

            return back()->with(
                'error',
                'Not enough stock available.'
            );
        }

        $cart[$product->id]['quantity']++;

    } else {

        $cart[$product->id] = [

            'id' => $product->id, // IMPORTANT

            'name' => $product->name,

            'price' => $product->price,

            'image' => $product->image,

            'quantity' => 1
        ];
    }

    session()->put('cart', $cart);

    return back()->with(
        'success',
        'Product added to cart!'
    );
}
    public function index()
{
    return view('cart');
}

public function increase($id)
{
    $cart = session()->get('cart', []);

    $product = Product::find($id);

    if (!$product) {

        return back()->with(
            'error',
            'Product not found.'
        );
    }

    if (isset($cart[$id])) {

        // PREVENT EXCEEDING STOCK
        if (
            $cart[$id]['quantity']
            >= $product->stock
        ) {

            return back()->with(
                'error',
                'Not enough stock available.'
            );
        }

        $cart[$id]['quantity']++;
    }

    session()->put('cart', $cart);

    return back();
}

public function decrease($id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {

        if($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }

    }

    session()->put('cart', $cart);

    return back();
}

public function remove($id)
{
    $cart = session()->get('cart', []);

    unset($cart[$id]);

    session()->put('cart', $cart);

    return back()->with('success', 'Item removed from cart.');
}
}