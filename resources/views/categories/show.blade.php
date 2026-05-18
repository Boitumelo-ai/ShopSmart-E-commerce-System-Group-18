@extends('layouts.app')

@section('content')

<h1>📂 {{ $category->name }}</h1>

@if($category->products->isEmpty())
    <div class="alert alert-info">
        No products in this category yet.
    </div>
@else
    <div class="row">
        @foreach($category->products as $product)
        <div class="col-md-4">
            <div class="card p-3">
                <h5>{{ $product->description }}</h5>
                <p class="text-success fw-bold">R{{ $product->amount }}</p>
                <p>Stock: {{ $product->quantity }}</p>
                <p>Sold by: {{ $product->user->first_name ?? 'Unknown' }}</p>
                <div class="d-flex gap-2">
                    <a href="/products/{{ $product->id }}"
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                    @auth
                    <form action="/cart/add/{{ $product->id }}"
                          method="POST">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm btn-success">
                            🛒 Add to Cart
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

<a href="/categories" class="btn btn-secondary mt-3">
    ← Back to Categories
</a>

@endsection 
