<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Parking Admin - Data Parkir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 mb-4">
        <a class="navbar-brand fw-bold" href="#">E-Parking Admin</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link active" href="index.php?url=parkir/index">Data Parkir</a>
        </div>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Login sebagai: <strong><?= htmlspecialchars($_SESSION['username'] ?? 'april admin'); ?></strong> (Admin)</span>
            <a href="index.php?url=auth/logout" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Daftar Tiket Parkir Aktif & Riwayat</h2>
            <a href="index.php?url=parkir/tambah" class="btn btn-success">+ Buat Tiket Baru</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-3">No Tiket</th>
                            <th class="py-3">NIM / Nama</th>
                            <th class="py-3">Prodi</th>
                            <th class="py-3">Plat Nomor</th>
                            <th class="py-3">Waktu Masuk</th>
                            <th class="py-3">Waktu Keluar</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tiket)): ?>
                            <?php foreach ($tiket as $t): ?>
                            <tr>
                                <td class="ps-3 fw-bold"><?= htmlspecialchars($t['nomor_tiket']); ?></td>
                                <td>
                                    <div><?= htmlspecialchars($t['nim']); ?></div>
                                    <div class="text-muted small"><?= htmlspecialchars($t['nama']); ?></div>
                                </td>
                                <td><?= htmlspecialchars($t['prodi']); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1"><?= htmlspecialchars($t['plat_nomor']); ?></span>
                                </td>
                                <td><?= htmlspecialchars($t['waktu_masuk']); ?></td>
                                <td><?= !empty($t['waktu_keluar']) ? htmlspecialchars($t['waktu_keluar']) : '-'; ?></td>
                                <td>
                                    <span class="badge <?= (strtolower($t['status']) == 'aktif') ? 'bg-success' : 'bg-secondary'; ?>">
                                        <?= htmlspecialchars($t['status']); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="index.php?url=parkir/hapus&id=<?= $t['id']; ?>" class="btn btn-danger btn-sm px-3" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada data tiket parkir.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>