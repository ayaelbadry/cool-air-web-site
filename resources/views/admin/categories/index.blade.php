@extends('layouts.admin') 

@section('content') 

<h3>All Categories</h3>

<a href="{{ route('categories.create') }}">Add New Category</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>

    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>

    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</td>
        </tr>
        
    @endforeach

</table>

@endsection