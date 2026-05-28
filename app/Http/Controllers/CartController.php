<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if ($product->stock <= 0) {
            return back()->with('error', 'Product is out of stock.');
        }

        if (isset($cart[$product->id])) {
            if ($cart[$product->id]['quantity'] >= $product->stock) {
                return back()->with('error', 'Not enough stock available.');
            }
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        return view('cart');
    }

    public function increase($id)
    {
        $cart    = session()->get('cart', []);
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                return back()->with('error', 'Not enough stock available.');
            }
            $cart[$id]['quantity']++;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        // ALSO REMOVE FROM SELECTED IF REMOVED FROM CART
        $selected = session()->get('cart_selected', []);
        $selected = array_values(array_diff($selected, [$id]));
        session()->put('cart_selected', $selected);

        session()->put('cart', $cart);

        return back()->with('success', 'Item removed from cart.');
    }

    /* ── NEW: save selected item IDs to session ── */
    public function selectItems(Request $request)
    {
        $selected = $request->input('selected_items', []);

        session()->put('cart_selected', $selected);

        return back();
    }
}