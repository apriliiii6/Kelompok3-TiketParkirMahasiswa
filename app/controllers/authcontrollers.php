<?php

class Authcontrollers {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        require_once '../app/view/auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && ($password == $user['password'] || password_verify($password, $user['password']))) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: index.php?url=parkir/index");
                } else {
                    header("Location: index.php?url=parkir/tambah"); 
                }
                exit;
            } else {
                $data['error'] = "Username atau Password salah!";
                require_once '../app/view/auth/login.php';
            }
        }
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: index.php?url=auth/index");
        exit;
    }

    public function register() {
        require_once '../app/view/auth/register.php';
        $role = $_POST['role'] ?? 'mahasiswa';

if ($role === 'admin') {
    $secret_key = $_POST['secret_key'] ?? '';
    $kode_benar = "PARKIR2026"; 

    if ($secret_key !== $kode_benar) {
        $data['error'] = "Kode Rahasia Admin salah! Anda tidak bisa mendaftar sebagai admin.";
        require_once '../app/view/auth/register.php';
        return;
    }
}
    }

    public function prosesRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $role = $_POST['role'] ?? 'mahasiswa';

            if (empty($username) || empty($password)) {
                $data['error'] = "Semua field wajib diisi!";
                require_once '../app/view/auth/register.php';
                return;
            }

            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $data['error'] = "Username sudah digunakan!";
                require_once '../app/view/auth/register.php';
                return;
            }

            $insert = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            
            if ($insert->execute([$username, $password, $role])) {
                header("Location: index.php?url=auth/index");
                exit;
            } else {
                $data['error'] = "Gagal mendaftarkan akun.";
                require_once '../app/view/auth/register.php';
            }
        }
    }
}