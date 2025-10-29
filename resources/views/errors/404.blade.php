<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            text-align: center;
            color: white;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            margin: 0;
        }
        .error-message {
            font-size: 1.5rem;
            margin: 20px 0;
        }
        .error-description {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        .btn-back {
            background: white;
            color: #0066cc;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s ease;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <i class="fas fa-search" style="font-size: 4rem; margin-bottom: 20px;"></i>
        <h1 class="error-code">404</h1>
        <p class="error-message">Halaman Tidak Ditemukan</p>
        <p class="error-description">Halaman yang Anda cari tidak ada atau telah dihapus.</p>
        <a href="/dashboard" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</body>
</html>
