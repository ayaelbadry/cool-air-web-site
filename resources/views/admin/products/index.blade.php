@extends('layouts.admin')
@section('content')

<h2>All Products</h2>

<a href="{{ route('products.create') }}">Add New Product</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>inStock</th>
            <th>Description</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->inStock }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->brand }}</td>
            <td>{{ $product->category->name ?? 'No Category' }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection