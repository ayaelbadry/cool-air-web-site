<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\WaterFilter;
use App\Models\Ac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
   public function index()
{
    $products = Product::with('category')->get();
    return View('admin.products.index', compact('products'));
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
        'inStock' => 'required|integer',
        'brand'=> 'required|string',
        'category_id' => 'required|exists:categories,id',
        'type'=>'required|in:ac,water_filter',

        'horsepower' => 'required_if:type,ac',
        'energy_rating' => 'required_if:type,ac',

        'number_of_stages' => 'required_if:type,water_filter'
    ]);

   DB::transaction(function () use ($request) {

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'description' => $request->description,
            'inStock' => $request->inStock,
            'category_id' => $request->category_id,
            'type' => $request->type,
        ]);

        if ($request->type == 'ac') {

    if (!$request->horsepower || !$request->energy_rating) {
        return back()->withErrors('AC fields required');
    }

    Ac::create([
        'product_id' => $product->id,
        'horsepower' => $request->horsepower,
        'energy_rating' => $request->energy_rating,
    ]);
}

if ($request->type == 'water_filter') {

    if (!$request->number_of_stages) {
        return back()->withErrors('Water filter stages required');
    }

    WaterFilter::create([
        'product_id' => $product->id,
        'number_of_stages' => $request->number_of_stages,
    ]);
}
});

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
        'type'=>'required'

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
