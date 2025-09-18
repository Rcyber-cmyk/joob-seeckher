<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Animasi fade-in sederhana */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md p-8 space-y-6 bg-gray-800 bg-opacity-50 backdrop-blur-sm border border-gray-700 rounded-2xl shadow-2xl animate-fade-in">
        <div class="text-center">
            <!-- Ikon Kunci -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-500 bg-opacity-20 mb-4">
                <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white">Lupa Password?</h2>
            <p class="mt-2 text-sm text-gray-400">
                Jangan khawatir. Masukkan email Anda dan kami akan kirimkan kode verifikasi.
            </p>
        </div>

        <!-- Notifikasi Status -->
        @if (session('status'))
            <div class="bg-green-500 bg-opacity-20 border border-green-400 text-green-300 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
            @csrf
            <div class="relative">
                <label for="email" class="sr-only">Alamat Email</label>
                <!-- Ikon Email di dalam Input -->
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                       class="relative block w-full pl-10 pr-3 py-3 bg-gray-700 border @error('email') border-red-500 @else border-gray-600 @enderror placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                       placeholder="Alamat Email">
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500 transform hover:scale-105 transition-transform duration-300">
                    Kirim Kode Verifikasi
                </button>
            </div>
        </form>
         <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-blue-400 hover:text-blue-300 hover:underline transition-colors duration-300">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>

