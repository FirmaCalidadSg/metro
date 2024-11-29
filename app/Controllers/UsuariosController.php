<?php

namespace App\Controllers;


use App\Models\Usuarios;
use App\Models\Security;

class UsuariosController
{
    private $security;
    public $usuarios;

    public function __construct()
    {
        $this->security = new Security();
        $this->usuarios = new Usuarios();
    }

    public function index()
    {

        $usuarios = $this->usuarios->getAllUsuarios();
        // var_dump($usuarios);
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/usuarios/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $roles = $this->security->getAllRoles();
        $usuario = new Usuarios();
        if (isset($_POST['id'])) {
            $usuario = $this->usuarios->getUsuarioById($_POST['id']);
        }
        // require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/usuarios/registro.php';
        // require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function crear()
    {
        $message = 'Usuario registrado exitosamente';
        $usuario = new Usuarios();
        $usuario->id = $_POST['id'];
        $usuario->rol_id = $_POST['rol_id'];
        $usuario->credencial = password_hash($_POST['credencial'], PASSWORD_DEFAULT);
        $usuario->identificacion = $_POST['identificacion'];
        $usuario->nombres = $_POST['nombres'];
        $usuario->apellidos = $_POST['apellidos'];
        $usuario->usuario = $_POST['usuario'];
        if ($usuario->id > 0) {
            $this->usuarios->updateUsuario($usuario);
            $message = 'Usuario actualizado exitosamente';
        } else {
            $this->usuarios->createUsuario($usuario);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
    }
    public function eliminar($id = null)
    {
        try {
            // Verificar si el ID viene en la URL
            if ($id === null) {
                // Si no viene en la URL, intentar obtenerlo del POST
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null;
            }

            if ($id === null) {
                throw new \Exception('ID no proporcionado');
            }

            // Eliminar el usuario
            $this->usuarios->deleteUsuario($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function credenciales()
    {
        // Extraer el ID de la URL
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($urlParts); // Obtiene el último segmento de la URL        
        $usuario = $this->usuarios->getUsuarioById($id);
        // var_dump($usuario);

        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/usuarios/credenciales.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
