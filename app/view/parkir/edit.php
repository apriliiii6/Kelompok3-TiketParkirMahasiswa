<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Parking Admin - Update Status Parkir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 mb-4">
        <a class="navbar-brand fw-bold" href="#">E-Parking Admin</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="index.php?url=parkir/index">Data Parkir</a>
        </div>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Login sebagai: <strong><?= htmlspecialchars($_SESSION['username'] ?? 'april admin'); ?></strong> (Admin)</span>
            <a href="index.php?url=auth/logout" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="fw-bold text-dark mb-3">Update Status Tiket Parkir</h3>
                <hr class="mb-4">

                <div class="alert alert-secondary mb-4">
                    <p class="mb-1"><strong>Nomor Tiket:</strong> <?= htmlspecialchars($tiket['nomor_tiket']) ?></p>
                    <p class="mb-1"><strong>Nama / NIM:</strong> <?= htmlspecialchars($tiket['nama']) ?> (<?= htmlspecialchars($tiket['nim']) ?>)</p>
                    <p class="mb-0"><strong>Plat Nomor:</strong> <?= htmlspecialchars($tiket['plat_nomor']) ?></p>
                </div>

                <form action="index.php?url=parkir/edit&id=<?= $tiket['id'] ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Parkir</label>
                        <select name="status" class="form-select">
                            <option value="Aktif" <?= ($tiket['status'] === 'Aktif') ? 'selected' : '' ?>>Aktif (Kendaraan di dalam)</option>
                            <option value="Selesai" <?= ($tiket['status'] === 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="index.php?url=parkir/index" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>