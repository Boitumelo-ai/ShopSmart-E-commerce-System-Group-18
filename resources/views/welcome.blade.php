@extends('layouts.app')

@section('content')

<style>
    /* Override body to use background image */
    body {
        background-image: url('{{ asset("images/Landing.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: #e8eaf2;
    }

    /* Override navbar to match design */
    .navbar {
        background-color: #0b1628 !important;
        border: 1px solid #1a3a60;
        border-radius: 8px;
    }

    .navbar-brand, .nav-link {
        color: #e8eaf2 !important;
    }

    /* Hero section */
    .hero-section {
        text-align: left;
        padding-left: 20px;
        padding-top: 100px;
        min-height: 60vh;
    }

    .hero-section h1 {
        font-size: 2.5em;
        margin-bottom: 15px;
        color: #ffffff;
    }

    .hero-section p {
        font-size: 1.2em;
        margin-bottom: 30px;
        color: #e8eaf2;
    }

    /* Custom buttons */
    .btn-custom {
        background-color: #1a3a60;
        color: #e8eaf2;
        border: none;
        padding: 12px 24px;
        margin: 8px;
        font-size: 1em;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-custom:hover {
        background-color: #3a6edb;
        color: white;
    }

    /* Features section */
    .features-section {
        margin-top: 60px;
    }

    .feature-card {
        background-color: rgba(11, 22, 40, 0.85);
        border: 1px solid #1a3a60;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        color: #e8eaf2;
        margin-bottom: 20px;
    }

    .feature-card h3 {
        color: #ffffff;
        margin-bottom: 10px;
    }

    .feature-card p {
        color: #5a8fc0;
        font-size: 0.95em;
    }

    /* Footer bar */
    .footer-bar {
        margin-top: 60px;
        padding: 15px 25px;
        border: 1px solid #1a3a60;
        border-radius: 8px;
        background-color: #0b1628;
    }

    .footer-bar strong {
        font-size: 1em;
        color: #ffffff;
        display: block;
    }

    .footer-bar span {
        font-size: 0.85em;
        color: #5a8fc0;
    }

    /* Override card styles for dark theme */
    .card {
        background-color: rgba(11, 22, 40, 0.85) !important;
        border: 1px solid #1a3a60 !important;
        color: #e8eaf2 !important;
    }
</style>

{{-- HERO SECTION --}}
<div class="hero-section">
    <h1>Welcome to ShopSmart 🛒</h1>
    <p>Your one-stop shop for everything you need</p>

    @auth
        {{-- Show dashboard button if logged in --}}
        @if(auth()->user()->role->name === 'vendor')
            <a href="/vendor/dashboard" class="btn btn-custom">
                Go to Dashboard
            </a>
        @else
            <a href="/student/dashboard" class="btn btn-custom">
                Go to Dashboard
            </a>
        @endif
    @else
        {{-- Show login/register if not logged in --}}
        <a href="{{ route('register') }}" class="btn btn-custom">
            Sign Up
        </a>
        <a href="{{ route('login') }}" class="btn btn-custom">
            Log In
        </a>
    @endauth
</div>

{{-- FEATURES SECTION --}}
<div class="features-section">
    <div class="row">
        <div class="col-md-4">
            <div class="feature-card">
                <h2>🎓</h2>
                <h3>Students</h3>
                <p>Browse and buy products from vendors on campus</p>
                <a href="{{ route('register') }}" class="btn btn-custom">
                    Register as Student
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <h2>🏪</h2>
                <h3>Vendors</h3>
                <p>List and sell your products to students</p>
                <a href="{{ route('register') }}" class="btn btn-custom">
                    Register as Vendor
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <h2>🛒</h2>
                <h3>Easy Shopping</h3>
                <p>Add to cart, checkout and track your orders</p>
                <a href="/product" class="btn btn-custom">
                    Browse Products
                </a>
            </div>
        </div>
    </div>
</div>

{{-- FEATURED PRODUCTS --}}
<div class="feature-card mt-4 p-4">
    <h4 class="mb-3">🛍️ Featured Products</h4>
    <div class="row">
       @forelse($products ?? [] as $item)
    <div class="col-md-3">
        <div class="feature-card p-3">
            <h6>{{ $item->description }}</h6>
            <p class="text-success fw-bold">R{{ $item->amount }}</p>
            <a href="/product" class="btn btn-custom btn-sm">
                View
            </a>
        </div>
    </div>
@empty
    <p style="color: #5a8fc0;">No products available yet.</p>
@endforelse
    </div>
</div>

{{-- FOOTER BAR --}}
<div class="footer-bar">
    <strong>Business Chat</strong>
    <span>Live customer communication</span>
</div>

@endsection
