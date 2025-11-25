<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Terkirim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f1f5f9; font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .alert-card { max-width: 500px; text-align: center; padding: 30px; border-radius: 1rem; }
    </style>
</head>
<body>
    <div class="alert-card bg-white shadow-sm">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
        <h3 class="mt-3 text-success">Formulir Berhasil Dikirim!</h3>
        <p class="text-muted">{{ $message ?? 'Kami telah menerima isian formulir Anda. Tim rekrutmen akan segera memprosesnya.' }}</p>
        <hr>
        <p class="small">Anda dapat menutup halaman ini sekarang.</p>
    </div>
</body>
</html>