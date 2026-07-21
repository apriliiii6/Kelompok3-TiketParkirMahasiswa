<?php

class Authcontrollers {
    private $db;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $database = new Database();
        $this->db = $database->connect();
    }

    private function renderView($viewPath, $data = []) {
        extract($data);
        $filePath = __DIR__ . '/../view/' . $viewPath . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }

        die("File view '{$viewPath}.php' tidak ditemukan di jalur: " . $filePath);
    }

    public function index() {
        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);
        $this->renderView('auth/login', ['error' => $error]);
    }

    public function register() {
        $error = $_SESSION['reg_error'] ?? null;
        unset($_SESSION['reg_error']);
        $this->renderView('auth/register', ['error' => $error]);
    }

    public function proses_register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username   = trim($_POST['username'] ?? '');
            $password   = $_POST['password'] ?? '';
            $nama       = trim($_POST['nama'] ?? '');
            $role       = $_POST['role'] ?? 'student';

            if (empty($username) || empty($password)) {
                $_SESSION['reg_error'] = 'Username dan Password wajib diisi!';
                header("Location: index.php?url=auth/register");
                exit;
            }

            $checkUser = $this->db->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
            $checkUser->execute([$username]);
            if ($checkUser->fetch()) {
                $_SESSION['reg_error'] = 'Username sudah terdaftar!';
                header("Location: index.php?url=auth/register");
                exit;
            }

            if ($role === 'admin') {
                $nim        = '-';
                $prodi      = '-';
                $plat_nomor = '-';

                $admin_key  = $_POST['admin_key'] ?? '';
                if ($admin_key !== 'ADMIN123') {
                    $_SESSION['reg_error'] = 'Kode Rahasia Admin salah!';
                    header("Location: index.php?url=auth/register");
                    exit;
                }
            } else {
                $nim        = trim($_POST['nim'] ?? '');
                $prodi      = $_POST['prodi'] ?? '';
                $plat_nomor = strtoupper(trim($_POST['plat_nomor'] ?? ''));

                if (empty($nim) || empty($nama) || empty($prodi) || empty($plat_nomor)) {
                    $_SESSION['reg_error'] = 'Semua data mahasiswa wajib diisi!';
                    header("Location: index.php?url=auth/register");
                    exit;
                }
            }

            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            try {
                $stmt = $this->db->prepare("INSERT INTO users (username, password, nim, nama, prodi, plat_nomor, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $success = $stmt->execute([$username, $password_hash, $nim, $nama, $prodi, $plat_nomor, $role]);

                if ($success) {
                    $user_id = $this->db->lastInsertId();
                    if ($role === 'student') {
                        $stmtMhs = $this->db->prepare("INSERT INTO mahasiswa (id, nim, nama, prodi, plat_nomor) VALUES (?, ?, ?, ?, ?)");
                        $stmtMhs->execute([$user_id, $nim, $nama, $prodi, $plat_nomor]);
                    }

                    header("Location: index.php?url=auth/index");
                    exit;
                }
            } catch (PDOException $e) {
                $_SESSION['reg_error'] = 'Gagal mendaftar, terjadi kesalahan database.';
                header("Location: index.php?url=auth/register");
                exit;
            }
        }
    }

    public function proses_login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $is_valid_pass = $user && (password_verify($password, $user['password']) || $password === $user['password']);

            if ($is_valid_pass) {
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama']     = $user['nama'];
                $_SESSION['role']     = strtolower($user['role']);

                if ($_SESSION['role'] === 'admin') {
                    header("Location: index.php?url=parkir/index");
                } else {
                    header("Location: index.php?url=parkir/cetak");
                }
                exit;
            } else {
                $_SESSION['login_error'] = 'Username atau Password salah!';
                header("Location: index.php?url=auth/index");
                exit;
            }
        }
    }

    public function cetak() {
        header("Location: index.php?url=parkir/cetak");
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php?url=auth/index");
        exit;
    }
}