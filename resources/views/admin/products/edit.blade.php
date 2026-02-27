@extends('layouts.admin')

@section('content')

<h2>Edit Product</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ $product->name }}" readonly>
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
        <input type="text" name="description" value="{{ $product->description }}"readonly>
    </div>
      <div>
        <label>Brand</label>
        <input type="text" name="brand" value="{{ $product->brand }}" readonly>
    </div>
 

    <div>
        <label>Category</label>
        <input type="text" value="{{ $product->category->name }}" readonly>
    </div>

    @if($product->type == 'ac')

<div>
<label>Horsepower</label>
<input type="text" value="{{ $product->ac->horsepower }}" readonly>
</div>

<div>
<label>Energy Rating</label>
<input type="text" value="{{ $product->ac->energy_rating }}" readonly>
</div>

@endif


@if($product->type == 'water_filter')

<div>
<label>Number of Stages</label>
<input type="text" value="{{ $product->waterFilter->number_of_stages }}" readonly>
</div>

@endif

    <button type="submit">Update</button>

</form>

@endsection