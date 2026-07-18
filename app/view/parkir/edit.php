<h2>Update Status Tiket Parkir</h2>

<div class="detail-tiket">
    <p><strong>Nomor Tiket:</strong> <?= htmlspecialchars($tiket['nomor_tiket']) ?></p>
    <p><strong>Nama/NIM:</strong> <?= htmlspecialchars($tiket['nama']) ?> (<?= htmlspecialchars($tiket['nim']) ?>)</p>
    <p><strong>Plat Nomor:</strong> <?= htmlspecialchars($tiket['plat_nomor']) ?></p>
</div>

<form action="index.php?url=parkir/edit/<?= $tiket['id'] ?>" method="POST" class="form-group">
    <div class="form-field">
        <label>Status Parkir</label>
        <select name="status">
            <option value="Aktif" <?= $tiket['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif (Kendaraan di dalam)</option>
            <option value="Selesai" <?= $tiket['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai (Kendaraan Keluar)</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php?url=parkir/index" class="btn btn-secondary">Kembali</a>
    </div>
</form>