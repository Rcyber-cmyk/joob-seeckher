<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Lowongan</title>
    {{-- Sisipkan link CSS Anda di sini --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- Mungkin Anda punya navbar di sini --}}
    @include('pelamar.partials.navbar') 

    <main class="py-4">
        {{-- Ini adalah bagian paling penting, jangan sampai lupa! --}}
        @yield('content')
    </main>

    {{-- Mungkin Anda punya footer di sini --}}
    @include('layouts.partials.footer') 

    {{-- Sisipkan link JS Anda di sini --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>