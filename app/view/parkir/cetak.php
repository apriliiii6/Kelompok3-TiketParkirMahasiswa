<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket Parkir</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #e0e7ff 0%, #ede9fe 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .header-actions { width: 400px; display: flex; justify-content: space-between; margin-bottom: 12px; }
        .btn { padding: 8px 16px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 600; border: 1px solid #cbd5e1; background: white; color: #334155; cursor: pointer; transition: all 0.2s; }
        .btn:hover { background: #f8fafc; }
        .btn-print { background: linear-gradient(to right, #2563eb, #1d4ed8); color: white; border: none; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3); }
        .card { background: white; padding: 20px; border-radius: 20px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; width: 400px; text-align: center; box-sizing: border-box; }
        .card h3 { font-size: 18px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 3px; }
        .qr-code { margin: 10px 0; }
        .tiket-id { color: #2563eb; font-weight: 800; font-size: 1.2em; margin-bottom: 15px; letter-spacing: 0.5px; }
        .info { text-align: left; margin: 0 auto; width: 100%; font-size: 13px; color: #334155; background: #f8fafc; padding: 12px 15px; border-radius: 12px; box-sizing: border-box; border: 1px solid #f1f5f9; }
        .row { display: flex; margin-bottom: 6px; }
        .row:last-child { margin-bottom: 0; }
        .label { width: 85px; font-weight: 700; color: #64748b; }
        .instruction { font-size: 0.8em; color: #64748b; margin-bottom: 5px; }
        .footer-note { margin-top: 15px; font-size: 0.75em; color: #64748b; border-top: 1px solid #e2e8f0; padding-top: 12px; font-weight: 500; }
    </style>
</head>
<body>

<?php if (isset($tiket)) : ?>
    <div class="header-actions">
        <a href="index.php?url=auth/index" class="btn">&larr; Kembali</a>
        <button class="btn btn-print" onclick="window.print()">Cetak / Print</button>
    </div>

    <div class="card">
        <h3>E-TIKET PARKIR</h3>
        <p class="instruction">Tunjukkan QR Code ini pada pos pemeriksaan</p>

        <div class="qr-code">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=<?= htmlspecialchars($tiket['nomor_tiket']); ?>" alt="QR" style="border-radius: 8px;">
        </div>
        <div class="tiket-id"><?= htmlspecialchars($tiket['nomor_tiket']); ?></div>
        
        <div class="info">
            <div class="row"><span class="label">NIM</span> : <?= htmlspecialchars($tiket['nim']); ?></div>
            <div class="row"><span class="label">Nama</span> : <?= htmlspecialchars($tiket['nama']); ?></div>
            <div class="row"><span class="label">Prodi</span> : <?= htmlspecialchars($tiket['prodi']); ?></div>
            <div class="row"><span class="label">Plat</span> : <?= htmlspecialchars($tiket['plat_nomor']); ?></div>
            <div class="row"><span class="label">Masuk</span> : <?= htmlspecialchars($tiket['waktu_masuk']); ?></div>
        </div>

        <p class="footer-note">Hati-hati dijalan, karna yang di hati belum tentu sejalan☕️</p>
    </div>
<?php endif; ?>

</body>
</html>