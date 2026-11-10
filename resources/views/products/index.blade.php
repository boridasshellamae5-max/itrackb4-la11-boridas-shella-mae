
@extends('layouts.app')

@section('title', 'All Products')

@section('content')

<h2>Product List</h2>


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<hr>

<h5>Filter by Category</h5>

<a href="{{ route('products.index', ['category_id' => 1, 'price' => $price]) }}"
   class="btn btn-primary btn-sm">
    Electronics
</a>

<a href="{{ route('products.index', ['category_id' => 2, 'price' => $price]) }}"
   class="btn btn-primary btn-sm">
    Accessories
</a>

<a href="{{ route('products.index', ['category_id' => 3, 'price' => $price]) }}"
   class="btn btn-primary btn-sm">
    Office Equipment
</a>

<hr>

<h5>Filter by Price</h5>

<a href="{{ route('products.index', ['category_id' => $category, 'price' => 45000]) }}"
   class="btn btn-secondary btn-sm">₱45,000</a>

<a href="{{ route('products.index', ['category_id' => $category, 'price' => 15000]) }}"
   class="btn btn-secondary btn-sm">₱15,000</a>

<a href="{{ route('products.index', ['category_id' => $category, 'price' => 1200]) }}"
   class="btn btn-secondary btn-sm">₱1,200</a>

<a href="{{ route('products.index', ['category_id' => $category, 'price' => 800]) }}"
   class="btn btn-secondary btn-sm">₱800</a>

<a href="{{ route('products.index', ['category_id' => $category, 'price' => 2500]) }}"
   class="btn btn-secondary btn-sm">₱2,500</a>

<a href="{{ route('products.index', ['category_id' => $category, 'price' => 8500]) }}"
   class="btn btn-secondary btn-sm">₱8,500</a>

<hr>

<a href="{{ route('products.index') }}"
   class="btn btn-danger btn-sm">
    Clear All Filters
</a>

<hr>

<p>
    <strong>Category ID:</strong>
    {{ $category !== '' ? $category : 'All' }}
</p>

<p>
    <strong>Price:</strong>
    {{ $price !== '' ? '₱' . number_format($price) : 'All' }}
</p>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($products as $product)

        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>₱{{ number_format($product->price) }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->category->name ?? 'No Category' }}</td>

            <td>
                {{-- VIEW BUTTON --}}
                <a href="{{ route('products.show', $product) }}"
                   class="btn btn-info btn-sm">
                    View
                </a>

                {{-- EDIT BUTTON --}}
                <a href="{{ route('products.edit', $product) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                {{-- DELETE FORM: SS8 --}}
                <form action="{{ route('products.destroy', $product) }}"
                      method="POST"
                      style="display: inline;"
                      onsubmit="return confirm('Delete this record?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                        Delete
                    </button>

                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="6" class="text-center">
                No products found.
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

<hr>

<p>
    <strong>Queries:</strong>
    {{ count(DB::getQueryLog()) }}
</p>

@endsection
