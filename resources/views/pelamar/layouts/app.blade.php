<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Messari')</title>

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Style -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5; 
            color: #333;
            overflow-x: hidden;
        }

        /* --- Navbar Styles --- */
        .navbar {
            padding: 1rem 0;
            z-index: 1000;
            position: relative;
            background-color: #22374e;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: white;
        }
        .navbar-nav .nav-link {
            margin-right: 1rem;
            color: white;
        }
        .navbar-nav .nav-link:hover {
            color: #ff7b00;
        }
        .navbar-nav .highlight-text {
            color: #ff7b00 !important;
            font-weight: bold;
        }

        /* Global Button Styles */
        .btn-orange {
            background-color: #ff7b00;
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-orange:hover {
            background-color: #ff8c1a;
            color: white;
        }
        
        /* Footer Styles */
        footer.footer { 
            background-color: #071b2f; 
            color: white; 
            width: 100%; 
            padding: 4rem 0; 
        }
        footer.footer ul { 
            list-style-type: none; 
            padding-left: 0; 
        }
        footer.footer .text-white-50 { 
            color: rgba(255, 255, 255, 0.5); 
        }
        footer.footer a { 
            color: #ff7b00; 
            text-decoration: none; 
            transition: text-decoration 0.3s ease; 
        }
        footer.footer a:hover { 
            text-decoration: underline; 
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('pelamar.partials.navbar')

    <main>
        {{-- Konten dari halaman lain akan muncul di sini --}}
        @yield('content')
    </main>
    
    {{-- Memanggil footer partial --}}
    @include('pelamar.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
