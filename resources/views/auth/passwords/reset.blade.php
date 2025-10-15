
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Buat Password Baru</h2>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
            @csrf
            <input type="hidden" name="email" value="{{ session('email_for_password_reset') }}">
            
            <div>
                <label for="password" class="sr-only">Password Baru</label>
                <input id="password" name="password" type="password" required
                       class="relative block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md"
                       placeholder="Password Baru">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="sr-only">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="relative block w-full px-3 py-2 border border-gray-300 rounded-md"
                       placeholder="Konfirmasi Password Baru">
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>
