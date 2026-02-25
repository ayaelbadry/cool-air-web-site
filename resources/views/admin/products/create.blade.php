@extends('layouts.admin')

@section('content')

<h2>Create Product</h2>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label>Name</label>
        <input type="text" name="name">
    </div>

    <div>
        <label>Price</label>
        <input type="text" name="price">
    </div>
    <div>
        <label>inStock</label>
        <input type="text" name="inStock">
    </div>
    <div>
        <label>Description</label>
        <input type="text" name="description">
    </div>
    <div>
        <label>Brand</label>
        <input type="text" name="brand">
    </div>

    <div>
        <label>Category</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Save</button>

</form>

@endsection