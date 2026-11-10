<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // DISPLAY ALL PRODUCTS
    public function index(Request $request)
    {
        $category = $request->query('category_id', '');
        $price = $request->query('price', '');

        DB::flushQueryLog();
        DB::enableQueryLog();

        $query = Product::with('category');

        if ($category !== '') {
            $query->where('category_id', $category);
        }

        if ($price !== '') {
            $query->where('price', '<=', $price);
        }

        $products = $query->get();

        return view('products.index', compact(
            'products',
            'category',
            'price'
        ));
    }

    // SHOW SINGLE PRODUCT
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // SAVE NEW PRODUCT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'available' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    // SHOW EDIT FORM
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    // UPDATE PRODUCT
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'available' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // DELETE PRODUCT
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
