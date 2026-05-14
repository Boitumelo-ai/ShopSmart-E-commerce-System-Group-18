@extends('layouts.app')

@section('content')

<h1 class="mb-4">Products</h1>

<div class="row">

@foreach($product as $product)

<div class="col-md-4">

    <div class="card p-3">

        <h4>
            {{ $product->description }}
        </h4>

        <h5 class="text-primary">
            R{{ $product->amount }}
        </h5>

        <p>
            Quantity:
            {{ $product->quantity }}
        </p>

        <p>
            Vendor:
            {{ $product->user->name ?? 'Unknown' }}
        </p>

        <a href="/product/{{ $product->id }}"
           class="btn btn-primary">
            View Product
        </a>

    </div>

</div>

@endforeach

</div>

@endsection

@foreach($product as $product)
<div class="col-md-4">
    <div class="card p-3 mb-3">
        <h5>{{ $product->description }}</h5>
        <p class="text-success fw-bold">R{{ $product->amount }}</p>
        <p>Stock: {{ $product->quantity }}</p>
        <p>Sold by: {{ $product->user->first_name ?? 'Unknown' }}</p>

        {{-- Add to Cart button --}}
        <form action="/cart/add/{{ $product->id }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">
                🛒 Add to Cart
            </button>
        </form>
    </div>
</div>
@endforeach