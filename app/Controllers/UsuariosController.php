<?php

namespace App\Controllers;


use App\Models\Usuarios;
use App\Models\Security;
use App\Models\Roles;


class UsuariosController

{
    private $security;
    public $usuarios;
    public $roles;

    public function __construct()
    {
        $this->security = new Security();
        $this->usuarios = new Usuarios();
    }

    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['email'];
            $password = $_POST['password'];
            // Primero obtener el usuario y su hash almacenado
            $user = $this->security->getUserByUsername($username);
            // Verificar si el usuario existe y la contraseña coincide
            if ($user && password_verify($password, $user['credencial'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['usuario'];
                $response = [
                    'success' => true,
                    'message' => 'Login exitoso',
                    'url' => BASE_PATH . 'usuarios/dashboard'
                ];
                echo json_encode($response);
                // exit;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Usuario o contraseña incorrectos',
                    'url' => BASE_PATH . 'login'
                ];
                echo json_encode($response);
            }
        } else {
            require_once __DIR__ . '/../views/security/login.php';
        }
    }

    public function index()
    {
        $usuarios = $this->usuarios->getAllUsuarios();
        // var_dump($usuarios);
        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/usuarios/index.php';
    }

    public function registro()
    {
        // $usuario11 = $this->usuarios->getUsuarios1();
        $roles = $this->security->getAllRoles();
        $usuario = new Usuarios();
        if (isset($_REQUEST['id'])) {
            $usuario = $usuario->getUsuarioById($_REQUEST['id']);
        }
        // require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/usuarios/registro.php';
    }

    public function crear()
    {
        try {
            $message = 'Usuario registrado exitosamente';
            $usuario = new Usuarios();

            $usuario->id = $_POST['id'];
            $usuario->rol_id = $_POST['rol'];
            $usuario->credencial = password_hash($_POST['credencial'], PASSWORD_DEFAULT);
            $usuario->identificacion = $_POST['identificacion'];
            $usuario->nombres = $_POST['nombres'];
            $usuario->apellidos = $_POST['apellidos'];
            $usuario->usuario = $_POST['usuario'];

            if ($usuario->id > 0) {
                if ($this->usuarios->updateUsuario($usuario)) {
                    $message = 'Usuario actualizado exitosamente';
                } else {
                    $message = 'Error al actualizar el usuario';
                    $success = false;
                }
            } else {
                if ($this->usuarios->createUsuario($usuario)) {
                    $message = 'Usuario registrado exitosamente';
                } else {
                    $message = 'Error al registrar el usuario';
                    $success = false;
                }
            }

            $response = [
                'success' => $success ?? true,
                'message' => $message
            ];
            echo json_encode($response);
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function eliminar($id = null)

    {
        try {
            // Verificar si el ID viene en la URL o POST
            if ($id === null) {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null; // Buscar el ID en los datos JSON
            }

            if ($id === null) {
                // Si no hay ID, arrojar un error claro
                throw new \Exception('ID no proporcionado');
            }

            // Eliminar el usuario
            $this->usuarios->deleteUsuario($id);

            // Si todo salió bien, devolver éxito
            echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente']);
        } catch (\PDOException $e) {
            // Si ocurre un error en la base de datos, devolver error con el mensaje
            echo json_encode(['success' => false, 'error' => 'Error al eliminar el usuario: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Manejo general de excepciones
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

        require_once __DIR__ . '/../views/layouts/credenciales.php';
        require_once __DIR__ . '/../views/usuarios/credenciales.php';
    }

    public function actcredenciales()
    {
        // Extraer el ID de la URL
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($urlParts); // Obtiene el último segmento de la URL
        $usuario = new Usuarios();
        $usuario->credencial = $_REQUEST['credencial'];
        $usuario->id = $_REQUEST['id'];
        $usuario->usuario = $_REQUEST['usuario'];
        // var_dump($usuario);
        $result = $this->usuarios->updateCredenciales($usuario);
        echo json_encode($result);
    }


    public function dashboard()
    {
        require_once __DIR__ . '/../views/layouts/dashboard.php';
        require_once __DIR__ . '/../views/usuarios/dashboard.php';
        // require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
