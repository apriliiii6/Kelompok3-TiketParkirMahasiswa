<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Parkir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .register-card { width: 100%; max-width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background: #fff; }
    </style>
</head>
<body>
    <div class="register-card">
        <h3 class="text-center mb-4 font-weight-bold">Daftar Akun Baru</h3>
        
        <?php if(isset($data['error'])) : ?>
            <div class="alert alert-danger text-center"><?= $data['error']; ?></div>
        <?php endif; ?>

        <form action="index.php?url=auth/prosesRegister" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3" style="background-color: #0056b3;">Daftar Sekarang</button>
            <div class="text-center">
                <a href="index.php?url=auth/index" class="text-decoration-none small">Sudah punya akun? Login di sini</a>
            </div>
        </form>
    </div>
</body>
</html>