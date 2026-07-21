<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket Parkir</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f2f5; display: flex; flex-direction: column; align-items: center; padding-top: 20px; }
        .header-actions { width: 400px; display: flex; justify-content: space-between; margin-bottom: 15px; }
        .btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; border: 1px solid #ccc; background: white; color: #333; cursor: pointer; }
        .btn-print { background-color: #0d6efd; color: white; border: none; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); width: 400px; text-align: center; }
        .qr-code { margin: 20px 0; }
        .tiket-id { color: #0d6efd; font-weight: bold; font-size: 1.2em; margin-bottom: 20px; }
        .info { text-align: left; margin: 0 auto; width: 90%; }
        .row { display: flex; margin-bottom: 5px; }
        .label { width: 100px; font-weight: bold; }
        .instruction { font-size: 0.85em; color: #555; margin-bottom: 10px; }
        .footer-note { margin-top: 25px; font-size: 0.8em; color: #666; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>

<?php if (isset($tiket)) : ?>
    <div class="header-actions">
        <a href="index.php?url=auth/index" class="btn">&larr; Kembali</a>
        <button class="btn btn-print" onclick="window.print()">Cetak / Print</button>
    </div>

    <div class="card">
        <h3>E-TIKET PARKIR MAHASISWA</h3>
        <p class="instruction">Tunjukkan QR Code ini pada pos pemeriksaan</p>

        <div class="qr-code">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= htmlspecialchars($tiket['nomor_tiket']); ?>" alt="QR">
        </div>
        <div class="tiket-id"><?= htmlspecialchars($tiket['nomor_tiket']); ?></div>
        
        <div class="info">
            <div class="row"><span class="label">NIM</span> : <?= htmlspecialchars($tiket['nim']); ?></div>
            <div class="row"><span class="label">Nama</span> : <?= htmlspecialchars($tiket['nama']); ?></div>
            <div class="row"><span class="label">Prodi</span> : <?= htmlspecialchars($tiket['prodi']); ?></div>
            <div class="row"><span class="label">Plat</span> : <?= htmlspecialchars($tiket['plat_nomor']); ?></div>
            <div class="row"><span class="label">Masuk</span> : <?= htmlspecialchars($tiket['waktu_masuk']); ?></div>
        </div>

        <p class="footer-note">Simpan tiket ini sampai keluar dari area parkir.</p>
    </div>
<?php endif; ?>

</body>
</html>