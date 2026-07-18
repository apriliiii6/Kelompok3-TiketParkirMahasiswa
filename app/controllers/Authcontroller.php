<?php

class AuthController {
    @var Database 
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function index() {
        require_once '../app/view/auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->db->query("SELECT * FROM users WHERE username = ?");
            $user = $this->db->single([$username]);

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
}