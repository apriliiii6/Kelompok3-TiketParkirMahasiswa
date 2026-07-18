<?php
class parkir extends Database {
    private $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function getAllWithMahasiswa() {
        $sql = "SELECT t.*, m.nama, m.nim, m.plat_nomor, m.prodi 
                FROM tiket_parkir t 
                JOIN mahasiswa m ON t.mahasiswa_id = m.id 
                ORDER BY t.waktu_masuk DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT t.*, m.nama, m.nim, m.plat_nomor, m.prodi 
                FROM tiket_parkir t 
                JOIN mahasiswa m ON t.mahasiswa_id = m.id 
                WHERE t.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($mahasiswa_id, $nomor_tiket) {
        $waktu_masuk = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO tiket_parkir (mahasiswa_id, nomor_tiket, waktu_masuk, status) VALUES (?, ?, ?, 'Aktif')");
        return $stmt->execute([$mahasiswa_id, $nomor_tiket, $waktu_masuk]);
    }

    public function updateStatus($id, $status) {
        $waktu_keluar = ($status === 'Selesai') ? date('Y-m-d H:i:s') : null;
        $stmt = $this->db->prepare("UPDATE tiket_parkir SET status = ?, waktu_keluar = ? WHERE id = ?");
        return $stmt->execute([$status, $waktu_keluar, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tiket_parkir WHERE id = ?");
        return $stmt->execute([$id]);
    }
}