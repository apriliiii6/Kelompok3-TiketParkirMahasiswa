<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../app/config/database.php';

spl_autoload_register(function ($class_name) {
    $file_lower = strtolower($class_name);
    
    if (file_exists('../app/controllers/' . $file_lower . '.php')) {
        require_once '../app/controllers/' . $file_lower . '.php';
    } elseif (file_exists('../app/models/' . $class_name . '.php')) {
        require_once '../app/models/' . $class_name . '.php';
    }
});

$url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : [];
$controllerName = isset($url[0]) ? strtolower($url[0]) : 'home';
$actionName = isset($url[1]) ? $url[1] : 'index';
$id = isset($url[2]) ? $url[2] : null;

$controllerClassName = $controllerName . 'controllers';

if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName();
    if (method_exists($controller, $actionName)) {
        if ($id) {
            $controller->$actionName($id);
        } else {
            $controller->$actionName();
        }
    } else {
        die("404 - Aksi tidak ditemukan: " . $actionName);
    }
} else {
    die("404 - Halaman/Controller tidak ditemukan: " . $controllerClassName);
}