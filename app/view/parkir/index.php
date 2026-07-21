<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir Mahasiswa - Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <a class="navbar-brand fw-bold fs-4" href="#">E-Parking Admin</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link active" href="index.php?url=parkir/index">Data Parkir</a>
        </div>
        <div class="d-flex align-items-center text-white gap-3">
            <span>Login sebagai: <strong><?= htmlspecialchars($_SESSION['username'] ?? ''); ?></strong> (<?= ucfirst($_SESSION['role'] ?? ''); ?>)</span>
            <a href="index.php?url=auth/logout" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Daftar Tiket Parkir Aktif & Riwayat</h3>
            <a href="index.php?url=parkir/tambah" class="btn btn-success">+ Buat Tiket Baru</a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">No Tiket</th>
                            <th>NIM / Nama</th>
                            <th>Prodi</th>
                            <th>Plat Nomor</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tiket) && is_array($tiket)): ?>
                            <?php foreach ($tiket as $t): ?>
                            <tr>
                                <td class="ps-3 fw-bold"><?= htmlspecialchars($t['nomor_tiket'] ?? '-'); ?></td>
                                <td>
                                    <div><?= htmlspecialchars($t['nim'] ?? '-'); ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($t['nama'] ?? '-'); ?></small>
                                </td>
                                <td><?= htmlspecialchars($t['prodi'] ?? '-'); ?></td>
                                <td><span class="badge bg-light text-dark border fw-bold"><?= htmlspecialchars($t['plat_nomor'] ?? '-'); ?></span></td>
                                <td><?= htmlspecialchars($t['waktu_masuk'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($t['waktu_keluar'] ?? '-'); ?></td>
                                <td>
                                    <span class="badge bg-<?= ($t['status'] ?? '') === 'aktif' ? 'success' : 'secondary'; ?>">
                                        <?= ucfirst($t['status'] ?? 'aktif'); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="index.php?url=parkir/hapus&id=<?= $t['nomor_tiket'] ?? ''; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tiket ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada tiket parkir yang terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="text-center text-muted mt-5 fs-7">
            &copy; 2026 Kelompok Pemrograman Web 1. All Rights Reserved.
        </footer>
    </div>

</body>
</html>