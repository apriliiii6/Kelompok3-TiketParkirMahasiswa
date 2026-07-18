<?php
require_once '../app/config/database.php';

spl_autoload_register(function ($class_name) {
    $file_name = strtolower($class_name); 
    
    if (file_exists('../app/controllers/' . $file_name . '.php')) {
        require_once '../app/controllers/' . $file_name . '.php';
    } elseif (file_exists('../app/models/' . $file_name . '.php')) {
        require_once '../app/models/' . $file_name . '.php';
    }
});

$controllerName = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/'))[0] : 'home';
$actionName = isset($_GET['url']) ? (explode('/', rtrim($_GET['url'], '/'))[1] ?? 'index') : 'index';
$id = isset($_GET['url']) ? (explode('/', rtrim($_GET['url'], '/'))[2] ?? null) : null;

$controllerClassName = ucfirst($controllerName) . 'controllers';

if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName();
    if (method_exists($controller, $actionName)) {
        if ($id) {
            $controller->$actionName($id);
        } else {
            $controller->$actionName();
        }
    } else {
        die("404 - Aksi tidak ditemukan");
    }
} else {
    die("404 - Halaman tidak ditemukan");
}