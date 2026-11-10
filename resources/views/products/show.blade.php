
@extends('layouts.app')

@section('title', 'Product Details')

@section('content')

<h2>Product Details</h2>

<hr>

<table class="table table-bordered">

    <tr>
        <th>ID</th>
        <td>{{ $product->id }}</td>
    </tr>

    <tr>
        <th>Name</th>
        <td>{{ $product->name }}</td>
    </tr>

    <tr>
        <th>Price</th>
        <td>₱{{ number_format($product->price, 2) }}</td>
    </tr>

    <tr>
        <th>Quantity</th>
        <td>{{ $product->quantity }}</td>
    </tr>

    <tr>
        <th>Category</th>
        <td>{{ $product->category->name ?? 'No Category' }}</td>
    </tr>

    <tr>
        <th>Available</th>
        <td>{{ $product->available ? 'Yes' : 'No' }}</td>
    </tr>

    <tr>
        <th>Description</th>
        <td>{{ $product->description ?? 'No Description' }}</td>
    </tr>

</table>

<a href="{{ route('products.index') }}"
   class="btn btn-secondary">
    Back to Products
</a>

<a href="{{ route('products.edit', $product) }}"
   class="btn btn-warning">
    Edit Product
</a>

@endsection
