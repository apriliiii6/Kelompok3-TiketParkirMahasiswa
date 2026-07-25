<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #e0e7ff 0%, #ede9fe 100%); display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 35px; border-radius: 20px; width: 380px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; box-sizing: border-box; }
        .alert { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; text-align: center; }
        .form-group { margin-bottom: 14px; }
        label { font-size: 13px; font-weight: 700; color: #334155; display: block; margin-bottom: 6px; }
        input, select { width: 100%; padding: 12px 14px; border: 2px solid #e2e8f0; border-radius: 10px; box-sizing: border-box; font-size: 14px; outline: none; }
        input:focus, select:focus { border-color: #2563eb; }
        button { width: 100%; padding: 14px; background: linear-gradient(to right, #2563eb, #1d4ed8); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; margin-top: 15px; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3); }
        .link { text-align: center; margin-top: 20px; font-size: 13px; color: #64748b; }
        .link a { color: #2563eb; text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>
<div class="card">
    <h3 style="text-align: center; margin-top:0; font-size: 24px; font-weight: 800; color: #0f172a;">Daftar Akun Baru 🚀</h3>

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
            <input type="text" name="username" placeholder="Masukkan username..." required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password..." required>
        </div>

        <div id="mhs_fields">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM...">
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap...">
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <input type="text" name="prodi" placeholder="Masukkan prodi...">
            </div>
            <div class="form-group">
                <label>Plat Nomor Kendaraan</label>
                <input type="text" name="plat_nomor" placeholder="Contoh: B 1234 ABC">
            </div>
        </div>

        <div id="admin_fields" style="display: none;">
            <div class="form-group">
                <label>Kode Rahasia Admin</label>
                <input type="password" name="admin_key" placeholder="Masukkan kode rahasia...">
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