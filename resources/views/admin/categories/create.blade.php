@extends('layouts.admin')

@section('content')

<h3>Add Category</h3>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Category Name">
    <button type="submit">Save</button>

</form>

@endsection
