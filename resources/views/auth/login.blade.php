<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #2d3e50;
            color: #ffffff;
        }
        .login-container {
            min-height: 100vh;
        }
        .illustration-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .illustration-panel img {
            max-width: 80%;
            height: auto;
        }
        .back-arrow {
            position: absolute;
            top: 2rem;
            left: 2rem;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }
        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
        }
        .form-header h2 {
            font-weight: 300;
            font-size: 2.5rem;
        }
        .form-header h2 span {
            font-weight: 700;
        }
        .form-control {
            background-color: #4a5568;
            border: none;
            color: white;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            height: 50px;
        }
        .form-control::placeholder {
            color: #a0aec0;
        }
        .form-control:focus {
            background-color: #4a5568;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25);
            border-color: #f97316;
        }
        .btn-signin {
            background-color: #f97316;
            border: none;
            color: white;
            padding: 0.8rem;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease;
        }
        .btn-signin:hover {
            background-color: #fb923c;
            color: white;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #718096;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #4a5568;
        }
        .divider:not(:empty)::before {
            margin-right: .25em;
        }
        .divider:not(:empty)::after {
            margin-left: .25em;
        }
        .social-btn {
            background-color: white;
            border-radius: 0.5rem;
            height: 50px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }
        .social-btn:hover {
            transform: translateY(-2px);
        }
        .social-btn i {
            font-size: 1.5rem;
        }
        .bi-google { color: #db4437; }
        .bi-facebook { color: #4267B2; }
        .bi-apple { color: #000000; }
        .bottom-link a {
            color: #f97316;
            font-weight: bold;
            text-decoration: none;
        }
        .bottom-link a:hover {
            text-decoration: underline;
        }
        /* Style untuk toggle password */
        .password-input-wrapper {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            font-size: 1.2rem;
        }
        .password-toggle:hover {
            color: white;
        }
        @media (max-width: 991.98px) {
            .illustration-panel {
                display: none;
            }
            .form-panel {
                padding: 1.5rem;
            }
            .illustration-panel {
                display: flex; /* Tampilkan kembali panel ilustrasi di mobile */
                width: 100%; /* Lebar penuh di mobile */
                padding: 1rem 0; /* Padding atas bawah */
                order: -1; /* Pindahkan ke atas form */
            }
            .illustration-panel img {
                max-width: 150px; /* Ukuran gambar lebih kecil di mobile */
                margin-top: 2rem; /* Jarak dari atas */
                margin-bottom: 1rem; /* Jarak dari form */
            }
            .form-panel {
                width: 100%; /* Lebar penuh di mobile */
                padding: 1.5rem; /* Padding yang lebih kecil */
            }
            .back-arrow {
                top: 1rem;
                left: 1rem;
            }
            .form-header h2 {
                text-align: left; /* Pusatkan judul di mobile */
                font-size: 2rem; /* Kecilkan ukuran font judul */
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row login-container">
            <!-- Kolom Ilustrasi (kiri) -->
            <div class="col-lg-7 illustration-panel">
                <a href="{{ url()->previous() }}" class="back-arrow"><i class="bi bi-arrow-left"></i></a>
                {{-- Ganti 'src' dengan path gambar ilustrasi Anda --}}
                <img src="{{ asset('images/auth/login1.png') }}" alt="Ilustrasi Login">
            </div>

            <!-- Kolom Form (kanan) -->
            <div class="col-lg-5 form-panel">
                <div class="w-100" style="max-width: 400px; margin: auto;">
                    <div class="form-header mb-4">
                        <h2><span>Hello !</span><br>Welcome Back</h2>
                    </div>

                    <!-- Menampilkan Error Validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 small p-2" style="background-color: #5c2a2a; color: white;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            @if (Route::has('password.request'))
                                <div class="text-end mt-2">
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: #a0aec0;">Forgot Password?</a>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-signin w-100 mb-4">Sign In</button>

                        <!-- Divider -->
                        <div class="divider mb-4">Or Continue With</div>

                        <!-- Social Login -->
                        <div class="row g-2 mb-4">
                            <div class="col">
                                <a href="{{ route('login.google') }}" class="social-btn"><i class="bi bi-google"></i></a>
                            </div>
                            <div class="col">
                                <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                            </div>
                            <div class="col">
                                <a href="#" class="social-btn"><i class="bi bi-apple"></i></a>
                            </div>
                        </div>

                        <!-- Link Daftar -->
                        <div class="text-center small bottom-link">
                            Tidak Punya Akun? <a href="{{ route('register') }}">Buat Akun !</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>