<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background: linear-gradient(135deg, #e0e7ff 0%, #ede9fe 100%); margin: 0;">
    
    <div style="background: #ffffff; padding: 40px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); border: 1px solid #e2e8f0; width: 100%; max-width: 420px; box-sizing: border-box;">
        
        <div style="text-align: center; margin-bottom: 28px;">
            <h2 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">Halo, Selamat Datang!</h2>
            <p style="font-size: 14px; color: #64748b; margin: 0;">Login dulu buat cetak tiket parkir.</p>
        </div>

        <form action="index.php?url=auth/proses_login" method="POST">
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Username</label>
                <input type="text" name="username" placeholder="Masukkan Username..." required style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Password</label>
                <input type="password" name="password" placeholder="Masukkan password..." required style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; padding: 14px; background: linear-gradient(to right, #2563eb, #1d4ed8); color: #ffffff; font-size: 15px; font-weight: 700; border: none; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);">
                Masuk
            </button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <p style="font-size: 13px; color: #64748b; margin: 0;">
                Belum punya akun? <a href="index.php?url=auth/register" style="color: #2563eb; text-decoration: none; font-weight: 700;">Daftar Baru</a>
            </p>
        </div>

    </div>

</div>