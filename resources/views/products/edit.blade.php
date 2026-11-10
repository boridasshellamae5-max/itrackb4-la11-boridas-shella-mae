@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

    <h2>Edit Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}"
                required>
        </div>

        <div class="mb-3">
            <label>Category</label>

            <select name="category_id" class="form-control" required>
                <option value="" disabled></option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Available</label>

            <select name="available" class="form-control" required>
                <option value="1" @selected(old('available', $product->available) == '1')>
                    Yes
                </option>

                <option value="0" @selected(old('available', $product->available) == '0')>
                    No
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>

            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Product
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection