<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        $categories = Category::where('is_active', true)->get();

        return view('admin.product', compact('products', 'categories'));
    }


public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image',
    ]);

    try {

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                                 ->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Product added successfully!');

    } catch (QueryException $e) {

        return back()
            ->withInput()
            ->with('error', 'Product is already in the shop.');

    }
}
public function update(Request $request, Product $product)
{
    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
    ]);

    return back()->with('success', 'Product Updated Succesfully!');
}

public function destroy(Product $product)
{
    $product->delete();

    return back()->with('success', 'Product Deleted!');
}
}