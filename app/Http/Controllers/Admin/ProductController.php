<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index()
{
    $products = Product::with('category')->get();
    return view('admin.products.index', compact('products'));
}
public function create()
{
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    Product::create($request->all());

    return redirect()->route('products.index')
        ->with('success', 'Product created successfully');
}
public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.products.edit', compact('product','categories'));
}
public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'inStock' => 'required|integer',
        'description' => 'required|string',
        'brand'=> 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    $product->update($request->all());

    return redirect()->route('products.index')
        ->with('success', 'Product updated successfully');
}
public function destroy(Product $product)
{
    $product->delete();

    return redirect()->route('products.index')
        ->with('success', 'Product deleted successfully');
}
}
