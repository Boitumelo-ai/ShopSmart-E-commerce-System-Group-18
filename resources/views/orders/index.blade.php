 
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📦 My Orders</h1>
</div>

{{-- Success message --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->isEmpty())
    <div class="alert alert-info">
        You have no orders yet.
        <a href="/products">Start Shopping</a>
    </div>
@else
    <table class="table table-bordered">
        <thead style="background-color: #2c3e50; color: white;">
            <tr>
                <th>Order #</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Address</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $orders)
            <tr>
                <td>#{{ $orders->id }}</td>
                <td>
                    {{-- Color code the status --}}
                    @if($orders->status === 'delivered')
                        <span class="badge bg-success">Delivered</span>
                    @elseif($orders->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($orders->status === 'cancelled')
                        <span class="badge bg-danger">Cancelled</span>
                    @else
                        <span class="badge bg-secondary">{{ $orders->status }}</span>
                    @endif
                </td>
                <td>R{{ $orders->total_amount }}</td>
                <td>{{ $orders->address->residence ?? 'N/A' }}</td>
                <td>{{ $orders->created_at }}</td>
                <td>
                    <a href="/orders/{{ $orders->id }}"
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                    {{-- Cancel order --}}
                    @if($orders->status === 'pending')
                    <form action="/orders/{{ $orders->id }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Cancel this order?')">
                            Cancel
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection