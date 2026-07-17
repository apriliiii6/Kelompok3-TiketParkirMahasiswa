<?php
class Mahasiswa extends Database {
    private $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa ORDER BY nama ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function checkOrInsert($nim, $nama, $prodi, $plat) {
        $stmt = $this->db->prepare("SELECT id FROM mahasiswa WHERE nim = ?");
        $stmt->execute([$nim]);
        $mhs = $stmt->fetch();

        if ($mhs) {
            return $mhs['id'];
        } else {
            $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, prodi, plat_nomor) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nim, $nama, $prodi, $plat]);
            return $this->db->lastInsertId();
        }
    }
}