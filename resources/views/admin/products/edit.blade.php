@extends('layouts.admin')

@section('content')

<h2>Edit Product</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ $product->name }}">
    </div>

    <div>
        <label>Price</label>
        <input type="text" name="price" value="{{ $product->price }}">
    </div>
      <div>
        <label>inStock</label>
        <input type="text" name="inStock" value="{{ $product->inStock }}">
    </div>
      <div>
        <label>Description</label>
        <input type="text" name="description" value="{{ $product->description }}">
    </div>
      <div>
        <label>Brand</label>
        <input type="text" name="brand" value="{{ $product->brand }}">
    </div>

    <div>
        <label>Category</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Update</button>

</form>

@endsection