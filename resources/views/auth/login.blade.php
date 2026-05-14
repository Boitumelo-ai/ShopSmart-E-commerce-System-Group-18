<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopSmart - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Full page background */
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Login card styling */
        .auth-card {
            width: 100%;
            max-width: 420px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        /* Top colored header */
        .auth-header {
            background-color: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .auth-body {
            background: white;
            padding: 30px;
        }
        /* Input field styling */
        .form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.2rem rgba(44,62,80,0.25);
        }
        /* Button styling */
        .btn-login {
            background-color: #2c3e50;
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }
        .btn-login:hover {
            background-color: #1a252f;
            color: white;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <!-- Header -->
        <div class="auth-header">
            <h2>🛒 ShopSmart</h2>
            <p class="mb-0">Sign in to your account</p>
        </div>

        <!-- Login Form -->
        <div class="auth-body">

            {{-- Show validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Show success messages --}}
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter your password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-login">
                    Sign In
                </button>

                <!-- Register link -->
                <div class="text-center mt-3">
                    <p class="text-muted">Don't have an account? 
                        <a href="{{ route('register') }}" style="color: #2c3e50; font-weight: bold;">
                            Register here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>