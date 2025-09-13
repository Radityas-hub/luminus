<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Luminus Education</title>
    
    <!-- Stylesheets -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Base styles */
        
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #fff;
            margin: 0;
            min-height: 100vh;
        }

        /* Layout */
        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Left side */
        .left-side {
            display: none;
            background-image: url('{{ asset('images/logo.png') }}');
            background-size: cover;
            background-position: center;
        }

        /* Card */
        .card {
            background: #fff;
            width: 100%;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Logo */
        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            gap: 0.75rem;
        }

        .logo-container img {
            width: 40px;
            height: 40px;
        }

        /* Form elements */
        .input-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9e9e9e;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 0 0 2px rgba(26,115,232,0.1);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9e9e9e;
        }

        /* Button */
        .btn-primary {
            background-color: #1a73e8;
            color: #fff;
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #1557b0;
        }

        /* Responsive */
        @media (min-width: 768px) {
            .left-side {
                display: block;
                width: 50%;
            }

            .card {
                width: 50%;
                padding: 3rem;
            }
        }

        @media (min-width: 1024px) {
            .left-side {
                width: 60%;
            }

            .card {
                width: 40%;
            }
        }

        @media (max-width: 640px) {
            .card {
                padding: 1.5rem;
            }

            .logo-container {
                margin-bottom: 1.5rem;
            }

            .input-field {
                padding: 0.625rem 1rem 0.625rem 2.25rem;
            }
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="left-side"></div>

        <div class="card">
            <div class="card-content">
                <!-- Logo -->
                <div class="logo-container">
                    <img src="{{ asset('images/logo2.png') }}" alt="Luminus Logo">
                    <span class="text-xl font-semibold text-gray-800">Luminus Education</span>
                </div>

                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Masuk ke Luminus Education</h1>
                    <p class="text-gray-600">Gunakan akun Anda untuk masuk</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6">
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-50 text-red-600 p-3 rounded-lg flex items-center mb-2">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email field -->
                    <div class="input-wrapper">
                        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="input-field"
                                placeholder="Masukkan email Anda" required>
                        </div>
                    </div>

                    <!-- Password field -->
                    <div class="input-wrapper">
                        <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password"
                                class="input-field"
                                placeholder="Masukkan password" required>
                            <i class="fas fa-eye toggle-password" id="toggleIcon"></i>
                        </div>
                    </div>

                    <!-- Remember me & Forgot password -->
                    <div class="flex items-center justify-between mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox text-blue-500 h-4 w-4">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" 
                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-primary">
                        Masuk
                    </button>

                    <!-- Register link -->
                    <div class="text-center mt-6">
                        <p class="text-gray-600 text-sm">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('toggleIcon').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = this;
            
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>