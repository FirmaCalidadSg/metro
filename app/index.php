<?php

use App\Config\CustomAutoloader;
use App\Lib\Router;
use App\Lib\RouterGroup;

// Debug y errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Constantes
define('BASE_PATH', '/metro/app');
define('APP_PATH', __DIR__);

// Autoloader
require_once __DIR__ . '/config/Autoloader.php';
CustomAutoloader::register();

// Inicializar Router
$router = new Router();

// Rutas de seguridad
$router->group('', 'SecurityController', function($group) {
    $group->add('', 'index');
    $group->add('login', 'login');
    $group->add('logout', 'logout');
    $group->add('dashboard', 'dashboard');
});

// Rutas de usuarios
$router->group('usuarios', 'UsuariosController', function($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro','POST');
    $group->add('crear', 'crear', 'POST');
    $group->add('credenciales/{id}', 'credenciales', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});

// Rutas de roles
$router->group('roles', 'RolesController', function($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro','POST');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
    $group->add('editar/{id}', 'editar');
});
$router->group('api', 'DefinicionesController', function($group) {
    $group->add('usuarios', 'usuarios');
    $group->add('roles', 'roles');

    
});

try {
    $uri = trim(str_replace(BASE_PATH, '', $_SERVER['REQUEST_URI']), '/');
    $method = $_SERVER['REQUEST_METHOD'];
    $router->dispatch($uri, $method);
} catch (\Exception $e) {
    if ($e->getCode() === 404) {
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
    } else {
        error_log($e->getMessage());
        echo "Error en la aplicación: " . $e->getMessage();
    }
}
