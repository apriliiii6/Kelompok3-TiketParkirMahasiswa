<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Tiket - E-Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <a class="navbar-brand fw-bold fs-4" href="#">E-Parking Admin</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="index.php?url=parkir/index">Data Parkir</a>
            <a class="nav-link" href="index.php?url=parkir/users">Data User</a>
            <a class="nav-link active" href="index.php?url=parkir/scan">Scan QR</a>
        </div>
        <div class="d-flex align-items-center text-white gap-3">
            <span>Login sebagai: <strong><?= htmlspecialchars($_SESSION['username'] ?? ''); ?></strong></span>
            <a href="index.php?url=auth/logout" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card border-0 shadow-sm rounded-3 p-4">
                    <h4 class="fw-bold mb-3">Scan QR Code Tiket</h4>
                    <p class="text-muted">Arahkan kamera ke QR Code pada tiket mahasiswa untuk memverifikasi atau memproses keluar parkir.</p>
                    
                    <div class="bg-dark text-white rounded p-5 my-3 d-flex flex-column align-items-center justify-content-center" style="min-height: 250px;">
                        <span class="fs-1">📷</span>
                        <small class="mt-2 text-secondary">[ Fitur Pemindai Kamera QR ]</small>
                    </div>

                    <a href="index.php?url=parkir/index" class="btn btn-secondary mt-2">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>