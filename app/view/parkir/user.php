<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - E-Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <a class="navbar-brand fw-bold fs-4" href="#">E-Parking Admin</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="index.php?url=parkir/index">Data Parkir</a>
            <a class="nav-link active" href="index.php?url=parkir/users">Data User</a>
            <a class="nav-link" href="index.php?url=parkir/scan">Scan QR</a>
        </div>
        <div class="d-flex align-items-center text-white gap-3">
            <span>Login sebagai: <strong><?= htmlspecialchars($_SESSION['username'] ?? ''); ?></strong></span>
            <a href="index.php?url=auth/logout" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container py-4">
        <h3 class="fw-bold mb-4">Daftar User Terdaftar</h3>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Username</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Plat Nomor</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="ps-3"><?= $u['id']; ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($u['username']); ?></td>
                                <td><?= htmlspecialchars($u['nim'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($u['nama'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($u['prodi'] ?? '-'); ?></td>
                                <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($u['plat_nomor'] ?? '-'); ?></span></td>
                                <td><span class="badge bg-info text-dark"><?= ucfirst($u['role']); ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data user.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>