<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopSmart - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            width: 100%;
            max-width: 480px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
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
        .form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.2rem rgba(44,62,80,0.25);
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: white;
        }
        /* Student button green */
        .btn-student {
            background-color: #27ae60;
        }
        .btn-student:hover {
            background-color: #219a52;
            color: white;
        }
        /* Vendor button dark */
        .btn-vendor {
            background-color: #2c3e50;
        }
        .btn-vendor:hover {
            background-color: #1a252f;
            color: white;
        }
        .role-card {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .role-card:hover {
            border-color: #2c3e50;
        }
        .role-card.selected {
            border-color: #2c3e50;
            background-color: #f0f4f8;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <!-- Header -->
        <div class="auth-header">
            <h2>🛒 ShopSmart</h2>
            <p class="mb-0">Create your account</p>
        </div>

        <div class="auth-body">

            {{-- Show errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">First Name</label>
                    <input
                        type="text"
                        name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror"
                        value="{{ old('first_name') }}"
                        placeholder="Enter your first name"
                        required
                    >
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Last Name</label>
                    <input
                        type="text"
                        name="last_name"
                        class="form-control @error('last_name') is-invalid @enderror"
                        value="{{ old('last_name') }}"
                        placeholder="Enter your last name"
                        required
                    >
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                        placeholder="Minimum 8 characters"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Repeat your password"
                        required
                    >
                </div>

                <!-- Role Selection -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Register as:</label>
                    <div class="row g-3">

                        {{-- Student option --}}
                        <div class="col-6">
                            <div class="role-card text-center" 
                                 onclick="selectRole('student', 2)">
                                <h4>🎓</h4>
                                <h6>Student</h6>
                                <small class="text-muted">Browse and buy products</small>
                            </div>
                        </div>

                        {{-- Vendor option --}}
                        <div class="col-6">
                            <div class="role-card text-center" 
                                 onclick="selectRole('vendor', 1)">
                                <h4>🏪</h4>
                                <h6>Vendor</h6>
                                <small class="text-muted">Sell your products</small>
                        </div>
                        </div>

                    </div>
                    {{-- Hidden field that stores the selected role_id --}}
                    <input type="hidden" name="role_id" id="role_id" 
                           value="{{ old('role_id', 2) }}">

                    {{-- Shows which role is currently selected --}}
                    <p class="text-center mt-2 text-muted" id="role_label">
                        Selected: Student
                    </p>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-register btn-vendor">
                    Create Account
                </button>

                <!-- Login link -->
                <div class="text-center mt-3">
                    <p class="text-muted">Already have an account?
                        <a href="{{ route('login') }}"
                           style="color: #2c3e50; font-weight: bold;">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // This function runs when user clicks Student or Vendor card
        function selectRole(roleName, roleId) {

            // Remove 'selected' highlight from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add 'selected' highlight to clicked card
            event.currentTarget.classList.add('selected');

            // Set the hidden role_id field to the selected role
            document.getElementById('role_id').value = roleId;

            // Update the label text
            document.getElementById('role_label').textContent =
                'Selected: ' + roleName.charAt(0).toUpperCase() + roleName.slice(1);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>