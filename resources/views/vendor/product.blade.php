 @extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📦 My Products</h1>
    <a href="/product/create" class="btn btn-primary">
        + Add Product
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($products->isEmpty())
    <div class="alert alert-info">
        You have no products yet.
        <a href="/products/create">Add your first product</a>
    </div>
@else
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card p-3">
                <h5>{{ $product->description }}</h5>
                <p class="text-success fw-bold">R{{ $product->amount }}</p>
                <p>Stock: {{ $product->quantity }}</p>
                <p>Category: {{ $product->category->name ?? 'N/A' }}</p>
                <div class="d-flex gap-2">
                    <a href="/products/{{ $product->id }}"
                       class="btn btn-sm btn-primary">View</a>
                    <form action="/products/{{ $product->id }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
