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
        $filePath = __DIR__ . '/../view/' . $viewPath . '.php';

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
            $status      = 'aktif';

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

    public function hapus() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $nomor_tiket = $_GET['id'] ?? null;

        if ($nomor_tiket) {
            $stmt = $this->db->prepare("DELETE FROM tiket_parkir WHERE nomor_tiket = ?");
            $stmt->execute([$nomor_tiket]);
        }

        header("Location: index.php?url=parkir/index");
        exit;
    }
}