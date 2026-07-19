<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<style>
    .ticket-card { max-width: 350px; margin: 50px auto; border: 2px dashed #333; border-radius: 8px; }
    @media print {
        body * { visibility: hidden; }
        .ticket-card, .ticket-card * { visibility: visible; }
        .ticket-card { position: absolute; left: 0; top: 0; margin: 0; border: none; width: 100%; }
        .btn-print, header, footer, nav { display: none !important; }
    }
</style>

<div class="container">
    <div class="card ticket-card p-4 bg-white text-center shadow-sm">
        <h4 class="fw-bold mb-1">E-TIKET PARKIR</h4>
        <small class="text-secondary">Universitas Parkir 2026</small>
        <hr class="my-2">
        
        <div class="my-3 text-start bg-light p-2 rounded small font-monospace">
            <div><strong>Plat Nomor :</strong> <?= htmlspecialchars($data['plat_nomor'] ?? 'N/A'); ?></div>
            <div><strong>Waktu Masuk:</strong> <?= isset($tiket['waktu_masuk']) ? date('d-m-Y H:i:s', strtotime($tiket['waktu_masuk'])) : date('d-m-Y H:i:s'); ?></div>
            <div><strong>Status      :</strong> Aktif</div>
        </div>

        <div class="my-4 d-flex justify-content-center">
            <div id="qrcodeTarget"></div>
        </div>

        <hr class="my-2">
        <button onclick="window.print()" class="btn btn-dark btn-print w-100 fw-semibold">Cetak Tiket</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rawKode = "<?= $data['kode_tiket'] ?? 'PKR-' . time(); ?>";
        
        const ipKomputer = "192.168.1.XX"; 
        
        const urlAplikasi = "http://" + ipKomputer + "/TiketParkirMahasiswa/public/index.php?url=parkir/prosesKeluar&kode_tiket=" + encodeURIComponent(rawKode);
        
        new QRCode(document.getElementById("qrcodeTarget"), {
            text: urlAplikasi,
            width: 140,
            height: 140,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.M
        });
    });
</script>