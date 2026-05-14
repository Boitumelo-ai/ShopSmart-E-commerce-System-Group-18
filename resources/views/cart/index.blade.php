@extends('layouts.app')

@section('content')

<h1>My Cart</h1>

{{-- Show success messages --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Check if cart is empty --}}
@if(empty($cart))
    <div class="alert alert-info">
        Your cart is empty. 
        <a href="/product" class="btn btn-primary"> Continue Shopping</a>
    </div>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through each cart item --}}
            @foreach($cart as $id => $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>R{{ $item['price'] }}</td>

                {{-- Quantity update form --}}
                <td>
                    <form action="/cart/update/{{ $id }}" method="POST">
                        @csrf
                        @method('POST')
                        <input 
                            type="number" 
                            name="quantity" 
                            value="{{ $item['quantity'] }}" 
                            min="1" 
                            class="form-control" 
                            style="width: 80px; display:inline"
                        >
                        <button type="submit" class="btn btn-sm btn-secondary">
                            Update
                        </button>
                    </form>
                </td>

                <td>R{{ $item['price'] * $item['quantity'] }}</td>

                {{-- Remove item form --}}
                <td>
                    <form action="/cart/remove/{{ $id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Cart total and actions --}}
    <div class="card p-3">
        <h4>Total: R{{ $total }}</h4>

        {{-- Clear cart button --}}
        <form action="/cart/clear" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">
                Clear Cart
            </button>
        </form>

        {{-- Checkout button --}}
        <a href="/checkout" class="btn btn-success ms-2">
            Proceed to Checkout
        </a>
    </div>
@endif

@endsection