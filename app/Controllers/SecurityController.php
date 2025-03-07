<?php

namespace App\Controllers;

require __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;

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
            header('Location: ' . BASE_PATH . 'logout');
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
            header('Location: ' . BASE_PATH . 'logout');
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
        header('Location: ' . BASE_PATH . 'login');
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

    public function loginAuth()
    {
        session_start();
        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";

        $idToken = $_SESSION['jsonResponse']['id_token']; // Tu ID Token
        $accessToken = $_SESSION['jsonResponse']['access_token']; // accessToken
        $tokenParts = explode(".", $idToken);
        $payload = base64_decode($tokenParts[1]);
        $userData = json_decode($payload, true);
        //  print_r($userData);

        // echo "Nombre: " . $userData['name'] . "<br>";
        // echo "Email: " . $userData['email'] . "<br>";


        $url = "https://graph.microsoft.com/v1.0/me";
        $headers = [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $userInfo = json_decode($response, true);
        // print_r($userInfo);

        require_once __DIR__ . '/../views/security/Authlogin.php';
    }



    public function revocarAcceso($tenantId = null, $clientId = null, $clientSecret = null, $userId = null)
    {
        session_start();
        $userId = $_SESSION['userData']['oid'];

        // $tenantId = "7258c2e3-77e9-4639-b8c0-b0ce37f72218";
        // $clientId = "a05de9cb-0cf4-4f44-9f89-94a5fd88f960";
        // $clientSecret = "UZr8Q~k8uws6AamJReZzMvAXWiIbOzQdYqMylbBa";
        /**teamFoodBOGOTA */
        $tenantId = "7b99514b-2c6e-47f0-8e95-f99ecc22f148";
        $clientId = "784e35de-c7a5-4899-a92f-4b9ededb4984";
        $clientSecret = "pB78Q~57KEoj8CVU29hKnGA1to7W~mgTxP47gcM~";

        // 1. Obtener token de acceso
        $tokenUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token";
        $tokenData = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'https://graph.microsoft.com/.default',
            'grant_type' => 'client_credentials',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $tokenResponse = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            // Redireccionar en caso de error
            header("Location: http://localhost/metro/app/?error=token_error");
            exit();
        }

        $tokenData = json_decode($tokenResponse, true);
        $accessToken = $tokenData['access_token'];

        if (!$accessToken) {
            // Redireccionar en caso de error
            header("Location: http://localhost/metro/app/?error=token_error");
            exit();
        }

        // 2. Revocar sesiones del usuario
        $revokeUrl = "https://graph.microsoft.com/v1.0/users/$userId/revokeSignInSessions";
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $revokeUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $revokeResponse = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // print_r($revokeResponse);
        if ($httpCode == 200) {
            $responseData = json_decode($revokeResponse, true);
            if (isset($responseData['value']) && $responseData['value'] === true) {
                // Redireccionar en caso de éxito
                header("Location: http://localhost/metro/app/");
                exit();
            } else {
                // Redireccionar en caso de respuesta inesperada
                header("Location: http://localhost/metro/app/?error=unexpected_response");
                exit();
            }
        } else {
            // Redireccionar en caso de error
            $errorDetails = json_decode($revokeResponse, true);
            header("Location: http://localhost/metro/app/");
            exit();
        }
    }
}
