<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ShopSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #2c3e50; }
        .navbar-brand, .nav-link { color: white !important; }
        .btn-primary { background-color: #2c3e50; border-color: #2c3e50; }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">🛒 ShopSmart</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/product">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user_goods">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/review">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cart">
                            🛒 Cart
                            @if(session('cart'))
                                <span class="badge bg-warning text-dark">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Show logout if logged in, login if not --}}
                    @auth
                        <li class="nav-item">
                            <span class="nav-link text-warning">
                                👤 {{ auth()->user()->first_name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="nav-link btn btn-link text-white">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container mt-4">
        {{-- Supports both @yield and $slot for Breeze compatibility --}}
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </div>

    <!-- FOOTER -->
    <footer class="text-center">
        <p>&copy; 2025 ShopSmart. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>