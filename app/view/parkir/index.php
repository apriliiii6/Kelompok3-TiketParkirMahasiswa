<div class="header-action">
    <h2>Daftar Tiket Parkir Aktif & Riwayat</h2>
    <a href="index.php?url=parkir/tambah" class="btn btn-success">+ Buat Tiket Baru</a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>No Tiket</th>
                <th>NIM / Nama</th>
                <th>Prodi</th>
                <th>Plat Nomor</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tikets)): ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada transaksi parkir.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($tikets as $t): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($t['nomor_tiket']) ?></strong></td>
                        <td><?= htmlspecialchars($t['nim']) ?> - <?= htmlspecialchars($t['nama']) ?></td>
                        <td><?= htmlspecialchars($t['prodi']) ?></td>
                        <td><span class="badge-plat"><?= htmlspecialchars($t['plat_nomor']) ?></span></td>
                        <td><?= $t['waktu_masuk'] ?></td>
                        <td><?= $t['waktu_keluar'] ?? '-' ?></td>
                        <td>
                            <span class="status-badge <?= $t['status'] === 'Aktif' ? 'status-aktif' : 'status-selesai' ?>">
                                <?= $t['status'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="index.php?url=parkir/edit/<?= $t['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?url=parkir/hapus/<?= $t['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data tiket ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>