@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Vendor Dashboard</h1>
        <a href="{{ route('product.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-primary">{{ $product->count() }}</h3>
                <p class="mb-0">My Products</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-success">{{ $orders->count() }}</h3>
                <p class="mb-0">Total Orders</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-warning">{{ $pendingPayments ?? 0 }}</h3>
                <p class="mb-0">Pending Payments</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-info">R{{ number_format($totalSales ?? 0, 2) }}</h3>
                <p class="mb-0">Total Sales</p>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Recent Orders</h5>
        </div>
        <div class="card-body">
            @if($orders->isEmpty())
                <p class="text-muted">No orders yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #2c3e50; color: white;">
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->first_name ?? 'N/A' }} {{ $order->user->last_name ?? '' }}</td>
                                {{-- Phone number is stored in payment table as cod_phone --}}
                                <td>{{ $order->user->phone_number ?? 'N/A' }}</td>
                                {{-- Address from the order's address relationship --}}
                                <td>{{ $order->address->residence ?? 'No address provided' }}</td>
                                <td>
                                    @php
                                        $vendorItems = $order->order_item->filter(function($item) use ($product) {
                                            return $product->contains('id', $item->product_id);
                                        });
                                        $totalItems = $vendorItems->sum('quantity');
                                    @endphp
                                    {{ $totalItems }} items
                                 </td>
                                <td>R{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if($order->payment)
                                        <span class="badge bg-{{ $order->payment->status === 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->payment->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">No payment</span>
                                    @endif
                                  </td>
                                <td>
                                    <form action="{{ route('vendor.order.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm mb-2">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary w-100">Update Status</button>
                                    </form>
                                  </td>
                                <td>
                                    @if($order->payment && $order->payment->status == 'pending')
                                        <form action="{{ route('vendor.order.confirmPayment', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success w-100">Confirm Payment</button>
                                        </form>
                                    @endif
                                  </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- My Products --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">My Products</h5>
        </div>
        <div class="card-body">
            @if($product->isEmpty())
                <p class="text-muted">You haven't added any products yet.</p>
                <a href="{{ route('product.create') }}" class="btn btn-primary">Add Your First Product</a>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #2c3e50; color: white;">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td>R{{ number_format($item->amount, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                                    </form>
                                  </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Vendor Dashboard</h1>
        <a href="{{ route('product.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-primary">{{ $product->count() }}</h3>
                <p class="mb-0">My Products</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-success">{{ $orders->count() }}</h3>
                <p class="mb-0">Total Orders</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-warning">{{ $pendingPayments ?? 0 }}</h3>
                <p class="mb-0">Pending Payments</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h3 class="text-info">R{{ number_format($totalSales ?? 0, 2) }}</h3>
                <p class="mb-0">Total Sales</p>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Recent Orders</h5>
        </div>
        <div class="card-body">
            @if($orders->isEmpty())
                <p class="text-muted">No orders yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #2c3e50; color: white;">
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->first_name ?? 'N/A' }} {{ $order->user->last_name ?? '' }}</td>
                                {{-- Phone number is stored in payment table as cod_phone --}}
                                <td>{{ $order->payment->cod_phone ?? 'N/A' }}</td>
                                {{-- Address from the order's address relationship --}}
                                <td>{{ $order->address->residence ?? 'No address provided' }}</td>
                                <td>
                                    @php
                                        $vendorItems = $order->order_item->filter(function($item) use ($product) {
                                            return $product->contains('id', $item->product_id);
                                        });
                                        $totalItems = $vendorItems->sum('quantity');
                                    @endphp
                                    {{ $totalItems }} items
                                 </td>
                                <td>R{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if($order->payment)
                                        <span class="badge bg-{{ $order->payment->status === 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->payment->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">No payment</span>
                                    @endif
                                  </td>
                                <td>
                                    <form action="{{ route('vendor.order.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm mb-2">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary w-100">Update Status</button>
                                    </form>
                                  </td>
                                <td>
                                    @if($order->payment && $order->payment->status == 'pending')
                                        <form action="{{ route('vendor.order.confirmPayment', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success w-100">Confirm Payment</button>
                                        </form>
                                    @endif
                                  </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- My Products --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">My Products</h5>
        </div>
        <div class="card-body">
            @if($product->isEmpty())
                <p class="text-muted">You haven't added any products yet.</p>
                <a href="{{ route('product.create') }}" class="btn btn-primary">Add Your First Product</a>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #2c3e50; color: white;">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td>R{{ number_format($item->amount, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                                    </form>
                                  </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection