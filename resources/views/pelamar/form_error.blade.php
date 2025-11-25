<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f1f5f9; font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .alert-card { max-width: 500px; text-align: center; padding: 30px; border-radius: 1rem; }
    </style>
</head>
<body>
    <div class="alert-card bg-white shadow-sm">
        <i class="bi bi-x-octagon-fill text-danger" style="font-size: 3rem;"></i>
        <h3 class="mt-3 text-danger">Akses Ditolak</h3>
        <p class="text-muted">{{ $message ?? 'Terjadi kesalahan atau link yang Anda akses tidak valid.' }}</p>
        <hr>
        <p class="small">Jika Anda yakin ini adalah kesalahan, silakan hubungi tim rekrutmen perusahaan.</p>
    </div>
</body>
</html>