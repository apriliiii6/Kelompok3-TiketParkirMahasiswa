<?php

class Parkir extends Controller {

    public function index() {
        $data['judul'] = 'Daftar Tiket Parkir';
        $data['parkir'] = $this->model('Parkir_model')->getAllWithMahasiswa();
        
        $this->view('templates/header', $data);
        $this->view('parkir/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        $this->view('templates/header', ['judul' => 'Tambah Tiket']);
        $this->view('parkir/tambah');
        $this->view('templates/footer');
    }

    public function hapus($id) {
        if ($this->model('Parkir_model')->delete($id) > 0) {
            header('Location: ' . BASEURL . '/parkir');
            exit;
        }
    }
}