@extends('layouts.app')

@section('content')

<h1>🧾 Customer Orders</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->isEmpty())
    <div class="alert alert-info">No orders for your products yet.</div>
@else
    @foreach($orders as $order)
    <div class="card p-4 mb-3">
        <div class="row">

            {{-- Order Info --}}
            <div class="col-md-4">
                <h5>Order #{{ $order->id }}</h5>
                <p><strong>Customer:</strong>
                    {{ $order->user->first_name ?? 'Unknown' }}
                    {{ $order->user->last_name ?? '' }}
                </p>
                <p><strong>Total:</strong> R{{ $order->total_amount }}</p>
                <p><strong>Date:</strong> {{ $order->created_at }}</p>
                <p><strong>Address:</strong>
                    {{ $order->address->residence ?? 'N/A' }}
                </p>
            </div>

            {{-- Items --}}
            <div class="col-md-4">
                <h6>Items:</h6>
                @foreach($order->order_item as $item)
                    <p class="mb-1">
                        • {{ $item->product->description ?? 'Unknown' }}
                        x{{ $item->quantity }}
                        = R{{ $item->quantity * $item->amount }}
                    </p>
                @endforeach
            </div>

            {{-- Payment & Status --}}
            <div class="col-md-4">
                <h6>Payment Status:</h6>

                {{-- Payment method badge --}}
                @if($order->payment)
                    <p>
                        <span class="badge bg-info">
                            {{ strtoupper($order->payment->method) }}
                        </span>
                        @if($order->payment->status === 'completed')
                            <span class="badge bg-success">Paid ✅</span>
                        @else
                            <span class="badge bg-warning text-dark">
                                Awaiting Payment
                            </span>
                        @endif
                    </p>
                @endif

                {{-- Order status --}}
                <p>
                    <strong>Order Status:</strong>
                    @if($order->status === 'delivered')
                        <span class="badge bg-success">Delivered</span>
                    @elseif($order->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($order->status === 'pending_payment')
                        <span class="badge bg-info">Pending Payment</span>
                    @else
                        <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </p>

                {{-- Confirm COD Payment button --}}
                @if($order->payment &&
                    $order->payment->method === 'cod' &&
                    $order->payment->status !== 'completed')
                    <form action="{{ route('vendor.order.confirmPayment', $order->id) }}"
                          method="POST" class="mb-2">
                        @csrf
                        <button type="submit"
                                class="btn btn-success btn-sm w-100"
                                onclick="return confirm('Confirm cash payment received?')">
                            ✅ Confirm Cash Received
                        </button>
                    </form>
                @endif

                {{-- Update order status dropdown --}}
                <form action="{{ route('vendor.order.updateStatus', $order->id) }}"
                      method="POST">
                    @csrf
                    <select name="status" class="form-control form-control-sm mb-2">
                        <option value="pending"
                            {{ $order->status === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="processing"
                            {{ $order->status === 'processing' ? 'selected' : '' }}>
                            Processing
                        </option>
                        <option value="delivered"
                            {{ $order->status === 'delivered' ? 'selected' : '' }}>
                            Delivered
                        </option>
                        <option value="cancelled"
                            {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endif

@endsection