<?php

class Parkircontrollers {
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
        $filePath = dirname(__DIR__) . '/view/' . $viewPath . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }

        die("File view '{$viewPath}.php' tidak ditemukan di jalur: " . $filePath);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=auth/index");
            exit;
        }

        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: index.php?url=parkir/cetak");
            exit;
        }

        $stmt_update = $this->db->prepare("UPDATE tiket_parkir SET status = 'Expired' WHERE LOWER(status) = 'aktif' AND TIMESTAMPDIFF(HOUR, waktu_masuk, NOW()) >= 7");
        $stmt_update->execute();

        $stmt = $this->db->prepare("SELECT * FROM tiket_parkir ORDER BY id DESC");
        $stmt->execute();
        $data_parkir = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->renderView('parkir/index', ['tiket' => $data_parkir]);
    }

    public function scan() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $this->renderView('admin/scan');
    }

    public function cetak() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $user_id = $_SESSION['user_id'];

        $stmtUser = $this->db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmtUser->execute([$user_id]);
        $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

        $stmtTiket = $this->db->prepare("SELECT * FROM tiket_parkir WHERE mahasiswa_id = ? ORDER BY id DESC LIMIT 1");
        $stmtTiket->execute([$user_id]);
        $tiket = $stmtTiket->fetch(PDO::FETCH_ASSOC);

        if (!$tiket) {
            $nomor_tiket = 'PKR-' . date('YmdHis') . '-' . rand(100, 999);
            $waktu_masuk = date('Y-m-d H:i:s');
            $nim         = $user['nim'] ?? '-';
            $nama        = $user['nama'] ?? '-';
            $prodi       = $user['prodi'] ?? '-';
            $plat_nomor  = $user['plat_nomor'] ?? '-';
            $status      = 'Aktif';

            $stmtInsert = $this->db->prepare("INSERT INTO tiket_parkir (mahasiswa_id, nomor_tiket, nim, nama, prodi, plat_nomor, waktu_masuk, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtInsert->execute([$user_id, $nomor_tiket, $nim, $nama, $prodi, $plat_nomor, $waktu_masuk, $status]);

            $tiket = [
                'nomor_tiket' => $nomor_tiket,
                'nim'         => $nim,
                'nama'        => $nama,
                'prodi'       => $prodi,
                'plat_nomor'  => $plat_nomor,
                'waktu_masuk' => $waktu_masuk,
                'status'      => $status
            ];
        }

        $this->renderView('parkir/cetak', ['tiket' => $tiket]);
    }

    public function edit() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?url=parkir/index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? 'Aktif';

            $stmt = $this->db->prepare("UPDATE tiket_parkir SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);

            header("Location: index.php?url=parkir/index");
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM tiket_parkir WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $tiket = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tiket) {
            header("Location: index.php?url=parkir/index");
            exit;
        }

        $this->renderView('parkir/edit', ['tiket' => $tiket]);
    }

    public function hapus() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $this->db->prepare("DELETE FROM tiket_parkir WHERE id = ?");
            $stmt->execute([$id]);
        }

        header("Location: index.php?url=parkir/index");
        exit;
    }
}