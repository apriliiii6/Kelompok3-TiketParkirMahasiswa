<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Scan Masuk/Keluar Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        .scanner-box { max-width: 500px; margin: 40px auto; }
        #reader { border-radius: 8px; overflow: hidden; border: 1px solid #ddd !important; }
        #reader__dashboard_section_csr button {
            background-color: #0d6efd !important;
            color: white !important;
            border: none !important;
            padding: 6px 12px !important;
            border-radius: 4px !important;
            margin: 5px !important;
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="card scanner-box p-4 shadow-sm bg-white text-center">
        <h4 class="fw-bold mb-3">Scanner Pos Parkir</h4>
        <p class="text-muted small">Arahkan barcode tiket mahasiswa ke kamera laptop / HP untuk memproses status parkir.</p>
        
        <div id="reader" class="mb-3"></div>

        <form id="formScan" action="index.php?url=parkir/prosesKeluar" method="POST">
            <div class="input-group">
                <span class="input-group-text bg-secondary text-white small">Kode</span>
                <input type="text" name="kode_tiket" id="resultInput" class="form-control" placeholder="Menunggu scan..." readonly required>
                <button type="submit" class="btn btn-success fw-semibold">Proses Manual</button>
            </div>
        </form>
        
        <a href="index.php?url=admin/dashboard" class="btn btn-link btn-sm mt-3 text-decoration-none text-secondary">← Kembali ke Dashboard</a>
    </div>
</div>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById('resultInput').value = decodedText;
        
        html5QrcodeScanner.clear();
        
        document.getElementById('formScan').submit();
    }

    function onScanFailure(error) {
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 15, qrbox: { width: 300, height: 150 } }, false
    );
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

</body>
</html>