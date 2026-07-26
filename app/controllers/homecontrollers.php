<?php
class Homecontrollers {
    public function index() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TiketParkirMahasiswa/app/view/templates/header.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TiketParkirMahasiswa/app/view/home.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TiketParkirMahasiswa/app/view/templates/footer.php';
    }
}