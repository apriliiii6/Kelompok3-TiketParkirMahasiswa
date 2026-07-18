<?php

class Parkircontrollers {
    private $parkirModel;
    private $mahasiswaModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->parkirModel = new Parkir();
        $this->mahasiswaModel = new Mahasiswa();
    }

    public function index() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $tikets = $this->parkirModel->getAllWithMahasiswa();
        
        require_once '../app/view/templates/header.php';
        require_once '../app/view/parkir/index.php';
        require_once '../app/view/templates/footer.php';
    }

    public function tambah() {
        if (!isset($_SESSION['role'])) {
            header("Location: index.php?url=auth/index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = trim($_POST['nim']);
            $nama = trim($_POST['nama']);
            $prodi = trim($_POST['prodi']);
            $plat = trim($_POST['plat_nomor']);

            if (empty($nim) || empty($nama) || empty($plat)) {
                $error = "Semua field wajib diisi!";
                require_once '../app/view/templates/header.php';
                require_once '../app/view/parkir/tambah.php';
                require_once '../app/view/templates/footer.php';
                return;
            }

            $mhsId = $this->mahasiswaModel->checkOrInsert($nim, $nama, $prodi, $plat);
            $nomorTiket = "PKR-" . time();

            $lastInsertId = $this->parkirModel->create($mhsId, $nomorTiket);

            if ($lastInsertId) {
                if ($_SESSION['role'] === 'mahasiswa') {
                    header("Location: index.php?url=parkir/cetak/" . $lastInsertId);
                } else {
                    header("Location: index.php?url=parkir/index");
                }
                exit;
            }
        }

        require_once '../app/view/templates/header.php';
        require_once '../app/view/parkir/tambah.php';
        require_once '../app/view/templates/footer.php';
    }

    public function edit($id) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        $tiket = $this->parkirModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            if ($this->parkirModel->updateStatus($id, $status)) {
                header("Location: index.php?url=parkir/index");
                exit;
            }
        }

        require_once '../app/view/templates/header.php';
        require_once '../app/view/parkir/edit.php';
        require_once '../app/view/templates/footer.php';
    }

    public function hapus($id) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        if ($this->parkirModel->delete($id)) {
            header("Location: index.php?url=parkir/index");
            exit;
        }
    }
}