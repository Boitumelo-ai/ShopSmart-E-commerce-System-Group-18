@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">💰 Checkout</h4>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('payment.cod.process') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="first_name" 
                                       name="first_name" 
                                       value="{{ old('first_name', auth()->user()->first_name ?? '') }}"
                                       required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="last_name" 
                                       name="last_name" 
                                       value="{{ old('last_name', auth()->user()->last_name ?? '') }}"
                                       required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', auth()->user()->email ?? '') }}"
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="tel" 
                                   class="form-control" 
                                   id="phone_number" 
                                   name="phone_number" 
                                   placeholder="e.g., 0712345678"
                                   value="{{ old('phone_number') }}"
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="delivery_address" class="form-label">Delivery Address</label>
                            <textarea class="form-control" 
                                      id="delivery_address" 
                                      name="delivery_address" 
                                      rows="3" 
                                      placeholder="Enter your full delivery address"
                                      required>{{ old('delivery_address') }}</textarea>
                        </div>
                        
                        {{-- ORDER SUMMARY --}}
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5 class="mb-3">Order Summary</h5>
                                
                                @php
                                    $cart = session()->get('cart', []);
                                    $subtotal = 0;
                                @endphp
                                
                                @foreach($cart as $item)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>
                                            <strong>{{ $item['name'] }}</strong><br>
                                            <small>Quantity: {{ $item['quantity'] }}</small>
                                        </span>
                                        <span class="fw-bold">
                                            R{{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </span>
                                    </div>
                                    @php
                                        $subtotal += $item['price'] * $item['quantity'];
                                    @endphp
                                @endforeach
                                
                                <hr>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>R{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Delivery Fee:</span>
                                    <span>R0.00</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong class="fs-5">Total:</strong>
                                    <strong class="fs-5 text-success">R{{ number_format($subtotal, 2) }}</strong>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 py-2">
                            Confirm Order
                        </button>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('cart.index') }}" class="text-decoration-none">
                                ← Back to Cart
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection