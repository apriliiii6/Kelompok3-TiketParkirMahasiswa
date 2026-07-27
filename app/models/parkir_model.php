<?php

class parkir_model {
    private $table = 'tiket_parkir'; 
    private $db;

    public function __construct() {
        $this->db = new database; 
    }

    public function get_all_parkir() {
        $this->db->query('select * from ' . $this->table);
        return $this->db->result_set();
    }

    public function cek_dan_update_expired_tiket() {
        $query = "update " . $this->table . " 
                  set status = 'Expired' 
                  where lower(status) = 'aktif' 
                  and timestampdiff(hour, waktu_masuk, now()) >= 7";
        
        $this->db->query($query);
        $this->db->execute();
        
        return $this->db->row_count();
    }

    public function get_tiket_by_kode($kode_qr) {
        $this->db->query('select * from ' . $this->table . ' where kode_qr = :kode_qr');
        $this->db->bind('kode_qr', $kode_qr);
        return $this->db->single();
    }
}