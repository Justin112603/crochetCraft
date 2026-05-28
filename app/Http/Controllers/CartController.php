<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /* ── Helper: build cart array from DB (same shape as old session cart) ── */
    private function getCart(): array
    {
        return CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get()
            ->keyBy('product_id')
            ->map(fn($item) => [
                'id'       => $item->product_id,
                'name'     => $item->product->name,
                'price'    => $item->product->price,
                'image'    => $item->product->image,
                'quantity' => $item->quantity,
            ])
            ->toArray();
    }

    public function index()
    {
        $cart = $this->getCart();
        return view('cart', compact('cart'));
    }

    public function add(Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'Product is out of stock.');
        }

        $item = CartItem::firstOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => 0]
        );

        if ($item->quantity >= $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $item->increment('quantity');

        return back()->with('success', 'Product added to cart!');
    }

    public function increase($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $item = CartItem::where('user_id', auth()->id())
                        ->where('product_id', $id)
                        ->first();

        if ($item) {
            if ($item->quantity >= $product->stock) {
                return back()->with('error', 'Not enough stock available.');
            }
            $item->increment('quantity');
        }

        return back();
    }

    public function decrease($id)
    {
        $item = CartItem::where('user_id', auth()->id())
                        ->where('product_id', $id)
                        ->first();

        if ($item) {
            if ($item->quantity > 1) {
                $item->decrement('quantity');
            } else {
                $item->delete(); // remove if quantity hits 0
            }
        }

        return back();
    }

    public function remove($id)
    {
        CartItem::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->delete();

        // also remove from selected
        $selected = session()->get('cart_selected', []);
        $selected = array_values(array_diff($selected, [$id]));
        session()->put('cart_selected', $selected);

        return back()->with('success', 'Item removed from cart.');
    }

    public function selectItems(Request $request)
    {
        $selected = $request->input('selected_items', []);

        if (empty($selected)) {
            return back()->with('error', 'Please select at least one item to checkout.');
        }

        session()->put('cart_selected', $selected);

        return redirect()->route('checkout');
    }
}