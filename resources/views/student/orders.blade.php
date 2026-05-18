 @extends('layouts.app')

@section('content')

<h1>📦 My Orders</h1>

@if($orders->isEmpty())
    <div class="alert alert-info">
        No orders yet. <a href="/products">Start Shopping</a>
    </div>
@else
    @foreach($orders as $order)
    <div class="card p-3 mb-3">
        <div class="d-flex justify-content-between">
            <h5>Order #{{ $order->id }}</h5>
            @if($order->status === 'delivered')
                <span class="badge bg-success">Delivered</span>
            @elseif($order->status === 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
            @else
                <span class="badge bg-secondary">{{ $order->status }}</span>
            @endif
        </div>
        <p><strong>Total:</strong> R{{ $order->total_amount }}</p>
        <p><strong>Address:</strong>
            {{ $order->address->residence ?? 'N/A' }}
        </p>
        <p><strong>Items:</strong>
            {{ $order->orderItems->count() }} product(s)
        </p>
        <a href="/orders/{{ $order->id }}"
           class="btn btn-sm btn-primary">
            View Details
        </a>
    </div>
    @endforeach
@endif

@endsection
