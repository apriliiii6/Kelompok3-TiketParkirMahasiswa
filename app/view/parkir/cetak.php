<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket Parkir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .tiket-box {
            width: 320px;
            padding: 20px;
            border: 2px dashed #333;
            background-color: #fff;
            text-align: center;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .barcode {
            margin: 20px 0;
        }
        .barcode img {
            max-width: 100%;
            height: auto;
        }
        .info-table {
            width: 100%;
            text-align: left;
            margin-top: 15px;
            font-size: 14px;
        }
        .info-table td {
            padding: 4px 0;
        }
        .footer-text {
            font-size: 11px;
            color: #777;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="tiket-box">
    <h3 style="margin-bottom: 5px;">TIKET PARKIR</h3>
    <h4 style="margin-top: 0; color: #0056b3;">MAHASISWA</h4>
    <hr style="border: top 1px dashed #ccc;">
    
    <div class="barcode">
        <img src="https://bwipjs-api.metafloor.com/?bcid=code128&text=<?= urlencode($data['tiket']['nomor_tiket']); ?>&scale=2&rotate=N&includeText=true" alt="Barcode Tiket">
    </div>

    <table class="info-table">
        <tr>
            <td><strong>No. Tiket</strong></td>
            <td>: <?= $data['tiket']['nomor_tiket']; ?></td>
        </tr>
        <tr>
            <td><strong>NIM</strong></td>
            <td>: <?= $data['tiket']['nim']; ?></td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td>: <?= $data['tiket']['nama']; ?></td>
        </tr>
        <tr>
            <td><strong>Plat Nomor</strong></td>
            <td>: <?= $data['tiket']['plat_nomor']; ?></td>
        </tr>
        <tr>
            <td><strong>Prodi</strong></td>
            <td>: <?= $data['tiket']['prodi']; ?></td>
        </tr>
    </table>

    <hr style="border: top 1px dashed #ccc;">
    <p style="font-size: 12px; margin-bottom: 5px;"><strong>Waktu Masuk:</strong><br><?= $data['tiket']['waktu_masuk']; ?></p>
    <div class="footer-text">Jangan sampai menghilangkan tiket ini!</div>
</div>

<script>
    window.print();
</script>

</body>
</html>