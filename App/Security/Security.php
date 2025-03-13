<?php

class Security {
    private $db;
    private const MAX_LOGIN_ATTEMPTS = 3;
    private const LOCKOUT_TIME = 900; // 15 minutos en segundos

    public function __construct() {
        // Inicializar conexión a base de datos
        $this->db = new PDO("mysql:host=localhost;dbname=tu_base_de_datos", "usuario", "contraseña");
    }

    public function login($username, $password) {
        if ($this->isIpLocked($_SERVER['REMOTE_ADDR'])) {
            return ['success' => false, 'message' => 'Demasiados intentos. Intente más tarde.'];
        }

        // Sanitizar entrada
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        
        // Verificar usuario en la base de datos
        $stmt = $this->db->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Reset intentos fallidos
            $this->resetLoginAttempts($_SERVER['REMOTE_ADDR']);
            
            // Generar token de sesión
            $token = bin2hex(random_bytes(32));
            
            // Iniciar sesión segura
            session_start([
                'cookie_httponly' => true,
                'cookie_secure' => true,
                'cookie_samesite' => 'Lax'
            ]);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['token'] = $token;
            
            return ['success' => true];
        }

        // Registrar intento fallido
        $this->recordFailedAttempt($_SERVER['REMOTE_ADDR']);
        return ['success' => false, 'message' => 'Credenciales inválidas'];
    }

    private function isIpLocked($ip) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as attempts, MAX(attempt_time) as last_attempt 
                                   FROM login_attempts 
                                   WHERE ip_address = ? 
                                   AND attempt_time > DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
        $stmt->execute([$ip]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($result['attempts'] >= self::MAX_LOGIN_ATTEMPTS);
    }

    private function recordFailedAttempt($ip) {
        $stmt = $this->db->prepare("INSERT INTO login_attempts (ip_address) VALUES (?)");
        $stmt->execute([$ip]);
    }

    private function resetLoginAttempts($ip) {
        $stmt = $this->db->prepare("DELETE FROM login_attempts WHERE ip_address = ?");
        $stmt->execute([$ip]);
    }

    public function validateCSRFToken($token) {
        return isset($_SESSION['token']) && hash_equals($_SESSION['token'], $token);
    }
} 