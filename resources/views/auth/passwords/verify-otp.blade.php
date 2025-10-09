    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Verifikasi Kode</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">Masukkan Kode Verifikasi</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Kami telah mengirimkan kode 6 digit ke <span class="font-medium">{{ session('email') }}</span>.
                </p>
            </div>

            <form method="POST" action="{{ route('password.otp.verify') }}" class="mt-8 space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <div>
                    <label for="otp" class="sr-only">Kode OTP</label>
                    <input id="otp" name="otp" type="text" required
                        class="relative block w-full px-3 py-2 text-center text-lg tracking-[1em] border @error('otp') border-red-500 @else border-gray-300 @enderror rounded-md"
                        placeholder="______" maxlength="6">
                    @error('otp')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </body>
    </html>

