<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Tiket Parkir - E-Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4 text-center">Buat Tiket Parkir Baru</h4>

                    <form action="index.php?url=parkir/simpan" method="POST">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Nama Akun Login</label>
                            <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($_SESSION['username'] ?? ''); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <select name="prodi" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Prodi --</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Komputer">Teknik Komputer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Plat Nomor Kendaraan</label>
                            <input type="text" name="plat_nomor" class="form-control" placeholder="Contoh: A 5678 XYZ" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="index.php?url=parkir/index" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Buat Tiket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>