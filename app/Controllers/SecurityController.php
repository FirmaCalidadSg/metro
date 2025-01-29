<?php

namespace App\Controllers;

use App\Models\Security;

class SecurityController
{
    private $security;

    public function __construct()
    {
        error_log("Construyendo SecurityController");
        $this->security = new Security();
    }

    public function dashboard()
    {
        // Redirigir a login si no hay sesión activa
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
        // Si hay sesión, mostrar dashboard o página principal
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/security/dashboard.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    public function index()
    {
        // Redirigir a login si no hay sesión activa
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
        // Si hay sesión, mostrar dashboard o página principal        
        require_once __DIR__ . '/../views/security/dashboard.php';
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Primero obtener el usuario y su hash almacenado
            $user = $this->security->getUserByUsername($username);

            // Verificar si el usuario existe y la contraseña coincide
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ' . BASE_PATH . '/dashboard');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos";
                require_once __DIR__ . '/../views/security/login.php';
            }
        } else {
            require_once __DIR__ . '/../views/security/login.php';
        }
    }

    public function Auth()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
    }



    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_PATH . '/login');
        exit;
    }

    public function testConnection()
    {
        try {
            $db = \App\Config\Database::getInstance()->getConnection();
            echo "Conexión exitosa a SQL Server";

            // Probar una consulta simple
            $stmt = $db->query("SELECT TOP 1 * FROM users");
            $user = $stmt->fetch();
            var_dump($user);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
