<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();

    // CATEGORY FILTER
    if ($request->filled('category') && $request->category !== 'all') {
        $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
    }

    // SEARCH FILTER
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // PRICE FILTER
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // SORT
    match($request->sort) {
        'newest'     => $query->latest(),
        'price_asc'  => $query->orderBy('price', 'asc'),
        'price_desc' => $query->orderBy('price', 'desc'),
        default      => $query->orderBy('is_featured', 'desc')->latest(),
    };

    $products   = $query->paginate(20);
    $categories = \App\Models\Category::all();

    // AJAX — return only the product cards as JSON
    if ($request->ajax()) {
        $html = '';
        foreach ($products as $product) {
            $outOfStock = $product->stock <= 0;
            $imgUrl     = asset('storage/' . $product->image);
            $price      = number_format($product->price, 2);
            $stock      = $product->stock;
            $addUrl     = route('cart.add', $product->id);
            $csrf       = csrf_token();
            $featured   = $product->is_featured
                ? '<span class="absolute top-3 left-3 bg-[#c4693f] text-white text-xs font-medium px-3 py-1 rounded-full shadow">Featured</span>'
                : '';

            $actionBtn = $outOfStock
                ? '<p class="text-xs text-red-500 font-semibold mt-1">Out of Stock</p>
                   <button disabled class="mt-4 w-full bg-gray-300 text-gray-500 py-2.5 rounded-xl text-sm font-medium cursor-not-allowed">Out of Stock</button>'
                : '<p class="text-xs text-[#9d7d6a] mt-1">Stock: ' . $stock . '</p>
                   <form action="' . $addUrl . '" method="POST">
                       <input type="hidden" name="_token" value="' . $csrf . '">
                       <button type="submit" class="mt-4 w-full bg-[#c4693f] hover:bg-[#9e4a28] text-white py-2.5 rounded-xl text-sm font-medium transition">Add to Cart</button>
                   </form>';

            $html .= '
                <div class="product-card bg-white rounded-2xl overflow-hidden border border-[#e8d5bd]">
                    <div class="relative">
                        <img src="' . $imgUrl . '" class="product-img w-full h-52 object-cover" alt="' . e($product->name) . '">
                        ' . $featured . '
                    </div>
                    <div class="p-4">
                        <h5 class="font-medium text-[#2e1a0e] line-clamp-2 h-12">' . e($product->name) . '</h5>
                        <p class="text-[#c4693f] text-xl font-bold price mt-2">₱' . $price . '</p>
                        ' . $actionBtn . '
                    </div>
                </div>';
        }

        return response()->json([
            'html'         => $html,
            'current_page' => $products->currentPage(),
            'last_page'    => $products->lastPage(),
        ]);
    }

    return view('shop', compact('products', 'categories'));
}
}