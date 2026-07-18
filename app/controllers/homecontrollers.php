<?php
class HomeController {
    public function index() {
        require_once '../app/views/templates/header.php';
        require_once '../app/views/home.php';
        require_once '../app/views/templates/footer.php';
    }
}