<?php
class Parkircontrollers {
    private $tiketModel;
    private $mhsModel;

    public function __construct() {
        $this->tiketModel = new Tiket();
        $this->mhsModel = new Mahasiswa();
}

    public function index() {
        $tikets = $this->tiketModel->getAllWithMahasiswa();
        require_once '../app/views/templates/header.php';
        require_once '../app/views/parkir/index.php';
        require_once '../app/views/templates/footer.php';
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = trim($_POST['nim']);
            $nama = trim($_POST['nama']);
            $prodi = trim($_POST['prodi']);
            $plat = trim($_POST['plat_nomor']);

            if (empty($nim) || empty($nama) || empty($plat)) {
                $error = "Semua field wajib diisi!";
                require_once '../app/views/templates/header.php';
                require_once '../app/views/parkir/tambah.php';
                require_once '../app/views/templates/footer.php';
                return;
            }

            $mhsId = $this->mhsModel->checkOrInsert($nim, $nama, $prodi, $plat);
            
            $nomorTiket = "PKR-" . time();

            if ($this->tiketModel->create($mhsId, $nomorTiket)) {
                header("Location: index.php?url=parkir/index");
                exit;
            }
        }

        require_once '../app/views/templates/header.php';
        require_once '../app/views/parkir/tambah.php';
        require_once '../app/views/templates/footer.php';
    }

    public function edit($id) {
        $tiket = $this->tiketModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            if ($this->tiketModel->updateStatus($id, $status)) {
                header("Location: index.php?url=parkir/index");
                exit;
            }
        }

        require_once '../app/views/templates/header.php';
        require_once '../app/views/parkir/edit.php';
        require_once '../app/views/templates/footer.php';
    }

    public function hapus($id) {
        if ($this->tiketModel->delete($id)) {
            header("Location: index.php?url=parkir/index");
            exit;
        }
    }
}