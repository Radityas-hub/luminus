<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Luminus Education</title>
    
    <!-- Stylesheets -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Base styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
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
            background-image:url('{{ asset('images/logo.png') }}');
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

        /* Logo */
        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
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
            transition: border-color 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #1a73e8;
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
            transition: background-color 0.2s;
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
                    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Daftar ke Luminus Education</h1>
                    <p class="text-gray-600">Buat akun Anda untuk melanjutkan</p>
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

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name field -->
                    <div class="input-wrapper">
                        <label class="block text-gray-700 font-medium mb-2" for="name">Nama</label>
                        <div class="relative">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="input-field"
                                placeholder="Masukkan nama Anda" required>
                        </div>
                    </div>

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
<div class="form-group">
    <label for="gender">Gender</label>
    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
        <option value="">Pilih Gender</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>
    @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

                    <!-- Password fields -->
                    <div class="input-wrapper">
                        <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password"
                                class="input-field"
                                placeholder="Masukkan password" required>
                            <i class="fas fa-eye toggle-password" data-target="password"></i>
                        </div>
                    </div>

                    <div class="input-wrapper">
                        <label class="block text-gray-700 font-medium mb-2" for="password_confirmation">Konfirmasi Password</label>
                        <div class="relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="input-field"
                                placeholder="Konfirmasi password" required>
                            <i class="fas fa-eye toggle-password" data-target="password_confirmation"></i>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-primary w-full">
                        Daftar
                    </button>

                    <!-- Login link -->
                    <div class="text-center mt-6">
                        <p class="text-gray-600 text-sm">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                Masuk sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                
                input.type = input.type === 'password' ? 'text' : 'password';
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>