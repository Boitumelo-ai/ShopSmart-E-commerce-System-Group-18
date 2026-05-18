 @extends('layouts.app')

@section('content')

{{-- Welcome banner --}}
<div class="p-4 mb-4 rounded text-white"
     style="background-color: #2c3e50;">
    <h2>👋 Welcome, {{ auth()->user()->first_name }}!</h2>
    <p class="mb-0">Here is your student dashboard</p>
</div>

{{-- Stats --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center p-3">
            <h3 class="text-primary">{{ $orders->count() }}</h3>
            <p class="mb-0">Total Orders</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <h3 class="text-success">
                {{ $orders->where('status', 'delivered')->count() }}
            </h3>
            <p class="mb-0">Delivered</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <h3 class="text-warning">
                {{ $orders->where('status', 'pending')->count() }}
            </h3>
            <p class="mb-0">Pending</p>
        </div>
    </div>
</div>

{{-- Recent Orders --}}
<div class="card p-3 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📦 Recent Orders</h4>
        <a href="/orders" class="btn btn-sm btn-primary">
            View All
        </a>
    </div>
    @if($orders->isEmpty())
        <div class="alert alert-info">
            No orders yet.
            <a href="/product">Start Shopping</a>
        </div>
    @else
        <table class="table table-bordered">
            <thead style="background-color: #2c3e50; color: white;">
                <tr>
                    <th>Order #</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders->take(5) as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>R{{ $order->total_amount }}</td>
                    <td>
                        @if($order->status === 'delivered')
                            <span class="badge bg-success">Delivered</span>
                        @elseif($order->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-secondary">
                                {{ $order->status }}
                            </span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="/orders/{{ $order->id }}"
                           class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- Featured Products --}}
<div class="card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>🛍️ Featured Products</h4>
        <a href="/product" class="btn btn-sm btn-primary">
            View All
        </a>
    </div>
    <div class="row">
        @foreach($product as $product)
        <div class="col-md-3">
            <div class="card p-3">
                <h6>{{ $product->description }}</h6>
                <p class="text-success fw-bold">R{{ $product->amount }}</p>
                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="btn btn-sm btn-primary w-100">
                        🛒 Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
