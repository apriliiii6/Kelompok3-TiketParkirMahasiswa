<?php

class Parkir {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAllWithMahasiswa() {
        $query = "SELECT p.*, m.nim, m.nama, m.prodi, m.plat_nomor 
                  FROM tiket_parkir p 
                  JOIN mahasiswa m ON p.mahasiswa_id = m.id 
                  ORDER BY p.waktu_masuk DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT p.*, m.nim, m.nama, m.prodi, m.plat_nomor 
                  FROM tiket_parkir p 
                  JOIN mahasiswa m ON p.mahasiswa_id = m.id 
                  WHERE p.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($mahasiswa_id, $nomor_tiket) {
        $query = "INSERT INTO tiket_parkir (mahasiswa_id, nomor_tiket, waktu_masuk, status) 
                  VALUES (?, ?, NOW(), 'masuk')";
        
        $stmt = $this->db->prepare($query);
        if ($stmt->execute([$mahasiswa_id, $nomor_tiket])) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE tiket_parkir SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$status, $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM tiket_parkir WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}