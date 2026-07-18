<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card-register { max-width: 400px; margin: 80px auto; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="card card-register p-4 bg-white">
    <h3 class="text-center mb-4 fw-bold">Daftar Akun Baru</h3>
    
    <?php if(isset($data['error'])) : ?>
        <div class="alert alert-danger p-2 small text-center"><?= $data['error']; ?></div>
    <?php endif; ?>

    <form action="index.php?url=auth/prosesRegister" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label small fw-semibold text-secondary">Username</label>
            <input type="text" name="username" class="form-control" id="username" required autocomplete="off">
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label small fw-semibold text-secondary">Daftar Sebagai</label>
            <select name="role" class="form-select" id="role">
                <option value="mahasiswa">Mahasiswa</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-3" id="secret-key-container" style="display: none;">
            <label for="secret_key" class="form-label small fw-semibold text-danger">Kode Rahasia Admin</label>
            <input type="password" name="secret_key" class="form-control" id="secret_key">
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-semibold my-2">Daftar Sekarang</button>
    </form>
    
    <div class="text-center mt-3">
        <a href="index.php?url=auth/index" class="text-decoration-none small">Sudah punya akun? Login di sini</a>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        var container = document.getElementById('secret-key-container');
        if (this.value === 'admin') {
            container.style.display = 'block';
            document.getElementById('secret_key').setAttribute('required', 'required');
        } else {
            container.style.display = 'none';
            document.getElementById('secret_key').removeAttribute('required');
        }
    });
</script>

</body>
</html>