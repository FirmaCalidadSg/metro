<?php

use App\Config\CustomAutoloader;
use App\Lib\Router;
use App\Lib\RouterGroup;

// Debug y errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Constantes
define('BASE_PATH', '/metro/app/');
define('APP_PATH', __DIR__);

// Autoloader
require_once __DIR__ . '/config/Autoloader.php';
CustomAutoloader::register();

// Inicializar Router
$router = new Router();

// Rutas de seguridad
$router->group('', 'SecurityController', function ($group) {
    $group->add('', 'index');
    $group->add('login', 'login');
    $group->add('auth', 'auth');
    $group->add('logout', 'logout');
    $group->add('dashboard', 'dashboard');
});
// Rutas de usuarios
$router->group('usuarios', 'UsuariosController', function ($group) {
    $group->add('', 'index');
    $group->add('dashboard', 'dashboard');
    $group->add('auth', 'auth', 'POST');
    $group->add('registro', 'registro', 'POST');
    $group->add('crear', 'crear', 'POST');
    $group->add('credenciales/{id}', 'credenciales');
    $group->add('actcredenciales', 'actcredenciales', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
// Rutas de roles
$router->group('roles', 'RolesController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro', 'POST');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
    $group->add('editar/{id}', 'editar');
});
$router->group('api', 'DefinicionesController', function ($group) {
    $group->add('usuarios', 'usuarios');
    $group->add('roles', 'roles');
});
// Rutas de definicion
$router->group('definicion', 'DefinicionController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
// Rutas de paises
$router->group('pais', 'PaisController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro'); // siempre hay que agragarla
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
// Rutas de departamentos
$router->group('departamento', 'DepartamentoController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
// Rutas de ciudades
$router->group('ciudad', 'CiudadController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
// Rutas de equipos
$router->group('equipo', 'EquipoController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});

// Rutas de daños de equipos
$router->group('danoequipo', 'DanoEquipoController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});

// Rutas de procesos
$router->group('proceso', 'ProcesoController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
    $group->add('GetProcesoByPlanta/{id}', 'GetProcesoByPlanta', 'GET');
});

// Rutas de lineas
$router->group('linea', 'LineaController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
    $group->add('getbyplanta/{id}', 'getbyplanta', 'GET');
});
// Rutas de productos
$router->group('producto', 'ProductoController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('agregarproducto', 'agregarproducto');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
// Rutas de productos
$router->group('lineaproducto', 'LineaproductoController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});

$router->group('consultas', 'ConsultasController', function ($group) {
    $group->add('', 'index');
    $group->add('registrosconsulta', 'registrosconsulta');
    $group->add('consultaPreview', 'consultaPreview');
});

$router->group('capacidades', 'CapacidadesController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro',);
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});
$router->group('configuracion', 'ConfiguracionController', function ($group) {
    $group->add('', 'index');
    $group->add('registroConfiguracion', 'registroConfiguracion');
});
$router->group('controlCapacidad', 'ControlCapacidadController', function ($group) {
    $group->add('', 'index');
    $group->add('paradas', 'paradas');
    $group->add('modal1', 'modal1');
    $group->add('modal2', 'modal2');
    $group->add('RegistroCtrlCap', 'RegistroCtrlCap', 'POST');
});
$router->group('reportes', 'ReportesController', function ($group) {
    $group->add('', 'index');
    $group->add('resultados', 'resultados');
});

$router->group('plantas', 'PlantasController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro'); // siempre hay que agragarla
    $group->add('crear', 'crear', 'POST');
    $group->add('registrar', 'registrar', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');

});
$router->group('turno', 'TurnosController', function ($group) {
    $group->add('', 'index');
    $group->add('crud', 'crud');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro'); // siempre hay que agragarla
    $group->add('crear', 'crear', 'POST');
    $group->add('getturnobyplanta/{id}', 'getturnobyplanta', 'GET');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
    $group->add('getturnobyid/{id}', 'getturnobyid', 'GET');
});

$router->group('paros', 'ParosController', function ($group) {
    $group->add('', 'index');
    $group->add('crud', 'crud');
    $group->add('registrar', 'registrar', 'POST');
    $group->add('getturnobyplanta/{id}', 'getturnobyplanta', 'GET');
});


$router->group('categoriaParos', 'CategoriaParosController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro'); // siempre hay que agragarla
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});

$router->group('subCategoriaParos', 'SubCategoriaParosController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro'); // siempre hay que agragarla
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
});

$router->group('tiposParos', 'TiposParosController', function ($group) {
    $group->add('', 'index');
    $group->add('registro', 'registro');
    $group->add('registro/{id}', 'registro'); // siempre hay que agragarla
    $group->add('editarFormulario/{id}', 'editarFormulario');
    $group->add('editar/{id}', 'editar', 'POST');
    $group->add('vistaPrevia/{id}', 'vistaPrevia');
    $group->add('crear', 'crear', 'POST');
    $group->add('eliminar/{id}', 'eliminar', 'POST');
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
