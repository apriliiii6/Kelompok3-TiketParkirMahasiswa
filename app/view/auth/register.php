<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 25px; border-radius: 8px; width: 350px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .alert { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; text-align: center; }
        .form-group { margin-bottom: 12px; }
        label { font-size: 13px; font-weight: bold; display: block; margin-bottom: 4px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .link { text-align: center; margin-top: 15px; font-size: 13px; }
    </style>
</head>
<body>
<div class="card">
    <h3 style="text-align: center; margin-top:0;">Daftar Akun Baru</h3>

    <?php if(!empty($error)): ?>
        <div class="alert"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="index.php?url=auth/proses_register" method="POST">
        <div class="form-group">
            <label>Daftar Sebagai</label>
            <select name="role" id="role" onchange="toggleForm()">
                <option value="student">Mahasiswa</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div id="mhs_fields">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim">
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama">
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <input type="text" name="prodi">
            </div>
            <div class="form-group">
                <label>Plat Nomor Kendaraan</label>
                <input type="text" name="plat_nomor" placeholder="Contoh: B 1234 ABC">
            </div>
        </div>

        <div id="admin_fields" style="display: none;">
            <div class="form-group">
                <label>Kode Rahasia Admin</label>
                <input type="password" name="admin_key" placeholder="Masukkan ADMIN123">
            </div>
        </div>

        <button type="submit">Daftar</button>
    </form>
    <div class="link">Sudah punya akun? <a href="index.php?url=auth/index">Login di sini</a></div>
</div>

<script>
function toggleForm() {
    var role = document.getElementById('role').value;
    if(role === 'admin') {
        document.getElementById('admin_fields').style.display = 'block';
        document.getElementById('mhs_fields').style.display = 'none';
    } else {
        document.getElementById('admin_fields').style.display = 'none';
        document.getElementById('mhs_fields').style.display = 'block';
    }
}
</script>
</body>
</html>