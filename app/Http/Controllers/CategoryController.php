<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display all categories (Public Page)
     */
   public function index()
{
    $categories = Category::where('is_active', true)
                    ->orderBy('name', 'asc')
                    ->get();

    // Correct view path for admin
    return view('admin.categories', compact('categories'));
}

    /**
     * Display products by category (Shop filtered by category)
     */
    public function show(Category $category)
    {
        $products = $category->products()
                    ->where('is_active', true)
                    ->latest()
                    ->paginate(20);

        return view('shop', compact('category', 'products'));
    }

    // ========================
    // ADMIN METHODS (Below)
    // ========================

    /**
     * Admin: Show all categories (with management)
     */
    public function adminIndex()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories', compact('categories'));
    }

    /**
     * Admin: Show Create Form
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Admin: Store New Category
     */
    
public function store(Request $request)
{
    try {

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon ?: '🧶',
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category added successfully!');

    } catch (QueryException $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Category already exists.');

    }
}

    /**
     * Admin: Show Edit Form
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Admin: Update Category
     */
    public function update(Request $request, Category $category)
{
    try {

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon ?: '🧶',
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category updated successfully!');

    } catch (\Exception $e) {

        return back()
            ->withInput()
            ->with('error', 'Unable to update category.');

    }
}

    /**
     * Admin: Delete Category
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')
                         ->with('success', 'Category deleted successfully!');
    }
}