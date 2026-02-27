@extends('layouts.admin')

@section('content')

<h3>Add Category</h3>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

   <input type="text" name="name" placeholder="Category Name">

<select name="type">
<option value="">Select type</option>
<option value="ac">AC</option>
<option value="water_filter">Water Filter</option>
</select>
    <button type="submit">Save</button>

</form>

@endsection
