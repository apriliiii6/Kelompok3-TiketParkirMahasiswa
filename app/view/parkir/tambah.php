<h2>Buat Tiket Parkir Baru</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form action="index.php?url=parkir/tambah" method="POST" class="form-group">
    <div class="form-field">
        <label>NIM Mahasiswa *</label>
        <input type="text" name="nim" required placeholder="Contoh: 2301010001">
    </div>
    <div class="form-field">
        <label>Nama Lengkap *</label>
        <input type="text" name="nama" required placeholder="Nama lengkap mahasiswa">
    </div>
    <div class="form-field">
        <label>Program Studi</label>
        <input type="text" name="prodi" placeholder="Contoh: Teknik Informatika">
    </div>
    <div class="form-field">
        <label>Plat Nomor Kendaraan *</label>
        <input type="text" name="plat_nomor" required placeholder="Contoh: B 1234 ABC">
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Cetak Tiket & Simpan</button>
        <a href="index.php?url=parkir/index" class="btn btn-secondary">Batal</a>
    </div>
</form>