@extends('layouts.admin')

@section('content')

<h3>Edit Category</h3>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $category->name }}">
    <button type="submit">Update</button>

</form>

@endsection
