<?php

class Parkircontrollers {
    private $parkirModel;
    private $mahasiswaModel;
    private $db; 

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->parkirModel = new Parkir();
        $this->mahasiswaModel = new Mahasiswa();
        
        $database = new Database();
        $this->db = $database->connect();
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

        $mahasiswa = null;
        
        if ($_SESSION['role'] === 'mahasiswa' && isset($_SESSION['username'])) {
            $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
            $stmt->execute([$_SESSION['username']]);
            $mahasiswa = $stmt->fetch();
        }

        if ($_SESSION['role'] === 'mahasiswa' && $mahasiswa) {
            $nomorTiket = "PKR-" . time();
            $lastInsertId = $this->parkirModel->create($mahasiswa['id'], $nomorTiket);

            if ($lastInsertId) {
                header("Location: index.php?url=parkir/cetak/" . $lastInsertId);
                exit;
            }
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

    public function cetak($id) {
        $tiket = $this->parkirModel->getById($id);
        
        if (!$tiket) {
            echo "Tiket tidak ditemukan.";
            return;
        }

        $data['kode_tiket'] = $tiket['kode_tiket'] ?? $tiket['nomor_tiket'];
        $data['plat_nomor'] = $tiket['plat_nomor'] ?? '';

        require_once '../app/view/parkir/cetak.php';
    }

    public function scan() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        require_once '../app/view/admin/scan.php';
    }

    public function prosesKeluar() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?url=auth/index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kode_tiket = trim($_POST['kode_tiket']);

            if (empty($kode_tiket)) {
                header("Location: index.php?url=parkir/scan&status=error&message=Kode+tiket+kosong");
                exit;
            }

            $stmt = $this->db->prepare("SELECT p.*, m.plat_nomor FROM parkir p 
                                  JOIN mahasiswa m ON p.mahasiswa_id = m.id 
                                  WHERE (p.kode_tiket = ? OR p.nomor_tiket = ?) AND p.status = 'masuk'");
            $stmt->execute([$kode_tiket, $kode_tiket]);
            $parkir = $stmt->fetch();

            if (!$parkir) {
                header("Location: index.php?url=parkir/scan&status=error&message=Tiket+tidak+valid+atau+sudah+keluar");
                exit;
            }

            $waktu_masuk = new DateTime($parkir['waktu_masuk']);
            $waktu_keluar = new DateTime();
            $selisih = $waktu_masuk->diff($waktu_keluar);
            
            $total_jam = $selisih->h + ($selisih->days * 24);
            if ($selisih->i > 0 || $selisih->s > 0) {
                $total_jam++;
            }

            $tarif_awal = 3000;
            $tarif_berikutnya = 2000;
            $total_bayar = ($total_jam <= 1) ? $tarif_awal : $tarif_awal + (($total_jam - 1) * $tarif_berikutnya);

            $update = $this->db->prepare("UPDATE parkir SET waktu_keluar = ?, total_bayar = ?, status = 'keluar' WHERE id = ?");
            $sukses = $update->execute([
                $waktu_keluar->format('Y-m-d H:i:s'),
                $total_bayar,
                $parkir['id']
            ]);

            if ($sukses) {
                header("Location: index.php?url=parkir/scan&status=sukses&bayar=" . $total_bayar);
            } else {
                header("Location: index.php?url=parkir/scan&status=error&message=Gagal+update+database");
            }
            exit;
        }
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