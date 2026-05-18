 @extends('layouts.app')

@section('content')

<h1>📦 Order #{{ $orders->id }}</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Order details --}}
<div class="card p-4 mb-4">
    <div class="row">
        <div class="col-md-6">
            <h5>Order Information</h5>
            <p><strong>Status:</strong>
                @if($orders->status === 'delivered')
                    <span class="badge bg-success">Delivered</span>
                @elseif($orders->status === 'pending')
                    <span classs="badge bg-warning text-dark">Pending</span>
                @else
                    <span class="badge bg-secondary">{{ $orders->status }}</span>
                @endif
            </p>
            <p><strong>Total:</strong> R{{ $orders->total_amount }}</p>
            <p><strong>Date:</strong> {{ $orders->created_at }}</p>
        </div>
        <div class="col-md-6">
            <h5>Delivery Address</h5>
            <p>{{ $orders->address->residence ?? 'No address' }}</p>
        </div>
    </div>
</div>

{{-- Order items --}}
<div class="card p-4 mb-4">
    <h5>🛍️ Items Ordered</h5>
    <table class="table table-bordered">
        <thead style="background-color: #2c3e50; color: white;">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders->order_item as $item)
            <tr>
                <td>{{ $item->product->description ?? 'Unknown' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>R{{ $item->amount }}</td>
                <td>R{{ $item->quantity * $item->amount }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>R{{ $orders->total_amount }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>

{{-- Payment info --}}
<div class="card p-4 mb-4">
    <h5>💳 Payment</h5>
    @if($orders->payment)
        <p><strong>Method:</strong> {{ $orders->payment->method }}</p>
        <p><strong>Amount:</strong> R{{ $orders->payment->amount }}</p>
        <p><strong>Status:</strong> {{ $orders->payment->status }}</p>
    @else
        <div class="alert alert-warning">
            No payment recorded yet.
            <a href="/payments/create?order_id={{ $orders->id }}"
               class="btn btn-sm btn-primary ms-2">
                Pay Now
            </a>
        </div>
    @endif
</div>

{{-- Reviews --}}
<div class="card p-4">
    <h5>⭐ Reviews</h5>
    @if($orders->review->isEmpty())
        <p class="text-muted">No reviews yet.</p>
        <form action="/reviews" method="POST">
            @csrf
            <input type="hidden" name="order_id"
                   value="{{ $orders->id }}">
            <input type="hidden" name="user_id"
                   value="{{ auth()->id() }}">
            <div class="mb-3">
                <label class="form-label">Select Product</label>
                <select name="product_id" class="form-control">
                    @foreach($orders->order_item as $item)
                        <option value="{{ $item->product_id }}">
                            {{ $item->product->description }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-control">
                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                    <option value="4">⭐⭐⭐⭐ Good</option>
                    <option value="3">⭐⭐⭐ Average</option>
                    <option value="2">⭐⭐ Poor</option>
                    <option value="1">⭐ Terrible</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea name="comment" class="form-control"
                          rows="3"
                          placeholder="Write your review...">
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                Submit Review
            </button>
        </form>
    @else
        @foreach($orders->reviews as $review)
        <div class="card p-3 mb-2">
            <p><strong>Rating:</strong>
                @for($i = 0; $i < $review->rating; $i++)⭐@endfor
            </p>
            <p>{{ $review->comment }}</p>
        </div>
        @endforeach
    @endif
</div>

<a href="/orders" class="btn btn-secondary mt-3">
    ← Back to Orders
</a>

@endsection
