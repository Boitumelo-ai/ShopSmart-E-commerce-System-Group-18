@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Checkout</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('payment.cod.process') }}" method="POST">
        @csrf

        <div class="card p-4 mb-4">
            <h5>Delivery Address</h5>

            <div class="mb-3">
                <label class="form-label">Enter your address</label>
                <input type="text" name="delivery_address" class="form-control" 
                       placeholder="e.g. 123 Main Street, Johannesburg" required>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <h5>Order Summary</h5>
            @php
                $cart_item = session()->get('cart', []);
                $total = 0;
                foreach ($cart_item as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
            @endphp
            @foreach($cart_item as $id => $item)
                <p>{{ $item['name'] }} x{{ $item['quantity'] }} = R{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
            @endforeach
            <h5>Total: R{{ number_format($total, 2) }}</h5>
        </div>

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection